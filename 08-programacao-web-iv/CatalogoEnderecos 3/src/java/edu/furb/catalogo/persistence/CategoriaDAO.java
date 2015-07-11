package edu.furb.catalogo.persistence;

import edu.furb.catalogo.model.Categoria;
import java.util.List;
import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.Query;

public class CategoriaDAO {

    @Inject
    private EntityManager em;

    public void inserir(Categoria categoria) {
        em.persist(categoria);
    }

    public void alterar(Categoria categoria) {
        em.merge(categoria);
    }

    public void excluir(Categoria categoria) {
        Categoria c = em.find(Categoria.class, categoria.getCodigo());
        em.remove(c);
    }

    public List<Categoria> listarTodos() {
        Query q = em.createQuery("select o from Categoria as o", Categoria.class);
        return q.getResultList();
    }

    public Categoria buscar(int codigo) {
        return em.find(Categoria.class, codigo);
    }
}
