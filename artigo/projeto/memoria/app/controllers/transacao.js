var async = require('async');

module.exports = function(app) {
  var Transacao = app.models.transacao;
  var Orcamento = app.models.orcamento;
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
      function(transacao) {
        verificarOrcamento(transacao, res);
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
        verificarOrcamento(transacao, res);
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

  function verificarOrcamento(transacao, res) {
    async.parallel([
        // buscar orçamento
        function(callback) {
          Orcamento.findOne({
            categoria: transacao.categoria
          }).populate('categoria').exec(function(erro, orcamento) {
            if (erro)
              callback(erro);
            callback(null, orcamento);
          });
        },

        // buscar transações
        function(callback) {
          Transacao.find({
            categoria: transacao.categoria
          }).exec(function(erro, transacoes) {
            if (erro)
              callback(erro);
            callback(null, transacoes);
          });
        }
      ],

      // exibir resultados
      function(erros, resultados) {
        if (erros) {
          res.status(500).json(erros);
        } else {
          var orcamento = resultados[0];
          var valorOrcamento = parseFloat(orcamento.valor.value);
          var transacoes = resultados[1];
          var totalTransacoes = transacoes.reduce(function(somatorio, transacao) {
            return somatorio + parseFloat(transacao.valor.value);
          }, 0);

          var result = {transacao: transacao};
          if (totalTransacoes > valorOrcamento) {
            result.alerta = 'As transações para a categoria ' + orcamento.categoria.nome + ' estouraram o orçamento.';
          } else if (totalTransacoes > (valorOrcamento * 0.75)) {
            result.alerta = 'As transações para a categoria ' + orcamento.categoria.nome + ' alcançaram 75% do orçamento.';
          } else if (totalTransacoes > (valorOrcamento * 0.5)) {
            result.alerta = 'As transações para a categoria ' + orcamento.categoria.nome + ' totalizam mais da metade do orçamento.';
          }
          res.status(201).json(result);
        }
      });
  }

  return controller;
};
