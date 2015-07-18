package br.edu.furb.estoque.view;

import java.util.List;

import javax.enterprise.context.RequestScoped;
import javax.faces.component.UIData;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.estoque.model.Category;
import br.edu.furb.estoque.persistence.CategoriaProdutoDAO;
import br.edu.furb.estoque.persistence.Transaction;

@Named
@RequestScoped
public class CategoriaProdutoBean {

	@Inject
	private Category categoriaItem;
	@Inject
	private CategoriaProdutoDAO dao;

	private UIData selection;
	private boolean update = false;

	public UIData getSelection() {
		return selection;
	}

	public void setSelection(UIData selection) {
		this.selection = selection;
	}

	public boolean isUpdate() {
		return update;
	}

	public void setUpdate(boolean update) {
		this.update = update;
	}

	public String editar() {
		this.categoriaItem = (Category) selection.getRowData();
		update = true;
		return "categoria";
	}

	@Transaction
	public String excluir() {
		this.categoriaItem = (Category) selection.getRowData();
		dao.excluir(categoriaItem);
		return "categorias?faces-redirect=true";
	}

	public String limpar() {
		return "categorias?faces-redirect=true";
	}

	public List<Category> getCategorias() {
		return dao.listarTodos();
	}

	@Transaction
	public String salvar() {
		if (update) {
			dao.alterar(categoriaItem);
		} else {
			dao.inserir(categoriaItem);
		}
		return "categorias?faces-redirect=true";
	}

	public Category getCategoriaItem() {
		return categoriaItem;
	}

	public void setCategoriaItem(Category categoriaItem) {
		this.categoriaItem = categoriaItem;
	}

}
