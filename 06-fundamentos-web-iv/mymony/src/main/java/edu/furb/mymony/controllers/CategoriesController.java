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
import edu.furb.mymony.models.Category;

@Controller
@Path("categories")
public class CategoriesController {

	@Inject
	private Result result;

	public static List<Category> getCategories() throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "select id, name from categories";
		ResultSet rs = Server.executeQuery(connection, sql);
		List<Category> categories = new LinkedList<Category>();

		while (rs.next()) {
			Category category = new Category();
			category.setId(rs.getLong(1));
			category.setName(rs.getString(2));
			categories.add(category);
		}

		Server.closeConnection(connection);
		return categories;
	}

	@Get("index")
	public void index() throws ClassNotFoundException, SQLException {
		result.include("categories", getCategories());
	}

	@Get("create")
	public void create() {
	}

	@Post("create")
	public void create(Category category) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "insert into categories(name) values('" + category.getName() + "')";
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(CategoriesController.class).index();
	}

	@Get("update/{id}")
	public void update(Long id) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "select id, name from categories where id = " + id;
		ResultSet rs = Server.executeQuery(connection, sql);

		rs.next();
		Category category = new Category();
		category.setId(rs.getLong(1));
		category.setName(rs.getString(2));
		result.include("category", category);

		Server.closeConnection(connection);
	}

	@Post("update/{id}")
	public void update(Long id, Category category) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "update categories set name = '" + category.getName() + "' where id = " + id;
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(CategoriesController.class).index();
	}

	@Delete("destroy/{id}")
	public void destroy(Long id) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "delete from categories where id = " + id;
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);

		result.redirectTo(CategoriesController.class).index();
	}

}
