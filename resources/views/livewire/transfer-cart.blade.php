<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Cost</th>
        <th>Sub Total</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($cart) && count($cart)!=0)
    @php($total = 0)
    @foreach($cart as $id => $transfer)
    @php ($subtotal = $transfer['cost'] * $transfer['quantity'])
    @php ($total+=$subtotal)
    <tr>
        <td>{{$transfer['name']}}</td>
        <td>
            <input 
            type="number" 
            class="form-control" 
            wire:keydown.enter="updateCart($event.target.value,{{$id}},'quantity')" 
            value="{{$transfer['quantity']}}">
        </td>
        <td>
            {{$transfer['price']}}
        </td>
        <td>
            {{$transfer['cost']}}
        </td>
        <td>{{$subtotal}}</td>
        <td><a href="#" class="btn btn-sm btn-danger" wire:click="removeFromCart({{$id}})"><i class="fas fa-trash"></i></a></td>
    </tr>
    @endforeach
    <tr>
        <td colspan="4" style="text-align:right">Total: </td>
        <td colspan="2"><strong>{{$total}}</strong></td>
        <input type="hidden" id="txt-total" value="{{$total}}">
    </tr>
    <tr>
        <td colspan="6"  style="text-align:right">
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clearModal">CLEAR</a>
            <button onclick="completeTransfer()" class="btn btn-success">COMPLETE</button>
        </td>
    </tr>
    @endif
    @if(!isset($cart) || count($cart)==0)
    <tr>
        <td>No Records</td>
    </tr>
    @endif
    </tbody>
    </table>
</div>    
