package edu.furb.catalogo.persistence;

import javax.inject.Inject;
import javax.interceptor.AroundInvoke;
import javax.interceptor.Interceptor;
import javax.interceptor.InvocationContext;
import javax.persistence.EntityManager;

@Interceptor @Transaction
public class TransactionInterceptor {
    
    @Inject
    private EntityManager em;
    
    @AroundInvoke
    public Object intercept(InvocationContext ctx) throws Exception {
        Object obj = null;
        try {
            em.getTransaction().begin();
            obj = ctx.proceed();
            em.getTransaction().commit();
        } catch (Exception ex) {
            em.getTransaction().rollback();
            throw ex;
        }
        return obj;
    }
    
}
