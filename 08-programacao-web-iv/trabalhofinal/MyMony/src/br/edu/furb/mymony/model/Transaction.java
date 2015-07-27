package br.edu.furb.mymony.model;

import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.OneToMany;
import javax.persistence.Table;

import lombok.Data;

@Entity
@Table(name = "transactions")
public @Data class Transaction {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@OneToMany
	@JoinColumn(name = "categories")
	private List<Category> categories;

	@Column(name = "description")
	private String description;

	@Column(name = "amount", nullable = false)
	private Double amount;

}
