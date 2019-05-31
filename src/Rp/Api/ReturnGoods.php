<?php

namespace TmallSdk\Rp\Api;

use TmallSdk\Rp\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * rp.returngoods.agree 卖家同意退货 https://open.taobao.com/api.htm?docId=22466&docType=2
 * rp.returngoods.refill 卖家回填物流信息 https://open.taobao.com/api.htm?docId=23876&docType=2
 * rp.returngoods.refuse 卖家拒绝退货 https://open.taobao.com/api.htm?docId=23877&docType=2
 *
 * Class ReturnGoods
 * @package TmallSdk\Rp\Api
 */
class ReturnGoods extends GateWay
{
    /**
     * rp.returngoods.agree 卖家同意退货
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function agree(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rp.returngoods.agree';
        $result = $this->request($parameter);
        return $result;
    }

    /**
     * rp.returngoods.agree 卖家同意退货
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function refill(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rp.returngoods.refill';
        $result = $this->request($parameter);
        return $result;
    }

    /**
     * rp.returngoods.refuse 卖家拒绝退货
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function refuse(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'rp.returngoods.refuse';
        $result = $this->request($parameter);
        return $result;
    }
}