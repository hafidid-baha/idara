                        <div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card text-right">
								<div class="card-header" style="direction: rtl;">
									<a href="<?=site_url('student/add');?>" class="btn btn-primary d-inline-block">اظافة طالب جديد</a>
								</div>
								<div class="card-body">
									<form action="<?=site_url('admin/student');?>" class="text-center" method="POST">
										<div class="row">
											<div class="col-6">
												<div class="form-group text-right">
													<label class="form-label">الموسم الدراسي</label>
													<select class="form-control select2 custom-select" name="season" style="direction: rtl;" data-placeholder="Choose one">
														<option label="اختر الموسم الدراسي المناسب">
														</option>
														<?php foreach($seasons as $s): ?>
														<option value="<?=$s->id;?>"><?=$s->content;?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group text-right">
													<label class="form-label">القسم</label>
													<select class="form-control select2 custom-select" name="classe" style="direction: rtl;" data-placeholder="Choose one">
														<option label="اختر القسم المناسب">
														</option>
														<?php foreach($classes as $c): ?>
														<option value="<?=$c->id;?>"><?=$c->name;?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
										<input type="submit" class="btn btn-primary mx-auto" name="filterStudents" value=" تحديث بيانات الطلاب" />
									</form>
									<hr/>
                                	<div class="table-responsive">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">الرقم</th>
												<th class="wd-15p">الاسم</th>
												<th class="wd-15p">البريد</th>
												<th class="wd-20p">الهاتف</th>
												<th class="wd-15p">رقم التاجير</th>
												<th class="wd-15p">رقم البطاقة الوطنية</th>
												<th class="wd-10p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($students as $std): ?>
											<tr>
												<td><a href="<?=site_url('admin/studentCert/').$std->id;?>" class="text-dark"><?=$std->code;?></a></td>
												<td><a href="<?=site_url('admin/studentCert/').$std->id;?>" class="text-dark"><?=$std->name;?></a></td>
												<td><?=$std->email;?></td>
												<td><?=$std->phone;?></td>
												<td><?=$std->dot;?></td>
												<td><?=$std->cin;?></td>
												<td class="text-center">
													<a href="<?= site_url('student/update/').$std->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?= site_url('student/remove/').$std->id;?>" onclick="showDeleteConfirm(this,event);" class="text-primary pl-2 pr-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
                                </div>
								<!-- table-wrapper -->
							</div>
							<!-- section-wrapper -->

							</div>
						</div>