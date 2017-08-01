
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
-- tf_booking_event_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_event_users`;

CREATE TABLE `tf_booking_event_users`
(
    `event_id` INTEGER DEFAULT 0 NOT NULL,
    `staff_id` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`event_id`,`staff_id`),
    INDEX `booking_event_user_user_fk` (`staff_id`),
    CONSTRAINT `booking_event_user_event_fk`
        FOREIGN KEY (`event_id`)
        REFERENCES `tf_booking_events` (`event_id`),
    CONSTRAINT `booking_event_user_user_fk`
        FOREIGN KEY (`staff_id`)
        REFERENCES `tf_contacts` (`contact_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_booking_events
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_events`;

CREATE TABLE `tf_booking_events`
(
    `event_id` INTEGER NOT NULL AUTO_INCREMENT,
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
    `booking_item_id` INTEGER,
    `is_active` VARCHAR(1) DEFAULT 'n',
    `deleted_date` INTEGER(10) DEFAULT 0,
    `deleted_by` INTEGER,
    `item_id` INTEGER,
    `is_kids` VARCHAR(1) DEFAULT 'n',
    `incl_os_done_number` VARCHAR(20),
    `incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL,
    `foc_os_done_number` VARCHAR(20),
    `foc_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL,
    `not_incl_os_done_number` VARCHAR(20),
    `not_incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL,
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
    INDEX `booking_event_booking_item_by_fk` (`booking_item_id`),
    INDEX `booking_event_status_fk` (`status`),
    CONSTRAINT `booking_event_author_fk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_event_booking_item_by_fk`
        FOREIGN KEY (`booking_item_id`)
        REFERENCES `tf_booking_items` (`booking_item_id`),
    CONSTRAINT `booking_event_called_by_fk`
        FOREIGN KEY (`called_by`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_event_cancelled_by_fk`
        FOREIGN KEY (`cancelled_by`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_event_deleted_by_fk`
        FOREIGN KEY (`deleted_by`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_event_facility_fk`
        FOREIGN KEY (`facility_id`)
        REFERENCES `tf_facilities` (`facility_id`),
    CONSTRAINT `booking_event_item_by_fk`
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
    `booking_id` INTEGER(5) NOT NULL,
    `form_id` INTEGER(5) NOT NULL,
    `required` VARCHAR(1) DEFAULT 'n' NOT NULL,
    `submitted` VARCHAR(1) DEFAULT 'n' NOT NULL,
    `notify_user_on_submit` VARCHAR(255) DEFAULT '' NOT NULL,
    `submitted_date` INTEGER(10) DEFAULT 0,
    `completed_by` INTEGER,
    `completed_date` int(10) unsigned DEFAULT 0,
    PRIMARY KEY (`booking_id`,`form_id`),
    INDEX `booking_form_completed_fk` (`completed_by`),
    INDEX `booking_form_fk` (`form_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_booking_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_booking_items`;

CREATE TABLE `tf_booking_items`
(
    `booking_item_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    `quantity` INTEGER(5) NOT NULL,
    `included` INTEGER(1) NOT NULL,
    `foc` INTEGER(1) DEFAULT 0 NOT NULL,
    `upsell` INTEGER(1) DEFAULT 0 NOT NULL,
    `inventory` INTEGER(5) DEFAULT 0,
    `upgrade` SMALLINT(1) DEFAULT 0,
    PRIMARY KEY (`booking_item_id`),
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
    INDEX `booking_package_fk` (`package_id`),
    INDEX `booking_guest_fk` (`guest_id`),
    INDEX `booking_author_fk` (`author_id`),
    INDEX `booking_room_fk` (`room_id`),
    INDEX `booking_status_fk` (`status`),
    CONSTRAINT `booking_author_fk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_guest_fk`
        FOREIGN KEY (`guest_id`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `booking_package_fk`
        FOREIGN KEY (`package_id`)
        REFERENCES `tf_packages` (`package_id`),
    CONSTRAINT `booking_room_fk`
        FOREIGN KEY (`room_id`)
        REFERENCES `tf_items` (`item_id`),
    CONSTRAINT `booking_status_fk`
        FOREIGN KEY (`status`)
        REFERENCES `tf_event_status` (`status_cd`)
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
    `is_active` TINYINT(1) NOT NULL,
    `verification_key` VARCHAR(255) DEFAULT '',
    `verified` VARCHAR(1) DEFAULT 'n' NOT NULL,
    `nickname` VARCHAR(50) DEFAULT '',
    `bio` TEXT NOT NULL,
    `approved` VARCHAR(1) DEFAULT 'y' NOT NULL,
    `activation_code` INTEGER,
    `active` VARCHAR(1) DEFAULT 'n' NOT NULL,
    PRIMARY KEY (`contact_id`),
    INDEX `position_fk` (`position_cd`),
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
-- tf_fields
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_fields`;

CREATE TABLE `tf_fields`
(
    `field_id` INTEGER NOT NULL AUTO_INCREMENT,
    `field_name` VARCHAR(100) NOT NULL,
    `field_label` VARCHAR(255) NOT NULL,
    `field_type` VARCHAR(32) NOT NULL,
    `settings` TEXT NOT NULL,
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
-- tf_form_entries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries`;

CREATE TABLE `tf_form_entries`
(
    `entry_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER,
    `form_id` INTEGER NOT NULL,
    `field_id` INTEGER NOT NULL,
    `field_text_value` VARCHAR(100),
    `field_dropdown_value` VARCHAR(100),
    `field_checkboxes_value` VARCHAR(100),
    PRIMARY KEY (`entry_id`),
    INDEX `form_entries_booking_fk` (`booking_id`),
    INDEX `form_entries_form_fk` (`form_id`),
    INDEX `form_entries_field_fk` (`field_id`),
    CONSTRAINT `form_entries_booking_fk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `form_entries_field_fk`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_fields` (`field_id`),
    CONSTRAINT `form_entries_form_fk`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_form_entries_1
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_1`;

CREATE TABLE `tf_form_entries_1`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_29` TEXT,
    `field_id_52` TEXT,
    `field_id_54` TEXT,
    `field_id_53` TEXT,
    `field_id_55` TEXT,
    `field_id_58` TEXT,
    `field_id_57` TEXT,
    `field_id_56` TEXT,
    `field_id_51` TEXT,
    `field_id_50` TEXT,
    `field_id_49` TEXT,
    `field_id_48` TEXT,
    `field_id_47` TEXT,
    `field_id_46` TEXT,
    `field_id_45` TEXT,
    `field_id_44` TEXT,
    `field_id_43` TEXT,
    `field_id_42` TEXT,
    `field_id_41` TEXT,
    `field_id_40` TEXT,
    `field_id_37` TEXT,
    `field_id_35` TEXT,
    `field_id_33` TEXT,
    `field_id_32` TEXT,
    `field_id_31` TEXT,
    `field_id_30` TEXT,
    `field_id_28` TEXT,
    `field_id_26` TEXT,
    `field_id_25` TEXT,
    `field_id_19` TEXT,
    `field_id_18` TEXT,
    `field_id_17` TEXT,
    `field_id_6` TEXT,
    `field_id_5` TEXT,
    `field_id_4` TEXT,
    `field_id_2` TEXT,
    `field_id_1` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_2
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_2`;

CREATE TABLE `tf_form_entries_2`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_3
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_3`;

CREATE TABLE `tf_form_entries_3`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_5
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_5`;

CREATE TABLE `tf_form_entries_5`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_6
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_6`;

CREATE TABLE `tf_form_entries_6`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_18` TEXT,
    `field_id_17` TEXT,
    `field_id_5` TEXT,
    `field_id_4` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_8
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_8`;

CREATE TABLE `tf_form_entries_8`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_196` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` INTEGER(5) NOT NULL,
    `completed_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_entries_9
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_entries_9`;

CREATE TABLE `tf_form_entries_9`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_197` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` INTEGER(5) NOT NULL,
    `completed_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_form_fields
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_form_fields`;

CREATE TABLE `tf_form_fields`
(
    `field_id` INTEGER DEFAULT 0 NOT NULL,
    `form_id` INTEGER DEFAULT 0 NOT NULL,
    `guest_only` CHAR NOT NULL,
    PRIMARY KEY (`field_id`,`form_id`)
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
    PRIMARY KEY (`item_id`,`facility_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items_related_forms
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items_related_forms`;

CREATE TABLE `tf_items_related_forms`
(
    `form_id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `item_id` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`form_id`,`item_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tf_items_related_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_items_related_users`;

CREATE TABLE `tf_items_related_users`
(
    `item_id` INTEGER NOT NULL,
    `contact_id` INTEGER NOT NULL,
    INDEX `contact_fk1` (`contact_id`),
    CONSTRAINT `contact_fk1`
        FOREIGN KEY (`contact_id`)
        REFERENCES `tf_contacts` (`contact_id`)
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
-- tf_migrations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_migrations`;

CREATE TABLE `tf_migrations`
(
    `version` BIGINT NOT NULL
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
-- tf_sessions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_sessions`;

CREATE TABLE `tf_sessions`
(
    `id` VARCHAR(40) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` BLOB NOT NULL,
    INDEX `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM;

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
-- tf_user_work_plan_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user_work_plan_code`;

CREATE TABLE `tf_user_work_plan_code`
(
    `work_plan_cd` VARCHAR(32) NOT NULL,
    `work_plan_name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`work_plan_cd`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_user_work_plan_day
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user_work_plan_day`;

CREATE TABLE `tf_user_work_plan_day`
(
    `contact_id` INTEGER(5) NOT NULL,
    `date` DATE NOT NULL,
    `work_code` VARCHAR(16) NOT NULL,
    UNIQUE INDEX `contact_id` (`contact_id`, `date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_user_work_plan_time
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_user_work_plan_time`;

CREATE TABLE `tf_user_work_plan_time`
(
    `contact_id` INTEGER(5) NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tf_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tf_users`;

CREATE TABLE `tf_users`
(
    `contact_id` INTEGER DEFAULT 0 NOT NULL,
    `username` VARCHAR(100) NOT NULL,
    `group_id` INTEGER,
    `last_login` INTEGER(10) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `work_plan` TEXT NOT NULL,
    `work_plan_code` TEXT,
    `location_id` INTEGER,
    `facebook_id` VARCHAR(50) NOT NULL,
    `user_order` INTEGER(5) DEFAULT 0 NOT NULL,
    `calendar_view_positions` VARCHAR(100) DEFAULT '',
    `calendar_view_status` VARCHAR(255),
    `calendar_show_my_schedule_only` VARCHAR(1) DEFAULT 'y',
    `calendar_view_locations` VARCHAR(100) DEFAULT '',
    `preferences` TEXT,
    `calendar_show_no_schedule` VARCHAR(1) DEFAULT 'y',
    PRIMARY KEY (`contact_id`),
    INDEX `location_fk` (`location_id`),
    INDEX `group_fk` (`group_id`),
    CONSTRAINT `contact_fk`
        FOREIGN KEY (`contact_id`)
        REFERENCES `tf_contacts` (`contact_id`),
    CONSTRAINT `group_fk`
        FOREIGN KEY (`group_id`)
        REFERENCES `tf_groups` (`group_id`),
    CONSTRAINT `location_fk`
        FOREIGN KEY (`location_id`)
        REFERENCES `tf_locations` (`location_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
