package edu.furb.catalogo.persistence;

import java.util.LinkedList;
import java.util.List;

import edu.furb.catalogo.model.Contato;

public class ContatoDAO {

	public static final List<Contato> registros = new LinkedList<Contato>();

	public List<Contato> list() {
		return registros;
	}

	public void criar(Contato contato) {
		registros.add(contato);
	}

	public void alterar(Contato contato) {
		for (int i = 0; i < registros.size(); i++) {
			if (contato.getNome().equals(registros.get(i).getNome())) {
				registros.add(i, contato);
				return;
			}
		}
	}

	public void excluir(Contato contato) {
		for (int i = 0; i < registros.size(); i++) {
			if (contato.getNome().equals(registros.get(i).getNome())) {
				registros.remove(i);
				return;
			}
		}
	}

}
