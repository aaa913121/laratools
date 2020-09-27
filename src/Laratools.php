<?php

namespace Nolin\Laratools;

use Nolin\Laratools\Services\CurlService;
use Nolin\Laratools\Services\ValidationService;

class Laratools
{
    /**
     * validation
     *
     * @param  String $feature
     * @return Object
     */
    public function validation($feature)
    {
        return new ValidationService($feature);
    }

    /**
     * curl 發送服務
     *
     * @param  String $url
     * @return Object
     */
    public function curl($url)
    {
        return new CurlService($url);
    }
}
