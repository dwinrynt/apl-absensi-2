<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function mapel(){
        return $this->belongsToMany(Mapel::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function rfid(){
        return $this->hasOne(Rfid::class);
    }

    public function absensi(){
        return $this->hasMany(absensi::class);
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }

    public static function getUserRole($role, $sekolah){
        $roles = Role::all();
        $users = \App\Models\User::with('roles')->get();
        $userRole = [];

        foreach ($users as $key => $user) {
            if ($user->hasRole($role) && $user->sekolah == $sekolah) {
                $userRole[] = $user;
            }
        }

        return $userRole;
    }

    public function scopeFilter($query, array $filter){
        $query->when($filter['search'] ?? false, function($query, $filter){
            return $query->where('users.name', 'like', '%' . $filter . '%')
                        ->orWhere('users.email', 'like', '%' . $filter . '%')
                        ->orWhere('users.nip', 'like', '%' . $filter . '%');
        });
    }

}
