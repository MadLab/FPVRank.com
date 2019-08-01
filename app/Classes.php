<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    
    /**
     * The table associated with the model.
     **Model name can't be 'Class' 
     * @var string
     */
    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];
       /**
     * 
     * Get a listing of the resource
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('id','name', 'description','created_at')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('id','name', 'description','created_at')
        ->where('name', 'LIKE', $text.'%')->get();
    }
    /**
     * Get a listing of the resource to fill select input
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillSelect(){
        return $this->select('id','name')->get();
    }
}
