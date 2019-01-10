<?php

namespace App;

use App\Events\UserHasRetrieved;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\User\Relations;
use App\Traits\User\Setters;
use App\Traits\User\Scopes as UserScopes;

class User extends Authenticatable
{
    use Notifiable, Relations, Setters, UserScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'specialization'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => UserHasRetrieved::class,
    ];

    protected $appends = ['append'];

    public function getAppendAttribute()
    {
        return "hello from append with laravel";
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new Scopes\UserScope);
    }



    public function humansDate()
    {
        return $this->created_at->diffForHumans();
    }
}
