<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class brand extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name_brand'
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function car():HasMany{
        return $this->hasMany(car::class);
    }
}
