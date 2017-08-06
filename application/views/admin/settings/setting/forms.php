
<div class="panel-heading"><b><i class="glyphicon glyphicon-list-alt"></i> Forms</b>

    <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('backend/form/edit');?>"><i class="fa fa-plus"></i> Add Form</a></li>
        <li><a data-toggle="modal" data-target="#modal-popup" href="<?php echo site_url('backend/field/edit');?>"><i class="fa fa-plus"></i> Add Field</a></li>

    </ul>
</div>

<div class="panel-body">
    <!-- Nav tabs -->
    <div role="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#forms" aria-controls="forms" role="tab" data-toggle="tab">Forms</a>
            </li>
            <li role="presentation">
                <a href="#fields" aria-controls="fields" role="tab" data-toggle="tab">Fields</a>
            </li>
        </ul>
        <div class="tab-content tab-content-default">
            <div role="tabpanel" class="tab-pane active" id="forms">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="text-uppercase">
                            <th>Name</th>
                            <th class="text-center">Submissions</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($forms as $row) : ?>
                            <tr>
                                <td>
                                    <?php echo anchor('backend/form/edit/'.$row['form_id'], $row['form_name'], 'class="text-regular" '); ?></td>
                                <td class="text-center"><span class="badge"><?php echo forms_entries($row['form_id']);?></span></td>
                                <td class="text-center">
                                    <a href="<?php echo site_url('backend/form/edit/'.$row['form_id']);?>" class="btn btn-xs btn-icon btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('backend/form/delete/'.$row['form_id']);?>" class="btn btn-xs btn-icon btn-default btn-confirm" title="Are you sure you want to delete this form?"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>

            <div role="tabpanel" class="tab-pane" id="fields">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="text-uppercase">
                            <!--<th>Field Name</th>-->
                            <th>Label</th>
                            <th class="text-center">Required?</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if ($fields) : ?>
                            <?php foreach ($fields as $row) : ?>
                                <tr>
                                    <td><a data-toggle="modal" data-target="#modal-popup" class="text-regular" href="<?php echo site_url('backend/field/edit/'.$row['field_id']);?>">
                                            <?php echo $row['field_label'];?></a></td>
                                    <td class="text-center">
                                        <?php if ($row['required'] === 'y') : ?>
                                            <i class="fa fa-check"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('backend/field/edit/'.$row['field_id']);?>" data-toggle="modal" data-target="#modal-popup" class="btn btn-xs btn-icon btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo site_url('backend/field/delete/'.$row['field_id']);?>" class="btn btn-xs btn-icon btn-default btn-confirm" title="Are you sure you want to DELETE this FIELD?"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

</div>