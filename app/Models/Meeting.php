<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    public const STATUS_SELECT = [
        'pass' => 'pass',
        'fail' => 'fail',
    ];

    public $table = 'meetings';

    protected $dates = [
        'date_expired',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'job_id',
        'candidate_id',
        'date_expired',
        'link',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function getDateExpiredAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateExpiredAttribute($value)
    {
        $this->attributes['date_expired'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
