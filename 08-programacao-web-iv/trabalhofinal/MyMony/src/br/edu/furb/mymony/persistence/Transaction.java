package br.edu.furb.mymony.persistence;

import static java.lang.annotation.ElementType.TYPE;
import static java.lang.annotation.ElementType.METHOD;
import java.lang.annotation.Retention;
import static java.lang.annotation.RetentionPolicy.RUNTIME;
import java.lang.annotation.Target;
import javax.interceptor.InterceptorBinding;

@Target({ METHOD, TYPE })
@Retention(RUNTIME)
@InterceptorBinding
public @interface Transaction {
}
