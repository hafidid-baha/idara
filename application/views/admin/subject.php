                        <div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card text-right">
								<div class="card-header" style="direction: rtl;">
									<a href="<?=site_url('subject/add');?>" class="btn btn-primary d-block">اظافة مجزوءة جديد</a>
								</div>
								<div class="card-body">
									<mark class="text-center d-block mb-4">المرجوا عدم اظافة المجزوئات التالية لانها موجودة سلفا (التداريب - البحث - امتحان التخرج)</mark>
                                	<div class="table-responsive">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">الاسم</th>
												<th class="wd-10p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($subjects as $s): ?>
											<tr>
												<td>
													<a href="" class="text-dark"><?=$s->name;?></a>
												</td>
												<td class="text-center">
													<a href="<?=site_url('subject/update/').$s->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?=site_url('subject/remove/').$s->id;?>" onclick="showDeleteConfirm(this,event);" class="text-primary pl-2 pr-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
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