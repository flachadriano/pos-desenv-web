package br.edu.furb.estoque.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

import lombok.Data;

@Entity
@Table(name = "categorias_produtos")
public @Data class CategoriaProduto {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@Column(name = "nome", nullable = false)
	private String nome;

}
