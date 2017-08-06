

  		<?php echo form_open('settings/configuration', '', array('site_id' => $site_id)); ?>

        <div class="panel-heading"><b><i class="glyphicon glyphicon-wrench"></i> Configuration</b></div>

        <div class="panel-body">

			<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Localization</h3>
			  	</div>
			  	<div class="panel-body">
			  		<label class="text-muted">Timezone</label>
			    	<input type="text" class="form-control" name="preferences[localization][timezone]" value="<?php echo $preferences['localization']['timezone'];?>" />
			    	
			    	<label class="text-muted">Date Format</label>
			    	<input type="text" class="form-control" name="preferences[localization][date_format]" value="<?php echo $preferences['localization']['date_format'];?>" />
			    	
			    	<label class="text-muted">Language</label>
			    	<input type="text" class="form-control" name="preferences[localization][language]" value="<?php echo $preferences['localization']['language'];?>" />
			  	</div>
			</div>
			
			<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">User Preferences</h3>
			  	</div>
			  	<div class="panel-body">
			  		<label class="text-muted">Avatar Upload Path</label>
			    	<input type="text" class="form-control" name="preferences[upload_path]" value="<?php echo $preferences['upload_path'];?>" />
			  	</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Company</h3>
				</div>
				<div class="panel-body">
					<label class="text-muted">Start Time</label>
					<input type="text" class="form-control" name="preferences[start_time]" value="<?php echo $preferences['start_time'];?>" />
					<label class="text-muted">End Time</label>
					<input type="text" class="form-control" name="preferences[end_time]" value="<?php echo $preferences['end_time'];?>" />
				</div>
			</div>

            <button type="submit" id="save-configuration" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">
                Save Changes
            </button>

		</div>
		
		<?php echo form_close(); ?>
