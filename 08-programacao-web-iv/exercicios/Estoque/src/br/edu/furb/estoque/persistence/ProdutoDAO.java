package br.edu.furb.estoque.persistence;

import java.util.List;

import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

import br.edu.furb.estoque.model.Produto;

public class ProdutoDAO {

	@Inject
	private EntityManager em;

	public void inserir(Produto produto) {
		em.persist(produto);
	}

	public void atualizar(Produto produto) {
		em.merge(produto);
	}

	public void excluir(Produto produto) {
		Produto prod = em.find(Produto.class, produto.getId());
		em.remove(prod);
	}

	@SuppressWarnings("unchecked")
	public List<Produto> listarTodos() {
		Query q = em.createQuery("select o from Produto as o", Produto.class);
		return q.getResultList();
	}

}
