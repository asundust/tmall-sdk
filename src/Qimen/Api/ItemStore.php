<?php

namespace TmallSdk\Qimen\Api;

use TmallSdk\Qimen\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * qimen.itemstore.banding 商品关联绑定接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.itemstore.query 门店关联商品查询接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class ItemStore
 * @package TmallSdk\Qimen\Api
 */
class ItemStore extends GateWay
{
    /**
     * qimen.itemstore.banding 商品关联绑定接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function banding(array $body = [])
    {
        $this->methodName = 'qimen.itemstore.banding';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.itemstore.query 门店关联商品查询接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function query(array $body = [])
    {
        $this->methodName = 'qimen.itemstore.query';
        $result = $this->request($body);
        return $result;
    }
}