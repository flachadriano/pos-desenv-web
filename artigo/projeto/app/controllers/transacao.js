module.exports = function(app) {
  var Transacao = app.models.transacao;
  var controller = {};

  controller.listar = function(req, res) {
    Transacao.find().populate('categoria').exec().then(
      function(transacaos) {
        res.json(transacaos);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.obter = function(req, res) {
    var _id = req.params.id;
    Transacao.findById(_id).populate('categoria').exec().then(
      function(transacao) {
        if (!transacao) throw new Error('Transacao não encontrada.');
        res.json(transacao);
      },
      function(erro) {
        res.status(404).json(erro);
      }
    );
  };

  controller.adicionar = function(req, res) {
    Transacao.create(req.body).then(
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
    Transacao.findByIdAndUpdate(_id, req.body).exec().then(
      function(transacao) {
        res.json(transacao);
      },
      function(erro) {
        res.status(500).json(erro);
      }
    );
  };

  controller.remover = function(req, res) {
    var _id = req.params.id;
    Transacao.remove({
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
