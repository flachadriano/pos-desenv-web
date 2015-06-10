package edu.furb.mymony;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;

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
		ResultSet rs = Server.executeQuery(connection, "select * form categories");

		while (rs.next()) {
			result.include("id", rs.getString("id"));
			result.include("name", rs.getString("name"));
		}

		Server.closeConnection(connection);
	}

	@Get("new")
	public void form() {
	}

	@Post("create")
	public void create(Category category) throws ClassNotFoundException, SQLException {
		Connection connection = Server.getConnection();
		Server.executeAndCommit(connection, "insert into categories values(" + category.getName() + ")");
		Server.closeConnection(connection);
	}

	@Put("update")
	public void update() {
	}

	@Delete("destroy")
	public void destroy() {
	}

}
