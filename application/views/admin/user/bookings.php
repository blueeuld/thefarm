<div role="tabpanel" class="tab-pane" id="bookings">

    <div class="panel panel-default">
        <div class="panel-heading"><b>Bookings</b>
            <div class="pull-right"><a href="<?php echo site_url('backend/booking/create/' . $contactId) ?>"
                                       class="btn btn-xs btn-primary" data-toggle="modal"
                                       data-target="#modal-popup">Add Booking <i
                        class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <?php if ($bookings) : ?>
            <ul class="list-group">
                <?php foreach ($bookings as $booking) : ?>
                    <?php if ($booking['IsActive']) : ?>
                    <li class="list-group-item">
                        <a href="<?php echo site_url('backend/booking/edit/' . $booking['BookingId']) ?>"
                           class="text-regular"
                           data-toggle="modal"
                           data-target="#modal-popup">
                            <?php echo $booking['Title']; ?>
                        </a>
                        <span class="label label-success"><?php echo ucfirst($booking['Status']) ?></span>

                        <!-- Single button -->
                        <div class="btn-group btn-group-xs pull-right">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('backend/booking/edit/' . $booking['BookingId']) ?>"
                                       class="text-regular"
                                       data-toggle="modal"
                                       data-target="#modal-popup">Edit</a></li>
                                <li><a href="<?php echo site_url('backend/booking/delete/' . $booking['BookingId']) ?>"
                                       class="text-regular btn-confirm"
                                       title="Are you sure you want to delete this entry?">Delete</a></li>
                            </ul>
                        </div>

                        <div class="text-muted">
                            <?php if (isset($booking['StartDate']) && isset($booking['EndDate'])) : ?>
                                <?php echo date('m/d/Y', $booking['StartDate']) . ' to ' . date('m/d/Y', $booking['EndDate']); ?>
                            <?php endif; ?>
                        </div>


                        <!--
                        <td class="text-right">

                            <a href="<?php echo site_url('backend/account/edit/' . $contactId . '/' . $booking['BookingId']) ?>#appointment"
                               class="btn btn-icon btn-primary"><i
                                    class="md md-event-available"></i></a>
                            <a href="<?php echo site_url('backend/account/print_schedule/' . $booking['BookingId']); ?>"
                               class="btn btn-icon btn-primary"
                               target="_blank"><i
                                    class="fa fa-print"></i> </a>

                        </td>
                        -->
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>