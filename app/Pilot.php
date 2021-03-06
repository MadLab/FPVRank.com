<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'country', 'imagePath', 'imageLocal', 'created_at','multigpId','pilotId'
    ];
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pilotId';
         /**
     *
     * Get a listing of the resource
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(){
        return $this->select('pilotId','name', 'username','created_at','country', 'multigpId')->paginate(12);
    }
     /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text){
        return $this->select('pilotId','name', 'username','created_at', 'country')
        ->where('name', 'LIKE', $text.'%')->orWhere('username', 'LIKE', $text.'%')->orWhere('pilotId', '=', $text)->get();
    }
      /**
     * Get a listing of the resource to fill select input
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillSelect(){
        return $this->select('pilotId','name')->get();
    }
     /**
     * Get a listing of the resource to make public pilot info
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function showInfo($pilotId){
        return $this->select('pilots.name','pilots.username')->get();
    }
    /**
     * Get a listing of the resource for the dashboard
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillTableDashboard($take){
        return $this->select('pilotId','name', 'username','created_at','country')->orderBy('created_at', 'asc')->take($take)->get();
    }

     /**
     * Get a listing of the resource for the public pilot search
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillAutoComplete(){
        return $this->select('name', 'username')->orderBy('name', 'asc')->get();
    }



}
