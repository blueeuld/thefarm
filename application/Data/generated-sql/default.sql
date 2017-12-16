
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- tf_booking_attachments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_attachments`;

CREATE TABLE `tf_booking_attachments`
(
    `booking_id` INTEGER DEFAULT 0 NOT NULL,
    `file_id` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`booking_id`,`file_id`),
    INDEX `booking_attachment_file_fk` (`file_id`),
    CONSTRAINT `booking_attachment_booking_fk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `booking_attachment_file_fk`
        FOREIGN KEY (`file_id`)
        REFERENCES `tf_files` (`file_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_event_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_event_user`;

CREATE TABLE `tf_event_user`
(
    `event_id` INTEGER DEFAULT 0 NOT NULL,
    `user_id` INTEGER DEFAULT 0 NOT NULL,
    `is_guest` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`event_id`,`user_id`),
    INDEX `tf_event_user_i_6ca017` (`user_id`),
    CONSTRAINT `tf_event_user_fk_11d4fb`
        FOREIGN KEY (`event_id`)
        REFERENCES `tf_event` (`event_id`),
    CONSTRAINT `tf_event_user_fk_e09fae`
        FOREIGN KEY (`user_id`)
        REFERENCES `tf_user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_event
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_event`;

CREATE TABLE `tf_event`
(
    `event_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER,
    `event_title` VARCHAR(100) NOT NULL,
    `start_dt` DATETIME,
    `end_dt` DATETIME,
    `facility_id` INTEGER,
    `all_day` INTEGER(1) NOT NULL,
    `status` VARCHAR(16),
    `author_id` INTEGER,
    `entry_date` INTEGER(10) DEFAULT 0,
    `edit_date` INTEGER(10) DEFAULT 0,
    `notes` VARCHAR(255) DEFAULT '',
    `called_by` INTEGER,
    `cancelled_by` INTEGER,
    `cancelled_reason` VARCHAR(50) DEFAULT '',
    `date_cancelled` INTEGER(10) DEFAULT 0,
    `personalized` VARCHAR(100) DEFAULT '',
    `is_active` TINYINT(1) DEFAULT 1,
    `deleted_date` INTEGER(10) DEFAULT 0,
    `deleted_by` INTEGER,
    `item_id` INTEGER,
    `is_kids` TINYINT(1) DEFAULT 0,
    `incl_os_done_number` VARCHAR(20),
    `incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00,
    `foc_os_done_number` VARCHAR(20),
    `foc_os_done_amount` DECIMAL(10,2) DEFAULT 0.00,
    `not_incl_os_done_number` VARCHAR(20),
    `not_incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00,
    `incl` INTEGER(1) NOT NULL,
    `not_incl` INTEGER(1) NOT NULL,
    `foc` INTEGER(1) NOT NULL,
    PRIMARY KEY (`event_id`),
    INDEX `booking_event_facility_fk` (`facility_id`),
    INDEX `booking_event_author_fk` (`author_id`),
    INDEX `booking_event_called_by_fk` (`called_by`),
    INDEX `booking_event_cancelled_by_fk` (`cancelled_by`),
    INDEX `booking_event_deleted_by_fk` (`deleted_by`),
    INDEX `booking_event_item_by_fk` (`item_id`),
    INDEX `booking_event_status_fk` (`status`),
    INDEX `fi_king_fk` (`booking_id`),
    CONSTRAINT `booking_event_author_fk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_fk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `booking_event_called_by_fk`
        FOREIGN KEY (`called_by`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_event_cancelled_by_fk`
        FOREIGN KEY (`cancelled_by`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_event_deleted_by_fk`
        FOREIGN KEY (`deleted_by`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `tf_event_fk_1eba8a`
        FOREIGN KEY (`facility_id`)
        REFERENCES `tf_facilities` (`facility_id`),
    CONSTRAINT `tf_event_fk_b49f13`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`),
    CONSTRAINT `booking_event_status_fk`
        FOREIGN KEY (`status`)
        REFERENCES `tf_event_status` (`status_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_forms
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_forms`;

CREATE TABLE `tf_booking_forms`
(
    `booking_id` INTEGER NOT NULL,
    `form_id` INTEGER NOT NULL,
    `required` TINYINT(1) DEFAULT 0,
    `submitted` TINYINT(1) DEFAULT 0,
    `notify_user_on_submit` VARCHAR(255) DEFAULT '' NOT NULL,
    `submitted_date` INTEGER(10) DEFAULT 0,
    `completed_by` INTEGER,
    `completed_date` int(10) unsigned DEFAULT 0,
    PRIMARY KEY (`booking_id`,`form_id`),
    INDEX `booking_form_completed_fk` (`completed_by`),
    INDEX `booking_form_fk` (`form_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_items`;

CREATE TABLE `tf_booking_items`
(
    `booking_id` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    `quantity` INTEGER(5) NOT NULL,
    `included` TINYINT(1),
    `foc` TINYINT(1),
    `upsell` TINYINT(1),
    `upgrade` TINYINT(1),
    `inventory` INTEGER(5) DEFAULT 0,
    INDEX `booking_item_item_fk` (`item_id`),
    INDEX `booking_item_booking_fk` (`booking_id`),
    CONSTRAINT `booking_item_booking_fk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `booking_item_item_fk`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_status`;

CREATE TABLE `tf_booking_status`
(
    `status_cd` VARCHAR(20) NOT NULL,
    `status_value` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`status_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_bookings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_bookings`;

CREATE TABLE `tf_bookings`
(
    `booking_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(200) NOT NULL,
    `package_id` INTEGER,
    `start_date` INTEGER NOT NULL,
    `end_date` INTEGER NOT NULL,
    `notes` TEXT NOT NULL,
    `status` VARCHAR(16),
    `guest_id` INTEGER,
    `fax` SMALLINT(3) DEFAULT 0,
    `author_id` INTEGER(5) DEFAULT 1,
    `entry_date` INTEGER(10) DEFAULT 0,
    `edit_date` INTEGER(10) DEFAULT 0,
    `personalized` SMALLINT(1) DEFAULT 0,
    `room_id` INTEGER,
    `restrictions` TEXT NOT NULL,
    `package_type_id` INTEGER,
    `is_active` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`booking_id`),
    INDEX `fi_king_author_fk` (`author_id`),
    INDEX `fi_king_guest_fk` (`guest_id`),
    INDEX `fi_king_package_fk` (`package_id`),
    INDEX `tf_bookings_fi_30729d` (`room_id`),
    INDEX `fi_king_status_fk` (`status`),
    CONSTRAINT `booking_author_fk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_guest_fk`
        FOREIGN KEY (`guest_id`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_package_fk`
        FOREIGN KEY (`package_id`)
        REFERENCES `tf_packages` (`package_id`),
    CONSTRAINT `tf_bookings_fk_30729d`
        FOREIGN KEY (`room_id`)
        REFERENCES `tf_items` (`item_id`),
    CONSTRAINT `booking_status_fk`
        FOREIGN KEY (`status`)
        REFERENCES `tf_event_status` (`status_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_form
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_form`;

CREATE TABLE `tf_booking_form`
(
    `booking_form_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER NOT NULL,
    `form_id` INTEGER NOT NULL,
    `author_id` INTEGER,
    `entry_date` DATETIME,
    `edit_date` DATETIME,
    `completed_by` INTEGER,
    `completed_date` DATETIME,
    PRIMARY KEY (`booking_form_id`),
    INDEX `fi_king_booking_pk` (`booking_id`),
    INDEX `fi_king_form_form_pk` (`form_id`),
    INDEX `fi_king_form_author_pk` (`author_id`),
    INDEX `fi_king_form_cb_pk` (`completed_by`),
    CONSTRAINT `booking_booking_pk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `booking_form_form_pk`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`),
    CONSTRAINT `booking_form_author_pk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_form_cb_pk`
        FOREIGN KEY (`completed_by`)
        REFERENCES `tf_user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_form_entry
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_form_entry`;

CREATE TABLE `tf_booking_form_entry`
(
    `booking_form_id` INTEGER,
    `field_id` INTEGER NOT NULL,
    `field_value` VARCHAR(200),
    INDEX `tf_booking_form_entry_fi_782e8c` (`booking_form_id`),
    INDEX `tf_booking_form_entry_fi_0427a6` (`field_id`),
    CONSTRAINT `tf_booking_form_entry_fk_782e8c`
        FOREIGN KEY (`booking_form_id`)
        REFERENCES `tf_booking_form` (`booking_form_id`),
    CONSTRAINT `tf_booking_form_entry_fk_0427a6`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_field` (`field_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_categories`;

CREATE TABLE `tf_categories`
(
    `cat_id` INTEGER NOT NULL AUTO_INCREMENT,
    `cat_name` VARCHAR(255) NOT NULL,
    `cat_image` INTEGER,
    `cat_body` TEXT NOT NULL,
    `parent_id` INTEGER NOT NULL,
    `location_id` INTEGER NOT NULL,
    `cat_bg_color` VARCHAR(1) DEFAULT '',
    PRIMARY KEY (`cat_id`),
    INDEX `category_parent_fk` (`parent_id`),
    INDEX `category_location_fk` (`location_id`),
    INDEX `category_image_fk` (`cat_image`),
    CONSTRAINT `category_image_fk`
        FOREIGN KEY (`cat_image`)
        REFERENCES `tf_files` (`file_id`),
    CONSTRAINT `category_location_fk`
        FOREIGN KEY (`location_id`)
        REFERENCES `tf_locations` (`location_id`),
    CONSTRAINT `category_parent_fk`
        FOREIGN KEY (`parent_id`)
        REFERENCES `tf_categories` (`cat_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_contact_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_contact_status`;

CREATE TABLE `tf_contact_status`
(
    `status_cd` VARCHAR(20) NOT NULL,
    `status_value` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`status_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_contacts
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_contacts`;

CREATE TABLE `tf_contacts`
(
    `contact_id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `middle_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) DEFAULT '' NOT NULL,
    `title` VARCHAR(10),
    `date_joined` DATE,
    `avatar` VARCHAR(255) DEFAULT '' NOT NULL,
    `civil_status` VARCHAR(20) DEFAULT '' NOT NULL,
    `nationality` VARCHAR(100) DEFAULT '' NOT NULL,
    `country_dominicile` VARCHAR(3) DEFAULT 'PH' NOT NULL,
    `etnic_origin` VARCHAR(255) DEFAULT '' NOT NULL,
    `dob` DATE,
    `place_of_birth` VARCHAR(255) NOT NULL,
    `age` INTEGER(3) DEFAULT 0,
    `gender` VARCHAR(10) DEFAULT '' NOT NULL,
    `height` VARCHAR(10) DEFAULT '' NOT NULL,
    `weight` VARCHAR(10) DEFAULT '' NOT NULL,
    `phone` VARCHAR(50) DEFAULT '',
    `position_cd` VARCHAR(50),
    `nickname` VARCHAR(50) DEFAULT '',
    `bio` TEXT NOT NULL,
    PRIMARY KEY (`contact_id`),
    INDEX `fi_ition_fk` (`position_cd`),
    CONSTRAINT `position_fk`
        FOREIGN KEY (`position_cd`)
        REFERENCES `tf_position` (`position_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_event_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_event_status`;

CREATE TABLE `tf_event_status`
(
    `status_cd` VARCHAR(20) NOT NULL,
    `status_value` VARCHAR(50) NOT NULL,
    `status_order` SMALLINT(3),
    `status_style` VARCHAR(200),
    `include_in_sales` VARCHAR(1),
    `include_in_duplicate_checking` VARCHAR(1),
    PRIMARY KEY (`status_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_email_instance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_email_instance`;

CREATE TABLE `tf_email_instance`
(
    `email_instance_id` INTEGER NOT NULL AUTO_INCREMENT,
    `email_subject` VARCHAR(100) NOT NULL,
    `email_body` TEXT,
    `from_email_address` VARCHAR(100) NOT NULL,
    `to_email_address` VARCHAR(100) NOT NULL,
    `email_status_cd` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`email_instance_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_facilities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_facilities`;

CREATE TABLE `tf_facilities`
(
    `facility_id` INTEGER NOT NULL AUTO_INCREMENT,
    `facility_name` VARCHAR(255) NOT NULL,
    `bg_color` VARCHAR(7) NOT NULL,
    `max_accomodation` INTEGER(5) NOT NULL,
    `location_id` INTEGER,
    `abbr` VARCHAR(16) DEFAULT '' NOT NULL,
    `status` SMALLINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`facility_id`),
    INDEX `location_fk1` (`location_id`),
    CONSTRAINT `location_fk1`
        FOREIGN KEY (`location_id`)
        REFERENCES `tf_locations` (`location_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_field
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_field`;

CREATE TABLE `tf_field`
(
    `field_id` INTEGER NOT NULL AUTO_INCREMENT,
    `field_name` VARCHAR(100) NOT NULL,
    `field_label` VARCHAR(255) NOT NULL,
    `field_type` VARCHAR(32) NOT NULL,
    `field_options` TEXT NOT NULL,
    `required` CHAR NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`field_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_files
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_files`;

CREATE TABLE `tf_files`
(
    `file_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_size` INTEGER NOT NULL,
    `upload_id` INTEGER(5) NOT NULL,
    `upload_date` INTEGER(10) NOT NULL,
    `location_id` int(5) unsigned NOT NULL,
    `last_viewed` int(10) unsigned,
    `viewed_by` int(5) unsigned,
    PRIMARY KEY (`file_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_form_field
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_field`;

CREATE TABLE `tf_form_field`
(
    `field_id` INTEGER DEFAULT 0 NOT NULL,
    `form_id` INTEGER DEFAULT 0 NOT NULL,
    `form_field_order` INTEGER DEFAULT 0,
    PRIMARY KEY (`field_id`,`form_id`),
    INDEX `tf_form_field_fi_8ba9c8` (`form_id`),
    CONSTRAINT `tf_form_field_fk_0427a6`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_field` (`field_id`),
    CONSTRAINT `tf_form_field_fk_8ba9c8`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_forms
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_forms`;

CREATE TABLE `tf_forms`
(
    `form_id` INTEGER NOT NULL AUTO_INCREMENT,
    `form_name` VARCHAR(255) NOT NULL,
    `form_html` TEXT NOT NULL,
    `field_ids` TEXT NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`form_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_groups`;

CREATE TABLE `tf_groups`
(
    `group_id` INTEGER NOT NULL AUTO_INCREMENT,
    `group_cd` VARCHAR(40) NOT NULL,
    `group_name` VARCHAR(100) NOT NULL,
    `default_calendar_view` VARCHAR(50),
    `include_in_provider_list` VARCHAR(1) DEFAULT 'n',
    `can_view_other_profiles` VARCHAR(1) DEFAULT 'n',
    `can_edit_other_profiles` VARCHAR(1) DEFAULT 'n',
    `can_delete_services` VARCHAR(1) DEFAULT 'n',
    `can_edit_services` VARCHAR(1) DEFAULT 'n',
    `can_add_schedule` VARCHAR(1) DEFAULT 'y',
    `can_admin_guest` VARCHAR(1) DEFAULT 'n',
    `can_admin_calendar` VARCHAR(1) DEFAULT 'n',
    `can_admin_providers` VARCHAR(1) DEFAULT 'n',
    `can_admin_services` VARCHAR(1) DEFAULT 'n',
    `can_admin_facilities` VARCHAR(1) DEFAULT 'n',
    `can_admin_activities` VARCHAR(1) DEFAULT 'n',
    `can_admin_packages` VARCHAR(1) DEFAULT 'n',
    `can_admin_reports` VARCHAR(1) DEFAULT 'n',
    `location` VARCHAR(16) DEFAULT '' NOT NULL,
    `forms` VARCHAR(64) NOT NULL,
    `can_view_schedules_1` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_1` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_2` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_2` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_3` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_3` VARCHAR(1) DEFAULT 'n',
    `include_in_audit_list` VARCHAR(1) DEFAULT 'n',
    `can_edit_completed_forms` VARCHAR(1) DEFAULT 'n',
    `can_assign_schedules` VARCHAR(1) DEFAULT 'n',
    `can_view_other_schedule` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_4` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_4` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_5` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_5` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_6` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_6` VARCHAR(1) DEFAULT 'n',
    `can_view_schedules_7` VARCHAR(1) DEFAULT 'n',
    `can_edit_schedules_7` VARCHAR(1) DEFAULT 'n',
    `can_view_dashboard` VARCHAR(1) DEFAULT 'n',
    `notify_on_bookings` VARCHAR(1) DEFAULT 'n',
    `can_manage_guest_bookings` VARCHAR(1) DEFAULT 'n',
    `can_manage_guest_forms` VARCHAR(1) DEFAULT 'n',
    `can_view_financial` VARCHAR(1) DEFAULT 'n',
    `can_view_today_bookings` VARCHAR(1) DEFAULT 'n',
    `dashboard_top` VARCHAR(255) NOT NULL,
    `dashboard_middle` VARCHAR(255) NOT NULL,
    `dashboard_bottom` VARCHAR(255) NOT NULL,
    `calendar_header_right` VARCHAR(255) NOT NULL,
    `can_manage_guest_settings` VARCHAR(1) DEFAULT 'n',
    PRIMARY KEY (`group_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_item_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_item_categories`;

CREATE TABLE `tf_item_categories`
(
    `item_id` INTEGER NOT NULL,
    `category_id` INTEGER NOT NULL,
    PRIMARY KEY (`item_id`,`category_id`),
    INDEX `item_category_item_fk` (`item_id`),
    INDEX `fi_m_category_category_fk` (`category_id`),
    CONSTRAINT `item_category_category_fk`
        FOREIGN KEY (`category_id`)
        REFERENCES `tf_categories` (`cat_id`),
    CONSTRAINT `item_category_item_fk`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_item_day_time_settings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_item_day_time_settings`;

CREATE TABLE `tf_item_day_time_settings`
(
    `item_id` INTEGER NOT NULL,
    `day_settings` VARCHAR(50),
    `time_settings` VARCHAR(50)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items`;

CREATE TABLE `tf_items`
(
    `item_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `duration` int(5) unsigned NOT NULL,
    `amount` int(5) unsigned NOT NULL,
    `uom` VARCHAR(10) NOT NULL,
    `abbr` VARCHAR(16),
    `max_provider` INTEGER(3) DEFAULT 1,
    `for_sale` VARCHAR(1) DEFAULT 'y' NOT NULL,
    `item_image` INTEGER,
    `bookable` VARCHAR(1) DEFAULT 'y' NOT NULL,
    `time_settings` VARCHAR(100) NOT NULL,
    `is_active` INTEGER(1) DEFAULT 1 NOT NULL,
    `item_icon` VARCHAR(50),
    PRIMARY KEY (`item_id`),
    INDEX `item_image_fk` (`item_image`),
    CONSTRAINT `item_image_fk`
        FOREIGN KEY (`item_image`)
        REFERENCES `tf_files` (`file_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items_related_facilities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items_related_facilities`;

CREATE TABLE `tf_items_related_facilities`
(
    `item_id` INTEGER NOT NULL,
    `facility_id` INTEGER NOT NULL,
    PRIMARY KEY (`item_id`,`facility_id`),
    INDEX `tf_items_related_facilities_fi_1eba8a` (`facility_id`),
    CONSTRAINT `tf_items_related_facilities_fk_1eba8a`
        FOREIGN KEY (`facility_id`)
        REFERENCES `tf_facilities` (`facility_id`),
    CONSTRAINT `tf_items_related_facilities_fk_b49f13`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items_related_forms
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items_related_forms`;

CREATE TABLE `tf_items_related_forms`
(
    `form_id` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    PRIMARY KEY (`form_id`,`item_id`),
    INDEX `tf_items_related_forms_fi_b49f13` (`item_id`),
    CONSTRAINT `tf_items_related_forms_fk_8ba9c8`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`),
    CONSTRAINT `tf_items_related_forms_fk_b49f13`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items_related_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items_related_users`;

CREATE TABLE `tf_items_related_users`
(
    `item_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`item_id`,`user_id`),
    INDEX `tf_items_related_users_fi_e09fae` (`user_id`),
    CONSTRAINT `tf_items_related_users_fk_e09fae`
        FOREIGN KEY (`user_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `tf_items_related_users_fk_b49f13`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_locations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_locations`;

CREATE TABLE `tf_locations`
(
    `location_id` INTEGER NOT NULL AUTO_INCREMENT,
    `location` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`location_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_messages`;

CREATE TABLE `tf_messages`
(
    `message_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `message` VARCHAR(255) NOT NULL,
    `sender` INTEGER(5) NOT NULL,
    `receiver` INTEGER(5) NOT NULL,
    `date_sent` DATETIME NOT NULL,
    `date_read` DATETIME NOT NULL,
    `message_type` VARCHAR(16) NOT NULL,
    `received` SMALLINT(1) DEFAULT 0 NOT NULL,
    `receiver_email` VARCHAR(255),
    `subject` VARCHAR(255),
    PRIMARY KEY (`message_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_package_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_package_items`;

CREATE TABLE `tf_package_items`
(
    `package_id` INTEGER DEFAULT 0 NOT NULL,
    `item_id` INTEGER DEFAULT 0 NOT NULL,
    `quantity` int(5) unsigned NOT NULL,
    PRIMARY KEY (`package_id`,`item_id`),
    INDEX `package_item_item_fk` (`item_id`),
    CONSTRAINT `package_item_item_fk`
        FOREIGN KEY (`item_id`)
        REFERENCES `tf_items` (`item_id`),
    CONSTRAINT `package_item_package_fk`
        FOREIGN KEY (`package_id`)
        REFERENCES `tf_packages` (`package_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_package_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_package_types`;

CREATE TABLE `tf_package_types`
(
    `package_type_id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `package_type_name` VARCHAR(200),
    `description` TEXT,
    `package_image` INTEGER(5),
    PRIMARY KEY (`package_type_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_packages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_packages`;

CREATE TABLE `tf_packages`
(
    `package_id` INTEGER NOT NULL AUTO_INCREMENT,
    `package_name` VARCHAR(255) NOT NULL,
    `package_type` VARCHAR(255) NOT NULL,
    `duration` SMALLINT(3) NOT NULL,
    `package_type_id` INTEGER(5) NOT NULL,
    `personalized` SMALLINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`package_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_position
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_position`;

CREATE TABLE `tf_position`
(
    `position_cd` VARCHAR(50) DEFAULT '' NOT NULL,
    `position_value` VARCHAR(50),
    `position_order` INTEGER(3),
    PRIMARY KEY (`position_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_sites
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_sites`;

CREATE TABLE `tf_sites`
(
    `site_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `site_title` VARCHAR(255) NOT NULL,
    `site_system_preferences` TEXT NOT NULL,
    PRIMARY KEY (`site_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_status_groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_status_groups`;

CREATE TABLE `tf_status_groups`
(
    `group_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_cd` VARCHAR(40) NOT NULL,
    `group_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`group_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_statuses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_statuses`;

CREATE TABLE `tf_statuses`
(
    `status_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_id` INTEGER(5) NOT NULL,
    `status_cd` VARCHAR(40) NOT NULL,
    `status_name` VARCHAR(255) NOT NULL,
    `status_order` INTEGER(2) NOT NULL,
    `status_style` TEXT,
    `include_in_sales` VARCHAR(1) DEFAULT 'y',
    `include_in_duplicate_checking` VARCHAR(1) DEFAULT 'y',
    PRIMARY KEY (`status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_title
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_title`;

CREATE TABLE `tf_title`
(
    `title_cd` VARCHAR(20) NOT NULL,
    `title_value` VARCHAR(50),
    PRIMARY KEY (`title_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_upload_prefs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_upload_prefs`;

CREATE TABLE `tf_upload_prefs`
(
    `upload_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `max_size` INTEGER NOT NULL,
    `max_height` INTEGER NOT NULL,
    `max_width` INTEGER NOT NULL,
    `upload_path` VARCHAR(255) NOT NULL,
    `allowed_types` VARCHAR(100) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    `location_id` int(5) unsigned NOT NULL,
    PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_work_plan
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_work_plan`;

CREATE TABLE `tf_work_plan`
(
    `work_plan_cd` VARCHAR(32) NOT NULL,
    `work_plan_name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`work_plan_cd`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_user_work_plan_day
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user_work_plan_day`;

CREATE TABLE `tf_user_work_plan_day`
(
    `user_id` INTEGER NOT NULL,
    `date` DATE NOT NULL,
    `work_plan_cd` VARCHAR(32) NOT NULL,
    UNIQUE INDEX `user_id` (`user_id`, `date`),
    INDEX `user_fk1` (`user_id`),
    INDEX `tf_user_work_plan_day_fi_a9b2fd` (`work_plan_cd`),
    CONSTRAINT `tf_user_work_plan_day_fk_a9b2fd`
        FOREIGN KEY (`work_plan_cd`)
        REFERENCES `tf_work_plan` (`work_plan_cd`),
    CONSTRAINT `tf_user_work_plan_day_fk_e09fae`
        FOREIGN KEY (`user_id`)
        REFERENCES `tf_user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_user_work_plan_time
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user_work_plan_time`;

CREATE TABLE `tf_user_work_plan_time`
(
    `user_id` INTEGER NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `is_working` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`user_id`,`start_date`,`end_date`),
    CONSTRAINT `tf_user_work_plan_time_fk_e09fae`
        FOREIGN KEY (`user_id`)
        REFERENCES `tf_user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user`;

CREATE TABLE `tf_user`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `group_id` INTEGER,
    `last_login` INTEGER(10) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `work_plan` TEXT NOT NULL,
    `work_plan_code` TEXT,
    `location_id` INTEGER,
    `facebook_id` VARCHAR(50) NOT NULL,
    `user_order` INTEGER(5) DEFAULT 0 NOT NULL,
    `is_active` TINYINT(1) NOT NULL,
    `verification_key` VARCHAR(255) DEFAULT '',
    `is_verified` TINYINT(1) DEFAULT 0,
    `is_approved` TINYINT(1) DEFAULT 0,
    `activation_code` INTEGER,
    `calendar_view_positions` VARCHAR(100) DEFAULT '',
    `calendar_view_status` VARCHAR(255),
    `calendar_show_my_schedule_only` VARCHAR(1) DEFAULT 'y',
    `calendar_view_locations` VARCHAR(100) DEFAULT '',
    `preferences` TEXT,
    `calendar_show_no_schedule` VARCHAR(1) DEFAULT 'y',
    PRIMARY KEY (`user_id`),
    INDEX `location_fk` (`location_id`),
    INDEX `group_fk` (`group_id`),
    CONSTRAINT `group_fk`
        FOREIGN KEY (`group_id`)
        REFERENCES `tf_groups` (`group_id`),
    CONSTRAINT `location_fk`
        FOREIGN KEY (`location_id`)
        REFERENCES `tf_locations` (`location_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
