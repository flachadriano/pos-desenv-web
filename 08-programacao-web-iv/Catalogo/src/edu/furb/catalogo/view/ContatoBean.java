package edu.furb.catalogo.view;

import java.util.List;

import javax.faces.bean.ManagedBean;

import edu.furb.catalogo.model.Contato;
import edu.furb.catalogo.persistence.ContatoDAO;

@ManagedBean
public class ContatoBean {

	public ContatoDAO dao = new ContatoDAO();
	public Contato contato = new Contato();

	public List<Contato> getContatos() {
		return dao.list();
	}

	public String criar() {
		dao.criar(contato);
		return "/contatos/index";
	}

	public Contato getContato() {
		return contato;
	}

	public void setContato(Contato contato) {
		this.contato = contato;
	}

}
