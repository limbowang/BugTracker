<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * User
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property boolean $is_admin
 * @property string $avatar
 * @property string $question
 * @property string $answer
 * @property string $last_login_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\bug[] $bugs
 * @property-read \Illuminate\Database\Eloquent\Collection|\comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\activity[] $activities
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'answer');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken() {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName() {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * Get if the user is admin..
     *
     * @return boolean
     */
    public function isAdmin() {
        return $this->is_admin;
    }

    public function bugs() {
        return $this->hasMany('bug');
    }

    public function comments() {
        return $this->hasMany('comment');
    }

    public function posts() {
        return $this->hasMany('post');
    }

    public function replies() {
        return $this->hasMany('reply');
    }

    public function activities() {
        return $this->hasMany('activity');
    }
}
