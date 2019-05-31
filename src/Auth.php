<?php

namespace TmallSdk;

use TmallSdk\Tools\Authorize\Authorize;
use TmallSdk\Tools\TmallException;

/**
 * Class Auth
 * @package TmallSdk
 */
class Auth
{
    protected $config;

    /**
     * Auth constructor.
     * @param $config
     * @throws TmallException
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * auth 授权页面
     * @param null $redirectUri
     * @throws TmallException
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
     * @throws TmallException
     */
    public function getAccessToken($code, $parameter = [])
    {
        return (new Authorize($this->config))->getAccessToken($code, $parameter);
    }

    /**
     * 获取AccessToken数据
     * @return mixed
     * @throws TmallException
     */
    public function getAccessTokenData()
    {
        return (new Authorize($this->config))->cacheGetAccessToken();
    }
}