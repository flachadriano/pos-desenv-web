module.exports = function(app) {
  var controller = app.controllers.orcamento;

  app.route('/orcamentos').
    get(controller.listar).
    post(controller.adicionar);

  app.route('/orcamentos/:id').
    get(controller.obter).
    put(controller.atualizar).
    delete(controller.remover);

};
