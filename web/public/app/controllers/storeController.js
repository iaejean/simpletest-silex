define(['angularAMD', 'app/common/logger', 'app/services/storeService'], function (angularAMD, Logger, StoreService) {
    'use strict';

    var StoreController = function ($scope, $http) {
        var logger = Logger.getLogger('StoreController');
        logger.info('Starting Controller');
        var storeService = new StoreService($scope, $http);
        storeService.findAll();
    };

    angularAMD.controller('storeController', ['$scope', '$http', StoreController]);
});
