Listar categorias: curl localhost:3000/categorias
Buscar categoria: curl localhost:3000/categorias/1
Criar categoria: curl --data "nome=Outro" localhost:3000/categorias
Atualizar categoria: curl --data "_id=1&nome=Alterado" localhost:3000/categorias
