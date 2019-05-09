<?php

namespace TmallSdk;

/**
 * @method static \TmallSdk\Top\Application top(array $config = []) 用户授权
 * @method static \TmallSdk\Inventory\Application inventory(array $config = []) 仓库
 * @method static \TmallSdk\Items\Application items(array $config = []) 商品
 * @method static \TmallSdk\Qimen\Application qimen(array $config = []) 奇门
 *
 * Class Tmall
 * @package TmallSdk
 */
class Tmall
{
    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    public static function make($name, array $config)
    {
        $name = "\\TmallSdk\\" . ucfirst($name) . "\\Application";
        return new $name($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}