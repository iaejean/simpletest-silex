define(['app/common/logger'], function (Logger) {
    'use strict';
    var logger = Logger.getLogger('StoreService');

    return (function () {
        function StoreService($scope, $http) {
            this.$scope = $scope;
            this.$http = $http;
            logger.info('Starting service');
        }

        StoreService.prototype.findAll = function () {
            logger.info('GET: '  + '/store');
            var $scope = this.$scope;
            this.$http({
                method: 'GET',
                url: 'store'
            }).then(function (response) {
                $scope.stores = response.data;
            });
        };

        StoreService.prototype.findProductById = function (idStore, idProduct) {
            logger.info('GET: '  + '/store/' + idStore + '/product/' + idProduct);
            var $scope = this.$scope;
            this.$http({
                method: 'GET',
                url: 'store/' + idStore + '/product/' + idProduct
            }).then(function (response) {
                if (response.status !== 200) {
                    return $scope.productSelected = false;
                }
                return $scope.productSelected = response.data;
            });
        };
        
        StoreService.prototype.purchase = function (idStore, idProduct, amount) {
            logger.info('PUT: /store/purchase');
            var $scope = this.$scope;
            this.$http({
                method: 'PUT',
                url: 'store/purchase/',
                data: JSON.stringify({
                    storeProduct: {
                        idStore: idStore,
                        idProduct: idProduct
                    },
                    amount: amount
                })
            }).then(function (response) {
                alert('There are ' + response.data + ' of this item in stock availables in the store');
            });
        };

        return StoreService;
    }());
});
