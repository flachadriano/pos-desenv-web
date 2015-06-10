package edu.furb.mymony.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;

@Entity
public class Category {

	@Id
	@GeneratedValue
	private Long id;

	private String name;

	public void setName(String name) {
		this.name = name;
	}
	
	public String getName() {
		return name;
	}
	
}
