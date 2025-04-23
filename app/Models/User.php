<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'manager_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function bawahan()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function atasan()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function isSupervisor()
    {
        return in_array($this->role, ['direktur', 'manager_operasional', 'manager_keuangan']);
    }
}