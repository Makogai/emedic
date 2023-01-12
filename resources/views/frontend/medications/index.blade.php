@extends('layouts.frontend')
@section('content')
<style>
    .siz{
        font-size: 26px;
    }
    .imaa{
        height:58px;
        width: 58px;
    }
    .hed{
        font-weight: bold;
        margin:0;
    }
    .butn{
        width: 150px;
        height: 120px;
        background: rgb(34,132,117);
        background: linear-gradient(0deg, rgba(34,132,117,0.13489145658263302) 0%, rgba(255,255,255,1) 100%);
        padding-bottom: 25px;
        text-align: center;
        border:0;
        border-radius: 10px;
        font-size: 16px;

    }
    .card{
        border: 0;
    }
    .test1{
        width: 100%;
    }
    .notif{
        
        height: 130px;
        background: rgb(255,255,255);
        background: linear-gradient(180deg, rgba(255,255,255,0.13489145658263302) 0%, rgba(255,255,255,0.23573179271708689) 55%, rgba(143,205,196,0.4066001400560224) 100%);
        position: relative;
        }
    .read{
        height: 130px;
        position:relative;
        
    }
    .proba{
        font-weight: bold;
        margin:0;
        opacity: 0.7;
    }
    .reead{
        margin:0;
        opacity: 0.7;
    }
    .reead-icon{
        opacity: 0.7;
    }
    .blabla{
        position: absolute;
        top:0;
        right: 0;
        font-size: 12px;

    }
    .boticon{
        position:absolute;
        bottom: 0;
        right: 0;
    }
    .heding{
        font-size: 25px;
        
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row justify-content-center heding mb-2">
                <p class="">
                    Propisani lekovi
                </p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row read">
                <div class="blabla pr-2 ">
                    OVDE IDE VREME
                </div>
                <div class="col-4 d-flex mx-auto pt-2 content-align-center align-items-center reead-icon ">
                    <img src="/images/droga1.png" alt="" class="">
                </div>
                <div class="col-8 justify-content-center pl-4 d-flex flex-column test1">
                    <p class="proba">
                        Izvestaj i misljenje
                    </p>
                    <span class="reead">
                        Propisao: Fiip Smolovic
                        Cijena:5,63$
                    </span>             
                </div>
                <div class="boticon pr-2">
                    <img src="/images/boticon.png" alt="">
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
@can('medication_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.medications.massDestroy') }}",
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
  let table = $('.datatable-Medication:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection