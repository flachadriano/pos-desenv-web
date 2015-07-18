package br.edu.furb.mymony.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

import lombok.Data;

@Entity
@Table(name = "categories")
public @Data class Category {

	@Id
	@GeneratedValue
	@Column(name = "id")
	private int id;

	@Column(name = "name", nullable = false)
	private String name;

}
