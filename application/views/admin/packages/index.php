<!DOCTYPE html>
<html lang="en" class="app">
<head>
	<?php $this->load->view('admin/_common/head', array('title' => 'Packages')); ?>
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
										<h1 class="serif">Packages <a href="<?php echo site_url('backend/package/edit'); ?>"
														class="btn btn-primary" data-toggle="modal"
														data-target="#modal-popup">Add <i class="fa fa-plus"></i></a>
										</h1>
									</div>

                                    <ul class="list-group">
                                        <?php foreach ($packages as $row) : ?>
                                            <li class="list-group-item">
                                                <?php echo anchor('backend/package/edit/' . $row['package_id'], $row['package_name'], 'class="text-regular" data-toggle="modal" data-target="#modal-popup"'); ?>
                                                <a href="#" class="btn btn-xs btn-icon btn-default pull-right"><i class="fa fa-trash-o"></i></a>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>

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