<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Job extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public $table = 'jobs';

    protected $dates = [
        'date_posted',
        'date_expired',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'date_posted',
        'date_expired',
        'job_description',
        'requirement',
        'procedure_recruitment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function jobRegistrationFlows()
    {
        return $this->hasMany(RegistrationFlow::class, 'job_id', 'id');
    }

    public function jobAppliedJobs()
    {
        return $this->hasMany(AppliedJob::class, 'job_id', 'id');
    }

    public function jobMeetings()
    {
        return $this->hasMany(Meeting::class, 'job_id', 'id');
    }

    public function jobJobAlerts()
    {
        return $this->hasMany(JobAlert::class, 'job_id', 'id');
    }

    public function getDatePostedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDatePostedAttribute($value)
    {
        $this->attributes['date_posted'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateExpiredAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateExpiredAttribute($value)
    {
        $this->attributes['date_expired'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
