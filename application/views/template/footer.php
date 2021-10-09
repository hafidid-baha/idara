						
                    </div>
                </div> 
            </div>

            <!--footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							جميع الحقوق محفوظة &copy;2020
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->
        </div>
        <!-- Back to top -->
		<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
		
		<!-- Dashboard Core -->
		<script src="<?=base_url();?>assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/selectize.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="<?=base_url();?>assets/js/vendors/circle-progress.min.js"></script>
		<script src="<?=base_url();?>assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- c3.js Charts Plugin -->
		<script src="<?=base_url();?>assets/plugins/charts-c3/d3.v5.min.js"></script>
		<script src="<?=base_url();?>assets/plugins/charts-c3/c3-chart.js"></script>
		
		<!-- Input Mask Plugin -->
		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.mask.min.js"></script>

        <!-- Index Scripts -->
		<script src="<?=base_url();?>assets/js/index.js"></script>
		<script src="<?=base_url();?>assets/js/charts.js"></script>
		
		<!-- Custom scroll bar Js-->
		<script src="<?=base_url();?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<!-- Custom Js-->
        <script src="<?=base_url();?>assets/js/custom.js"></script>
        
        <!-- Data tables -->
		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.js"></script>
		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

		<!-- Sweet alert Plugin -->
		<script src="<?=base_url();?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
		<script src="<?=base_url();?>assets/js/sweet-alert.js"></script>

		<!-- Notifications js -->
		<script src="<?=base_url();?>assets/plugins/notify/js/rainbow.js"></script>       
		<script src="<?=base_url();?>assets/plugins/notify/js/sample.js"></script>       
		<script src="<?=base_url();?>assets/plugins/notify/js/jquery.growl.js"></script>  

		<!-- WYSIWYG Editor js -->
		<script src="<?=base_url();?>assets/plugins/wysiwyag/jquery.richtext.js"></script>

		<!-- Data table js -->
		<script>
			$(function(e) {
				$('#teachers').DataTable();
				$('.content').richText();
			} );

			function showDeleteConfirm(e,ev){
				ev.preventDefault();
				// console.log(e);
				var href = $(e).attr('href');
				// var type = $(this).data("type");
				swal({
						title: " تنبيه بالحذف",
						text: "هل انت متاكد من حذف هذا العنصر",
						type: "warning",
						showCancelButton: true,
						confirmButtonText: 'حذف',
						cancelButtonText: 'الغاء'
					},
					function(isConfirm){
						if(isConfirm){
							window.location.href = href;
						}
					});
			};

			function imagePreview(element,imageId){
				const image = $('#'+imageId);
				const file = element.files[0];
				// console.log(element);
				if(file){
					const reader = new FileReader();
					reader.onload = function(e){
						$(image).attr('src',e.target.result);
						// console.log(e.target.result);
					};

					reader.readAsDataURL(file);
				}
				// console.log(image);
			}
			
			<?php if($this->session->flashdata('addSuccess')=='1'): ?>
				$.growl.notice({
					title: "<?=$this->session->flashdata('title');?>",
					message: "<?=$this->session->flashdata('msg');?>"
				});
			<?php endif;?>
			<?php if($this->session->flashdata('addError')=='1'): ?>
				$.growl.error({
					title: "<?=$this->session->flashdata('title');?>",
					message: "<?=$this->session->flashdata('msg');?>"
				});
			<?php endif;?>
		</script>

	</body>
</html>