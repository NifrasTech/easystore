<div class="view-container"> 
<!-- {{$some}} -->
@foreach($products as $product)
<a href="Javascript:void(0)" onclick="addToCart({{$product->id}})" class="card file-manager-item file">
<div class="card-img-top file-logo-wrapper d-flex flex-column justify-content-center">
  <div class="d-flex align-items-center justify-content-center w-100">
    <img 
    src='{{ $product->image==null ? asset("/images/products/d-product.webp"):asset($product->image)}}'
    alt="{{$product->name}}" 
    height="80" 
    />
  </div>
</div>
<div class="card-body">
  <div class="content-wrapper">
    <p class="card-text file-name mb-0">{{$product->name}}</p>
    <h5 class="card-text mb-0">Rs. {{$product->price}}</h5>
    <p class="card-text file-date">{{$product->created_at}}</p>
  </div>
  <small class="file-accessed text-muted">{{$product->brand_name}}</small>
  <span class="product-quantity badge bg-primary">{{$product->quantity}}</span>
</div>
</a>
@endforeach

<div class="d-none flex-grow-1 align-items-center no-result mb-3">
<i data-feather="alert-circle" class="me-50"></i>
No Results
</div>

<style>
  .product-quantity{
    position: absolute;
    top: 5px;
    left: 5px;
  }
</style>

</div>



