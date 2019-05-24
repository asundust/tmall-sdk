<?php

namespace TmallSdk\Rdc\Api;

use Exception;
use TmallSdk\Rdc\GateWay;

/**
 * rdc.aligenius.sendgoods.cancel 取消发货 https://open.taobao.com/api.htm?docId=29304&docType=2
 * rdc.aligenius.order.returngoods.notify 退货单创建结果反馈 https://open.taobao.com/api.htm?docId=29304&docType=2
 *
 * Class AliGenius
 * @package TmallSdk\Rdc\Api
 */
class AliGenius extends GateWay
{
    /**
     * rdc.aligenius.sendgoods.cancel 取消发货
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function sendGoodsCancel(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rdc.aligenius.sendgoods.cancel';
        $result = $this->request($parameter);
        return $result;
    }

    /**
     * rdc.aligenius.order.returngoods.notify 退货单创建结果反馈
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function orderReturnGoodsNotify(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rdc.aligenius.order.returngoods.notify';
        $result = $this->request($parameter);
        return $result;
    }
}