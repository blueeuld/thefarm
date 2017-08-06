<!DOCTYPE html>
<html lang="en" class="app">
<head>
	<?php $this->load->view('admin/_common/head', array('title' => 'Settings')); ?>
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

                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <a class="navbar-brand" href="#">System Settings</a>
                                    </div>
                                </div><!-- /.container-fluid -->
                            </nav>
							
							
							<div class="container-fluid ">
								
								<div id="notification" data-position="top-right" class="display-none">
								
								</div>
								
								<div id="main">
									<div class="row">
                                        <div class="col-lg-2">
                                            <div class="list-group">
                                                <a class="list-group-item<?php echo $setting === 'configuration' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/configuration'); ?>">Configuration</a>
                                                <a class="list-group-item<?php echo $setting === 'users' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/users'); ?>">System Users</a>
                                                <a class="list-group-item<?php echo $setting === 'groups' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/groups'); ?>">Member Groups</a>
                                                <a class="list-group-item<?php echo $setting === 'forms' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/forms'); ?>">Forms</a>
                                                <a class="list-group-item<?php echo $setting === 'category' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/category'); ?>">Categories</a>
                                                <a class="list-group-item<?php echo $setting === 'package_types' ? ' bs-callout bs-callout-info' : ''; ?>" href="<?php echo site_url('backend/settings/package_types'); ?>">Package Types</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <?php if (!$setting) : ?>
                                                <div class="panel-heading"><i class="glyphicon glyphicon-cog"></i> System Settings</div>
                                                <div class="panel-body">
                                                    <p>System Settings allows you to change system wide settings for all users, and is available only to administrators.</p>
                                                    <ul class="list-unstyled">
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/configuration'); ?>"><i class="glyphicon glyphicon-wrench"></i> Configuration</a></li>
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/users'); ?>"><i class="glyphicon glyphicon-user"></i> System Users</a></li>
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/groups'); ?>"><i class="glyphicon glyphicon-user"></i> Member Groups</a></li>
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/forms'); ?>"><i class="glyphicon glyphicon-list-alt"></i> Forms</a></li>
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/category'); ?>"><i class="glyphicon glyphicon-tasks"></i> Categories</a></li>
                                                        <li><a class="list-group-item" href="<?php echo site_url('backend/settings/package_types'); ?>"><i class="glyphicon glyphicon-briefcase"></i> Package Types</a></li>
                                                    </ul>
                                                </div>
                                                <?php else : ?>
                                                    <?php
                                                    $this->load->view('admin/settings/setting/'.$setting);
                                                    ?>
                                                <?php endif; ?>
                                            </div>

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