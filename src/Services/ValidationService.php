<?php

namespace nolin\laratools\Services;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidationService
{
    /**
     * namespace
     *
     * 因為此套件為核心，可以給專案或者其他套件使用
     * 預設是給專案使用，所以套件需使用setNamespace修改
     *
     * @var String
     */
    protected static $namespace = 'App\Validations';

    /**
     * feature 功能
     *
     * @var String
     */
    protected static $feature;

    /**
     * __construct
     *
     * @param  String $feature
     */
    public function __construct($feature)
    {
        self::$feature = $feature;
    }

    /**
     * setNamespace
     *
     * @param  String $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        self::$namespace = $namespace;

        return $this;
    }

    /**
     * 取得規則及訊息，檔案需放於App\Rules\底下
     *
     * @param  String $method
     * @param  mixed $request
     * @return void
     */
    public static function getRuleAndMsg($method, $request)
    {
        return call_user_func(array(self::$namespace . "\\" . self::$feature, $method), $request);
    }

    /**
     * 執行驗證
     *
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return void
     */
    public static function execute($method, $request)
    {
        $ruleAndMsg = self::getRuleAndMsg($method, $request);

        $message = isset($ruleAndMsg['message']) ? $ruleAndMsg['message'] : [];

        // 無設置則使用預設validation message
        $result = Validator::make($request, $ruleAndMsg['rule'], $message);

        if ($result->fails()) {
            $errorMsg = $result->errors()->first();
            throw new BadRequestHttpException($errorMsg);
        }

        return;
    }
}
