module.exports = function(app) {
  var controller = app.controllers.categoria;

  app.route('/categorias').
    get(controller.listar).
    post(controller.adicionar);

  app.route('categorias/:id').
    get(controller.obter).
    put(controller.atualizar).
    delete(controller.deletar);

};
