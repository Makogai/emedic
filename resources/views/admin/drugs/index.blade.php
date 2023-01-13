@extends('layouts.admin')
@section('content')
@can('drug_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.drugs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.drug.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.drug.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Drug">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.drug.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.drug.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.drug.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.drug.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drugs as $key => $drug)
                        <tr data-entry-id="{{ $drug->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $drug->id ?? '' }}
                            </td>
                            <td>
                                {{ $drug->name ?? '' }}
                            </td>
                            <td>
                                {{ $drug->weight ?? '' }}
                            </td>
                            <td>
                                @if($drug->image)
                                    <a href="{{ $drug->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $drug->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('drug_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.drugs.show', $drug->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('drug_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.drugs.edit', $drug->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('drug_delete')
                                    <form action="{{ route('admin.drugs.destroy', $drug->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('drug_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.drugs.massDestroy') }}",
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
  let table = $('.datatable-Drug:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection