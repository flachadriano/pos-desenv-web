package br.edu.furb.mymony.persistence;

import java.util.List;

import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

import br.edu.furb.mymony.model.Category;

public class CategoryDAO {

	@Inject
	private EntityManager em;

	@SuppressWarnings("unchecked")
	public List<Category> all() {
		Query q = em.createQuery("select c from Category as c", Category.class);
		return q.getResultList();
	}

	public void add(Category category) {
		em.persist(category);
	}

	public Category get(int code) {
		return em.find(Category.class, code);
	}

	public void update(Category category) {
		em.merge(category);
	}

	public void delete(Category category) {
		em.remove(em.find(Category.class, category.getId()));
	}

	public Category getOrCreateByName(String name) {
		if (name.equals("")) {
			return null;
		}

		List<Category> records = em.createQuery("select c from Category as c where c.name = :nome", Category.class).setParameter("nome", name).getResultList();

		if (records != null) {
			return records.get(0);
		} else {
			Category category = new Category();
			category.setName(name);
			em.persist(category);
			return category;
		}
	}

}
