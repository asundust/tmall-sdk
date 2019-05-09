<?php

namespace TmallSdk\Tools\Authorize;

use Exception;
use TmallSdk\Tmall;

class Authorize
{
    use AuthorizeTrait;

    const URL = 'https://oauth.taobao.com/authorize?';
    const SANDBOX_URL = 'https://oauth.tbsandbox.com/authorize?';

    protected $isSandbox;

    protected $appKey;
    protected $appSecret;
    protected $config;

    /**
     * Auth constructor.
     * @param $config
     * @throws Exception
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['secret'];
        $this->isSandbox = $config['isSandbox'] ?? false;
    }

    /**
     * auth 授权页面
     * @param null $redirectUri
     * @throws Exception
     */
    public function auth($redirectUri = null)
    {
        if (empty($this->appKey)) {
            throw new Exception('请填写app_key！');
        }
        header("Location: " . ($this->isSandbox ? self::SANDBOX_URL : self::URL) . http_build_query(array_merge([
                'client_id' => $this->appKey,
                'response_type' => 'code',
                'state' => 'code',
                'view' => is_mobile() ? 'wap' : 'web',
            ], ['redirect_uri' => $redirectUri ?: $this->getRedirectUri()])));
    }

    /**
     * 获取AccessToken
     * @param string $code
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function getAccessToken($code, $parameter = [])
    {
        if (strlen($code) == 0) {
            throw new Exception('请求失败，无code返回！');
        }
        if (!isset($parameter['redirect_uri'])) {
            $parameter['redirect_uri'] = $this->getRedirectUri();
        }
        $result = Tmall::top($this->config)->auth->tokenCreate(array_merge([
            'client_id' => $this->appKey,
            'client_secret' => $this->appSecret,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'state' => 'authorization_code',
            'view' => is_mobile() ? 'wap' : 'web',
        ], $parameter));
        if (!empty($result)) {
            $tokenArr = json_decode($result['token_result'], true);
            $tokenArr = $this->toChangeField($tokenArr);
            return $this->cacheSetAccessToken($tokenArr);
        }
        throw new Exception('请求失败，接口无返回数据！');
    }

    /**
     * 刷新AccessToken
     * @param string $refreshToken
     * @param array $parameter
     * @return bool|mixed
     * @throws Exception
     */
    public function refreshAccessToken($refreshToken, $parameter = [])
    {
        $result = Tmall::top($this->config)->auth->tokenRefresh(array_merge([
            'client_id' => $this->appKey,
            'client_secret' => $this->appSecret,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'state' => 'refresh_token',
            'view' => is_mobile() ? 'wap' : 'web',
        ], $parameter));
        if (!empty($result)) {
            $tokenArr = json_decode($result['token_result'], true);
            $tokenArr = $this->toChangeField($tokenArr);
            $this->cacheSetAccessToken($tokenArr);
            return $tokenArr;
        }
        return false;
    }
}