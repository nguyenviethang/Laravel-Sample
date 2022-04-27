<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $tables = "departments";
    public $fillable = ['name', 'deleted_at', 'description'];

    public function manager()
    {
        return $this->hasOne(User::class)->where('role_id', config('const.ROLE.MANAGE'));
    }

    public function users()
    {
        return $this->hasMany(User::class)->where('role_id', config('const.ROLE.USER'));
    }

    public function allUsers()
    {
        return $this->hasMany(User::class);
    }
}
