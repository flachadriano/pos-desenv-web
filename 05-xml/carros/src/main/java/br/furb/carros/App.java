package br.furb.carros;

import java.io.File;
import java.io.IOException;

import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;
import javax.xml.bind.Unmarshaller;

import org.codehaus.jackson.JsonGenerationException;
import org.codehaus.jackson.map.AnnotationIntrospector;
import org.codehaus.jackson.map.JsonMappingException;
import org.codehaus.jackson.map.ObjectMapper;
import org.codehaus.jackson.xc.JaxbAnnotationIntrospector;

public class App {

	@SuppressWarnings("unchecked")
	public static void main(String[] args) {
		try {
			Carro carro1 = new Carro();
			carro1.setNome("Brasília");
			carro1.getMotoristas().add(new Motorista("João"));
			carro1.getMotoristas().add(new Motorista("Adriano"));

			JAXBContext context = JAXBContext.newInstance("br.furb.carros");

			System.out.println("XML Generated with JAXB");
			Marshaller mar = context.createMarshaller();
			mar.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, Boolean.TRUE);
			JAXBElement<Carro> element = new ObjectFactory().createCarro(carro1);
			mar.marshal(element, System.out);

			System.out.println("XML Read by JAXB");
			Unmarshaller unmar = context.createUnmarshaller();
			File file = new File("carros.xml");
			element = (JAXBElement<Carro>) unmar.unmarshal(file);
			Carro carro2 = element.getValue();
			System.out.println(carro2.toString());

			System.out.println("XML Generated with Jackson");
			ObjectMapper mapper = new ObjectMapper();
			AnnotationIntrospector intro = new JaxbAnnotationIntrospector();
			mapper.getDeserializationConfig().setAnnotationIntrospector(intro);
			mapper.getSerializationConfig().setAnnotationIntrospector(intro);
			mapper.writeValue(System.out, carro1);

			System.out.println("XML Read with Jackson");
			Carro carro = mapper.readValue(new File("carros.json"), Carro.class);
			System.out.println(carro.toString());

		} catch (JAXBException e) {
			e.printStackTrace();
		} catch (JsonGenerationException e) {
			e.printStackTrace();
		} catch (JsonMappingException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

}
