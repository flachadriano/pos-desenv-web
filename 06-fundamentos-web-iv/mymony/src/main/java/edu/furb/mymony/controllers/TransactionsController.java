package edu.furb.mymony.controllers;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.inject.Inject;

import br.com.caelum.vraptor.Controller;
import br.com.caelum.vraptor.Delete;
import br.com.caelum.vraptor.Get;
import br.com.caelum.vraptor.Path;
import br.com.caelum.vraptor.Post;
import br.com.caelum.vraptor.Result;
import edu.furb.mymony.Server;
import edu.furb.mymony.models.Transaction;

@Controller
@Path("transactions")
public class TransactionsController {

	@Inject
	private Result result;

	@Get("index")
	public void index() throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "select id, category_id, due_date, value, description from transactions";
		show(sql);
		ResultSet rs = Server.executeQuery(connection, sql);
		List<Transaction> transactions = new LinkedList<Transaction>();

		while (rs.next()) {
			Transaction transaction = new Transaction();
			transaction.setId(rs.getLong(1));
			transaction.setCategory_id(rs.getLong(2));
			transaction.setDue_date(rs.getString(3));
			transaction.setValue(rs.getDouble(4));
			transaction.setDescription(rs.getString(5));
			transactions.add(transaction);
		}

		result.include("transactions", transactions);
		Server.closeConnection(connection);
	}

	@Get("create")
	public void create() {
	}

	@Post("create")
	public void create(Transaction transaction) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "insert into transactions(category_id, due_date, value, description) values('" + transaction.getCategory_id() + //
				"', '" + transaction.getDue_date() + "', '" + transaction.getValue() + "', '" + transaction.getDescription() + "')";
		show(sql);
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(TransactionsController.class).index();
	}

	@Get("update/{id}")
	public void update(Long id) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "select id, category_id, due_date, value, description from transactions where id = " + id;
		show(sql);
		ResultSet rs = Server.executeQuery(connection, sql);

		rs.next();
		Transaction transaction = new Transaction();
		transaction.setId(rs.getLong(1));
		transaction.setCategory_id(rs.getLong(2));
		transaction.setDue_date(rs.getString(3));
		transaction.setValue(rs.getDouble(4));
		transaction.setDescription(rs.getString(5));
		result.include("transaction", transaction);

		Server.closeConnection(connection);
	}

	@Post("update/{id}")
	public void update(Long id, Transaction transaction) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "update transactions set category_id = '" + transaction.getCategory_id() + "', due_date = '" + transaction.getDue_date() + //
				"', value = '" + transaction.getValue() + "', description = '" + transaction.getDescription() + "' where id = " + id;
		show(sql);
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(TransactionsController.class).index();
	}

	@Delete("destroy/{id}")
	public void destroy(Long id) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "delete from transactions where id = " + id;
		show(sql);
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(TransactionsController.class).index();
	}

	private void show(String value) {
		System.out.println("value = " + value);
	}

}
