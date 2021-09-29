<?php
    include 'admin_module/admin/includes/conn.php';
    include 'modal.php';

    $office_id = $_REQUEST["office_id"];

    $sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.office_id = '$office_id' AND a.remarks = 'active'";
    $query = $conn->query($sql);
    if($query->num_rows > 0)
    {
        while($row = $query->fetch_assoc())
        {
            $account_code = $row["account_code"];
            $description = $row["description"];
            $office_name = $row["office_name"];
            $amount = number_format($row["amount"], 2);
            $unit = $row["unit"];
            echo "
                <div class='col-md-6 d-flex id='transactions'>
                <div class='blog-entry justify-content-end'>
                <div class='text mt-3 float-right'>
                    <h3 id='type' class='heading'>$description</h3>";
    
                if(strlen($description) <= 27)
                {
                    echo "<br>";
                }
                echo "
                        <p id='office'>Office: $office_name</p>";
                if(!empty($amount) && !empty($unit))
                {
                    echo "<p id='amount'>Amount: P $amount $unit</p>";
                }
                else if($amount > 0 && empty($unit))
                {
                    echo "<p id='amount'>Amount: P $amount</p>";
                }
                else
                {
                    echo "<p id='amount'>Amount: To be decided</p>";
                }
    
            echo "
                    <div class='d-flex align-items-center mt-4 meta'>
                    <p class='mb-0'><a href='#carouselModal' data-toggle='modal' class='btn btn-secondary request'>Request this transaction <span class='ion-ios-arrow-round-forward'></span></a></p>
                    </div>
                </div>
                </div>
                </div>
            ";
        }
    }
    else
    {
        echo "
                <div class='col-md-4 d-flex id='transactions'>
                <div class='blog-entry justify-content-end'>
                <div class='text mt-3 float-right'>
                    <h3 id='type' class='heading'>No Transaction Available..</h3>
                    <div class='d-flex align-items-center mt-4 meta'>
                    </div>
                </div>
                </div>
                </div>
            ";
    }
?>

<script>
$(function()
{
});
</script>