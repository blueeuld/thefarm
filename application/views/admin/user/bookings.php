<div role="tabpanel" class="tab-pane" id="bookings">

    <div class="panel panel-default">
        <div class="panel-heading">Bookings
            <div class="pull-right"><a href="<?php echo site_url('backend/booking/edit/' . $contactId) ?>"
                                       class="btn btn-primary" data-toggle="modal"
                                       data-target="#modal-popup">Add <i
                        class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr class="text-uppercase ">
                        <th>Program</th>
                        <th>Status</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bookings as $booking) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url('backend/booking/edit/' . $contactId . '/' . $booking['BookingId']) ?>"
                                   class="text-regular"
                                   data-toggle="modal"
                                   data-target="#modal-popup">
                                    <?php echo $booking['Title']; ?>
                                </a>
                                <div class="text-muted">
                                    <?php if (isset($booking['StartDate']) && isset($booking['EndDate'])) : ?>
                                        <?php echo date('m/d/Y', $booking['StartDate']) . ' to ' . date('m/d/Y', $booking['EndDate']); ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                echo ucfirst($booking['Status'])
                                ?>
                            </td>
                            <td class="text-right">
                                <a href="<?php echo site_url('backend/booking/edit/' . $contactId . '/' . $booking['BookingId']) ?>"
                                   class="btn btn-icon btn-primary"
                                   data-toggle="modal"
                                   data-target="#modal-popup"><i
                                        class="md md-edit"></i></a>
                                <a href="<?php echo site_url('backend/account/edit/' . $contactId . '/' . $booking['BookingId']) ?>#appointment"
                                   class="btn btn-icon btn-primary"><i
                                        class="md md-event-available"></i></a>
                                <a href="<?php echo site_url('backend/account/print_schedule/' . $booking['BookingId']); ?>"
                                   class="btn btn-icon btn-primary"
                                   target="_blank"><i
                                        class="fa fa-print"></i> </a>
                                <a href="<?php echo site_url('backend/booking/delete/' . $booking['BookingId']) ?>"
                                   class="btn btn-icon btn-primary btn-confirm"
                                   title="Are you sure you want to delete this entry?"><i
                                        class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>