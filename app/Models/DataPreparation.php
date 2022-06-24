<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPreparation extends Model
{
    use SoftDeletes;

    public const STATUS_1_SELECT = [
        'Lulus'       => 'Lulus',
        'Tidak Lulus' => 'Tidak Lulus',
    ];

    public const STATUS_2_SELECT = [
        'Lulus'       => 'Lulus',
        'Tidak Lulus' => 'Tidak Lulus',
    ];

    public const STATUS_3_SELECT = [
        'Lulus'       => 'Lulus',
        'Tidak Lulus' => 'Tidak Lulus',
    ];

    public $table = 'data_preparations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'akses_file',
        'akses_video',
        'akses_forum',
        'kuis_1',
        'kuis_2',
        'tugas_1',
        'tugas_2',
        'nilai_akhir',
        'status_1',
        'status_2',
        'status_3',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
