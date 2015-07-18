package br.edu.furb.estoque.persistence;

import java.util.List;

import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

import br.edu.furb.estoque.model.CategoriaProduto;

public class CategoriaProdutoDAO {

	@Inject
	private EntityManager em;

	public void inserir(CategoriaProduto categoria) {
		em.persist(categoria);
	}

	public void alterar(CategoriaProduto categoria) {
		em.merge(categoria);
	}

	public void excluir(CategoriaProduto categoria) {
		CategoriaProduto c = em.find(CategoriaProduto.class, categoria.getId());
		em.remove(c);
	}

	public List<CategoriaProduto> listarTodos() {
		Query q = em.createQuery("select o from CategoriaProduto as o", CategoriaProduto.class);
		return q.getResultList();
	}

	public CategoriaProduto buscar(int codigo) {
		return em.find(CategoriaProduto.class, codigo);
	}
}
