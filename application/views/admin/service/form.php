<?php
ob_start();
$iconsFA = array("fa-adjust", "fa-adn", "fa-align-center", "fa-align-justify", "fa-align-left", "fa-align-right",
    "fa-ambulance", "fa-anchor", "fa-android", "fa-apple", "fa-archive", "fa-asterisk", "fa-backward", "fa-ban", "fa-barcode", "fa-bars",
    "fa-beer", "fa-bell", "fa-bell-o",
    "fa-bolt", "fa-bomb", "fa-book",
    "fa-bookmark", "fa-bookmark-o", "fa-briefcase", "fa-btc", "fa-bug", "fa-building", "fa-building-o", "fa-bullhorn", "fa-bullseye", "fa-calendar",
    "fa-calendar-o", "fa-camera", "fa-camera-retro", "fa-car",
    "fa-certificate", "fa-chain-broken", "fa-child",
    "fa-circle", "fa-circle-o", "fa-circle-o-notch", "fa-circle-thin", "fa-clipboard", "fa-clock-o", "fa-cloud",
    "fa-coffee", "fa-cog", "fa-cogs", "fa-columns", "fa-comment", "fa-comment-o", "fa-comments", "fa-comments-o", "fa-compass", "fa-compress",
    "fa-credit-card", "fa-crop", "fa-css3", "fa-cube", "fa-cubes", "fa-cutlery", "fa-database",
    "fa-delicious", "fa-desktop", "fa-deviantart", "fa-digg", "fa-dot-circle-o", "fa-download", "fa-eject", "fa-ellipsis-h", "fa-ellipsis-v",
    "fa-empire", "fa-envelope", "fa-envelope-o", "fa-envelope-square", "fa-eraser", "fa-exchange", "fa-exclamation", "fa-exclamation-circle",
    "fa-exclamation-triangle", "fa-expand", "fa-external-link", "fa-external-link-square", "fa-eye", "fa-eye-slash",
    "fa-fast-backward", "fa-fast-forward", "fa-fax", "fa-female", "fa-fighter-jet",
    "fa-film", "fa-filter", "fa-fire", "fa-fire-extinguisher", "fa-flag",
    "fa-flag-checkered", "fa-flag-o", "fa-flask", "fa-floppy-o", "fa-folder", "fa-folder-o", "fa-folder-open", "fa-folder-open-o", "fa-font",
    "fa-forward", "fa-frown-o", "fa-gamepad", "fa-gift", "fa-git", "fa-git-square",
    "fa-glass", "fa-globe",
    "fa-graduation-cap", "fa-hacker-news",
    "fa-hdd-o", "fa-header", "fa-headphones", "fa-heart", "fa-heart-o", "fa-history",
    "fa-home", "fa-hospital-o",
    "fa-inbox", "fa-indent", "fa-info", "fa-info-circle", "fa-inr", "fa-joomla", "fa-jpy", "fa-key",
    "fa-keyboard-o", "fa-krw", "fa-language", "fa-laptop", "fa-leaf", "fa-lemon-o", "fa-level-down", "fa-level-up", "fa-life-ring", "fa-lightbulb-o",
    "fa-link", "fa-list", "fa-list-alt", "fa-list-ol", "fa-list-ul", "fa-location-arrow", "fa-lock", "fa-magic", "fa-magnet", "fa-male", "fa-map-marker",
    "fa-medkit", "fa-microphone", "fa-microphone-slash", "fa-minus",
    "fa-minus-circle", "fa-minus-square", "fa-minus-square-o", "fa-mobile", "fa-money", "fa-moon-o", "fa-music",
    "fa-outdent", "fa-pagelines", "fa-paper-plane",
    "fa-paper-plane-o", "fa-paperclip", "fa-paragraph", "fa-pause", "fa-paw", "fa-pencil", "fa-pencil-square", "fa-pencil-square-o", "fa-phone",
    "fa-phone-square", "fa-picture-o", "fa-pied-piper", "fa-pied-piper-alt", "fa-plane", "fa-play", "fa-play-circle",
    "fa-play-circle-o", "fa-plus", "fa-plus-circle", "fa-plus-square", "fa-plus-square-o", "fa-power-off", "fa-print", "fa-puzzle-piece", "fa-qq", "fa-qrcode", "fa-question",
    "fa-question-circle", "fa-quote-left", "fa-quote-right", "fa-random",  "fa-rebel", "fa-recycle", "fa-reddit", "fa-reddit-square", "fa-refresh",
    "fa-repeat", "fa-reply", "fa-reply-all", "fa-retweet", "fa-road", "fa-rocket", "fa-rss", "fa-rss-square", "fa-rub", "fa-scissors", "fa-search", "fa-search-minus",
    "fa-search-plus", "fa-share", "fa-share-alt", "fa-share-alt-square", "fa-share-square", "fa-share-square-o", "fa-shield",
    "fa-shopping-cart", "fa-sign-in", "fa-sign-out", "fa-signal", "fa-simplybuilt", "fa-sitemap", "fa-sliders", "fa-smile-o",
    "fa-sort", "fa-sort-alpha-asc", "fa-sort-alpha-desc", "fa-sort-amount-asc", "fa-sort-amount-desc", "fa-sort-asc", "fa-sort-desc",
    "fa-sort-numeric-asc", "fa-sort-numeric-desc", "fa-soundcloud", "fa-space-shuttle", "fa-spinner", "fa-spoon", "fa-spotify", "fa-square", "fa-square-o", "fa-star",
    "fa-star-half", "fa-star-half-o", "fa-star-o", "fa-steam", "fa-steam-square", "fa-step-backward", "fa-step-forward", "fa-stethoscope", "fa-stop",
    "fa-suitcase", "fa-sun-o", "fa-table",
    "fa-tablet", "fa-tachometer", "fa-tag", "fa-tags", "fa-tasks", "fa-taxi", "fa-th", "fa-th-large", "fa-th-list",
    "fa-thumb-tack", "fa-thumbs-down", "fa-thumbs-o-down",
    "fa-thumbs-o-up", "fa-thumbs-up", "fa-ticket", "fa-times", "fa-times-circle", "fa-times-circle-o", "fa-tint",
    "fa-trash-o", "fa-tree", "fa-trophy", "fa-truck", "fa-umbrella",
    "fa-university", "fa-unlock", "fa-usd", "fa-user", "fa-user-md",
    "fa-users", "fa-video-camera",
    "fa-wheelchair",
    "fa-wrench");

$thumbnail = [
    'images/glass.png' => 'Glass'
];

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
    <li><a href="#providers" aria-controls="providers" role="tab" data-toggle="tab">Related Providers</a></li>
    <li><a href="#forms" aria-controls="form" role="tab" data-toggle="tab">Related Forms</a></li>
    <li><a href="#facilities" aria-controls="froviders" role="tab" data-toggle="tab">Related Facilities</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <br/>
        <div class="row">

            <div class="col-lg-2">
                <p>
                    <img src="<?php echo get_image_url($item_image); ?>" width="100" style="padding-bottom:10px">
                    <span><input type="file" name="item_image" class="filestyle"></span>
                </p>
            </div>

            <div class="col-lg-8">
                <p>
                    <input type="text" class="form-control" name="title" placeholder="Title of your service"
                           value="<?php echo $title; ?>">
                </p>
                <label class="bold text-muted"><i class="fa fa-clock"></i>Categories</label>
                <p>
                    <?php echo form_multiselect('item_categories[]', $categories, $item_categories, 'class="multi-select" data-header="Select categories"'); ?>
                </p>
            </div>

            <div class="col-lg-2">
                <p>
                    <select name="item_icon" class="selectpicker form-control">
                        <option value="">(no icon)</option>
                        <?php foreach ($thumbnail as $image => $text) : ?>
                            <option data-thumbnail="<?php echo $image; ?>"
                                    value="<?php echo $image; ?>"><?php echo $text; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3">

                <label class="bold text-muted"><i class="fa fa-clock"></i> Duration</label>

                <div class="row">
                    <div class="col-md-6">
                        <select name="duration_hours" class="form-control">
                            <option value="">Hr</option>
                            <option value="0"<?php if ($duration_hr == 0) : ?> selected<?php endif; ?>>00</option>
                            <option value="1"<?php if ($duration_hr == 1) : ?> selected<?php endif; ?>>01</option>
                            <option value="2"<?php if ($duration_hr == 2) : ?> selected<?php endif; ?>>02</option>
                            <option value="3"<?php if ($duration_hr == 3) : ?> selected<?php endif; ?>>03</option>
                            <option value="4"<?php if ($duration_hr == 4) : ?> selected<?php endif; ?>>04</option>
                            <option value="5"<?php if ($duration_hr == 5) : ?> selected<?php endif; ?>>05</option>
                            <option value="6"<?php if ($duration_hr == 6) : ?> selected<?php endif; ?>>06</option>
                            <option value="7"<?php if ($duration_hr == 7) : ?> selected<?php endif; ?>>07</option>
                            <option value="8"<?php if ($duration_hr == 8) : ?> selected<?php endif; ?>>08</option>
                            <option value="9"<?php if ($duration_hr == 9) : ?> selected<?php endif; ?>>09</option>
                            <option value="10"<?php if ($duration_hr == 10) : ?> selected<?php endif; ?>>10</option>
                            <option value="11"<?php if ($duration_hr == 11) : ?> selected<?php endif; ?>>11</option>
                            <option value="12"<?php if ($duration_hr == 12) : ?> selected<?php endif; ?>>12</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="duration_minutes" class="form-control col-md-6">
                            <option value="">Min</option>
                            <option value="0"<?php if ($duration_min == 0) : ?> selected<?php endif; ?>>00</option>
                            <option value="5"<?php if ($duration_min == 5) : ?> selected<?php endif; ?>>05</option>
                            <option value="10"<?php if ($duration_min == 10) : ?> selected<?php endif; ?>>10</option>
                            <option value="15"<?php if ($duration_min == 15) : ?> selected<?php endif; ?>>15</option>
                            <option value="20"<?php if ($duration_min == 20) : ?> selected<?php endif; ?>>20</option>
                            <option value="25"<?php if ($duration_min == 25) : ?> selected<?php endif; ?>>25</option>
                            <option value="30"<?php if ($duration_min == 30) : ?> selected<?php endif; ?>>30</option>
                            <option value="35"<?php if ($duration_min == 35) : ?> selected<?php endif; ?>>35</option>
                            <option value="40"<?php if ($duration_min == 40) : ?> selected<?php endif; ?>>40</option>
                            <option value="45"<?php if ($duration_min == 45) : ?> selected<?php endif; ?>>45</option>
                            <option value="50"<?php if ($duration_min == 50) : ?> selected<?php endif; ?>>50</option>
                            <option value="55"<?php if ($duration_min == 55) : ?> selected<?php endif; ?>>55</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <label class="bold text-muted">Abbreviation</label>
                <p>
                    <input type="text" class="form-control" name="abbr" value="<?php echo $abbr; ?>">
                </p>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <label class="bold text-muted">Cost</label>
                <p>
                    <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                </p>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">

                <label class="bold text-muted">Service Providers</label>
                <p>
                    <input type="text" class="form-control" name="max_provider" value="<?php echo $max_provider; ?>">
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th width="50%">Day Settings <span class="text-muted" style="font-size: 12px;">accepts Mon...Sun separated by comma.</span>
                        </th>
                        <th>Time Settings <span class="text-muted" style="font-size: 12px;">accepts 01:00AM format separated by comma.</span>
                        </th>
                    </tr>
                    </thead>
                    <?php foreach ($day_time_settings as $i => $day_time_setting) : ?>
                        <tr>
                            <td><input placeholder="Applicable to all week days" type="text" name="day_settings[]"
                                       style="width: 100%" value="<?php echo $day_time_setting['day_settings']; ?>">
                            </td>
                            <td><input type="text" name="time_settings[]" style="width: 100%"
                                       value="<?php echo $day_time_setting['time_settings']; ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="bold text-muted">Description</label>
                <textarea name="description" class="summernote"><?php echo $description; ?></textarea>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="providers">
        <div class="clearfix">
            <ul class="col-lg-4 list-group relatedUsers">
                <?php foreach ($productData['Users'] as $provider) : ?>
                <li class="list-group-item" id="relatedUser<?php echo $provider['ContactId'];?>">
                    <?php echo $provider['Contact']['FirstName'] . $provider['Contact']['LastName']; ?>
                    <input type="hidden" name="related_user_ids[]" value="<?php echo $provider['ContactId'];?>" />
                    <span class="pull-right"><a href="#" class="deleteRelationship"><i class="glyphicon glyphicon-trash"></i> </a></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group col-lg-4">
            <?php echo form_dropdown('providers', $providers, '', 'class="form-control"'); ?>
        </div>
        <button class="btn btn-success addRelatedUser" type="button">Add</button>
    </div>
    <div role="tabpanel" class="tab-pane" id="forms">

        <p>
            <br/>
            <?php echo form_multiselect('related_form_ids[]', $forms, $related_form_ids, 'class="multi-select" data-header="Select questionaires/forms" data-live-search="true"'); ?>
        </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="facilities">

        <div class="clearfix">
            <ul class="col-lg-4 list-group relatedFacilities">
                <?php foreach ($productData['Facilities'] as $facility) : ?>
                    <li class="list-group-item" id="relatedUser<?php echo $facility['FacilityId'];?>">
                        <?php echo $facility['Facility']['FacilityName'] ?>
                        <input type="hidden" name="related_facility_ids[]" value="<?php echo $facility['FacilityId'];?>" />
                        <span class="pull-right"><a href="#" class="deleteRelationship"><i class="glyphicon glyphicon-trash"></i> </a></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-group col-lg-4">
            <?php echo form_dropdown('facilities', $facilities, '', 'class="form-control"'); ?>
        </div>
        <button class="btn btn-success addRelatedFacility" type="button">Add</button>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();

        $('.deleteRelationship').each(function(){
            $(this).on('click', function(evt){
                evt.preventDefault();
                $(this).parents('li.list-group-item').remove();
            });
        });
        
        $('.addRelatedUser').on('click', function (evt) {
            evt.preventDefault();
            var selected = $('[name="providers"]').find('option:selected');
            if (selected) {
                var o = $('#relatedUser'+selected.val());
                if (o.length === 0) {
                    var $li = $('<li class="list-group-item" id="relatedUser'+selected.val()+'">'+selected.text()+'</li>');
                    $li.append('<input type="hidden" name="related_user_ids[]" value="'+selected.val()+'" />');
                    $li.append('<span class="pull-right"><a href="#" class="deleteRelationship"><i class="glyphicon glyphicon-trash"></i> </a></span>');
                    $li.find('.deleteRelationship').on('click', function(){
                        $(this).parents('li.list-group-item').remove();
                    });
                    $('.relatedUsers').append($li);
                }
                else {
                    alert('Already exists.');
                }
            }
        });

        $('.addRelatedFacility').on('click', function (evt) {
            evt.preventDefault();
            var selected = $('[name="facilities"]').find('option:selected');
            if (selected) {
                var o = $('#relatedFacility'+selected.val());
                if (o.length === 0) {
                    var $li = $('<li class="list-group-item" id="relatedFacility'+selected.val()+'">'+selected.text()+'</li>');
                    $li.append('<input type="hidden" name="related_facility_ids[]" value="'+selected.val()+'" />');
                    $li.append('<span class="pull-right"><a href="#" class="deleteRelationship"><i class="glyphicon glyphicon-trash"></i> </a></span>');
                    $li.find('.deleteRelationship').on('click', function(){
                        $(this).parents('li.list-group-item').remove();
                    });
                    $('.relatedFacilities').append($li);
                }
                else {
                    alert('Already exists.');
                }
            }
        });
    })
</script>

<?php
$contents = ob_get_clean();

$this->view('partials/modal', array(
    'action' => 'backend/service',
    'title' => $item_id ? 'Edit Service' : 'Add Service',
    'hidden_fields' => array('id' => $item_id, 'return' => $_REQUEST['return']),
    'contents' => $contents
));
?>
