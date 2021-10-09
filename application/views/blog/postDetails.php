<div class="row">
<?php 
    // echo '<pre>';
    // echo var_dump($post);
    // echo '</pre>';
    $days = date_diff(date_create($post->date),date_create(date('Y-m-d h:i:s a', time())))->d;
    $days = $days>0 ?$days : 1;
?>
    <div  class="col">
        <div class="card">
            <div class="card-body text-right pl-5 pr-5">
                <h3><?=$post->title?></h3>
                <p style="line-height: 200%;">
                    <?=$post->subject?>
                </p>
            </div>
            <div class="card-footer text-right" style="direction: rtl;">
                <!-- blog-content -->
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="avatar brround avatar-md mr-3" style="background-image: url(<?=base_url();?>uploads/<?= $post->image;?>)"></div>
                    <div>
                        <a href="" class="text-dark mr-1"><?=$post->name?></a>
                        <small class="d-block text-dark mr-2">قبل <?=$days?> ايام</small>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>