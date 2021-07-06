<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Transaction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="transaction_verify.php?action=add">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Account Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="account_code" name="account_code" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Description:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Amount:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="amount" name="amount" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Office:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="office" required>
                                <option disabled selected hidden value="">-- Select Office --</option>
                                <?php
                                    $sql = "SELECT id, description FROM tbl_offices WHERE remarks = 'active' ORDER BY description";
                                    $query = $conn->query($sql);
                                    while($row = $query->fetch_assoc())
                                    {
                                        $id = $row["id"];
                                        $description = $row["description"];
                                        echo "
                                            <option value='$id'>$description</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
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

<!-- Edit -->
<div class="modal fade" id="editnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Transaction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="transaction_verify.php?action=edit">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Account Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="editaccount_code" name="editaccount_code" required autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Description:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="editdescription" name="editdescription" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Amount:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="editamount" name="editamount" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Office:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editoffice" name="editoffice" required>
                                <option disabled selected hidden value="">-- Select Office --</option>
                                <?php
                                    $sql = "SELECT id, description FROM tbl_offices WHERE remarks = 'active' ORDER BY description";
                                    $query = $conn->query($sql);
                                    while($row = $query->fetch_assoc())
                                    {
                                        $id = $row["id"];
                                        $description = $row["description"];
                                        echo "
                                            <option value='$id'>$description</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="transaction_verify.php?action=delete">
            		<input type="hidden" id="del_account_code" name="del_account_code">
            		<div class="text-center">
	                	<p>DELETE TRANSCTION</p>
	                	<h2 id="del_account_code1" class="bold"></h2>
                        <h5 id="del_account_description"></h5>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>