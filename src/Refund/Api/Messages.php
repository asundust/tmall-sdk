<?php

namespace TmallSdk\Refund\Api;

use Exception;
use TmallSdk\Refund\GateWay;

/**
 * refund.messages.get 查询退款留言/凭证列表 https://open.taobao.com/api.htm?docId=124&docType=2
 *
 * Class Messages
 * @package TmallSdk\Refund\Api
 */
class Messages extends GateWay
{
    /**
     * refund.messages.get 查询退款留言/凭证列表
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refund.messages.get';
        $result = $this->request($parameter);
        return $result;
    }
}