<?php

	require('frontendheader.php');

?>

<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="frontend/image/banner/ac.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/giordano.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">
			<?php 
				$sql = "SELECT * FROM categories ORDER BY rand() LIMIT 8";

			        $stmt = $conn->prepare($sql);
			        $stmt->execute();

			        $categories = $stmt->fetchAll();

			        $i = 1;


			        foreach ($categories as $category) {
			        	$cid = $category['id'];
			        	$cname = $category['name'];
			        	$cphoto = $category['logo'];

			?>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
				  	<img src="<?= $cphoto ?>" class="card-img-top image-fluid"  alt="...">
				  	<div class="card-body">
				    	<p class="card-text font-weight-bold text-truncate"> 
				    		<?= $cname; ?>
				    	 </p>
				  	</div>
				</div>
			</div>
			<?php } ?>
		</div>

		<!-- <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div> -->
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Item </h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">

		            <?php 

		            	$sql = 'SELECT * FROM items WHERE discount !="" LIMIT 8';

		            	$stmt = $conn->prepare($sql);
		            	$stmt->execute();

		            	$discount_items = $stmt->fetchAll();

		            	foreach ($discount_items as $discount_item) {
		            		
		            		$di_id=$discount_item['id'];
		            		$di_name=$discount_item['name'];
		            		$di_price=$discount_item['price'];
		            		$di_photo = $discount_item['photo'];
		            		$di_codeno=$discount_item['codeno'];
		            		$di_discount = $discount_item['discount'];

		             ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $di_photo ?>" class="img-fluid">
		                        <p class="text-truncate"> <?= $di_name ?> </p>
		                        <p class="item-price">
		                        	<?php if ($di_discount) {
		                        	?>
		                        		
		                        	<strike><?= $di_price ?>Ks</strike> 
		                        	
		                        	<span class="d-block"> <?= $di_discount ?>Ks </span>
		                        	<?php } else{ ?>
		                        		<span class="d-block"><?= $di_price ?>Ks</span>
		                        	<?php } ?>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								 <button 
								 data-id="<?= $di_id ?>" data-photo = "<?=$di_photo ?>" data-name="<?= $di_name ?>"
								 data-codeno="<?= $di_codeno ?>"
								 data-price = "<?= $di_price ?>"
								 data-discount = "<?= $di_discount ?>"
								 class=" text-decoration-none btn_add">Add to Cart</button>

		                    </div>
		                </div>

		            <?php } ?>
		               
		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Flash Sale Item -->
		<div class="row mt-5">
			<h1> Flash Sale </h1>
		</div>

	    <!-- Flash Sale Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php 

		            		$sql = 'SELECT * FROM items ORDER BY created_at DESC LIMIT 8';
		            		$stmt = $conn->prepare($sql);
		            		$stmt->execute();


		            		$sale_items = $stmt->fetchAll();

		            		foreach ($sale_items as $sale_item) {
		            			
		            			$sa_id = $sale_item['id'];
		            			$sa_name = $sale_item['name'];
		            			$sa_price = $sale_item['price'];
		            			$sa_discount = $sale_item['discount'];
		            			$sa_photo = $sale_item['photo'];
		            			$sa_codeno = $sale_item['codeno'];


		            	?>



		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $sa_photo ?>" class="img-fluid">
		                        <p class="text-truncate"> <?= $sa_name ?> </p>
		                        <p class="item-price">
		                        	<?php if ($sa_discount) { ?>
		                        		
		                        		<strike> <?= $sa_price ?> Ks</strike> 
		                        		<span class="d-block"> <?= $sa_discount ?> Ks </span>
		                        		<?php } else{ ?>
		                        			<span class="d-block"> <?= $sa_price ?> Ks </span>

		                        		<?php } ?>
		                        	
		                        	
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<button 
								 data-id="<?= $sa_id ?>" data-photo = "<?=$sa_photo ?>" data-name="<?= $sa_name ?>"
								 data-codeno="<?= $sa_codeno ?>"
								 data-price = "<?= $sa_price ?>"
								 data-discount = "<?= $sa_discount ?>"
								 class=" text-decoration-none btn_add">Add to Cart</button>

		                    </div>
		                </div>
		               
		               	<?php } ?> 
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Random Catgory ~ Item -->
		<div class="row mt-5">
			<h1> ELECTRONIC DEVICE </h1>
		</div>

	    <!-- Random Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
		                	$sql = 'SELECT * FROM items  LIMIT 8';
		            		$stmt = $conn->prepare($sql);
		            		$stmt->execute();


		            		$random_items = $stmt->fetchAll();

		            		foreach ($random_items as $random_item) {
		            			
		            			$ra_id = $random_item['id'];
		            			$ra_name = $random_item['name'];
		            			$ra_price = $random_item['price'];
		            			$ra_discount = $random_item['discount'];
		            			$ra_photo = $random_item['photo'];
		            			$ra_codeno = $random_item['codeno'];
	

		                ?>
		                
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $ra_photo ?>" class="img-fluid">
		                        <p class="text-truncate"> <?= $ra_name ?></p>
		                        <p class="item-price">
		                        	<?php if ($ra_discount) { ?>
		                        		<strike> <?= $ra_price ?> Ks </strike> 
		                        	<span class="d-block"> <?= $ra_discount ?> Ks</span>
		                        	<?php } else { ?>
		                        		<span class="d-block"> <?= $ra_price ?> Ks</span>
		                        	<?php } ?>
		                        	
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<button 
								 data-id="<?= $ra_id ?>" data-photo = "<?= $ra_photo ?>" data-name="<?= $ra_name ?>"
								 data-codeno="<?= $ra_codeno ?>"
								 data-price = "<?= $ra_price ?>"
								 data-discount = "<?= $ra_discount ?>"
								 class=" text-decoration-none btn_add">Add to Cart</button>

		                    </div>
		                </div>
		            	<?php } ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">
	      	

	      		<?php

					$sql = "SELECT * FROM brands";
			        		
			       		 $stmt = $conn->prepare($sql);
			        	$stmt->execute();

			        	$rows = $stmt->fetchAll();

			        	$i = 1;


			        	foreach ($rows as $row) {
			        		$id = $row['id'];
			        		$photo = $row['photo'];
			        		

				 ?>
			<div class="slide">
	      		<a href="">
		      		<img src=" <?= $photo ?>" width ="50" height = "45"/>
		      	</a>
		      	
	      	</div>
	      	<?php } ?>
	      	
	      	
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	</div>

<?php

	require('frontendfooter.php');

?>