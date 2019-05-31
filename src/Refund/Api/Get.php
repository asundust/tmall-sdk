<?php

namespace TmallSdk\Refund\Api;

use TmallSdk\Refund\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * refund.get 获取单笔退款详情 https://open.taobao.com/api.htm?docId=53&docType=2
 *
 * Class Get
 * @package TmallSdk\Refund\Api
 */
class Get extends GateWay
{
    /**
     * refund.get 获取单笔退款详情
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function index(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refund.get';
        $result = $this->request($parameter);
        return $result;
    }
}