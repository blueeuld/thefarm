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

                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <a class="navbar-brand" href="#"><?php echo ucfirst($view);?>s</a>
                                    </div>
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="#" class="btn"><i class="fa fa-plus-circle"></i> Add <?php echo ucfirst($view);?></a></li>
                                        </ul>
                                    </div><!-- /.navbar-collapse -->
                                </div><!-- /.container-fluid -->
                            </nav>
    
                            <div class="container-fluid ">
                                <div id="main">


                                    <div class="table-responsive">

                                        <table class="dataTable table">
                                            <thead>
                                            <tr class="text-uppercase">
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <?php if (is_admin()) : ?>
                                                <th>Group</th>
                                                <th class="verified text-center">Verified?</th>
                                                <th class="approved text-center">Approved?</th>
                                                <?php endif; ?>
                                                <th class="actions text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            <?php foreach ($contacts as $row) : ?>
                                                <tr class="contacts" id="contact-<?php echo $row['ContactId'];?>">
                                                    <td>
                                                        <?php echo anchor('backend/account/edit/' . $row['ContactId'].$qstr, $row['FirstName'] . ' ' . $row['LastName'], 'class="text-regular"'); ?>
                                                       </td>
                                                    <td><?php echo $row['Email']; ?></td>
                                                    <?php if (is_admin()) : ?>
                                                    <td><?php echo $row['User']['Group']['GroupName']; ?></td>
                                                    <td class="text-center">
                                                        <?php form_toggle_button('btn-verify', $row['ContactId'], array('Yes', 'No'), $row['IsVerified']);?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php form_toggle_button('btn-approve', $row['ContactId'], array('Yes', 'No'), $row['IsApproved']);?>
                                                    </td>
                                                    <?php endif; ?>

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