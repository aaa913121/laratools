<?php

namespace nolin\laratools\Services;

use Illuminate\Support\Carbon;
use nolin\laratools\Support\ApiResponse;
use nolin\laratools\Support\ThrowException;
use nolin\laratools\Support\UserAgent;

class Service
{
    use ThrowException, UserAgent, ApiResponse;

    protected $parameter;
    protected $request;
    protected $repository;
    protected $status;

    /**
     * 將request中參數寫入物件(因放在service construct會被注入干擾)
     *
     * @return $this
     */
    public function setParameter()
    {
        $this->parameter = $this->request->all();

        return $this;
    }

    /**
     * 部分資料表不可異動system資料
     *
     * @param  Integer $id
     * @return $this
     */
    protected function untouchable($id)
    {
        if ($id == 1) {
            $this->throwJobFailed(trans('message.http_403'));
        }

        return $this;
    }

    /**
     * 製作api前綴
     *
     * @param  Boolean $secure
     * @param  String $version
     * @return String
     */
    protected function makeApiPrefix($secure = true, $version = 'v1')
    {
        $host = $this->request->getHttpHost();
        $http = ($secure == true) ? 'https' : 'http';

        return "{$http}://{$host}/api/{$version}/";
    }

    /**
     * 分頁資訊
     *
     * @return $this
     */
    protected function getPaginationParam($default)
    {
        $this->parameter = array_merge($this->parameter, [
            'page' => $this->parameter['page'] ?? $default[0],
            'pageSize' => $this->parameter['pageSize'] ?? $default[1],
        ]);

        return $this;
    }

    /**
     * 取得order by用資訊
     *
     * @param  Array $default
     * @return Array
     */
    protected function getOrder($default)
    {
        if (isset($this->parameter['sort']) && isset($this->parameter['sortName']) && !is_null($this->parameter['sort']) && !is_null($this->parameter['sortName'])) {
            return [
                $this->parameter['sortName'] => $this->parameter['sort'],
            ];
        } else {
            return $default;
        }
    }

    /**
     * 同上功能，不過是提供給eloquent使用，傳入$default結構與上相同
     *
     * @param  Array $default
     * @return Array
     */
    protected function getOrderArray($default)
    {
        if (isset($this->parameter['sort']) && isset($this->parameter['sortName']) && !is_null($this->parameter['sort']) && !is_null($this->parameter['sortName'])) {
            return [
                'key' => $this->parameter['sortName'],
                'direction' => $this->parameter['sort'],
            ];
        } else {
            foreach ($default as $key => $direction) {
                return compact('key', 'direction');
            }
        }
    }

    /**
     * 參數中添增creator與editor資料
     *
     * @param  Integer $id
     * @return $this
     */
    protected function getCreator($id)
    {
        $this->parameter = array_merge($this->parameter, [
            'created_by' => $id,
            'updated_by' => $id,
        ]);

        return $this;
    }

    /**
     * 參數中添增editor資料
     *
     * @param  Integer $id
     * @return $this
     */
    protected function getEditor($id)
    {
        $this->parameter = array_merge($this->parameter, [
            'updated_by' => $id,
        ]);

        return $this;
    }

    /**
     * 軟刪除
     *
     * @param  Integer $userId
     * @return Array
     */
    protected function makeDeleteParam($userId)
    {
        return [
            'updated_by' => $userId,
            'is_deleted' => 1,
            'is_enabled' => 0,
        ];
    }

    /**
     * 返回table中此id資料, 若無則拋出exception 404
     *
     * @param  Integer $id
     * @return Object
     */
    public function findExist($id)
    {
        $this->throwNotFound('', $exist = $this->repository->getId($id));

        return $exist;
    }

    /**
     * 檢查狀態停用狀態，若啟用中則拋出exception 409
     *
     * @param  Integer $id
     * @return void
     */
    protected function checkIsNotEnabled($id)
    {
        $this->throwNotFound('', $data = $this->repository->getId($id));

        $this->throwIsEnabled(trans('message.http_409'), $data->isEnabled);
    }

    /**
     * 檢查collection中是否有與參數帶入值相同（檢查是否重複）
     *
     * @param  Object $collection
     * @param  String $key
     * @param  String $message
     * @return $this
     */
    protected function collectionNotContain($collection, $key, $message)
    {
        if ($collection->pluck($key)->contains($this->parameter[$key])) {
            $this->throwJobFailed($message);
        };

        return $this;
    }

    /**
     * getEnum
     *
     * @param  String $field
     * @return Array
     */
    public function getEnum(string $field)
    {
        if ($result = $this->repository->getEnum($field)) {
            return $result;
        }
        $this->throwNotFound(trans('message.http_404'));
    }
}
