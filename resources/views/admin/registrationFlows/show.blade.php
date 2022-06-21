@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.registrationFlow.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registration-flows.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.registrationFlow.fields.id') }}
                        </th>
                        <td>
                            {{ $registrationFlow->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrationFlow.fields.job') }}
                        </th>
                        <td>
                            {{ $registrationFlow->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.registrationFlow.fields.flow') }}
                        </th>
                        <td>
                            {{ $registrationFlow->flow }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.registration-flows.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection