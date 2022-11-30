@extends('layouts/contentLayoutMaster')

@section('title', 'Stores')

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
    <div class="card-datatable table-responsive pt-0 p-2">
      <table class="store-list-table table">
        <thead class="table-light">
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Address</th>
            <th>Select</th>
            <th>Remove</th>
          </tr>
        </thead>
      </table>
    </div>
    
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@livewire('store-modal')
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
  	let storesURL = "{{route('show-stores')}}"
    
    function addNewStore(){
      @if($user->role_id == 1)
        window.livewire.emit('newStore')
        $('#modal-store').modal('show')
      @else toastMessage('You cannot add new store','info','Info')
      @endif

    }

    function refreshTable(){
        var table = $('.store-list-table').DataTable()
        $('#modal-store').modal('hide')
        table.ajax.reload(null,false)
    }

    function removeStore(id){
        $.post( "{{route('delete-store')}}",{ id: id, _token:CSRF_TOKEN } ,function( data ) {
            alert(data.message)
            refreshTable()
        })
    }

    function editStore(id){
        window.livewire.emit('findStore',id)
        $('#modal-store').modal('show')
    }

    $(function(){

    window.livewire.on('showMessage',message=>{
        alert(message)
        refreshTable()   
    })

    $('.store-list-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url:storesURL, 
        type:'POST',
        data: function(d){d._token=CSRF_TOKEN},
        },
        columns: [
            {data: "code"},
            {data: "name"},
            {data: "address"},
            {data: null, searchable:'false', orderable:'false', render: function(data, type, row){
              if(data.id == {{Session::get('store_id')}}){
                return `<button class="btn btn-primary" type="submit">SELECTED</button>`
              }
              return `<a type="button" class="btn btn-outline-primary" href="{{url('select/store')}}/${data.id}">SELECT</a>`
            }},
            {data: null, searchable:'false', orderable:'false',render: function(data, type, row){
                return `<a href="javascript:void(0)" onclick="removeStore(${data.id})" class="text-danger">REMOVE</a>`
            }}
        ],
        columnDefs: [
          {
            targets: 1,
            // responsivePriority: 4,
            render: function (data, type, row, meta) {
              return `<a href="#" onclick="editStore(${row.id})"> ${data} </a>`
            },
          }
        ],
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
        buttons: [  
          {
            text: 'ADD NEW STORE',
            className: 'add-new btn btn-primary',
            attr: {
              'onclick': 'addNewStore()',
            },
            init: function (api, node, config) {
              $(node).removeClass('btn-secondary');
            }
          }
        ],
        })
    })
  </script>
  
@endsection

