Listar categorias:
curl localhost:3000/categorias

Buscar categoria:
curl localhost:3000/categorias/56f1b243f322602d0cc4de13

Criar categoria:
curl -X POST --data "nome=Outro" localhost:3000/categorias

Atualizar categoria:
curl -X PUT --data "nome=Alterado" localhost:3000/categorias/56f1b243f322602d0cc4de13
