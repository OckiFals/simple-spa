var app = angular.module('guthub',
    ['ngRoute', 'guthub.directives', 'guthub.services']
);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/', {
        controller: 'ListCtrl',
        templateUrl: 'views/bookList.html'
    }).when('/edit/:bookId', {
        controller: 'EditCtrl',
        templateUrl: 'views/bookForm.html'
    }).when('/view/:bookId', {
        controller: 'ViewCtrl',
        templateUrl: 'views/bookView.html'
    }).when('/new', {
        controller: 'NewCtrl',
        templateUrl: 'views/bookForm.html'
    }).otherwise({redirectTo: '/'});
}]);