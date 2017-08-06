							<nav class="navbar navbar-default">
		                        <div class="container-fluid">
			                        
			                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					                    <?php echo form_open('backend/contacts/'.strtolower($title), array('class' => 'navbar-form navbar-right form-inline filter', 'method' => 'GET')); ?>
									        <div class="form-group">
									          <?php echo form_input('keyword', $this->input->get_post('keyword'), array('class' => 'form-control typeahead', 'placeholder' => 'Name or Email')); ?>
									        </div>
									        <button type="submit" class="btn btn-default">Search</button>
									    <?php echo form_close(); ?>
			                        </div>
		                        </div>
		                        
	                        </nav>