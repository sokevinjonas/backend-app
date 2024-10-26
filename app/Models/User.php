<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Client;
use App\Models\SyncLog;
use App\Models\Commande;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'matricule_user', 'matricule');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'matricule_user', 'matricule');
    }

    protected static function booted()
    {
        static::created(function ($model) {
            SyncLog::create([
                'table_name' => 'utilisateurs',
                'action' => 'create',
                'record_id' => $model->id,
                'data' => $model->toJson()
            ]);
        });

        static::updated(function ($model) {
            SyncLog::create([
                'table_name' => 'utilisateurs',
                'action' => 'update',
                'record_id' => $model->id,
                'data' => $model->toJson()
            ]);
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
