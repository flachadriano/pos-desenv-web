module.exports = function(app) {
  app.get('/', app.controllers.categoria.index);
};
