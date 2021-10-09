						<div class="row">
							<div class="col">
								<div class="card text-right">
									<div class='card-body'>
										<a href="<?=site_url('/blog/addType');?>" class="btn btn-primary">اظافة نوع مقال جديد</a>
										<a href="<?=site_url('/blog/add');?>" class="btn btn-primary">اظافة مقال جديد </a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="card text-right">
									<div class="card-header" style="direction:rtl;">
										جميع المقالات
									</div>
									<div class="card-body">
									<table id="teachers" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th class="wd-15p">العنوان</th>
												<th class="wd-15p">تاريخ النشر</th>
												<th class="wd-20p">الناشر</th>
												<th class="wd-15p">التحكم</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($posts as $p):
												$user = $this->teacher_model->getTeacher($p->user);	
											?>
											<tr>										
												<td><?=$p->title;?></td>
												<td><?=$p->date;?></td>
												<td><?=$user->name?></td>
												<td class="text-center">
													<a href="<?=site_url('blog/update/').$p->id;?>" class="text-primary pl-2 pr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?=site_url('blog/remove/').$p->id;?>" class="text-primary pl-2 pr-2" onclick="showDeleteConfirm(this,event);"><i class="fa fa-trash" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
						