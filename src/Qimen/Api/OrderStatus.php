<?php


namespace TmallSdk\Qimen\Api;

use Exception;
use TmallSdk\Qimen\GateWay;

/**
 * 3.1 qimen.orderStatus.sync 订单全链路接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class OrderStatus
 * @package QimenSdk\Api
 */
class OrderStatus extends GateWay
{
    /**
     * 3.1 qimen.orderStatus.sync 订单全链路接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function sync(array $body = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'qimen.orderStatus.sync';
        $result = $this->request($body);
        return $result;
    }
}