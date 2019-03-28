<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description','price','author_id',
    ];


    public static $createRules = [
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'price' => 'required|min:1',
        'author_id' => 'required|min:1',
    ];



    public static $updateRules = [
        'title' => 'max:255',
        'description' => 'max:255',
        'price' => 'min:1',
        'author_id' => 'min:1',
    ];





}
