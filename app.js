// initialize the app
var myapp = angular.module('myapp', ['ngSanitize', 'simplePagination']);
 
// set the configuration
myapp.run(['$rootScope', function($rootScope){
  // the following data is fetched from the JavaScript variables created by wp_localize_script(), and stored in the Angular rootScope
  $rootScope.dir = BlogInfo.url;
  $rootScope.site = BlogInfo.site;
  $rootScope.api = AppAPI.url;
}]);
 
// add a controller
myapp.controller('mycontroller', ['$scope', '$http', 'Pagination', function($scope, $http, Pagination) {


  // load posts from the WordPress API
  $http({
    method: 'GET',
    url: $scope.api, // derived from the rootScope
    params: {
      json: 'get_posts'
    }
  }).success(function(data, status, headers, config) {
    console.log(data.posts);
    $scope.postdata = data.posts;
    $scope.pagination = Pagination.getNew(3);
    $scope.pagination.numPages = Math.ceil($scope.postdata.length/$scope.pagination.perPage);
  }).error(function(data, status, headers, config) {
  });

  // load categories from the WordPress API
  $http({
    method: 'GET',
    url: $scope.api, // derived from the rootScope
    params: {
      json: 'get_category_index'
    }
  }).success(function(data, status, headers, config) {
    $scope.categorydata = data.categories;
  }).error(function(data, status, headers, config) {
  });

}]);