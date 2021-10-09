<!doctype html>
<html lang="en" dir="ltr">
	<head>
	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

		<!-- Title -->
		<title>crmef</title>
		<link rel="stylesheet" href="<?=base_url();?>assets/fonts/fonts/font-awesome.min.css">
		
		<!-- Font Family-->
        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

		<!-- Dashboard Css -->
		
		<link href="<?=base_url();?>assets/css/dashboard.css" rel="stylesheet" />
		

		<!-- c3.js Charts Plugin -->
		<link href="<?=base_url();?>assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />
		<link href="<?=base_url();?>assets/plugins/morris/morris.css" rel="stylesheet" />
		
		<!-- Custom scroll bar css-->
		<link href="<?=base_url();?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
		
		<!---Font icons-->
		<link href="<?=base_url();?>assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
		<link href="<?=base_url();?>assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
		
		<!-- Notifications  Css -->
		<link href="<?=base_url();?>assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
		
        <!-- Data table css -->
		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
	</head>
	<body class="">
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				<div class="header py-4">
					<div class="container">
						<div class="d-flex">
							<div class="d-flex">
								<div class="dropdown">
									<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
										<span class="avatar avatar-md brround" style="background-image: url(<?=base_url();?>uploads/<?= $this->session->userdata('userImage');?>)"></span>
										<span class="ml-2 d-none d-lg-block">
											<span class="text-dark"><?=$this->session->userdata('username')?></span>
										</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a class="dropdown-item text-right" href="<?=site_url('blog/posts')?>">
											الصفخة الامامية
										</a>
										<?php if($this->session->userdata('userRole') != 2): ?>
										<!-- <a class="dropdown-item text-right" href="#">
											الاعدادات
										</a> -->
										<a class="dropdown-item text-right" href="<?= site_url('/blog/index');?>">
											المدونة
										</a>
										<a class="dropdown-item text-right" href="<?=site_url('teacher/update/').$this->session->userdata('userId');?>">
											الملف السخصي
										</a>
										<?php endif; ?>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item text-right" href="<?= site_url('/login/logout');?>">
											خروج
										</a>
									</div>
								</div>
                            </div>
                            <a class="header-brand ml-auto order-lg-2" href="<?=site_url('blog/posts')?>">
								<img src="<?=base_url();?>assets/images/logo-short.png" class="header-brand-img" alt="وزارة التربية والتعليم">
							</a>

							<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
							<span class="header-toggler-icon"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="vobilet-navbar" id="headerMenuCollapse">
					<div class="container">
						<ul class="nav" style="direction: rtl;">
							<li class="nav-item">
								<?php if($this->session->userdata('userRole') == 1): ?>
								<a class="nav-link <?=$page=='index'?'active':'';?>" href="<?=site_url('admin/index');?>">
									<span> الرئيسية</span>
								</a>
								<?php else: ?>
								<a class="nav-link <?=$page=='index'?'active':'';?>" href="<?=site_url('user/index');?>">
									<span> الرئيسية</span>
								</a>
								<?php endif; ?>
							</li>
							<?php if($this->session->userdata('userRole') == 1): ?>
								<li class="nav-item">
									<a class="nav-link <?=$page=='teachers'?'active':'';?>" href="<?=site_url('admin/teacher');?>">
										<span>الاساتذة</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?=$page=='classes'?'active':'';?>" href="<?=site_url('admin/classe');?>">
										<span>الاقسام</span>
									</a>
								</li> 
								<li class="nav-item">
									<a class="nav-link <?=$page=='subjects'?'active':'';?>" href="<?=site_url('admin/subject');?>">
										<span>المجزوءات</span>
									</a>
								</li>
							<?php endif; ?>
							<?php if($this->session->userdata('addStudentPerm') == 1 || $this->session->userdata('userRole') == 1): ?>
								<li class="nav-item">
									<a class="nav-link <?=$page=='students'?'active':'';?>" href="<?=site_url('admin/student');?>">
										<span>الطلبة</span>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
                </div>

                <div class="my-3 my-md-5">
					<div class="container">