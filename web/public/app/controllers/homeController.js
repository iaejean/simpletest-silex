define(['angularAMD', 'app/common/logger'], function (angularAMD, Logger) {
    'use strict';

    var HomeController = function () {
        var logger = Logger.getLogger('HomeController');
        logger.info('Starting Controller');
    };

    angularAMD.controller('homeController', [HomeController]);
});
