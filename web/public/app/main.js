'use strict';

var config = {
    baseUrl: 'web/public/',
    useStrict: true,
    packages : [
        { name : 'app', location : 'app' },
        { name : 'req', location : 'vendor/requirejs' }
    ],
    paths: {
        angular: 'vendor/angular/angular.min',
        angularRoute: 'vendor/angular-route/angular-route.min',
        angularAMD: 'vendor/angularAMD/angularAMD',
        angularUIRouter: 'vendor/angular-ui-router/release/angular-ui-router.min',
        angularResource: 'vendor/angular-resource/angular-resource.min',
        angularAnimate: 'vendor/angular-animate/angular-animate.min',
        angularSanitize: 'vendor/angular-sanitize/angular-sanitize.min',
        angularLoadingBar: 'vendor/angular-loading-bar/build/loading-bar.min',
        moment: 'vendor/moment/min/moment-with-locales.min',
        uiBootstrap: 'vendor/angular-bootstrap/ui-bootstrap.min',
        uiBootstrapTlp: 'vendor/angular-bootstrap/ui-bootstrap-tpls.min',
        showdown: 'vendor/showdown/compressed/Showdown.min',
        showdownExtension: 'vendor/showdown/compressed/extensions/github.min',
        markdown: 'vendor/angular-markdown-directive/markdown'
    },
    shim: {
        angularRoute: ['angular'],
        angularAMD: ['angular'],
        angularAnimate: ['angular'],
        angularUIRouter: ['angular'],
        angularResource: ['angular'],
        angularSanitize: ['angular'],
        angularLoadingBar: ['angular'],
        markdown: ['angular', 'showdown'],
        showdownExtension: ['showdown'],
        uiBootstrap: ['angular'],
        uiBootstrapTlp: ['uiBootstrap']
    },
    deps: ['app/app']
};

require.config(config);
