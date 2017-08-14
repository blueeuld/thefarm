<div role="tabpanel" class="tab-pane" id="services">

    <?php echo form_hidden('contact_id', $contact_id); ?>
    <?php $other_services = []; ?>

    <ul class="list-group">
        <li class="list-group-item">
            <div class="input-group">
                <?php echo form_dropdown('add_service', $other_services, '', 'class="selectpicker show-tick form-control"'); ?>
                <span class="input-group-btn"><button type="button" class="btn btn-primary" id="add_related_service"><i class="fa fa-plus"></i> Add Service</button></span>
            </div>
        </li>
    <?php if ($userItems) : ?>
        <?php foreach ($userItems as $service) : ?>
            <?php if (isset($service['Item'])) : ?>
            <li class="list-group-item" id="related_services_<?php echo $service['ItemId']; ?>">
                <a href="#" class="pull-right"><i class="glyphicon glyphicon-trash"></i> </a>
                <!--<td style="width:5%;"><?php echo form_checkbox('remove_related_services_' . $service['ItemId'], $service['ItemId'], $service['ContactId'] !== null); ?></td>-->
                <?php
                $duration = (int)$service['Item']['Duration'];
                echo $service['Item']['Title'] . ($duration > 0 ? ' (' . $duration . ' min)' : '');
                ?>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    </ul>
</div>