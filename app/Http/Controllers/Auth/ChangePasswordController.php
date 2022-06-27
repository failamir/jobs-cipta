<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Gate;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\Models\Media;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user = auth()->user();
        $user->load('roles');

        // return view('admin.users.edit', compact('roles', 'user'));

        return view('auth.passwords.edit', compact('roles', 'user'));
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $user = auth()->user();
        $user->update($request->all());
        // $user->roles()->sync($request->input('roles', []));
        if ($request->input('resume_cv', false)) {
            if (!$user->resume_cv || $request->input('resume_cv') !== $user->resume_cv->file_name) {
                if ($user->resume_cv) {
                    $user->resume_cv->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_cv'))))->toMediaCollection('resume_cv');
            }
        } elseif ($user->resume_cv) {
            $user->resume_cv->delete();
        }

        if ($request->input('visa', false)) {
            if (!$user->visa || $request->input('visa') !== $user->visa->file_name) {
                if ($user->visa) {
                    $user->visa->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('visa'))))->toMediaCollection('visa');
            }
        } elseif ($user->visa) {
            $user->visa->delete();
        }

        if ($request->input('passport', false)) {
            if (!$user->passport || $request->input('passport') !== $user->passport->file_name) {
                if ($user->passport) {
                    $user->passport->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport'))))->toMediaCollection('passport');
            }
        } elseif ($user->passport) {
            $user->passport->delete();
        }

        if ($request->input('bst_ccm', false)) {
            if (!$user->bst_ccm || $request->input('bst_ccm') !== $user->bst_ccm->file_name) {
                if ($user->bst_ccm) {
                    $user->bst_ccm->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('bst_ccm'))))->toMediaCollection('bst_ccm');
            }
        } elseif ($user->bst_ccm) {
            $user->bst_ccm->delete();
        }
        // $user->update($request->validated());

        return redirect()->route('profile.password.edit')->with('message', __('global.update_profile_success'));
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        return redirect()->route('login')->with('message', __('global.delete_account_success'));
    }
}
