package br.edu.furb.mymony.view;

import javax.enterprise.context.RequestScoped;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.mymony.model.Category;
import br.edu.furb.mymony.persistence.CategoryDAO;
import br.edu.furb.mymony.persistence.TransactionDAO;

@Named
@RequestScoped
public class ReportBean {

	@Inject
	private TransactionDAO dao;
	@Inject
	private CategoryDAO cdao;

	public String getData() {
		String data = "[";

		// columns
		data += "[\"Data\", \"Valor\"]";

		// data
		for (Object record : dao.getAllGroupedByDate()) {
			Object[] obj = (Object[]) record;
			data += ", [\"" + obj[0] + "\", " + obj[1] + "]";
		}

		data += "]";
		System.out.println("DATA => " + data);
		return data;
	}

	public String getAmountByCategory() {
		String data = "[";

		// columns
		data += "[\"Categoria\", \"Valor\"]";

		// data
		for (Category cat : cdao.all()) {
			data += ", [\"" + cat.getName() + "\", " + dao.getAmountByCategory(cat) + "]";
		}

		data += "]";
		System.out.println("DATA => " + data);
		return data;
	}

}
