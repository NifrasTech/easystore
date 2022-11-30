<div class="row">
  <div class="col-12">
    <div class="row d-flex justify-content-end align-items-center">
        <div class="col-sm-3 mb-1">
            <input type="date" wire:model.defer="dtStart"  class="form-control">
        </div>
        <div class="col-sm-3 mb-1">
            <input type="date" wire:model.defer="dtEnd"  class="form-control">
        </div>
        <div class="col-sm-1 mb-1">
            <button class="btn btn-primary" wire:click="getRecord"> <i class="fas fa-sync-alt"></i> </button>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>SALES</th>
            <th>COST</th>
            <th>PROFIT</th>
            <th>EXPENSES</th>
            <th>NET PROFIT</th>
            <th>RECIEVED</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{number_format($sales)}}</td>
                <td>{{number_format(($sales+$discount)-$profit)}}</td>
                <td>{{number_format($profit-$discount)}}</td>
                <td>{{number_format($expense)}}</td>
                <td>{{number_format(($profit-$discount)-$expense)}}</td>
                <td>{{number_format($recieved)}}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>