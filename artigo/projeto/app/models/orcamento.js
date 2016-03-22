var mongoose = require('mongoose');

module.exports = function() {

  var schema = mongoose.Schema({
    categoria: {
      type: mongoose.Schema.ObjectId,
      ref: 'Categoria'
    },
    valor: {
      type: 'Number'
    }
  });

  return mongoose.model('Orcamento', schema);
};
