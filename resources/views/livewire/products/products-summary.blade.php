<div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{number_format($products->total)}}</h3>
            <span>Total Products</span>
          </div>
          <a href="#tbl-products" onclick="alertProducts(false)" class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i class="fas fa-cubes fa-2x"></i>
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{$products->alert}}</h3>
            <span>Alert Products</span>
          </div>
          <a href="#tbl-products" onclick="alertProducts(true)" class="avatar bg-light-danger p-50">
            <span class="avatar-content">
            <i class="fas fa-cubes fa-2x"></i>
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{number_format($products->valuation)}}</h3>
            <span>Total Valuation</span>
          </div>
          <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
            <i class="fas fa-cubes fa-2x"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">{{number_format($products->quantity)}}</h3>
            <span>Total Quantity</span>
          </div>
          <div class="avatar bg-light-warning p-50">
            <span class="avatar-content">
            <i class="fas fa-cubes fa-2x"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>