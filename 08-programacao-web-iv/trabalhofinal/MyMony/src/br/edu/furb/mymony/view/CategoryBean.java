package br.edu.furb.mymony.view;

import java.util.List;

import javax.enterprise.context.RequestScoped;
import javax.faces.component.UIData;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.mymony.model.Category;
import br.edu.furb.mymony.persistence.CategoryDAO;
import br.edu.furb.mymony.persistence.Transaction;

@Named
@RequestScoped
public class CategoryBean {

	@Inject
	private Category category;
	@Inject
	private CategoryDAO dao;

	private UIData selected = null;
	private boolean update = false;

	public UIData getSelectedItem() {
		return selected;
	}

	public void setSelectedItem(UIData selection) {
		this.selected = selection;
	}

	public boolean isUpdating() {
		return update;
	}

	public void setUpdating(boolean update) {
		this.update = update;
	}

	public String update() {
		this.category = (Category) selected.getRowData();
		update = true;
		return "categoria";
	}

	@Transaction
	public String delete() {
		this.category = (Category) selected.getRowData();
		dao.delete(category);
		return "categorias?faces-redirect=true";
	}

	public String clean() {
		return "categorias?faces-redirect=true";
	}

	public List<Category> getCategories() {
		return dao.all();
	}

	@Transaction
	public String save() {
		if (update) {
			dao.update(category);
		} else {
			dao.add(category);
		}
		return "categorias?faces-redirect=true";
	}

	public Category getCategory() {
		return category;
	}

	public void setCategory(Category categoriaItem) {
		this.category = categoriaItem;
	}

}
