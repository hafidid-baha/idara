		<div class="row">
							<div class="col">
								<div class="card ">
									<div class="card-body">
										<?php if(isset($post)): ?>
										<form action="<?=site_url('/blog/update/').$post->id;?>" method="post">
										<?php else: ?>
										<form action="<?=site_url('/blog/add');?>" method="post">
										<?php endif; ?>
											<div class="col">
												<div class="form-group text-right">
													<div class="form-label">عنوان المقال</div>
													<input type="text" required value="<?=isset($post)?$post->title:''?>" name="title" class="form-control text-right" placeholder="عنوان المقال" />
												</div>
											</div>
											<div class="col">
												<div class="form-group text-right">
													<label class="form-label">التبويب</label>
													<select class="form-control select2 custom-select" style="direction:rtl" name="posttype" data-placeholder="Choose one">
														<?php foreach($postTypes as $p): ?>
														<option  value="<?=$p->id?>" <?=isset($post) && $post->postType==$p->id ? "selected" : ''?>><?=$p->name?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
													<div class="form-label text-right">المقال</div>
													<textarea class="content" required name="content" class="" placeholder="المقال">
													<?=isset($post) ? $post->subject : ''?>
													</textarea>
												</div>
											</div>
											<div class="col text-right">
												<input type="submit" name="addPost"  class="btn btn-primary" value="حفظ" />	
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						