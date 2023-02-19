<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name_color'
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function car(){
        return $this->hasMany(car::class);
    }
}
