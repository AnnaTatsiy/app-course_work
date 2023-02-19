<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class worker extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'workers_category',
        'experience',
        'person_id',
        'specialization_id'
    ];

    // сторона "много" отношение "1:М", отношение "принадлежит"
    public function specialization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(specialization::class);
    }

    public function person(){
        return $this->belongsTo(person::class);
    }
}
