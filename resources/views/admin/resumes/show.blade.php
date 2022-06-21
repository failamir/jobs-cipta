@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.resume.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resumes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.id') }}
                        </th>
                        <td>
                            {{ $resume->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.resume_cv') }}
                        </th>
                        <td>
                            @if($resume->resume_cv)
                                <a href="{{ $resume->resume_cv->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.visa') }}
                        </th>
                        <td>
                            @if($resume->visa)
                                <a href="{{ $resume->visa->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.passport') }}
                        </th>
                        <td>
                            @if($resume->passport)
                                <a href="{{ $resume->passport->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.bst_ccm') }}
                        </th>
                        <td>
                            @if($resume->bst_ccm)
                                <a href="{{ $resume->bst_ccm->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.resume.fields.candidate') }}
                        </th>
                        <td>
                            {{ $resume->candidate->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.resumes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection