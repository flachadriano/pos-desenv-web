module.exports = function(app) {
  var categorias = [{
    _id: 1,
    nome: 'Comida'
  }, {
    _id: 2,
    nome: 'Roupa'
  }];
  var controller = {};

  controller.listar = function(req, res) {
    res.json(categorias);
  };

  controller.obter = function(req, res) {
    var _id = req.params.id;
    var categoria = categorias.filter(function(categoria) {
      return categoria._id == _id;
    })[0];
    res.json(categoria);
  };

  controller.adicionar = function(req, res) {
    var categoria = req.body;
    categorias.push(categoria);
    res.status(201).json(categoria);
  };

  controller.atualizar = function(req, res) {
    var _id = req.params.id;
    var categoriaAlterada = req.body;
    categorias = categorias.map(function(categoria) {
      if (categoria._id == _id)
        categoria = categoriaAlterada;
      return categoria;
    });
    res.json(categoriaAlterada);
  };

  controller.remover = function(req, res) {
    var _id = req.params.id;
    categorias = categorias.filter(function(categoria) {
      return categoria._id != _id;
    });
    res.status(204).end();
  };

  return controller;
};
