<?php

namespace TmallSdk\Rp;

use Exception;
use TmallSdk\Rp\Api\Refund;
use TmallSdk\Rp\Api\Refunds;
use TmallSdk\Rp\Api\ReturnGoods;
use TmallSdk\Tmall;

/**
 * @property Refund refund 退款
 * @property Refunds refunds 退款
 * @property ReturnGoods returnGoods 返回商品
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
        $configArr = ['app_key', 'secret'];
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