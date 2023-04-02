<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'users';
    protected $fillable = [
        'id',
        'Name',
        'Surname',
        'Patronymic',
        'Date_of_birth',
        'Gender',
        'ID_post',
        'Password'
    ];

    protected static function booted()
    {
        static::created(function ($doctors) {
            $doctors->save();
        });
    }

}