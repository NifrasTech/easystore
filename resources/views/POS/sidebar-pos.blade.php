@section('content-sidebar')
<div class="sidebar-file-manager">
  <div class="sidebar-inner">
    <!-- sidebar menu links starts -->
    <!-- sidebar list items starts  -->
    
    <ul class="list-group-flush list-group">
          <li class="list-group-item d-flex align-items-center justify-content-center">
          @if(Route::is('point-of-sale-add')) 
          <h3> EDIT ITEMS 
            <a href="#" onclick="viewSale({{$sale->id}})">#{{str_pad($sale->id,4,'0',STR_PAD_LEFT)}}</a>
          </h3>
          @elseif(Route::is('new-transfer')) <h3> TRANSFER ITEMS </h3>
          @else
            <select name="contact" id="cmb-contact" class="form-control" required>
              <option value="">SELECT A CONTACT</option>
            </select>
            <div class="dropdown">
          <a class="btn btn-success ms-1"
          data-bs-toggle="dropdown">
            <i class="fas fa-folder-open"></i>
          </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li>
                <a class="dropdown-item" onclick="addNewContact()" href="#"><i class="fa fa-user-plus me-1 fa-fw"></i>New Contact</a>
              </li>
              <li><a class="dropdown-item" href="#"><i class="fa fa-user-alt me-1 fa-fw"></i>View Contact</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa fa-user-edit me-1 fa-fw"></i>Edit Contact</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa fa-wallet me-1 fa-fw"></i>Add Payment</a></li>
            </ul> 
            </div>
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
      @if(Route::is('point-of-sale'))
      <a href="#" 
        class="dropdown-item"
        onclick="openCheckout()"
        >
          <div class="mb-0">
            <i data-feather='check-circle' class="me-25"></i>
            <span class="align-middle">CHECKOUT</span>
          </div>
        </a>
        <a class="dropdown-item" href="#" onclick="holdSale()">
          <div for="folder-upload" class="mb-0" >
            <i data-feather="upload-cloud" class="me-25"></i>
            <span class="align-middle">HOLD</span> 
          </div>
        </a>
        <a class="dropdown-item" href="#" onclick="viewHoldList()">
          <div for="folder-upload" class="mb-0" >
            <i data-feather="eye" class="me-25"></i>
            <span class="align-middle">VIEW HOLD / DRAFT</span>
          </div>
        </a>
      @endif
      @if(Route::is('point-of-sale-add'))
      <a href="#" class="dropdown-item" onclick="updateSale()">
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

        @if(Route::is('new-purchase'))
        <a class="dropdown-item" href="#" onclick="openPurchaseModal()">
          <div class="mb-0" >
          <i data-feather="thumbs-up" class="me-25"></i>
            <span class="align-middle">COMPLETE PURCHASE</span> 
          </div>
        </a>
        @endif

        @if(Route::is('new-transfer'))
        <a class="dropdown-item" href="#" onclick="openTransferModal()">
          <div class="mb-0" >
          <i data-feather="truck" class="me-25"></i>
            <span class="align-middle">TRANSFER</span> 
          </div>
        </a>
        @endif

        @if(Route::is('new-quotation'))
        <a class="dropdown-item" href="#">
          <div class="mb-0" >
          <i data-feather="truck" class="me-25"></i>
            <span class="align-middle">QUOTATION</span> 
          </div>
        </a>
        @endif
        
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