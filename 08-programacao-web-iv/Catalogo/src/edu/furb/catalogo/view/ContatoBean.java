package edu.furb.catalogo.view;

import javax.faces.bean.ManagedBean;

import edu.furb.catalogo.model.Contato;

@ManagedBean
public class ContatoBean {

	public Contato contato = new Contato();

	public Contato getContato() {
		return contato;
	}

	public void setContato(Contato contato) {
		this.contato = contato;
	}

}
