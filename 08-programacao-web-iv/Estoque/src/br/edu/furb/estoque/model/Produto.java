package br.edu.furb.estoque.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

import lombok.Data;

@Entity
@Table(name = "produtos")
public @Data class Produto {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@Column(name = "codigo", nullable = false)
	private String codigo;

	@Column(name = "nome", nullable = false)
	private String nome;

	@ManyToOne
	@JoinColumn(name = "idcategoria", nullable = false)
	private CategoriaProduto categoriaProduto;

	@Column(name = "preco", nullable = false)
	private Double preco;

	@Column(name = "estoque", nullable = false)
	private Double estoque;

}
