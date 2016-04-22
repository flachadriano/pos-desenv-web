var mongoose = require('mongoose');

module.exports = function() {
  var schema = mongoose.Schema({
    data: Date,
    valor: Number,
    descricao: String
  });

  return mongoose.model('Transacao', schema);
};
