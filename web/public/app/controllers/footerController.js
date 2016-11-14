define(['angularAMD', 'app/common/logger'], function (angularAMD, Logger) {
    'use strict';

    var FooterController = function ($scope) {
        var logger = Logger.getLogger('FooterController');
        logger.info('Starting Controller');
        $scope.currentYear = (new Date()).getFullYear();
    };

    angularAMD.controller('footerController', ['$scope', FooterController]);
});
