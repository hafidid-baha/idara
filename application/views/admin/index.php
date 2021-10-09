
						<div class="row text-center">
							<div class="col-md-3">
								<div class="card p-3 px-4">
									<div>الاساتذة</div>
									<div class="py-4 m-0 text-center h1 text-green"><?=$teachersCount != null ?$teachersCount:'0'?></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 px-4">
									<div>المجزوءات</div>
									<div class="py-4 m-0 text-center h1 text-red"><?=$subjectsCount != null ?$subjectsCount:'0'?></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 px-4">
									<div>الاقسام</div>
									<div class="py-4 m-0 text-center h1 text-blue"><?=$classesCount != null ?$classesCount:'0'?></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card p-3 px-4">
									<div>الطلبة</div>
									<div class="py-4 m-0 text-center h1 text-yellow"><?=$studentsCount != null ?$studentsCount:'0'?></div>
								</div>
							</div>
						</div>
						<?php if($createSeasAvailable): ?>
						<div class="row text-center">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3>بداية موسم تكويني جديد</h3>
										<P>لبداية موسم تكويني جديد <?=$currentSeason?> اضغط علي الزر ادناه</p>
										<a href="<?=site_url('admin/createSeason');?>" class="btn btn-primary">بداية موسم تكويني جديد</a>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<div class="row" style="direction: rtl;">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="jumbotron">
											<h1 class="display-3 text-center">اختيار الموسم الدراسي</h1>
											<p class="lead text-center">المرجوا اختيار الموسم الدراسي المناسب فوفقا للموسم الدراسي المختار البيانات المعروضة في النظام قد تتغير</p>
											<hr class="my-4">
											
											<div class="row">
												<div class="col-lg-6 text-right mx-auto">
													<form action="" method="POST">
														<div class="form-group ">

															<label class="form-label">الموسم الدراسي</label>
															<select class="form-control select2 custom-select" name="season" required data-placeholder="Choose one">
																<option label="اختر موسم دراسي">
																</option>
																<?php foreach($seasons as $s): ?>
																<option <?= $sessionSeason==$s->content?'selected':'';?> value="<?=$s->id;?>"><?=$s->content;?></option>
																<?php endforeach; ?>
															</select>
															
														</div>
														<input type="submit" name="updateSeason" value="تم" class="btn btn-primary mt-2 pl-4 pr-4" />
													</form>
													<small class="text-center">سيتم جلب بيانات النظام بداية من الموسم الدراسي المختار</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>