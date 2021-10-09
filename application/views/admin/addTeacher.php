						<div class="row">
							<?php if(!isset($teacher)):?>
							<form action="<?=site_url('teacher/add');?>" method='POST' enctype='multipart/form-data' class="d-inline-block">
							<?php else:?>
							<form action="<?=site_url('teacher/update/').$teacher->id;?>" method='POST' enctype='multipart/form-data' class="d-inline-block">
							<?php endif; ?>
								<div class="col-lg-4 float-left">
									<div class="card pl-5 pt-5 pr-5 text-right">
										<div class="card-title">
											صورة الاستاذ
										</div>
										<div class="card-body text-center">
											<div class="row text-center">
												<div class="col-12">
													<a href="#" class="thumbnail ">
													<?php if(!isset($teacher)): ?>
														<img id="imagePerv" src="<?=base_url()?>assets/images/photos/1.jpg" alt="thumb1" class="thumbimg">
													<?php else: ?>
														<img id="imagePerv" src="<?=base_url('uploads/').$teacher->image;?>" alt="thumb1" class="thumbimg">
													<?php endif; ?>
													</a>
												</div>
												<div class="text-center">
													<d	iv class="form-group text-center">
														<div class="form-label">حجم الصورة يجب ان يكون اقل من  2ميغا</div>
														<div class="custom-file">
															<input type="file" onchange="imagePreview(this,'imagePerv');" <?= !isset($teacher)?'required':''?> accept=".jpg" class="custom-file-input" name="image" id="imageInput">
															<label class="custom-file-label">اختر صورة</label>
														</div>
														<div>
															<small>نوعية الصورة المدعومة هي (.jpg)</small>
														</div>
													</d	iv>
												</div>
												<?php if(!isset($teacher) || $userRole == '1'): ?>
												<div class="form-group m-0 d-block w-100">
													<div class="custom-controls-stacked text-center">
														<label class="custom-control custom-checkbox ml-1 mr-1 text-center">
															<input type="checkbox" class="custom-control-input" <?=(isset($teacher) && $teacher->addStudentPer == 1) ?'checked':'';?> name="addStudent" value="1">
															<span class="custom-control-label">اعطاء صلاحيات اظافة التلاميذ للاستاذ</span>
														</label>
														<label class="custom-control custom-checkbox ml-1 mr-1 text-center">
															<input type="checkbox" class="custom-control-input" <?=(isset($teacher) && $teacher->isRisponsible == 1) ?'checked':'';?> name="responsible" value="1">
															<span class="custom-control-label">هل سيتكفل هذا الاستاذ بالمجزوءات التالية</span>
														</label>
														<ol style="direction: rtl;" class="text-right">
															<li>مجزوءة التداريب</li>
															<li>مجزوءة البحث</li>
															<li>مجزوءة امتحان التخرج</li>
														</ol>
													</div>
												</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-8 float-right">
									<div class="card pl-5 pr-5 pt-5">
										<div class="card-title text-right">
											معلومات الاستاذ العامة
										</div>
										<div class="card-body text-right" style="direction: rtl;">
												<div class="form-group">
													<label class="form-label">الاسم الكامل</label>
													<input type="text" value="<?=isset($teacher)?$teacher->name:'';?>" required class="form-control" name="name" placeholder="الاسم">
												</div>
												<div class="form-group">
													<label class="form-label">البريد الالكتروني</label>
													<input type="email" value="<?=isset($teacher)?$teacher->email:'';?>" required class="form-control" name="email" placeholder="البريد">
												</div>
												<div class="form-group">
													<label class="form-label">الهاتف</label>
													<input type="tel" value="<?=isset($teacher)?$teacher->tel:'';?>" required class="form-control" name="phone" placeholder="الهاتف">
												</div>
												<div class="form-group">
													<label class="form-label">اسم النستخدم</label>
													<input type="text" value="<?=isset($teacher)?$teacher->username:'';?>" required class="form-control" name="username" placeholder="اسم النستخدم">
												</div>
												<div class="form-group">
													<label class="form-label">كلمة المرور</label>
													<input type="password" <?= !isset($teacher)?'required':''?> class="form-control" name="password" placeholder="كلمة المرور">
												</div>
												<?php if(!isset($teacher) || $userRole == '1'): ?>
												<div class="form-group ">
													<label class="form-label">المجزوءة</label>
													<select class="form-control select2 custom-select" name="subject" data-placeholder="Choose one">
														<option label="اختر مجزوءة"></option>
														<?php foreach($subjects as $s): ?>
														<option <?=(isset($teacher) && $teacher->subjectId==$s->id)?'selected':'';?> value="<?=$s->id;?>"><?=$s->name?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<?php endif; ?>

												<?php if(!isset($teacher) || $userRole == '1'): ?>
												<div class="form-group m-0">
													<div class="form-label">الاقسام</div>
													<div class="custom-controls-stacked">
														<?php foreach($classes as $class): ?>
														<label class="custom-control custom-checkbox d-inline-block ml-1 mr-1">
															
															<input type="checkbox" class="custom-control-input" <?= (isset($teacherClass)&&in_array($class->id,$teacherClass))?'checked':'';?> name="classes[]" value="<?=$class->id;?>">
															<span class="custom-control-label"><?=$class->name;?></span>
														</label>	
														<?php endforeach; ?>
													</div>
												</div>
												<?php endif; ?>
												
												<input type="submit" name="addTeacher" class="btn btn-primary mt-3" value="حفظ"/>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
