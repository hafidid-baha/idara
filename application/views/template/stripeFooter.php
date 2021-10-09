</div>
			</div>
		</div>
		
		
		<!-- Dashboard js -->
		<script src="<?=base_url();?>assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/selectize.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/circle-progress.min.js"></script>
		<script src="<?=base_url();?>assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- Custom scroll bar Js-->
		<script src="<?=base_url();?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<!-- Custom Js-->
		<script src="<?=base_url();?>assets/js/custom.js"></script>
		<script>
			$("#print").on('click',function(){
				window.print();
			})
			$("#printC").on('click',function(){
				var url = "<?php echo site_url('admin/updateLastCertNumber'); ?>";
                $.ajax({
                url: url ,
                success: function(response)
                {
                    // alert('done');
                }
                });
				window.print();
			})
			
		</script>
	</body>
</html>
 