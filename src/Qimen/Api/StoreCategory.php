<?php

namespace TmallSdk\Qimen\Api;

use TmallSdk\Qimen\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * qimen.storecategory.get 门店类目获取接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class StoreCategory
 * @package TmallSdk\Qimen\Api
 */
class StoreCategory extends GateWay
{
    /**
     * qimen.storecategory.get 门店类目获取接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function get(array $body = [])
    {
        $this->methodName = 'qimen.storecategory.get';
        $result = $this->request($body);
        return $result;
    }
}