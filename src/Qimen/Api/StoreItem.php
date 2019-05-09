<?php

namespace TmallSdk\Qimen\Api;

use Exception;
use TmallSdk\Qimen\GateWay;

/**
 * qimen.storeitem.query 门店关联商品查询接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class StoreItem
 * @package QimenSdk\Api
 */
class StoreItem extends GateWay
{
    /**
     * qimen.storeitem.query 门店关联商品查询接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function query(array $body = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'qimen.storeitem.query';
        $result = $this->request($body);
        return $result;
    }
}