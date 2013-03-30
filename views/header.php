<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $page_title.$site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="<?php echo url::site().'themes/madev/css/dynatree/skin-vista/ui.dynatree.css' ?>" rel="stylesheet" type="text/css">
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
	<?php echo $header_block; ?>
	<?php Event::run('ushahidi_action.header_scripts'); // Action::header_scripts - Additional Inline Scripts from Plugins ?>
	<link href="<?php echo url::site().'themes/madev/css/bootstrap-combined.no-icons.min.css' ?>" rel="text/css" >
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo url::site().'themes/madev/css/bootstrap-overwrite.css' ?>" rel="text/css">
	<link href="<?php echo url::site().'themes/madev/css/tablecloth.css' ?>" rel="stylesheet" type="text/css">
	<script src="<?php echo url::site().'themes/madev/js/tablecloth/jquery.tablecloth.js' ?>" type="text/javascript"></script>
	<script src="<?php echo url::site().'themes/madev/js/jquery.dynatree.min.js' ?>" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.tltp').tooltip();
			
			// bar notification
			$('.downbar').show();          
			$('.jquery-bar').hide();
			$('.jquery-arrow').click(function(){
				$('.downbar').toggleClass('up', 500);          
				if($("#downbar").hasClass("up")) $('#topheader').css("margin-top", "0");
				else $('#topheader').css("margin-top", "40px");
				$('.jquery-bar').slideToggle();
			});  
			
			
			//Box widget Head Buttons
			$('.widget-title .btn').live("click",function(){
				var cls = $(this).find('i')[0].className; //Get classname of icon in button
				//Based on classname determine the task to be executed
				if( cls === 'icon-chevron-up' ){
					var bb = $(this).parent().parent().parent()[0];
					var	bbody = $(bb).find('.widget-content')[0];
					/* var bfooter = $(bb).find('.box-widget-footer')[0];*/
					/*bb.classList.add('box-widget-hide');*/
					$(bbody).slideUp(500);
					/*$(bfooter).hide();*/
				}
				if ( cls == 'icon-chevron-down' ){
					var bb = $(this).parent().parent().parent()[0];
					var bbody = $(bb).find('.widget-content')[0];
					/*var bfooter = $(bb).find('.box-widget-footer')[0];*/
					/*bb.classList.remove('box-widget-hide')*/;
					$(bbody).slideDown(500);
					/*$(bfooter).show();*/
				}
				/*
				if( cls == 'icon-remove' ){
					var bb = $(this).parent().parent().parent()[0];
					$(bb).fadeOut();
				}*/
			});
			
			/* Dropdown with form */
			$('.dropdown-menu').find('form').click(function (e) {
				e.stopPropagation();
			});
			  
		});
	</script>
</head>

<?php
  // Add a class to the body tag according to the page URI
  // we're on the home page
  if (count($uri_segments) == 0){ $body_class = "page-main"; }
  // 1st tier pages
  elseif (count($uri_segments) == 1){$body_class = "page-".$uri_segments[0];}
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2){$body_class = "page-".$uri_segments[0]."-".$uri_segments[1];}
?>

<body id="page" class="<?php echo $body_class; ?>">

	<div class="jquery-bar navbar navbar-fixed-top">
		<span class="notification">
			<p class="font-style">
				<a href="<?php echo url::site()."reports/submit" ?>"><?php echo Kohana::lang('ui_main.submit'); ?></a><!-- SUBMIT INCIDENT -->
			</p> 
			<p class="jquery-arrow down"><i class="icon-circle-arrow-up" style="cursor:pointer;"></i></p>
		</span>
	</div>
	<span id="downbar" class="downbar jquery-arrow"><i class="icon-plus-sign" style="cursor:pointer;"></i></span>






	<div id="topheader">
		<div class="container">
			<div class="row-fluid">
				<ul id="topbar" class="span12">
					<li class="pull-left">
						<a href="<?php echo url::site();?>"><i class="icon-cogs"></i> <?php echo $site_name; ?></a>
					</li>
					<li class="pull-right">
						<!-- LANGUAGE -->
						<div class="pull-right" style="margin:0 5px"><?php echo $languages;?></div>
					</li>
					<?php if(isset(Auth::instance()->get_user()->id)){ ?>
						<li class="parent pull-right">
							<a data-toggle="dropdown" href="#">
								<i class="icon-user"></i>
								<span><?php echo htmlentities(Auth::instance()->get_user()->username, ENT_QUOTES, "UTF-8"); ?></span>
							</a>
							<ul class="dropdown-menu">
								<?php if(Auth::instance()->get_user()->dashboard() != ""){ ?>
									<?php $adminLink = Auth::instance()->get_user()->dashboard(); ?>
									<li><a href="<?php echo $adminLink."/profile";?>"><?php echo Kohana::lang('ui_main.manage_your_account'); ?></a></li>
									<li><a href="<?php echo $adminLink;?>"><?php echo Kohana::lang('ui_main.your_dashboard'); ?></a></li>
								<?php } ?>
								<li><a href="<?php echo url::site();?>profile/user/<?php echo Auth::instance()->get_user()->username; ?>">
									<?php echo Kohana::lang('ui_main.view_public_profile'); ?></a>
								</li>
								<li><a href="<?php echo url::site();?>logout"><em><?php echo Kohana::lang('ui_admin.logout');?></em></a></li>
							</ul>
						</li>
					<?php }else{ ?>
						<li class="pull-right">
							<a href="#modalLogin" class="pull-right" data-toggle="modal">
								<i class="icon-user"></i>
								<span><?php echo Kohana::lang('ui_main.login'); ?></span>
							</a>
						</li>
					<?php }	?>
				</ul>
			</div>
		</div>
	</div>


	<!-- header -->
	<div class="container" style="margin-top:5px">
		<div class="row-fluid">
			<div id="header" class="span12">
				<!-- logo -->
				<?php if ($banner == NULL): ?>
				<div id="logo">
					<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
					<span><?php echo $site_tagline; ?></span>
				</div>
				<?php else: ?>
				<a href="<?php echo url::site();?>"><img src="<?php echo $banner; ?>" alt="<?php echo $site_name; ?>" style="width:90%" /></a>
				<?php endif; ?>
				<!-- / logo -->
				<?php Event::run('ushahidi_action.main_sidebar'); ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<?php nav::main_tabs($this_page); ?>
				</ul>

				
				<!-- SEARCH -->	
				<div class="pull-right">				
					<form id="formSearch" action="search" class="navbar-search">
						<div class="input-append">
							<input name="k" type="text" placeholder="<?php echo Kohana::lang('ui_main.search') ?>" class="search-query span2">
							<button class="btn btn-inverse" type="button" onclick="javascript:$('#formSearch').submit()">
								<i class="icon-search"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	





	<!-- wrapper -->
	<div class="container floatholder">
	
		<?php Event::run('ushahidi_action.header_item'); // Action::header_item - Additional items to be added by plugins ?>
        <?php if(isset($site_message) AND $site_message != '') { ?>
			<div class="alert alert-info"">
   				<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
   				<i class="icon-info-sign"></i> <?php echo $site_message; ?>
    		</div>
		<?php } ?>

		<!-- main body -->
		<div id="middle" class="row-fluid">
			<div class="background layoutleft span12">
























<div id="modalLogin" class="modal hide fade" role="dialog">
	 <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
		<h3 id="myModalLabel"><?php echo Kohana::lang('ui_main.login'); ?></h3>
	</div>
	<div class="modal-body">
		<?php echo form::open('login/', array('id' => 'userpass_form')); ?>
			<input type="hidden" name="action" value="signin" />
			<div class="control-group">
				<label class="control-label" for="username"><?php echo Kohana::lang('ui_main.email');?></label>
				<div class="controls"><input type="text" name="username" id="username" class="" /></div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="password"><?php echo Kohana::lang('ui_main.password');?></label>
				<div class="controls"><input name="password" type="password" class="" id="password" size="20" /></div>
			</div>
			<input class="btn" type="submit" name="submit" value="<?php echo Kohana::lang('ui_main.login'); ?>" class="header_nav_login_btn" />
		<?php echo form::close(); ?>

		<ul>
			<li><a href="<?php echo url::site()."login/?newaccount";?>"><?php echo Kohana::lang('ui_main.login_signup_click'); ?></a></li>
			<li><a href="#" id="header_nav_forgot" onclick="return false"><?php echo Kohana::lang('ui_main.forgot_password');?></a></li>
		</ul>
	</div>
</div>