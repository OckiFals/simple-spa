app.controller('ListCtrl', 
    function($scope, Books) {
        Books.query().success(function (data) {
            $scope.books = data
        })
    }
);

app.controller('ViewCtrl',
    function($scope, $routeParams, $location, Books) {
        Books.get($routeParams.bookId).success(function (data) {
            $scope.recipe = data;
        });
        $scope.edit = function() {
            $location.path('/edit/' + $scope.recipe.id);
        };
    }
);

app.controller('EditCtrl',
    function($scope, $routeParams, $location, Books) {
        Books.get($routeParams.bookId).success(function (data) {
            $scope.book = data;
        });
        $scope.save = function() {
            Books.save($scope.book).then(function() {
                $location.path('/');
            });
        };
        $scope.remove = function() {
            Books.delete($routeParams.bookId);
            $location.path('/');
        };
    }
);

app.controller('NewCtrl',
    function($scope, $location, Books) {
        $scope.is_new = true;
        $scope.book = {};
        $scope.save = function() {
            Books.save($scope.book).then(function() {
                $location.path('/');
            });
        };
    }
);