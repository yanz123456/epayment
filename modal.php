
<style>
    .modal {
      overflow: auto !important;
    }
</style>

<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transaction Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="transactionForm" method="POST" autocomplete="no">
          <div class="form-group">
            <div class="box-body">
                  <div id="listofemployees">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="">
                          <div class="box-body">
                            <table id="example1" class="table table-bordered">
                              <thead>
                                <th width="20%">Transaction Name</th>
                                <th width="10%">Office</th>
                                <th width="20%">Note</th>
                                <th width="10%">Price</th>
                                <th width="10%">Qty of Unit <span id="unitPrice"></span></th>
                                <th width="10%">No. of Copy(ies)</th>
                                <th width="5%"></th>
                              </thead>
                              <tbody id="transactionList">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-12">
                        <div class="">
                          <div class="box-header with-border">
                            <h5>Additional Transactions Offered by this Office (Optional)</h5>
                          </div>
                          <div class="box-body">
                            <table id="example2" class="table table-bordered">
                              <thead>
                                <th width="20%">Transaction Name</th>
                                <th width="20%">Office</th>
                                <th width="20%">Note</th>
                                <th width="10%">Price & Unit</th>
                                <th width="50%"></th>
                              </thead>
                              <tbody id="loadedTransactions">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Proceed</button>
        <!-- <button type="submit" class="btn btn-primary">Proceed</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="ajax/add_request.php" method="POST" autocomplete="no">
          <div class="row">
            <div class="col-lg-12">
              <table id="confirmation_table" class="table table-bordered">
                <thead>
                  <input type="hidden" class="form-control" id="trans_user_id" name="trans_user_id" readonly>
                  <input type="hidden" class="form-control" id="year" name="year" readonly>
                  <input type="hidden" class="form-control" id="month" name="month" readonly>
                  <th width="20%">Transaction Name</th>
                  <th width="10%">Office</th>
                  <th width="20%">Note</th>
                  <th width="10%">Price</th>
                  <th width="10%">Qty of Unit <span id="unitPrice"></span></th>
                  <th width="10%">No. of Copy(ies)</th>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="col-lg-12">
            <p style="text-align: right;font-size: 1.2em; font-weight: bold;">Total Amount: <span id="totalAmount"></span></p>
            </div>
            <div class="col-lg-12">
            <p style="color:red;"><i>Note: Please be informed that this might take 2-3 days to be processed by the concerned office. You will receive an email for the result of your request.</i></p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button id="backConfirmation" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Check Transaction -->
<div class="modal fade" id="checkTransaction" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Check Your Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="admin_module/client/login.php?action=check" method="POST">
          <div class="form-group">
            <div class="row">
              <label for="title" class="col-sm-3 control-label">Client Type:</label>
              <div class="col-sm-9">
                  <select class="form-control" id="cyt_client_type" name="cyt_client_type" required>
                    <option value="" disabled hidden selected>-- Select Client Type--</option>
                    <option value="Student">Student</option>
                    <option value="Applicant">Applicant</option>
                    <option value="External">External</option>
                  </select>
              </div>
            </div>
          </div>
          <div id="cyt_secondform">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Proceed</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>