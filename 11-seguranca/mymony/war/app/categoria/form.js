angular.module('mymony').controller('CategoriaController', controller);
controller.$inject = ['$scope', 'CategoriaService'];

function controller($scope, CategoriaService) {
	$scope.service = CategoriaService;
	$scope.service.setResource('categoria');

	$scope.onCreateForm = function(form, data) {
		$scope.service.create(data);
	};

	$scope.onGetForm = function(form, data) {
		$scope.service.get(data.login);
	};

	$scope.onPutForm = function(form, data) {
		data.id = true;
		$scope.service.create(data);
	};
}
