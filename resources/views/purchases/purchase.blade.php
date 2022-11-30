@extends('layouts/contentLayoutMaster')

@section('title', 'New Purchase')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}"> 
@endsection
@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">ADD NEW PURCHASE</h4>
      </div>
      <div class="card-body">
      <form class="" method="POST">
            <div class="row mb-md-1">
              <div class="col-md-6">
                <label class="form-label">Store</label>
                <select 
          class="select2 form-select text-capitalize mb-md-0 mb-2"
          id="cmb-store">
                <option value="">SELECT A STORE</option>
        		@foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Supplier:</label>
                <select name="contact" id="cmb-contact" class="form-control" required>
                    <option value="">Select Supplier</option>
                </select>
              </div>
            </div>
            <div class="row mb-md-1">
            <div class="col-md-6">
                <label class="form-label">Ref #:</label>
                <input type="text" id="txt-ref" class="form-control dt-input" data-column="3" 
                placeholder="Bill No / Invoice No" data-column-index="2">
              </div>
              <div class="col-md-6">
                <label class="form-label">Date:</label>
                <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
              </div>
            </div>
            <div class="row mb-md-1">
              <div class="col-md-12">
                <label class="form-label">Note:</label>
                <input type="text" id="txt-note" class="form-control" data-column="3" 
                placeholder="Note..." data-column-index="2">
              </div>
            </div>
            <div class="row mb-md-1">
            <div class="col-md-12 d-flex align-items-center mt-2">
            <a href="#" class="btn btn-success me-1"><i class="fas fa-plus"></i></a>
            <div class="input-group input-group-merge">
            <span class="input-group-text" ><i data-feather="search"></i></span>
            <input
              id="txtSearch"
              type="text"   
              class="form-control"
              placeholder="Search..."
              aria-label="Search..."
              aria-describedby="basic-addon-search1"
            />
          </div>
          <div class="align-items-center">
      <div class="btn-group view-toggle ms-50" role="group">
        <input
          type="radio"
          class="btn-check"
          name="view-btn-radio"
          id="sch_barcode"
          checked
          autocomplete="off"
          name="search_mode"
          value="barcode"
        />
        <label class="btn btn-outline-primary p-50 btn-md" for="sch_barcode">
        <i class="fas fa-barcode"></i>
        </label>
        <input 
        type="radio" 
        class="btn-check" 
        name="view-btn-radio" 
        id="sch_name" 
        autocomplete="off" 
        name="search_mode"
        value="search_name"
        />
        <label class="btn btn-outline-primary p-50 btn-md" for="sch_name">
         <i data-feather='type'></i>
        </label>
      </div>
    </div>
              </div>
            </div>
        </form>
      </div>

          
            @livewire("purchase-cart")  
    </div>
  </div>

  <div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p>Do you really want to clear?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="window.livewire.emit('clearCart')" class="btn btn-danger" data-bs-dismiss="modal">Yes, Clear</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>   
<script src="{{asset('js/purchase-localcart.js')}}" type="text/javascript"></script>   
<script>
let findProduct = "{{route('find-product')}}"
$(document).ready(function() {

//Search Product
$( "#txtSearch" ).autocomplete({
delay: 400,
source: function( request, response ) {
  // Fetch data
  $.ajax({
    url:"{{route('product-search-in-pos')}}",
    type: 'post',
    dataType: "json",
    data: {
       _token: CSRF_TOKEN,
       search: request.term,
       search_method: $(".btn-check:checked").val(),
    },
    success: function( data ) {
       response( data )
    }
  });
},
focus: function( event, ui ) {
  $(this).val(ui.item.label);
  return false;
},
select: function (event, ui) {
    event.preventDefault();
   // Set selection
   $('#txtSearch').val(ui.item.label) // display the selected text
   $('#itemID').val(ui.item.value) // save selected id to input
   addToPurchaseCart(ui.item.value)
   $( "#txtSearch" ).select()
}
})
//AutoComplete------------------------------------------------

$('.flatpickr-basic').flatpickr()
$('#cmb-contact').select2({
  ajax:{
      url: '{{route("api-contact")}}',
      type: 'POST',
      dataType:'json',

      data: function(params){
          return {
              searchTerm: params.term,
              type:'vendor',
              _token: CSRF_TOKEN
          }
      },
      processResults: function(response){
      // var select2Data = $.map(response.data, function(obj) {
      //    obj.id = obj._id.$id
      //    obj.text = obj.name
      //    return obj
      // })
      return {
          results: response
      }
      },
      cach: false
  }, 
})

})

function completePurchase(){
  $.post( 
  "{{route('store-purchase')}}", 
  {
    _token: CSRF_TOKEN,
    contact_id: $('#cmb-contact').val(), 
    store_id: $('#cmb-store').val(),
    reference: $('#txt-ref').val(),
    purchase_date: $('#fp-default').val(),
    note: $('#txt-note').val(),
    total: $('#txt-total').val(),
    discount: $('#txt-discount').val()}).done(function( result ) 
  {
      if(result.type=="success"){
        alert(result.message)
        location.reload()
      }
  })
}
</script>
@endsection
