<?php
declare(strict_types = 1);

namespace Iaejean\Product;

use Iaejean\Helpers\SerializerHelper;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package Iaejean\Product
 */
class ProductController implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $logger = \Logger::getLogger(__CLASS__);
        /** @var ProductService  $productService */
        $productService = $app['container']->getBean('product_service');
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($logger, $productService) {
            $logger->info('Request to findAll');
            $listProducts = $productService->findAll();
            return SerializerHelper::toJSON($listProducts);
        });

        $controllers->get('/{idProduct}/stores', function ($idProduct) use ($logger, $productService) {
            $logger->info('Request to /'. $idProduct .'/stores');
            $product = new Product();
            $product->setId($idProduct);
            $listStores = $productService->getStores($product);
            return SerializerHelper::toJSON($listStores);
        });

        return $controllers;
    }
}
