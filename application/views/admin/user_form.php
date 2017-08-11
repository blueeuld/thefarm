<?php
$return = urlencode($_SERVER["REQUEST_URI"]);
$qstr = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
$qstr = $qstr ? $qstr.'&return='.$return : '?return=' . $return;

if ($userData) {

    $contact_id = $userData['ContactId'];
    $group_cd = isset($userData['User']) ? $userData['User']['Group']['GroupCd'] : 'guest';
    $isProvider = isset($userData['User']) ? $userData['User']['Group']['IncludeInProviderList'] === 'y' : false;

//    echo '<pre>';
//    print_r($userData);
//    echo '</pre>';

}

?>
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

                                    <div class="row" style="padding-bottom: 20px">
                                        <div class="col-md-12 col-lg-12">
                                            <a class="btn btn-default" href="<?php echo $this->input->get_post('return');?>"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                            <a class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 col-lg-12">

                                            <div role="tabpanel" class="tabbable tabs-primary">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <?php if (current_user_can('CanViewOtherProfiles') || $userData['ContactId'] === 0 || $userData['ContactId'] === get_current_user_id()) : ?>
                                                        <li role="presentation">
                                                            <a href="#account" aria-controls="account" role="tab" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Profile</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($userData['ContactId']) : ?>

                                                        <?php if ($group_cd === 'guest') : ?>
                                                            <?php if (current_user_can('CanManageGuestBookings')) : ?>
                                                                <li role="presentation">
                                                                    <a href="#bookings" aria-controls="bookings" role="tab" data-toggle="tab"><i class="fa fa-fw fa-book"></i> Bookings</a>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php if (current_user_can('CanManageGuestForms')) : ?>
                                                                <li role="presentation">
                                                                    <a href="#submissions" aria-controls="submissions" role="tab" data-toggle="tab"><i class="fa fa-fw fa-book"></i> Forms</a>
                                                                </li>
                                                            <?php endif; ?>

                                                        <?php endif; ?>


                                                    <?php endif; ?>

                                                    <?php if ($isProvider) : ?>
                                                        <li role="presentation">
                                                            <a href="#services" aria-controls="services" role="tab" data-toggle="tab">Related Services</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if (current_user_can('CanManageGuestSettings')) : ?>
                                                        <li role="presentation">
                                                            <a href="#member" aria-controls="member" role="tab" data-toggle="tab"><i class="fa fa-fw fa-cog"></i> Settings</a>
                                                        </li>
                                                    <?php endif; ?>

                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content tab-content-default" style="margin-top: 20px;">

                                                    <?php if (current_user_can('CanViewOtherProfiles') || $userData['ContactId'] === 0 || $userData['ContactId'] === get_current_user_id()) : ?>
                                                        <div role="tabpanel" class="tab-pane" id="account">
                                                            <?php $this->view('admin/user/personal_info', array('userData' => $userData, 'return' => $return)); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($userData['ContactId']) : ?>

                                                        <?php if (current_user_can('CanManageGuestBookings')) : ?>
                                                            <?php $this->view('admin/user/bookings', ['bookings' => $userData['Bookings'], 'return' => $return, 'contactId' => $contact_id]); ?>
                                                        <?php endif; ?>

                                                        <?php if (current_user_can('CanManageGuestForms')) : ?>

                                                            <?php // $this->view('admin/user/forms'); ?>

                                                        <?php endif; ?>
                                                        <!--

                                                        <?php if ($booking_id) : ?>
                                                            <div role="tabpanel" class="tab-pane" id="appointment">
                                                                <?php if ($booking_id) : ?>
                                                                    <?php $this->view('admin/account/calendar', array('booking_id' => $booking_id, 'recent_booking' => $account['recent_booking'], 'booking_items' => $booking_items)); ?>
                                                                <?php else : ?>
                                                                    <div class="alert alert-warning">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="alert" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        You haven't made any bookings.
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        -->


                                                        <div role="tabpanel" class="tab-pane" id="messages">
                                                            <?php // $this->view('admin/account/messages', array('messages' => $messages, 'return' => $return)); ?>
                                                        </div>

                                                    <?php endif; ?>

                                                    <?php if ($isProvider) : ?>

                                                        <?php $this->view('admin/user/related_items', ['userItems' => $userData['UserItems'], 'return' => $return, 'contact_id' => $contact_id]); ?>

                                                    <?php endif; ?>

                                                    <?php if (current_user_can('CanManageGuestSettings')) : ?>
                                                        <div role="tabpanel" class="tab-pane" id="member">
                                                            <?php $this->view('admin/user/login', array('userData' => $userData['User'], 'return' => $return)); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

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