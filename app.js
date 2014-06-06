// initialize the app
angular.module('myapp', ['ngSanitize', 'simplePagination'])
  .run(['$rootScope', function($rootScope){
    //set the initial configuration
    //created by wp_localize_script() in functions.php, and stored in the Angular rootScope
    $rootScope.api = AppAPI.url;
  }])
  .controller('mycontroller', ['$scope', '$http', 'Pagination', function($scope, $http, Pagination) {

    // load posts from the WordPress API
    $http({
      method: 'GET',
      url: $scope.api,
      params: {
        json: 'get_posts'
      }
    }).success(function(data) {
      $scope.posts = data.posts;
      $scope.pagination = Pagination.getNew(3);
      $scope.pagination.numPages = Math.ceil($scope.posts.length/$scope.pagination.perPage);
    });

    // load categories from the WordPress API
    $http({
      method: 'GET',
      url: $scope.api,
      params: {
        json: 'get_category_index'
      }
    }).success(function(data) {
      $scope.categories = data.categories;
    });

    //popup content
    $scope.detailpost = function(post){
      $scope.openpopup = true;
      $scope.post = post;
    };

    $scope.closedetail = function(){
      $scope.openpopup = false;
    }

  }]);