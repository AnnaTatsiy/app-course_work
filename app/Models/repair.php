<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repair extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'date_of_detection',
        'date_of_correction',
        'is_fixed',
        'malfunction_id',
        'worker_id',
        'car_id',
        'client_id',
        'spare_part_id'
    ];

    // сторона "много" отношение "1:М", отношение "принадлежит"
    public function malfunction() {
        return $this->belongsTo(malfunction::class);
    }

    public function worker(){
        return $this->belongsTo(worker::class);
    }

    public function car(){
        return $this->belongsTo(car::class);
    }

    public function client(){
        return $this->belongsTo(client::class);
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(person::class, 'client_id', 'id','person');
    }

    public function spare_part(){
        return $this->belongsTo(spare_part::class);
    }
}
