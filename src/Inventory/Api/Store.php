<?php

namespace TmallSdk\Inventory\Api;

use Exception;
use TmallSdk\Inventory\GateWay;

/**
 * inventory.store.manage 创建或更新仓库 https://open.taobao.com/api.htm?docId=21611&docType=2
 *
 * Class Store
 * @package TmallSdk\Inventory\Api
 */
class Store extends GateWay
{
    /**
     * inventory.store.manage 创建或更新仓库
     * @param array $parameter
     * @return mixed
     * @throws Exception
     */
    public function manage(array $parameter = [])
    {
        $this->needSessionKey = true;
        $this->methodName = 'inventory.store.manage';
        $result = $this->request($parameter);
        return $result;
    }
}