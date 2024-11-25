<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'total_duration',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor para calcular duración si no está almacenada correctamente
    public function getCalculatedDurationAttribute()
    {
        $endTime = $this->end_time ?? now(); // Usa now() si end_time es null
        if ($this->start_time && $endTime) {
            return $endTime->diffInSeconds($this->start_time);
        }
        return 0; // Retorna 0 si no hay tiempos válidos
    }
}
