package edu.furb.catalogo.persistence;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;

public class JpaUtils {

    private static EntityManagerFactory emf = null;
    
    public static EntityManager getEm() {
        if (emf == null) {
            emf = Persistence.createEntityManagerFactory("catalogo");
        }
        return emf.createEntityManager();
    }
    
    public static void close() {
        if (emf != null && emf.isOpen()) {
            //emf.close();
        }
    }
    
}
