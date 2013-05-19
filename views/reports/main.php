


<div id="content" >
	<div class="widget-box">
		<div class="widget-title">
			<h5>
				<i class="icon-globe"></i> <?php echo Kohana::lang('ui_main.showing_reports_from', array(date('M d, Y', $oldest_timestamp), date('M d, Y', $latest_timestamp))); ?>
			</h5>
			<div class="widget-toolbar pull-right btn-group">
				<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-down"></i></a>
				<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
			</div>
		</div>

		<div class="widget-content">
			<div class="row-fluid">
				
				<!-- reports-box -->
				<div id="reports-box1" class="span9"> <?php echo $report_listing_view; ?> </div>
				<!-- end #reports-box -->


				<div id="sidebar" class="span3">					

						<!-- filters-box -->
						<div class="actionFilter">
							<a href="javascript:void(0)" id="applyFilters" class="btn btn-danger"><?php echo Kohana::lang('ui_main.filter_reports'); ?></a>
							<a href="javascript:void(0)" id="reset_all_filters" class="btn btn-inverse"><?php echo Kohana::lang('ui_main.reset_all_filters'); ?></a> 
						</div>
						
						
						<ul>
							<li class="active"><i class="icon icon-filter"></i> <?php echo Kohana::lang('ui_main.filter_reports_by'); ?></li>
							
							
							
							<li class="submenu">
								<a href="#"><i class="icon-th-list"></i> <?php echo Kohana::lang('ui_main.category')?></a>
								<div style="position: relative; float: right; top: -31px; right: 40px; width:0">
									<a class="btn btn-info tltp" href="javascript:void(0)" onclick="removeParameterKey('c', 'fl-categories');" title="<?php echo Kohana::lang('ui_main.clear')?>">
										<i class="icon-remove-sign"></i>
									</a>
								</div>
								<ul class="filter-list fl-categories" id="category-filter-list">
									<li>
										<a href="#"><?php
										$all_cat_image = '&nbsp';
										$all_cat_image = '';
										if($default_map_all_icon != NULL) {
											$all_cat_image = html::image(array('src'=>$default_map_all_icon));
										}
										?>
										<span class="item-swatch" style="background-color: #<?php echo Kohana::config('settings.default_map_all'); ?>">
											<?php echo $all_cat_image ?>
										</span>
										<span class="item-title"><?php echo Kohana::lang('ui_main.all_categories'); ?></span>
										<span class="item-count" id="all_report_count"><?php echo $report_stats->total_reports; ?></span>
										</a>
									</li>
									<?php echo $category_tree_view; ?>
								</ul>
							</li>
							
							
							
							
							
							<li class="submenu">
								<a href="#"><i class="icon icon-calendar"></i> <?php echo Kohana::lang('ui_main.change_date_range'); ?></a>
								<ul>
									<li>
										<a title="<?php echo Kohana::lang('ui_main.all_time'); ?>" class="btn-date-range active" id="dateRangeAll" href="#">
											<?php echo Kohana::lang('ui_main.all_time')?>
										</a>
										<a title="<?php echo Kohana::lang('ui_main.today'); ?>" class="btn-date-range" id="dateRangeToday" href="#">
											<?php echo Kohana::lang('ui_main.today'); ?>
										</a>
										<a title="<?php echo Kohana::lang('ui_main.this_week'); ?>" class="btn-date-range" id="dateRangeWeek" href="#">
											<?php echo Kohana::lang('ui_main.this_week'); ?>
										</a>
										<a title="<?php echo Kohana::lang('ui_main.this_month'); ?>" class="btn-date-range" id="dateRangeMonth" href="#">
											<?php echo Kohana::lang('ui_main.this_month'); ?>
										</a>
										
										<p class="labeled-divider"><span><?php echo Kohana::lang('ui_main.choose_date_range'); ?>:</span></p>
										<?php echo form::open(NULL, array('method' => 'get')); ?>
											<strong><?php echo Kohana::lang('ui_admin.from')?>:</strong>
											<input id="report_date_from" type="text" style="width:78px" />
											<strong><?php echo ucfirst(strtolower(Kohana::lang('ui_admin.to'))); ?>:</strong>
											<input id="report_date_to" type="text" style="width:78px" />
											<a href="#" id="applyDateFilter" class="filter-button" style="position:static;"><?php echo Kohana::lang('ui_main.go')?></a>
										<?php echo form::close(); ?>
									</li>
								</ul>
							</li>
							
							
							
							<li class="submenu">
								<a class="accordion-toggle" data-toggle="collapse" href="#filterLocation" onclick="startLocation()">
									<i class="icon icon-globe"></i> <?php echo Kohana::lang('ui_main.location'); ?>
								</a>
								<div id="filterLocation" class="f-location-box collapse">
									<?php echo $alert_radius_view; ?>
								</div>
							</li>
							
							
							
							
							
							
							
							
							<li class="submenu">
								<a href="#"><i class="icon icon-random"></i> <?php echo Kohana::lang('ui_main.type')?></a>
								<div style="position: relative; float: right; top: -31px; right: 40px; width:0">
									<a class="btn btn-info tltp" href="javascript:void(0)" onclick="removeParameterKey('mode', 'fl-incident-mode')" title="<?php echo Kohana::lang('ui_main.clear')?>">
										<i class="icon-remove-sign"></i>
									</a>
								</div>	
								<ul class="filter-list fl-incident-mode">
									<li>
										<a href="#" id="filter_link_mode_1">
											<span class="item-icon ic-webform">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.web_form'); ?></span>
										</a>
									</li>
							
									<?php foreach ($services as $id => $name): ?>
										<?php
											$item_class = "";
											if ($id == 1) $item_class = "ic-sms";
											if ($id == 2) $item_class = "ic-email";
											if ($id == 3) $item_class = "ic-twitter";
										?>
										<li>
											<a href="#" id="filter_link_mode_<?php echo ($id + 1); ?>">
												<span class="item-icon <?php echo $item_class; ?>">&nbsp;</span>
												<span class="item-title"><?php echo $name; ?></span>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
							
							
							
							
							
							<li class="submenu">
								<a href="#"><i class="icon icon-desktop"></i> <?php echo Kohana::lang('ui_main.media');?></a>
								<div style="position: relative; float: right; top: -31px; right: 40px; width:0">
									<a class="btn btn-info tltp" href="javascript:void(0)" onclick="removeParameterKey('m', 'fl-media');" title="<?php echo Kohana::lang('ui_main.clear')?>">
										<i class="icon-remove-sign"></i>
									</a>
								</div>	
								<ul class="filter-list fl-media">
									<li>
										<a href="#" id="filter_link_media_1">
											<span class="item-icon ic-photos">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.photos'); ?></span>
										</a>
									</li>
									<li>
										<a href="#" id="filter_link_media_2">
											<span class="item-icon ic-videos">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.video'); ?></span>
										</a>
									</li>
									<li>
										<a href="#" id="filter_link_media_4">
											<span class="item-icon ic-news">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.reports_news')?></span>
										</a>
									</li>
								</ul>
							</li>
							
							
							
							
							
							<li class="submenu">
								<a href="#"><i class="icon icon-check"></i> <?php echo Kohana::lang('ui_main.verification'); ?></a>
								<div style="position: relative; float: right; top: -31px; right: 40px; width:0">
									<a class="btn btn-info tltp" href="javascript:void(0)" onclick="removeParameterKey('v', 'fl-verification');" title="<?php echo Kohana::lang('ui_main.clear')?>">
										<i class="icon-remove-sign"></i>
									</a>
								</div>	
								<ul class="filter-list fl-verification">
									<li>
										<a href="#" id="filter_link_verification_1">
											<span class="item-icon ic-verified">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.verified'); ?></span>
										</a>
									</li>
									<li>
										<a href="#" id="filter_link_verification_0">
											<span class="item-icon ic-unverified">&nbsp;</span>
											<span class="item-title"><?php echo Kohana::lang('ui_main.unverified'); ?></span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="submenu">
								<a href="#"><i class="icon icon-magic"></i> <?php echo Kohana::lang('ui_main.custom_fields'); ?></a>
								<div style="position: relative; float: right; top: -31px; right: 40px; width:0">
									<a class="btn btn-info tltp" href="javascript:void(0)" onclick="removeParameterKey('cff', 'fl-customFields');" title="<?php echo Kohana::lang('ui_main.clear')?>">
										<i class="icon-remove-sign"></i>
									</a>
								</div>	
								<ul>
									<li><div class="f-customFields-box"><?php echo $custom_forms_filter; ?></div></li>
								</ul>
							</li>
							
						</ul>
					</div>

			<!--
			<div class="actionFilter pull-right">
				<a href="javascript:void(0)" id="applyFilters" class="btn btn-danger"><?php echo Kohana::lang('ui_main.filter_reports'); ?></a>
				<a href="javascript:void(0)" id="reset_all_filters" class="btn btn-inverse"><?php echo Kohana::lang('ui_main.reset_all_filters'); ?></a> 
			</div>
			-->
      
			<div style="display:none">
				<?php
					// Filter::report_stats - The block that contains reports list statistics
					Event::run('ushahidi_filter.report_stats', $report_stats);
					echo $report_stats;
				?>
			</div>

		</div>
		<!-- end reports block -->
		
	</div>
	<!-- end content-bg -->
</div>



<script type="text/javascript">

$(document).ready(function(){
	// === Sidebar navigation === //
	$('.submenu > a').click(function(e)
	{
		e.preventDefault();
		var submenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var submenus = $('#sidebar li.submenu ul');
		var submenus_parents = $('#sidebar li.submenu');
		if(li.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenu.slideUp();
			} else {
				submenu.fadeOut(250);
			}
			li.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenus.slideUp();			
				submenu.slideDown();
			} else {
				submenus.fadeOut(250);			
				submenu.fadeIn(250);
			}
			submenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});
	
	var ul = $('#sidebar > ul');
	
	$('#sidebar > a').click(function(e)
	{
		e.preventDefault();
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else 
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});
});
	
</script>