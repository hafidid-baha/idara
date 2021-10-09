                <div class="my-3 my-md-5">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 text-center d-print-none">
								<button id="printC" class="btn btn-primary">اطبع</button>
							</div>
							<div class="col-lg-12 mt-2">
								<div class="card rounded-0 text-center">
									<img src="<?=base_url();?>assets/images/header.png" width="600" class="mx-auto" alt="وزارة التربية والتعليم">
									<p class="text-center mt-1">المركزالجهوي لمهن التربية والتكويين سوس ماسة انزكان</p>
									<hr class="pt-0 mt-0 mb-5 w-50 mx-auto"/>
									<h3 class="font-weight-bold mb-5">شهادة متابعة التكوين</h3>

									<p class="text-right w-75" style="font-size: 20px;">2019/<?=$certNumber;?>   الرقم</p>
									<p class="text-right w-75" style="font-size: 20px; direction:rtl;">تهم الاستاذ(ة) : <?=$student->name?></p>
									<p class="text-right w-75" style="font-size: 20px;direction:rtl;">رقم البطاقة الطنية : <?=$student->cin;?></p>
									<p class="text-right w-75" style="font-size: 20px;direction:rtl;">رقم التاجير  :  <?=$student->dot;?></p>
									<p class="text-right w-75" style="font-size: 20px;direction:rtl;">الاطار : <?=$student->cadre;?></p>
									<p class="text-right w-75" style="font-size: 20px;direction:rtl;">رقم التسجيل : <?=$student->code;?></p>

									<p class="text-right w-75 mt-0 pt-0" style="font-size: 20px;">ت يتابع التكوين بالمركز مسلك التكوين أطر الادارة التربوية <?=$season->content;?> ملحقة اكادير <br /><br />
									وقد سلمت له(ها) هذه الشهادة بطلب منه(ها) </p>
									<span class="d-inline-block" style="height: 50px;"></span>
									<p class="text-right mx-auto w-50 mt-0 pt-0" style="font-size: 20px;">حرر باكادير في : <?=date('Y/m/d')?></p>
									<span class="d-inline-block" style="height: 480px;"></span>
									<hr class="pt-0 mt-0 mb-5 w-75 mx-auto"/>
									<p class="text-center">
										المركز الجهوي لمهن التربية والتكوين سوس ماسة - انزكان
										<br />
										الهاتف 0528834855 /http://crmefsm.ac.ma
									</p>
								</div>
								
							</div>
						</div>
                    </div>
                </div> 
           
           <script>
           $("#print").on('click',function(){
                
			    //window.print();
			})
           </script>