<?php ob_start(); ?>
<?php
$dateTimeFormat = 'Y-m-d H:i:s';
$eventApi = new EventApi();
$bookingApi = new BookingApi();
$userApi = new UserApi();
$facilityApi = new FacilityApi();


if ($eventData) {
    $event_id = $eventData['EventId'];
    $booking_id = $eventData['BookingId'];
    $item_id = $eventData['Item']['ItemId'];
    $duration = $eventData['Item']['Duration'];
    $incl = $eventData['Incl'];
    $foc = $eventData['Foc'];
    $not_incl = $eventData['NotIncl'];
    $incl_os_done_number = $eventData['InclOsDoneNumber'];
    $assigned_to = [];

    if (isset($eventData['BookingEventUsers'])) {

        foreach ($eventData['BookingEventUsers'] as $bookingEventUser) {
            if (!$bookingEventUser['IsGuest']) {
                $assigned_to[] = $bookingEventUser['UserId'];
            }
        }
    }

    $start_date = date('Y-m-d', strtotime($eventData['StartDate']));
    $start_time = date('H:i', strtotime($eventData['StartDate']));
    $end_date = date('Y-m-d', strtotime($eventData['EndDate']));
    $end_time = date('H:i', strtotime($eventData['EndDate']));
    $author_id = $eventData['AuthorId'];
    $status = $eventData['Status'];
    $max_provider = $eventData['Item']['MaxProvider'];
    $facility_id = $eventData['FacilityId'];
    $notes = $eventData['Notes'];
    $called_by = $eventData['CalledBy'];
    $cancelled_by = $eventData['CancelledBy'];
    $cancelled_reason = $eventData['CancelledReason'];
    $date_cancelled = $eventData['DateCancelled'];
    $incl_os_done_amount = $eventData['InclOsDoneAmount'];
    $not_incl_os_done_number = $eventData['NotInclOsDoneNumber'];
    $not_incl_os_done_amount = $eventData['NotInclOsDoneAmount'];
    $foc_os_done_number = $eventData['FocOsDoneNumber'];
    $foc_os_done_amount = $eventData['FocOsDoneAmount'];
    $date = $start_date;

    $availableProviders = $userApi->get_users(false, [0, get_current_user_location_id()], $item_id, true, $eventData['StartDate'], $eventData['EndDate']);
}
else {

    $date = $this->input->get_post('start');
    $item_id = $this->input->get_post('item_id');
    $booking_id = (int)$this->input->get_post('booking_id');
    $assigned_to = [$this->input->get_post('assigned_to')];
    $duration = is_int($this->input->get_post('duration')) ? $this->input->get_post('duration') : 60;

    $start_date_dt = new DateTime($date);
    $end_date_dt = new DateTime($date);
    $end_date_dt->add(new DateInterval('PT'.$duration.'M'));

    $event_id = null;
    $incl = true;
    $foc = false;
    $not_incl = false;
    $start_date = $start_date_dt->format('Y-m-d');
    $start_time = $start_date_dt->format('H:i');
    $end_date = $end_date_dt->format('Y-m-d');
    $end_time = $end_date_dt->format('H:i');
    $facility_id = null;
    $max_provider = 1;
    $notes = '';
    $status = '';
    $author_id = get_current_user_id();
    $cancelled_reason = '';
    $cancelled_by = null;
    $called_by = null;
    $date_cancelled = null;
    $incl_os_done_amount = '';
    $not_incl_os_done_number = '';
    $not_incl_os_done_amount = '';
    $foc_os_done_number = '';
    $foc_os_done_amount = '';
    $availableProviders = $userApi->get_users(false, [0, get_current_user_location_id()], $item_id, true, $start_date_dt->format($dateTimeFormat), $end_date_dt->format($dateTimeFormat));
}

$providers = [];
if ($availableProviders) {
    foreach ($availableProviders as $availableProvider) {
        $providers[$availableProvider['ContactId']] = $availableProvider['FirstName'] . ' ' . $availableProvider['LastName'];
    }
}

$auditUsersArr = $userApi->get_users(true, null, null, null, null, null, true);
foreach ($auditUsersArr as $item) {
    $audit_users[$item['ContactId']] = $item['FirstName'] . ' ' . $item['LastName'];
}

$reasons = array('Reason 1', 'Reason 2', 'Reason 3', 'N/A');

$statusesArr = $eventApi->get_statuses();
foreach ($statusesArr as $item) {
    $statuses[$item['StatusCd']] = $item['StatusValue'];
}

// Bookings.
$bookingsArr = $bookingApi->search_bookings($date, ['confirmed']);
$bookings = [];
foreach ($bookingsArr as $booking) {
    $bookings[$booking['BookingId']] = $booking['Guest']['FirstName'] . ' ' . $booking['Guest']['LastName'];
}

$endDate = new DateTime($date);
$endDate->add(new DateInterval('P1W'));

$date_range = createDateRangeArray($date, $endDate->format('Y-m-d'));
$dates = [];
foreach ($date_range as $date) $dates[$date] = date('m/d/Y', strtotime($date));


// Facilities
$facilitiesArr = $facilityApi->search_facilities(get_current_user_locations());
if ($facilitiesArr) {
    foreach ($facilitiesArr as $facility) {
        $facilities[$facility['FacilityId']] = $facility['FacilityName'];
    }
}

// Package Types
$packageTypesArr = $bookingApi->get_package_types();
if ($packageTypesArr) {
    foreach ($packageTypesArr as $item) {
        $package_types[$item['PackageTypeId']] = $item['PackageTypeName'];
    }
}

$times = createTimeRangeArray(1800*12, 3600*23, 60*10);

?>
<?php if (!$booking_id) : ?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#existing" aria-controls="existing" role="tab" data-toggle="tab">Select Existing Guest</a></li>
        <li><a href="#new-guest" aria-controls="new-guest" role="tab" data-toggle="tab">New Guest</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="existing">
            <div class="form-group">
                <?php echo form_dropdown('booking_id', $bookings, $booking_id, 'class="show-tick form-control"'); ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="new-guest">
            <fieldset>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                            <input type="text" name="first_name" class="form-control required" placeholder="First Name">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                            <input type="text" name="last_name" class="form-control required" placeholder="Last Name">
                            <input type="hidden" name="guest_id" value="" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                            <?php echo form_dropdown('package_type', $package_types, '', 'class="form-control required"'); ?>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                            <input type="text" name="arrival_date" class="form-control datepicker required" placeholder="Arrival Date">
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                            <input type="text" name="departure_date" class="form-control datepicker required" placeholder="Departure Date">
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

<?php else : ?>
    <h3 class="bg-info" style="background: #d9edf7; color: #333; padding: 10px; margin-top: 10px; margin-bottom: 10px;">
        <strong><?php echo $eventData['Booking']['Guest']['FirstName'] . ' ' . $eventData['Booking']['Guest']['LastName']; ?></strong> - <label style="font-size: 16px; padding-top: 7px" class="label label-primary"><?php echo $eventData['Booking']['Title']; ?></label>
        <?php echo form_hidden('booking_id', $booking_id); ?>
    </h3>
<?php endif; ?>

    <div class="row">

        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label class="bold text-muted"><i class="fa fa-tasks"></i> Service</label>
                <div class="form-group">
                    <div class="input-group" id="available-services" style="width:100%">
                        <?php echo form_dropdown('item_id', available_booking_items($booking_id), $item_id,
                            'class="form-control" ' . ($item_id ? 'readonly' : '')); ?>
                    </div>
                </div>
                <input type="checkbox" value="1" name="incl" <?php echo $incl ? 'checked' : '';?>> Included
                <input type="checkbox" value="1" name="not_incl" <?php echo $not_incl ? 'checked' : '';?>> Not Included
                <input type="checkbox" value="1" name="foc" <?php echo $foc ? 'checked' : '';?>> FOC
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label class="bold text-muted"><i class="fa fa-calendar"></i> Date & Time Settings</label>
                <div class="input-group">
                    <div class="start-dt col-lg-6" style="display: inline-block; padding-left: 0; padding-right: 0">
                        <?php echo form_dropdown('start_date', $dates, $start_date, 'data-duration="' . $duration . '" class="form-control required" style="width:50%"'); ?>
                        <?php echo form_dropdown('start_time', $times, $start_time, 'data-duration="' . $duration . '" class="form-control required" style="width:50%"'); ?>
                        <input type="hidden" name="_start_date" value="<?php echo $start_date; ?>"/>
                        <input type="hidden" name="_start_time" value="<?php echo $start_time; ?>"/>
                    </div>
                    <div class="end-dt col-lg-6" style="display: inline-block; padding-left: 0; padding-right: 0">
                        <?php echo form_dropdown('end_date', $dates, $end_date, 'class="form-control required" style="width:50%"'); ?>
                        <?php echo form_dropdown('end_time', $times, $end_time, 'class="form-control required" style="width:50%"'); ?>
                        <input type="hidden" name="_end_date" value="<?php echo $end_date; ?>"/>
                        <input type="hidden" name="_end_time" value="<?php echo $end_time; ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-md-6 col-lg-6">

            <div class="form-group">
                <div class="input-group" style="width:100%">
                    <label class="bold text-muted"><i class="fa fa-home"></i> Facility</label>
                    <?php echo form_dropdown('facility_id', $facilities, $facility_id, 'class="show-tick form-control"'); ?>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="input-group" style="width:100%">
                    <label class="bold text-muted"><i class="fa fa-user"></i> Service provider (s)</label>
                    <?php if ($max_provider > 1) : ?>
                        <?php echo form_multiselect('assigned_to[]', $providers, $assigned_to, 'class="multi-select show-tick form-control"', TRUE); ?>
                    <?php else : ?>
                        <?php echo form_dropdown('assigned_to[]', $providers, $assigned_to, 'class="show-tick form-control"', TRUE); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="form-group">
                <div class="input-group" style="width:100%">
                    <label class="bold text-muted"><i class="fa fa-flag"></i> Status</label>
                    <?php echo form_dropdown('status', $statuses, $status, 'class="show-tick form-control required"'); ?>
                </div>
            </div>

        </div>
        <div class="col-xs-2 col-md-6 col-lg-3">
            <div class="form-group">
                <div class="input-group" style="width:100%">
                    <label class="bold text-muted"><i class="fa fa-user"></i> Book By </label>
                    <?php echo form_dropdown('author_id', $audit_users, $author_id, 'class="show-tick form-control"'); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label class="bold text-muted"><i class="fa fa-file-text"></i> Additional Info </label>
                <?php echo form_input('notes', $notes, 'class="form-control"'); ?>
            </div>
        </div>

    </div>

    <div class="panel-collapse collapse statusOptions <?php echo $status === 'cancelled' ? 'in' : '' ?>" id="cancelledOptions">

        <div class="alert alert-warning alert-dismissible fade in form-group" role="alert">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <label class="bold text-muted">Called by</label>
                    <?php echo form_dropdown('called_by', $providers, $called_by, 'class="show-tick form-control"'); ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <label class="bold text-muted">Cancelled by</label>
                    <?php echo form_dropdown('cancelled_by', $audit_users, $cancelled_by, 'class="show-tick form-control"'); ?>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <label class="bold text-muted">Reason</label>
                    <?php echo form_dropdown('cancelled_reason', $reasons, $cancelled_reason, 'class="form-control required" placeholder="Enter Reason"'); ?>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <label class="bold text-muted">Date</label>
                    <?php echo form_input('date_cancelled', $date_cancelled, 'class="form-control required datepicker" placeholder="Enter Reason"'); ?>
                </div>


            </div>
        </div>
    </div>

    <div class="panel-collapse collapse statusOptions <?php echo $status === 'os-done' ? 'in' : '' ?>" id="os-doneOptions">

        <div class="alert alert-warning alert-dismissible fade in form-group" role="alert">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">Included OS No.</label>
                    <?php echo form_input('incl_os_done_number', $incl_os_done_number, 'class="form-control"'); ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">Included OS Price</label>
                    <?php echo form_input('incl_os_done_amount', $incl_os_done_amount, 'class="form-control"'); ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">Not Incl. OS No.</label>
                    <?php echo form_input('not_incl_os_done_number', $not_incl_os_done_number, 'class="form-control"'); ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">Not Incl. OS Price</label>
                    <?php echo form_input('not_incl_os_done_amount', $not_incl_os_done_amount, 'class="form-control"'); ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">FOC OS No.</label>
                    <?php echo form_input('foc_os_done_number', $foc_os_done_number, 'class="form-control"'); ?>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <label class="bold text-muted">FOC OS Price</label>
                    <?php echo form_input('foc_os_done_amount', $foc_os_done_amount, 'class="form-control"'); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.selectpicker').selectpicker('render');
        });
    </script>

<?php
$contents = ob_get_clean();

$hidden_fields = ['event_id' => $event_id];

$this->view('partials/modal', array(
    'action' => 'backend/calendar',
    'ajax' => true,
    'form_id' => 'appointmentForm',
    'form_name' => 'appointmentForm',
    'custom_buttons' => $event_id ? '<a class="btn btn-danger btn-confirm pull-left" title="Are you sure you want to delete this appointment" href="' . site_url('backend/calendar/delete/' . $event_id) . '">Delete</a>' : '',
    'title' => 'Appointment',
    'hidden_fields' => $hidden_fields,
    'contents' => $contents
));
?>