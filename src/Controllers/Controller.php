<?php

namespace nolin\laratools\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use nolin\laratools\Support\ApiResponse;
use nolin\laratools\Support\ParseManager;
use nolin\laratools\Support\UserAgent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
    ParseManager, ApiResponse, UserAgent;

    public function test()
    {
        return 'Hello world!';
    }

    /**
     * validateRequest
     *
     * 驗證request參數
     *
     * @return void
     */
    public function validateRequest()
    {
        return $this->validation::execute(
            //取得前一個function名稱
            debug_backtrace()[1]['function'],
            $this->request->all()
        );
    }

    /**
     * validateCustom
     *
     * 驗證id
     *
     * @param  Array $arg
     * @return void
     */
    public function validateCustom($method, $arg)
    {
        return $this->validation::execute($method, $arg);
    }

    /**
     * getEnum
     *
     * @param  String $field
     * @return Array
     */
    public function getEnum(string $field)
    {
        return [
            $field => $this->service->getEnum($field),
        ];
    }
}
