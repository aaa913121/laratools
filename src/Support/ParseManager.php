<?php

namespace Nolin\Laratools\Support;

trait ParseManager
{
    protected $jwt;

    /**
     * getPayload
     *
     * @param  String $key
     * @return Object
     */
    public function getPayload()
    {
        return $this->jwt->parseToken()->getPayload();
    }

    /**
     * invalidateToken
     *
     * 使token無效
     *
     * @return Object
     */
    public function invalidateToken()
    {
        return $this->jwt->parseToken()->invalidate();
    }
}
