@extends('layouts/contentLayoutMaster')

@section('title', 'Contacts')

@section('vendor-style')
  {{-- Page Css files --}}  
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
    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="contact-list-table table">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>City</th>
            <th>Balance</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
    
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@livewire('contact-modal')
@livewire('contact-details')
@livewire('payments.payments-modal')
@endsection

@section('vendor-script')
  @include('panels.datatableScripts')
@endsection

@section('page-script')
<script>
  let contactsURL = "{{route('show-contacts')}}"
  function refreshTable(){
      var table = $('.contact-list-table').DataTable()
      $('#modal-contact').modal('hide')
      table.ajax.reload(null,false)
  }

  function editContact(id){
    window.livewire.emit('findContact',id)
    $('#modal-contact').modal('show')
  }

  function addNewContact(){
    let type = '{{$contact_type}}'
    window.livewire.emit('setType',type)
    $('#modal-contact').modal('show')
  }

  function openPaymentModal($id){
    //$id is Contact ID, 0 is Reference ID
    window.livewire.emit('setAttributes',$id,0)
    $('#modal-payment').modal('show')
  }

  function contactDetails(id){
    window.livewire.emit('initContact',id)
    $('#modal-contactdetails').modal('show')
  }

$(function () {
  window.livewire.on('showMessage',message=>{
    confirmedMessage()
    $('#modal-contact').modal('hide')
    var table = $('.contact-list-table').DataTable()
    table.ajax.reload(null,false)
  })

  var dtContactTable = $('.contact-list-table') 

  // Users List datatable
  if (dtContactTable.length) {
    dtContactTable.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      url:contactsURL, 
      type:'POST',
      data: function(d){
                  d._token=CSRF_TOKEN,
                  d.type = '{{$contact_type}}'
                },
      },
      columns: [
        // columns according to JSON
        { data: 'name'},
        { data: 'contact_no' },
        { data: 'email' },
        { data: 'city' }, //Show full address on popover
        { data: 'balance', render:function(balance){return Number(balance).toLocaleString()}},
        { data: null },
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
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              '<i class="fas fa-bars"></i>' +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              `<a href="javascript:;" onclick="contactDetails(${data.id})" class="dropdown-item">` +
              feather.icons['file-text'].toSvg({ class: 'me-50 font-small-4' }) +
              'Details</a>' +
              `<a href="{{url('/contact/report/')}}/${data.id}" class="dropdown-item"><i class="fas fa-file-invoice me-50"> </i>Report</a>
              <a href="javascript:;" onclick="openPaymentModal(${data.id})" class="dropdown-item"><i class="fas fa-money-bill me-50"> </i>Make Payment</a>` +
              '</div>' +
              '</div>' +
              `<a href="javascript:;" onclick="editContact(${data.id})" class="item-edit"> <i class="fas fa-user-edit"></i>`+
              '<a href="javascript:;" class="item-delete ms-50"> <i class="fas fa-trash"></i>'+
              '</a>'
            );
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
          text: 'Add New Contact',
          className: 'add-new btn btn-primary',
          attr: {
            'onclick': 'addNewContact()',
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
  </script>
@endsection
