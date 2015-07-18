package edu.furb.catalogo.persistence;

import edu.furb.catalogo.model.Contato;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.Query;

public class ContatoDAO {

    public void inserir(Contato contato) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            em.persist(contato);
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
    
    public void atualizar(Contato contato) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            em.merge(contato);
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
    
    public void excluir(Contato contato) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            Contato c = em.find(Contato.class, contato.getCodigo());
            em.remove(c);
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
    
    public List<Contato> listarTodos() {
        List<Contato> registros = null;
        EntityManager em = JpaUtils.getEm();
        try {
            Query q = em.createQuery("select o from Contato as o", Contato.class);
            registros = q.getResultList();
        } finally {
            em.close();
            JpaUtils.close();
        }
        return registros;
    }
}
