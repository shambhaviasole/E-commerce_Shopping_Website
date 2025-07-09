<?php

include("include/dbconnect.php");
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
if($category=='all')
{
    $qry = "select * from product";
}
else
{
    $qry = "select * from product where productcategory = '$category'";
}

$result = mysqli_query($connect, $qry);

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("include/allheadercdn.php"); ?>
	<link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php include("include/homeheader.php") ?>

<div class="jumbotron">
	
	<div class="row align-items-center text-center" >
		<div class="col-md-6">
			<h1 class="display-2"> Customized Printed Tees </h1>
			<button class="btn btn-danger"> Shop Now </button>
		</div>
		<div class="col-md-6">
			<img src="images/static/boy-t2.png" class="img-fluid">
		</div>
	</div>

</div>



<!-- product list -->

<div class="container">
        <div class="text-center my-4">
           
            <button class="btn btn-primary filter-button active" data-filter="all">All</button>
            <button class="btn btn-primary filter-button" data-filter="electronics">Electronics</button>
            <button class="btn btn-primary filter-button" data-filter="fashion">Fashion</button>
            <button class="btn btn-primary filter-button" data-filter="pets">Pets</button>
            
        </div>

        <div class="row">

        <?php
        while($data = mysqli_fetch_assoc($result))
        {
            $imgpath = "images/".$data['productcategory']."/".$data['productimage'];
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 filter <?php echo $data['productcategory'] ?> show">
                <div class="card product-card">
                    <img src="<?php echo $imgpath ?>" class="card-img-top" alt="Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $data["productname"]; ?></h5>
                        <p class="card-text">⭐⭐⭐⭐☆</p>
                        <p class="card-text"><?php echo $data["productprice"]; ?></p>
                        <a href="productinfo.php?pid=<?php echo $data['productid'] ?>" class="btn btn-primary">View More</a>
                    </div>
                </div>
            </div>
        <?php        
        }
        ?>



    


        </div>
    </div>


<!-- end of product list -->


<?php include("include/allfooterlinks.php"); ?>
<script type="text/javascript" src="js/script.js"></script>

<script>
$(document).ready(function() {
    $('.filter-button').on('click', function() {
        const category = $(this).data('filter');
        window.location.href = '?category=' + category;
    });
});

</script>

</body>
</html>








<!-- product list
navigation menu
register
login
footer
jumbotron
gallery/product list - fetch from table
carousel
slick slider -->
