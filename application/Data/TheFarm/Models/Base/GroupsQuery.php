<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\Groups as ChildGroups;
use TheFarm\Models\GroupsQuery as ChildGroupsQuery;
use TheFarm\Models\Map\GroupsTableMap;

/**
 * Base class that represents a query for the 'tf_groups' table.
 *
 *
 *
 * @method     ChildGroupsQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildGroupsQuery orderByGroupCd($order = Criteria::ASC) Order by the group_cd column
 * @method     ChildGroupsQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 * @method     ChildGroupsQuery orderByDefaultCalendarView($order = Criteria::ASC) Order by the default_calendar_view column
 * @method     ChildGroupsQuery orderByIncludeInProviderList($order = Criteria::ASC) Order by the include_in_provider_list column
 * @method     ChildGroupsQuery orderByCanViewOtherProfiles($order = Criteria::ASC) Order by the can_view_other_profiles column
 * @method     ChildGroupsQuery orderByCanEditOtherProfiles($order = Criteria::ASC) Order by the can_edit_other_profiles column
 * @method     ChildGroupsQuery orderByCanDeleteServices($order = Criteria::ASC) Order by the can_delete_services column
 * @method     ChildGroupsQuery orderByCanEditServices($order = Criteria::ASC) Order by the can_edit_services column
 * @method     ChildGroupsQuery orderByCanAddSchedule($order = Criteria::ASC) Order by the can_add_schedule column
 * @method     ChildGroupsQuery orderByCanAdminGuest($order = Criteria::ASC) Order by the can_admin_guest column
 * @method     ChildGroupsQuery orderByCanAdminCalendar($order = Criteria::ASC) Order by the can_admin_calendar column
 * @method     ChildGroupsQuery orderByCanAdminProviders($order = Criteria::ASC) Order by the can_admin_providers column
 * @method     ChildGroupsQuery orderByCanAdminServices($order = Criteria::ASC) Order by the can_admin_services column
 * @method     ChildGroupsQuery orderByCanAdminFacilities($order = Criteria::ASC) Order by the can_admin_facilities column
 * @method     ChildGroupsQuery orderByCanAdminActivities($order = Criteria::ASC) Order by the can_admin_activities column
 * @method     ChildGroupsQuery orderByCanAdminPackages($order = Criteria::ASC) Order by the can_admin_packages column
 * @method     ChildGroupsQuery orderByCanAdminReports($order = Criteria::ASC) Order by the can_admin_reports column
 * @method     ChildGroupsQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildGroupsQuery orderByForms($order = Criteria::ASC) Order by the forms column
 * @method     ChildGroupsQuery orderByCanViewSchedules1($order = Criteria::ASC) Order by the can_view_schedules_1 column
 * @method     ChildGroupsQuery orderByCanEditSchedules1($order = Criteria::ASC) Order by the can_edit_schedules_1 column
 * @method     ChildGroupsQuery orderByCanViewSchedules2($order = Criteria::ASC) Order by the can_view_schedules_2 column
 * @method     ChildGroupsQuery orderByCanEditSchedules2($order = Criteria::ASC) Order by the can_edit_schedules_2 column
 * @method     ChildGroupsQuery orderByCanViewSchedules3($order = Criteria::ASC) Order by the can_view_schedules_3 column
 * @method     ChildGroupsQuery orderByCanEditSchedules3($order = Criteria::ASC) Order by the can_edit_schedules_3 column
 * @method     ChildGroupsQuery orderByIncludeInAuditList($order = Criteria::ASC) Order by the include_in_audit_list column
 * @method     ChildGroupsQuery orderByCanEditCompletedForms($order = Criteria::ASC) Order by the can_edit_completed_forms column
 * @method     ChildGroupsQuery orderByCanAssignSchedules($order = Criteria::ASC) Order by the can_assign_schedules column
 * @method     ChildGroupsQuery orderByCanViewOtherSchedule($order = Criteria::ASC) Order by the can_view_other_schedule column
 * @method     ChildGroupsQuery orderByCanViewSchedules4($order = Criteria::ASC) Order by the can_view_schedules_4 column
 * @method     ChildGroupsQuery orderByCanEditSchedules4($order = Criteria::ASC) Order by the can_edit_schedules_4 column
 * @method     ChildGroupsQuery orderByCanViewSchedules5($order = Criteria::ASC) Order by the can_view_schedules_5 column
 * @method     ChildGroupsQuery orderByCanEditSchedules5($order = Criteria::ASC) Order by the can_edit_schedules_5 column
 * @method     ChildGroupsQuery orderByCanViewSchedules6($order = Criteria::ASC) Order by the can_view_schedules_6 column
 * @method     ChildGroupsQuery orderByCanEditSchedules6($order = Criteria::ASC) Order by the can_edit_schedules_6 column
 * @method     ChildGroupsQuery orderByCanViewSchedules7($order = Criteria::ASC) Order by the can_view_schedules_7 column
 * @method     ChildGroupsQuery orderByCanEditSchedules7($order = Criteria::ASC) Order by the can_edit_schedules_7 column
 * @method     ChildGroupsQuery orderByCanViewDashboard($order = Criteria::ASC) Order by the can_view_dashboard column
 * @method     ChildGroupsQuery orderByNotifyOnBookings($order = Criteria::ASC) Order by the notify_on_bookings column
 * @method     ChildGroupsQuery orderByCanManageGuestBookings($order = Criteria::ASC) Order by the can_manage_guest_bookings column
 * @method     ChildGroupsQuery orderByCanManageGuestForms($order = Criteria::ASC) Order by the can_manage_guest_forms column
 * @method     ChildGroupsQuery orderByCanViewFinancial($order = Criteria::ASC) Order by the can_view_financial column
 * @method     ChildGroupsQuery orderByCanViewTodayBookings($order = Criteria::ASC) Order by the can_view_today_bookings column
 * @method     ChildGroupsQuery orderByDashboardTop($order = Criteria::ASC) Order by the dashboard_top column
 * @method     ChildGroupsQuery orderByDashboardMiddle($order = Criteria::ASC) Order by the dashboard_middle column
 * @method     ChildGroupsQuery orderByDashboardBottom($order = Criteria::ASC) Order by the dashboard_bottom column
 * @method     ChildGroupsQuery orderByCalendarHeaderRight($order = Criteria::ASC) Order by the calendar_header_right column
 * @method     ChildGroupsQuery orderByCanManageGuestSettings($order = Criteria::ASC) Order by the can_manage_guest_settings column
 *
 * @method     ChildGroupsQuery groupByGroupId() Group by the group_id column
 * @method     ChildGroupsQuery groupByGroupCd() Group by the group_cd column
 * @method     ChildGroupsQuery groupByGroupName() Group by the group_name column
 * @method     ChildGroupsQuery groupByDefaultCalendarView() Group by the default_calendar_view column
 * @method     ChildGroupsQuery groupByIncludeInProviderList() Group by the include_in_provider_list column
 * @method     ChildGroupsQuery groupByCanViewOtherProfiles() Group by the can_view_other_profiles column
 * @method     ChildGroupsQuery groupByCanEditOtherProfiles() Group by the can_edit_other_profiles column
 * @method     ChildGroupsQuery groupByCanDeleteServices() Group by the can_delete_services column
 * @method     ChildGroupsQuery groupByCanEditServices() Group by the can_edit_services column
 * @method     ChildGroupsQuery groupByCanAddSchedule() Group by the can_add_schedule column
 * @method     ChildGroupsQuery groupByCanAdminGuest() Group by the can_admin_guest column
 * @method     ChildGroupsQuery groupByCanAdminCalendar() Group by the can_admin_calendar column
 * @method     ChildGroupsQuery groupByCanAdminProviders() Group by the can_admin_providers column
 * @method     ChildGroupsQuery groupByCanAdminServices() Group by the can_admin_services column
 * @method     ChildGroupsQuery groupByCanAdminFacilities() Group by the can_admin_facilities column
 * @method     ChildGroupsQuery groupByCanAdminActivities() Group by the can_admin_activities column
 * @method     ChildGroupsQuery groupByCanAdminPackages() Group by the can_admin_packages column
 * @method     ChildGroupsQuery groupByCanAdminReports() Group by the can_admin_reports column
 * @method     ChildGroupsQuery groupByLocation() Group by the location column
 * @method     ChildGroupsQuery groupByForms() Group by the forms column
 * @method     ChildGroupsQuery groupByCanViewSchedules1() Group by the can_view_schedules_1 column
 * @method     ChildGroupsQuery groupByCanEditSchedules1() Group by the can_edit_schedules_1 column
 * @method     ChildGroupsQuery groupByCanViewSchedules2() Group by the can_view_schedules_2 column
 * @method     ChildGroupsQuery groupByCanEditSchedules2() Group by the can_edit_schedules_2 column
 * @method     ChildGroupsQuery groupByCanViewSchedules3() Group by the can_view_schedules_3 column
 * @method     ChildGroupsQuery groupByCanEditSchedules3() Group by the can_edit_schedules_3 column
 * @method     ChildGroupsQuery groupByIncludeInAuditList() Group by the include_in_audit_list column
 * @method     ChildGroupsQuery groupByCanEditCompletedForms() Group by the can_edit_completed_forms column
 * @method     ChildGroupsQuery groupByCanAssignSchedules() Group by the can_assign_schedules column
 * @method     ChildGroupsQuery groupByCanViewOtherSchedule() Group by the can_view_other_schedule column
 * @method     ChildGroupsQuery groupByCanViewSchedules4() Group by the can_view_schedules_4 column
 * @method     ChildGroupsQuery groupByCanEditSchedules4() Group by the can_edit_schedules_4 column
 * @method     ChildGroupsQuery groupByCanViewSchedules5() Group by the can_view_schedules_5 column
 * @method     ChildGroupsQuery groupByCanEditSchedules5() Group by the can_edit_schedules_5 column
 * @method     ChildGroupsQuery groupByCanViewSchedules6() Group by the can_view_schedules_6 column
 * @method     ChildGroupsQuery groupByCanEditSchedules6() Group by the can_edit_schedules_6 column
 * @method     ChildGroupsQuery groupByCanViewSchedules7() Group by the can_view_schedules_7 column
 * @method     ChildGroupsQuery groupByCanEditSchedules7() Group by the can_edit_schedules_7 column
 * @method     ChildGroupsQuery groupByCanViewDashboard() Group by the can_view_dashboard column
 * @method     ChildGroupsQuery groupByNotifyOnBookings() Group by the notify_on_bookings column
 * @method     ChildGroupsQuery groupByCanManageGuestBookings() Group by the can_manage_guest_bookings column
 * @method     ChildGroupsQuery groupByCanManageGuestForms() Group by the can_manage_guest_forms column
 * @method     ChildGroupsQuery groupByCanViewFinancial() Group by the can_view_financial column
 * @method     ChildGroupsQuery groupByCanViewTodayBookings() Group by the can_view_today_bookings column
 * @method     ChildGroupsQuery groupByDashboardTop() Group by the dashboard_top column
 * @method     ChildGroupsQuery groupByDashboardMiddle() Group by the dashboard_middle column
 * @method     ChildGroupsQuery groupByDashboardBottom() Group by the dashboard_bottom column
 * @method     ChildGroupsQuery groupByCalendarHeaderRight() Group by the calendar_header_right column
 * @method     ChildGroupsQuery groupByCanManageGuestSettings() Group by the can_manage_guest_settings column
 *
 * @method     ChildGroupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildGroupsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildGroupsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildGroupsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildGroupsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildGroupsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildGroupsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \TheFarm\Models\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroups findOne(ConnectionInterface $con = null) Return the first ChildGroups matching the query
 * @method     ChildGroups findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGroups matching the query, or a new ChildGroups object populated from the query conditions when no match is found
 *
 * @method     ChildGroups findOneByGroupId(int $group_id) Return the first ChildGroups filtered by the group_id column
 * @method     ChildGroups findOneByGroupCd(string $group_cd) Return the first ChildGroups filtered by the group_cd column
 * @method     ChildGroups findOneByGroupName(string $group_name) Return the first ChildGroups filtered by the group_name column
 * @method     ChildGroups findOneByDefaultCalendarView(string $default_calendar_view) Return the first ChildGroups filtered by the default_calendar_view column
 * @method     ChildGroups findOneByIncludeInProviderList(string $include_in_provider_list) Return the first ChildGroups filtered by the include_in_provider_list column
 * @method     ChildGroups findOneByCanViewOtherProfiles(string $can_view_other_profiles) Return the first ChildGroups filtered by the can_view_other_profiles column
 * @method     ChildGroups findOneByCanEditOtherProfiles(string $can_edit_other_profiles) Return the first ChildGroups filtered by the can_edit_other_profiles column
 * @method     ChildGroups findOneByCanDeleteServices(string $can_delete_services) Return the first ChildGroups filtered by the can_delete_services column
 * @method     ChildGroups findOneByCanEditServices(string $can_edit_services) Return the first ChildGroups filtered by the can_edit_services column
 * @method     ChildGroups findOneByCanAddSchedule(string $can_add_schedule) Return the first ChildGroups filtered by the can_add_schedule column
 * @method     ChildGroups findOneByCanAdminGuest(string $can_admin_guest) Return the first ChildGroups filtered by the can_admin_guest column
 * @method     ChildGroups findOneByCanAdminCalendar(string $can_admin_calendar) Return the first ChildGroups filtered by the can_admin_calendar column
 * @method     ChildGroups findOneByCanAdminProviders(string $can_admin_providers) Return the first ChildGroups filtered by the can_admin_providers column
 * @method     ChildGroups findOneByCanAdminServices(string $can_admin_services) Return the first ChildGroups filtered by the can_admin_services column
 * @method     ChildGroups findOneByCanAdminFacilities(string $can_admin_facilities) Return the first ChildGroups filtered by the can_admin_facilities column
 * @method     ChildGroups findOneByCanAdminActivities(string $can_admin_activities) Return the first ChildGroups filtered by the can_admin_activities column
 * @method     ChildGroups findOneByCanAdminPackages(string $can_admin_packages) Return the first ChildGroups filtered by the can_admin_packages column
 * @method     ChildGroups findOneByCanAdminReports(string $can_admin_reports) Return the first ChildGroups filtered by the can_admin_reports column
 * @method     ChildGroups findOneByLocation(string $location) Return the first ChildGroups filtered by the location column
 * @method     ChildGroups findOneByForms(string $forms) Return the first ChildGroups filtered by the forms column
 * @method     ChildGroups findOneByCanViewSchedules1(string $can_view_schedules_1) Return the first ChildGroups filtered by the can_view_schedules_1 column
 * @method     ChildGroups findOneByCanEditSchedules1(string $can_edit_schedules_1) Return the first ChildGroups filtered by the can_edit_schedules_1 column
 * @method     ChildGroups findOneByCanViewSchedules2(string $can_view_schedules_2) Return the first ChildGroups filtered by the can_view_schedules_2 column
 * @method     ChildGroups findOneByCanEditSchedules2(string $can_edit_schedules_2) Return the first ChildGroups filtered by the can_edit_schedules_2 column
 * @method     ChildGroups findOneByCanViewSchedules3(string $can_view_schedules_3) Return the first ChildGroups filtered by the can_view_schedules_3 column
 * @method     ChildGroups findOneByCanEditSchedules3(string $can_edit_schedules_3) Return the first ChildGroups filtered by the can_edit_schedules_3 column
 * @method     ChildGroups findOneByIncludeInAuditList(string $include_in_audit_list) Return the first ChildGroups filtered by the include_in_audit_list column
 * @method     ChildGroups findOneByCanEditCompletedForms(string $can_edit_completed_forms) Return the first ChildGroups filtered by the can_edit_completed_forms column
 * @method     ChildGroups findOneByCanAssignSchedules(string $can_assign_schedules) Return the first ChildGroups filtered by the can_assign_schedules column
 * @method     ChildGroups findOneByCanViewOtherSchedule(string $can_view_other_schedule) Return the first ChildGroups filtered by the can_view_other_schedule column
 * @method     ChildGroups findOneByCanViewSchedules4(string $can_view_schedules_4) Return the first ChildGroups filtered by the can_view_schedules_4 column
 * @method     ChildGroups findOneByCanEditSchedules4(string $can_edit_schedules_4) Return the first ChildGroups filtered by the can_edit_schedules_4 column
 * @method     ChildGroups findOneByCanViewSchedules5(string $can_view_schedules_5) Return the first ChildGroups filtered by the can_view_schedules_5 column
 * @method     ChildGroups findOneByCanEditSchedules5(string $can_edit_schedules_5) Return the first ChildGroups filtered by the can_edit_schedules_5 column
 * @method     ChildGroups findOneByCanViewSchedules6(string $can_view_schedules_6) Return the first ChildGroups filtered by the can_view_schedules_6 column
 * @method     ChildGroups findOneByCanEditSchedules6(string $can_edit_schedules_6) Return the first ChildGroups filtered by the can_edit_schedules_6 column
 * @method     ChildGroups findOneByCanViewSchedules7(string $can_view_schedules_7) Return the first ChildGroups filtered by the can_view_schedules_7 column
 * @method     ChildGroups findOneByCanEditSchedules7(string $can_edit_schedules_7) Return the first ChildGroups filtered by the can_edit_schedules_7 column
 * @method     ChildGroups findOneByCanViewDashboard(string $can_view_dashboard) Return the first ChildGroups filtered by the can_view_dashboard column
 * @method     ChildGroups findOneByNotifyOnBookings(string $notify_on_bookings) Return the first ChildGroups filtered by the notify_on_bookings column
 * @method     ChildGroups findOneByCanManageGuestBookings(string $can_manage_guest_bookings) Return the first ChildGroups filtered by the can_manage_guest_bookings column
 * @method     ChildGroups findOneByCanManageGuestForms(string $can_manage_guest_forms) Return the first ChildGroups filtered by the can_manage_guest_forms column
 * @method     ChildGroups findOneByCanViewFinancial(string $can_view_financial) Return the first ChildGroups filtered by the can_view_financial column
 * @method     ChildGroups findOneByCanViewTodayBookings(string $can_view_today_bookings) Return the first ChildGroups filtered by the can_view_today_bookings column
 * @method     ChildGroups findOneByDashboardTop(string $dashboard_top) Return the first ChildGroups filtered by the dashboard_top column
 * @method     ChildGroups findOneByDashboardMiddle(string $dashboard_middle) Return the first ChildGroups filtered by the dashboard_middle column
 * @method     ChildGroups findOneByDashboardBottom(string $dashboard_bottom) Return the first ChildGroups filtered by the dashboard_bottom column
 * @method     ChildGroups findOneByCalendarHeaderRight(string $calendar_header_right) Return the first ChildGroups filtered by the calendar_header_right column
 * @method     ChildGroups findOneByCanManageGuestSettings(string $can_manage_guest_settings) Return the first ChildGroups filtered by the can_manage_guest_settings column *

 * @method     ChildGroups requirePk($key, ConnectionInterface $con = null) Return the ChildGroups by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOne(ConnectionInterface $con = null) Return the first ChildGroups matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroups requireOneByGroupId(int $group_id) Return the first ChildGroups filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByGroupCd(string $group_cd) Return the first ChildGroups filtered by the group_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByGroupName(string $group_name) Return the first ChildGroups filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByDefaultCalendarView(string $default_calendar_view) Return the first ChildGroups filtered by the default_calendar_view column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByIncludeInProviderList(string $include_in_provider_list) Return the first ChildGroups filtered by the include_in_provider_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewOtherProfiles(string $can_view_other_profiles) Return the first ChildGroups filtered by the can_view_other_profiles column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditOtherProfiles(string $can_edit_other_profiles) Return the first ChildGroups filtered by the can_edit_other_profiles column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanDeleteServices(string $can_delete_services) Return the first ChildGroups filtered by the can_delete_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditServices(string $can_edit_services) Return the first ChildGroups filtered by the can_edit_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAddSchedule(string $can_add_schedule) Return the first ChildGroups filtered by the can_add_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminGuest(string $can_admin_guest) Return the first ChildGroups filtered by the can_admin_guest column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminCalendar(string $can_admin_calendar) Return the first ChildGroups filtered by the can_admin_calendar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminProviders(string $can_admin_providers) Return the first ChildGroups filtered by the can_admin_providers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminServices(string $can_admin_services) Return the first ChildGroups filtered by the can_admin_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminFacilities(string $can_admin_facilities) Return the first ChildGroups filtered by the can_admin_facilities column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminActivities(string $can_admin_activities) Return the first ChildGroups filtered by the can_admin_activities column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminPackages(string $can_admin_packages) Return the first ChildGroups filtered by the can_admin_packages column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAdminReports(string $can_admin_reports) Return the first ChildGroups filtered by the can_admin_reports column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByLocation(string $location) Return the first ChildGroups filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByForms(string $forms) Return the first ChildGroups filtered by the forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules1(string $can_view_schedules_1) Return the first ChildGroups filtered by the can_view_schedules_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules1(string $can_edit_schedules_1) Return the first ChildGroups filtered by the can_edit_schedules_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules2(string $can_view_schedules_2) Return the first ChildGroups filtered by the can_view_schedules_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules2(string $can_edit_schedules_2) Return the first ChildGroups filtered by the can_edit_schedules_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules3(string $can_view_schedules_3) Return the first ChildGroups filtered by the can_view_schedules_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules3(string $can_edit_schedules_3) Return the first ChildGroups filtered by the can_edit_schedules_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByIncludeInAuditList(string $include_in_audit_list) Return the first ChildGroups filtered by the include_in_audit_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditCompletedForms(string $can_edit_completed_forms) Return the first ChildGroups filtered by the can_edit_completed_forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanAssignSchedules(string $can_assign_schedules) Return the first ChildGroups filtered by the can_assign_schedules column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewOtherSchedule(string $can_view_other_schedule) Return the first ChildGroups filtered by the can_view_other_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules4(string $can_view_schedules_4) Return the first ChildGroups filtered by the can_view_schedules_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules4(string $can_edit_schedules_4) Return the first ChildGroups filtered by the can_edit_schedules_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules5(string $can_view_schedules_5) Return the first ChildGroups filtered by the can_view_schedules_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules5(string $can_edit_schedules_5) Return the first ChildGroups filtered by the can_edit_schedules_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules6(string $can_view_schedules_6) Return the first ChildGroups filtered by the can_view_schedules_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules6(string $can_edit_schedules_6) Return the first ChildGroups filtered by the can_edit_schedules_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewSchedules7(string $can_view_schedules_7) Return the first ChildGroups filtered by the can_view_schedules_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanEditSchedules7(string $can_edit_schedules_7) Return the first ChildGroups filtered by the can_edit_schedules_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewDashboard(string $can_view_dashboard) Return the first ChildGroups filtered by the can_view_dashboard column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByNotifyOnBookings(string $notify_on_bookings) Return the first ChildGroups filtered by the notify_on_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanManageGuestBookings(string $can_manage_guest_bookings) Return the first ChildGroups filtered by the can_manage_guest_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanManageGuestForms(string $can_manage_guest_forms) Return the first ChildGroups filtered by the can_manage_guest_forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewFinancial(string $can_view_financial) Return the first ChildGroups filtered by the can_view_financial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanViewTodayBookings(string $can_view_today_bookings) Return the first ChildGroups filtered by the can_view_today_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByDashboardTop(string $dashboard_top) Return the first ChildGroups filtered by the dashboard_top column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByDashboardMiddle(string $dashboard_middle) Return the first ChildGroups filtered by the dashboard_middle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByDashboardBottom(string $dashboard_bottom) Return the first ChildGroups filtered by the dashboard_bottom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCalendarHeaderRight(string $calendar_header_right) Return the first ChildGroups filtered by the calendar_header_right column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByCanManageGuestSettings(string $can_manage_guest_settings) Return the first ChildGroups filtered by the can_manage_guest_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroups[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGroups objects based on current ModelCriteria
 * @method     ChildGroups[]|ObjectCollection findByGroupId(int $group_id) Return ChildGroups objects filtered by the group_id column
 * @method     ChildGroups[]|ObjectCollection findByGroupCd(string $group_cd) Return ChildGroups objects filtered by the group_cd column
 * @method     ChildGroups[]|ObjectCollection findByGroupName(string $group_name) Return ChildGroups objects filtered by the group_name column
 * @method     ChildGroups[]|ObjectCollection findByDefaultCalendarView(string $default_calendar_view) Return ChildGroups objects filtered by the default_calendar_view column
 * @method     ChildGroups[]|ObjectCollection findByIncludeInProviderList(string $include_in_provider_list) Return ChildGroups objects filtered by the include_in_provider_list column
 * @method     ChildGroups[]|ObjectCollection findByCanViewOtherProfiles(string $can_view_other_profiles) Return ChildGroups objects filtered by the can_view_other_profiles column
 * @method     ChildGroups[]|ObjectCollection findByCanEditOtherProfiles(string $can_edit_other_profiles) Return ChildGroups objects filtered by the can_edit_other_profiles column
 * @method     ChildGroups[]|ObjectCollection findByCanDeleteServices(string $can_delete_services) Return ChildGroups objects filtered by the can_delete_services column
 * @method     ChildGroups[]|ObjectCollection findByCanEditServices(string $can_edit_services) Return ChildGroups objects filtered by the can_edit_services column
 * @method     ChildGroups[]|ObjectCollection findByCanAddSchedule(string $can_add_schedule) Return ChildGroups objects filtered by the can_add_schedule column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminGuest(string $can_admin_guest) Return ChildGroups objects filtered by the can_admin_guest column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminCalendar(string $can_admin_calendar) Return ChildGroups objects filtered by the can_admin_calendar column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminProviders(string $can_admin_providers) Return ChildGroups objects filtered by the can_admin_providers column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminServices(string $can_admin_services) Return ChildGroups objects filtered by the can_admin_services column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminFacilities(string $can_admin_facilities) Return ChildGroups objects filtered by the can_admin_facilities column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminActivities(string $can_admin_activities) Return ChildGroups objects filtered by the can_admin_activities column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminPackages(string $can_admin_packages) Return ChildGroups objects filtered by the can_admin_packages column
 * @method     ChildGroups[]|ObjectCollection findByCanAdminReports(string $can_admin_reports) Return ChildGroups objects filtered by the can_admin_reports column
 * @method     ChildGroups[]|ObjectCollection findByLocation(string $location) Return ChildGroups objects filtered by the location column
 * @method     ChildGroups[]|ObjectCollection findByForms(string $forms) Return ChildGroups objects filtered by the forms column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules1(string $can_view_schedules_1) Return ChildGroups objects filtered by the can_view_schedules_1 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules1(string $can_edit_schedules_1) Return ChildGroups objects filtered by the can_edit_schedules_1 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules2(string $can_view_schedules_2) Return ChildGroups objects filtered by the can_view_schedules_2 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules2(string $can_edit_schedules_2) Return ChildGroups objects filtered by the can_edit_schedules_2 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules3(string $can_view_schedules_3) Return ChildGroups objects filtered by the can_view_schedules_3 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules3(string $can_edit_schedules_3) Return ChildGroups objects filtered by the can_edit_schedules_3 column
 * @method     ChildGroups[]|ObjectCollection findByIncludeInAuditList(string $include_in_audit_list) Return ChildGroups objects filtered by the include_in_audit_list column
 * @method     ChildGroups[]|ObjectCollection findByCanEditCompletedForms(string $can_edit_completed_forms) Return ChildGroups objects filtered by the can_edit_completed_forms column
 * @method     ChildGroups[]|ObjectCollection findByCanAssignSchedules(string $can_assign_schedules) Return ChildGroups objects filtered by the can_assign_schedules column
 * @method     ChildGroups[]|ObjectCollection findByCanViewOtherSchedule(string $can_view_other_schedule) Return ChildGroups objects filtered by the can_view_other_schedule column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules4(string $can_view_schedules_4) Return ChildGroups objects filtered by the can_view_schedules_4 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules4(string $can_edit_schedules_4) Return ChildGroups objects filtered by the can_edit_schedules_4 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules5(string $can_view_schedules_5) Return ChildGroups objects filtered by the can_view_schedules_5 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules5(string $can_edit_schedules_5) Return ChildGroups objects filtered by the can_edit_schedules_5 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules6(string $can_view_schedules_6) Return ChildGroups objects filtered by the can_view_schedules_6 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules6(string $can_edit_schedules_6) Return ChildGroups objects filtered by the can_edit_schedules_6 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewSchedules7(string $can_view_schedules_7) Return ChildGroups objects filtered by the can_view_schedules_7 column
 * @method     ChildGroups[]|ObjectCollection findByCanEditSchedules7(string $can_edit_schedules_7) Return ChildGroups objects filtered by the can_edit_schedules_7 column
 * @method     ChildGroups[]|ObjectCollection findByCanViewDashboard(string $can_view_dashboard) Return ChildGroups objects filtered by the can_view_dashboard column
 * @method     ChildGroups[]|ObjectCollection findByNotifyOnBookings(string $notify_on_bookings) Return ChildGroups objects filtered by the notify_on_bookings column
 * @method     ChildGroups[]|ObjectCollection findByCanManageGuestBookings(string $can_manage_guest_bookings) Return ChildGroups objects filtered by the can_manage_guest_bookings column
 * @method     ChildGroups[]|ObjectCollection findByCanManageGuestForms(string $can_manage_guest_forms) Return ChildGroups objects filtered by the can_manage_guest_forms column
 * @method     ChildGroups[]|ObjectCollection findByCanViewFinancial(string $can_view_financial) Return ChildGroups objects filtered by the can_view_financial column
 * @method     ChildGroups[]|ObjectCollection findByCanViewTodayBookings(string $can_view_today_bookings) Return ChildGroups objects filtered by the can_view_today_bookings column
 * @method     ChildGroups[]|ObjectCollection findByDashboardTop(string $dashboard_top) Return ChildGroups objects filtered by the dashboard_top column
 * @method     ChildGroups[]|ObjectCollection findByDashboardMiddle(string $dashboard_middle) Return ChildGroups objects filtered by the dashboard_middle column
 * @method     ChildGroups[]|ObjectCollection findByDashboardBottom(string $dashboard_bottom) Return ChildGroups objects filtered by the dashboard_bottom column
 * @method     ChildGroups[]|ObjectCollection findByCalendarHeaderRight(string $calendar_header_right) Return ChildGroups objects filtered by the calendar_header_right column
 * @method     ChildGroups[]|ObjectCollection findByCanManageGuestSettings(string $can_manage_guest_settings) Return ChildGroups objects filtered by the can_manage_guest_settings column
 * @method     ChildGroups[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\GroupsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Groups', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGroupsQuery) {
            return $criteria;
        }
        $query = new ChildGroupsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildGroups|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGroups A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT group_id, group_cd, group_name, default_calendar_view, include_in_provider_list, can_view_other_profiles, can_edit_other_profiles, can_delete_services, can_edit_services, can_add_schedule, can_admin_guest, can_admin_calendar, can_admin_providers, can_admin_services, can_admin_facilities, can_admin_activities, can_admin_packages, can_admin_reports, location, forms, can_view_schedules_1, can_edit_schedules_1, can_view_schedules_2, can_edit_schedules_2, can_view_schedules_3, can_edit_schedules_3, include_in_audit_list, can_edit_completed_forms, can_assign_schedules, can_view_other_schedule, can_view_schedules_4, can_edit_schedules_4, can_view_schedules_5, can_edit_schedules_5, can_view_schedules_6, can_edit_schedules_6, can_view_schedules_7, can_edit_schedules_7, can_view_dashboard, notify_on_bookings, can_manage_guest_bookings, can_manage_guest_forms, can_view_financial, can_view_today_bookings, dashboard_top, dashboard_middle, dashboard_bottom, calendar_header_right, can_manage_guest_settings FROM tf_groups WHERE group_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildGroups $obj */
            $obj = new ChildGroups();
            $obj->hydrate($row);
            GroupsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildGroups|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE group_id = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
     * </code>
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $groupId, $comparison);
    }

    /**
     * Filter the query on the group_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupCd('fooValue');   // WHERE group_cd = 'fooValue'
     * $query->filterByGroupCd('%fooValue%', Criteria::LIKE); // WHERE group_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByGroupCd($groupCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_GROUP_CD, $groupCd, $comparison);
    }

    /**
     * Filter the query on the group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupName('fooValue');   // WHERE group_name = 'fooValue'
     * $query->filterByGroupName('%fooValue%', Criteria::LIKE); // WHERE group_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByGroupName($groupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_GROUP_NAME, $groupName, $comparison);
    }

    /**
     * Filter the query on the default_calendar_view column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultCalendarView('fooValue');   // WHERE default_calendar_view = 'fooValue'
     * $query->filterByDefaultCalendarView('%fooValue%', Criteria::LIKE); // WHERE default_calendar_view LIKE '%fooValue%'
     * </code>
     *
     * @param     string $defaultCalendarView The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByDefaultCalendarView($defaultCalendarView = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($defaultCalendarView)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_DEFAULT_CALENDAR_VIEW, $defaultCalendarView, $comparison);
    }

    /**
     * Filter the query on the include_in_provider_list column
     *
     * Example usage:
     * <code>
     * $query->filterByIncludeInProviderList('fooValue');   // WHERE include_in_provider_list = 'fooValue'
     * $query->filterByIncludeInProviderList('%fooValue%', Criteria::LIKE); // WHERE include_in_provider_list LIKE '%fooValue%'
     * </code>
     *
     * @param     string $includeInProviderList The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByIncludeInProviderList($includeInProviderList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInProviderList)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_INCLUDE_IN_PROVIDER_LIST, $includeInProviderList, $comparison);
    }

    /**
     * Filter the query on the can_view_other_profiles column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewOtherProfiles('fooValue');   // WHERE can_view_other_profiles = 'fooValue'
     * $query->filterByCanViewOtherProfiles('%fooValue%', Criteria::LIKE); // WHERE can_view_other_profiles LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewOtherProfiles The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewOtherProfiles($canViewOtherProfiles = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewOtherProfiles)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_OTHER_PROFILES, $canViewOtherProfiles, $comparison);
    }

    /**
     * Filter the query on the can_edit_other_profiles column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditOtherProfiles('fooValue');   // WHERE can_edit_other_profiles = 'fooValue'
     * $query->filterByCanEditOtherProfiles('%fooValue%', Criteria::LIKE); // WHERE can_edit_other_profiles LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditOtherProfiles The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditOtherProfiles($canEditOtherProfiles = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditOtherProfiles)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_OTHER_PROFILES, $canEditOtherProfiles, $comparison);
    }

    /**
     * Filter the query on the can_delete_services column
     *
     * Example usage:
     * <code>
     * $query->filterByCanDeleteServices('fooValue');   // WHERE can_delete_services = 'fooValue'
     * $query->filterByCanDeleteServices('%fooValue%', Criteria::LIKE); // WHERE can_delete_services LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canDeleteServices The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanDeleteServices($canDeleteServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canDeleteServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_DELETE_SERVICES, $canDeleteServices, $comparison);
    }

    /**
     * Filter the query on the can_edit_services column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditServices('fooValue');   // WHERE can_edit_services = 'fooValue'
     * $query->filterByCanEditServices('%fooValue%', Criteria::LIKE); // WHERE can_edit_services LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditServices The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditServices($canEditServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SERVICES, $canEditServices, $comparison);
    }

    /**
     * Filter the query on the can_add_schedule column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAddSchedule('fooValue');   // WHERE can_add_schedule = 'fooValue'
     * $query->filterByCanAddSchedule('%fooValue%', Criteria::LIKE); // WHERE can_add_schedule LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAddSchedule The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAddSchedule($canAddSchedule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAddSchedule)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADD_SCHEDULE, $canAddSchedule, $comparison);
    }

    /**
     * Filter the query on the can_admin_guest column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminGuest('fooValue');   // WHERE can_admin_guest = 'fooValue'
     * $query->filterByCanAdminGuest('%fooValue%', Criteria::LIKE); // WHERE can_admin_guest LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminGuest The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminGuest($canAdminGuest = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminGuest)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_GUEST, $canAdminGuest, $comparison);
    }

    /**
     * Filter the query on the can_admin_calendar column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminCalendar('fooValue');   // WHERE can_admin_calendar = 'fooValue'
     * $query->filterByCanAdminCalendar('%fooValue%', Criteria::LIKE); // WHERE can_admin_calendar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminCalendar The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminCalendar($canAdminCalendar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminCalendar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_CALENDAR, $canAdminCalendar, $comparison);
    }

    /**
     * Filter the query on the can_admin_providers column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminProviders('fooValue');   // WHERE can_admin_providers = 'fooValue'
     * $query->filterByCanAdminProviders('%fooValue%', Criteria::LIKE); // WHERE can_admin_providers LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminProviders The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminProviders($canAdminProviders = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminProviders)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_PROVIDERS, $canAdminProviders, $comparison);
    }

    /**
     * Filter the query on the can_admin_services column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminServices('fooValue');   // WHERE can_admin_services = 'fooValue'
     * $query->filterByCanAdminServices('%fooValue%', Criteria::LIKE); // WHERE can_admin_services LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminServices The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminServices($canAdminServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_SERVICES, $canAdminServices, $comparison);
    }

    /**
     * Filter the query on the can_admin_facilities column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminFacilities('fooValue');   // WHERE can_admin_facilities = 'fooValue'
     * $query->filterByCanAdminFacilities('%fooValue%', Criteria::LIKE); // WHERE can_admin_facilities LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminFacilities The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminFacilities($canAdminFacilities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminFacilities)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_FACILITIES, $canAdminFacilities, $comparison);
    }

    /**
     * Filter the query on the can_admin_activities column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminActivities('fooValue');   // WHERE can_admin_activities = 'fooValue'
     * $query->filterByCanAdminActivities('%fooValue%', Criteria::LIKE); // WHERE can_admin_activities LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminActivities The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminActivities($canAdminActivities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminActivities)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_ACTIVITIES, $canAdminActivities, $comparison);
    }

    /**
     * Filter the query on the can_admin_packages column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminPackages('fooValue');   // WHERE can_admin_packages = 'fooValue'
     * $query->filterByCanAdminPackages('%fooValue%', Criteria::LIKE); // WHERE can_admin_packages LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminPackages The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminPackages($canAdminPackages = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminPackages)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_PACKAGES, $canAdminPackages, $comparison);
    }

    /**
     * Filter the query on the can_admin_reports column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAdminReports('fooValue');   // WHERE can_admin_reports = 'fooValue'
     * $query->filterByCanAdminReports('%fooValue%', Criteria::LIKE); // WHERE can_admin_reports LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAdminReports The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAdminReports($canAdminReports = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminReports)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ADMIN_REPORTS, $canAdminReports, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the forms column
     *
     * Example usage:
     * <code>
     * $query->filterByForms('fooValue');   // WHERE forms = 'fooValue'
     * $query->filterByForms('%fooValue%', Criteria::LIKE); // WHERE forms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $forms The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByForms($forms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($forms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_FORMS, $forms, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules1('fooValue');   // WHERE can_view_schedules_1 = 'fooValue'
     * $query->filterByCanViewSchedules1('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules1($canViewSchedules1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_1, $canViewSchedules1, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules1('fooValue');   // WHERE can_edit_schedules_1 = 'fooValue'
     * $query->filterByCanEditSchedules1('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules1($canEditSchedules1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_1, $canEditSchedules1, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules2('fooValue');   // WHERE can_view_schedules_2 = 'fooValue'
     * $query->filterByCanViewSchedules2('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules2($canViewSchedules2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_2, $canViewSchedules2, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules2('fooValue');   // WHERE can_edit_schedules_2 = 'fooValue'
     * $query->filterByCanEditSchedules2('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules2($canEditSchedules2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_2, $canEditSchedules2, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules3('fooValue');   // WHERE can_view_schedules_3 = 'fooValue'
     * $query->filterByCanViewSchedules3('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules3($canViewSchedules3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_3, $canViewSchedules3, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules3('fooValue');   // WHERE can_edit_schedules_3 = 'fooValue'
     * $query->filterByCanEditSchedules3('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules3($canEditSchedules3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_3, $canEditSchedules3, $comparison);
    }

    /**
     * Filter the query on the include_in_audit_list column
     *
     * Example usage:
     * <code>
     * $query->filterByIncludeInAuditList('fooValue');   // WHERE include_in_audit_list = 'fooValue'
     * $query->filterByIncludeInAuditList('%fooValue%', Criteria::LIKE); // WHERE include_in_audit_list LIKE '%fooValue%'
     * </code>
     *
     * @param     string $includeInAuditList The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByIncludeInAuditList($includeInAuditList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInAuditList)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_INCLUDE_IN_AUDIT_LIST, $includeInAuditList, $comparison);
    }

    /**
     * Filter the query on the can_edit_completed_forms column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditCompletedForms('fooValue');   // WHERE can_edit_completed_forms = 'fooValue'
     * $query->filterByCanEditCompletedForms('%fooValue%', Criteria::LIKE); // WHERE can_edit_completed_forms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditCompletedForms The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditCompletedForms($canEditCompletedForms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditCompletedForms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_COMPLETED_FORMS, $canEditCompletedForms, $comparison);
    }

    /**
     * Filter the query on the can_assign_schedules column
     *
     * Example usage:
     * <code>
     * $query->filterByCanAssignSchedules('fooValue');   // WHERE can_assign_schedules = 'fooValue'
     * $query->filterByCanAssignSchedules('%fooValue%', Criteria::LIKE); // WHERE can_assign_schedules LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canAssignSchedules The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanAssignSchedules($canAssignSchedules = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAssignSchedules)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_ASSIGN_SCHEDULES, $canAssignSchedules, $comparison);
    }

    /**
     * Filter the query on the can_view_other_schedule column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewOtherSchedule('fooValue');   // WHERE can_view_other_schedule = 'fooValue'
     * $query->filterByCanViewOtherSchedule('%fooValue%', Criteria::LIKE); // WHERE can_view_other_schedule LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewOtherSchedule The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewOtherSchedule($canViewOtherSchedule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewOtherSchedule)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_OTHER_SCHEDULE, $canViewOtherSchedule, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules4('fooValue');   // WHERE can_view_schedules_4 = 'fooValue'
     * $query->filterByCanViewSchedules4('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules4 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules4($canViewSchedules4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_4, $canViewSchedules4, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules4('fooValue');   // WHERE can_edit_schedules_4 = 'fooValue'
     * $query->filterByCanEditSchedules4('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules4 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules4($canEditSchedules4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_4, $canEditSchedules4, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_5 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules5('fooValue');   // WHERE can_view_schedules_5 = 'fooValue'
     * $query->filterByCanViewSchedules5('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules5 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules5($canViewSchedules5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_5, $canViewSchedules5, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_5 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules5('fooValue');   // WHERE can_edit_schedules_5 = 'fooValue'
     * $query->filterByCanEditSchedules5('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules5 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules5($canEditSchedules5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_5, $canEditSchedules5, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_6 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules6('fooValue');   // WHERE can_view_schedules_6 = 'fooValue'
     * $query->filterByCanViewSchedules6('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_6 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules6 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules6($canViewSchedules6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_6, $canViewSchedules6, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_6 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules6('fooValue');   // WHERE can_edit_schedules_6 = 'fooValue'
     * $query->filterByCanEditSchedules6('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_6 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules6 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules6($canEditSchedules6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_6, $canEditSchedules6, $comparison);
    }

    /**
     * Filter the query on the can_view_schedules_7 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewSchedules7('fooValue');   // WHERE can_view_schedules_7 = 'fooValue'
     * $query->filterByCanViewSchedules7('%fooValue%', Criteria::LIKE); // WHERE can_view_schedules_7 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewSchedules7 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules7($canViewSchedules7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules7)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_SCHEDULES_7, $canViewSchedules7, $comparison);
    }

    /**
     * Filter the query on the can_edit_schedules_7 column
     *
     * Example usage:
     * <code>
     * $query->filterByCanEditSchedules7('fooValue');   // WHERE can_edit_schedules_7 = 'fooValue'
     * $query->filterByCanEditSchedules7('%fooValue%', Criteria::LIKE); // WHERE can_edit_schedules_7 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canEditSchedules7 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules7($canEditSchedules7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules7)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_EDIT_SCHEDULES_7, $canEditSchedules7, $comparison);
    }

    /**
     * Filter the query on the can_view_dashboard column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewDashboard('fooValue');   // WHERE can_view_dashboard = 'fooValue'
     * $query->filterByCanViewDashboard('%fooValue%', Criteria::LIKE); // WHERE can_view_dashboard LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewDashboard The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewDashboard($canViewDashboard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewDashboard)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_DASHBOARD, $canViewDashboard, $comparison);
    }

    /**
     * Filter the query on the notify_on_bookings column
     *
     * Example usage:
     * <code>
     * $query->filterByNotifyOnBookings('fooValue');   // WHERE notify_on_bookings = 'fooValue'
     * $query->filterByNotifyOnBookings('%fooValue%', Criteria::LIKE); // WHERE notify_on_bookings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notifyOnBookings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByNotifyOnBookings($notifyOnBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notifyOnBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_NOTIFY_ON_BOOKINGS, $notifyOnBookings, $comparison);
    }

    /**
     * Filter the query on the can_manage_guest_bookings column
     *
     * Example usage:
     * <code>
     * $query->filterByCanManageGuestBookings('fooValue');   // WHERE can_manage_guest_bookings = 'fooValue'
     * $query->filterByCanManageGuestBookings('%fooValue%', Criteria::LIKE); // WHERE can_manage_guest_bookings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canManageGuestBookings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestBookings($canManageGuestBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS, $canManageGuestBookings, $comparison);
    }

    /**
     * Filter the query on the can_manage_guest_forms column
     *
     * Example usage:
     * <code>
     * $query->filterByCanManageGuestForms('fooValue');   // WHERE can_manage_guest_forms = 'fooValue'
     * $query->filterByCanManageGuestForms('%fooValue%', Criteria::LIKE); // WHERE can_manage_guest_forms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canManageGuestForms The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestForms($canManageGuestForms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestForms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_MANAGE_GUEST_FORMS, $canManageGuestForms, $comparison);
    }

    /**
     * Filter the query on the can_view_financial column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewFinancial('fooValue');   // WHERE can_view_financial = 'fooValue'
     * $query->filterByCanViewFinancial('%fooValue%', Criteria::LIKE); // WHERE can_view_financial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewFinancial The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewFinancial($canViewFinancial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewFinancial)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_FINANCIAL, $canViewFinancial, $comparison);
    }

    /**
     * Filter the query on the can_view_today_bookings column
     *
     * Example usage:
     * <code>
     * $query->filterByCanViewTodayBookings('fooValue');   // WHERE can_view_today_bookings = 'fooValue'
     * $query->filterByCanViewTodayBookings('%fooValue%', Criteria::LIKE); // WHERE can_view_today_bookings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canViewTodayBookings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanViewTodayBookings($canViewTodayBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewTodayBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_VIEW_TODAY_BOOKINGS, $canViewTodayBookings, $comparison);
    }

    /**
     * Filter the query on the dashboard_top column
     *
     * Example usage:
     * <code>
     * $query->filterByDashboardTop('fooValue');   // WHERE dashboard_top = 'fooValue'
     * $query->filterByDashboardTop('%fooValue%', Criteria::LIKE); // WHERE dashboard_top LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dashboardTop The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByDashboardTop($dashboardTop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardTop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_DASHBOARD_TOP, $dashboardTop, $comparison);
    }

    /**
     * Filter the query on the dashboard_middle column
     *
     * Example usage:
     * <code>
     * $query->filterByDashboardMiddle('fooValue');   // WHERE dashboard_middle = 'fooValue'
     * $query->filterByDashboardMiddle('%fooValue%', Criteria::LIKE); // WHERE dashboard_middle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dashboardMiddle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByDashboardMiddle($dashboardMiddle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardMiddle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_DASHBOARD_MIDDLE, $dashboardMiddle, $comparison);
    }

    /**
     * Filter the query on the dashboard_bottom column
     *
     * Example usage:
     * <code>
     * $query->filterByDashboardBottom('fooValue');   // WHERE dashboard_bottom = 'fooValue'
     * $query->filterByDashboardBottom('%fooValue%', Criteria::LIKE); // WHERE dashboard_bottom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dashboardBottom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByDashboardBottom($dashboardBottom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardBottom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_DASHBOARD_BOTTOM, $dashboardBottom, $comparison);
    }

    /**
     * Filter the query on the calendar_header_right column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarHeaderRight('fooValue');   // WHERE calendar_header_right = 'fooValue'
     * $query->filterByCalendarHeaderRight('%fooValue%', Criteria::LIKE); // WHERE calendar_header_right LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarHeaderRight The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCalendarHeaderRight($calendarHeaderRight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarHeaderRight)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CALENDAR_HEADER_RIGHT, $calendarHeaderRight, $comparison);
    }

    /**
     * Filter the query on the can_manage_guest_settings column
     *
     * Example usage:
     * <code>
     * $query->filterByCanManageGuestSettings('fooValue');   // WHERE can_manage_guest_settings = 'fooValue'
     * $query->filterByCanManageGuestSettings('%fooValue%', Criteria::LIKE); // WHERE can_manage_guest_settings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canManageGuestSettings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestSettings($canManageGuestSettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestSettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupsTableMap::COL_CAN_MANAGE_GUEST_SETTINGS, $canManageGuestSettings, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Users object
     *
     * @param \TheFarm\Models\Users|ObjectCollection $users the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGroupsQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \TheFarm\Models\Users) {
            return $this
                ->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $users->getGroupId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            return $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \TheFarm\Models\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\TheFarm\Models\UsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGroups $groups Object to remove from the list of results
     *
     * @return $this|ChildGroupsQuery The current query, for fluid interface
     */
    public function prune($groups = null)
    {
        if ($groups) {
            $this->addUsingAlias(GroupsTableMap::COL_GROUP_ID, $groups->getGroupId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_groups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupsTableMap::clearInstancePool();
            GroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GroupsQuery
