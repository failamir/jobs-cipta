@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobPosition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-positions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosition.fields.id') }}
                        </th>
                        <td>
                            {{ $jobPosition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosition.fields.job') }}
                        </th>
                        <td>
                            {{ $jobPosition->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosition.fields.name_position') }}
                        </th>
                        <td>
                            {{ $jobPosition->name_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobPosition.fields.description_position') }}
                        </th>
                        <td>
                            {!! $jobPosition->description_position !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-positions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection