var app = angular.module('mymony', []);

app.controller('CategoriaController', function ($scope, $http) {
	$scope.categorias = [];
	$scope.search = "";
	$scope.order = "descricao";
	$scope.modoEdicao = false;
	$scope.categoriaEdicao = [];

	$http.post('wrapper.php', {
		class: 'Categoria',
		method: 'ListAll'
	})
	.then(function(response) {
		$scope.categorias = response.data;
	}, function(response) {
		//erro
	});

	$scope.excluir = function(categoria) {
		if (confirm('Deseja mesmo excluir a categoria "' + categoria.descricao + '"?') === true) {
			$http.post('wrapper.php', {
				class: 'Categoria',
				method: 'Delete',
				params: categoria
			})
			.then(function(response) {
				location.reload();
			}, function(response) {
				//erro
			});
		}
	};

	$scope.toggleMode = function(categoria) {
		$scope.modoEdicao = !$scope.modoEdicao;
		$scope.categoriaEdicao = categoria;
	};

	$scope.salvar = function(categoria) {
		$http.post('wrapper.php', {
			class: 'Categoria',
<<<<<<< Updated upstream
			method: categoria.id > 0 ? 'Update' : 'Insert',
=======
<<<<<<< HEAD
			method: categoria.id > 0 ? 'Update' : 'createEntity',
=======
			method: categoria.id > 0 ? 'Update' : 'Insert',
>>>>>>> origin/master
>>>>>>> Stashed changes
			params: categoria
		})
		.then(function(response) {
			location.reload();
			$scope.toggleMode([]);
		}, function(response) {
			//erro
		});
	};
});
