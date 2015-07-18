package edu.furb.catalogo.model;

import java.util.Objects;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "categorias")
public class Categoria {

    @Id
    @GeneratedValue
    @Column(name="idcategoria")
    private int codigo;
    @Column(name="nmcategoria", nullable = false)
    private String nome;

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 17 * hash + this.codigo;
        hash = 17 * hash + Objects.hashCode(this.nome);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Categoria other = (Categoria) obj;
        if (this.codigo != other.codigo) {
            return false;
        }
        if (!Objects.equals(this.nome, other.nome)) {
            return false;
        }
        return true;
    }

}
