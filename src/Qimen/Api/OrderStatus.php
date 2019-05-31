<?php


namespace TmallSdk\Qimen\Api;

use TmallSdk\Qimen\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * qimen.orderStatus.sync 订单全链路接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class OrderStatus
 * @package TmallSdk\Qimen\Api
 */
class OrderStatus extends GateWay
{
    /**
     * qimen.orderStatus.sync 订单全链路接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function sync(array $body = [])
    {
        $this->methodName = 'qimen.orderStatus.sync';
        $result = $this->request($body);
        return $result;
    }
}