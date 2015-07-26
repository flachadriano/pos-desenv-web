package br.edu.furb.mymony.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

import lombok.Data;

@Entity
@Table(name = "transactions")
public @Data class Transaction {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@Column(name = "categories")
	private String categories;

	@Column(name = "description")
	private String description;

	@Column(name = "amount", nullable = false)
	private Double amount;

}
