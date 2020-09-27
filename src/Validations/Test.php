<?php

namespace nolin\laratools\Validations;

class Test extends BaseRules
{
    /**
     * create
     *
     * @param  Array $request
     * @return Array
     */
    public static function create($request = null)
    {
        return [
            'rule' => [
                'test' => 'required|string',
            ],
            'message' => [],
        ];
    }

    /**
     * show
     *
     * @param  Array $request
     * @return Array
     */
    public static function show($request = null)
    {
        return [
            'rule' => [

            ],
            'message' => [],
        ];
    }

    /**
     * read
     *
     * @param  Array $request
     * @return Array
     */
    public static function read($request = null)
    {
        return self::id();
    }

    /**
     * update
     *
     * @param  Array $request
     * @return Array
     */
    public static function update($request = null)
    {
        return self::create();
    }

    /**
     * delete
     *
     * @param  Array $request
     * @return Array
     */
    public static function delete($request = null)
    {
        return self::id();
    }
}
