<!-- Add -->
<div class="modal fade" id="process">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Confirm Transaction:</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="requests_verify.php?action=confirm">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Transaction #:</label>
                        <div class="col-sm-9">
                            <input type="hidden" id="type_of_transaction" name="type_of_transaction">
                            <input type="hidden" id="amount_to_post" name="amount_to_post">
                            <input type="text" class="form-control" id="transaction_number" name="transaction_number" required readonly="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Client Type:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="client_type_confirm" name="client_type_confirm" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="requestor_id" name="requestor_id" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="requestor_name" name="requestor_name" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Requestor's Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rqeuestor_email" name="rqeuestor_email" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Account Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="account_code" name="account_code" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Transaction:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="transaction" name="transaction" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Additional Notes:</label>
                        <div class="col-sm-9">
                            <textarea style="resize: none" type="text" rows="5" class="form-control" id="notes" name="notes" required readonly></textarea>
                        </div>
                    </div>
                    <div id="amountinputs">
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
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
                        <label for="title" class="col-sm-3 control-label">Account Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_account_code" name="del_account_code" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Transaction:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="del_transaction" name="del_transaction" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Additional Notes:</label>
                        <div class="col-sm-9">
                            <textarea style="resize: none" type="text" rows="5" class="form-control" id="del_notes" name="del_notes" required readonly></textarea>
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