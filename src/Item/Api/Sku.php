<?php

namespace TmallSdk\Item\Api;

use TmallSdk\Item\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * item.sku.get 获取SKU https://open.taobao.com/api.htm?docId=28&docType=2
 *
 * Class Skus
 * @package TmallSdk\Item\Api
 */
class Sku extends GateWay
{
    /**
     * item.sku.get 获取SKU
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'item.sku.get';
        $result = $this->request($parameter);
        return $result;
    }
}