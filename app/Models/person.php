<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function client(){
        return $this->hasMany(client::class);
    }

    public function worker(){
        return $this->hasMany(worker::class);
    }
}
