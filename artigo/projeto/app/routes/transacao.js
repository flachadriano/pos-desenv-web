module.exports = function(app) {
  var controller = app.controllers.transacao;

  app.route('/transacoes').
    get(controller.listar).
    post(controller.adicionar);

  app.route('/transacoes/:id').
    get(controller.obter).
    put(controller.atualizar).
    delete(controller.remover);

};
