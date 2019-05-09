<?php

namespace TmallSdk\Top\Api;

use Exception;
use TmallSdk\Top\GateWay;

/**
 * auth.token.create 用户token获取 https://open.taobao.com/api.htm?docId=25388&docType=2
 * auth.token.refresh 用户token刷新 https://open.taobao.com/api.htm?docId=25387&docType=2
 *
 * Class Auth
 * @package TmallSdk\Top\Api
 */
class Auth extends GateWay
{
    /**
     * auth.token.create 用户token获取
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function tokenCreate(array $parameter = [])
    {
        $this->methodName = 'top.auth.token.create';
        $result = $this->request($parameter);
        return $result;
    }

    /**
     * auth.token.refresh 用户token刷新
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function tokenRefresh(array $parameter = [])
    {
        $this->methodName = 'top.auth.token.refresh';
        $result = $this->request($parameter);
        return $result;
    }
}