<div wire:key="modal-contactdetails" wire:ignore.self class="modal fade" id="modal-contactdetails" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h5 class="modal-title">Contact Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-md-4">
        <label>From:</label>
            <input
            type="date"
            class="form-control mb-2"
            wire:model.defer="dtStart"
            />
        </div>
        <div class="col-md-4">
        <label>To:</label>
            <input
            type="date"
            class="form-control mb-2"
            wire:model.defer="dtEnd"
            />
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary mt-md-2 d-block m-auto w-100" wire:click="filter">FILTER</button>
        </div>
      </div>
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                data-bs-toggle="tab"
                href="#payment-area"
                role="tab"
                aria-selected="true"
                ><i class="fas fa-plus-square"></i>PAYMENTS</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="tab"
                href="#sales-area"
                role="tab"
                ><i class="fas fa-cubes"></i>
                @if($is_supplier) PURCHASES
                @else SALES
                @endif
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="payment-area" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Note</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if($contact_id!=0)
                            @foreach ($payments as $payment)
                            <tr>
                              <td>{{$payment->created_at}}</td>
                              <td>{{strtoupper($payment->payment_type)}}</td>
                              <td>{{number_format($payment->amount)}}</td>
                              <td>{{$payment->note}}</td>
                            </tr>
                            @endforeach
                            <tfoot>
                              <tr>
                                <th colspan="2">Cash: </th>
                                <th colspan="2">
                                  
                                </th>
                              </tr>
                            </tfoot>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>    
            <div class="tab-pane" id="sales-area" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Bill No</th>
                            <th>Total</th>
                            <th>Discount</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if($contact_id!=0)
                            @foreach ($transaction as $trans)
                              <tr>
                                @if($is_supplier) <td>{{date('d-m-Y', strtotime($trans->purchase_date))}}</td>
                                @else <td>{{$trans->created_at}}</td>
                                @endif
                                <td>{{str_pad($trans->id,4,'0',STR_PAD_LEFT)}}</td>
                                <td>{{number_format($trans->total)}}</td>
                                <td>{{number_format($trans->discount)}}</td>
                              </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>    
      </div>
    </div>
  </div>
</div>
</div>
