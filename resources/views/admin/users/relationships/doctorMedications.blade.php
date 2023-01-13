<div class="m-3">
    @can('medication_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.medications.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.medication.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.medication.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-doctorMedications">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.medication.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.medication.fields.doctor') }}
                            </th>
                            <th>
                                {{ trans('cruds.medication.fields.patient') }}
                            </th>
                            <th>
                                {{ trans('cruds.medication.fields.isread') }}
                            </th>
                            <th>
                                {{ trans('cruds.medication.fields.drug') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medications as $key => $medication)
                            <tr data-entry-id="{{ $medication->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $medication->id ?? '' }}
                                </td>
                                <td>
                                    {{ $medication->doctor->name ?? '' }}
                                </td>
                                <td>
                                    {{ $medication->patient->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Medication::ISREAD_RADIO[$medication->isread] ?? '' }}
                                </td>
                                <td>
                                    @foreach($medication->drugs as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('medication_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.medications.show', $medication->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('medication_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.medications.edit', $medication->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('medication_delete')
                                        <form action="{{ route('admin.medications.destroy', $medication->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('medication_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.medications.massDestroy') }}",
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
  let table = $('.datatable-doctorMedications:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection