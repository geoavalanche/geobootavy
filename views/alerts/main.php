<div id="content">
	<div class="content-bg">
		
		
		<!-- start block -->
		<div class="widget-box">
			<div class="widget-title">
				<h5><i class="icon-cloud"></i> <?php echo Kohana::lang('ui_main.alerts_get'); ?></h5>
				<div class="widget-toolbar pull-right btn-group">
					<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			
			<div class="widget-content">
				
				<?php if ($form_error): ?>
					<!-- red-box -->
					<div class="red-box">
						<h3>Error!</h3>
						<ul>
							<?php foreach ($errors as $error_item => $error_description) {
								print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
							}?>
						</ul>
					</div>
				<?php endif; ?>
				<?php print form::open() ?>
				
				
				<div class"row-fluid">
					<div class="span6">
						<legend><?php echo Kohana::lang('ui_main.alerts_step1_select_city'); ?></legend>
						<div class="step-1">
							<?php echo $alert_radius_view; ?>
						</div>
						<input type="hidden" id="alert_lat" name="alert_lat" value="<?php echo $form['alert_lat']; ?>">
						<input type="hidden" id="alert_lon" name="alert_lon" value="<?php echo $form['alert_lon']; ?>">
						<input type="hidden" id="alert_country" name="alert_country" value="<?php echo $form['alert_country']; ?>" />
						<input type="hidden" id="alert_confirmed" name="alert_confirmed" value="<?php echo $form['alert_confirmed']; ?>" />
					</div>
					<div class="span6">			
						<div>
							<div class="step-2">
								<legend><?php echo Kohana::lang('ui_main.alerts_step2_send_alerts'); ?></legend>
								<?php if ($show_mobile == TRUE): ?>
									<label>
										<?php $checked = ($form['alert_mobile_yes'] == 1); ?>
										<?php print form::checkbox('alert_mobile_yes', '1', $checked); ?>
										<span>
											<strong><?php echo Kohana::lang('ui_main.alerts_mobile_phone'); ?></strong><br />
											<?php echo Kohana::lang('ui_main.alerts_enter_mobile'); ?>
										</span>
									</label>
									<span><?php print form::input('alert_mobile', $form['alert_mobile'], ' class="text long"'); ?></span>
								<?php endif; ?>
								<label>
									<?php $checked = ($form['alert_email_yes'] == 1) ?> 
									<?php print form::checkbox('alert_email_yes', '1', $checked); ?>
									<span>
										<strong><?php echo Kohana::lang('ui_main.alerts_email'); ?></strong><br />
										<?php echo Kohana::lang('ui_main.alerts_enter_email'); ?>
									</span>
								</label>
								<span><?php print form::input('alert_email', $form['alert_email'], ' class="text long"'); ?></span>
							</div>
							<div class="step-3">
								<legend><?php echo Kohana::lang('ui_main.alerts_step3_select_catgories'); ?></legend>
								<div class="report_category" id="categories">
								<?php 
									$selected_categories = (!empty($form['alert_category']) AND is_array($form['alert_category']))
										? $selected_categories = $form['alert_category']
										: array();
									
									/* OLD CODE */
									/*echo '<div id="treeCategory">';
									echo category::form_tree('alert_category', $selected_categories, 1, TRUE, FALSE);
									echo '</div>';*/
									
									/* CUSTOM CODE */
									$form_field = "alert_category";
									$columns = 1;
									$enable_parents = TRUE;
									$show_hidden = FALSE;
									
									$category_data = category::get_category_tree_data(FALSE, $show_hidden);
									$html = '';
									$categories_total = count($category_data);
									
									// Format categories for column display.
									$this_col = 1; // Column number
									$maxper_col = round($categories_total / $columns); 	// Maximum number of elements per column

									$i = 1;  // Element Count
									$html .= '<div id="treeCategory">';
									foreach ($category_data as $category){
										// If this is the first element of a column, start a new UL
										if ($i == 1){
											$html .= '<ul class="category-column category-column-'.$this_col.'">';
										}

										// Display parent category.
										$html .= '<li title="'.$category['category_description'].'">';
										$cid = $category['category_id'];
										// Category is selected.
										$category_checked = in_array($cid, $selected_categories);
										$disabled = "";
										if (!$enable_parents AND count($category['children']) > 0){
											$disabled = " disabled=\"disabled\"";	
										}
										$html .= "<label>";
										$html .= form::checkbox($form_field.'[]', $cid, $category_checked, ' class="check-box"'.$disabled);
										$html .= $category['category_title'];
										$html .= "</label>";
			
										if (count($category['children']) > 0){
											$html .= '<ul>';
											foreach ($category['children'] as $child){
												$html .= '<li title="'.$child['category_description'].'">';
												$cid = $category['category_id'];
												// Category is selected.
												$category_checked = in_array($cid, $selected_categories);
												$disabled = "";
												if (!$enable_parents AND count($category['children']) > 0){
													$disabled = " disabled=\"disabled\"";	
												}
												$html .= "<label>";
												$html .= form::checkbox($form_field.'[]', $cid, $category_checked, ' class="check-box"'.$disabled);
												$html .= $child['category_title'];
												$html .= "</label>";
											}
											$html .= '</ul>';
										}

										// If this is the last element of a column, close the UL
										if ($i > $maxper_col OR $i == $categories_total){
											$html .= '</ul>';
											$i = 1;
											$this_col++;
										}else{
											$i++;
										}						
									}									
									$html .= '</div>';
									echo $html;			
								?>
								</div>
							</div>
							<input id="btn-send-alerts" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.alerts_btn_send'); ?>" />
							<BR /><BR />
							<a href="<?php echo url::site()."alerts/confirm";?>"><?php echo Kohana::lang('ui_main.alert_confirm_previous'); ?></a>
						</div>
					</div>
				</div>
				<?php print form::close(); ?>
			</div>
		</div>
		<!-- end block -->
	</div>
</div>

