<?php

namespace TmallSdk;

use Exception;
use TmallSdk\Tools\Authorize\Authorize;

class Auth
{
    protected $config;

    /**
     * Auth constructor.
     * @param $config
     * @throws Exception
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * auth 授权页面
     * @param null $redirectUri
     * @throws Exception
     */
    public function auth($redirectUri = null)
    {
        (new Authorize($this->config))->auth($redirectUri);
    }

    /**
     * 获取code回调，获取AccessToken
     * @param $code
     * @param array $parameter
     * @return bool
     * @throws Exception
     */
    public function getAccessToken($code, $parameter = [])
    {
        return (new Authorize($this->config))->getAccessToken($code, $parameter);
    }

    /**
     * 获取AccessToken数据
     * @return mixed
     * @throws Exception
     */
    public function getAccessTokenData()
    {
        return (new Authorize($this->config))->cacheGetAccessToken();
    }
}