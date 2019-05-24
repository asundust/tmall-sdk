<?php

namespace TmallSdk\Items\Api;

use Exception;
use TmallSdk\Items\GateWay;

/**
 * items.onsale.get 获取当前会话用户出售中的商品列表 https://open.taobao.com/api.htm?docId=18&docType=2
 *
 * Class OnSale
 * @package TmallSdk\Items\Api
 */
class OnSale extends GateWay
{
    /**
     * items.onsale.get 获取当前会话用户出售中的商品列表
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function get(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'items.onsale.get';
        $result = $this->request($parameter);
        return $result;
    }
}