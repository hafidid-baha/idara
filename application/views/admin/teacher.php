<div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card text-right">
								<div class="card-header" style="direction: rtl;">
									<a href="<?=site_url('teacher/add')?>" class="btn btn-primary d-inline-block">اظافة استاذ جديد</a>
								</div>
								<div class="card-body">
                                	<div class="table-responsive">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">الاسم</th>
												<th class="wd-15p">البريد</th>
												<th class="wd-20p">الهاتف</th>
												<th class="wd-15p">المجزوءة</th>
												<th class="wd-10p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($teachers as $t): ?>
											<tr>
												<td><?=$t->name; ?></td>
												<td><?=$t->email; ?></td>
												<td><?=$t->tel; ?></td>
												<td><?=($t->isRisponsible==1 && $t->subjectId==0) ? 'المسؤول' : $t->sname; ?></td>
												<td class="text-center">
													<a href="<?= site_url('teacher/update/').$t->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?= site_url('teacher/remove/').$t->id;?>" onclick="showDeleteConfirm(this,event);" class="text-primary pl-2 pr-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
                                </div>
								<!-- table-wrapper -->
							</div>
							<!-- section-wrapper -->

							</div>
						</div>