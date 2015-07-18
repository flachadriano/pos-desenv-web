package edu.furb.catalogo.view;

import java.util.List;

import javax.faces.bean.ManagedBean;
import javax.faces.component.html.HtmlDataTable;

import edu.furb.catalogo.model.Contato;
import edu.furb.catalogo.persistence.ContatoDAO;

@ManagedBean
public class ContatoBean {

	private ContatoDAO dao = new ContatoDAO();
	private Contato contato = new Contato();
	private HtmlDataTable selecionado;

	public List<Contato> getContatos() {
		return dao.list();
	}

	public String criar() {
		dao.criar(contato);
		return "/contatos/index?face-redirect=true";
	}

	public String editar() {
		contato = (Contato) selecionado.getRowData();
		return "/contatos/update";
	}

	public String alterar() {
		dao.alterar(contato);
		return "/contatos/index?face-redirect=true";
	}

	public String excluir() {
		contato = (Contato) selecionado.getRowData();
		dao.excluir(contato);
		return "/contatos/index?face-redirect=true";
	}

	public Contato getContato() {
		return contato;
	}

	public void setContato(Contato contato) {
		this.contato = contato;
	}

	public HtmlDataTable getSelecionado() {
		return selecionado;
	}

	public void setSelecionado(HtmlDataTable selecionado) {
		this.selecionado = selecionado;
	}

}
