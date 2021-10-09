						<div class="row">
							<div class="col-lg-12">
								<div class="card pl-5 pr-5 pt-5">
									<div class="card-body text-right" style="direction: rtl;">
										<?php if(!isset($subject)): ?>
										<form action="<?=site_url('/subject/add');?>" method="POST">
										<?php else: ?>
										<form action="<?=site_url('/subject/update/').$subject->id;?>" method="POST">
										<?php endif; ?>
											<div class="form-group">
												<label class="form-label">اسم المجزوءة</label>
												<input type="text" required class="form-control" name="name" value="<?=isset($subject) ? $subject->name : '';?>" placeholder="اسم المجزوءة">
											</div>
											<input type="submit" name="saveSub" class="btn btn-primary mt-3" value="حفظ"/>
										</form>
									</div>
								</div>
							</div>
						</div>