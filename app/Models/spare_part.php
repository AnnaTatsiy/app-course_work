<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spare_part extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name_spare_part',
        'price'
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function repairs(){
        return $this->hasMany(repair::class);
    }
}
