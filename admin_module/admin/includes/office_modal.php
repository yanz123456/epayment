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
            	<form class="form-horizontal" id="form_request_verify" method="POST" action="requests_verify.php?action=confirm">
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
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="button" class="btn btn-primary btn-flat" id="compute"><i class="fa fa-calculator"></i> Compute</button>
            	<button type="submit" class="btn btn-success btn-flat" name="accept"><i class="fa fa-save"></i> Accept</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Decline -->
<div class="modal fade" id="decline">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Decline Transaction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="requests_verify.php?action=decline">
            		<div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Transaction #:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_transaction_number" name="del_transaction_number" required readonly="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Client Type:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_client_type" name="del_client_type" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_requestor_id" name="del_requestor_id" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_requestor_name" name="del_requestor_name" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_rqeuestor_email" name="del_rqeuestor_email" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Transaction:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_transaction" name="del_transaction" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Reason:</label>
                        <div class="col-sm-9">
                            <textarea style="resize: none" type="text" rows="3" class="form-control" id="reason" name="reason" required></textarea>
                        </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Decline</button>
            	</form>
          	</div>
        </div>
    </div>
</div>