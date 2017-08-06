<?php
$return = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/services';
?>

<div class="panel-heading"><b><i class="glyphicon glyphicon-tasks"></i> Categories</b></div>

<div class="panel-body">

    <div class="table-responsive">
        <table class="table table-striped table-hover dt-responsive no-footer dtr-inline">
            <tbody>

            <?php

            $indent = false;
            $parent = 0;

            foreach ($categories as $row) :

                if ($row['parent_id'] === '0' || $row['cat_id'] === $row['parent_id']) {
                    $parent = $row['cat_id'];
                    $indent = 0;
                } elseif ($row['parent_id'] === $parent) {
                    $indent++;
                }


                ?>
                <tr>
                    <td>
                        <?php if ($indent) : ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                src="/images/cat_marker.gif"><?php endif; ?>
                        <?php echo anchor('backend/category/edit/' . $row['cat_id'] . '?return=' . urlencode($return), $row['cat_name'], 'class="text-regular" data-toggle="modal" data-target="#modal-popup"'); ?>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo site_url('backend/category/edit/' . $row['cat_id'] . '?return=' . urlencode($return)); ?>"
                           class="btn btn-xs btn-icon btn-primary" data-toggle="modal"
                           data-target="#modal-popup"><i
                                    class="fa fa-pencil"></i></a>
                        <a href="<?php echo site_url('backend/category/delete/' . $row['cat_id']); ?>"
                           class="btn btn-xs btn-icon btn-default btn-confirm"
                           title="Are you sure you want to delete this category?"><i
                                    class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>