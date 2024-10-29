<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function translations()
    {
        return $this->hasMany(PermissionTranslation::class);
    }

    public function getNameAttribute()
    {
        return $this->translations()->where('locale', app()->getLocale())->first()->name ?? null;
    }
}
