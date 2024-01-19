<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IoPessoa extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const OPERACAO_RADIO = [
        '1' => 'entrada',
        '0' => 'saida',
    ];

    public $table = 'io_pessoas';

    protected $dates = [
        'data_hora',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data_hora',
        'operacao',
        'responsavel_user_id',
        'user_id',
        'secao_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDataHoraAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDataHoraAttribute($value)
    {
        $this->attributes['data_hora'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function responsavel_user()
    {
        return $this->belongsTo(User::class, 'responsavel_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function secao()
    {
        return $this->belongsTo(Seco::class, 'secao_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
