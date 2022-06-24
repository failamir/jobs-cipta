@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataPreparation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-preparations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.id') }}
                        </th>
                        <td>
                            {{ $dataPreparation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.nama') }}
                        </th>
                        <td>
                            {{ $dataPreparation->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_file') }}
                        </th>
                        <td>
                            {{ $dataPreparation->akses_file }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_video') }}
                        </th>
                        <td>
                            {{ $dataPreparation->akses_video }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_forum') }}
                        </th>
                        <td>
                            {{ $dataPreparation->akses_forum }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.kuis_1') }}
                        </th>
                        <td>
                            {{ $dataPreparation->kuis_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.kuis_2') }}
                        </th>
                        <td>
                            {{ $dataPreparation->kuis_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.tugas_1') }}
                        </th>
                        <td>
                            {{ $dataPreparation->tugas_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.tugas_2') }}
                        </th>
                        <td>
                            {{ $dataPreparation->tugas_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.nilai_akhir') }}
                        </th>
                        <td>
                            {{ $dataPreparation->nilai_akhir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_1') }}
                        </th>
                        <td>
                            {{ App\Models\DataPreparation::STATUS_1_SELECT[$dataPreparation->status_1] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_2') }}
                        </th>
                        <td>
                            {{ App\Models\DataPreparation::STATUS_2_SELECT[$dataPreparation->status_2] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_3') }}
                        </th>
                        <td>
                            {{ App\Models\DataPreparation::STATUS_3_SELECT[$dataPreparation->status_3] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-preparations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection