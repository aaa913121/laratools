<?php

namespace nolin\laratools\Support;

trait UserAgent
{
    protected $agent;

    /**
     * getUserAgent 取得裝置、作業系統、瀏覽器
     *
     * @return Array
     */
    public function getUserAgent()
    {
        return [
            'device' => $this->getDevice(),
            'os' => $this->getOs(),
            'browser' => $this->getBrowser(),
        ];
    }

    /**
     * getDevice
     *
     * @return String
     */
    public function getDevice()
    {
        return ($this->agent->device()) ? ($this->agent->device()) : '';
    }

    /**
     * getOs
     *
     * @return String
     */
    public function getOs()
    {
        return ($this->agent->platform()) ?
        $this->agent->platform() . '_' . $this->agent->version($this->agent->platform()) : '';
    }

    /**
     * getBrowser
     *
     * @return String
     */
    public function getBrowser()
    {
        return ($this->agent->browser()) ?
        $this->agent->browser() . '_' . $this->agent->version($this->agent->browser()) : '';
    }
}
