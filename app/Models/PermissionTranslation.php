<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
    protected $fillable = ['permission_id', 'locale', 'name'];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
