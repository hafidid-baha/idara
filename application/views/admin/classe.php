                        <div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card text-right">
								<div class="card-header" style="direction: rtl;">
									<a href="<?= site_url('classe/add');?>" class="btn btn-primary d-inline-block">اظافة قسم جديد</a>
								</div>
								<div class="card-body">
                                	<div class="table-responsive">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">الاسم</th>
												<th class="wd-15p">عدد الطلبة</th>
												<th class="wd-10p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($classes as $classe): ?>
											<tr>
												<td>
													<a href="<?=site_url('admin/classeStudents/').$classe->id;?>" class="text-dark"><?=$classe->name; ?></a>
												</td>
												<td><?=$this->student_model->getStudentsCountInClasse($classe->id)->count;?></td>
												<td class="text-center">
													<a href="<?=site_url('classe/update/').$classe->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?=site_url('classe/remove/').$classe->id;?>" onclick="showDeleteConfirm(this,event);" class="text-primary pl-2 pr-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
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