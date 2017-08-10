<div role="tabpanel" class="tab-pane" id="services">

    <?php echo form_hidden('contact_id', $contact_id); ?>

    <div class="input-group">
        <?php echo form_dropdown('add_service', $other_services, '', 'class="selectpicker show-tick form-control"'); ?>
        <span class="input-group-btn"><button type="button" class="btn btn-primary" id="add_related_service"><i class="fa fa-plus"></i> Add Service</button></span>
    </div>

    <table class="table" id="related_services">
        <thead>
        <tr>
            <th>Remove</th>
            <th>Service</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($userItems) : ?>
            <?php foreach ($userItems as $service) : ?>
                <tr id="related_services_<?php echo $service['item_id']; ?>">
                    <td style="width:5%;"><?php echo form_checkbox('remove_related_services_' . $service['item_id'], $service['item_id'], $service['contact_id'] !== null); ?></td>
                    <td>
                        <?php
                        $duration = (int)$service['duration'];
                        echo $service['title'] . ($duration > 0 ? ' (' . $duration . ' min)' : '');
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>