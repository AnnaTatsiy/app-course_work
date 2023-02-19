<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class malfunction extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name_malfunction',
        'price'
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function repair(){
        return $this->hasMany(repair::class);
    }
}
