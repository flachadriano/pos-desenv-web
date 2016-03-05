angular.module('mymony', [ 'ngRoute' ]).config(function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl : 'app/categoria/form.html',
		controller : 'CategoriaController',
	});
});
