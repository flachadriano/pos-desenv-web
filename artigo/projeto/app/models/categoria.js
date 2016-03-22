var mongoose = require('mongoose');
var SchemaTypes = mongoose.Schema.Types;

module.exports = function() {

  var schema = mongoose.Schema({
    nome: {
      type: SchemaTypes.String,
      required: true,
      index: {
        unique: true
      }
    }
  });

  return mongoose.model('Categoria', schema);
};
