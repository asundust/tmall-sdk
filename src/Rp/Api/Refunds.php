<?php

namespace TmallSdk\Rp\Api;

use TmallSdk\Rp\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * rp.refunds.agree 同意退款 https://open.taobao.com/api.htm?docId=21611&docType=2 需在聚石塔内调用
 *
 * Class Refunds
 * @package TmallSdk\Rp\Api
 */
class Refunds extends GateWay
{
    /**
     * rp.refunds.agree 同意退款
     * 需在聚石塔内调用
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function agree(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rp.refunds.agree';
        $result = $this->request($parameter);
        return $result;
    }
}