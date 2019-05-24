<?php

namespace TmallSdk\Rdc;

use Exception;
use TmallSdk\Rdc\Api\AliGenius;
use TmallSdk\Tmall;

/**
 * @property AliGenius aliGenius 阿里天才???
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