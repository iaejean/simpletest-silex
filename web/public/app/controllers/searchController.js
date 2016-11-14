define([
    'angularAMD',
    'app/common/logger',
    'app/services/productService',
    'app/services/storeService'
], function (
    angularAMD,
    Logger,
    ProductService,
    StoreService
) {
    'use strict';

    var SearchController = function ($scope, $http) {
        var logger = Logger.getLogger('SearchController');
        logger.info('Starting Controller');

        var productService = new ProductService($scope, $http),
            storeService = new StoreService($scope, $http);

        productService.findAll();
        storeService.findAll();

        $scope.formError = false;
        $scope.purchaseFormError = false;
        $scope.store = null;
        $scope.product = null;
        $scope.productSelected = null;
        $scope.volume = null;
        $scope.otherStores = null;

        $scope.$watch('volume', function (val) {
            console.log(val);
            $scope.volume = val;
        });

        $scope.submit = function (form) {
            $scope.formError = form.$invalid;
            storeService.findProductById($scope.store.id, $scope.product.id);
        };

        $scope.purchase = function (form) {
            $scope.purchaseFormError = form.$invalid;
            storeService.purchase($scope.store.id, $scope.product.id, form.volume.$viewValue);
        };

        $scope.searchOtherStore = function () {
            productService.getStores($scope.product.id);
        };
    };

    angularAMD.controller('searchController', ['$scope', '$http', SearchController]);
});

