
						<div class="row">
							<div class="col">
								<div class="card ">
									<div class="card-body">
										<?php if(isset($postType)): ?>
										<form action="<?=site_url('/blog/updateType/').$postType->id;?>" method="post">
										<?php else: ?>
										<form action="<?=site_url('/blog/addType');?>" method="post">
										<?php endif; ?>
											<div class="col">
												<div class="form-group text-right">
													<div class="form-label">الاسم</div>
													<input type="text" required value="<?=isset($postType)? $postType->name : ''?>" name="name" class="form-control text-right" placeholder="اسم نوع المقال" />
												</div>
											</div>

											<div class="col">
												<div class="form-group text-right">
													<label class="form-label">التبويب الرئيسي</label>
													<select class="form-control select2 custom-select" style="direction:rtl" name="parent" data-placeholder="Choose one">
														<option value="0">بدون تبويب رئيسي</option>
														<?php foreach($postTypes as $post): ?>
														<option  value="<?=$post->id?>" <?=isset($postType) && $postType->parent==$post->id ? "selected" : ''?>><?=$post->name?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											
											<div class="col text-right">
												<input type="submit" name="addPostType"  class="btn btn-primary" value="حفظ" />	
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="card text-right">
									<div class="card-header" style="direction:rtl;">
										جميع انواع المقالات
									</div>
									<div class="card-body">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">الاسم</th>
												<th class="wd-15p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($allPostTypes as $p):
												
											?>
											<tr>										
												<td><?=$p->name;?></td>
												<td class="text-center">
													<a href="<?=site_url('blog/updateType/').$p->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?=site_url('blog/removePostType/').$p->id;?>" class="text-primary pl-2 pr-2" onclick="showDeleteConfirm(this,event);"><i class="fa fa-trash" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
						