<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDataPreparationRequest;
use App\Http\Requests\StoreDataPreparationRequest;
use App\Http\Requests\UpdateDataPreparationRequest;
use App\Models\DataPreparation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataPreparationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_preparation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPreparations = DataPreparation::all();

        return view('admin.dataPreparations.index', compact('dataPreparations'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_preparation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataPreparations.create');
    }

    public function store(StoreDataPreparationRequest $request)
    {
        $dataPreparation = DataPreparation::create($request->all());

        return redirect()->route('admin.data-preparations.index');
    }

    public function edit(DataPreparation $dataPreparation)
    {
        abort_if(Gate::denies('data_preparation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataPreparations.edit', compact('dataPreparation'));
    }

    public function update(UpdateDataPreparationRequest $request, DataPreparation $dataPreparation)
    {
        $dataPreparation->update($request->all());

        return redirect()->route('admin.data-preparations.index');
    }

    public function show(DataPreparation $dataPreparation)
    {
        abort_if(Gate::denies('data_preparation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataPreparations.show', compact('dataPreparation'));
    }

    public function destroy(DataPreparation $dataPreparation)
    {
        abort_if(Gate::denies('data_preparation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPreparation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataPreparationRequest $request)
    {
        DataPreparation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
