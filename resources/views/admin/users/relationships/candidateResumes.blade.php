@can('resume_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.resumes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.resume.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.resume.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-candidateResumes">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.resume_cv') }}
                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.visa') }}
                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.passport') }}
                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.bst_ccm') }}
                        </th>
                        <th>
                            {{ trans('cruds.resume.fields.candidate') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resumes as $key => $resume)
                        <tr data-entry-id="{{ $resume->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $resume->id ?? '' }}
                            </td>
                            <td>
                                @if($resume->resume_cv)
                                    <a href="{{ $resume->resume_cv->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($resume->visa)
                                    <a href="{{ $resume->visa->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($resume->passport)
                                    <a href="{{ $resume->passport->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($resume->bst_ccm)
                                    <a href="{{ $resume->bst_ccm->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $resume->candidate->name ?? '' }}
                            </td>
                            <td>
                                {{ $resume->candidate->phone_number ?? '' }}
                            </td>
                            <td>
                                @can('resume_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.resumes.show', $resume->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('resume_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.resumes.edit', $resume->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('resume_delete')
                                    <form action="{{ route('admin.resumes.destroy', $resume->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('resume_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.resumes.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-candidateResumes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection