<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'passport',
        'registration',
        'date_of_birth',
        'person_id'

    ];

    // сторона "много" отношение "1:М", отношение "принадлежит"
    public function person() {
        return $this->belongsTo(person::class);
    }
}
