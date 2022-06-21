<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Resume extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public $table = 'resumes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'resume_cv',
        'visa',
        'passport',
        'bst_ccm',
    ];

    protected $fillable = [
        'candidate_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getResumeCvAttribute()
    {
        return $this->getMedia('resume_cv')->last();
    }

    public function getVisaAttribute()
    {
        return $this->getMedia('visa')->last();
    }

    public function getPassportAttribute()
    {
        return $this->getMedia('passport')->last();
    }

    public function getBstCcmAttribute()
    {
        return $this->getMedia('bst_ccm')->last();
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}
