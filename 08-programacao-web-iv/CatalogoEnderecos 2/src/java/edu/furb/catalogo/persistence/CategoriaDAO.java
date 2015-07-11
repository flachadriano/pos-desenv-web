package edu.furb.catalogo.persistence;

import edu.furb.catalogo.model.Categoria;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.Query;

public class CategoriaDAO {
    
    public void inserir(Categoria categoria) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            em.persist(categoria);
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
    
    public void alterar(Categoria categoria) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            em.merge(categoria);
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
    
    public void excluir(Categoria categoria) {
        EntityManager em = JpaUtils.getEm();
        em.getTransaction().begin();
        try {
            Categoria c = em.find(Categoria.class, categoria.getCodigo());
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
    
    public List<Categoria> listarTodos() {
        List<Categoria> registros = null;
        EntityManager em = JpaUtils.getEm();
        try {
            Query q = em.createQuery("select o from Categoria as o", Categoria.class);
            registros = q.getResultList();
        } finally {
            em.close();
            JpaUtils.close();
        }
        return registros;
    }

    public Categoria buscar(int codigo) {
        EntityManager em = JpaUtils.getEm();
        try {
            return em.find(Categoria.class, codigo);
        } finally {
            em.close();
            JpaUtils.close();
        }
    }
}
