package br.edu.furb.estoque.persistence;

import javax.enterprise.context.ApplicationScoped;
import javax.enterprise.context.RequestScoped;
import javax.enterprise.inject.Disposes;
import javax.enterprise.inject.Produces;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

public class JpaUtils {

	@Produces
	@ApplicationScoped
	public EntityManagerFactory createFactory() {
		return Persistence.createEntityManagerFactory("estoque");
	}

	@Produces
	@RequestScoped
	public EntityManager createEm(EntityManagerFactory emf) {
		return emf.createEntityManager();
	}

	public void closeEm(@Disposes EntityManager em) {
		em.close();
	}

}
