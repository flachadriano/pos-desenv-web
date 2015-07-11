package edu.furb.catalogo.view.converter;

import edu.furb.catalogo.model.Categoria;
import edu.furb.catalogo.persistence.CategoriaDAO;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;
import javax.faces.convert.FacesConverter;

@FacesConverter(forClass = Categoria.class)
public class CategoriaConverter implements Converter {

    private CategoriaDAO dao = new CategoriaDAO();
    
    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        return dao.buscar(Integer.parseInt(value));
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        Categoria cat = (Categoria)value;
        return String.valueOf(cat.getCodigo());
    }
    
}
