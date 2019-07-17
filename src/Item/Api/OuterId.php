<?php

namespace TmallSdk\Item\Api;

use TmallSdk\Item\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * item.outerid.update 天猫商品/SKU商家编码更新接口 https://open.taobao.com/api.htm?docId=25076&docType=2
 *
 * Class OuterId
 * @package TmallSdk\Item\Api
 */
class OuterId extends GateWay
{
    /**
     * item.outerid.update 天猫商品/SKU商家编码更新接口
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function update(array $parameter = [])
    {
        $this->prefixMethod = 'tmall.';
        $this->needSessionKey = true;
        $this->methodName = 'item.outerid.update';
        $result = $this->request($parameter);
        return $result;
    }
}