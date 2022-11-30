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

@include('POS.sidebar-pos')

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
        id="sch_name" 
        autocomplete="off" 
        name="search_mode"
        value="search_name"
        />
        <label class="btn btn-outline-primary p-50 btn-md" for="sch_name">
         <i data-feather='type'></i> NAME
        </label>
      </div>
      <div class="dropdown">
        <a class="btn btn-primary ms-1"
            data-bs-toggle="dropdown">
              <i class="fas fa-align-justify"></i>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="{{route('point-of-sale')}}"><i class="fa fa-cart-plus me-1 fa-fw"></i>New Sale</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('new-purchase')}}"><i class="fa fa-cart-arrow-down me-1 fa-fw"></i>New Purchase</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('new-transfer')}}"><i class="fa fa-truck me-1 fa-fw"></i>New Transfer</a>
          </li>
          <li>
            <a class="dropdown-item" data-bs-toggle='modal',
            data-bs-target='#modal-product' ><i class="fa fa-archive me-1 fa-fw"></i>New Product</a>
          </li>
        </ul>
      </div>
      <a href="{{route('dashboard-store')}}" class="btn btn-secondary ms-1 ">
        <i class="fas fa-home"></i>
      </a>
    </div>
  </div>
  <div class="file-manager-content-body"> 
      @livewire('pos.pos-products')
  </div>
  <hr class="m-0 mb-1"/>
  <div class="content-footer">
  <p class="mb-0 ms-1 me-1">
    <span class="d-block d-md-inline-block">COPYRIGHT &copy;
      <script>document.write(new Date().getFullYear())</script><a class="ms-25" href="#" target="_blank">Easy Store</a>,
      <span class="d-none d-sm-inline-block">All rights Reserved</span>
    </span>
    <span class="float-md-end d-none d-md-block h4">
      <strong>{{Session::get('store_name')}} | </strong>
      @if(Route::is('new-purchase') || Route::is('edit-purchase'))
      <strong>PURCHASE</strong>
      @elseif(Route::is('point-of-sale-add') || Route::is('point-of-sale'))
      <strong>SALE</strong>
      @elseif(Route::is('new-transfer'))
      <strong>TRANSFER</strong>
      @endif

  </span>
  </p>
</div>
</div>

@include('POS.modal-cart')
@livewire('contact-modal')
@include('POS.hold-modal')
@livewire('products.stock-modal', ['stores'=>$stores])
@livewire('products.product-modal')

@if(Route::is('point-of-sale')) @include('POS.checkout') @endif
@if(Route::is('point-of-sale-add')) @livewire('sales.sale-details-modal') @endif
@includeWhen(Route::is('new-purchase'),'POS.purchase-modal')
@includeWhen(Route::is('new-transfer'),'transfers.transfer-modal')

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
@if(Route::is('new-purchase')) let contact_type = "vendor"
@else let contact_type = "customer"
@endif
$(document).ready(function() {
//Contact select box ajax result
$('#cmb-contact').select2({
    // dropdownParent: $(".sidebar-list"),
    dropdownParent: $('#cmb-contact').parent(),
    ajax:{
      url: '{{route("api-contact")}}',
      type: 'POST',
      dataType:'json',

      data: function(params){
          return {
              searchTerm: params.term,
              type: contact_type,
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


//Tracking text box Enter key
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

//Search product items
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
          $('#txtSearch').select()
        }
      }
    });
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
    alert ("Please Select a Contact")
    return false
  }
  else return true 
}

//Show Cart Items in side bar
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
            <td style="padding: 0.80rem;" class="text-end">
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

showCart()

//Update Cart
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

//Add to Cart
function addToCart(productID){
  $.ajax({
    url:"{{route('find-product')}}",
    type: 'POST',
    data: {product:productID, _token: CSRF_TOKEN,},
    dataType: "json",
    success: function( data ) {
       const product = data
       cartLS.add(product,1)

       //Change sale price to cost on purchase
       if(contact_type==="vendor"){
        // let cartRow = cartLS.get(productID)
        cartLS.update(product.id,'price',product.cost)
       }

       toastMessage('Item Added','success','info')
       showCart()
    }
  })
}

//Clear the cart
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

let cartID = 0

//Open Modal of Cart to Edit cart items
function openEditCart(id){
  let cartRow = cartLS.get(id)
  cartID = id
  $('#txtCartPrice').val(cartRow.price)
  $('#txtCartDiscount').val(cartRow.discount)
  $('#txtCartNote').val(cartRow.note)
  $('#modal-cart').modal('show')
}

//Update cart item
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

//Remove the cart item from cart list
function removeCart(){
  cartLS.remove(cartID)
  $('#cart-item-'+cartID).remove()
  $('#btnProceed').html('Rs. '+cartLS.total())
  toastMessage('Item Removed','error','info')
  $('#modal-cart').modal('hide')
}

//Add New Contact Modal
function addNewContact(){
  window.livewire.emit('setType',contact_type)
  $('#modal-contact').modal('show')
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

//View Hold list
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

//Set hold items to cart
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

//Open stock adjustment modal
function stockAdjustment(id){
  window.livewire.emit('findStockProduct',id)
  $('#modal-stock').modal('show')
}

/// #region Update Sale ----------------------------------------------------
@if(Route::is('point-of-sale-add'))
//Show confirmation message for sales update
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

//Sale will be updated after confirmation
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

//View Sale items
function viewSale(id){
  window.livewire.emit('initSale',id)
  $('#modal-saledetails').modal('show')
}
@endif
/// #endregion Update Sale End ------------------------------------------------

$(function (){
  initSelect2()
  window.livewire.on('showMessage',message=>{
    toastMessage(message,'success','Done')
    $('#modal-contact').modal('hide')
    $('#modal-product').modal('hide')
  })
})

function initSelect2(){
  select = $(document.getElementsByClassName("product-select2"))
  select.each(function () {
  var $this = $(this);
  $this.wrap('<div class="position-relative"></div>');
  $this.select2({
    // the following code is used to disable x-scrollbar when click in select input and
    // take 100% width in responsive also
    dropdownAutoWidth: true,
    width: '100%',
    dropdownParent: $this.parent()
  });
  // console.log($this)
})
}
</script>
@stack('custom-scripts')
@endsection
