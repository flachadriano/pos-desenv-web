package br.furb.mony;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.security.InvalidKeyException;
import java.security.Key;
import java.security.KeyPair;
import java.security.KeyStore;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.PrivateKey;
import java.security.PublicKey;
import java.security.Signature;
import java.security.UnrecoverableKeyException;
import java.security.cert.Certificate;

import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.SecretKeySpec;
import javax.security.cert.X509Certificate;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.commons.codec.binary.Base64;

import com.google.appengine.api.datastore.DatastoreService;
import com.google.appengine.api.datastore.DatastoreServiceFactory;
import com.google.appengine.api.datastore.Entity;
import com.google.appengine.api.datastore.PreparedQuery;
import com.google.appengine.api.datastore.Query;
import com.google.appengine.api.datastore.Query.Filter;
import com.google.appengine.api.datastore.Query.FilterOperator;
import com.google.appengine.api.datastore.Query.FilterPredicate;

@SuppressWarnings("serial")
public class ControllerServlet extends HttpServlet {

	DatastoreService datastore = DatastoreServiceFactory.getDatastoreService();

	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		Entity usuario = new Entity("usuario");
		usuario.setProperty("login", req.getParameter("login").toString());
		byte[] passwordEnc = applyAES(req.getParameter("password").getBytes(), Cipher.ENCRYPT_MODE);
		usuario.setProperty("password", Base64.encodeBase64String(passwordEnc));
		datastore.put(usuario);

	}

	@Override
	protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		String[] params = req.getPathInfo().split("/");
		String login = params[2];

		String message = "";
		if (params.length > 3)
			message = req.getPathInfo().split("/")[3];

		Filter loginFilter = new FilterPredicate("login", FilterOperator.EQUAL, login);
		Query q = new Query("usuario").setFilter(loginFilter);
		PreparedQuery pq = datastore.prepare(q);

		for (Entity result : pq.asIterable()) {
			String password = (String) result.getProperty("password");
			String messageEncoded = (String) result.getProperty("message_encoded");
			String dadosEncoded = (String) result.getProperty("dados_encoded");

			resp.getWriter().write("Senha recuperada: ");
			resp.getWriter().write(new String(applyAES(Base64.decodeBase64(password), Cipher.DECRYPT_MODE)));
			resp.getWriter().write("\n");

			if (message != null && !message.equals("")) {
				resp.getWriter().write("Mensagem assinada: ");
				if (verifyRSATrue(message, messageEncoded.getBytes())) {
					resp.getWriter().write("Confere");
				} else {
					resp.getWriter().write("Não Confere");
				}
			}
			resp.getWriter().write("\n");

			String certificadoResult = decipherWithCertificateKey(dadosEncoded.getBytes());
			if (!certificadoResult.isEmpty())
				resp.getWriter().write("Dados aplicando certificado: " + certificadoResult);
		}
	}

	@Override
	protected void doPut(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		Filter loginFilter = new FilterPredicate("login", FilterOperator.EQUAL, req.getParameter("login"));
		Query q = new Query("usuario").setFilter(loginFilter);
		PreparedQuery pq = datastore.prepare(q);

		for (Entity result : pq.asIterable()) {
			String message = req.getParameter("message");
			if (message != null && !message.equals("")) {
				result.setProperty("message", message);
				result.setProperty("message_encoded", applyRSATrue(message));
			}

			String dados = req.getParameter("dados");
			if (dados != null && !dados.equals("")) {
				result.setProperty("dados", dados);
				result.setProperty("dados_encoded", cipherWithCertificateKey(dados));
			}

			datastore.put(result);
		}
	}

	private String applyRSATrue(String mensagem) {
		byte[] result = "".getBytes();
		try {

			KeyPair par = getKeys(getKeyStore(), "mymony", "mymony".toCharArray());
			PrivateKey priv = par.getPrivate();

			Signature sgn = Signature.getInstance("MD5withRSA");
			sgn.initSign(priv);
			sgn.update(mensagem.getBytes());
			result = sgn.sign();

			if (verifyRSATrue(mensagem, result)) {
				System.out.println("sucess");
			} else {
				System.out.println("falhou");
			}
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new String(Base64.encodeBase64(result));
	}

	private boolean verifyRSATrue(String messageToValidate, byte[] mensageAssinada) {
		boolean result = false;
		try {

			KeyPair par = getKeys(getKeyStore(), "mymony", "mymony".toCharArray());
			PublicKey pub = par.getPublic();

			Signature sgn = Signature.getInstance("MD5withRSA");
			sgn.initVerify(pub);
			sgn.update(messageToValidate.getBytes());
			result = sgn.verify(Base64.decodeBase64(mensageAssinada));

		} catch (Exception e) {
			e.printStackTrace();
		}
		return result;
	}

	private String cipherWithCertificateKey(String msg) {
		byte[] mensagemCifrada = "".getBytes();
		try {
			FileInputStream fr = new FileInputStream("certificado-mymony.cer");
			X509Certificate c = X509Certificate.getInstance(fr);

			Cipher cifra = Cipher.getInstance("RSA");
			cifra.init(Cipher.ENCRYPT_MODE, c.getPublicKey());
			mensagemCifrada = cifra.doFinal(msg.getBytes());

		} catch (Exception e) {
			e.printStackTrace();
		}
		return new String(Base64.encodeBase64(mensagemCifrada));
	}

	private String decipherWithCertificateKey(byte[] msg) {
		byte[] mensagem2 = "".getBytes();
		try {
			Key pKey = getPrivateKey("keystore.jks", "mymony", "mymony");
			Cipher cifra2 = Cipher.getInstance("RSA");
			cifra2.init(Cipher.DECRYPT_MODE, pKey);
			mensagem2 = cifra2.doFinal(Base64.decodeBase64(msg));
		} catch (Exception e) {
			e.printStackTrace();
		}

		return new String(mensagem2);
	}

	private byte[] applyAES(byte[] password, int mode) {
		try {

			String chaveSegura = "chaveSeguraqwert";
			byte[] chaveSeguraBytes = chaveSegura.getBytes();

			Cipher cipher = Cipher.getInstance("AES");
			cipher.init(mode, new SecretKeySpec(chaveSeguraBytes, "AES"));

			return cipher.doFinal(password);

		} catch (NoSuchAlgorithmException | NoSuchPaddingException | InvalidKeyException | IllegalBlockSizeException
				| BadPaddingException e) {
			e.printStackTrace();
		}
		return null;
	}

	public Key getPrivateKey(String fileName, String aliasName, String pass) throws Exception {
		KeyStore ks = KeyStore.getInstance("JKS");
		char[] passPhrase = pass.toCharArray();

		File certificateFile = new File(fileName);
		ks.load(new FileInputStream(certificateFile), passPhrase);

		KeyPair kp = getKeys(ks, aliasName, passPhrase);

		PrivateKey privKey = kp.getPrivate();

		System.out.println("-----BEGIN PRIVATE KEY-----");
		System.out.println(privKey.getEncoded());
		System.out.println("-----END PRIVATE KEY-----");
		// return privKey.getEncoded();
		return kp.getPrivate();
	}

	// From http://javaalmanac.com/egs/java.security/GetKeyFromKs.html

	private KeyStore getKeyStore() {
		try {

			KeyStore ks = KeyStore.getInstance("JKS");
			char[] passPhrase = "mymony".toCharArray();

			File keystorePath = new File("keystore.jks");
			ks.load(new FileInputStream(keystorePath), passPhrase);

			return ks;

		} catch (Exception e) {
		}
		return null;
	}

	public KeyPair getKeys(KeyStore keystore, String alias, char[] password) {
		try {
			// Get private key
			Key key = keystore.getKey(alias, password);
			if (key instanceof PrivateKey) {
				// Get certificate of public key
				Certificate cert = keystore.getCertificate(alias);

				// Get public key
				PublicKey publicKey = cert.getPublicKey();

				// Return a key pair
				return new KeyPair(publicKey, (PrivateKey) key);
			}
		} catch (UnrecoverableKeyException e) {
		} catch (NoSuchAlgorithmException e) {
		} catch (KeyStoreException e) {
		}
		return null;
	}

}
