			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->

	<!-- footer -->
	<div id="footer">
		
		<div class="container">
			<div class="row-fluid">
	
				<!-- footer content -->
				<div id="footer_content" class="floatholder">
		
					<!-- footer credits -->
					<div class="footer-credits">
						Powered by the &nbsp;
						<a href="http://www.ushahidi.com/">
							<img src="<?php echo url::file_loc('img'); ?>media/img/footer-logo.png" alt="Ushahidi" style="vertical-align:middle" />
						</a>
						&nbsp; Platform
					</div>
					<!-- / footer credits -->
		
					<!-- footer menu -->
					<div class="footermenu">
						<ul class="clearingfix">
							<li>
								<a class="item1" href="<?php echo url::site(); ?>">
									<?php echo Kohana::lang('ui_main.home'); ?>
								</a>
							</li>
		
							<?php if (Kohana::config('settings.allow_reports')): ?>
							<li>
								<a href="<?php echo url::site()."reports/submit"; ?>">
									<?php echo Kohana::lang('ui_main.submit'); ?>
								</a>
							</li>
							<?php endif; ?>
		
							<?php if (Kohana::config('settings.allow_alerts')): ?>
							<li>
								<a href="<?php echo url::site()."alerts"; ?>">
									<?php echo Kohana::lang('ui_main.alerts'); ?>
								</a>
							</li>
							<?php endif; ?>
		
							<?php if (Kohana::config('settings.site_contact_page')): ?>
							<li>
								<a href="<?php echo url::site()."contact"; ?>">
									<?php echo Kohana::lang('ui_main.contact'); ?>
								</a>
							</li>
							<?php endif; ?>
		
							<?php
							// Action::nav_main_bottom - Add items to the bottom links
							Event::run('ushahidi_action.nav_main_bottom');
							?>
		
						</ul>
						<?php if ($site_copyright_statement != ''): ?>
						<p><?php echo $site_copyright_statement; ?></p>
						<?php endif; ?>
					</div>
					<!-- / footer menu -->
		
					<div class="row-fluid">
						<span class="span12">
							<a class="footerFeedBack" href="http://feedback.ushahidi.com/fillsurvey.php?sid=2">
								<i class="icon-pencil"></i>	<?php echo Kohana::lang('ui_main.feedback'); ?>
							</a>
						</span>
					</div>
					
					
					<b>Be our friend on facebook</b>
<p id="pFB"></p>
<iframe scrolling="no" frameborder="0" allowtransparency="true" style="border:none; overflow:hidden; width:450px; height:80px;" src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FGeoavalanche&send=false&layout=standard&width=450&show_faces=true&action=like&colorscheme=dark&font&height=80"></iframe>

				</div>
				<!-- / footer content -->
			</div>
		</div>
	</div>
	<!-- / footer -->

	<?php
	echo $footer_block;
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
