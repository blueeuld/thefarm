<div role="tabpanel" class="tab-pane" id="submissions">

    <div class="row">

        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-pills nav-stacked col-md-2">
                    <?php foreach ($guest_forms as $form) : ?>
                        <li>
                            <a data-toggle="tab" href="#form-<?php echo $form['form_id'];?>"><?php echo $form['form_name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content col-md-10">
                    <?php foreach ($guest_forms as $form) : ?>


                        <div class="tab-pane" id="form-<?php echo $form['form_id'];?>">


                            <!--<h3><?php echo $form['form_name'];?></h3>-->
                            <?php
                            $completed_by = (int)$form['completed_by'];
                            if ($completed_by > 0 && current_user_can('CanEditCompletedForms') && get_current_user_id() !== $completed_by) :
                                ?>
                                You are not allowed to edit forms completed by others.
                                <?php
                            else :


                                echo form_open('backend/entry', array('class' => 'form validate', 'id' => 'form-'.$form['form_id']), array('booking_id' => $booking_id, 'form_id' => $form['form_id'], 'complete' => 'y'));

                                ?>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-primary btn-save-form-entry">Save</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" class="btn-new-form-entry">New</a></li>
                                        <li><a href="#" class="btn-save-form-entry">Save</a></li>
                                        <li><a href="#" class="btn-duplicate-form-entry">Duplicate</a></li>
                                    </ul>
                                </div>
                                <?php

                                $value = booking_form_entries($booking_id, $form['form_id']);

                                if ($value) {
                                    echo form_hidden('entry_id', $value['entry_id']);
                                }
                                echo '<div class="form-group">';
                                $this->formbuilder->build($form['field_ids'], $value);
                                echo '</div>';

                                echo form_close();

                            endif;
                            ?>
                        </div>
                    <?php endforeach;?>
                </div>

            </div>

        </div>

    </div>
</div>