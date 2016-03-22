var mongoose = require('mongoose');
require('mongoose-double')(mongoose);
var SchemaTypes = mongoose.Schema.Types;

module.exports = function() {

  var schema = mongoose.Schema({
    categoria: {
      type: mongoose.Schema.ObjectId,
      ref: 'Categoria'
    },
    data: {
      type: SchemaTypes.Date,
      default: Date.now
    },
    valor: SchemaTypes.Double
  });

  return mongoose.model('Transacao', schema);
};
