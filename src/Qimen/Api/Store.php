<?php

namespace TmallSdk\Qimen\Api;

use TmallSdk\Qimen\GateWay;
use TmallSdk\Tools\TmallException;

/**
 * qimen.store.create 门店新增接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.store.update 门店更新接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.store.delete 门店删除接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 * qimen.store.query 门店信息查询接口 https://open.taobao.com/doc.htm?docId=104651&docType=1
 *
 * Class Store
 * @package TmallSdk\Qimen\Api
 */
class Store extends GateWay
{
    /**
     * qimen.store.create 门店新增接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function create(array $body = [])
    {
        $this->methodName = 'qimen.store.create';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.store.update 门店更新接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function update(array $body = [])
    {
        $this->methodName = 'qimen.store.update';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.store.delete 门店删除接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function delete(array $body = [])
    {
        $this->methodName = 'qimen.store.delete';
        $result = $this->request($body);
        return $result;
    }

    /**
     * qimen.store.query 门店信息查询接口
     * @param array $body
     * @return mixed
     * @throws TmallException
     */
    public function query(array $body = [])
    {
        $this->methodName = 'qimen.store.query';
        $result = $this->request($body);
        return $result;
    }
}