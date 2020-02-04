<?php

namespace App\Repositories;

use Config;

abstract class Repository {
    protected $model = FALSE;

    //получение всех записей модели
    public function get($select = '*', $take = FALSE, $pagination = FALSE, $where = FALSE){
        $builder = $this->model->select($select);

        if ($take){
            $builder->take($take);
        }

        if ($where){
            $builder->where($where[0], $where[1]);
        }

        if($pagination){
            return $this->check($builder->paginate($pagination));
        }


        return $this->check($builder->get());
    }// get()


    public function check($result){
        if($result->isEmpty()){
            return FALSE;
        }
        return $result;
    }//check($result)

}

