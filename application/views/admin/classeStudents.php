						<div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card text-right">
								<div class="card-body">
                                	<div class="table-responsive">
									<table id="" class="table table-striped table-bordered" style="width:100%;direction: rtl;">
										<thead>
											<tr>
												<th rowspan="2" class="wd-15p text-rigth">الاسم</th>
												<?php foreach($subjects as $sub): ?>
												<th colspan="3" class="wd-15p text-center"><?=$sub->name;?></th>
												<?php endforeach; ?>
												<?php foreach($resSubjects as $sub): ?>
												<th colspan="3" class="wd-15p text-center"><?=$sub->name;?></th>
												<?php endforeach; ?>
											</tr>
											<tr>
												<?php foreach($subjects as $sub): ?>
													<td>المراقبة المستمرة</td>
													<td>الاختبار الكتابي</td>
													<td>المعدل</td>
												<?php endforeach; ?>

												<?php foreach($resSubjects as $sub):
													$subsub = $this->subject_model->getSubSubjects($sub->id);
													?>
													<?php foreach($subsub as $ss): ?>
													<td><?=$ss->name;?></td>
													<?php endforeach; ?>
													<td>المعدل</td>
												<?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach($students as $s): ?>
											<tr>
												<td><?=$s->name;?></td>
												<?php foreach($subjects as $sub):
													$point = $this->point_model->getPointsByStudent($s->id,$sub->id);
													?>
													<td><?=(!empty($point))?(float)$point->sc:'0';?></td>
													<td><?=(!empty($point))?(float)$point->te:'0';?></td>
													<td>0</td>
												<?php endforeach; ?>

												<?php foreach($resSubjects as $sub):
													$point = $this->point_model->getPointsByStudent($s->id,$sub->id);
													?>
													<td><?=(!empty($point))?(float)$point->sc:'0';?></td>
													<td><?=(!empty($point))?(float)$point->te:'0';?></td>
													<td>0</td>
												<?php endforeach; ?>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<button class="btn btn-primary mt-2 d-print-none" onclick="window.print()">طباعة</button>
                                </div>
								<!-- table-wrapper -->

							</div>
							<!-- section-wrapper -->

							</div>
						</div>