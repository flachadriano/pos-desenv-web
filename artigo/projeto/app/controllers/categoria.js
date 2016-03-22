module.exports = function() {
  var controller = {};

  controller.index = function(req, res) {
    res.json([{"teste": "teste"}]);
  };

  return controller;
};
