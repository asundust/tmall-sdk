<?php

namespace TmallSdk\Tools\Authorize;

use Doctrine\Common\Cache\PhpFileCache;
use TmallSdk\Tools\TmallException;

/**
 * Trait AuthorizeTrait
 *
 * @package TmallSdk\Tools\Authorize
 */
trait AuthorizeTrait
{
    protected $cachePrefix = 'tmall.access_token.';

    /**
     * 获取回调地址
     *
     * @return string
     */
    public function getRedirectUri()
    {
        return (tmall_is_https() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
    }

    /**
     * 添加字符串时间到token数据里
     *
     * @param $tokenArr
     * @return mixed
     */
    public function toChangeField($tokenArr)
    {
        $toChangeFields = [
            'refresh_token_valid_time',
            'expire_time',
            'w1_valid',
            'w2_valid',
            'r2_valid',
            'r1_valid',
        ];
        foreach ($toChangeFields as $field) {
            $tokenArr[$field . '_str'] = date('Y-m-d H:i:s', substr($tokenArr[$field], 0, 10));
        }
        return $tokenArr;
    }

    /**
     * 缓存token数据
     *
     * @param $tokenArr
     * @return mixed
     * @throws TmallException
     */
    public function cacheSetAccessToken($tokenArr)
    {
        // todo other cache
        $cache = new PhpFileCache(sys_get_temp_dir());
        $cache->save($this->cachePrefix . md5($this->appKey . $this->appSecret), $tokenArr, $tokenArr['expires_in']);
        return $tokenArr;
    }

    /**
     * 获取token数据
     *
     * @return mixed
     * @throws TmallException
     */
    public function cacheGetAccessToken()
    {
        // todo other cache
        $cache = new PhpFileCache(sys_get_temp_dir());
        $tokenArr = $cache->fetch($this->cachePrefix . md5($this->appKey . $this->appSecret));
        if (empty($tokenArr)) {
            throw new TmallException('需要重新授权“(new \TmallSdk\Auth($config))->auth($redirectUri);”');
        }
        if ($tokenArr['re_expires_in'] > 0 || $tokenArr['r2_valid'] - time() <= 86400) { // todo
            $tokenArr = (new Authorize($this->config))->refreshAccessToken($tokenArr['refresh_token']);
        }
        if (empty($tokenArr)) {
            throw new TmallException('需要重新授权“(new \TmallSdk\Auth($config))->auth($redirectUri);”');
        }
        return $tokenArr;
    }

    /**
     * 获取access token
     *
     * @return mixed
     * @throws TmallException
     */
    public function getSessionKey()
    {
        return $this->cacheGetAccessToken()['access_token'];
    }
}