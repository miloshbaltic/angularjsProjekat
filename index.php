<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.js"></script>
		<script src="jsontest.js"></script>

		<script>
			var app1 = angular.module('Cdm', ['ngRoute']);
			app1.controller('kontroler', function($scope, $http){
				$http.get('articles.json')
				.success(function(response) {
					$scope.articles = response;
				}).error(function(response){
					console.log("greska");
				});
			});		

			app1.config(["$routeProvider", function($routeProvider){
				$routeProvider
					.when('/categories', {
						templateUrl: 'categories.html',
						controller: 'categoriesController'
					})

					.when('/articles/:id', {
						templateUrl: 'article.html',
						controller: 'clanakController'
					})					
					
			}]);

			var a = "";
			for (var i = 0; i < json1.length; i++) {
				a = a + json1[i].name + " ";
			};
			
			app1.controller('mainController', function($scope){
				$scope.message = 'Main controller!';				
			});

			app1.controller('categoriesController', function($scope, $http){
				$http.get('categories.json')
				.success(function(response) {
					$scope.categories = response;
				}).error(function(response){
					console.log("greska");
				});				
			});

			app1.controller('clanakController', function($scope, $http, $sce){
				$http.get('clanak.json')
				.success(function(response) {
					$scope.article = response;
   				    $scope.trusted = $sce.trustAsHtml($scope.article);
				}).error(function(response){
					console.log("greska");
				});			
			});			
		</script>
	</head>

	<body>
		<h1>Naslovi:</h1>
		<div ng-app="Cdm" ng-controller="kontroler">
			<div ng-view>
				
			</div>
			<ul ng-repeat="article in articles">
				<a href = "/#/articles/{{article.id}}"><li>{{article.title}}</li></a>
			</ul>

			<h3><a href="/#/categories">Kategorije</a></h3>
		</div>
	</body>
</html>