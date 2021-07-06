<div class="box-header with-border" id="dropdownfordepartments">
                <div class="col-sm-3">
                  <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-building"></i>
                      </div>
                      <select class="form-control" name="department" id="department" required>
                        <option value="" selected>- Select Department -</option>
                        <?php
                          $sql = "SELECT * FROM departments WHERE remarks = 'active'";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div id="listofemployees">
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="">
                        <div class="box-header with-border">
                          <h4><b>LIST OF PENDING EMPLOYEES</b></h4>
                        </div>
                        <div class="box-body">
                          <table id="example1" class="table table-bordered">
                            <thead>
                              <th>Employee ID</th>
                              <th>Name</th>
                              <th>Position</th>
                              <th>Department</th>
                              <th>Tools</th>
                            </thead>
                            <tbody>
                              <?php
                                $sql = "SELECT *, employees.id AS empid, position.description AS pos_desc, departments.description AS dep_desc FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN departments ON departments.id=employees.department_id";
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){
                                  ?>
                                    <tr>
                                      <td><?php echo $row['employee_id']; ?></td>
                                      <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']; ?></td>
                                      <td><?php echo $row['pos_desc']; ?></td>
                                      <td><?php echo $row['dep_desc']; ?></td>
                                      <td>
                                        <button class="btn btn-success btn-sm compute btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-calculator"></i> Compute</button>
                                      </td>
                                    </tr>
                                  <?php
                                }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="">
                        <div class="box-header with-border">
                          <h4><b>LIST OF FINISHED EMPLOYEES</b></h4>
                        </div>
                        <div class="box-body">
                          <span id="tableload">

                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>