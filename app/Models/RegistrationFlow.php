<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationFlow extends Model
{
    use SoftDeletes;

    public $table = 'registration_flows';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'job_id',
        'flow',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
