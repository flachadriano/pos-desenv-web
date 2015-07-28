package br.edu.furb.mymony.view;

import javax.enterprise.context.RequestScoped;
import javax.inject.Named;

@Named
@RequestScoped
public class ReportBean {

	public String getData() {
		return "o/";
	}

}
