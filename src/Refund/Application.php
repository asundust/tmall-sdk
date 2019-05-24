<?php

namespace TmallSdk\Refund;

use Exception;
use TmallSdk\Refund\Api\Get;
use TmallSdk\Refund\Api\Message;
use TmallSdk\Refund\Api\Messages;
use TmallSdk\Refund\Api\Refuse;
use TmallSdk\Refund\Api\RefuseReason;
use TmallSdk\Tmall;

/**
 * @property Get get 获取
 * @property Message message 消息
 * @property Messages messages 消息
 * @property Refuse refuse 拒绝
 * @property RefuseReason refuseReason 拒绝原因
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