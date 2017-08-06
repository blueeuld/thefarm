<div class="panel-heading"><b><i class="glyphicon glyphicon-user"></i> System Users</b>

    <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('backend/account/edit/'); ?>"><i class="fa fa-plus"></i> Add</a></li>
    </ul>

</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($users as $row) : ?>
                <tr class="contacts" id="contact-<?php echo $row['ContactId'];?>">
                    <td class="text-muted text-uppercase text-center">
                        <?php if ($row['Avatar']) : ?>
                            <img src="<?php echo $row['Avatar'];?>" width="30" alt="person">
                        <?php else : ?>
                            <img src="/images/noprofile.png" width="30" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo anchor('backend/account/edit/' . $row['ContactId'], $row['FirstName'] . ' ' . $row['LastName'], 'class="text-regular"'); ?>
                    </td>
                    <td><?php echo $row['Email']; ?></td>
                    <td class="text-center">
                        <a href="<?php echo site_url('backend/account/edit/' . $row['ContactId']); ?>"
                           class="btn btn-xs btn-icon btn-primary"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo site_url('backend/account/delete/' . $row['ContactId']); ?>" class="btn btn-xs btn-icon btn-default btn-confirm" title="Are you sure you want to delete this person?"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>