<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table="permissions";

    protected $fillable = ['key', 'name', 'description', 'module_id'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function profiles(){
        return $this->belongsToMany('App\Models\UserProfile','role_has_permission','permission_id','profile_id');
    }
}
