package edu.furb.mymony;

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
import br.com.caelum.vraptor.Put;
import br.com.caelum.vraptor.Result;
import edu.furb.mymony.model.Category;

@Controller
@Path("categories")
public class CategoriesController {

	@Inject
	private Result result;

	@Get("index")
	public void index() throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		ResultSet rs = Server.executeQuery(connection, "select id, name from categories");
		List<Category> categories = new LinkedList<Category>();

		while (rs.next()) {
			Category category = new Category();
			category.setId(rs.getLong(1));
			category.setName(rs.getString(2));
			categories.add(category);
		}

		result.include("categories", categories);
		Server.closeConnection(connection);
	}

	@Get("new")
	public void form() {
	}

	@Post("create")
	public void create(Category category) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		String sql = "insert into categories(name) values('" + category.getName() + "')";
		Server.executeAndCommit(connection, sql);
		Server.closeConnection(connection);
	}

	@Put("update")
	public void update() {
	}

	@Delete("destroy")
	public void destroy() {
	}

}
