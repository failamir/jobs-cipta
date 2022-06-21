<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobAlert extends Model
{
    use SoftDeletes;

    public const STATUS_SELECT = [
        'read'   => 'read',
        'unread' => 'unread',
    ];

    public $table = 'job_alerts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'candidate_id',
        'job_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
