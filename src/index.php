<?php
declare(strict_types = 1);

date_default_timezone_set('America/Mexico_city');

require_once __DIR__ . '/../vendor/autoload.php';

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Ding\Container\Impl\ContainerImpl;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Iaejean\Product\ProductController;
use Iaejean\Store\StoreController;
use Iaejean\Helpers\SerializerHelper;
use Silex\Application;

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;

AnnotationRegistry::registerLoader('class_exists');

define('ROOT_APPLICATION_PATH', dirname(__DIR__));
$paths = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
define('URL_BASE', '/' . $paths[1] . '/');

$app = new Application(['debug' => true]);
$app->register(new ServiceControllerServiceProvider());
$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'store',
        'user'      => 'root',
        'password'  => 'admin',
        'charset'   => 'utf8'
    ]
]);
$app->register(new DoctrineOrmServiceProvider, [
    'orm.proxies_dir' => ROOT_APPLICATION_PATH . '/cache/proxies/',
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'Iaejean\Entity',
                'path' => ROOT_APPLICATION_PATH . '/src/Iaejean/Entity',
                'use_simple_annotation_reader' => false
            ]
        ]
    ]
]);
$app->register(new TwigServiceProvider(), [
    'twig.path' => ROOT_APPLICATION_PATH . '/src/Iaejean/views' ,
]);
$app['urlBase'] = URL_BASE;
$app['container'] = ContainerImpl::getInstance([
    'ding' => [
        'log4php.properties' => ROOT_APPLICATION_PATH . '/src/log4php.php',
        'factory' => [
            'bdef' => [
                'annotation' => [
                    'scanDir' => [__DIR__]
                ]
            ],
            'properties' => [
                'entity_manager' => $app['orm.em']
            ]
        ]
    ]
]);
$logger = Logger::getLogger('app');
$logger->info('Starting app');

$app->mount(URL_BASE . 'product', new ProductController());
$app->mount(URL_BASE . 'store', new StoreController());
$app->get(URL_BASE, function () use ($app) {
    return $app['twig']->render('index.html.twig', []);
});
$app->error(function (\Exception $e) {
    $stdClass = new stdClass();
    $stdClass->code = $e->getCode();
    $stdClass->message = $e->getMessage();
    return new Response(SerializerHelper::toJSON($stdClass), 400);
});

ob_clean();
$app->run();
