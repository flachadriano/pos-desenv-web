package edu.furb.catalogo.view;

import edu.furb.catalogo.model.Categoria;
import edu.furb.catalogo.persistence.CategoriaDAO;
import edu.furb.catalogo.persistence.Transaction;
import java.util.List;
import javax.enterprise.context.RequestScoped;
import javax.faces.component.UIData;
import javax.inject.Inject;
import javax.inject.Named;

@Named @RequestScoped
public class CategoriaBean {
    
    @Inject
    private Categoria categoriaItem;
    @Inject
    private CategoriaDAO dao;
    
    private UIData selection;
    private boolean update = false;

    public UIData getSelection() {
        return selection;
    }

    public void setSelection(UIData selection) {
        this.selection = selection;
    }

    public boolean isUpdate() {
        return update;
    }

    public void setUpdate(boolean update) {
        this.update = update;
    }
    
    public String editar() {
        this.categoriaItem = 
                (Categoria) selection.getRowData();
        update = true;
        return "categoria";
    }
    
    @Transaction
    public String excluir() {
        this.categoriaItem = 
                (Categoria) selection.getRowData();
        dao.excluir(categoriaItem);
        return "categoria?faces-redirect=true";
    }
    
    public String limpar() {
        return "categoria?faces-redirect=true";
    }
    
    public List<Categoria> getCategorias() {
        return dao.listarTodos();
    }
    
    @Transaction
    public String salvar() {
        if (update) {
            dao.alterar(categoriaItem);
        } else {
            dao.inserir(categoriaItem);
        }
        return "categoria?faces-redirect=true";
    }
    
    public Categoria getCategoriaItem() {
        return categoriaItem;
    }

    public void setCategoriaItem(Categoria categoriaItem) {
        this.categoriaItem = categoriaItem;
    }
    
}
