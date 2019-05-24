<?php

namespace TmallSdk\Refunds\Api;

use Exception;
use TmallSdk\Refunds\GateWay;

/**
 * refunds.apply.get 查询买家申请的退款列表 https://open.taobao.com/api.htm?docId=51&docType=2
 *
 * Class Apply
 * @package TmallSdk\Refunds\Api
 */
class Apply extends GateWay
{
    /**
     * refunds.apply.get 查询买家申请的退款列表
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refunds.apply.get';
        $result = $this->request($parameter);
        return $result;
    }
}