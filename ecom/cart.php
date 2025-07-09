<?php


include("include/allheadercdn.php");
include("include/homeheader.php");
include("include/dbconnect.php");

$id = $_SESSION["sid"];

$qry = "select * from addtocart where uid = '$id'";	

$result = mysqli_query($connect, $qry);

$row = mysqli_num_rows($result);

?>

<link href="css/style.css" rel="stylesheet">

<div class="container my-5">
	<div class="row">
		<div class="col-md-8">
			<table class="table">
				<tr>
					<th> S. NO. </th>
					<th> Product Image  </th>
					<th>  Name </th>
					<th> Price </th>
					<th> Qunatity </th>
					<th> Action </th>
				</tr>
				
				<?php
				$count=1;
				if($row>0)
				{
				while($data = mysqli_fetch_assoc($result))	
				{
					$pid = $data["pid"];	
					$qry2 = "select productname, productcategory, productimage from product where productid = '$pid'";	
					$result2 = mysqli_query($connect, $qry2);
					$data2 = mysqli_fetch_assoc($result2);

					$imgpath = "images/".$data2['productcategory']."/".$data2['productimage'];

					?>
				<tr>	
					<td> <?php echo $count++; ?> </td>
					<td> <img src="<?php echo $imgpath ?>" width="60px" height="60px"> </td>
					<td> <?php echo $data2["productname"] ?> </td>
					<td class="totalprice"> <?php echo $data["totalprice"] ?> </td>

					<td> <input type="number" name="quantity"  value="<?php echo $data['quantity'] ?>" min="1" max="10" class="form-control d-inline-block quantity" style="width: 60px; text-align: center;" data-price = "<?php echo $data['totalprice'] ?>"> </td>
					<td> Delete </td>
				</tr>
				 <?php 
				}}
				else
				{ ?>
					<tr>	
					<td colspan="6" align="center">  No Record Found </td>
					
				</tr>
				<?php }
				?>
			</table>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h3> Order Summary </h3>
					<p> Total Items - <span id="totalitems"> 0 </span> </p>
					<h4> Total Price - <span id="totalprice"> 0 </span> </h4>

					<form action="checkout2.php" method="post">

						<input type="hidden" name="totalquantity" id="quantityInput">
						<input type="hidden" name="totalprice" id="priceInput">

						<?php
						 mysqli_data_seek($result, 0);
						while($data = mysqli_fetch_assoc($result))
						{
							$pid = $data["pid"];
							$quantity = $data["quantity"];
							$totalprice = $data["totalprice"];
						?>
							<input type="hidden" name="products[]" value="<?php echo $pid ?>">
							<input type="hidden" name="quantities[]" value="<?php echo $quantity ?>">
							<input type="hidden" name="prices[]" value="<?php echo $totalprice ?>">
						<?php



						}
					?>
					
					<button class="btn btn-success" type="submit"> Proceed to Checkout </button>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
	




<?php include("include/allfooterlinks.php"); ?>

<script>
	$(document).ready(function(){
    function updateTotals() {
        let totalquantity = 0;        
        let totalprice = 0;

        $(".quantity").each(function(){
            let quantity = $(this).val();
            totalquantity += parseInt(quantity);

            let price = $(this).data('price');
            totalprice += (quantity * price);
        });

        $("#totalprice").text(totalprice);
        $("#totalitems").text(totalquantity);

        $("#quantityInput").val(totalquantity); // Update hidden input
        $("#priceInput").val(totalprice); // Update hidden input

        // Update hidden inputs for each product's quantity and price
        let index = 0;
        $(".quantity").each(function(){
            let quantity = $(this).val();
            $("input[name='quantities[]']").eq(index).val(quantity);
            index++;
        });
    }

    $(".quantity").change(function(){
        updateTotals();
    });

    $(".quantity").trigger('change');

    $("form").submit(function() {
        updateTotals(); // Ensure totals are updated before form submission
    });
});

	</script>
