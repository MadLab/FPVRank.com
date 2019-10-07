<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public $incrementing = false;

    /**
     * The table associated with the model.
     **Model name can't be 'Class'
     * @var string
     */
    protected $table = 'classes';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'classId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classId', 'name', 'description', 'location', 'created_at'
    ];
    /**
     *
     * Get a listing of the resource
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
        return $this->select('classId', 'name', 'description', 'created_at', 'location')->paginate(12);
    }
    /**
     * Get a listing of the resource by name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($text)
    {
        return $this->select('classId', 'name', 'description', 'created_at', 'location')
            ->where('name', 'LIKE', $text . '%')->orWhere('classId', '=', $text)->get();
    }
    /**
     * Get a listing of the resource to fill select input
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillSelect()
    {
        return $this->select('classId', 'name', 'location')->get();
    }
    /**
     * Get a listing of the resource for the dashboard
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fillTableDashboard($take)
    {
        return $this->select('classId', 'name', 'description', 'created_at', 'location')->orderBy('created_at', 'asc')->take($take)->get();
    }
}
