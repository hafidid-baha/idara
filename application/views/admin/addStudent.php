                        <div class="row">
							<?php if(!isset($student)):?>
							<form action="<?=site_url('student/add');?>" method="POST" enctype='multipart/form-data' class="d-inline-block">
							<?php else: ?>
							<form action="<?=site_url('student/update/').$student->id;?>" method="POST" enctype='multipart/form-data' class="d-inline-block">
							<?php endif;?>
								<div class="col-lg-4 float-left">
									<div class="card pl-5 pt-5 pr-5 text-right">
										<div class="card-title">
											صورة الطالب
										</div>
										<div class="card-body text-center">
											<div class="row text-center">
												<div class="col-12">
													<a href="#" class="thumbnail ">
													<?php if(!isset($student)):?>
														<img id="imagePerv" src="<?=base_url();?>assets/images/photos/1.jpg" alt="thumb1" class="thumbimg">
													<?php else: ?>
														<img id="imagePerv" src="<?=base_url('./uploads/').$student->image;?>" alt="thumb1" class="thumbimg">
													<?php endif; ?>
													</a>
												</div>
												<div class="text-center">
													<div class="form-group text-center">
														<div class="form-label">حجم الصورة يجب ان يكون اقل من  2ميغا</div>
														<div class="custom-file">
															<input type="file" onchange="imagePreview(this,'imagePerv');" <?=!isset($student)?'required':'';?> class="custom-file-input" name="image">
															<label class="custom-file-label">اختر صورة</label>
														</div>
														<div>
															<small>نوعية الصورة المدعومة هي (.jpg)</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-8 float-right">
									<div class="card pl-5 pr-5 pt-5">
										<div class="card-title text-right">
											معلومات الطالب العامة
										</div>
										<div class="card-body text-right" style="direction: rtl;">
												<div class="form-group">
													<label class="form-label">الرقم</label>
													<input type="text" required value="<?=isset($student)?$student->code:$lastId;?>" readonly class="form-control" name="code" placeholder="الاسم">
												</div>
												<div class="form-group">
													<label class="form-label">الاسم الكامل</label>
													<input type="text" required class="form-control" value="<?=isset($student)?$student->name:'';?>" name="name" placeholder="الاسم">
												</div>
												<div class="form-group">
													<label class="form-label">البريد الالكتروني</label>
													<input type="email" required class="form-control" value="<?=isset($student)?$student->email:'';?>" name="email" placeholder="البريد">
												</div>
												<div class="form-group">
													<label class="form-label">الهاتف</label>
													<input type="tel" required class="form-control" name="tel" value="<?=isset($student)?$student->phone:'';?>" placeholder="الهاتف">
												</div>
												<div class="form-group">
													<label class="form-label">رقم التاجير</label>
													<input type="number" required class="form-control" name="dot" value="<?=isset($student)?$student->dot:'';?>" placeholder="رقم التاجير">
												</div>
												<div class="form-group">
													<label class="form-label">رقم البطاقة الوطنية</label>
													<input type="text" required class="form-control" name="cin" value="<?=isset($student)?$student->cin:'';?>" placeholder="رقم البطاقة الوطنية">
												</div>
												<div class="form-group ">
													<label class="form-label">القسم</label>
													<select class="form-control select2 custom-select" required name='classe' data-placeholder="Choose one">
														<option label="اختر القسم">
														</option>
														<?php foreach($classes as $class): ?>
														<option <?=(isset($student) && $student->classe==$class->id)?'selected':'';?> value="<?=$class->id;?>"><?=$class->name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="form-group ">
													<label class="form-label">اطار الطالب</label>
													<select required name="cadre" class="form-control select2 custom-select" data-placeholder="Choose one">
														<option label="اختر الاطار"></option>
														<option <?=(isset($student) && $student->cadre=='استاذ التعليم الابتدائي')?'selected':'';?> value="استاذ التعليم الابتدائي">استاذ التعليم الابتدائي</option>
														<option <?=(isset($student) && $student->cadre=='استاذ التعليم الاعدادي')?'selected':'';?> value="استاذ التعليم الاعدادي">استاذ التعليم الاعدادي</option>
														<option <?=(isset($student) && $student->cadre=='استاذالتعليم الثانوي التاهيلي')?'selected':'';?> value="استاذالتعليم الثانوي التاهيلي">استاذالتعليم الثانوي التاهيلي</option>
													</select>
												</div>
												<input type="submit" name="addStudent" class="btn btn-primary mt-3" value="حفظ"/>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</form>
						</div>