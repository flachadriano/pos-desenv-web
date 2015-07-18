package edu.furb.catalogo.view;

import edu.furb.catalogo.model.Contato;
import edu.furb.catalogo.persistence.ContatoDAO;
import java.util.List;
import javax.faces.bean.ManagedBean;
import javax.faces.component.UIData;

@ManagedBean
public class ContatoBean {

    private Contato contatoItem = 
                new Contato();
    private ContatoDAO dao = new ContatoDAO();

    private UIData selecionado;
    private boolean update = false;

    public UIData getSelecionado() {
        return selecionado;
    }

    public void setSelecionado(UIData selecionado) {
        this.selecionado = selecionado;
    }

    public boolean isUpdate() {
        return update;
    }

    public void setUpdate(boolean update) {
        this.update = update;
    }
    
    public String editar() {
        contatoItem = (Contato) 
                selecionado.getRowData();
        update = true;
        return "contato-form";
    }
    
    public String salvar() {
        if (update) {
            dao.atualizar(contatoItem);
        } else {
            dao.inserir(contatoItem);
        }
        return "contato-list?faces-redirect=true";
    }
    
    public String excluir() {
        contatoItem = (Contato) 
                selecionado.getRowData();
        dao.excluir(contatoItem);
        return "contato-list?faces-redirect=true";
    }
    
    public String limpar() {
        return "contato-list?faces-redirect=true";
    }
    
    public List<Contato> getContatos() {
        return dao.listarTodos();
    }
    
    public Contato getContatoItem() {
        return contatoItem;
    }

    public void setContatoItem(Contato contatoItem) {
        this.contatoItem = contatoItem;
    }

}
