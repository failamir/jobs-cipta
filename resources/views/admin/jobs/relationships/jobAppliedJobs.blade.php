@can('applied_job_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.applied-jobs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.appliedJob.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.appliedJob.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-jobAppliedJobs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.candidate') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.job') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.date_posted') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appliedJobs as $key => $appliedJob)
                        <tr data-entry-id="{{ $appliedJob->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $appliedJob->id ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->candidate->name ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->candidate->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->job->title ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->job->date_posted ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::STATUS_SELECT[$appliedJob->status] ?? '' }}
                            </td>
                            <td>
                                @can('applied_job_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.applied-jobs.show', $appliedJob->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('applied_job_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.applied-jobs.edit', $appliedJob->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('applied_job_delete')
                                    <form action="{{ route('admin.applied-jobs.destroy', $appliedJob->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('applied_job_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.applied-jobs.massDestroy') }}",
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
  let table = $('.datatable-jobAppliedJobs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection