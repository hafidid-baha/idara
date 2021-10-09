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
													<option value="<?=$s->id;?>"><?=$s->name;?></option>
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
										<h3 class="card-title">نقاط مجزوءة تكنولوجيا تدبير المعلومات</h3>
									</div>
									<div class="table-responsive text-right">
										<form action="<?=site_url('user/addPoints/');?>" method="POST">
											<table class="table card-table table-vcenter text-nowrap table-primary" >
												<thead  class="bg-primary text-white">
													<tr >
														<th class="text-white">الرقم</th>
														<th class="text-white">اسم الطالب</th>
														<th class="text-white">المراقبة المستمرة</th>
														<th class="text-white">الاختبار الكتابي</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php foreach($students as $s): ?>
													<tr>
														<th scope="row"><?=$s->code;?></th>
														<td><?=$s->name?></td>
														<td><input type="number" name="sc_<?=$s->id;?>" value="<?=isset($s->sc)?$s->sc:'0';?>" min="0" step="0.1" id="" class="rounded border border-primary p-1 m-0" /></td>
														<td><input type="number" name="te_<?=$s->id;?>" value="<?=isset($s->te)?$s->te:'0';?>" min="0" step="0.1" id="" class="rounded border border-primary p-1 m-0" /></td>
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