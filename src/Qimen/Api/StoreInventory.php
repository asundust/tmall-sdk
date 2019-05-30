<?php

namespace TmallSdk\Qimen\Api;

use Exception;
use TmallSdk\Qimen\GateWay;

/**
 * qimen.storeinventory.iteminitial 库存初始化接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.storeinventory.itemupdate 库存增量更新接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.storeinventory.itemquery 库存查询接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.storeinventory.itemadjust 库存占用调整接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class StoreInventory
 * @package TmallSdk\Qimen\Api
 */
class StoreInventory extends GateWay
{
    /**
     * qimen.storeinventory.iteminitial 库存初始化接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function itemInitial(array $body = [])
    {
        $this->methodName = 'qimen.storeinventory.iteminitial';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.storeinventory.itemupdate 库存增量更新接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function itemUpdate(array $body = [])
    {
        $this->methodName = 'qimen.storeinventory.itemupdate';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.storeinventory.itemquery 库存查询接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function itemQuery(array $body = [])
    {
        $this->methodName = 'qimen.storeinventory.itemquery';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.storeinventory.itemadjust 库存占用调整接口
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    public function itemAdjust(array $body = [])
    {
        $this->methodName = 'qimen.storeinventory.itemadjust';
        $result = $this->request($body);
        return $result;
    }
}