<?php

namespace TmallSdk\Qimen;

use Exception;
use TmallSdk\Tools\Authorize\AuthorizeTrait;

class GateWay
{
    use AuthorizeTrait;

    const URL = 'https://qimen.api.taobao.com/router/qimen/service?';
    const SANDBOX_URL = 'http://qimenapi.tbsandbox.com/router/qimen/service?';

    protected $application;
    protected $isSandbox = false;

    protected $config;
    protected $appKey;
    protected $appSecret;
    protected $customerId;
    protected $partnerId;
    protected $targetAppKey;

    protected $needSessionKey = false;
    protected $prefixMethod = 'taobao.';
    protected $prefixXmlHeader = '<?xml version="1.0" encoding="utf-8"?>';
    protected $methodName;

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
        $this->customerId = $config['customerId'];
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
     * @param $bodyXml
     * @return string
     */
    protected function getStringToSign($parameter, $bodyXml)
    {
        ksort($parameter);
        $str = '';
        foreach ($parameter as $key => $value) {
            if (strlen($value) > 0) {
                $str .= $key . $value;
            }
        }
        $str = $this->appSecret . $str . $bodyXml . $this->appSecret;
        $signature = strtoupper(md5($str));
        return $signature;
    }

    /**
     * 签名
     * @param array $body
     * @return array
     * @throws Exception
     */
    protected function setParameter(array $body)
    {
        $time = date('Y-m-d H:i:s', time());
        $publicParameter = [
            'app_key' => $this->appKey,
            'customerId' => $this->customerId,
            'format' => 'xml',
            'method' => $this->prefixMethod . $this->methodName,
            'sign_method' => 'md5',
            'simplify' => false,
            'target_app_key' => $this->targetAppKey,
            'timestamp' => $time,
            'v' => '2.0',
        ];
        if ($this->needSessionKey) {
            $publicParameter['session'] = $this->getSessionKey();
        }
        $publicParameter = array_filter($publicParameter);
        $bodyXml = $this->prefixXmlHeader . array_to_xml(array_filter($body));
        $sign = $this->getStringToSign($publicParameter, $bodyXml);
        $parameters = array_merge($publicParameter, ['sign' => $sign]);
        return [
            'str' => http_build_query($parameters),
            'bodyXml' =>$bodyXml,
        ];
    }

    /**
     * 发送参数请求
     * @param array $body
     * @return mixed
     * @throws Exception
     */
    protected function request(array $body)
    {
        $parameterArray = self::setParameter($body);
        $url = ($this->isSandbox ? self::SANDBOX_URL : self::URL) . $parameterArray['str'];
        $result = tmall_curl_post_xml($url, $parameterArray['bodyXml']);
        if ($result != false) {
            $result = get_need_between($result, '<response>', '</response>');
            if (empty($result)) {
                throw new Exception('请求失败：请求结果为空');
            }
        } else {
            throw new Exception('请求失败：请求结果为FALSE');
        }
        return $this->parseReps(xml_to_array($result));
    }

    /**
     * 解析参数
     * @param array $result
     * @return mixed
     * @throws Exception
     */
    private function parseReps($result)
    {
        if ($result['flag'] == 'success') {
            return $result;
        }
        throw new Exception($this->setError('接口请求失败，错误信息为：' . ($result['code'] ?? '') . ' => ' . ($result['message'] ?? '')));
    }
}