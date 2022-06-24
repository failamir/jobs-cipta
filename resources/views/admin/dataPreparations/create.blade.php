@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataPreparation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-preparations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">{{ trans('cruds.dataPreparation.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}">
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="akses_file">{{ trans('cruds.dataPreparation.fields.akses_file') }}</label>
                <input class="form-control {{ $errors->has('akses_file') ? 'is-invalid' : '' }}" type="number" name="akses_file" id="akses_file" value="{{ old('akses_file', '') }}" step="1">
                @if($errors->has('akses_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('akses_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.akses_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="akses_video">{{ trans('cruds.dataPreparation.fields.akses_video') }}</label>
                <input class="form-control {{ $errors->has('akses_video') ? 'is-invalid' : '' }}" type="number" name="akses_video" id="akses_video" value="{{ old('akses_video', '') }}" step="1">
                @if($errors->has('akses_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('akses_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.akses_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="akses_forum">{{ trans('cruds.dataPreparation.fields.akses_forum') }}</label>
                <input class="form-control {{ $errors->has('akses_forum') ? 'is-invalid' : '' }}" type="number" name="akses_forum" id="akses_forum" value="{{ old('akses_forum', '') }}" step="1">
                @if($errors->has('akses_forum'))
                    <div class="invalid-feedback">
                        {{ $errors->first('akses_forum') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.akses_forum_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kuis_1">{{ trans('cruds.dataPreparation.fields.kuis_1') }}</label>
                <input class="form-control {{ $errors->has('kuis_1') ? 'is-invalid' : '' }}" type="number" name="kuis_1" id="kuis_1" value="{{ old('kuis_1', '') }}" step="0.01">
                @if($errors->has('kuis_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kuis_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.kuis_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kuis_2">{{ trans('cruds.dataPreparation.fields.kuis_2') }}</label>
                <input class="form-control {{ $errors->has('kuis_2') ? 'is-invalid' : '' }}" type="number" name="kuis_2" id="kuis_2" value="{{ old('kuis_2', '') }}" step="0.01">
                @if($errors->has('kuis_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kuis_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.kuis_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tugas_1">{{ trans('cruds.dataPreparation.fields.tugas_1') }}</label>
                <input class="form-control {{ $errors->has('tugas_1') ? 'is-invalid' : '' }}" type="number" name="tugas_1" id="tugas_1" value="{{ old('tugas_1', '') }}" step="0.01">
                @if($errors->has('tugas_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tugas_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.tugas_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tugas_2">{{ trans('cruds.dataPreparation.fields.tugas_2') }}</label>
                <input class="form-control {{ $errors->has('tugas_2') ? 'is-invalid' : '' }}" type="text" name="tugas_2" id="tugas_2" value="{{ old('tugas_2', '') }}">
                @if($errors->has('tugas_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tugas_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.tugas_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_akhir">{{ trans('cruds.dataPreparation.fields.nilai_akhir') }}</label>
                <input class="form-control {{ $errors->has('nilai_akhir') ? 'is-invalid' : '' }}" type="number" name="nilai_akhir" id="nilai_akhir" value="{{ old('nilai_akhir', '') }}" step="0.01">
                @if($errors->has('nilai_akhir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_akhir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.nilai_akhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dataPreparation.fields.status_1') }}</label>
                <select class="form-control {{ $errors->has('status_1') ? 'is-invalid' : '' }}" name="status_1" id="status_1">
                    <option value disabled {{ old('status_1', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DataPreparation::STATUS_1_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_1', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.status_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dataPreparation.fields.status_2') }}</label>
                <select class="form-control {{ $errors->has('status_2') ? 'is-invalid' : '' }}" name="status_2" id="status_2">
                    <option value disabled {{ old('status_2', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DataPreparation::STATUS_2_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_2', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.status_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dataPreparation.fields.status_3') }}</label>
                <select class="form-control {{ $errors->has('status_3') ? 'is-invalid' : '' }}" name="status_3" id="status_3">
                    <option value disabled {{ old('status_3', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\DataPreparation::STATUS_3_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_3', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataPreparation.fields.status_3_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection