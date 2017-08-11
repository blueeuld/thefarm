<?php

$eventApi = new EventApi();
$todayTreatment = $eventApi->get_events(date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59'), null, [1, 2], $_SESSION['User']['LocationId']);

?>
<div class="col-lg-3 col-md-3 col-sm-3 tile_stats_count text-center">
    <div class="value">
        <?php echo count($todayTreatment);?>
    </div>
    <div class="tile_count_label text-muted">
        # of Treatments
    </div>
</div>
