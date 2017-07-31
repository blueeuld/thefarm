<?php

namespace TheFarm\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use TheFarm\Models\Groups;
use TheFarm\Models\GroupsQuery;


/**
 * This class defines the structure of the 'tf_groups' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class GroupsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.GroupsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_groups';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Groups';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Groups';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 49;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 49;

    /**
     * the column name for the group_id field
     */
    const COL_GROUP_ID = 'tf_groups.group_id';

    /**
     * the column name for the group_cd field
     */
    const COL_GROUP_CD = 'tf_groups.group_cd';

    /**
     * the column name for the group_name field
     */
    const COL_GROUP_NAME = 'tf_groups.group_name';

    /**
     * the column name for the default_calendar_view field
     */
    const COL_DEFAULT_CALENDAR_VIEW = 'tf_groups.default_calendar_view';

    /**
     * the column name for the include_in_provider_list field
     */
    const COL_INCLUDE_IN_PROVIDER_LIST = 'tf_groups.include_in_provider_list';

    /**
     * the column name for the can_view_other_profiles field
     */
    const COL_CAN_VIEW_OTHER_PROFILES = 'tf_groups.can_view_other_profiles';

    /**
     * the column name for the can_edit_other_profiles field
     */
    const COL_CAN_EDIT_OTHER_PROFILES = 'tf_groups.can_edit_other_profiles';

    /**
     * the column name for the can_delete_services field
     */
    const COL_CAN_DELETE_SERVICES = 'tf_groups.can_delete_services';

    /**
     * the column name for the can_edit_services field
     */
    const COL_CAN_EDIT_SERVICES = 'tf_groups.can_edit_services';

    /**
     * the column name for the can_add_schedule field
     */
    const COL_CAN_ADD_SCHEDULE = 'tf_groups.can_add_schedule';

    /**
     * the column name for the can_admin_guest field
     */
    const COL_CAN_ADMIN_GUEST = 'tf_groups.can_admin_guest';

    /**
     * the column name for the can_admin_calendar field
     */
    const COL_CAN_ADMIN_CALENDAR = 'tf_groups.can_admin_calendar';

    /**
     * the column name for the can_admin_providers field
     */
    const COL_CAN_ADMIN_PROVIDERS = 'tf_groups.can_admin_providers';

    /**
     * the column name for the can_admin_services field
     */
    const COL_CAN_ADMIN_SERVICES = 'tf_groups.can_admin_services';

    /**
     * the column name for the can_admin_facilities field
     */
    const COL_CAN_ADMIN_FACILITIES = 'tf_groups.can_admin_facilities';

    /**
     * the column name for the can_admin_activities field
     */
    const COL_CAN_ADMIN_ACTIVITIES = 'tf_groups.can_admin_activities';

    /**
     * the column name for the can_admin_packages field
     */
    const COL_CAN_ADMIN_PACKAGES = 'tf_groups.can_admin_packages';

    /**
     * the column name for the can_admin_reports field
     */
    const COL_CAN_ADMIN_REPORTS = 'tf_groups.can_admin_reports';

    /**
     * the column name for the location field
     */
    const COL_LOCATION = 'tf_groups.location';

    /**
     * the column name for the forms field
     */
    const COL_FORMS = 'tf_groups.forms';

    /**
     * the column name for the can_view_schedules_1 field
     */
    const COL_CAN_VIEW_SCHEDULES_1 = 'tf_groups.can_view_schedules_1';

    /**
     * the column name for the can_edit_schedules_1 field
     */
    const COL_CAN_EDIT_SCHEDULES_1 = 'tf_groups.can_edit_schedules_1';

    /**
     * the column name for the can_view_schedules_2 field
     */
    const COL_CAN_VIEW_SCHEDULES_2 = 'tf_groups.can_view_schedules_2';

    /**
     * the column name for the can_edit_schedules_2 field
     */
    const COL_CAN_EDIT_SCHEDULES_2 = 'tf_groups.can_edit_schedules_2';

    /**
     * the column name for the can_view_schedules_3 field
     */
    const COL_CAN_VIEW_SCHEDULES_3 = 'tf_groups.can_view_schedules_3';

    /**
     * the column name for the can_edit_schedules_3 field
     */
    const COL_CAN_EDIT_SCHEDULES_3 = 'tf_groups.can_edit_schedules_3';

    /**
     * the column name for the include_in_audit_list field
     */
    const COL_INCLUDE_IN_AUDIT_LIST = 'tf_groups.include_in_audit_list';

    /**
     * the column name for the can_edit_completed_forms field
     */
    const COL_CAN_EDIT_COMPLETED_FORMS = 'tf_groups.can_edit_completed_forms';

    /**
     * the column name for the can_assign_schedules field
     */
    const COL_CAN_ASSIGN_SCHEDULES = 'tf_groups.can_assign_schedules';

    /**
     * the column name for the can_view_other_schedule field
     */
    const COL_CAN_VIEW_OTHER_SCHEDULE = 'tf_groups.can_view_other_schedule';

    /**
     * the column name for the can_view_schedules_4 field
     */
    const COL_CAN_VIEW_SCHEDULES_4 = 'tf_groups.can_view_schedules_4';

    /**
     * the column name for the can_edit_schedules_4 field
     */
    const COL_CAN_EDIT_SCHEDULES_4 = 'tf_groups.can_edit_schedules_4';

    /**
     * the column name for the can_view_schedules_5 field
     */
    const COL_CAN_VIEW_SCHEDULES_5 = 'tf_groups.can_view_schedules_5';

    /**
     * the column name for the can_edit_schedules_5 field
     */
    const COL_CAN_EDIT_SCHEDULES_5 = 'tf_groups.can_edit_schedules_5';

    /**
     * the column name for the can_view_schedules_6 field
     */
    const COL_CAN_VIEW_SCHEDULES_6 = 'tf_groups.can_view_schedules_6';

    /**
     * the column name for the can_edit_schedules_6 field
     */
    const COL_CAN_EDIT_SCHEDULES_6 = 'tf_groups.can_edit_schedules_6';

    /**
     * the column name for the can_view_schedules_7 field
     */
    const COL_CAN_VIEW_SCHEDULES_7 = 'tf_groups.can_view_schedules_7';

    /**
     * the column name for the can_edit_schedules_7 field
     */
    const COL_CAN_EDIT_SCHEDULES_7 = 'tf_groups.can_edit_schedules_7';

    /**
     * the column name for the can_view_dashboard field
     */
    const COL_CAN_VIEW_DASHBOARD = 'tf_groups.can_view_dashboard';

    /**
     * the column name for the notify_on_bookings field
     */
    const COL_NOTIFY_ON_BOOKINGS = 'tf_groups.notify_on_bookings';

    /**
     * the column name for the can_manage_guest_bookings field
     */
    const COL_CAN_MANAGE_GUEST_BOOKINGS = 'tf_groups.can_manage_guest_bookings';

    /**
     * the column name for the can_manage_guest_forms field
     */
    const COL_CAN_MANAGE_GUEST_FORMS = 'tf_groups.can_manage_guest_forms';

    /**
     * the column name for the can_view_financial field
     */
    const COL_CAN_VIEW_FINANCIAL = 'tf_groups.can_view_financial';

    /**
     * the column name for the can_view_today_bookings field
     */
    const COL_CAN_VIEW_TODAY_BOOKINGS = 'tf_groups.can_view_today_bookings';

    /**
     * the column name for the dashboard_top field
     */
    const COL_DASHBOARD_TOP = 'tf_groups.dashboard_top';

    /**
     * the column name for the dashboard_middle field
     */
    const COL_DASHBOARD_MIDDLE = 'tf_groups.dashboard_middle';

    /**
     * the column name for the dashboard_bottom field
     */
    const COL_DASHBOARD_BOTTOM = 'tf_groups.dashboard_bottom';

    /**
     * the column name for the calendar_header_right field
     */
    const COL_CALENDAR_HEADER_RIGHT = 'tf_groups.calendar_header_right';

    /**
     * the column name for the can_manage_guest_settings field
     */
    const COL_CAN_MANAGE_GUEST_SETTINGS = 'tf_groups.can_manage_guest_settings';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('GroupId', 'GroupCd', 'GroupName', 'DefaultCalendarView', 'IncludeInProviderList', 'CanViewOtherProfiles', 'CanEditOtherProfiles', 'CanDeleteServices', 'CanEditServices', 'CanAddSchedule', 'CanAdminGuest', 'CanAdminCalendar', 'CanAdminProviders', 'CanAdminServices', 'CanAdminFacilities', 'CanAdminActivities', 'CanAdminPackages', 'CanAdminReports', 'Location', 'Forms', 'CanViewSchedules1', 'CanEditSchedules1', 'CanViewSchedules2', 'CanEditSchedules2', 'CanViewSchedules3', 'CanEditSchedules3', 'IncludeInAuditList', 'CanEditCompletedForms', 'CanAssignSchedules', 'CanViewOtherSchedule', 'CanViewSchedules4', 'CanEditSchedules4', 'CanViewSchedules5', 'CanEditSchedules5', 'CanViewSchedules6', 'CanEditSchedules6', 'CanViewSchedules7', 'CanEditSchedules7', 'CanViewDashboard', 'NotifyOnBookings', 'CanManageGuestBookings', 'CanManageGuestForms', 'CanViewFinancial', 'CanViewTodayBookings', 'DashboardTop', 'DashboardMiddle', 'DashboardBottom', 'CalendarHeaderRight', 'CanManageGuestSettings', ),
        self::TYPE_CAMELNAME     => array('groupId', 'groupCd', 'groupName', 'defaultCalendarView', 'includeInProviderList', 'canViewOtherProfiles', 'canEditOtherProfiles', 'canDeleteServices', 'canEditServices', 'canAddSchedule', 'canAdminGuest', 'canAdminCalendar', 'canAdminProviders', 'canAdminServices', 'canAdminFacilities', 'canAdminActivities', 'canAdminPackages', 'canAdminReports', 'location', 'forms', 'canViewSchedules1', 'canEditSchedules1', 'canViewSchedules2', 'canEditSchedules2', 'canViewSchedules3', 'canEditSchedules3', 'includeInAuditList', 'canEditCompletedForms', 'canAssignSchedules', 'canViewOtherSchedule', 'canViewSchedules4', 'canEditSchedules4', 'canViewSchedules5', 'canEditSchedules5', 'canViewSchedules6', 'canEditSchedules6', 'canViewSchedules7', 'canEditSchedules7', 'canViewDashboard', 'notifyOnBookings', 'canManageGuestBookings', 'canManageGuestForms', 'canViewFinancial', 'canViewTodayBookings', 'dashboardTop', 'dashboardMiddle', 'dashboardBottom', 'calendarHeaderRight', 'canManageGuestSettings', ),
        self::TYPE_COLNAME       => array(GroupsTableMap::COL_GROUP_ID, GroupsTableMap::COL_GROUP_CD, GroupsTableMap::COL_GROUP_NAME, GroupsTableMap::COL_DEFAULT_CALENDAR_VIEW, GroupsTableMap::COL_INCLUDE_IN_PROVIDER_LIST, GroupsTableMap::COL_CAN_VIEW_OTHER_PROFILES, GroupsTableMap::COL_CAN_EDIT_OTHER_PROFILES, GroupsTableMap::COL_CAN_DELETE_SERVICES, GroupsTableMap::COL_CAN_EDIT_SERVICES, GroupsTableMap::COL_CAN_ADD_SCHEDULE, GroupsTableMap::COL_CAN_ADMIN_GUEST, GroupsTableMap::COL_CAN_ADMIN_CALENDAR, GroupsTableMap::COL_CAN_ADMIN_PROVIDERS, GroupsTableMap::COL_CAN_ADMIN_SERVICES, GroupsTableMap::COL_CAN_ADMIN_FACILITIES, GroupsTableMap::COL_CAN_ADMIN_ACTIVITIES, GroupsTableMap::COL_CAN_ADMIN_PACKAGES, GroupsTableMap::COL_CAN_ADMIN_REPORTS, GroupsTableMap::COL_LOCATION, GroupsTableMap::COL_FORMS, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_1, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_1, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_2, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_2, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_3, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_3, GroupsTableMap::COL_INCLUDE_IN_AUDIT_LIST, GroupsTableMap::COL_CAN_EDIT_COMPLETED_FORMS, GroupsTableMap::COL_CAN_ASSIGN_SCHEDULES, GroupsTableMap::COL_CAN_VIEW_OTHER_SCHEDULE, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_4, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_4, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_5, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_5, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_6, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_6, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_7, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_7, GroupsTableMap::COL_CAN_VIEW_DASHBOARD, GroupsTableMap::COL_NOTIFY_ON_BOOKINGS, GroupsTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS, GroupsTableMap::COL_CAN_MANAGE_GUEST_FORMS, GroupsTableMap::COL_CAN_VIEW_FINANCIAL, GroupsTableMap::COL_CAN_VIEW_TODAY_BOOKINGS, GroupsTableMap::COL_DASHBOARD_TOP, GroupsTableMap::COL_DASHBOARD_MIDDLE, GroupsTableMap::COL_DASHBOARD_BOTTOM, GroupsTableMap::COL_CALENDAR_HEADER_RIGHT, GroupsTableMap::COL_CAN_MANAGE_GUEST_SETTINGS, ),
        self::TYPE_FIELDNAME     => array('group_id', 'group_cd', 'group_name', 'default_calendar_view', 'include_in_provider_list', 'can_view_other_profiles', 'can_edit_other_profiles', 'can_delete_services', 'can_edit_services', 'can_add_schedule', 'can_admin_guest', 'can_admin_calendar', 'can_admin_providers', 'can_admin_services', 'can_admin_facilities', 'can_admin_activities', 'can_admin_packages', 'can_admin_reports', 'location', 'forms', 'can_view_schedules_1', 'can_edit_schedules_1', 'can_view_schedules_2', 'can_edit_schedules_2', 'can_view_schedules_3', 'can_edit_schedules_3', 'include_in_audit_list', 'can_edit_completed_forms', 'can_assign_schedules', 'can_view_other_schedule', 'can_view_schedules_4', 'can_edit_schedules_4', 'can_view_schedules_5', 'can_edit_schedules_5', 'can_view_schedules_6', 'can_edit_schedules_6', 'can_view_schedules_7', 'can_edit_schedules_7', 'can_view_dashboard', 'notify_on_bookings', 'can_manage_guest_bookings', 'can_manage_guest_forms', 'can_view_financial', 'can_view_today_bookings', 'dashboard_top', 'dashboard_middle', 'dashboard_bottom', 'calendar_header_right', 'can_manage_guest_settings', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('GroupId' => 0, 'GroupCd' => 1, 'GroupName' => 2, 'DefaultCalendarView' => 3, 'IncludeInProviderList' => 4, 'CanViewOtherProfiles' => 5, 'CanEditOtherProfiles' => 6, 'CanDeleteServices' => 7, 'CanEditServices' => 8, 'CanAddSchedule' => 9, 'CanAdminGuest' => 10, 'CanAdminCalendar' => 11, 'CanAdminProviders' => 12, 'CanAdminServices' => 13, 'CanAdminFacilities' => 14, 'CanAdminActivities' => 15, 'CanAdminPackages' => 16, 'CanAdminReports' => 17, 'Location' => 18, 'Forms' => 19, 'CanViewSchedules1' => 20, 'CanEditSchedules1' => 21, 'CanViewSchedules2' => 22, 'CanEditSchedules2' => 23, 'CanViewSchedules3' => 24, 'CanEditSchedules3' => 25, 'IncludeInAuditList' => 26, 'CanEditCompletedForms' => 27, 'CanAssignSchedules' => 28, 'CanViewOtherSchedule' => 29, 'CanViewSchedules4' => 30, 'CanEditSchedules4' => 31, 'CanViewSchedules5' => 32, 'CanEditSchedules5' => 33, 'CanViewSchedules6' => 34, 'CanEditSchedules6' => 35, 'CanViewSchedules7' => 36, 'CanEditSchedules7' => 37, 'CanViewDashboard' => 38, 'NotifyOnBookings' => 39, 'CanManageGuestBookings' => 40, 'CanManageGuestForms' => 41, 'CanViewFinancial' => 42, 'CanViewTodayBookings' => 43, 'DashboardTop' => 44, 'DashboardMiddle' => 45, 'DashboardBottom' => 46, 'CalendarHeaderRight' => 47, 'CanManageGuestSettings' => 48, ),
        self::TYPE_CAMELNAME     => array('groupId' => 0, 'groupCd' => 1, 'groupName' => 2, 'defaultCalendarView' => 3, 'includeInProviderList' => 4, 'canViewOtherProfiles' => 5, 'canEditOtherProfiles' => 6, 'canDeleteServices' => 7, 'canEditServices' => 8, 'canAddSchedule' => 9, 'canAdminGuest' => 10, 'canAdminCalendar' => 11, 'canAdminProviders' => 12, 'canAdminServices' => 13, 'canAdminFacilities' => 14, 'canAdminActivities' => 15, 'canAdminPackages' => 16, 'canAdminReports' => 17, 'location' => 18, 'forms' => 19, 'canViewSchedules1' => 20, 'canEditSchedules1' => 21, 'canViewSchedules2' => 22, 'canEditSchedules2' => 23, 'canViewSchedules3' => 24, 'canEditSchedules3' => 25, 'includeInAuditList' => 26, 'canEditCompletedForms' => 27, 'canAssignSchedules' => 28, 'canViewOtherSchedule' => 29, 'canViewSchedules4' => 30, 'canEditSchedules4' => 31, 'canViewSchedules5' => 32, 'canEditSchedules5' => 33, 'canViewSchedules6' => 34, 'canEditSchedules6' => 35, 'canViewSchedules7' => 36, 'canEditSchedules7' => 37, 'canViewDashboard' => 38, 'notifyOnBookings' => 39, 'canManageGuestBookings' => 40, 'canManageGuestForms' => 41, 'canViewFinancial' => 42, 'canViewTodayBookings' => 43, 'dashboardTop' => 44, 'dashboardMiddle' => 45, 'dashboardBottom' => 46, 'calendarHeaderRight' => 47, 'canManageGuestSettings' => 48, ),
        self::TYPE_COLNAME       => array(GroupsTableMap::COL_GROUP_ID => 0, GroupsTableMap::COL_GROUP_CD => 1, GroupsTableMap::COL_GROUP_NAME => 2, GroupsTableMap::COL_DEFAULT_CALENDAR_VIEW => 3, GroupsTableMap::COL_INCLUDE_IN_PROVIDER_LIST => 4, GroupsTableMap::COL_CAN_VIEW_OTHER_PROFILES => 5, GroupsTableMap::COL_CAN_EDIT_OTHER_PROFILES => 6, GroupsTableMap::COL_CAN_DELETE_SERVICES => 7, GroupsTableMap::COL_CAN_EDIT_SERVICES => 8, GroupsTableMap::COL_CAN_ADD_SCHEDULE => 9, GroupsTableMap::COL_CAN_ADMIN_GUEST => 10, GroupsTableMap::COL_CAN_ADMIN_CALENDAR => 11, GroupsTableMap::COL_CAN_ADMIN_PROVIDERS => 12, GroupsTableMap::COL_CAN_ADMIN_SERVICES => 13, GroupsTableMap::COL_CAN_ADMIN_FACILITIES => 14, GroupsTableMap::COL_CAN_ADMIN_ACTIVITIES => 15, GroupsTableMap::COL_CAN_ADMIN_PACKAGES => 16, GroupsTableMap::COL_CAN_ADMIN_REPORTS => 17, GroupsTableMap::COL_LOCATION => 18, GroupsTableMap::COL_FORMS => 19, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_1 => 20, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_1 => 21, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_2 => 22, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_2 => 23, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_3 => 24, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_3 => 25, GroupsTableMap::COL_INCLUDE_IN_AUDIT_LIST => 26, GroupsTableMap::COL_CAN_EDIT_COMPLETED_FORMS => 27, GroupsTableMap::COL_CAN_ASSIGN_SCHEDULES => 28, GroupsTableMap::COL_CAN_VIEW_OTHER_SCHEDULE => 29, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_4 => 30, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_4 => 31, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_5 => 32, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_5 => 33, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_6 => 34, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_6 => 35, GroupsTableMap::COL_CAN_VIEW_SCHEDULES_7 => 36, GroupsTableMap::COL_CAN_EDIT_SCHEDULES_7 => 37, GroupsTableMap::COL_CAN_VIEW_DASHBOARD => 38, GroupsTableMap::COL_NOTIFY_ON_BOOKINGS => 39, GroupsTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS => 40, GroupsTableMap::COL_CAN_MANAGE_GUEST_FORMS => 41, GroupsTableMap::COL_CAN_VIEW_FINANCIAL => 42, GroupsTableMap::COL_CAN_VIEW_TODAY_BOOKINGS => 43, GroupsTableMap::COL_DASHBOARD_TOP => 44, GroupsTableMap::COL_DASHBOARD_MIDDLE => 45, GroupsTableMap::COL_DASHBOARD_BOTTOM => 46, GroupsTableMap::COL_CALENDAR_HEADER_RIGHT => 47, GroupsTableMap::COL_CAN_MANAGE_GUEST_SETTINGS => 48, ),
        self::TYPE_FIELDNAME     => array('group_id' => 0, 'group_cd' => 1, 'group_name' => 2, 'default_calendar_view' => 3, 'include_in_provider_list' => 4, 'can_view_other_profiles' => 5, 'can_edit_other_profiles' => 6, 'can_delete_services' => 7, 'can_edit_services' => 8, 'can_add_schedule' => 9, 'can_admin_guest' => 10, 'can_admin_calendar' => 11, 'can_admin_providers' => 12, 'can_admin_services' => 13, 'can_admin_facilities' => 14, 'can_admin_activities' => 15, 'can_admin_packages' => 16, 'can_admin_reports' => 17, 'location' => 18, 'forms' => 19, 'can_view_schedules_1' => 20, 'can_edit_schedules_1' => 21, 'can_view_schedules_2' => 22, 'can_edit_schedules_2' => 23, 'can_view_schedules_3' => 24, 'can_edit_schedules_3' => 25, 'include_in_audit_list' => 26, 'can_edit_completed_forms' => 27, 'can_assign_schedules' => 28, 'can_view_other_schedule' => 29, 'can_view_schedules_4' => 30, 'can_edit_schedules_4' => 31, 'can_view_schedules_5' => 32, 'can_edit_schedules_5' => 33, 'can_view_schedules_6' => 34, 'can_edit_schedules_6' => 35, 'can_view_schedules_7' => 36, 'can_edit_schedules_7' => 37, 'can_view_dashboard' => 38, 'notify_on_bookings' => 39, 'can_manage_guest_bookings' => 40, 'can_manage_guest_forms' => 41, 'can_view_financial' => 42, 'can_view_today_bookings' => 43, 'dashboard_top' => 44, 'dashboard_middle' => 45, 'dashboard_bottom' => 46, 'calendar_header_right' => 47, 'can_manage_guest_settings' => 48, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tf_groups');
        $this->setPhpName('Groups');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Groups');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('group_id', 'GroupId', 'INTEGER', true, null, null);
        $this->addColumn('group_cd', 'GroupCd', 'VARCHAR', true, 40, null);
        $this->addColumn('group_name', 'GroupName', 'VARCHAR', true, 100, null);
        $this->addColumn('default_calendar_view', 'DefaultCalendarView', 'VARCHAR', false, 50, null);
        $this->addColumn('include_in_provider_list', 'IncludeInProviderList', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_other_profiles', 'CanViewOtherProfiles', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_other_profiles', 'CanEditOtherProfiles', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_delete_services', 'CanDeleteServices', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_services', 'CanEditServices', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_add_schedule', 'CanAddSchedule', 'VARCHAR', false, 1, 'y');
        $this->addColumn('can_admin_guest', 'CanAdminGuest', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_calendar', 'CanAdminCalendar', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_providers', 'CanAdminProviders', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_services', 'CanAdminServices', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_facilities', 'CanAdminFacilities', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_activities', 'CanAdminActivities', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_packages', 'CanAdminPackages', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_admin_reports', 'CanAdminReports', 'VARCHAR', false, 1, 'n');
        $this->addColumn('location', 'Location', 'VARCHAR', true, 16, '');
        $this->addColumn('forms', 'Forms', 'VARCHAR', true, 64, null);
        $this->addColumn('can_view_schedules_1', 'CanViewSchedules1', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_1', 'CanEditSchedules1', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_2', 'CanViewSchedules2', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_2', 'CanEditSchedules2', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_3', 'CanViewSchedules3', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_3', 'CanEditSchedules3', 'VARCHAR', false, 1, 'n');
        $this->addColumn('include_in_audit_list', 'IncludeInAuditList', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_completed_forms', 'CanEditCompletedForms', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_assign_schedules', 'CanAssignSchedules', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_other_schedule', 'CanViewOtherSchedule', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_4', 'CanViewSchedules4', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_4', 'CanEditSchedules4', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_5', 'CanViewSchedules5', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_5', 'CanEditSchedules5', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_6', 'CanViewSchedules6', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_6', 'CanEditSchedules6', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_schedules_7', 'CanViewSchedules7', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_edit_schedules_7', 'CanEditSchedules7', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_dashboard', 'CanViewDashboard', 'VARCHAR', false, 1, 'n');
        $this->addColumn('notify_on_bookings', 'NotifyOnBookings', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_manage_guest_bookings', 'CanManageGuestBookings', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_manage_guest_forms', 'CanManageGuestForms', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_financial', 'CanViewFinancial', 'VARCHAR', false, 1, 'n');
        $this->addColumn('can_view_today_bookings', 'CanViewTodayBookings', 'VARCHAR', false, 1, 'n');
        $this->addColumn('dashboard_top', 'DashboardTop', 'VARCHAR', true, 255, null);
        $this->addColumn('dashboard_middle', 'DashboardMiddle', 'VARCHAR', true, 255, null);
        $this->addColumn('dashboard_bottom', 'DashboardBottom', 'VARCHAR', true, 255, null);
        $this->addColumn('calendar_header_right', 'CalendarHeaderRight', 'VARCHAR', true, 255, null);
        $this->addColumn('can_manage_guest_settings', 'CanManageGuestSettings', 'VARCHAR', false, 1, 'n');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Users', '\\TheFarm\\Models\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':group_id',
    1 => ':group_id',
  ),
), null, null, 'Userss', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? GroupsTableMap::CLASS_DEFAULT : GroupsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Groups object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = GroupsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GroupsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GroupsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GroupsTableMap::OM_CLASS;
            /** @var Groups $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GroupsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = GroupsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GroupsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Groups $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GroupsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(GroupsTableMap::COL_GROUP_ID);
            $criteria->addSelectColumn(GroupsTableMap::COL_GROUP_CD);
            $criteria->addSelectColumn(GroupsTableMap::COL_GROUP_NAME);
            $criteria->addSelectColumn(GroupsTableMap::COL_DEFAULT_CALENDAR_VIEW);
            $criteria->addSelectColumn(GroupsTableMap::COL_INCLUDE_IN_PROVIDER_LIST);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_OTHER_PROFILES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_OTHER_PROFILES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_DELETE_SERVICES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SERVICES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADD_SCHEDULE);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_GUEST);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_CALENDAR);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_PROVIDERS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_SERVICES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_FACILITIES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_ACTIVITIES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_PACKAGES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ADMIN_REPORTS);
            $criteria->addSelectColumn(GroupsTableMap::COL_LOCATION);
            $criteria->addSelectColumn(GroupsTableMap::COL_FORMS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_1);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_1);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_2);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_2);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_3);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_3);
            $criteria->addSelectColumn(GroupsTableMap::COL_INCLUDE_IN_AUDIT_LIST);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_COMPLETED_FORMS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_ASSIGN_SCHEDULES);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_OTHER_SCHEDULE);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_4);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_4);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_5);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_5);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_6);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_6);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_7);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_7);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_DASHBOARD);
            $criteria->addSelectColumn(GroupsTableMap::COL_NOTIFY_ON_BOOKINGS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_MANAGE_GUEST_FORMS);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_FINANCIAL);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_VIEW_TODAY_BOOKINGS);
            $criteria->addSelectColumn(GroupsTableMap::COL_DASHBOARD_TOP);
            $criteria->addSelectColumn(GroupsTableMap::COL_DASHBOARD_MIDDLE);
            $criteria->addSelectColumn(GroupsTableMap::COL_DASHBOARD_BOTTOM);
            $criteria->addSelectColumn(GroupsTableMap::COL_CALENDAR_HEADER_RIGHT);
            $criteria->addSelectColumn(GroupsTableMap::COL_CAN_MANAGE_GUEST_SETTINGS);
        } else {
            $criteria->addSelectColumn($alias . '.group_id');
            $criteria->addSelectColumn($alias . '.group_cd');
            $criteria->addSelectColumn($alias . '.group_name');
            $criteria->addSelectColumn($alias . '.default_calendar_view');
            $criteria->addSelectColumn($alias . '.include_in_provider_list');
            $criteria->addSelectColumn($alias . '.can_view_other_profiles');
            $criteria->addSelectColumn($alias . '.can_edit_other_profiles');
            $criteria->addSelectColumn($alias . '.can_delete_services');
            $criteria->addSelectColumn($alias . '.can_edit_services');
            $criteria->addSelectColumn($alias . '.can_add_schedule');
            $criteria->addSelectColumn($alias . '.can_admin_guest');
            $criteria->addSelectColumn($alias . '.can_admin_calendar');
            $criteria->addSelectColumn($alias . '.can_admin_providers');
            $criteria->addSelectColumn($alias . '.can_admin_services');
            $criteria->addSelectColumn($alias . '.can_admin_facilities');
            $criteria->addSelectColumn($alias . '.can_admin_activities');
            $criteria->addSelectColumn($alias . '.can_admin_packages');
            $criteria->addSelectColumn($alias . '.can_admin_reports');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.forms');
            $criteria->addSelectColumn($alias . '.can_view_schedules_1');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_1');
            $criteria->addSelectColumn($alias . '.can_view_schedules_2');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_2');
            $criteria->addSelectColumn($alias . '.can_view_schedules_3');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_3');
            $criteria->addSelectColumn($alias . '.include_in_audit_list');
            $criteria->addSelectColumn($alias . '.can_edit_completed_forms');
            $criteria->addSelectColumn($alias . '.can_assign_schedules');
            $criteria->addSelectColumn($alias . '.can_view_other_schedule');
            $criteria->addSelectColumn($alias . '.can_view_schedules_4');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_4');
            $criteria->addSelectColumn($alias . '.can_view_schedules_5');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_5');
            $criteria->addSelectColumn($alias . '.can_view_schedules_6');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_6');
            $criteria->addSelectColumn($alias . '.can_view_schedules_7');
            $criteria->addSelectColumn($alias . '.can_edit_schedules_7');
            $criteria->addSelectColumn($alias . '.can_view_dashboard');
            $criteria->addSelectColumn($alias . '.notify_on_bookings');
            $criteria->addSelectColumn($alias . '.can_manage_guest_bookings');
            $criteria->addSelectColumn($alias . '.can_manage_guest_forms');
            $criteria->addSelectColumn($alias . '.can_view_financial');
            $criteria->addSelectColumn($alias . '.can_view_today_bookings');
            $criteria->addSelectColumn($alias . '.dashboard_top');
            $criteria->addSelectColumn($alias . '.dashboard_middle');
            $criteria->addSelectColumn($alias . '.dashboard_bottom');
            $criteria->addSelectColumn($alias . '.calendar_header_right');
            $criteria->addSelectColumn($alias . '.can_manage_guest_settings');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(GroupsTableMap::DATABASE_NAME)->getTable(GroupsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(GroupsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(GroupsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new GroupsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Groups or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Groups object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Groups) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GroupsTableMap::DATABASE_NAME);
            $criteria->add(GroupsTableMap::COL_GROUP_ID, (array) $values, Criteria::IN);
        }

        $query = GroupsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GroupsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GroupsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_groups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return GroupsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Groups or Criteria object.
     *
     * @param mixed               $criteria Criteria or Groups object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Groups object
        }

        if ($criteria->containsKey(GroupsTableMap::COL_GROUP_ID) && $criteria->keyContainsValue(GroupsTableMap::COL_GROUP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GroupsTableMap::COL_GROUP_ID.')');
        }


        // Set the correct dbName
        $query = GroupsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // GroupsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
GroupsTableMap::buildTableMap();
