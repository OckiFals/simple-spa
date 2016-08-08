var services = angular.module('guthub.services', ['ngResource']);

services.factory('Books', ['$http',
    function ($http) {
        var baseurl = 'api/books';

        return {
            get: function(bookId) {
                return $http.get(baseurl + '/' + bookId);
            },
            save: function(book) {
                var url = book.id ? baseurl + '/' + book.id : baseurl;
                return $http.post(url, book);
            },
            query: function () {
                return $http.get(baseurl);
            },
            delete: function(bookId) {
                return $http.delete(baseurl + '/' + bookId);
            }
        } 
    }]
);