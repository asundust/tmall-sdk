<?php

namespace TmallSdk\Item\Api;

use TmallSdk\Item\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * item.skus.get 根据商品ID列表获取SKU信息 https://open.taobao.com/api.htm?docId=30&docType=2
 *
 * Class Skus
 * @package TmallSdk\Item\Api
 */
class Skus extends GateWay
{
    /**
     * item.skus.get 根据商品ID列表获取SKU信息
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'item.skus.get';
        $result = $this->request($parameter);
        return $result;
    }
}