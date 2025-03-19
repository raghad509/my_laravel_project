<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\HasRolesAndPermissions;

class User extends Authenticatable
{

    use HasRolesAndPermissions;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password','active'
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
        'password' => 'hashed',
    ];
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWhereRole($query,$role_name)
    {
        return $query->whereHas('roles',function($q) use ($role_name){
            return $q->whereIn('name', (array)$role_name)
                    ->orWhereIn('id',(array)$role_name);
        });
    }
    public function scopeWhereRoleNot($query,$role_name)
    {
        return $query->whereHas('roles',function($q) use ($role_name){
            return $q->whereNotIn('name', (array)$role_name)
                    ->WhereNotIn('id',(array)$role_name);
        });
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search,function($q) use ($search){
            return $q->where('name','like',"%$search%" );
        });
    }

    public function scopeWhenRole($query,$role_id)
    {
        return $query->when($role_id,function($q) use ($role_id){
            return $this->scopeWhereRole($q,$role_id);
        });
    }
public function daily_notes(){
    return $this->hasMany(DailyNote::class);
}
public function quetionnaires(){
    return $this->hasMany(Qustionnaire::class);
}
public function specialist_communications(){
    return $this->hasMany(SpecialistCommunication::class);
}
public function notifications(){
    return $this->hasMany(Notification::class);
}
public function diet_and_habits(){
    return $this->hasMany(DietAndHabit::class);
}
public function relaxation_exercises(){
    return $this->hasMany(RelaxationExercise::class);
}
public function phobias(){
    return $this->hasMany(Phobia::class);
}
public function community_messages(){
    return $this->hasMany(CommunityMessage::class);
}
}