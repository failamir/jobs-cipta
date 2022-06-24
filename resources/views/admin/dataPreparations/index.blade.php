@extends('layouts.admin')
@section('content')
@can('data_preparation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.data-preparations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataPreparation.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DataPreparation', 'route' => 'admin.data-preparations.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataPreparation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DataPreparation">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_file') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_video') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.akses_forum') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.kuis_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.kuis_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.tugas_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.tugas_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.nilai_akhir') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPreparation.fields.status_3') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPreparations as $key => $dataPreparation)
                        <tr data-entry-id="{{ $dataPreparation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dataPreparation->id ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->nama ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->akses_file ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->akses_video ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->akses_forum ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->kuis_1 ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->kuis_2 ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->tugas_1 ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->tugas_2 ?? '' }}
                            </td>
                            <td>
                                {{ $dataPreparation->nilai_akhir ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DataPreparation::STATUS_1_SELECT[$dataPreparation->status_1] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DataPreparation::STATUS_2_SELECT[$dataPreparation->status_2] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DataPreparation::STATUS_3_SELECT[$dataPreparation->status_3] ?? '' }}
                            </td>
                            <td>
                                @can('data_preparation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.data-preparations.show', $dataPreparation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('data_preparation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.data-preparations.edit', $dataPreparation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('data_preparation_delete')
                                    <form action="{{ route('admin.data-preparations.destroy', $dataPreparation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('data_preparation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-preparations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-DataPreparation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection