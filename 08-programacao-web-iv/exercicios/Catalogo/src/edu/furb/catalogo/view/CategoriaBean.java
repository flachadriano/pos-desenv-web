package edu.furb.catalogo.view;

import java.util.List;

import javax.faces.bean.ManagedBean;

import edu.furb.catalogo.model.Categoria;
import edu.furb.catalogo.persistence.CategoriaDAO;

@ManagedBean
public class CategoriaBean {

	private CategoriaDAO dao = new CategoriaDAO();
	private Categoria categoria = new Categoria();

	public List<Categoria> getCategorias() {
		return dao.list();
	}

	public String criar() {
		dao.criar(categoria);
		return "categoria";
	}

	public Categoria getCategoria() {
		return categoria;
	}

	public void setCategoria(Categoria categoria) {
		this.categoria = categoria;
	}

}
