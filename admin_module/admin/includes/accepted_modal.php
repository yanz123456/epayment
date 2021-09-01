<!-- Add -->
<div class="modal fade" id="process">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Transaction Details:</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal">
                    <table class="table table-sm table-bordered" id="transaction_details">
                        <thead>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <hr>
                    <h4> Requested Transactions </h4>

                    <table class="table table-sm table-bordered" id="list_of_request">
                        <thead>
                            <th width="16.6%">Transaction Name</th>
                            <th width="16.6%">Price</th>
                            <th width="16.6%">Qty of Unit <span id="unitPrice"></span></th>
                            <th width="16.6%">No. of Copy(ies)</th>
                            <th width="16.6%">Total Amount (Php)</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>


                    <div class="form-group">
                        <h4 class="col-sm-6 text-bold">Total Amount: Php <span id="total_amount_print"></span></h4>
                    </div>
          	</div>
          	<div class="modal-footer">
            	</form>
          	</div>
        </div>
    </div>
</div>