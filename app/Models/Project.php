<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;
    protected $fillable = ['project_name', 'slug', 'type_id', 'description', 'working_hours', 'co_workers'];
    public function type()
    {
        return $this->belongsTo(Type::class);

    }


    public function tecnologies(){

        return $this->belongsToMany(Technology::class);
    }
}
