var express = require('express');
var bodyParser = require('body-parser');
var mongoose = require('mongoose');

var app = express();
app.set('port', process.env.PORT || 3000);
app.use(bodyParser.urlencoded({
  extended: true
}));
app.use(bodyParser.json());
mongoose.connect('mongodb://localhost/mymony');
var Transacao = require('./models/transacao')();

app.get('/', function(req, res) {
  Transacao.find().exec().then(
    function(transacoes) {
      res.json(transacoes);
    },
    function(erro) {
      res.status(500).json(erro);
    }
  );
});

app.post('/criar', function(req, res) {
  Transacao.create(req.body).then(
    function success(transacao) {
      res.json(transacao);
    },
    function(erro) {
      res.status(500).json(erro);
    }
  );
});

app.use(function(req, res) {
  res.type('text/plain');
  res.status(404);
  res.send('Não encontrado');
});

app.listen(app.get('port'), function() {
  console.log('Express iniciado em http://localhost:' + app.get('port'));
});
