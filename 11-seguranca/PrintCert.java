package certificados;


import javax.crypto.Cipher;
import javax.security.cert.*;
import java.io.*;

public class PrintCert {
    
	public static void main(String args[]) {
            
		try {
                    //cria o input para o arquivo do certificado
                    FileInputStream fr = new FileInputStream("cert-posweb.cer");
                    
                    //cria a inst�ncia do certificado
                    X509Certificate c = X509Certificate.getInstance(fr);
                    
                    //sa�das da leitura do certificado
                    System.out.println("Dados do certificado lido: ");
                    System.out.println("\tCertificado para (SubjectDN): " + c.getSubjectDN());
                    System.out.println("\tAutoridade certificadora: " + c.getIssuerDN());
                    System.out.println("\tValidade de " +
                                            c.getNotBefore() + " para " + c.getNotAfter());
                    System.out.println("\tCertificate SN# " + c.getSerialNumber());
                    System.out.println("\tGenerated with " + c.getSigAlgName());
                    System.out.println("\tChave Publica " + c.getPublicKey());

                    //Verifica��o do certificado                     
                    //Neste caso, auto assinado
                    c.verify(c.getPublicKey());

                    //Verifica a validade
                     c.checkValidity();
                       
                     //cifrar com a chave p�blica
                     Cipher cifra = Cipher.getInstance("RSA");  
               
                     // Criptografa a mensagem com a chave p�blica  
                     // inicializa o algoritmo para a criptografia  
                     cifra.init(Cipher.ENCRYPT_MODE, c.getPublicKey());  

                     // criptgrafia o texto inteiro  
                     byte[] mensagemCifrada = cifra.doFinal("mensagem".getBytes());  

                     //Decifraria a mensagem se fivesse a chave privada neste ponto
                   //  cifra.init(Cipher.DECRYPT_MODE,c.getPrivate());  
                     //byte[] mensagemOriginal = cifra.doFinal(mensagemCifrada);  

                     System.out.println("Chave Publica: "+c.getPublicKey());  
                     //System.out.println("Chave Privada: "+chaves.getPrivate().toString());  

                     System.out.println("A mensagem cifrada fica: ");  
                     System.out.println(new String(mensagemCifrada));  
                     System.out.println("A mensagem original era: ?");  
                     //System.out.println(new String(mensagemOriginal));                         

		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
