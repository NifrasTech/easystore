<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EASY STORE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="{{ asset('css/core.css') }}" />
    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
<!--     @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = url('/'); @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif -->

    
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back </a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> Print</button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="d-flex align-items-center">
        <img src="{{asset('thumbnail/'.$setting->logo)}}" 
            style="height:100px; max-width:100px">
            <div class="text-area p-1">
                <hr>
            <h2 >{{$setting->store_name}}</h2>     
            <p>{{$branch->address}}
                <br>{{$branch->contact}}
            </p>
            <hr>
            </div>
        </div>
        <div class="centered">
                
            
            
        </div>
        <p>	
        	Date: {{$sale['created_at']}}<br>
            Reciept No: {{str_pad($sale['id'],4,'0',STR_PAD_LEFT)}}<br>
            Client: {{$sale['contact']}} | Reference: {{empty($sale['reference']) ? 'None' : $sale['reference']}}
        </p>
        <table>
            <tbody>
            	<tr>
            		<th style="text-align: left;">Description</th>
            		<th style="text-align: right;">Unit</th>
            		<th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Disc.</th>	
            		<th style="text-align: right;">Total</th>
            	</tr>
            	@foreach($soldItems as $sold)
                <tr>         	
                	<td>{{$sold->name}}</td>
                	<td style="text-align: right;">{{number_format($sold->quantity,2)}}</td>
                	<td style="text-align: right; padding-left: 15px;">{{number_format($sold->price,2)}}</td>
                    <td style="text-align: right; padding-left: 15px;">{{number_format($sold->discount,2)}}</td>
                    <td style="text-align:right;vertical-align:bottom; padding-left: 15px;">{{number_format((($sold->price-$sold->discount)*$sold->quantity),2)}}
                    </td>             
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:left;" colspan="4">Total Before Discount: </th>
                    <th style="text-align:right;">{{number_format($sale->total + $sale->discount,2)}}</th>
                </tr>
                <tr>
                    <th style="text-align:left" colspan="4">Discount : </th>
                    <th style="text-align:right">{{number_format($sale->discount,2)}}</th>
                </tr>
                <tr>
                    <th style="text-align:left" colspan="4">Net Total : </th>
                    <th style="text-align:right">{{number_format($sale->total,2)}}</th>
                </tr>
                <tr>
                    <!-- <th class="centered" colspan="3">In Words: <span>Rs</span> <span>{{str_replace("-"," ",3000)}}</span></th> -->
                </tr>
            </tfoot>
        </table>
        <table>
            <tbody>         
                <!-- <tr style="background-color:#ddd;">
                    <td style="padding: 5px;width:30%">Paid By: Cash</td>
                    <td style="padding: 5px;width:40%">Amount: </td>
                    <td>600.00</td>
                </tr> -->
                <tr><td class="centered" colspan="3"><img id="barcode"/></td></tr>
                <tr><td class="centered" colspan="3">{{$setting->bill_note}}</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script type="text/javascript">
    // JsBarcode("#barcode", '{{str_pad($sale['id'],4,'0',STR_PAD_LEFT)}}');
    JsBarcode("#barcode", '{{str_pad($sale['id'],4,'0',STR_PAD_LEFT)}}', {
                // format: "upc",
                width:5,
                height:40,
                displayValue: false
                })
    // function auto_print() {     
    //     window.print()
    // }
    // setTimeout(auto_print, 1000);
</script>

</body>
</html>
