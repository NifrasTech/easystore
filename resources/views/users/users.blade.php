@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
  <!-- list and filter start -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="user-list-table table">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>User Name</th>
            <th>Role</th>
            <th>Store</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
</section>
<!-- users list ends -->
@livewire('users.user-modal')

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
    function addNewUser(){
      $('#modal-user').modal('show')
    }

  function editUser(id){
    window.livewire.emit('findUser',id)
    $('#modal-user').modal('show')
  }

  function refreshTable(){
    var table = $('.user-list-table').DataTable()
    table.ajax.reload(null,false)
  }

    $(function () {
      window.livewire.on('showMessage',message=>{
        toastMessage(message, 'success', 'Done')
        $('#modal-user').modal('hide')
        refreshTable()
      })

      let userURL = "{{route('show-users')}}"
      var dtUserTable = $('.user-list-table')

      if (dtUserTable.length) {
        dtUserTable.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url:userURL, 
        type:'POST',
        data: function(d){
                    d._token=CSRF_TOKEN
                  },
        },
        columns: [
          // columns according to JSON
          { data: 'name'},
          { data: 'username'},
          { data: 'role', name:'user_roles.role'},
          { data: 'store_name', name:'stores.name'},
          { data: 'email' },
          { data: 'created_at'},
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
            targets: 6 ,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              return (
                `<a href="javascript:;" onclick="editUser(${data.id})" class="item-edit"> <i class="fas fa-edit"></i>`+
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
            text: 'Add New User',
            className: 'add-new btn btn-primary',
            attr: {
              'onclick': 'addNewUser()',
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
                return col.columnIndex !== 7 // ? Do not show row in modal popup if title is blank (for check box)
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
