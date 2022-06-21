@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.meeting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.id') }}
                        </th>
                        <td>
                            {{ $meeting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.job') }}
                        </th>
                        <td>
                            {{ $meeting->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.candidate') }}
                        </th>
                        <td>
                            {{ $meeting->candidate->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.date_expired') }}
                        </th>
                        <td>
                            {{ $meeting->date_expired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.link') }}
                        </th>
                        <td>
                            {{ $meeting->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Meeting::STATUS_SELECT[$meeting->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection