Controle financeiro pessoal com VRaptor

Rodar o projeto:

1 importar no Eclipse
2 alterar o local do DB na constante DB da classe Server
3 executar maven install
4 criar um servidor Tomcat
5 adicionar a aplicação ao servidor
6 rodar a aplicação 

Comandos usados:
lsof -i :8009
kill -9 PID

Utilizado como base:
- https://pedrohosilva.wordpress.com/2015/01/01/aplicacao-web-com-vraptor-4-pt3/

Auxílio:
- http://www.vraptor.org/en/docs/dependencies-and-prerequisites/
- http://www.vraptor.org/en/docs/controllers-rest/
- https://bitbucket.org/xerial/sqlite-jdbc