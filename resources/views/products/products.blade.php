@extends('layouts/contentLayoutMaster')

@section('title', 'Products')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dropify/css/dropify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dropify/dropify-demo.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
  <style>
    .file-icon p{
      font-size: 20px;
    }
  </style>
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
@endsection

@section('content')

<section class="app-user-list">
  
@livewire('products.products-summary')

  <div class="card">
    <div class="card-body border-bottom">
      <h4 class="card-title">Search & Filter</h4>
      <div class="row">
        <div class="col-md-4">
        	<label class="form-label">Brand</label>
        	<select 
          class="select2 form-select text-capitalize mb-md-0 mb-2"
          id="cmb-brand">
          <option value="all"> All </option>
        		@foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        	</select>
        </div>  
        <div class="col-md-4">
        	<label class="form-label">Store</label>
        	<select 
          class="select2 form-select text-capitalize mb-md-0 mb-2"
          id="cmb-store">
        		<option value="all"> All </option>
        		@foreach($stores as $store)
            <option value="{{$store->id}}">{{$store->name}}</option>
            @endforeach
        	</select>
        </div>
        <div class="col-md-4">
    <a href="#tbl-products" class="btn btn-primary mt-md-2 d-block m-auto w-100 mb-2" onclick="refreshTable()">
      <i class="fa fa-sync-alt"> </i>
    </a>
  </div>
      </div>
    </div>
    <div class="card-datatable table-responsive pt-0" id="tbl-products">
      <table class="product-list-table table">
        <thead class="table-light">
          <tr>
            <th></th>
            <th>Barcode</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Cost</th>
            <th>Price</th>
            <th>QTY.</th>
            <th>Valuation</th>
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
            <th>Quantity</th>
            <th>Valuation</th>
          </tr>
        </tfoot>
      </table>
    </div>
    @include('products.product-image-modal')
    @livewire('products.product-modal')
    @livewire('products.stock-modal', ['stores'=>$stores])
  </div>
  <!-- list and filter end -->
</section>
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('dropify/js/dropify.min.js') }}"></script>
  @include('panels.datatableScripts')
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
  	let productsURL = "{{route('show-products')}}"

    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })

        $('#image-form').submit(function(e) {

          e.preventDefault();

          var formData = new FormData($(this)[0]);

          $.ajax({
            type:'POST',
            url: "{{ route('image-product')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                toastMessage('Image has been uploaded successfully','success','info')
            },
            error: function(data){
                console.log(data)
              }
            });
          });
    });

     //Show Image Modal
    function openImage(id){
      $('#txtID').val(id)
      $.post( "{{route('find-product')}}",{product:id, _token: CSRF_TOKEN,}, function( data ) {
        let html = `<input type="file" id="input-file-now" name="image" class="dropify p-2" data-default-file="${data.image}" required/>`
        $('#image-container').empty()
        $('#image-container').append(html)
        $('.dropify').dropify()
        $('#modal-image').modal('show')
      })
    }
  </script>

  <script src="{{ asset('/js/scripts/products.js') }}"></script>
@endsection
