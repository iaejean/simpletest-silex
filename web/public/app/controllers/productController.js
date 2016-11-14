define([
    'angularAMD',
    'app/common/logger',
    'app/services/productService'
], function (
    angularAMD,
    Logger,
    ProductService
) {
    'use strict';

    var ProductController = function ($scope, $http) {
        var logger = Logger.getLogger('ProductController');
        logger.info('Starting Controller');
        var productService = new ProductService($scope, $http);
        productService.findAll();
    };

    angularAMD.controller('productController', ['$scope', '$http', ProductController]);
});
