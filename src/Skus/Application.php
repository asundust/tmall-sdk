<?php

namespace TmallSdk\Skus;

use TmallSdk\Skus\Api\Custom;
use TmallSdk\Tmall;
use TmallSdk\Tools\TmallException;

/**
 * @property Custom custom ???
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