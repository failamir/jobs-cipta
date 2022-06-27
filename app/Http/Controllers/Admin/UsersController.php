<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles', 'media'])->get();

        $roles = Role::get();

        return view('admin.users.index', compact('roles', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('resume_cv', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_cv'))))->toMediaCollection('resume_cv');
        }

        if ($request->input('visa', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('visa'))))->toMediaCollection('visa');
        }

        if ($request->input('passport', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport'))))->toMediaCollection('passport');
        }

        if ($request->input('bst_ccm', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('bst_ccm'))))->toMediaCollection('bst_ccm');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
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

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'candidateResumes', 'candidateMeetings', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
