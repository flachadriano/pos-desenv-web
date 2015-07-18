package edu.furb.catalogo.model;

import java.util.Objects;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Transient;

@Entity
@Table(name="contatos")
public class Contato {

    @Id
    @GeneratedValue
    @Column(name="idcontato")
    private int codigo;
    @Column(name="nmcontato")
    private String nome;
    @Column(name="nmtelefone")
    private String telefone;
    @Column(name="dsemail")
    private String email;
    @ManyToOne
    @JoinColumn(name="idcategoria", nullable=false)
    private Categoria categoria;

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

    public String getTelefone() {
        return telefone;
    }

    public void setTelefone(String telefone) {
        this.telefone = telefone;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public Categoria getCategoria() {
        return categoria;
    }

    public void setCategoria(Categoria categoria) {
        this.categoria = categoria;
    }

    @Override
    public int hashCode() {
        int hash = 5;
        hash = 19 * hash + this.codigo;
        hash = 19 * hash + Objects.hashCode(this.nome);
        hash = 19 * hash + Objects.hashCode(this.telefone);
        hash = 19 * hash + Objects.hashCode(this.email);
        hash = 19 * hash + Objects.hashCode(this.categoria);
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
        final Contato other = (Contato) obj;
        if (this.codigo != other.codigo) {
            return false;
        }
        if (!Objects.equals(this.nome, other.nome)) {
            return false;
        }
        if (!Objects.equals(this.telefone, other.telefone)) {
            return false;
        }
        if (!Objects.equals(this.email, other.email)) {
            return false;
        }
        if (!Objects.equals(this.categoria, other.categoria)) {
            return false;
        }
        return true;
    }


}
