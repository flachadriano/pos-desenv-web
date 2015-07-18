package br.edu.furb.estoque.view;

import java.util.List;

import javax.enterprise.context.RequestScoped;
import javax.faces.component.UIData;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.estoque.model.Produto;
import br.edu.furb.estoque.persistence.ProdutoDAO;
import br.edu.furb.estoque.persistence.Transaction;

@Named
@RequestScoped
public class ProdutoBean {

	@Inject
	private Produto produtoItem;
	@Inject
	private ProdutoDAO dao;

	private UIData selecionado;
	private boolean update = false;

	public UIData getSelecionado() {
		return selecionado;
	}

	public void setSelecionado(UIData selecionado) {
		this.selecionado = selecionado;
	}

	public boolean isUpdate() {
		return update;
	}

	public void setUpdate(boolean update) {
		this.update = update;
	}

	public String editar() {
		produtoItem = (Produto) selecionado.getRowData();
		update = true;
		return "produto-form";
	}

	@Transaction
	public String salvar() {
		if (update) {
			dao.atualizar(produtoItem);
		} else {
			dao.inserir(produtoItem);
		}
		return "produto-list?faces-redirect=true";
	}

	@Transaction
	public String excluir() {
		produtoItem = (Produto) selecionado.getRowData();
		dao.excluir(produtoItem);
		return "produto-list?faces-redirect=true";
	}

	public String limpar() {
		return "produto-list?faces-redirect=true";
	}

	public List<Produto> getContatos() {
		return dao.listarTodos();
	}

	public Produto getContatoItem() {
		return produtoItem;
	}

	public void setContatoItem(Produto contatoItem) {
		this.produtoItem = contatoItem;
	}

}
