<?php

namespace TmallSdk\Qimen\Api;

use Exception;
use TmallSdk\Qimen\GateWay;

/**
 * qimen.storecategory.get 门店类目获取接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class StoreCategory
 * @package QimenSdk\Api
 */
class StoreCategory extends GateWay
{
    /**
     * qimen.storecategory.get 门店类目获取接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function get(array $body = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'qimen.storecategory.get';
        $result = $this->request($body);
        return $result;
    }
}