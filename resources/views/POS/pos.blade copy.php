@extends('layouts/contentLayoutMaster')

@section('title', 'POS')
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
@endsection
{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/pos-area.css')}}">
  <style>
    .file-manager-application{
      height: 100%;
    }
  </style>
@endsection
{{-- sidebar included --}}
@section('content-sidebar')
<div class="sidebar-file-manager">
  <div class="sidebar-inner">
    <!-- sidebar menu links starts -->
    <!-- sidebar list items starts  -->
    
    <ul class="list-group-flush list-group">
          <li class="list-group-item d-flex align-items-center justify-content-center">
          @if(!Route::is('point-of-sale-add'))
            <select name="contact" id="cmb-contact" class="form-control" required>
              <option value="">SELECT A CONTACT</option>
            </select>
            <a class="btn btn-success ms-1" onclick="addNewContact()"><i class="fas fa-user-plus"></i></a> 
          
          @else 
          <h3> ADD ITEMS TO <a href="#" onclick="viewSale({{$sale->id}})">#{{str_pad($sale->id,4,'0',STR_PAD_LEFT)}}</a>
          </h3>
          @endif
          
          </li>
    </ul>
    <div class="sidebar-list">
      <!-- <div class="cart-container d-flex flex-column"> -->
      <div class="cart-container">
      <table class="table">
        <tbody id="cart-body">
        </tbody>
      </table>
      </div>

    </div>
    <!-- side bar list items ends  -->
    <!-- sidebar menu links ends -->

    <!-- add file button -->
    <div class="dropdown dropdown-actions d-flex">
      <button
        class="btn btn-primary add-file-btn text-center w-100"
        type="button"
        id="btnProceed"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="true"
      >
        <span class="align-middle">PROCEED</span>
      </button>
      <div class="dropdown-menu text-success" aria-labelledby="btnProceed">
      @if(!Route::is('point-of-sale-add'))
      <a href="#" 
        class="dropdown-item"
        onclick="openCheckout()"
        >
        <!-- class="dropdown-item"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvas-checkout"
        aria-controls="offcanvas-checkout" -->
          <div class="mb-0">
            <i data-feather='check-circle' class="me-25"></i>
            <span class="align-middle">CHECKOUT</span>
          </div>
        </a>

        <a class="dropdown-item" 
        href="#"
        onclick="holdSale()"
        >
          <div for="folder-upload" class="mb-0" >
            <i data-feather="upload-cloud" class="me-25"></i>
            <span class="align-middle">HOLD</span> 
          </div>
        </a>
      @endif
      @if(Route::is('point-of-sale-add'))
      <a href="#" 
        class="dropdown-item"
        onclick="updateSale()"
        >
        <!-- class="dropdown-item"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvas-checkout"
        aria-controls="offcanvas-checkout" -->
          <div class="mb-0">
            <i data-feather='check-circle' class="me-25"></i>
            <span class="align-middle">UPDATE SALE</span>
          </div>
        </a>
        @endif
        <a class="dropdown-item" 
        href="#"
        onclick="viewHoldList()"
        >
          <div for="folder-upload" class="mb-0" >
            <i data-feather="eye" class="me-25"></i>
            <span class="align-middle">VIEW HOLD / DRAFT</span>
          </div>
        </a>
        <div class="dropdown-item text-danger">
          <div class="mb-0" for="file-upload" onclick="clearCart()">
            <i data-feather='trash-2' class="me-25"></i>
            <span class="align-middle">CLEAR CART</span>
          </div>
        </div>
      </div>
      <div class="sidebar-toggle d-block d-xl-none float-start align-middle ms-1">
        <a href="#" class="btn btn-danger"><i class="fas fa-window-close fa-1x"></i></a>
      </div>
    </div>
    <!-- add file button ends -->
  </div>
</div>
@endsection


@section('content')

<!-- overlay container -->
<div class="body-content-overlay"></div>

<div class="file-manager-main-content">
  <div class="file-manager-content-header d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center col-md-8">
      <div class="sidebar-toggle d-block d-xl-none float-start align-middle ms-1">
        <i data-feather="menu" class="font-medium-5"></i>
      </div>
      <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
        <span class="input-group-text border-0">
          <i data-feather="search"></i>
        </span>
        <input type="text" id="txtSearch" class="form-control border-0 bg-transparent" placeholder="Search" />
      </div>
    </div>
    <div class="d-flex align-items-center">
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
          <i data-feather="grid"></i> CODE
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
         <i data-feather='type'></i> NAME
        </label>
      </div>
      <a href="{{route('dashboard-store')}}" class="btn btn-primary ms-50 p-20">
        <i class="fas fa-home"></i>
      </a>
    </div>
  </div>
  <div class="file-manager-content-body"> 
      @livewire('pos.pos-products')
  </div>
</div>

<div class="modal fade" id="modal-cart">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content pt-0">
      <div class="modal-header mb-1"> 
        <h5 class="modal-title">Edit Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body flex-grow-1">    
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-9">
                <input type="number" id="txtCartPrice" step="0.01" class="form-control" placeholder="Price" required/>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Discount</label>
            <div class="col-sm-9">
                <input type="number" id="txtCartDiscount" step="0.01" value="0" class="form-control" placeholder="Discount" required disabled/>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Note</label>
            <div class="col-sm-9">
                <input type="text" id="txtCartNote" class="form-control" placeholder="Note" required/>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-1 me-1 data-submit" onclick="updateCart()">SAVE</button>
        <button type="submit" class="btn btn-danger mt-1 me-1 data-submit" onclick="removeCart()">REMOVE</button>
        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>

@livewire('contact-modal')
@include('POS.checkout')
@include('POS.hold-modal')
@if(Route::is('point-of-sale-add'))
@livewire('sales.sale-details-modal')
@endif
@livewire('products.stock-modal', ['stores'=>$stores])
@endsection

@section('vendor-script')
<script src="{{ asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-file-manager.js')}}"></script>
<script src="{{asset('js/scripts/components/components-popovers.js')}}"></script>
<script src="{{asset('js/cart-localstorage.min.js')}}"></script>
<script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script>

//Search Product
$( "#txtSearch" ).autocomplete({
delay: 400,
source: function( request, response ) {

  let search_type = $(".btn-check:checked").val()

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
    if($(".btn-check:checked").val()=="barcode")
    {
      $('#txtSearch').val(ui.item.barcode)
    }
    else $('#txtSearch').val(ui.item.name)
   // Set selection
    // display the selected text
   $('#itemID').val(ui.item.value) // save selected id to input
   addToCart(ui.item.value)
   $( "#txtSearch" ).select()
}
})
//AutoComplete------------------------------------------------

$("#txtSearch").on('keyup', function (e) {
  let search_method=$(".btn-check:checked").val()
  let search = $( "#txtSearch" ).val()
  if ((e.key === 'Enter' || e.keyCode === 13)) {
    if(search_method=='barcode')
    {
      searchProduct(search,search_method)
    }
    else{
      Livewire.emit('searchProducts',search,search_method)
    }
  }
})

function searchProduct(search, search_method){
  // Fetch data
  $.ajax({
      url:"{{route('product-search-in-pos')}}",
      type: 'post',
      dataType: "json",
      data: {
        _token: CSRF_TOKEN,
        search: search,
        search_method: search_method,
      },
      success: function( data ) {
        let total_row = Object.keys(data).length
        if(!total_row){
          toastMessage('No Products Found','error','Error')
        }
        else if(total_row>1){
          Livewire.emit('searchProducts',search,search_method)
        }
        else{
          addToCart(data[0].value)
        }
      }
    });
}

function showCart(){
    const cart = $('#cart-body')
    const products = cartLS.list()
    // console.log(products)
    var cartArea = ""
    products.map(product=>{
      let image = product.image==null ? 'images/products/d-product.webp' : product.image
      cartArea+=`
          <tr id="cart-item-${product.id}">
            <td style="padding: 0.25rem;">
              <div class="d-flex justify-content-start align-items-center">
                <div class="image-wrapper d-flex">
                  <div class="image me-50 d-inline-flex align-items-center">
                    <img style="border-radius: 50%; object-fit: cover" src="{{ asset('${image}') }}" alt="" width="45" height="45">
                  </div>
                </div>
                <a href="#" onclick="stockAdjustment(${product.id})" class="d-flex flex-column">
                  <h6 class="mb-0">${product.name}</h6>
                  <!-- <small class="text-muted">By Brand</small> -->
                </a>
              </div>
            </td>
            <td style="padding: 0.25rem;">
                <div class="input-group">
                  <input 
                  class="touchspin-cart" 
                  min="0" max="9999" 
                  onchange="cartUpdate(this)" 
                  data-id="${product.id}" 
                  type="number" 
                  value="${product.quantity}" 
                  data-bts-decimals="2">
                </div>
            </td>
            <td style="padding: 0.25rem;" class="text-end">
            <a href="#" onclick="openEditCart(${product.id})">
            <h5 id="item-price-${product.id}" class="cart-item-price mb-0">${Number(product.price * product.quantity).toLocaleString()}
            </h5>
            <small class="cart-item-by" id="item-desc-${product.id}">${product.quantity} X ${product.price}</small>
            </a>
            </td>
          </tr>`
    })
    cart.html(cartArea)
    $('#btnProceed').html('Rs. '+cartLS.total())

    if ($('.touchspin-cart').length > 0) {
    $('.touchspin-cart').TouchSpin({
      max: 99999,
      min: -9999,
      decimals: 2,
      step: 0.01,
      buttondown_class: 'btn btn-primary',
      buttonup_class: 'btn btn-primary',
      buttondown_txt: feather.icons['minus'].toSvg(),
      buttonup_txt: feather.icons['plus'].toSvg()
    })
  } // Do not close cart or notification dropdown on click of the items
    // $('[data-bs-toggle="popover"]').popover()
}

function cartUpdate(cartQty){
let id = $(cartQty).data('id')  
  cartLS.update(id,'quantity',Number($(cartQty).val()))
  var product = cartLS.get(id)
  $('#btnProceed').html('Rs. '+cartLS.total())
  $('#item-price-'+id).html(Number(product.quantity*product.price).toLocaleString())
  $('#item-desc-'+id).html(`${product.quantity} X ${product.price}`)
  if(Number($(cartQty).val())==0){
  cartID = id
  removeCart()
  }
}

showCart()
// Livewire.emit('times',searchTerm) 
function addToCart(productID){
  // alert(productID)
  $.ajax({
    url:"{{route('find-product')}}",
    type: 'POST',
    data: {product:productID, _token: CSRF_TOKEN,},
    dataType: "json",
    success: function( data ) {
       const product = data
       cartLS.add(product,1)
       toastMessage('Item Added','success','info')
       showCart()
    }
  })
}

function clearCart(){
  Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        scrollbarPadding: false,
        heightAuto: false, 
        confirmButtonText: 'Yes, delete it!',
        customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-outline-primary ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if(result.isConfirmed) 
        {
          cartLS.destroy()
          showCart()
          confirmedMessage()
        }
    })
}

function addNewContact(){
  window.livewire.emit('setType','customer')
  $('#modal-contact').modal('show')
}

let cartID = 0

function openEditCart(id){
  let cartRow = cartLS.get(id)
  cartID = id
  $('#txtCartPrice').val(cartRow.price)
  $('#txtCartDiscount').val(cartRow.discount)
  $('#txtCartNote').val(cartRow.note)
  $('#modal-cart').modal('show')
}

function updateCart(){
  let price = $('#txtCartPrice').val()
  let discount = $('#txtCartDiscount').val()
  let note = $('#txtCartNote').val()

  if(price === "" || discount === ""){
    alert('Please fill discount and price field')
  }
  else{
    cartLS.update(cartID, 'price', price)
    cartLS.update(cartID, 'discount', discount)
    cartLS.update(cartID, 'note', note)
    let cartRow = cartLS.get(cartID)
    $('#btnProceed').html('Rs. '+cartLS.total())
    $('#item-price-'+cartID).html(cartRow.quantity*cartRow.price)
    $('#item-desc-'+cartID).html(`${cartRow.quantity} X ${cartRow.price}`)
    toastMessage('Cart Updated','info','info')
    $('#modal-cart').modal('hide')
  }
}

function removeCart(){
  cartLS.remove(cartID)
  $('#cart-item-'+cartID).remove()
  $('#btnProceed').html('Rs. '+cartLS.total())
  toastMessage('Item Removed','error','info')
  $('#modal-cart').modal('hide')
}

function holdSale(){
  if(cartVerify()){
    $.ajax({
        url:"{{route('hold-sale')}}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          cart:JSON.stringify(cartLS.list()),
          total: cartLS.total(),
          contact: $('#cmb-contact').val(),
        },
        dataType: "json",
        success: function( data ) {
           if(data.type=="success"){
            cartLS.destroy()
            showCart()
            toastMessage(data.message,'success','Success')
           }             
        }
      })
  }
}

function viewHoldList(){
  $.post("{{route('hold-list')}}", { _token: CSRF_TOKEN})
  .done(function( data ) {
    let holdList = ""
    data.holdlist.map(hold=>{
      holdList+=`
      <tr>
          <td>${String(hold.id).padStart(4, '0')}</td>
          <td>${hold.name}</td>
          <td>${hold.total}</td>
          <td>${new Date(hold.created_at).toLocaleDateString()}</td>
          <td>
              <a href="#" 
              class="btn btn-sm btn-primary"
              onclick="holdToCart(${hold.id})"
              >SELECT</a>
          </td>
      </tr>
      `
    })
    $('#hold-list').html(holdList)
  })
  $('#modal-holdsale').modal('show')
}

function holdToCart(id){
  $.post("{{route('hold-items')}}", { _token: CSRF_TOKEN, id:id})
  .done(function( data ) {
    cartLS.destroy()
    data.holditems.map(item=>{
      cartLS.add(item,item.quantity)
    })
    console.log(cartLS.list())
    showCart()
    $('#modal-holdsale').modal('hide')
  })
}

//Verify the cart is empty or not
function cartVerify(){
  let contact = $('#cmb-contact').val()
  if ((cartLS.list()).length==0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Cart is Empty',
      scrollbarPadding: false,
      heightAuto: false, 
    })
    return false
  } 
  else if (contact == "" || contact==0) {
    alert ("Please Select a Customer")
    return false
  }
  else return true
}

function stockAdjustment(id){
  window.livewire.emit('findStockProduct',id)
  $('#modal-stock').modal('show')
 }

@if(Route::is('point-of-sale-add'))
// Update Sale ----------------------------------------------------

function updateSale(){
  if ((cartLS.list()).length==0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Cart is Empty',
      scrollbarPadding: false,
      heightAuto: false, 
    })
  }
  else{
    Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to update the sale?",
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
            confirmSaleUpdate()
          }
      })
  }
}

function confirmSaleUpdate(){
  $.ajax({
        url:"{{route('update-sale')}}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          sale_id: {{$sale->id}},
          cart:JSON.stringify(cartLS.list()),
        },
        dataType: "json",
        success: function( data ) {
           if(data.type=="success"){
            cartLS.destroy()
            showCart()
            confirmedMessage()
           }             
        }
      })  
}

function viewSale(id){
  window.livewire.emit('initSale',id)
  $('#modal-saledetails').modal('show')
}

// Update Sale End ------------------------------------------------
@endif

$(function (){
  window.livewire.on('showMessage',message=>{
    toastMessage(message,'success','Done')
    $('#modal-contact').modal('hide')
  })
})
</script>
@stack('custom-scripts')
@endsection
