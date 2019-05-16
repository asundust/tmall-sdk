<?php

if (!function_exists('tmall_curl_post_xml')) {
    /**
     * CURL_POST_XML
     * @param $url
     * @param null $curlPost
     * @return bool|string
     */
    function tmall_curl_post_xml($url, $curlPost = null)
    {
        $curl = curl_init();
        $timeout = 5;
        curl_setopt($curl, CURLOPT_URL, $url);
        $header = ["Content-Type=application/xml; charset=utf-8"];
        curl_setopt($curl, CURLOPT_HEADER, $header);
        // curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
}

if (!function_exists('tmall_curl_post')) {
    /**
     * CURL_POST
     * @param $url
     * @param null $curlPost
     * @return bool|string
     */
    function tmall_curl_post($url, $curlPost = null)
    {
        $curl = curl_init();
        $timeout = 5;
        curl_setopt($curl, CURLOPT_URL, $url);
        $header = ["Content-Type=application//x-www-form-urlencoded; charset=utf-8"];
        curl_setopt($curl, CURLOPT_HEADER, $header);
        // curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
}

if (!function_exists('xml_to_array')) {
    /**
     * xml 转为 array
     * @param string file $data
     * @return array
     */
    function xml_to_array($xml)
    {
        return (new \TmallSdk\Tools\XML())->parse($xml);
    }
}

if (!function_exists('array_to_xml')) {
    /**
     * array 转为 xml
     * @param $array
     * @return string
     */
    function array_to_xml($array)
    {
        return (new \TmallSdk\Tools\XML())->build($array);
    }
}

if (!function_exists('get_need_between')) {
    /**
     * 获取两个字符串中间的文本
     * @param $str
     * @param $str1
     * @param $str2
     * @return bool|string
     */
    function get_need_between($str, $str1, $str2)
    {
        $start = stripos($str, $str1);
        $end = stripos($str, $str2);
        if (($start == false || $end == false) || $start >= $end) {
            return '';
        }
        $kw = substr($str, ($start), ($end - 1));
        return $kw;
    }
}

if (!function_exists('array_first')) {
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param array $array
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    function array_first($array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                return $value;
            }
        }

        return value($default);
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('array_dot')) {
    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param array $array
     * @param string $prepend
     * @return array
     */
    function array_dot($array, $prepend = '')
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, array_dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }
        return $results;
    }
}

if (!function_exists('array_str')) {
    /**
     * 数组转字符
     * @param $array
     * @param string $prepend1
     * @param string $prepend2
     * @return string
     */
    function array_str($array, $prepend1 = ':', $prepend2 = ' // ')
    {
        $results = '';
        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results .= array_str($value, $prepend1 . $key . $prepend2);
            } else {
                $results .= $key . $prepend1 . $value . $prepend2;
            }
        }
        return $results;
    }
}

if (!function_exists('is_mobile')) {
    /**
     * 判断是否是手机访问
     * @return bool
     */
    function is_mobile()
    {
        return (new \Jenssegers\Agent\Agent())->isMobile();
    }
}

if (!function_exists('is_https')) {
    function is_https()
    {
        if (defined('HTTPS') && HTTPS) return true;
        if (!isset($_SERVER)) return false;
        if (!isset($_SERVER['HTTPS'])) return false;
        if ($_SERVER['HTTPS'] === 1) {  //Apache
            return true;
        } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
            return true;
        } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
            return true;
        }
        return false;
    }
}

if (!function_exists('api_result_name')) {
    /**
     * api返回数据字段名
     * @param $methodName
     * @param string $search
     * @param string $replace
     * @param string $suffix
     * @return string
     */
    function api_result_name($methodName, $search = '.', $replace = '_', $suffix = 'response')
    {
        return str_replace($search, $replace, $methodName) . $replace . $suffix;
    }
}