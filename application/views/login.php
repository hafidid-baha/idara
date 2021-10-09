                    <div class="row">
                    	<div class="col col-login mx-auto">

                    		<form action='<?= site_url('login/login'); ?>' class="card" method="post">
                    			<div class="card-body p-6" style="direction: rtl;">
                    				<div class="text-center mb-6">
                    					<img src="<?= base_url(); ?>assets/images/logo-short.png" class="h-7" alt="">
                    				</div>
                    				<div class="card-title text-center">تسجيل الدخول</div>
                    				<div class="form-group">
                    					<label class="form-label text-right">اسم المستخدم</label>
                    					<input type="text" name="username" value="admin" class="form-control" id="exampleInputEmail1" placeholder="اسم المستخدم">
                    				</div>

                    				<div class="form-group">
                    					<label class="form-label text-right">كلمة المرور</label>
                    					<input type="password" name="password" value="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                    				</div>

                    				<div class="form-group text-right">
                    					<label class="form-label text-right d-inline-block">طالب <input class="d-inline-block" type="radio" name="loginType" value="student" class="form-control"></label>
                    					<label class="form-label text-right d-inline-block mr-2">استاذ او مدير <input checked class="d-inline-block" type="radio" name="loginType" value="teacher" class="form-control"></label>
                    				</div>

                    				<div class="form-group text-right" style="direction: rtl;">
                    					<label class="custom-control custom-checkbox">
                    						<input type="checkbox" name="remember" class="custom-control-input text-right" />
                    						<span class="custom-control-label">تذكرني</span>
                    					</label>
                    				</div>
                    				<div class="form-footer">
                    					<button type="submit" name="login" class="btn btn-primary btn-block">دخول</button>
                    				</div>
                    			</div>

                    		</form>
                    	</div>
                    </div>