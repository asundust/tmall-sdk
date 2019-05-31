<?php

namespace TmallSdk\Top;

use TmallSdk\Tools\Authorize\AuthorizeTrait;
use TmallSdk\Tools\TmallException;

/**
 * Class GateWay
 * @package TmallSdk\Top
 */
class GateWay
{
    use AuthorizeTrait;

    const URL = 'https://eco.taobao.com/router/rest';
    const SANDBOX_URL = 'https://gw.api.tbsandbox.com/router/rest';

    protected $application;
    protected $isSandbox = false;

    protected $config;
    protected $appKey;
    protected $appSecret;
    protected $prefixMethod = 'taobao.';
    protected $methodName;
    protected $partnerId;
    protected $targetAppKey;

    protected $needSessionKey = false;

    /**
     * GateWay constructor.
     * @param array $config
     * @param Application $application
     */
    public function __construct(array $config, Application $application)
    {
        $this->config = $config;
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['secret'];
        $this->partnerId = $config['partner_id'] ?? null;
        $this->targetAppKey = $config['target_app_key'] ?? null;
        $this->application = $application;
        if (isset($config['isSandbox'])) {
            $this->isSandbox = $config['isSandbox'];
        }
    }

    /**
     * @param $message
     * @return mixed
     */
    protected function setError($message)
    {
        return $this->application->setError($message);
    }

    /**
     * @param $isSandbox
     */
    protected function setIsSandbox($isSandbox)
    {
        $this->isSandbox = $isSandbox;
    }

    /**
     * 生成签名
     * @param $parameter
     * @return string
     */
    protected function getStringToSign($parameter)
    {
        ksort($parameter);
        $str = '';
        foreach ($parameter as $key => $value) {
            if (strlen($value) > 0) {
                $str .= $key . $value;
            }
        }
        $str = $this->appSecret . $str . $this->appSecret;
        $signature = strtoupper(md5($str));
        return $signature;
    }

    /**
     * 签名
     * @param array $parameter
     * @return array
     * @throws TmallException
     */
    protected function setParameter(array $parameter)
    {
        $time = date('Y-m-d H:i:s', time());
        $publicParameter = [
            'app_key' => $this->appKey,
            'format' => 'json',
            'method' => $this->prefixMethod . $this->methodName,
            'partner_id' => $this->partnerId,
            'sign_method' => 'md5',
            'simplify' => false,
            'target_app_key' => $this->targetAppKey,
            'timestamp' => $time,
            'v' => '2.0',
        ];
        if ($this->needSessionKey) {
            $publicParameter['session'] = $this->getSessionKey();
        }
        $allParameters = array_merge(array_filter($publicParameter), array_filter($parameter));
        $sign = $this->getStringToSign($allParameters);
        return array_merge(array_filter($allParameters), ['sign' => $sign]);
    }

    /**
     * 发送参数请求
     * @param array $parameter
     * @return mixed
     * @throws TmallException
     */
    protected function request(array $parameter)
    {
        $parameter = self::setParameter($parameter);
        $url = ($this->isSandbox ? self::SANDBOX_URL : self::URL);
        $result = tmall_curl_post($url, $parameter);
        if ($result != false) {
            preg_match("/{.+}/", $result, $pmResult);
            if (count($pmResult) == 1) {
                return $this->parseReps($pmResult[0]);
            }
            throw new TmallException('解析失败：' . $result);
        } else {
            throw new TmallException('请求失败：请求结果为FALSE');
        }
    }

    /**
     * 解析参数
     * @param $result
     * @return bool
     * @throws TmallException
     */
    private function parseReps($result)
    {
        $data = json_decode($result, true);
        if ($data === false) {
            throw new TmallException($this->setError('数据解析失败，错误信息为：' . $result));
        }
        if (is_array($data) && count($data) == 1 && array_key_exists('error_response', $data)) {
            throw new TmallException($this->setError('接口请求失败，错误信息为：' . array_str($data['error_response'])));
        }
        return $data[api_result_name($this->methodName)];
    }
}