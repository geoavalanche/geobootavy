<?php
/**
 * View file for the map used to specify the alert radius
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
?>
	<div class="map-wrapper">
	<?php if ($show_usage_info): ?>
		<p><?php echo Kohana::lang('ui_main.alerts_place_spot'); ?></p>
	<?php endif; ?>
		<?php $css_class = (isset($css_class))? $css_class : "map-holder"; ?>
		<div class="<?php echo $css_class; ?>" id="divMap"></div>
	</div>
	<div class="report-find-location">
		<div class="alert_slider">
			<select name="alert_radius" id="alert_radius">
				<option value="1">1 KM</option>
				<option value="5">5 KM</option>
				<option value="10">10 KM</option>
				<option value="20" selected="selected">20 KM</option>
				<option value="50">50 KM</option>
				<option value="100">100 KM</option>
			</select>
		</div>
		
	<?php if ($enable_find_location): ?>
		<div class="find-location input-append">
    		<?php print form::input('location_find', '', ' title="City, State and/or Country" class="findtext"'); ?>
    		<input type="button" name="button" id="button" value="<?php echo Kohana::lang('ui_main.find_location'); ?>" class="btn_find btn btn-danger" />
			<div id="find_loading" class="report-find-loading"></div>
    	</div>
		
		<div class="find-text clear">* <?php echo Kohana::lang('ui_main.alerts_place_spot2'); ?></div>
	<?php endif; ?>
		
	</div>
