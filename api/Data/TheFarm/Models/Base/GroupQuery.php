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
use TheFarm\Models\Group as ChildGroup;
use TheFarm\Models\GroupQuery as ChildGroupQuery;
use TheFarm\Models\Map\GroupTableMap;

/**
 * Base class that represents a query for the 'tf_groups' table.
 *
 *
 *
 * @method     ChildGroupQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildGroupQuery orderByGroupCd($order = Criteria::ASC) Order by the group_cd column
 * @method     ChildGroupQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 * @method     ChildGroupQuery orderByDefaultCalendarView($order = Criteria::ASC) Order by the default_calendar_view column
 * @method     ChildGroupQuery orderByIncludeInProviderList($order = Criteria::ASC) Order by the include_in_provider_list column
 * @method     ChildGroupQuery orderByCanViewOtherProfiles($order = Criteria::ASC) Order by the can_view_other_profiles column
 * @method     ChildGroupQuery orderByCanEditOtherProfiles($order = Criteria::ASC) Order by the can_edit_other_profiles column
 * @method     ChildGroupQuery orderByCanDeleteServices($order = Criteria::ASC) Order by the can_delete_services column
 * @method     ChildGroupQuery orderByCanEditServices($order = Criteria::ASC) Order by the can_edit_services column
 * @method     ChildGroupQuery orderByCanAddSchedule($order = Criteria::ASC) Order by the can_add_schedule column
 * @method     ChildGroupQuery orderByCanAdminGuest($order = Criteria::ASC) Order by the can_admin_guest column
 * @method     ChildGroupQuery orderByCanAdminCalendar($order = Criteria::ASC) Order by the can_admin_calendar column
 * @method     ChildGroupQuery orderByCanAdminProviders($order = Criteria::ASC) Order by the can_admin_providers column
 * @method     ChildGroupQuery orderByCanAdminServices($order = Criteria::ASC) Order by the can_admin_services column
 * @method     ChildGroupQuery orderByCanAdminFacilities($order = Criteria::ASC) Order by the can_admin_facilities column
 * @method     ChildGroupQuery orderByCanAdminActivities($order = Criteria::ASC) Order by the can_admin_activities column
 * @method     ChildGroupQuery orderByCanAdminPackages($order = Criteria::ASC) Order by the can_admin_packages column
 * @method     ChildGroupQuery orderByCanAdminReports($order = Criteria::ASC) Order by the can_admin_reports column
 * @method     ChildGroupQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildGroupQuery orderByForms($order = Criteria::ASC) Order by the forms column
 * @method     ChildGroupQuery orderByCanViewSchedules1($order = Criteria::ASC) Order by the can_view_schedules_1 column
 * @method     ChildGroupQuery orderByCanEditSchedules1($order = Criteria::ASC) Order by the can_edit_schedules_1 column
 * @method     ChildGroupQuery orderByCanViewSchedules2($order = Criteria::ASC) Order by the can_view_schedules_2 column
 * @method     ChildGroupQuery orderByCanEditSchedules2($order = Criteria::ASC) Order by the can_edit_schedules_2 column
 * @method     ChildGroupQuery orderByCanViewSchedules3($order = Criteria::ASC) Order by the can_view_schedules_3 column
 * @method     ChildGroupQuery orderByCanEditSchedules3($order = Criteria::ASC) Order by the can_edit_schedules_3 column
 * @method     ChildGroupQuery orderByIncludeInAuditList($order = Criteria::ASC) Order by the include_in_audit_list column
 * @method     ChildGroupQuery orderByCanEditCompletedForms($order = Criteria::ASC) Order by the can_edit_completed_forms column
 * @method     ChildGroupQuery orderByCanAssignSchedules($order = Criteria::ASC) Order by the can_assign_schedules column
 * @method     ChildGroupQuery orderByCanViewOtherSchedule($order = Criteria::ASC) Order by the can_view_other_schedule column
 * @method     ChildGroupQuery orderByCanViewSchedules4($order = Criteria::ASC) Order by the can_view_schedules_4 column
 * @method     ChildGroupQuery orderByCanEditSchedules4($order = Criteria::ASC) Order by the can_edit_schedules_4 column
 * @method     ChildGroupQuery orderByCanViewSchedules5($order = Criteria::ASC) Order by the can_view_schedules_5 column
 * @method     ChildGroupQuery orderByCanEditSchedules5($order = Criteria::ASC) Order by the can_edit_schedules_5 column
 * @method     ChildGroupQuery orderByCanViewSchedules6($order = Criteria::ASC) Order by the can_view_schedules_6 column
 * @method     ChildGroupQuery orderByCanEditSchedules6($order = Criteria::ASC) Order by the can_edit_schedules_6 column
 * @method     ChildGroupQuery orderByCanViewSchedules7($order = Criteria::ASC) Order by the can_view_schedules_7 column
 * @method     ChildGroupQuery orderByCanEditSchedules7($order = Criteria::ASC) Order by the can_edit_schedules_7 column
 * @method     ChildGroupQuery orderByCanViewDashboard($order = Criteria::ASC) Order by the can_view_dashboard column
 * @method     ChildGroupQuery orderByNotifyOnBookings($order = Criteria::ASC) Order by the notify_on_bookings column
 * @method     ChildGroupQuery orderByCanManageGuestBookings($order = Criteria::ASC) Order by the can_manage_guest_bookings column
 * @method     ChildGroupQuery orderByCanManageGuestForms($order = Criteria::ASC) Order by the can_manage_guest_forms column
 * @method     ChildGroupQuery orderByCanViewFinancial($order = Criteria::ASC) Order by the can_view_financial column
 * @method     ChildGroupQuery orderByCanViewTodayBookings($order = Criteria::ASC) Order by the can_view_today_bookings column
 * @method     ChildGroupQuery orderByDashboardTop($order = Criteria::ASC) Order by the dashboard_top column
 * @method     ChildGroupQuery orderByDashboardMiddle($order = Criteria::ASC) Order by the dashboard_middle column
 * @method     ChildGroupQuery orderByDashboardBottom($order = Criteria::ASC) Order by the dashboard_bottom column
 * @method     ChildGroupQuery orderByCalendarHeaderRight($order = Criteria::ASC) Order by the calendar_header_right column
 * @method     ChildGroupQuery orderByCanManageGuestSettings($order = Criteria::ASC) Order by the can_manage_guest_settings column
 *
 * @method     ChildGroupQuery groupByGroupId() Group by the group_id column
 * @method     ChildGroupQuery groupByGroupCd() Group by the group_cd column
 * @method     ChildGroupQuery groupByGroupName() Group by the group_name column
 * @method     ChildGroupQuery groupByDefaultCalendarView() Group by the default_calendar_view column
 * @method     ChildGroupQuery groupByIncludeInProviderList() Group by the include_in_provider_list column
 * @method     ChildGroupQuery groupByCanViewOtherProfiles() Group by the can_view_other_profiles column
 * @method     ChildGroupQuery groupByCanEditOtherProfiles() Group by the can_edit_other_profiles column
 * @method     ChildGroupQuery groupByCanDeleteServices() Group by the can_delete_services column
 * @method     ChildGroupQuery groupByCanEditServices() Group by the can_edit_services column
 * @method     ChildGroupQuery groupByCanAddSchedule() Group by the can_add_schedule column
 * @method     ChildGroupQuery groupByCanAdminGuest() Group by the can_admin_guest column
 * @method     ChildGroupQuery groupByCanAdminCalendar() Group by the can_admin_calendar column
 * @method     ChildGroupQuery groupByCanAdminProviders() Group by the can_admin_providers column
 * @method     ChildGroupQuery groupByCanAdminServices() Group by the can_admin_services column
 * @method     ChildGroupQuery groupByCanAdminFacilities() Group by the can_admin_facilities column
 * @method     ChildGroupQuery groupByCanAdminActivities() Group by the can_admin_activities column
 * @method     ChildGroupQuery groupByCanAdminPackages() Group by the can_admin_packages column
 * @method     ChildGroupQuery groupByCanAdminReports() Group by the can_admin_reports column
 * @method     ChildGroupQuery groupByLocation() Group by the location column
 * @method     ChildGroupQuery groupByForms() Group by the forms column
 * @method     ChildGroupQuery groupByCanViewSchedules1() Group by the can_view_schedules_1 column
 * @method     ChildGroupQuery groupByCanEditSchedules1() Group by the can_edit_schedules_1 column
 * @method     ChildGroupQuery groupByCanViewSchedules2() Group by the can_view_schedules_2 column
 * @method     ChildGroupQuery groupByCanEditSchedules2() Group by the can_edit_schedules_2 column
 * @method     ChildGroupQuery groupByCanViewSchedules3() Group by the can_view_schedules_3 column
 * @method     ChildGroupQuery groupByCanEditSchedules3() Group by the can_edit_schedules_3 column
 * @method     ChildGroupQuery groupByIncludeInAuditList() Group by the include_in_audit_list column
 * @method     ChildGroupQuery groupByCanEditCompletedForms() Group by the can_edit_completed_forms column
 * @method     ChildGroupQuery groupByCanAssignSchedules() Group by the can_assign_schedules column
 * @method     ChildGroupQuery groupByCanViewOtherSchedule() Group by the can_view_other_schedule column
 * @method     ChildGroupQuery groupByCanViewSchedules4() Group by the can_view_schedules_4 column
 * @method     ChildGroupQuery groupByCanEditSchedules4() Group by the can_edit_schedules_4 column
 * @method     ChildGroupQuery groupByCanViewSchedules5() Group by the can_view_schedules_5 column
 * @method     ChildGroupQuery groupByCanEditSchedules5() Group by the can_edit_schedules_5 column
 * @method     ChildGroupQuery groupByCanViewSchedules6() Group by the can_view_schedules_6 column
 * @method     ChildGroupQuery groupByCanEditSchedules6() Group by the can_edit_schedules_6 column
 * @method     ChildGroupQuery groupByCanViewSchedules7() Group by the can_view_schedules_7 column
 * @method     ChildGroupQuery groupByCanEditSchedules7() Group by the can_edit_schedules_7 column
 * @method     ChildGroupQuery groupByCanViewDashboard() Group by the can_view_dashboard column
 * @method     ChildGroupQuery groupByNotifyOnBookings() Group by the notify_on_bookings column
 * @method     ChildGroupQuery groupByCanManageGuestBookings() Group by the can_manage_guest_bookings column
 * @method     ChildGroupQuery groupByCanManageGuestForms() Group by the can_manage_guest_forms column
 * @method     ChildGroupQuery groupByCanViewFinancial() Group by the can_view_financial column
 * @method     ChildGroupQuery groupByCanViewTodayBookings() Group by the can_view_today_bookings column
 * @method     ChildGroupQuery groupByDashboardTop() Group by the dashboard_top column
 * @method     ChildGroupQuery groupByDashboardMiddle() Group by the dashboard_middle column
 * @method     ChildGroupQuery groupByDashboardBottom() Group by the dashboard_bottom column
 * @method     ChildGroupQuery groupByCalendarHeaderRight() Group by the calendar_header_right column
 * @method     ChildGroupQuery groupByCanManageGuestSettings() Group by the can_manage_guest_settings column
 *
 * @method     ChildGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildGroupQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildGroupQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildGroupQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildGroupQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildGroupQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildGroupQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \TheFarm\Models\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroup findOne(ConnectionInterface $con = null) Return the first ChildGroup matching the query
 * @method     ChildGroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGroup matching the query, or a new ChildGroup object populated from the query conditions when no match is found
 *
 * @method     ChildGroup findOneByGroupId(int $group_id) Return the first ChildGroup filtered by the group_id column
 * @method     ChildGroup findOneByGroupCd(string $group_cd) Return the first ChildGroup filtered by the group_cd column
 * @method     ChildGroup findOneByGroupName(string $group_name) Return the first ChildGroup filtered by the group_name column
 * @method     ChildGroup findOneByDefaultCalendarView(string $default_calendar_view) Return the first ChildGroup filtered by the default_calendar_view column
 * @method     ChildGroup findOneByIncludeInProviderList(string $include_in_provider_list) Return the first ChildGroup filtered by the include_in_provider_list column
 * @method     ChildGroup findOneByCanViewOtherProfiles(string $can_view_other_profiles) Return the first ChildGroup filtered by the can_view_other_profiles column
 * @method     ChildGroup findOneByCanEditOtherProfiles(string $can_edit_other_profiles) Return the first ChildGroup filtered by the can_edit_other_profiles column
 * @method     ChildGroup findOneByCanDeleteServices(string $can_delete_services) Return the first ChildGroup filtered by the can_delete_services column
 * @method     ChildGroup findOneByCanEditServices(string $can_edit_services) Return the first ChildGroup filtered by the can_edit_services column
 * @method     ChildGroup findOneByCanAddSchedule(string $can_add_schedule) Return the first ChildGroup filtered by the can_add_schedule column
 * @method     ChildGroup findOneByCanAdminGuest(string $can_admin_guest) Return the first ChildGroup filtered by the can_admin_guest column
 * @method     ChildGroup findOneByCanAdminCalendar(string $can_admin_calendar) Return the first ChildGroup filtered by the can_admin_calendar column
 * @method     ChildGroup findOneByCanAdminProviders(string $can_admin_providers) Return the first ChildGroup filtered by the can_admin_providers column
 * @method     ChildGroup findOneByCanAdminServices(string $can_admin_services) Return the first ChildGroup filtered by the can_admin_services column
 * @method     ChildGroup findOneByCanAdminFacilities(string $can_admin_facilities) Return the first ChildGroup filtered by the can_admin_facilities column
 * @method     ChildGroup findOneByCanAdminActivities(string $can_admin_activities) Return the first ChildGroup filtered by the can_admin_activities column
 * @method     ChildGroup findOneByCanAdminPackages(string $can_admin_packages) Return the first ChildGroup filtered by the can_admin_packages column
 * @method     ChildGroup findOneByCanAdminReports(string $can_admin_reports) Return the first ChildGroup filtered by the can_admin_reports column
 * @method     ChildGroup findOneByLocation(string $location) Return the first ChildGroup filtered by the location column
 * @method     ChildGroup findOneByForms(string $forms) Return the first ChildGroup filtered by the forms column
 * @method     ChildGroup findOneByCanViewSchedules1(string $can_view_schedules_1) Return the first ChildGroup filtered by the can_view_schedules_1 column
 * @method     ChildGroup findOneByCanEditSchedules1(string $can_edit_schedules_1) Return the first ChildGroup filtered by the can_edit_schedules_1 column
 * @method     ChildGroup findOneByCanViewSchedules2(string $can_view_schedules_2) Return the first ChildGroup filtered by the can_view_schedules_2 column
 * @method     ChildGroup findOneByCanEditSchedules2(string $can_edit_schedules_2) Return the first ChildGroup filtered by the can_edit_schedules_2 column
 * @method     ChildGroup findOneByCanViewSchedules3(string $can_view_schedules_3) Return the first ChildGroup filtered by the can_view_schedules_3 column
 * @method     ChildGroup findOneByCanEditSchedules3(string $can_edit_schedules_3) Return the first ChildGroup filtered by the can_edit_schedules_3 column
 * @method     ChildGroup findOneByIncludeInAuditList(string $include_in_audit_list) Return the first ChildGroup filtered by the include_in_audit_list column
 * @method     ChildGroup findOneByCanEditCompletedForms(string $can_edit_completed_forms) Return the first ChildGroup filtered by the can_edit_completed_forms column
 * @method     ChildGroup findOneByCanAssignSchedules(string $can_assign_schedules) Return the first ChildGroup filtered by the can_assign_schedules column
 * @method     ChildGroup findOneByCanViewOtherSchedule(string $can_view_other_schedule) Return the first ChildGroup filtered by the can_view_other_schedule column
 * @method     ChildGroup findOneByCanViewSchedules4(string $can_view_schedules_4) Return the first ChildGroup filtered by the can_view_schedules_4 column
 * @method     ChildGroup findOneByCanEditSchedules4(string $can_edit_schedules_4) Return the first ChildGroup filtered by the can_edit_schedules_4 column
 * @method     ChildGroup findOneByCanViewSchedules5(string $can_view_schedules_5) Return the first ChildGroup filtered by the can_view_schedules_5 column
 * @method     ChildGroup findOneByCanEditSchedules5(string $can_edit_schedules_5) Return the first ChildGroup filtered by the can_edit_schedules_5 column
 * @method     ChildGroup findOneByCanViewSchedules6(string $can_view_schedules_6) Return the first ChildGroup filtered by the can_view_schedules_6 column
 * @method     ChildGroup findOneByCanEditSchedules6(string $can_edit_schedules_6) Return the first ChildGroup filtered by the can_edit_schedules_6 column
 * @method     ChildGroup findOneByCanViewSchedules7(string $can_view_schedules_7) Return the first ChildGroup filtered by the can_view_schedules_7 column
 * @method     ChildGroup findOneByCanEditSchedules7(string $can_edit_schedules_7) Return the first ChildGroup filtered by the can_edit_schedules_7 column
 * @method     ChildGroup findOneByCanViewDashboard(string $can_view_dashboard) Return the first ChildGroup filtered by the can_view_dashboard column
 * @method     ChildGroup findOneByNotifyOnBookings(string $notify_on_bookings) Return the first ChildGroup filtered by the notify_on_bookings column
 * @method     ChildGroup findOneByCanManageGuestBookings(string $can_manage_guest_bookings) Return the first ChildGroup filtered by the can_manage_guest_bookings column
 * @method     ChildGroup findOneByCanManageGuestForms(string $can_manage_guest_forms) Return the first ChildGroup filtered by the can_manage_guest_forms column
 * @method     ChildGroup findOneByCanViewFinancial(string $can_view_financial) Return the first ChildGroup filtered by the can_view_financial column
 * @method     ChildGroup findOneByCanViewTodayBookings(string $can_view_today_bookings) Return the first ChildGroup filtered by the can_view_today_bookings column
 * @method     ChildGroup findOneByDashboardTop(string $dashboard_top) Return the first ChildGroup filtered by the dashboard_top column
 * @method     ChildGroup findOneByDashboardMiddle(string $dashboard_middle) Return the first ChildGroup filtered by the dashboard_middle column
 * @method     ChildGroup findOneByDashboardBottom(string $dashboard_bottom) Return the first ChildGroup filtered by the dashboard_bottom column
 * @method     ChildGroup findOneByCalendarHeaderRight(string $calendar_header_right) Return the first ChildGroup filtered by the calendar_header_right column
 * @method     ChildGroup findOneByCanManageGuestSettings(string $can_manage_guest_settings) Return the first ChildGroup filtered by the can_manage_guest_settings column *

 * @method     ChildGroup requirePk($key, ConnectionInterface $con = null) Return the ChildGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOne(ConnectionInterface $con = null) Return the first ChildGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroup requireOneByGroupId(int $group_id) Return the first ChildGroup filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByGroupCd(string $group_cd) Return the first ChildGroup filtered by the group_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByGroupName(string $group_name) Return the first ChildGroup filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByDefaultCalendarView(string $default_calendar_view) Return the first ChildGroup filtered by the default_calendar_view column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByIncludeInProviderList(string $include_in_provider_list) Return the first ChildGroup filtered by the include_in_provider_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewOtherProfiles(string $can_view_other_profiles) Return the first ChildGroup filtered by the can_view_other_profiles column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditOtherProfiles(string $can_edit_other_profiles) Return the first ChildGroup filtered by the can_edit_other_profiles column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanDeleteServices(string $can_delete_services) Return the first ChildGroup filtered by the can_delete_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditServices(string $can_edit_services) Return the first ChildGroup filtered by the can_edit_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAddSchedule(string $can_add_schedule) Return the first ChildGroup filtered by the can_add_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminGuest(string $can_admin_guest) Return the first ChildGroup filtered by the can_admin_guest column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminCalendar(string $can_admin_calendar) Return the first ChildGroup filtered by the can_admin_calendar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminProviders(string $can_admin_providers) Return the first ChildGroup filtered by the can_admin_providers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminServices(string $can_admin_services) Return the first ChildGroup filtered by the can_admin_services column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminFacilities(string $can_admin_facilities) Return the first ChildGroup filtered by the can_admin_facilities column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminActivities(string $can_admin_activities) Return the first ChildGroup filtered by the can_admin_activities column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminPackages(string $can_admin_packages) Return the first ChildGroup filtered by the can_admin_packages column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAdminReports(string $can_admin_reports) Return the first ChildGroup filtered by the can_admin_reports column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByLocation(string $location) Return the first ChildGroup filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByForms(string $forms) Return the first ChildGroup filtered by the forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules1(string $can_view_schedules_1) Return the first ChildGroup filtered by the can_view_schedules_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules1(string $can_edit_schedules_1) Return the first ChildGroup filtered by the can_edit_schedules_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules2(string $can_view_schedules_2) Return the first ChildGroup filtered by the can_view_schedules_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules2(string $can_edit_schedules_2) Return the first ChildGroup filtered by the can_edit_schedules_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules3(string $can_view_schedules_3) Return the first ChildGroup filtered by the can_view_schedules_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules3(string $can_edit_schedules_3) Return the first ChildGroup filtered by the can_edit_schedules_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByIncludeInAuditList(string $include_in_audit_list) Return the first ChildGroup filtered by the include_in_audit_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditCompletedForms(string $can_edit_completed_forms) Return the first ChildGroup filtered by the can_edit_completed_forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanAssignSchedules(string $can_assign_schedules) Return the first ChildGroup filtered by the can_assign_schedules column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewOtherSchedule(string $can_view_other_schedule) Return the first ChildGroup filtered by the can_view_other_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules4(string $can_view_schedules_4) Return the first ChildGroup filtered by the can_view_schedules_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules4(string $can_edit_schedules_4) Return the first ChildGroup filtered by the can_edit_schedules_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules5(string $can_view_schedules_5) Return the first ChildGroup filtered by the can_view_schedules_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules5(string $can_edit_schedules_5) Return the first ChildGroup filtered by the can_edit_schedules_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules6(string $can_view_schedules_6) Return the first ChildGroup filtered by the can_view_schedules_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules6(string $can_edit_schedules_6) Return the first ChildGroup filtered by the can_edit_schedules_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewSchedules7(string $can_view_schedules_7) Return the first ChildGroup filtered by the can_view_schedules_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanEditSchedules7(string $can_edit_schedules_7) Return the first ChildGroup filtered by the can_edit_schedules_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewDashboard(string $can_view_dashboard) Return the first ChildGroup filtered by the can_view_dashboard column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByNotifyOnBookings(string $notify_on_bookings) Return the first ChildGroup filtered by the notify_on_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanManageGuestBookings(string $can_manage_guest_bookings) Return the first ChildGroup filtered by the can_manage_guest_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanManageGuestForms(string $can_manage_guest_forms) Return the first ChildGroup filtered by the can_manage_guest_forms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewFinancial(string $can_view_financial) Return the first ChildGroup filtered by the can_view_financial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanViewTodayBookings(string $can_view_today_bookings) Return the first ChildGroup filtered by the can_view_today_bookings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByDashboardTop(string $dashboard_top) Return the first ChildGroup filtered by the dashboard_top column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByDashboardMiddle(string $dashboard_middle) Return the first ChildGroup filtered by the dashboard_middle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByDashboardBottom(string $dashboard_bottom) Return the first ChildGroup filtered by the dashboard_bottom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCalendarHeaderRight(string $calendar_header_right) Return the first ChildGroup filtered by the calendar_header_right column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroup requireOneByCanManageGuestSettings(string $can_manage_guest_settings) Return the first ChildGroup filtered by the can_manage_guest_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGroup objects based on current ModelCriteria
 * @method     ChildGroup[]|ObjectCollection findByGroupId(int $group_id) Return ChildGroup objects filtered by the group_id column
 * @method     ChildGroup[]|ObjectCollection findByGroupCd(string $group_cd) Return ChildGroup objects filtered by the group_cd column
 * @method     ChildGroup[]|ObjectCollection findByGroupName(string $group_name) Return ChildGroup objects filtered by the group_name column
 * @method     ChildGroup[]|ObjectCollection findByDefaultCalendarView(string $default_calendar_view) Return ChildGroup objects filtered by the default_calendar_view column
 * @method     ChildGroup[]|ObjectCollection findByIncludeInProviderList(string $include_in_provider_list) Return ChildGroup objects filtered by the include_in_provider_list column
 * @method     ChildGroup[]|ObjectCollection findByCanViewOtherProfiles(string $can_view_other_profiles) Return ChildGroup objects filtered by the can_view_other_profiles column
 * @method     ChildGroup[]|ObjectCollection findByCanEditOtherProfiles(string $can_edit_other_profiles) Return ChildGroup objects filtered by the can_edit_other_profiles column
 * @method     ChildGroup[]|ObjectCollection findByCanDeleteServices(string $can_delete_services) Return ChildGroup objects filtered by the can_delete_services column
 * @method     ChildGroup[]|ObjectCollection findByCanEditServices(string $can_edit_services) Return ChildGroup objects filtered by the can_edit_services column
 * @method     ChildGroup[]|ObjectCollection findByCanAddSchedule(string $can_add_schedule) Return ChildGroup objects filtered by the can_add_schedule column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminGuest(string $can_admin_guest) Return ChildGroup objects filtered by the can_admin_guest column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminCalendar(string $can_admin_calendar) Return ChildGroup objects filtered by the can_admin_calendar column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminProviders(string $can_admin_providers) Return ChildGroup objects filtered by the can_admin_providers column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminServices(string $can_admin_services) Return ChildGroup objects filtered by the can_admin_services column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminFacilities(string $can_admin_facilities) Return ChildGroup objects filtered by the can_admin_facilities column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminActivities(string $can_admin_activities) Return ChildGroup objects filtered by the can_admin_activities column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminPackages(string $can_admin_packages) Return ChildGroup objects filtered by the can_admin_packages column
 * @method     ChildGroup[]|ObjectCollection findByCanAdminReports(string $can_admin_reports) Return ChildGroup objects filtered by the can_admin_reports column
 * @method     ChildGroup[]|ObjectCollection findByLocation(string $location) Return ChildGroup objects filtered by the location column
 * @method     ChildGroup[]|ObjectCollection findByForms(string $forms) Return ChildGroup objects filtered by the forms column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules1(string $can_view_schedules_1) Return ChildGroup objects filtered by the can_view_schedules_1 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules1(string $can_edit_schedules_1) Return ChildGroup objects filtered by the can_edit_schedules_1 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules2(string $can_view_schedules_2) Return ChildGroup objects filtered by the can_view_schedules_2 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules2(string $can_edit_schedules_2) Return ChildGroup objects filtered by the can_edit_schedules_2 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules3(string $can_view_schedules_3) Return ChildGroup objects filtered by the can_view_schedules_3 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules3(string $can_edit_schedules_3) Return ChildGroup objects filtered by the can_edit_schedules_3 column
 * @method     ChildGroup[]|ObjectCollection findByIncludeInAuditList(string $include_in_audit_list) Return ChildGroup objects filtered by the include_in_audit_list column
 * @method     ChildGroup[]|ObjectCollection findByCanEditCompletedForms(string $can_edit_completed_forms) Return ChildGroup objects filtered by the can_edit_completed_forms column
 * @method     ChildGroup[]|ObjectCollection findByCanAssignSchedules(string $can_assign_schedules) Return ChildGroup objects filtered by the can_assign_schedules column
 * @method     ChildGroup[]|ObjectCollection findByCanViewOtherSchedule(string $can_view_other_schedule) Return ChildGroup objects filtered by the can_view_other_schedule column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules4(string $can_view_schedules_4) Return ChildGroup objects filtered by the can_view_schedules_4 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules4(string $can_edit_schedules_4) Return ChildGroup objects filtered by the can_edit_schedules_4 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules5(string $can_view_schedules_5) Return ChildGroup objects filtered by the can_view_schedules_5 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules5(string $can_edit_schedules_5) Return ChildGroup objects filtered by the can_edit_schedules_5 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules6(string $can_view_schedules_6) Return ChildGroup objects filtered by the can_view_schedules_6 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules6(string $can_edit_schedules_6) Return ChildGroup objects filtered by the can_edit_schedules_6 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewSchedules7(string $can_view_schedules_7) Return ChildGroup objects filtered by the can_view_schedules_7 column
 * @method     ChildGroup[]|ObjectCollection findByCanEditSchedules7(string $can_edit_schedules_7) Return ChildGroup objects filtered by the can_edit_schedules_7 column
 * @method     ChildGroup[]|ObjectCollection findByCanViewDashboard(string $can_view_dashboard) Return ChildGroup objects filtered by the can_view_dashboard column
 * @method     ChildGroup[]|ObjectCollection findByNotifyOnBookings(string $notify_on_bookings) Return ChildGroup objects filtered by the notify_on_bookings column
 * @method     ChildGroup[]|ObjectCollection findByCanManageGuestBookings(string $can_manage_guest_bookings) Return ChildGroup objects filtered by the can_manage_guest_bookings column
 * @method     ChildGroup[]|ObjectCollection findByCanManageGuestForms(string $can_manage_guest_forms) Return ChildGroup objects filtered by the can_manage_guest_forms column
 * @method     ChildGroup[]|ObjectCollection findByCanViewFinancial(string $can_view_financial) Return ChildGroup objects filtered by the can_view_financial column
 * @method     ChildGroup[]|ObjectCollection findByCanViewTodayBookings(string $can_view_today_bookings) Return ChildGroup objects filtered by the can_view_today_bookings column
 * @method     ChildGroup[]|ObjectCollection findByDashboardTop(string $dashboard_top) Return ChildGroup objects filtered by the dashboard_top column
 * @method     ChildGroup[]|ObjectCollection findByDashboardMiddle(string $dashboard_middle) Return ChildGroup objects filtered by the dashboard_middle column
 * @method     ChildGroup[]|ObjectCollection findByDashboardBottom(string $dashboard_bottom) Return ChildGroup objects filtered by the dashboard_bottom column
 * @method     ChildGroup[]|ObjectCollection findByCalendarHeaderRight(string $calendar_header_right) Return ChildGroup objects filtered by the calendar_header_right column
 * @method     ChildGroup[]|ObjectCollection findByCanManageGuestSettings(string $can_manage_guest_settings) Return ChildGroup objects filtered by the can_manage_guest_settings column
 * @method     ChildGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\GroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Group', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGroupQuery) {
            return $criteria;
        }
        $query = new ChildGroupQuery();
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
     * @return ChildGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGroup A model object, or null if the key is not found
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
            /** @var ChildGroup $obj */
            $obj = new ChildGroup();
            $obj->hydrate($row);
            GroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGroup|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $groupId, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByGroupCd($groupCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_CD, $groupCd, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByGroupName($groupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_GROUP_NAME, $groupName, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByDefaultCalendarView($defaultCalendarView = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($defaultCalendarView)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_DEFAULT_CALENDAR_VIEW, $defaultCalendarView, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByIncludeInProviderList($includeInProviderList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInProviderList)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_INCLUDE_IN_PROVIDER_LIST, $includeInProviderList, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewOtherProfiles($canViewOtherProfiles = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewOtherProfiles)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_OTHER_PROFILES, $canViewOtherProfiles, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditOtherProfiles($canEditOtherProfiles = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditOtherProfiles)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_OTHER_PROFILES, $canEditOtherProfiles, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanDeleteServices($canDeleteServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canDeleteServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_DELETE_SERVICES, $canDeleteServices, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditServices($canEditServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SERVICES, $canEditServices, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAddSchedule($canAddSchedule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAddSchedule)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADD_SCHEDULE, $canAddSchedule, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminGuest($canAdminGuest = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminGuest)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_GUEST, $canAdminGuest, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminCalendar($canAdminCalendar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminCalendar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_CALENDAR, $canAdminCalendar, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminProviders($canAdminProviders = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminProviders)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_PROVIDERS, $canAdminProviders, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminServices($canAdminServices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminServices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_SERVICES, $canAdminServices, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminFacilities($canAdminFacilities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminFacilities)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_FACILITIES, $canAdminFacilities, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminActivities($canAdminActivities = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminActivities)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_ACTIVITIES, $canAdminActivities, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminPackages($canAdminPackages = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminPackages)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_PACKAGES, $canAdminPackages, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAdminReports($canAdminReports = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAdminReports)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ADMIN_REPORTS, $canAdminReports, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_LOCATION, $location, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByForms($forms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($forms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_FORMS, $forms, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules1($canViewSchedules1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_1, $canViewSchedules1, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules1($canEditSchedules1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_1, $canEditSchedules1, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules2($canViewSchedules2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_2, $canViewSchedules2, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules2($canEditSchedules2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_2, $canEditSchedules2, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules3($canViewSchedules3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_3, $canViewSchedules3, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules3($canEditSchedules3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_3, $canEditSchedules3, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByIncludeInAuditList($includeInAuditList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInAuditList)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_INCLUDE_IN_AUDIT_LIST, $includeInAuditList, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditCompletedForms($canEditCompletedForms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditCompletedForms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_COMPLETED_FORMS, $canEditCompletedForms, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanAssignSchedules($canAssignSchedules = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canAssignSchedules)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_ASSIGN_SCHEDULES, $canAssignSchedules, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewOtherSchedule($canViewOtherSchedule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewOtherSchedule)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_OTHER_SCHEDULE, $canViewOtherSchedule, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules4($canViewSchedules4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_4, $canViewSchedules4, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules4($canEditSchedules4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_4, $canEditSchedules4, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules5($canViewSchedules5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_5, $canViewSchedules5, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules5($canEditSchedules5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_5, $canEditSchedules5, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules6($canViewSchedules6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_6, $canViewSchedules6, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules6($canEditSchedules6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_6, $canEditSchedules6, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewSchedules7($canViewSchedules7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewSchedules7)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_SCHEDULES_7, $canViewSchedules7, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanEditSchedules7($canEditSchedules7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canEditSchedules7)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_EDIT_SCHEDULES_7, $canEditSchedules7, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewDashboard($canViewDashboard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewDashboard)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_DASHBOARD, $canViewDashboard, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByNotifyOnBookings($notifyOnBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notifyOnBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_NOTIFY_ON_BOOKINGS, $notifyOnBookings, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestBookings($canManageGuestBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS, $canManageGuestBookings, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestForms($canManageGuestForms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestForms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_MANAGE_GUEST_FORMS, $canManageGuestForms, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewFinancial($canViewFinancial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewFinancial)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_FINANCIAL, $canViewFinancial, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanViewTodayBookings($canViewTodayBookings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canViewTodayBookings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_VIEW_TODAY_BOOKINGS, $canViewTodayBookings, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByDashboardTop($dashboardTop = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardTop)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_DASHBOARD_TOP, $dashboardTop, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByDashboardMiddle($dashboardMiddle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardMiddle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_DASHBOARD_MIDDLE, $dashboardMiddle, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByDashboardBottom($dashboardBottom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dashboardBottom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_DASHBOARD_BOTTOM, $dashboardBottom, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCalendarHeaderRight($calendarHeaderRight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarHeaderRight)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CALENDAR_HEADER_RIGHT, $calendarHeaderRight, $comparison);
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
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function filterByCanManageGuestSettings($canManageGuestSettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canManageGuestSettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupTableMap::COL_CAN_MANAGE_GUEST_SETTINGS, $canManageGuestSettings, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGroupQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(GroupTableMap::COL_GROUP_ID, $user->getGroupId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\TheFarm\Models\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGroup $group Object to remove from the list of results
     *
     * @return $this|ChildGroupQuery The current query, for fluid interface
     */
    public function prune($group = null)
    {
        if ($group) {
            $this->addUsingAlias(GroupTableMap::COL_GROUP_ID, $group->getGroupId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupTableMap::clearInstancePool();
            GroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GroupQuery
