package br.furb.mony;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.security.InvalidKeyException;
import java.security.Key;
import java.security.KeyPair;
import java.security.KeyPairGenerator;
import java.security.KeyStore;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.PrivateKey;
import java.security.PublicKey;
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
		String login = req.getPathInfo().split("/")[2];
		Filter loginFilter = new FilterPredicate("login", FilterOperator.EQUAL, login);
		Query q = new Query("usuario").setFilter(loginFilter);
		PreparedQuery pq = datastore.prepare(q);

		for (Entity result : pq.asIterable()) {
			String password = (String) result.getProperty("password");
			resp.getWriter().write(new String(applyAES(Base64.decodeBase64(password), Cipher.DECRYPT_MODE)));
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
//
//				try {
//					int hashCode = message.hashCode();
//					byte[] hashCodeBytes = new Integer(hashCode).toString().getBytes();
//					result.setProperty("message_hash", hashCode);
//
//					KeyPairGenerator keyGen = KeyPairGenerator.getInstance("RSA");
//					keyGen.initialize(1024);
//					KeyPair key = keyGen.generateKeyPair();
//
//					final Cipher cipher = Cipher.getInstance("RSA");
//					cipher.init(Cipher.ENCRYPT_MODE, key.getPublic());
//					byte[] cipherText = cipher.doFinal(hashCodeBytes);
//					result.setProperty("message_hash_encoded", Base64.encodeBase64String(cipherText));
//
//					final Cipher cipher2 = Cipher.getInstance("RSA");
//					cipher2.init(Cipher.DECRYPT_MODE, key.getPrivate());
//					byte[] cipherText2 = cipher2.doFinal(cipherText);
//					result.setProperty("message_hash_decoded", new String(cipherText2));
//				} catch (Exception e) {
//					e.printStackTrace();
//				}
				
				String encodedMsg = cipherRSA(message);
				result.setProperty("message_encoded", encodedMsg);
				result.setProperty("message_decoded", decipherRSA(encodedMsg));
			}

			String dados = req.getParameter("dados");
			if (dados != null && !dados.equals("")) {
				result.setProperty("dados", dados);

				// FileInputStream fr = new
				// FileInputStream("certificado-mymony.cer");
				// X509Certificate c = X509Certificate.getInstance(fr);
				//
				// Cipher cifra = Cipher.getInstance("RSA");
				// cifra.init(Cipher.ENCRYPT_MODE, c.getPublicKey());
				// byte[] mensagemCifrada = cifra.doFinal(dados.getBytes());
				// result.setProperty("dados_encoded", new
				// String(mensagemCifrada));
				// result.setProperty("dados_encoded", cipherWithKey(dados));

				// Key pKey = getPrivateKey("keystore.jks", "mymony", "mymony");
				// Cipher cifra2 = Cipher.getInstance("RSA");
				// cifra2.init(Cipher.DECRYPT_MODE, pKey);
				// byte[] mensagem2 = cifra2.doFinal(mensagemCifrada);
				// result.setProperty("dados_decoded", new String(mensagem2));

				String mensagem2 = cipherWithCertificateKey(dados);
				result.setProperty("dados_encoded", mensagem2);
				result.setProperty("dados_decoded", decipherWithCertificateKey(mensagem2));
			}

			datastore.put(result);
		}
	}

	private String decipherRSA(String msg) {
		byte[] cipherText2 = "".getBytes();
		try {
			KeyPairGenerator keyGen = KeyPairGenerator.getInstance("RSA");
			keyGen.initialize(1024);
			KeyPair key = keyGen.generateKeyPair();
			
			Cipher cipher2 = Cipher.getInstance("RSA");
			cipher2.init(Cipher.DECRYPT_MODE, key.getPrivate());
			cipherText2 = cipher2.doFinal(msg.getBytes());
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new String(cipherText2);
	}

	private String cipherRSA(String msg) {
		byte[] cipherText = "".getBytes();
		try {
			KeyPairGenerator keyGen = KeyPairGenerator.getInstance("RSA");
			keyGen.initialize(1024);
			KeyPair key = keyGen.generateKeyPair();

			Cipher cipher = Cipher.getInstance("RSA");
			cipher.init(Cipher.ENCRYPT_MODE, key.getPublic());
			cipherText = cipher.doFinal(msg.getBytes());
		} catch (Exception e) {
			e.printStackTrace();
		}
		return new String(cipherText);
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
		return new String(mensagemCifrada);
	}

	private String decipherWithCertificateKey(String msg) {
		byte[] mensagem2 = "".getBytes();
		try {
			Key pKey = getPrivateKey("keystore.jks", "mymony", "mymony");
			Cipher cifra2 = Cipher.getInstance("RSA");
			cifra2.init(Cipher.DECRYPT_MODE, pKey);
			mensagem2 = cifra2.doFinal(msg.getBytes());
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
