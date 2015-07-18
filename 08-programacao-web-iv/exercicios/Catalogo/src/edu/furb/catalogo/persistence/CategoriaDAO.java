package edu.furb.catalogo.persistence;

import java.util.LinkedList;
import java.util.List;

import edu.furb.catalogo.model.Categoria;

public class CategoriaDAO {

	public static final List<Categoria> registros = new LinkedList<Categoria>();

	public List<Categoria> list() {
		return registros;
	}

	public void criar(Categoria categoria) {
		registros.add(categoria);
	}

	public void alterar(Categoria categoria) {
		for (int i = 0; i < registros.size(); i++) {
			if (categoria.getCodigo().equals(registros.get(i).getCodigo())) {
				registros.add(i, categoria);
				return;
			}
		}
	}

	public void excluir(Categoria categoria) {
		for (int i = 0; i < registros.size(); i++) {
			if (categoria.getCodigo().equals(registros.get(i).getCodigo())) {
				registros.remove(i);
				return;
			}
		}
	}

}
