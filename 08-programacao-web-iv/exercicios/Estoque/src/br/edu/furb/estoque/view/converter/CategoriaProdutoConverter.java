package br.edu.furb.estoque.view.converter;

import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.estoque.model.CategoriaProduto;
import br.edu.furb.estoque.persistence.CategoriaProdutoDAO;

@Named
public class CategoriaProdutoConverter implements Converter {

	@Inject
	private CategoriaProdutoDAO dao;

	@Override
	public Object getAsObject(FacesContext context, UIComponent component, String value) {
		return dao.buscar(Integer.parseInt(value));
	}

	@Override
	public String getAsString(FacesContext context, UIComponent component, Object value) {
		CategoriaProduto cat = (CategoriaProduto) value;
		if (cat == null) {
			return "";
		}
		return String.valueOf(cat.getId());
	}

}
