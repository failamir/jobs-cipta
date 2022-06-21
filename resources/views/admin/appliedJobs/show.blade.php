@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appliedJob.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applied-jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.id') }}
                        </th>
                        <td>
                            {{ $appliedJob->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.candidate') }}
                        </th>
                        <td>
                            {{ $appliedJob->candidate->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.job') }}
                        </th>
                        <td>
                            {{ $appliedJob->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::STATUS_SELECT[$appliedJob->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applied-jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection