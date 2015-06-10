package edu.furb.mymony.model;

import javax.persistence.Entity;

@Entity
public class Category {

	private Long id;

	private String name;

	public void setId(Long id) {
		this.id = id;
	}

	public Long getId() {
		return id;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getName() {
		return name;
	}

}
