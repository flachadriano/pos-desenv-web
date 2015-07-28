package br.edu.furb.mymony.persistence;

import java.util.List;

import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

import br.edu.furb.mymony.model.Category;
import br.edu.furb.mymony.model.Transaction;

public class TransactionDAO {

	@Inject
	private EntityManager em;

	@SuppressWarnings("unchecked")
	public List<Transaction> all() {
		Query q = em.createQuery("select t from Transaction as t", Transaction.class);
		return q.getResultList();
	}

	public void add(Transaction transaction) {
		em.persist(transaction);
	}

	public Transaction get(int code) {
		return em.find(Transaction.class, code);
	}

	public void update(Transaction transaction) {
		em.merge(transaction);
	}

	public void delete(Transaction transaction) {
		em.remove(em.find(Transaction.class, transaction.getId()));
	}

	public List getAllGroupedByDate() {
		return em.createQuery("select t.date, sum(t.amount) from Transaction as t group by t.date").getResultList();
	}

	public Object getAmountByCategory(Category c) {
		List<Object[]> list = em.createQuery(
				"select sum(t.amount) "
				+ "from Transaction as t "
				+ "where :c member of t.categories ").setParameter("c", c).getResultList();
		if (list == null) {
			return 0.0;
		} else if (list.get(0) == null) {
			return 0.0;
		}
		return list.get(0);
	}

}
