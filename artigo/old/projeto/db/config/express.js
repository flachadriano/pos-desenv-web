var express = require('express');
var load = require('express-load');
var bodyParser = require('body-parser');

module.exports = function() {
  var app = express();

  app.set('port', 3000);

  app.use(bodyParser.urlencoded({extended: true}));
  app.use(bodyParser.json());

  load('models', {cwd: 'app'}).
    then('controllers').
    then('routes').
    into(app);

  return app;
};
