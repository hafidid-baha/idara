
                                <div class="card text-right">
									<!-- <div class="card-header" style="direction:rtl;">
										جميع المقالات
									</div> -->
									<div class="card-body" style="direction:rtl">
                                        <div class="row mt-4">
                                            <?php foreach($subjects as $subject):
                                                
                                                $sub = $this->subject_model->getSubSubjects($subject->id);
                                                // echo var_dump($sub);
                                                ?>
                                            <div class="col-md-6 col-xs-12">
												<div class="row justify-content-center">
                                                    <div class="col-10">
                                                        <div class="expanel expanel-default">
                                                        <div class="expanel-heading"><?=$subject->name?></div>
                                                            <div class="expanel-body">
                                                                <table class="borderless w-100" dir="rtl">
                                                                    <thead>
                                                                        <th><?=isset($sub) && !empty($sub) ?$sub[0]->name:'المراقبة المستمرة' ?></th>
                                                                        <th><?=isset($sub) && !empty($sub) ?$sub[1]->name:'الامتحان الكتابي' ?></th>
                                                                        <th>المعدل العام</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <?php
                                                                                $points = $this->point_model->getPointsByStudent($this->session->userdata('userId'),$subject->id);
                                                                                // echo var_dump($points);
                                                                            ?>
                                                                            <td><?=isset($points) && !empty($points) ? $points->sc : '0'?></td>
                                                                            <td><?=isset($points) && !empty($points) ? $points->te : '0'?></td>
                                                                            <td><?=isset($points) && !empty($points) ? ($points->te+$points->sc)/2 : '0'?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php endforeach; ?>
											
										</div>
									</div>
								</div>