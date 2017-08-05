<!DOCTYPE html>
<html lang="en" class="app">
<head>
	<?php $this->load->view('admin/_common/head', array('title' => 'Contacts')); ?>
</head>
<body class="">
<section class="vbox">
	<?php $this->load->view('admin/_common/header'); ?>
	<section>
		<section class="hbox stretch">
			<section id="content">
				<section class="vbox">
					<section class="scrollable bg-white">
						<div class="content">
							
							<div class="container-fluid ">
								
								<div id="main">
									<div class="page-header">
										<h3>Provider Schedule</h3>
									</div>

                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="list-group">
                                                <?php foreach ($providers as $provider) : ?>
                                                    <a href="<?php echo site_url('backend/schedule/view/'.$provider['ContactId']);?>" class="list-group-item<?php echo $provider['ContactId'] === $contact_id ? ' disabled' : '';?>">
                                                        <?php echo ($provider['FirstName'] . ' ' . $provider['LastName']); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <?php if ($contact_id) : ?>
                                            <?php echo form_open('backend/schedule/update', '', array('contact_id' => $contact_id, 'week' => $week)); ?>
                                            <?php echo $this->weeklycalendar->showCalendar(); ?>
                                            <?php echo form_submit('', 'Save Changes', 'class="btn btn-primary"'); ?>
                                            <?php echo form_close(); ?>
                                            <?php else : ?>
                                            <p>Please select provider.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</section>
				</section>
			</section>
		</section>
	</section>
</section>
<?php $this->view('admin/_common/footer_js'); ?>
</body>
</html>