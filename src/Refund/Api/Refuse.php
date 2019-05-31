<?php

namespace TmallSdk\Refund\Api;

use TmallSdk\Refund\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * refund.refuse 卖家拒绝退款 https://open.taobao.com/api.htm?docId=10480&docType=2
 *
 * Class Refuse
 * @package TmallSdk\Refund\Api
 */
class Refuse extends GateWay
{
    /**
     * refund.refuse 卖家拒绝退款
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function index(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refund.refuse';
        $result = $this->request($parameter);
        return $result;
    }
}