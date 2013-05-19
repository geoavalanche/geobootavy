<div id="content">
	<div class="content-bg">
		
		<div class="widget-box">
			<div class="widget-title">
				<h5><i class="icon-envelope"></i> <?php echo Kohana::lang('ui_main.contact'); ?></h5>
				<div class="widget-toolbar pull-right btn-group">
					<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-down"></i></a>
					<a href="javascript:void(0)" class="btn btn-inverse"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			
			<div class="widget-content">	
				<div id="contact_us">
					<?php if ($form_error) { ?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4>Error!</h4>
							<ul>
								<?php
								foreach ($errors as $error_item => $error_description){
									print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
								} ?>
							</ul>
						</div>
					<?php }else if ($form_sent){ ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4><?php echo Kohana::lang('ui_main.contact_message_has_send'); ?></h4>
						</div>
					<?php }	?>
					<?php print form::open(NULL, array('id' => 'contactForm', 'name' => 'contactForm')); ?>
					
					<div class="control-group">
						<label class="control-label" for="contact_name"><?php echo Kohana::lang('ui_main.contact_name'); ?>:</label>
						<div class="controls">
							<?php print form::input('contact_name', $form['contact_name'], ' class="text"'); ?>
						</div>	
					</div>
					<div class="control-group">
						<label class="control-label" for="contact_email"><?php echo Kohana::lang('ui_main.contact_email'); ?>:</label>
						<div class="controls">
							<?php print form::input('contact_email', $form['contact_email'], ' class="text"'); ?>
						</div>	
					</div>
					<div class="control-group">
						<label class="control-label" for="contact_phone"><?php echo Kohana::lang('ui_main.contact_phone'); ?>:</label>
						<div class="controls">
							<?php print form::input('contact_phone', $form['contact_phone'], ' class="text"'); ?>
						</div>	
					</div>
					<div class="control-group">
						<label class="control-label" for="contact_subject"><?php echo Kohana::lang('ui_main.contact_subject'); ?>:</label>
						<div class="controls">
							<?php print form::input('contact_subject', $form['contact_subject'], ' class="text"'); ?>
						</div>	
					</div>
					<div class="control-group">
						<label class="control-label" for="contact_message"><?php echo Kohana::lang('ui_main.contact_message'); ?>:</label>
						<div class="controls">
							<?php print form::textarea('contact_message', $form['contact_message'], ' rows="4" cols="40" class="textarea long" ') ?>
						</div>	
					</div>
					<div class="control-group">
						<label class="control-label" for="captcha"><?php echo Kohana::lang('ui_main.contact_code'); ?>:</label>
						<div class="controls">
							<b style="color:#CCCCCC"><?php print $captcha->render(); ?></b><br />
							<?php print form::input('captcha', $form['captcha'], ' class="text"'); ?>
						</div>	
					</div>


					<div class="report_row">
						<input name="submit" type="submit" value="<?php echo Kohana::lang('ui_main.contact_send'); ?>" class="btn_submit" />
					</div>
					<?php print form::close(); ?>
				</div>
				
			</div>
			<!-- end contacts block -->
		</div>
	</div>
</div>