<?php

namespace nolin\laratools;

use nolin\laratools\Services\CurlService;
use nolin\laratools\Services\ValidationService;

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
