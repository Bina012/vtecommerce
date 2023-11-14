<?php
namespace App\Repositories;

use DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

class Repository{
    protected $modelClass;

    public function select($select='*'){
        return $this->modelClass->select($select);
    }

    public function with($with=[]){
        return $this->modelClass->with($with);
    }

    public function all(){
        return $this->modelClass->all();
    }

    public function get(){
        return $this->modelClass->get();
    }

    public function count(){
        return $this->modelClass->count();
    }

    public function find($id){
        return $this->modelClass->findOrFail($id);
    }

    public function save($data){
        DB::beginTransaction();
        try{
            $this->modelClass->insert($data);
            DB::commit();
            return true;
        }catch(QueryException $exception){
            DB::rollback();
            return false;
        }
    }

    public function update($id,$data){
        DB::beginTransaction();
        try{
            $record=$this->modelClass->findOrFail($id);
            $record->fill($data)->save();
            DB::commit();
            return $record;
        }catch(QueryExecuted $ex){
            DB::rollback();
            return false;
        }
    }

    public function destroy($id){
        try{
            $this->modelClass->findOrFail($id)->delete();
            return true;
        }catch(QueryExecuted $ex){
            return false;
        }
    }

    public function create($inputs){
        $record= $this->modelClass->create($inputs);
        return $record;
    }

    public function where($field,$operator=null,$value){
        return $this->modelClass->where($field,$operator,$value);
    }

    public function pluck($field,$key){
        return $this->modelClass->pluck($field,$key);
    }
}
