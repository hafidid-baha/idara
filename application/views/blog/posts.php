<div class="row">
	<div class="col">
		<!-- carousel start -->
		<div id="carousel-default" class="carousel slide mb-2"  data-ride="carousel">
			<div class="carousel-inner" style="max-height: 50vh;">
				<div class="carousel-item active">
					<img class="d-block " alt="" src="<?=base_url('assets/images/School_front.jpg');?>" data-holder-rendered="true">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- news items start -->
<div class="row" style="direction: rtl;">
	<?php foreach($posts as $post) :
		$days = date_diff(date_create($post->date),date_create(date('Y-m-d h:i:s a', time())))->d;
		$days = $days>0 ?$days : 1;
		$userInfo = $this->teacher_model->getUserById($post->user);
		?>
	<div class="col-lg-4">
		<div class="card card-blog-overlay">
			<div class="card-body blog-content-wrapper bg-white rounded">
				<div class="blog-content text-right">
					<h4 class="blog-title text-dark"><a href="<?=site_url('blog/post/').$post->postId?>"><?=$post->title?></a></h4>
					<p class="blog-category text-dark"><?=(mb_strlen($post->subject)>=50) ? mb_substr(strip_tags($post->subject),0,50).'...' : strip_tags($post->subject)?> </p>
				</div>
				
				<div class="d-flex align-items-center pt-5 mt-auto">
					<div class="avatar brround avatar-md mr-3" style="background-image: url(<?=base_url();?>uploads/<?= $userInfo->image;?>)"></div>
					<div>
						<a href="" class="text-dark mr-1"><?=$post->name?></a>
						<small class="d-block text-dark">قبل <?=$days?> ايام</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>


	
	
</div>