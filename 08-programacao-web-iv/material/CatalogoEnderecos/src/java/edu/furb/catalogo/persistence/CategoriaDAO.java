package edu.furb.catalogo.persistence;

import edu.furb.catalogo.model.Categoria;
import java.util.ArrayList;
import java.util.List;

public class CategoriaDAO {
    
    private static final List<Categoria>
            registros = new ArrayList<>();
    
    public void inserir(Categoria categoria) {
        registros.add(categoria);
    }
    
    public void alterar(Categoria categoria) {
        int registro = -1;
        for (int i = 0; i < registros.size(); i++) {
            if (registros.get(i).getCodigo() ==
                    categoria.getCodigo()){
                registro = i;
            }
        }
        registros.remove(registro);
        registros.add(registro, categoria);
    }
    
    public void excluir(Categoria categoria) {
        int registro = -1;
        for (int i = 0; i < registros.size(); i++) {
            if (registros.get(i).getCodigo() ==
                    categoria.getCodigo()){
                registro = i;
            }
        }
        registros.remove(registro);
    }
    
    public List<Categoria> listarTodos() {
        return registros;
    }
}
