module.exports = function(app) {
  var Categoria = app.models.categoria;
  var controller = {};

  controller.listar = function(req, res) {
    Categoria.find().exec().then(
      function(categorias) {
        res.json(categorias);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.obter = function(req, res) {
    var _id = req.params.id;
    Categoria.findById(_id).exec().then(
      function(categoria) {
        if (!categoria) throw new Error('Categoria não encontrada.');
        res.json(categoria);
      },
      function(erro) {
        res.status(404).json(erro);
      }
    );
  };

  controller.adicionar = function(req, res) {
    Categoria.create(req.body).then(
      function(contato) {
        res.status(201).json(contato);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.atualizar = function(req, res) {
    var _id = req.params.id;
    Categoria.findByIdAndUpdate(_id, req.body).exec().then(
      function(categoria) {
        res.json(categoria);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.remover = function(req, res) {
    var _id = req.params.id;
    Categoria.remove({
      _id: _id
    }).exec().then(
      function() {
        res.end();
      },
      function(erro) {
        res.status(404).json(erro);
      }
    );
  };

  return controller;
};
