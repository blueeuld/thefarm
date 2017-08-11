<?php

$userApi = new UserApi();

$nationalities = nationalities();
$countries = countries();

$positions = ['' => '-Select-'];
$positionsArr = $userApi->get_job_titles();
foreach ($positionsArr as $item) {
    $positions[$item['PositionCd']] = $item['PositionValue'];
}

$data['positions'] = $positions;

$titles = array(
    'Ms' => 'Ms',
    'Mrs' => 'Mrs',
    'Mr' => 'Mr',
    'Master' => 'Master',
    'Rev' => 'Rev',
    'Fr' => 'Fr',
    'Dr' => 'Dr',
    'Atty' => 'Atty',
    'Prof' => 'Prof',
    'Hon' => 'Hon',
    'Pres' => 'Pres',
    'Gov' => 'Gov',
    'Coach' => 'Coach',
    'Ofc' => 'Ofc',
    'Rep' => 'Rep',
    'Sen' => 'Sen');

$civil_statuses = array(
    'Single' => 'Single',
    'Married' => 'Married',
    'Living Common Law' => 'Living Common Law',
    'Widowed' => 'Widowed',
    'Separated' => 'Separated',
    'Divorced' => 'Divorced',
);

$editable = false;

if ($_SESSION['ContactId'] === $userData['ContactId']) {
    $editable = true;
}
elseif (current_user_can('CanEditOtherProfiles')) {
    $editable = true;
}

$group_cd = isset($userData['User']) ? $userData['User']['Group']['GroupCd'] : 'guest';

?>

<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('success_message') ?>
    </div>
<?php endif ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('error_message') ?>
    </div>
<?php endif ?>

<?php echo form_open_multipart('backend/guest/save', array('class'=>'form-horizontal padding-15 validate'), array('contact_id' => $userData['ContactId'], 'return' => $return));?>
    <div class="form-group">
        <label for="avatar" class="col-sm-3 control-label">Profile Picture</label>
        <div class="col-sm-9">
            <div class="media">

                <div class="media-left">
                    <?php if ($userData['Avatar']) : ?>
                    <img src="<?php echo $userData['Avatar'];?>" width="80" alt="person">
                    <?php else : ?>
                    <img src="/images/noprofile.png" width="80" />
                    <?php endif; ?>
                </div>

                <div class="media-body media-middle">
                    <input type="file" name="avatar" class="filestyle">
                    <small class="text-muted bold">Size 80x80px</small>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" <?php echo !$editable ? 'disabled' : '';?> id="last_name" name="last_name" value="<?php echo $userData['LastName'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" <?php echo !$editable ? 'disabled' : '';?> id="first_name" name="first_name" value="<?php echo $userData['FirstName'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Nick Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" <?php echo !$editable ? 'disabled' : '';?> id="nickname" name="nickname" value="<?php echo $userData['Nickname'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-9">
	        <?php echo form_dropdown('title', $titles, $userData['Title'], 'class="form-control"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Position</label>
        <div class="col-sm-9">
            <?php echo form_dropdown('position', $positions, $userData['PositionCd'], 'class="form-control"'); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Civil Status</label>
        <div class="col-sm-9">
	        <?php echo form_dropdown('civil_status', $civil_statuses, $userData['CivilStatus'], 'class="form-control"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Gender</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="female" value="0" <?php echo !$editable ? 'disabled' : '';?> name="gender" <?php  echo ($userData['Gender']==0) ? "checked":""; ?>>
                <label for="female"> Female </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="male" value="1" <?php echo !$editable ? 'disabled' : '';?> name="gender" <?php  echo ($userData['Gender']==1) ? "checked":""; ?>>
                <label for="male"> Male </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Date of Birth</label>
        <div class="col-sm-9">
            <input type="text" <?php echo !$editable ? 'disabled' : '';?> class="datepicker form-control" name="dob" value="<?php echo ($userData['Dob'] === '' || $userData['Dob'] === '0000-00-00') ? '':date('m/d/Y', strtotime($userData['Dob']));?>">
        </div>
    </div>
    <?php if ($group_cd === 'guest'): ?>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Ethnic Origin</label>
        <div class="col-sm-9">
            <input type="text" <?php echo !$editable ? 'disabled' : '';?> class="form-control" name="etnic_origin" value="<?php echo $userData['EtnicOrigin'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Height</label>
        <div class="col-sm-9">
            <input type="text" <?php echo !$editable ? 'disabled' : '';?> class="form-control" name="height" value="<?php echo $userData['Height'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Weight</label>
        <div class="col-sm-9">
            <input type="text" <?php echo !$editable ? 'disabled' : '';?> class="form-control" name="weight" value="<?php echo $userData['Weight'];?>">
        </div>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Telephone Number</label>
        <div class="col-sm-9">
            <input type="text" <?php echo !$editable ? 'disabled' : '';?> class="form-control" name="phone" value="<?php echo $userData['Phone'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="email" <?php echo !$editable ? 'disabled' : '';?> class="form-control" name="email" value="<?php echo $userData['Email'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Date Joined</label>
        <div class="col-sm-9">
            <input class="datepicker form-control" <?php echo !$editable ? 'disabled' : '';?> name="date_joined" type="text" value="<?php echo ($userData['DateJoined']==='' || $userData['DateJoined'] === '0000-00-00') ? "":date('m/d/Y', strtotime($userData['DateJoined']));?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Nationality</label>
        <div class="col-sm-9">
            <?php echo form_dropdown('nationality', $nationalities, $userData['Nationality'], array("class"=>"selectpicker show-tick form-control")); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Country of Dominicile</label>
        <div class="col-sm-9">
            <?php echo form_dropdown('country_dominicile', $countries, $userData['CountryDominicile'], array("class"=>"selectpicker show-tick form-control")); ?>
        </div>
    </div>

    <?php if (!$userData['ContactId'] && $editable) : ?>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Skip Confirmation Email</label>
        <div class="col-sm-9">
            <?php echo form_checkbox('skip_confirmation', 1); ?> Add the guest without sending an email that requires their confirmation.
        </div>
    </div>
    <?php endif; ?>
	
	<?php if ($editable) : ?>
    <hr>
    <div class="form-group">
        <div class="col-md-offset-3 col-sm-9 ">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </div>
    <?php endif; ?>

<?php echo form_close() ?>