module.exports = function(app) {
  var Orcamento = app.models.orcamento;
  var controller = {};

  controller.listar = function(req, res) {
    Orcamento.find().populate('categoria').exec().then(
      function(orcamentos) {
        res.json(orcamentos);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.obter = function(req, res) {
    var _id = req.params.id;
    Orcamento.findById(_id).populate('categoria').exec().then(
      function(orcamento) {
        if (!orcamento) throw new Error('Orcamento não encontrada.');
        res.json(orcamento);
      },
      function(erro) {
        res.status(404).json(erro);
      }
    );
  };

  controller.adicionar = function(req, res) {
    Orcamento.create(req.body).then(
      function(orcamento) {
        res.status(201).json(orcamento);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.atualizar = function(req, res) {
    var _id = req.params.id;
    Orcamento.findByIdAndUpdate(_id, req.body).exec().then(
      function(orcamento) {
        res.json(orcamento);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.remover = function(req, res) {
    var _id = req.params.id;
    Orcamento.remove({
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
