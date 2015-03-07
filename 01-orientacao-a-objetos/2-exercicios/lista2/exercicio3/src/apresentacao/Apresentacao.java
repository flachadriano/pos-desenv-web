package apresentacao;

import java.awt.Dimension;
import java.awt.GridLayout;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.SwingConstants;

import negocio.Obra;

@SuppressWarnings("serial")
public class Apresentacao extends JFrame {

	private ArrayList<Obra> obras = new ArrayList<Obra>();

	private JTextField titulo = new JTextField(44);
	private JTextField autor = new JTextField(34);
	private JButton cadastrarObra = new JButton("Cadastrar");
	private JTextField data = new JTextField(44);
	private JTextField nomeParecista = new JTextField(44);
	private JTextField conteudo = new JTextField(34);
	private JButton cadastrarParecer = new JButton("Cadastrar");

	public Apresentacao() {
		setSize(600, 300);

		setLayout(new GridLayout(3, 1));

		JPanel obra = new JPanel();

		JLabel obraTitulo = new JLabel("Obra", SwingConstants.CENTER);
		obraTitulo.setPreferredSize(new Dimension(590, 20));
		obra.add(obraTitulo);

		obra.add(new JLabel("Título"));
		obra.add(titulo);
		obra.add(new JLabel("Autor"));
		obra.add(autor);
		obra.add(cadastrarObra);

		this.add(obra);

		cadastrarObra.addMouseListener(new MouseListener() {
			public void mouseClicked(MouseEvent e) {
			}

			public void mousePressed(MouseEvent e) {
			}

			public void mouseReleased(MouseEvent e) {
			}

			public void mouseExited(MouseEvent e) {
			}

			public void mouseEntered(MouseEvent e) {
				cadastrarObra();
			}
		});

		JPanel parecer = new JPanel();

		JLabel parecerTitulo = new JLabel("Parecer", SwingConstants.CENTER);
		parecerTitulo.setPreferredSize(new Dimension(590, 20));
		parecer.add(parecerTitulo);

		obra.add(new JLabel("Data"));
		obra.add(titulo);
		obra.add(new JLabel("Parecista"));
		obra.add(autor);
		obra.add(new JLabel("Conteúdo"));
		obra.add(cadastrarObra);

		this.add(parecer);
	}

	public void cadastrarObra() {
		obras.add(new Obra(titulo.getText(), autor.getText()));
	}

	public static void main(String[] args) {
		Apresentacao app = new Apresentacao();
		app.setVisible(true);
	}

}
