var express = require('express');
var load = require('express-load');

module.exports = function() {
  var app = express();

  app.set('port', 3000);
  app.use(express.static('./public'));
  app.set('view engine', 'html');
  app.set('views', './app/views');

  load('models', {cwd: 'app'}).
    then('controllers').
    then('routes').
    into(app);

  return app;
};
