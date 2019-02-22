<?php
include 'global/connect.php';

?>
<?php 
$banners = mysqli_query($conn,"SELECT * FROM banner WHERE status = 1 ORDER BY ordering ASC ");
?>

<div id="carousel-id" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php foreach ($banners as $k => $bn):
			$active = $k == 0 ? 'active' : '';
			?>

			<li data-target="#carousel-id" data-slide-to="2" class="<?php $active ?>"></li>
		<?php endforeach ?>

	</ol>
	<div class="carousel-inner">
		<?php foreach ($banners as $i => $bnn): 
			$active1 = $i == 0 ? 'active' : '';
			?>

		

			<div class="item <?php echo $active1 ?>">
				<img style="width: 100%;height: 750px;" src="uploads/<?php echo $bnn['link_image'] ?>">
				<div class="container">
					<div class="carousel-caption">
						<!-- <h1><?php echo $bnn['name']; ?></h1> -->
						
						<!-- <p><a class="btn btn-lg btn-primary" href="<?php echo $bnn['link'] ?>" role="button">Browse gallery</a></p> -->
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>