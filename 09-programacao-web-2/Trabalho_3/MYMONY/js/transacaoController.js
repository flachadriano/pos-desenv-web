<<<<<<< Updated upstream
=======
<<<<<<< HEAD
var app = angular.module('mymony', []);
app.controller('TransacaoController', function ($scope, $http) {
	$scope.transacoes = [];
	$scope.categoriasDescricao = [];
	$scope.search = "";
	$scope.order = "descricao";
	$scope.modoEdicao = false;
	$scope.transacao = [];

	$http.post('wrapper.php', {
		class: 'Transacao',
		method: 'ListAll'
	})
	.then(function(response) {
		console.log(response.data);
		$scope.transacoes = response.data;
	}, function(response) {
		//erro
	});

	$http.post('wrapper.php', {
		class: 'Categoria',
		method: 'ListAll'
	})
	.then(function(response) {
		response.data.forEach( function( item ) {
		    $scope.categoriasDescricao.push({id: item.id, descricao: item.descricao});
		    });
	  }, function(response) {
		  //erro
	});

	$scope.getDescricaoCategoria = function(categoriaTransacaoId){
		var cat = $scope.categoriasDescricao.filter(function(a){ return a.id == categoriaTransacaoId; })[0];
		if(cat !== undefined){
			return cat.descricao;
		}
	};

	$scope.converteData = function(data){
		var dt = data.split("-");
		return new Date(dt[0],dt[1],dt[2]);
	};

	$scope.editar = function() {
		$scope.modoEdicao = true;
	};

	$scope.excluir = function(transacao) {
		if (confirm('Deseja mesmo excluir a transação "' + transacao.descricao + '"?') === true) {
			$http.post('wrapper.php', {
				class: 'Transacao',
				method: 'Delete',
				params: transacao
			})
			.then(function(response) {
				location.reload();
			}, function(response) {
				//erro
			});
		}
	};

	$scope.toggleMode = function(transacao) {
		$scope.modoEdicao = !$scope.modoEdicao;
		$scope.transacaoEdicao = transacao;
	};

	$scope.salvar = function(transacao) {
		$http.post('wrapper.php', {
			class: 'Transacao',
			method: transacao.id > 0 ? 'Update' : 'Insert',
			params: transacao
		})
		.then(function(response) {
			location.reload();
			$scope.toggleMode([]);
		}, function(response) {
			//erro
		});
	};
});
=======
>>>>>>> Stashed changes
var app = angular.module('mymony', []);
app.controller('TransacaoController', function ($scope, $http) {
	$scope.transacoes = [];
	$scope.categoriasDescricao = [];
	$scope.search = "";
	$scope.order = "descricao";
	$scope.modoEdicao = false;
	$scope.transacao = [];

	$http.post('wrapper.php', {
		class: 'Transacao',
		method: 'ListAll'
	})
	.then(function(response) {
		console.log(response.data);
		$scope.transacoes = response.data;
	}, function(response) {
		//erro
	});

	$http.post('wrapper.php', {
		class: 'Categoria',
		method: 'ListAll'
	})
	.then(function(response) {
		response.data.forEach( function( item ) {
		    $scope.categoriasDescricao.push({id: item.id, descricao: item.descricao});
		    });
	  }, function(response) {
		  //erro
	});

	$scope.getDescricaoCategoria = function(categoriaTransacaoId){
		var cat = $scope.categoriasDescricao.filter(function(a){ return a.id == categoriaTransacaoId; })[0];
		if(cat !== undefined){
			return cat.descricao;
		}
	};

	$scope.converteData = function(data){
		var dt = data.split("-");
		return new Date(dt[0],dt[1],dt[2]);
	};

	$scope.editar = function() {
		$scope.modoEdicao = true;
	};

	$scope.excluir = function(transacao) {
		if (confirm('Deseja mesmo excluir a transação "' + transacao.descricao + '"?') === true) {
			$http.post('wrapper.php', {
				class: 'Transacao',
				method: 'Delete',
				params: transacao
			})
			.then(function(response) {
				location.reload();
			}, function(response) {
				//erro
			});
		}
	};

	$scope.toggleMode = function(transacao) {
		$scope.modoEdicao = !$scope.modoEdicao;
		$scope.transacaoEdicao = transacao;
	};

	$scope.salvar = function(transacao) {
		$http.post('wrapper.php', {
			class: 'Transacao',
			method: transacao.id > 0 ? 'Update' : 'Insert',
			params: transacao
		})
		.then(function(response) {
			location.reload();
			$scope.toggleMode([]);
		}, function(response) {
			//erro
		});
	};
});
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
