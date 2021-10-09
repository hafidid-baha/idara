                        <div class="row">
							<div class="col-lg-12">
								<div class="card pl-5 pr-5 pt-5">
									<div class="card-body text-right" style="direction: rtl;">
										<?php if(!isset($classe)): ?>
										<form action="<?=site_url('classe/add');?>" method="POST">
										<?php else: ?>
										<form action="<?=site_url('classe/update/').$classe->id;?>" method="POST">
										<?php endif; ?>
											<div class="form-group">
												<label class="form-label">اسم القسم</label>
												<input type="text" class="form-control" value="<?=isset($classe)?$classe->name:'';?>" name="classeName" placeholder="القسم">
											</div>
											
											<input type="submit" name="addclasse" class="btn btn-primary mt-3" value="حفظ"/>
										</form>
									</div>
								</div>
							</div>
						</div>