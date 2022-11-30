@extends('layouts/contentLayoutMaster')

@section('title', 'Transfers')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
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
      
    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="transfers-list-table table">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Ref</th>
            <th>From</th>
            <th>To</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->

@include('transfers.transfer-items')

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
let transfersURL = "{{route('show-transfers')}}"

function refreshTable(){
    var table = $('.transfers-list-table').DataTable()
    table.ajax.reload(null,false)
}

function addNewTransfer(){
  window.location.replace("{{route('new-transfer')}}")
}

function showItems(id){
  $.post("{{route('transfer-items')}}", { _token: CSRF_TOKEN, id:id})
  .done(function( data ) {
    let transferItems = ""
    data.transferItems.map(item=>{
      transferItems+=`
      <tr>
          <td>${item.name}</td>
          <td>${item.quantity}</td>
      </tr>
      `
    })
    $('#transfer-list').html(transferItems)
  })
  $('#modal-transferitems').modal('show')
}

$(function () {
  var dtTransferTable = $('.transfers-list-table') 

  if (dtTransferTable.length) {
    dtTransferTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url:transfersURL, 
      type:'POST',
      data: function(d){
                  d._token=CSRF_TOKEN
                },
      },
      columns: [
        // columns according to JSON
        { data: 'transfer_date'},
        { data: 'reference'},
        { data: 'from_store'},
        { data: 'to_store' },
        { data: 'status' },
        { data: null, searchable:'false'},
      ],
      columnDefs: [
        {
          // Actions
          targets: 5,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              `<a href="javascript:;" class="ms-50" onclick="showItems(${data.id})"> <i class="fas fa-eye"></i> </a>`+
              '<a href="javascript:;" class="item-delete ms-50"> <i class="fas fa-trash"></i> </a>'
            );
          }
        },
        {
          // Status
          targets: 4,
          orderable: false,
          render: function (data, type, row, meta) {
            let status = "btn btn-sm btn-success"
            if(data=='Pending') status = "btn btn-sm btn-primary"
            return (`<a href="#" class="${status}" onclick="updateTransferStatus(${row.id},'${data}')">${data}</a>`);
          }
        }
      ],
      order: [[1, 'desc']],
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
              exportOptions: { columns: [1, 2, 3, 4, 5] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5] }
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
          text: 'Add New Transfer',
          className: 'add-new btn btn-primary',
          attr: {
            'onclick': 'addNewTransfer()',
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
    });
  }
})

function updateTransferStatus(id,status){
Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to update the transfer status?`,
        icon: 'warning',
        showCancelButton: true,
        scrollbarPadding: false,
        heightAuto: false, 
        confirmButtonText: 'Yes, Update',
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-outline-primary ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if(result.isConfirmed) 
        {
          confirmedStatus(id)
        }
    })
}

function confirmedStatus(id){
  $.post("{{route('update-transfer-status')}}", { _token: CSRF_TOKEN, id:id})
  .done(function( data ) {
    Swal.fire({
      icon: 'success',
      title: 'success',
      text: 'Status Updated',
      scrollbarPadding: false,
      heightAuto: false, 
    })
    refreshTable()
  })
}
  </script>
@endsection
