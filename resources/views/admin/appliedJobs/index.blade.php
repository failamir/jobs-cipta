@extends('layouts.admin')
@section('content')
@can('applied_job_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.applied-jobs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.appliedJob.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'AppliedJob', 'route' => 'admin.applied-jobs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.appliedJob.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AppliedJob">
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
                            {{ trans('cruds.appliedJob.fields.crew_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.date_of_entry') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.source') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.applied_position') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.d_o_b') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.vaccination_yf') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.vaccination_covid_19') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.cid') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.coc') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.rating_able') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.ccm') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.application_form') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_result') }}
                        </th>
                        <th>
                            {{ trans('cruds.appliedJob.fields.approved_as') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($jobs as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::STATUS_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($job_positions as $key => $item)
                                    <option value="{{ $item->name_position }}">{{ $item->name_position }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::DEPARTMENT_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::VACCINATION_YF_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::VACCINATION_COVID_19_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::CID_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::RATING_ABLE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::CCM_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::APPLICATION_FORM_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\AppliedJob::INTERVIEW_RESULT_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
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
                                {{ $appliedJob->crew_code ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->date_of_entry ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->source ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->applied_position->name_position ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::DEPARTMENT_SELECT[$appliedJob->department] ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->d_o_b ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::VACCINATION_YF_RADIO[$appliedJob->vaccination_yf] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::VACCINATION_COVID_19_SELECT[$appliedJob->vaccination_covid_19] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::CID_SELECT[$appliedJob->cid] ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->coc ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::RATING_ABLE_SELECT[$appliedJob->rating_able] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::CCM_SELECT[$appliedJob->ccm] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::APPLICATION_FORM_SELECT[$appliedJob->application_form] ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->interview_date ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->interview_by ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AppliedJob::INTERVIEW_RESULT_SELECT[$appliedJob->interview_result] ?? '' }}
                            </td>
                            <td>
                                {{ $appliedJob->approved_as ?? '' }}
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



@endsection
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
  let table = $('.datatable-AppliedJob:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection