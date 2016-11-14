require([
        'app/common',
        'app/common/logger',
        'app/controllers/headerController',
        'app/controllers/footerController',
        'moment'
    ],
    function (angularAMD, Logger, HeaderController, FooterController, moment) {
        'use strict';

        var logger, app;

        // Loading plugins
        app = angular.module('app', [
            'ui.router',
            'ngResource',
            'ui.bootstrap',
            'ngAnimate',
            'ngSanitize',
            'angular-loading-bar',
            'btford.markdown'
        ]);

        // Const
        app.constant('appConfig', {
            'URL_BASE': 'web/public/app/'
        });

        // Setup app
        app.config([
            '$stateProvider',
            '$urlRouterProvider',
            'cfpLoadingBarProvider',
            '$httpProvider',
            '$logProvider',
            'markdownConverterProvider',
            'appConfig',
            function (
                $stateProvider,
                $urlRouterProvider,
                cfpLoadingBarProvider,
                $httpProvider,
                $logProvider,
                markdownConverterProvider,
                appConfig
            ) {
                // Setup moment locale
                moment.locale('es');

                // Setup $logProvider
                $logProvider.debugEnabled(true);
                Logger.setLogger(angular.injector(['ng']).get('$log'));
                logger = Logger.getLogger('App');
                logger.info('Starting APP');

                markdownConverterProvider.config({
                    extensions: ['github']
                });

                // Setup $httpProvider
                $httpProvider.defaults.timeout = 10000;
                $httpProvider.interceptors.push(function ($q, $location, $injector) {
                    return {
                        responseError: function (response) {
                            logger.error('status: ' + response.status + ', statusText: ' + response.statusText);

                            var $modalInstance, $modal = $injector.get('$uibModal');

                            $modalInstance = $modal.open({
                                animation: true,
                                templateUrl: appConfig.URL_BASE + 'views/modal.html',
                                controller: function ($scope) {
                                    var msg = (response.data.message) ? response.data.message : response.statusText;
                                    $scope.message = msg;
                                    $scope.code = response.status;
                                    $scope.time = moment().format('LLLL');
                                    $scope.details = response.details;
                                    $scope.showDetail = false;

                                    $scope.ok = function (event) {
                                        $modalInstance.close(event);
                                    };

                                    $scope.toggleDetail = function (event) {
                                        $scope.showDetail = !$scope.showDetail;
                                    };
                                }
                            });
                            return response;
                        }
                    };
                });

                // Setup Router
                $stateProvider.state('home', angularAMD.route({
                    url: '/home',
                    templateUrl: appConfig.URL_BASE + 'views/home.html',
                    controllerUrl: 'app/controllers/homeController'
                })).state('products', angularAMD.route({
                    url: '/products',
                    templateUrl: appConfig.URL_BASE + 'views/product.html',
                    controller: 'productController',
                    controllerUrl: 'app/controllers/productController'
                })).state('stores', angularAMD.route({
                    url: '/stores',
                    templateUrl: appConfig.URL_BASE + 'views/store.html',
                    controller: 'storeController',
                    controllerUrl: 'app/controllers/storeController'
                })).state('search', angularAMD.route({
                    url: '/search',
                    templateUrl: appConfig.URL_BASE + 'views/search.html',
                    controller: 'searchController',
                    controllerUrl: 'app/controllers/searchController'
                }));

                $urlRouterProvider.otherwise('/home');
            }
        ]);
        return angularAMD.bootstrap(app);
    }
);
