@extends('layouts/contentLayoutMaster')

@section('title', 'Purchases')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
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
      <table class="purchases-list-table table">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Reference</th>
            <th>Supplier/Vendor</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Status</th>
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
            <th></th>
            </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@livewire('purchase-details-modal')
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
let purchasesURL = "{{route('show-purchases')}}"
function refreshTable(){
    var table = $('.purchases-list-table').DataTable()
    table.ajax.reload(null,false)
}

function addNewPurchase(){
    window.location.replace("{{route('new-purchase')}}")
}

$(function () {
  var dtPurchaseTable = $('.purchases-list-table') 

  if (dtPurchaseTable.length) {
    dtPurchaseTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url:purchasesURL, 
      type:'POST',
      data: function(d){
                  d._token=CSRF_TOKEN;
                  d.from=$('#dtStart').val();
                  d.to=$('#dtEnd').val();
                },
      },
      columns: [
        // columns according to JSON
        { data: 'purchase_date'},
        { data: 'reference'},
        { data: 'contact', name:'contacts.name'},
        { data: 'total', render:function(total){return Number(total).toLocaleString()}},
        { data: 'discount' },
        { data: 'status' },
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
          targets: 1,
          render: function (data, type, row, meta) {
            return (`<a href="#" onclick="viewPurchase(${row.id})">${String(data).padStart(4, '0')}</a>`);
          }
        },
        {
          // Actions
          targets: 5,
          render: function (data, type, row, meta) {
            let status = "btn btn-sm btn-success"
            if(data=='Open') status = "btn btn-sm btn-primary"
            return (`<a href="#" class="${status}" onclick="updatePurchaseStatus(${row.id},'${data}')">${data}</a>`);
          }
        },
        {
          // Actions
          targets: 6,
          title: 'Actions',
          orderable: false,
          className: "text-center",
          render: function (data, type, full, meta) {
            let edit=""
            if(data.status=='Open')
            {edit=`<a href="{{url('/pos/${data.id}/purchase')}}" class="item-edit"> <i class="fas fa-edit"></i>`}
            return (
              '<div class="d-inline-flex text-center">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              '<i class="fas fa-folder-open"></i>' +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:;" class="dropdown-item"><i class="fas fa-money-bill me-50"></i>Payment</a>' +
              '</div>' +
              '</div>' + edit
            );
          }
        }
      ],
      order: [[1, 'ASC']],
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
          text: 'Add New Purchase',
          className: 'add-new btn btn-primary',
          attr: {
            'onclick': 'addNewPurchase()',
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
        let total = api.column( 3 ).data().sum()
        let discount = api.column( 4 ).data().sum()
        $( api.column( 3 ).footer() ).html(
          Number(total).toLocaleString()
        )
        $( api.column( 4 ).footer() ).html(
          Number(discount).toLocaleString()
        )
      }
    });
  }
})

function updatePurchaseStatus(id,status){
  
  if(status=='Open') status = 'Close'
  else status = 'Open'
  Swal.fire({
          title: 'Are you sure?',
          text: `Do you want to ${status} the purchase?`,
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
  $.post("{{route('update-purchase-status')}}", { _token: CSRF_TOKEN, id:id})
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

@stack('custom-scripts')
@endsection
