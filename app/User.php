<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'location',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # получить имя и фамилию или только имя
    public function getName()
    {
        if($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->first_name){
            return $this->first_name;
        }

        return null;
    }

    # получить имя и фамилию или логин
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    # получить имя или логин
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    // пользователю принадлежит статус
    public function statuses ()
    {
        return $this->hasmany('App\Status', 'user_id');
    }

    # получить аватарку из граватар
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email)?d=mp&s=40 }}";
    }

    # отношение многие ко многим Мои друзья
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    # отношение многие ко многим Друг
    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    # отношение многие ко многим Получить друзей
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge( $this->friendOf()->wherePivot('accepted', true)->get() );
    }

    # запросы в друзья
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    # запрос на ожидание друга
    public function friendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    # есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user)
    {
        return (bool)$this->friendRequestPending()->where('id', $user->id)->count();
    }

    # получил запрос о дружбе
    public function hasFriendRequestReceived(User $user)
    {
        return (bool)$this->friendRequests()->where('id', $user->id)->count();
    }

    # добавить друга
    public function addfriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    # принять запрос на дружбу
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    # пользователь уже в друзьях
    public function isFriendWith(User $user)
    {
        return (bool)$this->friends()->where('id', $user->id)->count();
    }
}
