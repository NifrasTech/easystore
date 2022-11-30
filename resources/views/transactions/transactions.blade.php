@extends('layouts/contentLayoutMaster')

@section('title', 'Transactions')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
    @include('panels.cmn-filter')
    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="transactions-list-table table">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Payment Type</th>
            <th>Contact</th>
            <th>Amount</th>
            <th>Note</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
<script>
let transactionsURL = "{{route('show-transactions')}}"

function refreshTable(){
    var table = $('.transactions-list-table').DataTable()
    table.ajax.reload(null,false)
}

$(function () {
  var dtTransactionTable = $('.transactions-list-table') 

  if (dtTransactionTable.length) {
    dtTransactionTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url:transactionsURL, 
      type:'POST',
      data: function(d){
                  d._token=CSRF_TOKEN;
                  d.from=$('#dtStart').val();
                  d.to=$('#dtEnd').val();
                },
      },
      columns: [
        // columns according to JSON
        { data: 'created_at'},
        { data: 'payment_type'},
        { data: 'name'},
        { data: 'amount', render:function(amount){return Number(amount).toLocaleString()}},
        { data: 'note'},
        { data: null, searchable:'false'},
      ],
      columnDefs: [
        // {
        //   targets: 0,
        //   responsivePriority: 4,
        //   render: function (data, type, full, meta) {
        //     return `<a href="#" onclick="editContact(${data.id})"> ${data.name} </a>`
        //   }
        // },

        {
          // Actions
          targets: 5,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a href="javascript:;" class="item-delete ms-50"> <i class="fas fa-trash"></i>'+
              '</a>'
            );
          }
        }
      ],
      order: [[0, 'desc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print', footer: 'true',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1, 2, 3, 4] }
            },
            {
              extend: 'excel', footer: 'true',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1, 2, 3, 4] }
            },
            {
              extend: 'pdf', footer: 'true',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1, 2, 3, 4] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
            }, 50);
          }
        },
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      "footerCallback": function ( row, data, start, end, display ){
        var api = this.api(), data;
        let total = api.column( 3 ).data().sum()
        $( api.column( 3 ).footer() ).html(
          Number(total).toLocaleString()
        )
      }
    });
  }
})
  </script>
@endsection
