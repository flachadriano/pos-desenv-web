## Categoria

Listar categorias:
curl localhost:3000/categorias

Criar categoria:
curl -X POST --data "nome=Outro" localhost:3000/categorias

Buscar categoria:
curl localhost:3000/categorias/56f1b243f322602d0cc4de13

Atualizar categoria:
curl -X PUT --data "nome=Alterado" localhost:3000/categorias/56f1b243f322602d0cc4de13

Deletar categoria:
curl -X DELETE localhost:3000/categorias/56f1b243f322602d0cc4de13

## Orçamento

Listar orçamentos:
curl localhost:3000/orcamentos

Criar orçamento:
curl -X POST --data "categoria=56f1b243f322602d0cc4de13&valor=123.45" localhost:3000/orcamentos

Buscar orçamento:
curl localhost:3000/orcamentos/56f1b6b9b8e8e7d10c2ffcf6

Atualizar orçamento:
curl -X PUT --data "categoria=56f1b2dcf322602d0cc4de14" localhost:3000/orcamentos/56f1b6b9b8e8e7d10c2ffcf6

Deletar orçamento:
curl -X DELETE localhost:3000/orcamentos/56f1b6b9b8e8e7d10c2ffcf6
