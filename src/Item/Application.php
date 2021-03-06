<?php

namespace TmallSdk\Item;

use TmallSdk\Item\Api\OuterId;
use TmallSdk\Item\Api\Sku;
use TmallSdk\Item\Api\Skus;
use TmallSdk\Tmall;
use TmallSdk\Tools\TmallException;

/**
 * @property OuterId outerId 外部id
 * @property Sku sku SKU
 * @property Skus skus SKU
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
     * @throws TmallException
     */
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new TmallException('No config');
        }
        $configArr = ['app_key', 'secret'];
        foreach ($configArr as $configName) {
            if (!isset($config[$configName]) || empty($config[$configName])) {
                throw new TmallException("Config $configName is missing");
            }
        }
        $this->config = $config;
        return $this;
    }

    /**
     * @param $api
     * @return bool
     * @throws TmallException
     */
    public function __get($api)
    {
        try {
            $classname = __NAMESPACE__ . "\\Api\\" . ucfirst($api);
            if (!class_exists($classname)) {
                throw new TmallException('Api undefined');
            }
            $new = new $classname($this->config, $this);
            return $new;
        } catch (TmallException $e) {
            throw new TmallException('Api undefined');
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