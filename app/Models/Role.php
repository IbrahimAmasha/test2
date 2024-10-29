<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    
    public function translations()
    {
        return $this->hasMany(RoleTranslation::class);
    }

    public function getNameAttribute()
    {
        return $this->translations()->where('locale', app()->getLocale())->first()->name ?? null;
    }
}
