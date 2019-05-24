<?php

namespace TmallSdk\Refund\Api;

use Exception;
use TmallSdk\Refund\GateWay;

/**
 * refund.message.add 创建退款留言/凭证 https://open.taobao.com/api.htm?docId=125&docType=2
 *
 * Class Message
 * @package TmallSdk\Refund\Api
 */
class Message extends GateWay
{
    /**
     * refund.message.add 创建退款留言/凭证
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function add(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'refund.message.add';
        $result = $this->request($parameter);
        return $result;
    }
}