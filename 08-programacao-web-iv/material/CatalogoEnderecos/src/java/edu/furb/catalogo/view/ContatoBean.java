package edu.furb.catalogo.view;

import edu.furb.catalogo.model.Contato;
import javax.faces.bean.ManagedBean;

@ManagedBean
public class ContatoBean {

    private Contato contatoItem = 
                new Contato();

    public Contato getContatoItem() {
        return contatoItem;
    }

    public void setContatoItem(Contato contatoItem) {
        this.contatoItem = contatoItem;
    }

}
