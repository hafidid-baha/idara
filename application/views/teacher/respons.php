<!-- start of the changed section  -->
						<div class="row">
							<div class="card" style="direction: rtl;">
								<div class="col-md-6 col-lg-6 mx-auto text-right">
									<div class="card-body">
										<form action="<?= site_url('user/refresh');?>" method="POST">
											<div class="form-group ">
												<label class="form-label">القسم</label>
												<select name="classe" class="form-control select2 custom-select" data-placeholder="Choose one">
													<!-- <option label="اختر القسم المناسب"></option> -->
                                                    <?php foreach($classes as $c): ?>
													<option <?=($this->session->userdata('teacher_classe')==$c->classe_id)?'selected':''?> value="<?=$c->classe_id;?>"><?=$c->name;?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
											<div class="form-group ">
												<label class="form-label">المجزوءة</label>
												<select name="subject" class="form-control select2 custom-select" data-placeholder="Choose one">
													<!-- <option label="اختر المجزوءة المناسبة"></option> -->
                                                    <?php foreach($subject as $s): ?>
													<option <?=$s->id==$this->session->userdata('teacher_sub')?'selected':'';?> value="<?=$s->id;?>"><?=$s->name;?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
											<input type="submit" class="btn btn-primary text-right" name="" value="تحديث المعلومات" />
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card  p-1" style="direction: rtl;">
									<div class="card-header">
										<h3 class="card-title">نقاط المجزوءة</h3>
									</div>
									<div class="table-responsive text-right">
										<form action="<?=site_url('user/addResPoints/');?>" method="POST">
											<table class="table card-table table-vcenter text-nowrap" >
												<thead  class="text-white">
													<tr >
														<th class="text-dark">الرقم</th>
														<th class="text-dark">اسم الطالب</th>
														<th class="text-dark">اقسام المجزوءة</th>
														<th class="text-dark">النتيجة</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php foreach($students as $s): ?>
													<tr>
														<th rowspan="2" scope="row"><?=$s->code;?></th>
														<td rowspan="2"><?=$s->name?></td>
														<td><?=$subSubjects[0]->name;?></td>
														<td>
															<input type="number" name="<?='M_'.$s->id.'_'.$subSubjects[0]->id;?>" classe="border rounded" value="<?=(isset($s->sc)&&$this->session->userdata('teacher_sub')==$s->subject)?$s->sc:'0'?>" min="0" />
														</td>
													</tr>
													<tr>
														<td><?=$subSubjects[1]->name;?></td>
														<td>
															<input type="number" name="<?='M_'.$s->id.'_'.$subSubjects[1]->id;?>" classe="border rounded" value="<?=(isset($s->sc)&&$this->session->userdata('teacher_sub')==$s->subject)?$s->te:'0'?>" min="0"/>
														</td>
													</tr>
                                                    <?php endforeach; ?>
												</tbody>
											</table>
											<input type="submit" class="btn btn-primary text-right m-2" name="" value="حفظ" />
										</form>
									</div>
									<!-- table-responsive -->
								</div>
							</div>
						</div>
						<!-- ends of the changed section -->