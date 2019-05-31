<?php

namespace TmallSdk\Skus\Api;

use TmallSdk\Skus\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * skus.custom.get 根据外部ID取商品SKU https://open.taobao.com/api.htm?docId=164&docType=2
 *
 * Class Custom
 * @package TmallSdk\Skus\Api
 */
class Custom extends GateWay
{
    /**
     * skus.custom.get 根据外部ID取商品SKU
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'skus.custom.get';
        $result = $this->request($parameter);
        return $result;
    }
}