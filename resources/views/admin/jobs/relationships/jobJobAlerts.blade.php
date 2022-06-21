@can('job_alert_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.job-alerts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.jobAlert.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.jobAlert.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-jobJobAlerts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.jobAlert.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobAlert.fields.candidate') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobAlert.fields.job') }}
                        </th>
                        <th>
                            {{ trans('cruds.job.fields.date_posted') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobAlert.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobAlerts as $key => $jobAlert)
                        <tr data-entry-id="{{ $jobAlert->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $jobAlert->id ?? '' }}
                            </td>
                            <td>
                                {{ $jobAlert->candidate->name ?? '' }}
                            </td>
                            <td>
                                {{ $jobAlert->candidate->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $jobAlert->job->title ?? '' }}
                            </td>
                            <td>
                                {{ $jobAlert->job->date_posted ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\JobAlert::STATUS_SELECT[$jobAlert->status] ?? '' }}
                            </td>
                            <td>
                                @can('job_alert_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.job-alerts.show', $jobAlert->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('job_alert_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.job-alerts.edit', $jobAlert->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('job_alert_delete')
                                    <form action="{{ route('admin.job-alerts.destroy', $jobAlert->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('job_alert_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.job-alerts.massDestroy') }}",
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
  let table = $('.datatable-jobJobAlerts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection