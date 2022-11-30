@php 

function thousand_format($number) {
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}

@endphp

@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/pages/dashboard-ecommerce.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/charts/chart-apex.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
  <div class="row match-height">
    <!-- Stats Vertical Card -->
  <div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-info p-50 mb-1">
            <div class="avatar-content">
            <i class="fas fa-chart-line fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{thousand_format($sales)}}</h4>
          <p class="card-text">SALES</p>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-warning p-50 mb-1">
            <div class="avatar-content">
              <i class="fas fa-truck-loading fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{thousand_format($purchases)}}</h4>
          <p class="card-text">PURCHASES</p>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-danger p-50 mb-1">
            <div class="avatar-content">
              <i class="fas fa-archive fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{thousand_format($products)}}</h4>
          <p class="card-text">PRODUCTS</p>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-primary p-50 mb-1">
            <div class="avatar-content">
            <i class="fas fa-user-friends fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{$customers}}</h4>
          <p class="card-text">CUSTOMERS</p>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-success p-50 mb-1">
            <div class="avatar-content">
            <i class="fas fa-people-carry fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{$suppliers}}</h4>
          <p class="card-text">SUPPLIERS</p>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <div class="avatar bg-light-danger p-50 mb-1">
            <div class="avatar-content">
            <i class="fas fa-money-check fa-2x"></i>
            </div>
          </div>
          <h4 class="fw-bolder">{{$cheques}}</h4>
          <p class="card-text">CHEQUES</p>
        </div>
      </div>
    </div>
  </div>
  <!--/ Stats Vertical Card -->
  </div>

  <div class="row match-height">
   
    <!-- Transaction Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-transaction">
        <div class="card-header">
          <h4 class="card-title">Recent Transactions</h4>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <!-- <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div> -->
          </div>
        </div>
        <div class="card-body">
          @foreach ($recentTrans as $trans)
          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-primary rounded float-start">
                <div class="avatar-content">
                  <i class="fas fa-money-bill"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">{{strtoupper($trans->payment_type)}}</h6>
                <small>{{$trans->created_at}}</small>
              </div>
            </div>
            <div class="fw-bolder">{{thousand_format($trans->amount)}}</div>
          </div>
          @endforeach
          </div>
      </div>
    </div>
    <!--/ Transaction Card -->

    <!-- Transaction Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-transaction">
        <div class="card-header">
          <h4 class="card-title">Recent Sale</h4>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @foreach ($recentSale as $sale)
          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-primary rounded float-start">
                <div class="avatar-content">
                  <i class="fas fa-receipt"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">{{str_pad($sale->id,4,'0',STR_PAD_LEFT)}}</h6>
                <small>{{$sale->created_at}}</small>
              </div>
            </div>
            <div class="fw-bolder">{{thousand_format($sale->total)}}</div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
    <!--/ Transaction Card -->

    <!-- Transaction Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-transaction">
        <div class="card-header">
          <h4 class="card-title">Recent Purchase</h4>
          <div class="dropdown chart-dropdown">
            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        @foreach ($recentPurchase as $purchase)
          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-primary rounded float-start">
                <div class="avatar-content">
                <i class="fas fa-receipt"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">{{str_pad($purchase->id,4,'0',STR_PAD_LEFT)}}</h6>
                <small>{{$purchase->created_at}}</small>
              </div>
            </div>
            <div class="fw-bolder">{{thousand_format($purchase->total)}}</div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
    <!--/ Transaction Card -->
  </div> <!-- Row End -->

  @livewire('dashboard-summary')

</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
<script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/scripts/pages/dashboard-ecommerce.js') }}"></script>
  <script>
  $(function(){
    setTimeout(function () {
      toastr['success'](
        'You have successfully logged in to Easy Store. Now you can start to explore!',
        '👋 Welcome {{ Auth::user()->name }}!',
        {
          closeButton: true,
          tapToDismiss: false,
        }
      )
    }, 2000)
  })
  </script>
@endsection
