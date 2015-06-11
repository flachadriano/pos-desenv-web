package edu.furb.mymony;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Server {

	public static final String DB = "/Users/flachadriano/Github/pos-desenv-web/06-fundamentos-web-iv/mymony/database/mymony";

	public static Connection getConnection() throws ClassNotFoundException, SQLException {
		// load the sqlite-JDBC driver using the current class loader
		Class.forName("org.sqlite.JDBC");

		// create a database connection
		return DriverManager.getConnection("jdbc:sqlite:" + Server.DB);
	}

	public static ResultSet executeQuery(Connection connection, String sql) throws SQLException {
		show(sql);
		return connection.createStatement().executeQuery(sql);
	}
	
	public static void executeAndCommit(Connection connection, String sql) throws SQLException {
		show(sql);
		connection.createStatement().executeUpdate(sql);
	}

	public static void closeConnection(Connection connection) throws SQLException {
		if (connection != null)
			connection.close();
	}

	public static void show(String value) {
		System.out.println("SQL -> " + value);
	}

}
