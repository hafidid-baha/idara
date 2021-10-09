						<div class="row">
							<div class="col-lg-12 text-center d-print-none">
								<button id="print" class="btn btn-primary">اطبع</button>
							</div>
							<div class="col-lg-12 mt-2">
								<div class="card rounded-0 text-center">
									<img src="<?=base_url()?>assets/images/header.png" width="600" class="mx-auto" alt="وزارة التربية والتعليم">
									<p class="text-center mt-1">المركزالجهوي لمهن التربية والتكويين سوس ماسة انزكان</p>
									<p class="text-center mt-1">مسلك تكوين اطر الادارة التربوية</p>
									<h3 class="font-weight-bold mt-1 mb-5">بيان النقط</h3>
									<div class="w-75 mx-auto border border-dark" style="direction: rtl;">
										<div class="row">
											<div class="col-6 text-right">الاسم : <?=$student->name;?></div>
											<div class="col-6 text-right">رقم الاجير : <?=$student->dot;?></div>
										</div>
										<div class="row mt-3">
											<div class="col-6 text-right">رقم البطاقة الوطنية : <?=$student->cin;?></div>
											<div class="col-6 text-right">السنة التكوينية : <?=$season->content;?></div>
										</div>
									</div>
									<div class="row text-center mt-5">
										<div class="col-8 mx-auto">
											<div class="row">
												<div class="col-md-12 col-lg-12">
													<div class="table-responsive text-right">
														<table dir="rtl" class="table card-table table-vcenter text-nowrap">
															<thead >
																<tr>
																	<th>المجزوءات</th>
																	<th>النقطة على 20</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($subjects as $subject): 
																	if($subject->name=='امتحان التخرج'):
																	$point = $this->point_model->getPointsByStudent($student->id,$subject->id);
																	?>
																	<tr>
																		<td class="p-1 m-0">
																			<table>
																				<tr>
																					<td class="p-1 m-0" rowspan="2">امتحان التخرج</td>
																					<td class="p-1 m-0">الشق الكتابي</td>
																				</tr>
																				<tr>
																					<td class="p-1 m-0">الشق الشفوي</td>
																				</tr>
																			</table>
																		</td>
																		<td class="text-center">
																		<table class="w-100">
																				<tr>
																					<td class="p-1 m-0"><?= $point->sc??'0' ?></td>
																				</tr>
																				<tr>
																					<td class="p-1 m-0"><?= $point->te??'0' ?></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<?php else: 
																		$point = $this->point_model->getPointsByStudent($student->id,$subject->id);
																		if(!empty($point)){
																			$pointr = (($point->sc)+($point->te))/2;
																		}else{
																			$pointr = 0;
																		}
																		?>
																	<tr >
																		<td class="p-1 m-0"><?=$subject->name;?></td>
																		<td class="p-1 m-0 text-center"><?=$subject->name=="البحث" ? $point->te :$pointr?></td>
																	</tr>
																	<?php endif; ?>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row mt-5 mb-5">
												<div class="col mt-5 mb-5 text-center">
													<b>خاتم وتوقيع مدير المركز</b>
												</div>	
											</div>
										</div>
									</div>

									<div class="row mt-5 mb-2">
										<div class="col mt-5 pt-5">
											<small>يسلم بيان النقط في اصل واحد , ويمكن عند الحاجةاستخراج نسخ والمصادقة عليها من طرف السلطات المختصة</small>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>