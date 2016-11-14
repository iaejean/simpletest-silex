<?php
declare(strict_types = 1);

namespace Iaejean\Store;

use Iaejean\Helpers\SerializerHelper;
use Iaejean\Product\Product;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StoreController
 * @package Iaejean\Store
 */
class StoreController implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $logger = \Logger::getLogger(__CLASS__);
        /** @var StoreService  $storeService */
        $storeService = $app['container']->getBean('store_service');
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($logger, $storeService) {
            $logger->info('Reques to findAll');
            $listStores = $storeService->findAll();
            return SerializerHelper::toJSON($listStores);
        });

        $controllers->get(
            '/{idStore}/product/{idProduct}',
            function ($idStore, $idProduct) use ($logger, $storeService) {
                $logger->info('Request to /' . $idStore . '/product/' . $idProduct);
                $store = new Store();
                $store->setId($idStore);
                $product = new Product();
                $product->setId($idProduct);
                $product = $storeService->findProductBy($store, $product);
                return SerializerHelper::toJSON($product);
            }
        );

        $controllers->put('/purchase/', function (Request $request) use ($logger, $storeService) {
            $logger->info('Reqesto /purchase/');
            $content = json_decode($request->getContent());
            $productStore = SerializerHelper::parseJSON(
                json_encode($content->storeProduct),
                'Iaejean\Store\StoreProduct'
            );
            $productStore = $storeService->purchase($productStore, $content->amount);
            return SerializerHelper::toJSON($productStore);
        });

        return $controllers;
    }
}
