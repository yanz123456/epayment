<?php 
			date_default_timezone_set('Asia/Singapore');
			$referencenumber = "613CLST20216-000001";
			$amounttobepaid = 50;
			$term = $_GET['term'];
			$schoolyear = $_GET['schoolyear'];
			$typeoftransaction = $_GET['typeoftransaction'];
			$studentnumber = "201210549";
			$studentname = "Tamares, Bryan Lester D.";



			// Create a function for converting the amount in words
function numberTowords($amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
  $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
  while( $x < $count_length ) {
       $get_divider = ($x == 2) ? 10 : 100;
       $amount = floor($num % $get_divider);
       $num = floor($num / $get_divider);
       $x += $get_divider == 10 ? 1 : 2;
       if ($amount) {
         $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
         $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
         $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
         '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
         '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
         }else $string[] = null;
       }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'pesos only ' : '') . $get_paise;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	</head>
	<style>
		 #header { position: fixed; border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;}
 		 #footer { position: fixed; border-top:1px solid black;}
 		 #body-content { text-align: center; margin: auto;padding: 30px; }
 		 #divline { border-bottom: 1px solid black;padding-bottom: 0px; }
 		 #inlinediv {
			  display: inline-block;
		}
	</style>
<body style="font-family: Arial, sans-serif;font-size:12px;">
	<div id="header"></div>
	<div id="body-content">
		<table width="100%" style="float:left;">
			<tr>
				<td colspan="4" style='font-size:12px;text-align: left;'>
					<center><img src="official.png" alt="PNU" height="100" width="400" ></center>
				</td>
			</tr>
			<tr>
				<td colspan="4" style='font-size:15px;text-align: right;'>
					<b style="font-size: 35px;"><?php echo $referencenumber ?></b>
					<br>
					E-Services Transaction Reference Number
					<br>
					Date: <u><?php echo date('m/d/Y'); ?></u>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<p style="text-align: center;font-size:16px;"><b>ORDER OF PAYMENT</b></p>
					<p style="text-align: left;font-size:12px;">
						The Collecting Officer<br/>
					    Cash Unit<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    Please issue Official Receipt in favor of
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: center;vertical-align: top;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;">
						<?php echo strtoupper($studentnumber); ?>
					</b>
				</td>
				<td colspan="3" style="text-align: center;vertical-align: top;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;">
						<?php echo strtoupper($studentname); ?>
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: center;vertical-align: top;">
						(Requestor No.)
				</td>
				<td colspan="3" style="text-align: center;vertical-align: top;">
						(Name)
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left;vertical-align: top;height: 15px;">
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: center;vertical-align: top;">
					<span style="border-top: 1px solid black;padding-top: 0px;display: inline-block;">
						(Address/Office)
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="1" width="100px" style="text-align: left;vertical-align: top;">
					In the amount of
				</td>
				<td colspan="3" style="text-align: left;vertical-align: top;">
					<span style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;">
						<?php
						echo numberTowords($amounttobepaid);
						?>
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right;vertical-align: top;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"><span style="height: 12px;font-weight: normal;">(Php</span></b>
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<span style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"> <?php echo number_format($amounttobepaid,2); ?> <span style="height: 12px;font-weight: normal;">)</span></span>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: left;vertical-align: top;">
					for the payment of (pls. include fee
				</td>
				<td colspan="2" style="text-align: right;vertical-align: top;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: right;vertical-align: top;height: 20px;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;vertical-align: top;height: 20px;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
				<td colspan="2" style="text-align: right;vertical-align: top;">
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: left;vertical-align: top;height: 20px;">
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
				</td>
				<td colspan="2">
					
				</td>
			</tr>
			<tr>
				<td colspan="1" width="100px" style="text-align: left;vertical-align: top;">
					per Bill No.
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
				<td colspan="2">
					
				</td>
			</tr>
			<tr>
				<td colspan="1" width="100px" style="text-align: left;vertical-align: top;">
					dated
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
				<td colspan="2">
					
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: center;">
					*************************** For Online Payment use ***************************
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					SCAN THIS QR CODE
					<br>
					FOR THE STEPS ONLINE
				</td>
				<td colspan="2" style="text-align: right;">
					Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="2" rowspan="8" style="text-align: center;">
					<img src="../ebizqr.png" width="180px" height="180px">
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					P
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"> <?php echo number_format($amounttobepaid,2); ?> </b>
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<p style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"></p>
				</td>
			</tr>
			<tr>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					P
				</td>
				<td colspan="1" style="text-align: right;vertical-align: top;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;"> <?php echo number_format($amounttobepaid,2); ?> </b>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;vertical-align: top;">
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<b style="border-bottom: 1px solid black;padding-bottom: 0px;display: inline-block;height:16px;">RONNIE PAGAL</b>
				</td>
			</tr>
			<tr height="1px">
				<td colspan="2" style="text-align: center;vertical-align: top;">
					(Authorized Signatory)
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;vertical-align: top;">
					(Accounting Office)
				</td>
			</tr>
		</table>
	</div>
	<div id="footer"></div>
</body>
</html>