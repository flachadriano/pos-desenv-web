package br.edu.furb.estoque.persistence;

import java.util.List;

import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

import br.edu.furb.estoque.model.Category;

public class CategoriaProdutoDAO {

	@Inject
	private EntityManager em;

	public void inserir(Category categoria) {
		em.persist(categoria);
	}

	public void alterar(Category categoria) {
		em.merge(categoria);
	}

	public void excluir(Category categoria) {
		Category c = em.find(Category.class, categoria.getId());
		em.remove(c);
	}

	@SuppressWarnings("unchecked")
	public List<Category> listarTodos() {
		Query q = em.createQuery("select o from CategoriaProduto as o", Category.class);
		return q.getResultList();
	}

	public Category buscar(int codigo) {
		return em.find(Category.class, codigo);
	}
}
