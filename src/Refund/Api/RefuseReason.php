<?php

namespace TmallSdk\Refund\Api;

use TmallSdk\Refund\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * refund.refusereason.get 获取拒绝原因列表 https://open.taobao.com/api.htm?docId=26204&docType=2
 *
 * Class RefuseReason
 * @package TmallSdk\Refund\Api
 */
class RefuseReason extends GateWay
{
    /**
     * refund.refusereason.get 获取拒绝原因列表
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refund.refusereason.get';
        $result = $this->request($parameter);
        return $result;
    }
}