<?php

namespace TmallSdk\Qimen\Api;

use TmallSdk\Qimen\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * qimen.storeitem.query 门店关联商品查询接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class StoreItem
 * @package TmallSdk\Qimen\Api
 */
class StoreItem extends GateWay
{
    /**
     * qimen.storeitem.query 门店关联商品查询接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function query(array $body = [])
    {
        $this->methodName = 'qimen.storeitem.query';
        $result = $this->request($body);
        return $result;
    }
}