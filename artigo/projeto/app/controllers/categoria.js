module.exports = function() {
  var controller = {};
  var ID_CONTATO_INC = 1;
  var categorias = [{
    _id: 1,
    nome: "Teste"
  }];

  controller.listar = function(req, res) {
    res.json(categorias);
  };

  controller.obter = function(req, res) {
    var idCategoria = req.params.id;
    var categoria = categorias.filter(function(categoria) {
      return categoria._id == idCategoria;
    })[0];

    categoria ? res.json(categoria) : res.status(404).send('Categoria não encontrada.');
  };

  controller.adicionar = function(req, res) {
    var categoria = req.body;
    categoria._id = ++ID_CONTATO_INC;
    categorias.push(categoria);
    res.json(categoria);
  };

  controller.atualizar = function(req, res) {
    var categoriaAlterada = req.body;
    categoriaAlterada._id = req.params.id;
    categorias = categorias.map(function(categoria) {
      if (categoria._id == categoriaAlterada._id) {
        categoria = categoriaAlterada;
      }
      return categoria;
    });
    res.json(categoriaAlterada);
  };

  controller.remover = function(req, res) {
    var idCategoria = req.params.id;
    categorias = categorias.filter(function(categoria) {
      return categoria._id != idCategoria;
    });
    res.send(204).end();
  }

  return controller;
};
