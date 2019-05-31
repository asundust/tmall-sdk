<?php

namespace TmallSdk\Rp\Api;

use TmallSdk\Rp\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * rp.refund.review 审核退款单 https://open.taobao.com/api.htm?docId=21611&docType=2
 *
 * Class Refund
 * @package TmallSdk\Rp\Api
 */
class Refund extends GateWay
{
    /**
     * rp.refund.review 审核退款单
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function review(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rp.refunds.agree';
        $result = $this->request($parameter);
        return $result;
    }
}