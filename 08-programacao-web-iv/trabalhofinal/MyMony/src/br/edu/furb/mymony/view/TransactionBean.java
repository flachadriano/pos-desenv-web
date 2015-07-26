package br.edu.furb.mymony.view;

import java.util.List;

import javax.enterprise.context.RequestScoped;
import javax.faces.component.UIData;
import javax.inject.Inject;
import javax.inject.Named;

import br.edu.furb.mymony.model.Transaction;
import br.edu.furb.mymony.persistence.ITransaction;
import br.edu.furb.mymony.persistence.TransactionDAO;

@Named
@RequestScoped
public class TransactionBean {

	@Inject
	private Transaction transaction;
	@Inject
	private TransactionDAO dao;

	private UIData selected = null;
	private boolean update = false;

	public UIData getSelectedItem() {
		return selected;
	}

	public void setSelectedItem(UIData selection) {
		this.selected = selection;
	}

	public boolean isUpdating() {
		return update;
	}

	public void setUpdating(boolean update) {
		this.update = update;
	}

	public String update() {
		transaction = (Transaction) selected.getRowData();
		update = true;
		return "transaction";
	}

	@ITransaction
	public String delete() {
		transaction = (Transaction) selected.getRowData();
		dao.delete(transaction);
		return "transactions?faces-redirect=true";
	}

	public String clean() {
		return "transactions?faces-redirect=true";
	}

	public List<Transaction> getTransactions() {
		return dao.all();
	}

	@ITransaction
	public String save() {
		if (update) {
			dao.update(transaction);
		} else {
			dao.add(transaction);
		}
		return "transactions?faces-redirect=true";
	}

	public Transaction getTransaction() {
		return transaction;
	}

	public void setCategory(Transaction transactionItem) {
		this.transaction = transactionItem;
	}

}
