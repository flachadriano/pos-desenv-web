package br.edu.furb.estoque.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "categorias")
public class CategoriaProduto {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@Column(name = "nome", nullable = false)
	private String nome;

}
