@extends('layouts/contentLayoutMaster')

@section('title', 'Expenses')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
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
      <table class="expenses-list-table table">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Amount</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
        <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->

@livewire('expenses.expense-modal')
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
<script>
let expensesURL = "{{route('show-expenses')}}"

function addNewExpense(){
    $('#modal-expense').modal('show') 
}

@include('panels.confirm-delete')

function deleteExpense(id){
  Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-outline-primary ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if(result.isConfirmed) deleteRow(id)
    })
}

function deleteRow(id){
  $.post( `{{route('delete-expense')}}`, { id: id, _token: CSRF_TOKEN })
  .done(function( data ) {
    confirmedMessage()
    refreshTable()
  })
}

function refreshTable(){
    var table = $('.expenses-list-table').DataTable()
    table.ajax.reload(null,false)
}

$(function () {
    var dtExpensesTable = $('.expenses-list-table')
    
    window.livewire.on('showMessage',message=>{
        toastMessage(message,'info','info')
        $('#modal-expense').modal('hide')
        refreshTable()
    })   

  if (dtExpensesTable.length) {
    dtExpensesTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url:expensesURL = "{{route('show-expenses')}}"
, 
      type:'POST',
      data: function(d){
                  d._token=CSRF_TOKEN;
                  d.from=$('#dtStart').val();
                  d.to=$('#dtEnd').val();
                },
      },
      columns: [
        // columns according to JSON
        { data: 'expense_date'},
        { data: 'description'},
        { data: 'amount',render:function(amount){return Number(amount).toLocaleString()}},
        { data: null, searchable:'false'},
      ],
      columnDefs: [
       {
          // Actions
          targets: 3,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              `<a href="javascript:;" onclick="deleteExpense(${data.id})" class="item-delete ms-50"> <i class="fas fa-trash"></i>`+
              '</a>'
            );
          }
        },
        {
          // Actions
          targets: 2,
          render: function (data, type, full, meta) {
            return `${Number(data).toLocaleString()}`
          }
        }
      ],
      order: [[0, 'DESC']],
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
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1, 2, 3, 4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0,1, 2, 3, 4] }
            },
            {
              extend: 'pdf',
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
        {
          text: 'ADD NEW EXPENSE',
          className: 'add-new btn btn-primary',
          attr: {
            'onclick': 'addNewExpense()',
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
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
        let total = api.column( 2 ).data().sum()
        $( api.column( 2 ).footer() ).html(
          Number(total).toLocaleString()
        )
      }
    });
  }
})
  </script>
@endsection
