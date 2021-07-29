<?php
    include 'admin_module/admin/includes/conn.php';
    include 'modal.php';

    $keyword = $_REQUEST["keyword"];

    $sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.description LIKE '%$keyword%' AND a.remarks = 'active'";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc())
    {
        $account_code = $row["account_code"];
        $description = $row["description"];
        $office_name = $row["office_name"];
        $amount = number_format($row["amount"], 2);
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
?>

<script>
$(function()
{
  $('.request').on('click', function (e) 
  {
    e.preventDefault();
    var transtype = $(this).closest("#transactions").find("#type").text();
    var transamount = $(this).closest("#transactions").find("#amount").text();
    var transoffice = $(this).closest("#transactions").find("#office").text();
    alert(transamount);
    $("#transtype").val(transtype);
    $("#transamount").val(transamount.split(": ").pop());
    $("#transoffice").val(transoffice.split(": ").pop());
  });

});
</script>