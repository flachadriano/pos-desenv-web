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

import com.google.appengine.api.datastore.DatastoreService;
import com.google.appengine.api.datastore.DatastoreServiceFactory;
import com.google.appengine.api.datastore.Entity;

@SuppressWarnings("serial")
public class ControllerServlet extends HttpServlet {

	DatastoreService datastore = DatastoreServiceFactory.getDatastoreService();

	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		Entity usuario = new Entity("usuario");
		usuario.setProperty("login", req.getParameter("login").toString());

		try {

			String password = req.getParameter("password").toString();
			byte[] passwordBytes = password.getBytes();
			Cipher cipher;
			cipher = Cipher.getInstance("AES");
			cipher.init(Cipher.ENCRYPT_MODE, new SecretKeySpec(passwordBytes, "AES"));
			byte[] encryptedBytes = cipher.doFinal(passwordBytes);
			usuario.setProperty("password", encryptedBytes.toString());

		} catch (NoSuchAlgorithmException | NoSuchPaddingException | InvalidKeyException | IllegalBlockSizeException
				| BadPaddingException e) {
			e.printStackTrace();
		}

		datastore.put(usuario);
	}

}
