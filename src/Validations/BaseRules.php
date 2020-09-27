<?php

namespace Nolin\Laratools\Validations;

abstract class BaseRules
{
    /**
     * 驗證name
     *
     * @return Array
     */
    public static function name()
    {
        return [
            'rule' => [
                'id' => 'required|string',
            ],
            'message' => [],
        ];
    }

    /**
     * abort
     *
     * @return Array
     */
    public static function abort()
    {
        return \App::abort(404, trans('message.http_404'));
    }

    /**
     * __callStatic
     *
     * @param  String $method
     * @param  Array $args
     * @return void
     */
    public static function __callStatic($method, $args)
    {
        // 若沒有設置相關驗證會返回404
        return self::abort();
    }

    /**
     * 儲存一些常用的規則
     */
    function default() {
        return [
            'rule' => [
            ],
        ];
    }
}
