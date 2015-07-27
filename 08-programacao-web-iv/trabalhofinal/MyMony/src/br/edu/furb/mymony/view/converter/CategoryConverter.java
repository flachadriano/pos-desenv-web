package br.edu.furb.mymony.view.converter;

import java.util.LinkedList;
import java.util.List;

import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.mymony.model.Category;
import br.edu.furb.mymony.persistence.CategoryDAO;

@Named
public class CategoryConverter implements Converter {

	@Inject
	private CategoryDAO dao;

	@Override
	public List<Category> getAsObject(FacesContext context, UIComponent component, String value) {
		List<Category> records = new LinkedList<Category>();

		String[] names = value.split(",");
		for (String name : names) {
			records.add(dao.getOrCreateByName(name));
		}
		return records;
	}

	@Override
	public String getAsString(FacesContext context, UIComponent component, Object value) {
		@SuppressWarnings("unchecked")
		List<Category> lista = (List<Category>) value;
		if (lista == null) {
			return "";
		}

		StringBuffer result = new StringBuffer();
		for (Category cat : lista) {
			if (result.length() > 0)
				result.append(",");
			result.append(cat.getName());
		}
		return result.toString();
	}

}
