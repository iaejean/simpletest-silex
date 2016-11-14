define(['angularAMD', 'app/common/logger'], function (angularAMD, Logger) {
    'use strict';

    var HeaderController = function () {
        var logger = Logger.getLogger('HeaderController');
        logger.info('Starting Controller');
    };

    angularAMD.controller('headerController', [HeaderController]);
});
