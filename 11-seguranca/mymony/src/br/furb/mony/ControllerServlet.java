package br.furb.mony;

import java.io.IOException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;

import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.SecretKeySpec;
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

}
