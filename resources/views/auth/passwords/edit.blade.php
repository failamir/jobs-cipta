@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ trans('global.my_profile') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.updateProfile") }}">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}">
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                    </div>
                    {{-- <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="approved" value="0">
                            <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                        </div>
                        @if($errors->has('approved'))
                            <div class="invalid-feedback">
                                {{ $errors->first('approved') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('roles'))
                            <div class="invalid-feedback">
                                {{ $errors->first('roles') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                    </div> --}}
                    <div class="form-group">
                        <label for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                        <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                        @if($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.user.fields.gender') }}</label>
                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', $user->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="age">{{ trans('cruds.user.fields.age') }}</label>
                        <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', $user->age) }}" step="1">
                        @if($errors->has('age'))
                            <div class="invalid-feedback">
                                {{ $errors->first('age') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.age_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="background_experience">{{ trans('cruds.user.fields.background_experience') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('background_experience') ? 'is-invalid' : '' }}" name="background_experience" id="background_experience">{!! old('background_experience', $user->background_experience) !!}</textarea>
                        @if($errors->has('background_experience'))
                            <div class="invalid-feedback">
                                {{ $errors->first('background_experience') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.background_experience_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="resume_cv">{{ trans('cruds.user.fields.resume_cv') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('resume_cv') ? 'is-invalid' : '' }}" id="resume_cv-dropzone">
                        </div>
                        @if($errors->has('resume_cv'))
                            <div class="invalid-feedback">
                                {{ $errors->first('resume_cv') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.resume_cv_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="visa">{{ trans('cruds.user.fields.visa') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('visa') ? 'is-invalid' : '' }}" id="visa-dropzone">
                        </div>
                        @if($errors->has('visa'))
                            <div class="invalid-feedback">
                                {{ $errors->first('visa') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.visa_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="passport">{{ trans('cruds.user.fields.passport') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('passport') ? 'is-invalid' : '' }}" id="passport-dropzone">
                        </div>
                        @if($errors->has('passport'))
                            <div class="invalid-feedback">
                                {{ $errors->first('passport') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.passport_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="bst_ccm">{{ trans('cruds.user.fields.bst_ccm') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('bst_ccm') ? 'is-invalid' : '' }}" id="bst_ccm-dropzone">
                        </div>
                        @if($errors->has('bst_ccm'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bst_ccm') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.bst_ccm_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ trans('global.change_password') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.update") }}">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="title">New {{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="title">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ trans('global.delete_account') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.destroyProfile") }}" onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                    @csrf
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.delete') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection