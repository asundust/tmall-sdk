<?php

namespace TmallSdk\Trades;

use TmallSdk\Tools\BaseGateWay;

/**
 * Class GateWay
 * @package TmallSdk\Trades
 */
class GateWay extends BaseGateWay
{
    /**
     * GateWay constructor.
     * @param array $config
     * @param Application $application
     */
    public function __construct(array $config, Application $application)
    {
        parent::__construct($config, $application);
    }
}