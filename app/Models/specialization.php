<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialization extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name_specialization'
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function worker(){
        return $this->hasMany(worker::class);
    }
}
