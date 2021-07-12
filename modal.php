
<style>
    .modal {
      overflow: auto !important;
    }
</style>

<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Fill-up Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="addrequest.php?action=add" id="transactionForm" method="POST">
          <div class="form-group">
            <div class="row">
              <label for="title" class="col-sm-3 control-label">Transaction:</label>
              <div class="col-sm-9">
                  <input type="hidden" class="form-control" id="year" name="year" readonly>
                  <input type="hidden" class="form-control" id="month" name="month" readonly>
                  <input type="hidden" class="form-control" id="transcode" name="transcode" readonly>
                  <input type="hidden" class="form-control" id="transCategory" name="transCategory" readonly>
                  <input type="hidden" class="form-control" id="transUnitInputtedBy" name="transUnitInputtedBy" readonly>
                  <input type="hidden" class="form-control" id="transNoOfCopy" name="transNoOfCopy" readonly>
                  <input type="text" class="form-control" id="transtype" name="transtype" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label for="title" class="col-sm-3 control-label">Transaction Amount:</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control" id="transamount" name="transamount" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label for="title" class="col-sm-3 control-label">Transaction Office:</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control" id="transoffice" name="transoffice" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label for="title" class="col-sm-3 control-label">Client Type:</label>
              <div class="col-sm-9">
                  <select class="form-control" id="client_type" name="client_type" required>
                    <option value="" disabled hidden selected>-- Select Client Type--</option>
                    <option value="Student">Student</option>
                    <option value="Applicant">Applicant</option>
                    <option value="External1">External w/ Previous Transaction</option>
                    <option value="External2">External w/o Previous Transaction</option>
                  </select>
              </div>
            </div>
          </div>
          <div id="secondform">
          </div>
      </div>
      <div class="modal-footer">
        <button id="showConfirmation" type="button" class="btn btn-danger">Show Temporary Confirmation</button>
        <button id="proceedButton" type="button" class="btn btn-primary">Proceed</button>
        <!-- <button type="submit" class="btn btn-primary">Proceed</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="addrequest.php?action=add" method="POST">
          <div class="row">
            <div class="col-lg-12">
              <table id="confirmationTable" class="table table-bordered">
                <tbody>
                  <tr>
                    <td width="40%">Transaction:</td>
                    <td><span id="confModal_transaction"></span></td>
                  </tr>
                  <tr>
                    <td>Transaction Amount:</td>
                    <td><span id="confModal_transAmount"></span></td>
                  </tr>
                  <tr>
                    <td>Transaction Office:</td>
                    <td><span id="confModal_transOffice"></span></td>
                  </tr>
                  <tr>
                    <td>Client Type:</td>
                    <td><span id="confModal_clientType"></span></td>
                  </tr>
                  <tr>
                    <td>Student Number:</td>
                    <td><span id="confModal_studentNumber"></span></td>
                  </tr>
                  <tr>
                    <td>Lastname:</td>
                    <td><span id="confModal_lastname"></span></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><span id="confModal_email"></span></td>
                  </tr>
                  <tr>
                    <td>Notes:</td>
                    <td><span id="confModal_notes"></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-12">
            <p style="color:red;"><i>Note: Please take note that this might take 2-3 days to be processed by the concerned office. You will receive an email for the result of your request.</i></p>
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