<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResumeRequest;
use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use App\Models\Resume;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ResumeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('resume_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resumes = Resume::with(['candidate', 'media'])->get();

        $users = User::get();

        return view('admin.resumes.index', compact('resumes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('resume_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resumes.create', compact('candidates'));
    }

    public function store(StoreResumeRequest $request)
    {
        $resume = Resume::create($request->all());

        if ($request->input('resume_cv', false)) {
            $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_cv'))))->toMediaCollection('resume_cv');
        }

        if ($request->input('visa', false)) {
            $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('visa'))))->toMediaCollection('visa');
        }

        if ($request->input('passport', false)) {
            $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport'))))->toMediaCollection('passport');
        }

        if ($request->input('bst_ccm', false)) {
            $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('bst_ccm'))))->toMediaCollection('bst_ccm');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $resume->id]);
        }

        return redirect()->route('admin.resumes.index');
    }

    public function edit(Resume $resume)
    {
        abort_if(Gate::denies('resume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resume->load('candidate');

        return view('admin.resumes.edit', compact('candidates', 'resume'));
    }

    public function update(UpdateResumeRequest $request, Resume $resume)
    {
        $resume->update($request->all());

        if ($request->input('resume_cv', false)) {
            if (!$resume->resume_cv || $request->input('resume_cv') !== $resume->resume_cv->file_name) {
                if ($resume->resume_cv) {
                    $resume->resume_cv->delete();
                }
                $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('resume_cv'))))->toMediaCollection('resume_cv');
            }
        } elseif ($resume->resume_cv) {
            $resume->resume_cv->delete();
        }

        if ($request->input('visa', false)) {
            if (!$resume->visa || $request->input('visa') !== $resume->visa->file_name) {
                if ($resume->visa) {
                    $resume->visa->delete();
                }
                $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('visa'))))->toMediaCollection('visa');
            }
        } elseif ($resume->visa) {
            $resume->visa->delete();
        }

        if ($request->input('passport', false)) {
            if (!$resume->passport || $request->input('passport') !== $resume->passport->file_name) {
                if ($resume->passport) {
                    $resume->passport->delete();
                }
                $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport'))))->toMediaCollection('passport');
            }
        } elseif ($resume->passport) {
            $resume->passport->delete();
        }

        if ($request->input('bst_ccm', false)) {
            if (!$resume->bst_ccm || $request->input('bst_ccm') !== $resume->bst_ccm->file_name) {
                if ($resume->bst_ccm) {
                    $resume->bst_ccm->delete();
                }
                $resume->addMedia(storage_path('tmp/uploads/' . basename($request->input('bst_ccm'))))->toMediaCollection('bst_ccm');
            }
        } elseif ($resume->bst_ccm) {
            $resume->bst_ccm->delete();
        }

        return redirect()->route('admin.resumes.index');
    }

    public function show(Resume $resume)
    {
        abort_if(Gate::denies('resume_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resume->load('candidate');

        return view('admin.resumes.show', compact('resume'));
    }

    public function destroy(Resume $resume)
    {
        abort_if(Gate::denies('resume_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resume->delete();

        return back();
    }

    public function massDestroy(MassDestroyResumeRequest $request)
    {
        Resume::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('resume_create') && Gate::denies('resume_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Resume();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
