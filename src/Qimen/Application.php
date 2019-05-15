<?php

namespace TmallSdk\Qimen;

use Exception;
use TmallSdk\Qimen\Api\ItemStore;
use TmallSdk\Qimen\Api\OrderStatus;
use TmallSdk\Qimen\Api\Store;
use TmallSdk\Qimen\Api\StoreCategory;
use TmallSdk\Qimen\Api\StoreInventory;
use TmallSdk\Qimen\Api\StoreItem;
use TmallSdk\Tmall;

/**
 * @property ItemStore itemStore 商品关联门店
 * @property OrderStatus orderStatus 订单
 * @property Store store 门店
 * @property StoreCategory storeCategory 门店分类
 * @property StoreInventory storeInventory 门店库存
 * @property StoreItem storeItem 门店商品
 *
 * Class Application
 * @package QimenSdk
 */
class Application extends Tmall
{
    private $config;
    private $error;

    /**
     * Application constructor.
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new Exception('No config');
        }
        $configArr = ['app_key', 'secret', 'customerId'];
        foreach ($configArr as $configName) {
            if (!isset($config[$configName]) || empty($config[$configName])) {
                throw new Exception("Config $configName is missing");
            }
        }
        $this->config = $config;
        return $this;
    }

    /**
     * @param $api
     * @return bool
     * @throws Exception
     */
    public function __get($api)
    {
        try {
            $classname = __NAMESPACE__ . "\\Api\\" . ucfirst($api);
            if (!class_exists($classname)) {
                throw new Exception('Api undefined');
            }
            $new = new $classname($this->config, $this);
            return $new;
        } catch (Exception $e) {
            throw new Exception('Api undefined');
        }
    }

    /**
     * @param $message
     * @return mixed
     */
    public function setError($message)
    {
        $this->error = $message;
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}