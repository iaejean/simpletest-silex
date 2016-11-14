define(['app/common/logger'], function (Logger) {
    'use strict';
    var logger = Logger.getLogger('ProductService');

    return (function () {
        function ProductService($scope, $http) {
            this.$scope = $scope;
            this.$http = $http;
            logger.info('Starting service');
        }

        ProductService.prototype.findAll = function () {
            logger.info('GET: '  + '/product');
            var $scope = this.$scope;
            this.$http({
                method: 'GET',
                url: 'product'
            }).then(function (response) {
                $scope.products = response.data;
            });
        };

        ProductService.prototype.getStores = function (idProduct) {
            logger.info('GET: '  + '/product/' + idProduct + '/stores');
            var $scope = this.$scope;
            this.$http({
                method: 'GET',
                url: 'product/' + idProduct + '/stores'
            }).then(function (response) {
                $scope.otherStores = response.data;
            });
        };
        
        return ProductService;
    }());
});
