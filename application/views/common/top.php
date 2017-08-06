<?php
$return = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
?>

<!-- Top Breadcrumbs
   		============================================= -->     
        <div class="top-nav semi-transparent">
        	<div class="container clearfix">
        		<ul class="serif">
					<?php if (!isset($_SESSION['ContactId'])) : ?>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal" class="button button-border button-dark button-mini">Log-In</a></li>
					<?php else : ?>
					<li>Welcome <?php echo $_SESSION['FirstName'];?>!
						<?php if ($_SESSION['User']['Group']['GroupId'] !== 5) : ?>
							<a href="<?php echo site_url('backend');?>" class="button button-border button-dark button-mini">Dashboard</a>
						<?php endif; ?>
						<a href="<?php echo site_url('profile');?>" class="button button-border button-dark button-mini">Profile</a>
						<a href="<?php echo site_url('logout').'?return='.$return;?>" class="button button-border button-dark button-mini">Logout</a></li>
					<?php endif; ?>
        		</ul>
        	</div>
        </div>