<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>Contact Report</title>
<meta name="author" content="invoice">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/stylesheet.css')}}"/>
<link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}">
<style>
  .invoice-container{
    padding: 20px 60px;
  }
</style>
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    <div class="col-sm-3 text-center text-sm-start mb-3 mb-sm-0">
      <img id="logo" style="max-height:100px; max-width:100px" src="{{asset('thumbnail/'.$setting->logo)}}" title="Logo"/>
    </div>
    <div class="col-sm-9 text-center text-sm-end">
      <h4 class="text-7 mb-0">SUMMARY REPORT</h4>
    </div>
  </div>
  <hr>
  </header>
  
  <!-- Main Content -->
  <main>
  <div class="row">
    <div class="col-sm-6 text-sm-start"><strong>Customer: </strong>{{$contact->name}}</div>
    <div class="col-sm-6 text-sm-end"><strong>Date:</strong> {{date("Y-m-d")}}</div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12 text-sm-center">
      <address>
      {{$setting->address}} | {{$setting->contact_no}}
      </address>
    </div>
  </div>
	
  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
		<thead class="card-header">
          <tr>
            <td class="col-1"><strong>#</strong></td>
			<td class="col-4"><strong>Description</strong></td>
            <td class="col-2 text-end">
              @if($contact->is_supplier) <strong>Purchase</strong>
              @else <strong>Sale</strong>
              @endif
          </td>
			<td class="col-1 text-end">
      <strong>Paid</strong>
      </td>
          </tr>
        </thead>
          <tbody>
            @php $num = 0; $sale = 0; $recieved = 0; @endphp
            @foreach ($summary as $record)
            <tr>
              <td class="col-1">{{++$num}}</td>
              <td class="col-4 text-1">
                {{date("m/d/Y",strtotime($record->created_at))}} - 
                @if(!$record->is_pay) 
                  @if($contact->is_supplier) PUR/{{str_pad($record->transid,4,'0',STR_PAD_LEFT)}}
                  @else SALE/{{str_pad($record->transid,4,'0',STR_PAD_LEFT)}}
                  @endif
                @else PAY/{{str_pad($record->transid,4,'0',STR_PAD_LEFT)}}
                @endif
                | {{ucwords($record->description)}}
              </td>
              <td class="col-2 text-end">{{number_format($record->billamount,2)}}</td>
			        <td class="col-2 text-end">{{number_format($record->paid,2)}}</td>
            </tr>  
            @php $sale += $record->billamount; $recieved += $record->paid; @endphp
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td class="text-end"> <p class="fw-bold">{{number_format($sale,2)}}</p></td>
              <td class="text-end"><p class="fw-bold">{{number_format($recieved,2)}}</p></td>
            </tr>
            <tr>
              <td></td>
              <td class="text-end" colspan="2"> <p class="fw-bold">Balance to pay: </p> </td>
              <td class="text-end"><p class="fw-bold">{{number_format($sale-$recieved,2)}}</p></td>
            </tr>
          </tbody>
		  <!-- <tfoot class="card-footer">
		
		  </tfoot> -->
        </table>
      </div>
    </div>
  </div>
  </main>
  <!-- Footer -->
  <footer class="text-center mt-4">
  <!-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> -->
  <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fas fa-print"></i> Print</a> <a href="" class="btn btn-light border text-black-50 shadow-none"><i class="fas fa-download"></i> Download</a> </div>
  </footer>
</div>
</body>
</html>