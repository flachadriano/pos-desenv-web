package edu.furb.catalogo.view.converter;

import edu.furb.catalogo.model.Categoria;
import edu.furb.catalogo.persistence.CategoriaDAO;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;
import javax.inject.Inject;
import javax.inject.Named;

@Named
public class CategoriaConverter implements Converter {

    @Inject
    private CategoriaDAO dao;

    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        return dao.buscar(Integer.parseInt(value));
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        Categoria cat = (Categoria) value;
        if (cat == null) {
            return "";
        }
        return String.valueOf(cat.getCodigo());
    }

}
