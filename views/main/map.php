<div class="widget-box">
	<div class="widget-title row-fluid">
		<div class="span8 pull-left">
			<h5><i class="icon-globe"></i> <?php echo Kohana::lang('ui_main.map') ?></h5>
		</div>
		<div class="buttons btn-toolbar span4">
			<div class="btn-group pull-right">
				<a class="btn tltp dropdown-toggle pull-right" data-toggle="dropdown" href="#" title="<?php echo Kohana::lang('ui_main.filter_reports_by'); ?>">
					<i class="icon-filter"></i> <?php echo Kohana::lang('ui_main.filter_reports_by'); ?>
				</a>
				<ul class="dropdown-menu pull-right row-fluid" style="width:300px">
					<li class="span6">
						<!-- filters box -->
						<div class="filters">
							<?php
							// Action::main_sidebar_pre_filters - Add Items to the Entry Page before filters
							Event::run('ushahidi_action.main_sidebar_pre_filters');
							?>
							
							<!-- report category filters -->
							<span><?php echo Kohana::lang('ui_main.category');?></span>
							<ul id="category_switch" class="category-filters">
								<?php
									$color_css = 'class="swatch" style="background-color:#'.Kohana::config('settings.default_map_all').'"';
									$all_cat_image = '';
									if (Kohana::config('settings.default_map_all_icon') != NULL)
									{
										$all_cat_image = html::image(array(
											'src'=>Kohana::config('settings.default_map_all_icon'),
											'style'=>'float:left;padding-right:5px;'
										));
										$color_css = '';
									}
								?>
								<li>
									<a class="active" id="cat_0" href="#">
										<span <?php echo $color_css; ?>><?php echo $all_cat_image; ?></span>
										<span class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></span>
									</a>
								</li>
								<?php
									$categories = ORM::factory('category')->find_all();
									//foreach ($categories as $category => $category_info){
									foreach($categories as $category){
										$cat = ORM::factory('category', $category->id);
										$category_title = htmlentities($cat->category_title, ENT_QUOTES, "UTF-8");
										$category_color = $cat->category_color;
										$category_image = ($cat->category_image != NULL)
											? url::convert_uploaded_to_abs($cat->category_image)
											: NULL;
										$category_description = $cat->category_description;
										$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
										if ($cat->category_image != NULL){
											$category_image = html::image(array(
												'src'=>$category_image,
												'style'=>'float:left;padding-right:5px;'
												));
											$color_css = '';
										}
										echo '<li>'
											. '<a href="#" id="cat_'. $category .'" title="'.$category_description.'" class="tltp">'
											. '<span '.$color_css.'>'.$category_image.'</span>'
											. '<span class="category-title">'.$category_title.'</span>'
											. '</a>';
									}
									
									// MANCA LA GET CHILDREN
								?>
							</ul>
							<!-- / category filters -->
						</div>
					</li>
					<li class="span6">
						<!-- report type filters -->
						<div class="filters">
							<span><?php echo Kohana::lang('ui_main.type'); ?></span>
							<ul>
								<li><a id="media_0" class="active" href="#"><span><i class="icon-file-alt"></i> <?php echo Kohana::lang('ui_main.reports'); ?></span></a></li>
								<li><a id="media_4" href="#"><span><?php echo Kohana::lang('ui_main.news'); ?></span></a></li>
								<li><a id="media_1" href="#"><span><i class="icon-picture"></i> <?php echo Kohana::lang('ui_main.pictures'); ?></span></a></li>
								<li><a id="media_2" href="#"><span><i class="icon-film"></i> <?php echo Kohana::lang('ui_main.video'); ?></span></a></li>
								<li><a id="media_0" href="#"><span><?php echo Kohana::lang('ui_main.all'); ?></span></a></li>
							</ul>
							<div class="floatbox">
								<?php
								// Action::main_filters - Add items to the main_filters
								Event::run('ushahidi_action.map_main_filters');
								?>
							</div>
						</div>
						<!-- / report type filters -->
					</li>
				</ul>
			</div>
			<div class="btn-group pull-right">			
				<a class="btn tltp" title="<?php echo Kohana::lang('ui_main.how_to_report'); ?>" href="#modalInfoReport" data-toggle="modal">
					<i class="icon-info-sign"></i>
				</a>
			</div>	
		</div>
	</div>
	<div class="widget-content">
		<div class="map" id="map"></div>
		<div style="clear:both;"></div>
		<div id="mapStatus">
			<div id="mapScale" style="border-right: solid 1px #999"></div>
			<div id="mapMousePosition" style="min-width: 135px;border-right: solid 1px #999;text-align: center"></div>
			<div id="mapProjection" style="border-right: solid 1px #999"></div>
			<div id="mapOutput"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>





<div id="modalInfoReport" class="modal hide fade" role="dialog">
	 <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
		<h3><i class="icon-info-sign"></i> <?php echo Kohana::lang('ui_main.how_to_report'); ?></h3>
	</div>
	<div class="modal-body">
		<div>
			<div>
				<!-- Phone -->
				<?php if (!empty($phone_array)) { ?>
				<div style="margin-bottom:10px;">
					<?php echo Kohana::lang('ui_main.report_option_1'); ?>
					<?php foreach ($phone_array as $phone) { ?>
						<strong><?php echo $phone; ?></strong>
						<?php if ($phone != end($phone_array)) { ?>
							 <br/>
						<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>
				
				<!-- External Apps -->
				<?php 
					// Get external apps
					$external_apps = array();
					// Catch errors, in case we have an old db
					try {
						$external_apps = ORM::factory('externalapp')->find_all();
					}catch(Exception $e){} 
				?>
				<?php if (count($external_apps) > 0) { ?>
				<div style="margin-bottom:10px;">
					<strong><?php echo Kohana::lang('ui_main.report_option_external_apps'); ?>:</strong><br/>
					<?php foreach ($external_apps as $app) { ?>
						<a href="<?php echo $app->url; ?>"><?php echo $app->name; ?></a><br/>
					<?php } ?>
				</div>
				<?php } ?>
		
				<!-- Email -->
				<?php if (!empty($report_email)) { ?>
				<div style="margin-bottom:10px;">
					<strong><?php echo Kohana::lang('ui_main.report_option_2'); ?>:</strong><br/>
					<a href="mailto:<?php echo $report_email?>"><?php echo $report_email?></a>
				</div>
				<?php } ?>
				
				<!-- Twitter -->
				<?php if (!empty($twitter_hashtag_array)) { ?>
				<div style="margin-bottom:10px;">
					<strong><?php echo Kohana::lang('ui_main.report_option_3'); ?>:</strong><br/>
					<?php foreach ($twitter_hashtag_array as $twitter_hashtag) { ?>
						<span>#<?php echo $twitter_hashtag; ?></span>
						<?php if ($twitter_hashtag != end($twitter_hashtag_array)) { ?>
							<br />
						<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>

				<!-- Web Form -->
				<div style="margin-bottom:10px;">
					<a href="<?php echo url::site() . 'reports/submit/'; ?>"><?php echo Kohana::lang('ui_main.report_option_4'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>