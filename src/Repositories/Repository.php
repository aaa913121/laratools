<?php

namespace Nolin\Laratools\Repositories;

class Repository
{
    protected $model;

    /**
     * create
     *
     * @param  Array $data
     * @return Object
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * find 找到範圍中的資料
     *
     * $field不傳入則搜尋全部
     *
     * @param  Array $field
     * @param  mixed $select
     * @param  Integer $isDeleted
     * @return Object
     */
    public function find($field = null, $select = '*', $isDeleted = 0)
    {
        return $this->model::where(function ($query) use ($field) {
            if ($field) {
                $query->where($field);
            }
        })
            ->where('is_deleted', $isDeleted)
            ->select($select)
            ->get();
    }

    /**
     * findNotInclude
     *
     * 類似find方法, 但多了不搜尋的範圍
     *
     * @param  Array $notInclude
     * @param  Array $field
     * @param  mixed $select
     * @param  Integer $isDeleted
     * @return Object
     */
    public function findNotInclude($notInclude, $field = null, $select = '*', $isDeleted = 0)
    {
        return $this->model::where(function ($query) use ($field, $notInclude) {
            if ($field) {
                $query->where($field);
            }
            foreach ($notInclude as $column => $value) {
                $query->where($column, '!=', $value);
            }
        })
            ->where('is_deleted', $isDeleted)
            ->select($select)
            ->get();
    }

    /**
     * getId 取得單筆id資料
     *
     * @param  Integer $id
     * @param  Integer $isDeleted
     * @return Object
     */
    public function getId($id, $isDeleted = 0)
    {
        return $this->model::where('id', $id)
            ->where('is_deleted', $isDeleted)
            ->first();
    }

    /**
     * update 更新
     *
     * @param  Array $field
     * @param  Array $params
     * @return void
     */
    public function update($field, $params)
    {
        //update若未更新資料會回傳false
        $this->model::where($field)
            ->update($params);

        return true;
    }

    /**
     * getEnum
     *
     * @param  String $field
     * @return Array
     */
    public function getEnum(string $field)
    {
        return $this->model->getEnumJson($field);
    }
}
