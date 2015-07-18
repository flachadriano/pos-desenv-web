package edu.furb.catalogo.persistence;

import edu.furb.catalogo.model.Contato;
import java.util.List;
import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

public class ContatoDAO {

    @Inject
    private EntityManager em;

    public void inserir(Contato contato) {
        em.persist(contato);
    }

    public void atualizar(Contato contato) {
        em.merge(contato);
    }

    public void excluir(Contato contato) {
        Contato c = em.find(Contato.class, contato.getCodigo());
        em.remove(c);
    }

    public List<Contato> listarTodos() {
        Query q = em.createQuery("select o from Contato as o", Contato.class);
        return q.getResultList();
    }
}
