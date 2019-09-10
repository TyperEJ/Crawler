<?php

namespace App\Models\Entities;

use App\Models\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class LineMember extends Model implements AuthenticatableContract,JWTSubject
{
    use Authenticatable;

    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'channel_secret',
        'channel_token',
    ];

    protected $hidden = ['created_at','updated_at'];

    public function keywords()
    {
        return $this->hasMany(MemberBoardKeyword::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
