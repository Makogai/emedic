@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('doctor_patient_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.doctor-patients.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.doctorPatient.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.doctorPatient.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-DoctorPatient">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctorPatient.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctorPatient.fields.patient') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctorPatient.fields.doctor') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctorPatients as $key => $doctorPatient)
                                    <tr data-entry-id="{{ $doctorPatient->id }}">
                                        <td>
                                            {{ $doctorPatient->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $doctorPatient->patient->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $doctorPatient->doctor->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('doctor_patient_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.doctor-patients.show', $doctorPatient->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('doctor_patient_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.doctor-patients.edit', $doctorPatient->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('doctor_patient_delete')
                                                <form action="{{ route('frontend.doctor-patients.destroy', $doctorPatient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('doctor_patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.doctor-patients.massDestroy') }}",
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
  let table = $('.datatable-DoctorPatient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection