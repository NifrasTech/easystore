@extends('layouts/contentLayoutMaster')

@section('title', 'Categories')

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
      <div class="row">
        <div class="col-md-4">
        	<select 
            class="form-select text-capitalize mb-md-0 mb-2" 
            id="type"
            onchange="refreshTable()"
            >
        		<option value="cat"> Categories </option>
        		<option value="brand">Brands</option>
        	</select>
        </div>
        <div class="col-md-4">
        	<button 
            class="btn btn-success"
            onclick="addNewCategory()"
            >ADD NEW</button>
        </div>
      </div>
    </div>
    <div class="card-datatable table-responsive pt-0 p-2">
      <table class="category-list-table table">
        <thead class="table-light">
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Remove</th>
          </tr>
        </thead>
      </table>
    </div>
    
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@livewire('category-modal')
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
  	let categoriesURL = "{{route('show-categories')}}"
   
    function addNewCategory(){
        let type = $('#type').val()
        window.livewire.emit('setType',type)
        $('#modal-category').modal('show')
    }

    function refreshTable(){
        var table = $('.category-list-table').DataTable()
        $('#modal-category').modal('hide')
        table.ajax.reload(null,false)
    }

    function removeCategory(id){
        let type = $('#type').val()
        $.post( "{{route('delete-category')}}",{ type: type, id: id, _token:CSRF_TOKEN } ,function( data ) {
            refreshTable()
        })
    }

    function editCategory(id){
        let type = $('#type').val()
        window.livewire.emit('findCategory',type,id)
        $('#modal-category').modal('show')
    }

    $(function(){

    window.livewire.on('showMessage',message=>{
        confirmedMessage()
        refreshTable()   
    })

    $('.category-list-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url:categoriesURL, 
        type:'POST',
        data: function(d){d._token=CSRF_TOKEN,d.type=$('#type').val()},
        },
        columns: [
            {data: "code"},
            {data: "name"},
            {data: null, searchable:'false', orderable:'false',render: function(data, type, row){
                return `<a href="javascript:void(0)" onclick="editCategory(${data.id})" class="text-primary">EDIT</a>`
            }},
            {data: null, searchable:'false', orderable:'false',render: function(data, type, row){
                return `<a href="javascript:void(0)" onclick="removeCategory(${data.id})" class="text-danger">REMOVE</a>`
            }}
        ]
        })
    })
  </script>
  
@endsection

