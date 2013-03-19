<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $page_title.$site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<?php echo $header_block; ?>
	<?php
		// Action::header_scripts - Additional Inline Scripts from Plugins
		Event::run('ushahidi_action.header_scripts');
	?>
	
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="text/css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	<link href="../css/bootstrap-overwrite.css" rel="text/css">
	
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.tltp').tooltip()
		});
	</script>
</head>


<?php
  // Add a class to the body tag according to the page URI
  // we're on the home page
  if (count($uri_segments) == 0)
  {
    $body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }

?>

<body id="page" class="<?php echo $body_class; ?>">


<ul class="on-click" id="topbar">
	<li class="pull-left">
    	<h1 id="topbar-title">
      		<i class="icon-cogs"></i>
			<a href="<?php echo url::site();?>"><?php echo $site_name; ?></a>
    	</h1>
  	</li>
  	
		<!--
		<a data-toggle="dropdown" href="#">
		  <i class="icon-user"></i>
		  <span>John Adminsky</span>
		</a>
		<ul class="dropdown-menu">
		  <li><a href="#">Profile</a></li>
		  <li><a href="#">Finances</a></li>
		  <li class="divider"></li>
		  <li><a href="#">Logout</a></li>
		</ul>
		-->
		<?php if(isset(Auth::instance()->get_user()->id)){ ?>
			<li class="parent pull-right">
				<a data-toggle="dropdown" href="#">
					<i class="icon-user"></i>
					<span><?php echo htmlentities(Auth::instance()->get_user()->username, ENT_QUOTES, "UTF-8"); ?></span>
				</a>
				<ul class="dropdown-menu">
					<?php if(Auth::instance()->get_user()->dashboard() != ""){ ?>
						<?php $adminLink = Auth::instance()->get_user()->dashboard(); ?>
						<li><a href="<?php echo $adminLink;?>/profile"><?php echo Kohana::lang('ui_main.manage_your_account'); ?></a></li>
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

	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
<!--	
  <li class="parent pull-right">
    <a data-toggle="dropdown" href="#">
      <i class="icon-cog"></i>
      <span>Settings</span>
    </a>
    <ul class="dropdown-menu">
      <li><a href="#">Backend Settings</a></li>
      <li><a href="#">Frontend Settings</a></li>
    </ul>
  </li>-->
  <!-- <li class="pull-right">
    <a href="page-login.html">
      <i class="icon-sign-blank"></i>
      <span>Sign in</span>
    </a>
  </li>-->
</ul>
























	<div class="navbar navbar-inverse navbar-fixed-top" style="margin-top:30px"> <!--navbar-fixed-top-->
    	<div class="navbar-inner">
			<!-- SUBMIT INCIDENT -->
			<div class="pull-left"><?php echo $submit_btn; ?></div>
			
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
	
	
	

	
	
	
	<!-- header -->
	<div class="container" style="margin-top:72px">
		<div class="row-fluid">
			<div id="header" class="span12">
				<!-- logo -->
				<?php if ($banner == NULL): ?>
				<div id="logo">
					<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
					<span><?php echo $site_tagline; ?></span>
				</div>
				<?php else: ?>
				<a href="<?php echo url::site();?>"><img src="<?php echo $banner; ?>" alt="<?php echo $site_name; ?>" /></a>
				<?php endif; ?>
				<!-- / logo -->
				<?php Event::run('ushahidi_action.main_sidebar'); ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="navbar" style="margin-top:1px">
			<div class="navbar-inner">
				<ul class="nav">
					<?php nav::main_tabs($this_page); ?>
				</ul>
				<!-- LANGUAGE -->
				<div class="pull-right" style="margin:0 5px"><?php echo $languages;?></div>
			</div>
		</div>
	</div>	





	<!-- wrapper -->
	<div class="container floatholder">

		<?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>

        <?php if(isset($site_message) AND $site_message != '') { ?>
			<div class="green-box">
				<h3><?php echo $site_message; ?></h3>
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