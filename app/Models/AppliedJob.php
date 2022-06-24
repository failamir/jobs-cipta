<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppliedJob extends Model
{
    use SoftDeletes;

    public const CID_SELECT = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const CCM_SELECT = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const RATING_ABLE_SELECT = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const VACCINATION_YF_RADIO = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const APPLICATION_FORM_SELECT = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const STATUS_SELECT = [
        'pass' => 'pass',
        'fail' => 'fail',
    ];

    public const VACCINATION_COVID_19_SELECT = [
        'Y' => 'Y',
        'N' => 'N',
    ];

    public const DEPARTMENT_SELECT = [
        'Deck'   => 'Deck',
        'Engine' => 'Engine',
    ];

    public const INTERVIEW_RESULT_SELECT = [
        'PASSED' => 'PASSED',
        'FAILED' => 'FAILED',
    ];

    public $table = 'applied_jobs';

    public static $searchable = [
        'crew_code',
        'date_of_entry',
        'source',
    ];

    protected $dates = [
        'date_of_entry',
        'd_o_b',
        'interview_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'candidate_id',
        'job_id',
        'status',
        'crew_code',
        'date_of_entry',
        'source',
        'applied_position_id',
        'department',
        'd_o_b',
        'vaccination_yf',
        'vaccination_covid_19',
        'cid',
        'coc',
        'rating_able',
        'ccm',
        'application_form',
        'interview_date',
        'interview_by',
        'interview_result',
        'approved_as',
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

    public function getDateOfEntryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfEntryAttribute($value)
    {
        $this->attributes['date_of_entry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function applied_position()
    {
        return $this->belongsTo(JobPosition::class, 'applied_position_id');
    }

    public function getDOBAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDOBAttribute($value)
    {
        $this->attributes['d_o_b'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getInterviewDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInterviewDateAttribute($value)
    {
        $this->attributes['interview_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
