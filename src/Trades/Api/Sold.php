<?php

namespace TmallSdk\Trades\Api;

use TmallSdk\Tools\TmallException;
use TmallSdk\Trades\GateWay;

/**
 * trades.sold.get 查询卖家已卖出的交易数据（根据创建时间） https://open.taobao.com/api.htm?docId=46&docType=2
 *
 * Class Sold
 * @package TmallSdk\Trades\Api
 */
class Sold extends GateWay
{
    /**
     * trades.sold.get 查询卖家已卖出的交易数据（根据创建时间）
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'trades.sold.get';
        $result = $this->request($parameter);
        return $result;
    }
}