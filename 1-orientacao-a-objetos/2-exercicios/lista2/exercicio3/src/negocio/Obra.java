package negocio;

public class Obra {

	private String titulo;
	private String autor;
	private Parecer[] pareceres = new Parecer[3];
	private int indexParecer = 0;

	public Obra(String titulo, String autor) {
		this.setTitulo(titulo);
		this.setAutor(autor);
	}

	public String exibirDados() {
		String dados = "Título: "+this.titulo+
				"\nAutor: "+this.autor+
				"\nPareceres: "+this.getQtdePareceres();
		
		for (int i = 0; i < this.getQtdeMaxPareceres(); i++) {
			Parecer parecer = this.pareceres[i];
			
			dados += "\nParecer: "+i+" de "+parecer.getNomeParecerista()+
					"\nEmitido em "+parecer.getData()+
					"\nConteúdo: "+parecer.getConteudo();
		}
		
		return dados;
	}
	
	public void addParecer(Parecer p) {
		if (this.indexParecer < this.getQtdeMaxPareceres()) {
			this.pareceres[this.indexParecer] = p;
			this.indexParecer++;
		}
	}

	public int getQtdePareceres() {
		return this.indexParecer;
	}

	public int getQtdeMaxPareceres() {
		return 3;
	}
	
	public String getTitulo() {
		return titulo;
	}

	public void setTitulo(String titulo) {
		if (titulo != null && !titulo.isEmpty())
			this.titulo = titulo;
	}

	public String getAutor() {
		return autor;
	}

	public void setAutor(String autor) {
		this.autor = autor;
	}

}
