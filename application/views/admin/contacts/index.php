<?php
$return = urlencode($_SERVER["REQUEST_URI"]);
$qstr = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
$qstr = $qstr ? $qstr.'&return='.$return : '?return=' . $return;

?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <?php $this->load->view('admin/_common/head', array('title' => 'Contacts')); ?>
</head>
<body class="" >
<section class="vbox">
    <?php $this->load->view('admin/_common/header'); ?>
    <section>
        <section class="hbox stretch">
            <section id="content">
                <section class="vbox">
                    <section class="scrollable bg-white">
                        <div class="content">
	                        
	                        <?php $this->load->view('admin/_common/search_bar', array('title' => ucfirst($view), 'qstr' => $qstr)); ?>
    
                            <div class="container-fluid ">
                                <div id="main">

                                    <div class="alignleft">
                                        <a href="#" class="btn btn-lg btn-success"><i class="fa fa-plus-circle"></i> Add Guest</a>
                                    </div>

                                    <div class="table-responsive">

                                        <table class="dataTable table">
                                            <thead>
                                            <tr class="text-uppercase">
                                                <th class="date-joined text-center">Date Joined</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                <?php if ($view === 'Guest') : ?>
                                                <th class="booking text-center">Booking</th>
                                                <?php endif; ?>
                                                <th class="verified text-center">Verified?</th>
                                                <th class="active text-center">Active?</th>
                                                <th class="approved text-center">Approved?</th>
                                                <th class="actions text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            <?php foreach ($contacts as $row) : ?>
                                                <tr class="contacts" id="contact-<?php echo $row['ContactId'];?>">
                                                    <td class="text-muted text-uppercase text-center">
                                                        <?php if ($row['DateJoined'] !== '0000-00-00'): ?>
                                                        <?php echo date('m/d/Y', strtotime($row['DateJoined'])) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo anchor('backend/account/edit/' . $row['ContactId'].$qstr, $row['FirstName'] . ' ' . $row['LastName'], 'class="text-regular"'); ?>
                                                       </td>
                                                    <td><?php echo $row['Email']; ?></td>
                                                    <td><?php echo $row['User']['Group']['GroupName']; ?></td>
                                                    <?php if ($view === 'Guest') : ?>
                                                    <td class="text-center">
                                                        <?php if (isset($row['recent_booking']) && $row['recent_booking']) : ?>
                                                            <a href="<?php echo site_url('backend/account/edit/'.$row['ContactId'].'/'.$row['recent_booking']).$qstr;?>" class="btn btn-xs"><i class="md md-schedule"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php endif; ?>


                                                    <td class="text-center">
                                                        <?php form_toggle_button('btn-verify', $row['ContactId'], array('Yes', 'No'), $row['Verified']);?>
                                                    </td>

                                                    <td class="text-center">
                                                        <?php form_toggle_button('btn-active', $row['ContactId'], array('Yes', 'No'), $row['Active']);?>
                                                    </td>

                                                    <td class="text-center">
                                                        <?php form_toggle_button('btn-approve', $row['ContactId'], array('Yes', 'No'), $row['Approved']);?>
                                                    </td>

                                                    <td class="text-right">

                                                        <a href="<?php echo site_url('backend/account/edit/' . $row['ContactId']).$qstr; ?>"
                                                           class="btn btn-xs btn-icon btn-primary"><i class="fa fa-pencil"></i></a>

                                                        <a href="<?php echo site_url('backend/account/delete/' . $row['ContactId']); ?>" class="btn btn-xs btn-icon btn-default btn-confirm" title="Are you sure you want to delete <b><?php echo $row['FirstName'] . ' ' . $row['LastName'];?></b>?"><i class="fa fa-trash-o"></i></a>



                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>
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