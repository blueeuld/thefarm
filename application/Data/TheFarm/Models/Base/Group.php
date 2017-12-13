<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use TheFarm\Models\Group as ChildGroup;
use TheFarm\Models\GroupQuery as ChildGroupQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\GroupTableMap;
use TheFarm\Models\Map\UserTableMap;

/**
 * Base class that represents a row from the 'tf_groups' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Group implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\GroupTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the group_id field.
     *
     * @var        int
     */
    protected $group_id;

    /**
     * The value for the group_cd field.
     *
     * @var        string
     */
    protected $group_cd;

    /**
     * The value for the group_name field.
     *
     * @var        string
     */
    protected $group_name;

    /**
     * The value for the default_calendar_view field.
     *
     * @var        string
     */
    protected $default_calendar_view;

    /**
     * The value for the include_in_provider_list field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $include_in_provider_list;

    /**
     * The value for the can_view_other_profiles field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_other_profiles;

    /**
     * The value for the can_edit_other_profiles field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_other_profiles;

    /**
     * The value for the can_delete_services field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_delete_services;

    /**
     * The value for the can_edit_services field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_services;

    /**
     * The value for the can_add_schedule field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $can_add_schedule;

    /**
     * The value for the can_admin_guest field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_guest;

    /**
     * The value for the can_admin_calendar field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_calendar;

    /**
     * The value for the can_admin_providers field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_providers;

    /**
     * The value for the can_admin_services field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_services;

    /**
     * The value for the can_admin_facilities field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_facilities;

    /**
     * The value for the can_admin_activities field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_activities;

    /**
     * The value for the can_admin_packages field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_packages;

    /**
     * The value for the can_admin_reports field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_admin_reports;

    /**
     * The value for the location field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $location;

    /**
     * The value for the forms field.
     *
     * @var        string
     */
    protected $forms;

    /**
     * The value for the can_view_schedules_1 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_1;

    /**
     * The value for the can_edit_schedules_1 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_1;

    /**
     * The value for the can_view_schedules_2 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_2;

    /**
     * The value for the can_edit_schedules_2 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_2;

    /**
     * The value for the can_view_schedules_3 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_3;

    /**
     * The value for the can_edit_schedules_3 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_3;

    /**
     * The value for the include_in_audit_list field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $include_in_audit_list;

    /**
     * The value for the can_edit_completed_forms field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_completed_forms;

    /**
     * The value for the can_assign_schedules field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_assign_schedules;

    /**
     * The value for the can_view_other_schedule field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_other_schedule;

    /**
     * The value for the can_view_schedules_4 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_4;

    /**
     * The value for the can_edit_schedules_4 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_4;

    /**
     * The value for the can_view_schedules_5 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_5;

    /**
     * The value for the can_edit_schedules_5 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_5;

    /**
     * The value for the can_view_schedules_6 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_6;

    /**
     * The value for the can_edit_schedules_6 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_6;

    /**
     * The value for the can_view_schedules_7 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_schedules_7;

    /**
     * The value for the can_edit_schedules_7 field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_edit_schedules_7;

    /**
     * The value for the can_view_dashboard field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_dashboard;

    /**
     * The value for the notify_on_bookings field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $notify_on_bookings;

    /**
     * The value for the can_manage_guest_bookings field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_manage_guest_bookings;

    /**
     * The value for the can_manage_guest_forms field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_manage_guest_forms;

    /**
     * The value for the can_view_financial field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_financial;

    /**
     * The value for the can_view_today_bookings field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_view_today_bookings;

    /**
     * The value for the dashboard_top field.
     *
     * @var        string
     */
    protected $dashboard_top;

    /**
     * The value for the dashboard_middle field.
     *
     * @var        string
     */
    protected $dashboard_middle;

    /**
     * The value for the dashboard_bottom field.
     *
     * @var        string
     */
    protected $dashboard_bottom;

    /**
     * The value for the calendar_header_right field.
     *
     * @var        string
     */
    protected $calendar_header_right;

    /**
     * The value for the can_manage_guest_settings field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $can_manage_guest_settings;

    /**
     * @var        ObjectCollection|ChildUser[] Collection to store aggregation of ChildUser objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->include_in_provider_list = 'n';
        $this->can_view_other_profiles = 'n';
        $this->can_edit_other_profiles = 'n';
        $this->can_delete_services = 'n';
        $this->can_edit_services = 'n';
        $this->can_add_schedule = 'y';
        $this->can_admin_guest = 'n';
        $this->can_admin_calendar = 'n';
        $this->can_admin_providers = 'n';
        $this->can_admin_services = 'n';
        $this->can_admin_facilities = 'n';
        $this->can_admin_activities = 'n';
        $this->can_admin_packages = 'n';
        $this->can_admin_reports = 'n';
        $this->location = '';
        $this->can_view_schedules_1 = 'n';
        $this->can_edit_schedules_1 = 'n';
        $this->can_view_schedules_2 = 'n';
        $this->can_edit_schedules_2 = 'n';
        $this->can_view_schedules_3 = 'n';
        $this->can_edit_schedules_3 = 'n';
        $this->include_in_audit_list = 'n';
        $this->can_edit_completed_forms = 'n';
        $this->can_assign_schedules = 'n';
        $this->can_view_other_schedule = 'n';
        $this->can_view_schedules_4 = 'n';
        $this->can_edit_schedules_4 = 'n';
        $this->can_view_schedules_5 = 'n';
        $this->can_edit_schedules_5 = 'n';
        $this->can_view_schedules_6 = 'n';
        $this->can_edit_schedules_6 = 'n';
        $this->can_view_schedules_7 = 'n';
        $this->can_edit_schedules_7 = 'n';
        $this->can_view_dashboard = 'n';
        $this->notify_on_bookings = 'n';
        $this->can_manage_guest_bookings = 'n';
        $this->can_manage_guest_forms = 'n';
        $this->can_view_financial = 'n';
        $this->can_view_today_bookings = 'n';
        $this->can_manage_guest_settings = 'n';
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Group object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Group</code> instance.  If
     * <code>obj</code> is an instance of <code>Group</code>, delegates to
     * <code>equals(Group)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Group The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [group_id] column value.
     *
     * @return int
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Get the [group_cd] column value.
     *
     * @return string
     */
    public function getGroupCd()
    {
        return $this->group_cd;
    }

    /**
     * Get the [group_name] column value.
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * Get the [default_calendar_view] column value.
     *
     * @return string
     */
    public function getDefaultCalendarView()
    {
        return $this->default_calendar_view;
    }

    /**
     * Get the [include_in_provider_list] column value.
     *
     * @return string
     */
    public function getIncludeInProviderList()
    {
        return $this->include_in_provider_list;
    }

    /**
     * Get the [can_view_other_profiles] column value.
     *
     * @return string
     */
    public function getCanViewOtherProfiles()
    {
        return $this->can_view_other_profiles;
    }

    /**
     * Get the [can_edit_other_profiles] column value.
     *
     * @return string
     */
    public function getCanEditOtherProfiles()
    {
        return $this->can_edit_other_profiles;
    }

    /**
     * Get the [can_delete_services] column value.
     *
     * @return string
     */
    public function getCanDeleteServices()
    {
        return $this->can_delete_services;
    }

    /**
     * Get the [can_edit_services] column value.
     *
     * @return string
     */
    public function getCanEditServices()
    {
        return $this->can_edit_services;
    }

    /**
     * Get the [can_add_schedule] column value.
     *
     * @return string
     */
    public function getCanAddSchedule()
    {
        return $this->can_add_schedule;
    }

    /**
     * Get the [can_admin_guest] column value.
     *
     * @return string
     */
    public function getCanAdminGuest()
    {
        return $this->can_admin_guest;
    }

    /**
     * Get the [can_admin_calendar] column value.
     *
     * @return string
     */
    public function getCanAdminCalendar()
    {
        return $this->can_admin_calendar;
    }

    /**
     * Get the [can_admin_providers] column value.
     *
     * @return string
     */
    public function getCanAdminProviders()
    {
        return $this->can_admin_providers;
    }

    /**
     * Get the [can_admin_services] column value.
     *
     * @return string
     */
    public function getCanAdminServices()
    {
        return $this->can_admin_services;
    }

    /**
     * Get the [can_admin_facilities] column value.
     *
     * @return string
     */
    public function getCanAdminFacilities()
    {
        return $this->can_admin_facilities;
    }

    /**
     * Get the [can_admin_activities] column value.
     *
     * @return string
     */
    public function getCanAdminActivities()
    {
        return $this->can_admin_activities;
    }

    /**
     * Get the [can_admin_packages] column value.
     *
     * @return string
     */
    public function getCanAdminPackages()
    {
        return $this->can_admin_packages;
    }

    /**
     * Get the [can_admin_reports] column value.
     *
     * @return string
     */
    public function getCanAdminReports()
    {
        return $this->can_admin_reports;
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [forms] column value.
     *
     * @return string
     */
    public function getForms()
    {
        return $this->forms;
    }

    /**
     * Get the [can_view_schedules_1] column value.
     *
     * @return string
     */
    public function getCanViewSchedules1()
    {
        return $this->can_view_schedules_1;
    }

    /**
     * Get the [can_edit_schedules_1] column value.
     *
     * @return string
     */
    public function getCanEditSchedules1()
    {
        return $this->can_edit_schedules_1;
    }

    /**
     * Get the [can_view_schedules_2] column value.
     *
     * @return string
     */
    public function getCanViewSchedules2()
    {
        return $this->can_view_schedules_2;
    }

    /**
     * Get the [can_edit_schedules_2] column value.
     *
     * @return string
     */
    public function getCanEditSchedules2()
    {
        return $this->can_edit_schedules_2;
    }

    /**
     * Get the [can_view_schedules_3] column value.
     *
     * @return string
     */
    public function getCanViewSchedules3()
    {
        return $this->can_view_schedules_3;
    }

    /**
     * Get the [can_edit_schedules_3] column value.
     *
     * @return string
     */
    public function getCanEditSchedules3()
    {
        return $this->can_edit_schedules_3;
    }

    /**
     * Get the [include_in_audit_list] column value.
     *
     * @return string
     */
    public function getIncludeInAuditList()
    {
        return $this->include_in_audit_list;
    }

    /**
     * Get the [can_edit_completed_forms] column value.
     *
     * @return string
     */
    public function getCanEditCompletedForms()
    {
        return $this->can_edit_completed_forms;
    }

    /**
     * Get the [can_assign_schedules] column value.
     *
     * @return string
     */
    public function getCanAssignSchedules()
    {
        return $this->can_assign_schedules;
    }

    /**
     * Get the [can_view_other_schedule] column value.
     *
     * @return string
     */
    public function getCanViewOtherSchedule()
    {
        return $this->can_view_other_schedule;
    }

    /**
     * Get the [can_view_schedules_4] column value.
     *
     * @return string
     */
    public function getCanViewSchedules4()
    {
        return $this->can_view_schedules_4;
    }

    /**
     * Get the [can_edit_schedules_4] column value.
     *
     * @return string
     */
    public function getCanEditSchedules4()
    {
        return $this->can_edit_schedules_4;
    }

    /**
     * Get the [can_view_schedules_5] column value.
     *
     * @return string
     */
    public function getCanViewSchedules5()
    {
        return $this->can_view_schedules_5;
    }

    /**
     * Get the [can_edit_schedules_5] column value.
     *
     * @return string
     */
    public function getCanEditSchedules5()
    {
        return $this->can_edit_schedules_5;
    }

    /**
     * Get the [can_view_schedules_6] column value.
     *
     * @return string
     */
    public function getCanViewSchedules6()
    {
        return $this->can_view_schedules_6;
    }

    /**
     * Get the [can_edit_schedules_6] column value.
     *
     * @return string
     */
    public function getCanEditSchedules6()
    {
        return $this->can_edit_schedules_6;
    }

    /**
     * Get the [can_view_schedules_7] column value.
     *
     * @return string
     */
    public function getCanViewSchedules7()
    {
        return $this->can_view_schedules_7;
    }

    /**
     * Get the [can_edit_schedules_7] column value.
     *
     * @return string
     */
    public function getCanEditSchedules7()
    {
        return $this->can_edit_schedules_7;
    }

    /**
     * Get the [can_view_dashboard] column value.
     *
     * @return string
     */
    public function getCanViewDashboard()
    {
        return $this->can_view_dashboard;
    }

    /**
     * Get the [notify_on_bookings] column value.
     *
     * @return string
     */
    public function getNotifyOnBookings()
    {
        return $this->notify_on_bookings;
    }

    /**
     * Get the [can_manage_guest_bookings] column value.
     *
     * @return string
     */
    public function getCanManageGuestBookings()
    {
        return $this->can_manage_guest_bookings;
    }

    /**
     * Get the [can_manage_guest_forms] column value.
     *
     * @return string
     */
    public function getCanManageGuestForms()
    {
        return $this->can_manage_guest_forms;
    }

    /**
     * Get the [can_view_financial] column value.
     *
     * @return string
     */
    public function getCanViewFinancial()
    {
        return $this->can_view_financial;
    }

    /**
     * Get the [can_view_today_bookings] column value.
     *
     * @return string
     */
    public function getCanViewTodayBookings()
    {
        return $this->can_view_today_bookings;
    }

    /**
     * Get the [dashboard_top] column value.
     *
     * @return string
     */
    public function getDashboardTop()
    {
        return $this->dashboard_top;
    }

    /**
     * Get the [dashboard_middle] column value.
     *
     * @return string
     */
    public function getDashboardMiddle()
    {
        return $this->dashboard_middle;
    }

    /**
     * Get the [dashboard_bottom] column value.
     *
     * @return string
     */
    public function getDashboardBottom()
    {
        return $this->dashboard_bottom;
    }

    /**
     * Get the [calendar_header_right] column value.
     *
     * @return string
     */
    public function getCalendarHeaderRight()
    {
        return $this->calendar_header_right;
    }

    /**
     * Get the [can_manage_guest_settings] column value.
     *
     * @return string
     */
    public function getCanManageGuestSettings()
    {
        return $this->can_manage_guest_settings;
    }

    /**
     * Set the value of [group_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setGroupId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->group_id !== $v) {
            $this->group_id = $v;
            $this->modifiedColumns[GroupTableMap::COL_GROUP_ID] = true;
        }

        return $this;
    } // setGroupId()

    /**
     * Set the value of [group_cd] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setGroupCd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_cd !== $v) {
            $this->group_cd = $v;
            $this->modifiedColumns[GroupTableMap::COL_GROUP_CD] = true;
        }

        return $this;
    } // setGroupCd()

    /**
     * Set the value of [group_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setGroupName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_name !== $v) {
            $this->group_name = $v;
            $this->modifiedColumns[GroupTableMap::COL_GROUP_NAME] = true;
        }

        return $this;
    } // setGroupName()

    /**
     * Set the value of [default_calendar_view] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setDefaultCalendarView($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->default_calendar_view !== $v) {
            $this->default_calendar_view = $v;
            $this->modifiedColumns[GroupTableMap::COL_DEFAULT_CALENDAR_VIEW] = true;
        }

        return $this;
    } // setDefaultCalendarView()

    /**
     * Set the value of [include_in_provider_list] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setIncludeInProviderList($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->include_in_provider_list !== $v) {
            $this->include_in_provider_list = $v;
            $this->modifiedColumns[GroupTableMap::COL_INCLUDE_IN_PROVIDER_LIST] = true;
        }

        return $this;
    } // setIncludeInProviderList()

    /**
     * Set the value of [can_view_other_profiles] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewOtherProfiles($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_other_profiles !== $v) {
            $this->can_view_other_profiles = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_OTHER_PROFILES] = true;
        }

        return $this;
    } // setCanViewOtherProfiles()

    /**
     * Set the value of [can_edit_other_profiles] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditOtherProfiles($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_other_profiles !== $v) {
            $this->can_edit_other_profiles = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_OTHER_PROFILES] = true;
        }

        return $this;
    } // setCanEditOtherProfiles()

    /**
     * Set the value of [can_delete_services] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanDeleteServices($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_delete_services !== $v) {
            $this->can_delete_services = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_DELETE_SERVICES] = true;
        }

        return $this;
    } // setCanDeleteServices()

    /**
     * Set the value of [can_edit_services] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditServices($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_services !== $v) {
            $this->can_edit_services = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SERVICES] = true;
        }

        return $this;
    } // setCanEditServices()

    /**
     * Set the value of [can_add_schedule] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAddSchedule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_add_schedule !== $v) {
            $this->can_add_schedule = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADD_SCHEDULE] = true;
        }

        return $this;
    } // setCanAddSchedule()

    /**
     * Set the value of [can_admin_guest] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminGuest($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_guest !== $v) {
            $this->can_admin_guest = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_GUEST] = true;
        }

        return $this;
    } // setCanAdminGuest()

    /**
     * Set the value of [can_admin_calendar] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminCalendar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_calendar !== $v) {
            $this->can_admin_calendar = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_CALENDAR] = true;
        }

        return $this;
    } // setCanAdminCalendar()

    /**
     * Set the value of [can_admin_providers] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminProviders($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_providers !== $v) {
            $this->can_admin_providers = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_PROVIDERS] = true;
        }

        return $this;
    } // setCanAdminProviders()

    /**
     * Set the value of [can_admin_services] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminServices($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_services !== $v) {
            $this->can_admin_services = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_SERVICES] = true;
        }

        return $this;
    } // setCanAdminServices()

    /**
     * Set the value of [can_admin_facilities] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminFacilities($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_facilities !== $v) {
            $this->can_admin_facilities = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_FACILITIES] = true;
        }

        return $this;
    } // setCanAdminFacilities()

    /**
     * Set the value of [can_admin_activities] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminActivities($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_activities !== $v) {
            $this->can_admin_activities = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_ACTIVITIES] = true;
        }

        return $this;
    } // setCanAdminActivities()

    /**
     * Set the value of [can_admin_packages] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminPackages($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_packages !== $v) {
            $this->can_admin_packages = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_PACKAGES] = true;
        }

        return $this;
    } // setCanAdminPackages()

    /**
     * Set the value of [can_admin_reports] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAdminReports($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_admin_reports !== $v) {
            $this->can_admin_reports = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ADMIN_REPORTS] = true;
        }

        return $this;
    } // setCanAdminReports()

    /**
     * Set the value of [location] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[GroupTableMap::COL_LOCATION] = true;
        }

        return $this;
    } // setLocation()

    /**
     * Set the value of [forms] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setForms($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->forms !== $v) {
            $this->forms = $v;
            $this->modifiedColumns[GroupTableMap::COL_FORMS] = true;
        }

        return $this;
    } // setForms()

    /**
     * Set the value of [can_view_schedules_1] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_1 !== $v) {
            $this->can_view_schedules_1 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_1] = true;
        }

        return $this;
    } // setCanViewSchedules1()

    /**
     * Set the value of [can_edit_schedules_1] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_1 !== $v) {
            $this->can_edit_schedules_1 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_1] = true;
        }

        return $this;
    } // setCanEditSchedules1()

    /**
     * Set the value of [can_view_schedules_2] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_2 !== $v) {
            $this->can_view_schedules_2 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_2] = true;
        }

        return $this;
    } // setCanViewSchedules2()

    /**
     * Set the value of [can_edit_schedules_2] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_2 !== $v) {
            $this->can_edit_schedules_2 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_2] = true;
        }

        return $this;
    } // setCanEditSchedules2()

    /**
     * Set the value of [can_view_schedules_3] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_3 !== $v) {
            $this->can_view_schedules_3 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_3] = true;
        }

        return $this;
    } // setCanViewSchedules3()

    /**
     * Set the value of [can_edit_schedules_3] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_3 !== $v) {
            $this->can_edit_schedules_3 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_3] = true;
        }

        return $this;
    } // setCanEditSchedules3()

    /**
     * Set the value of [include_in_audit_list] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setIncludeInAuditList($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->include_in_audit_list !== $v) {
            $this->include_in_audit_list = $v;
            $this->modifiedColumns[GroupTableMap::COL_INCLUDE_IN_AUDIT_LIST] = true;
        }

        return $this;
    } // setIncludeInAuditList()

    /**
     * Set the value of [can_edit_completed_forms] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditCompletedForms($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_completed_forms !== $v) {
            $this->can_edit_completed_forms = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_COMPLETED_FORMS] = true;
        }

        return $this;
    } // setCanEditCompletedForms()

    /**
     * Set the value of [can_assign_schedules] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanAssignSchedules($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_assign_schedules !== $v) {
            $this->can_assign_schedules = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_ASSIGN_SCHEDULES] = true;
        }

        return $this;
    } // setCanAssignSchedules()

    /**
     * Set the value of [can_view_other_schedule] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewOtherSchedule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_other_schedule !== $v) {
            $this->can_view_other_schedule = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_OTHER_SCHEDULE] = true;
        }

        return $this;
    } // setCanViewOtherSchedule()

    /**
     * Set the value of [can_view_schedules_4] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_4 !== $v) {
            $this->can_view_schedules_4 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_4] = true;
        }

        return $this;
    } // setCanViewSchedules4()

    /**
     * Set the value of [can_edit_schedules_4] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_4 !== $v) {
            $this->can_edit_schedules_4 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_4] = true;
        }

        return $this;
    } // setCanEditSchedules4()

    /**
     * Set the value of [can_view_schedules_5] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_5 !== $v) {
            $this->can_view_schedules_5 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_5] = true;
        }

        return $this;
    } // setCanViewSchedules5()

    /**
     * Set the value of [can_edit_schedules_5] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_5 !== $v) {
            $this->can_edit_schedules_5 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_5] = true;
        }

        return $this;
    } // setCanEditSchedules5()

    /**
     * Set the value of [can_view_schedules_6] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules6($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_6 !== $v) {
            $this->can_view_schedules_6 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_6] = true;
        }

        return $this;
    } // setCanViewSchedules6()

    /**
     * Set the value of [can_edit_schedules_6] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules6($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_6 !== $v) {
            $this->can_edit_schedules_6 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_6] = true;
        }

        return $this;
    } // setCanEditSchedules6()

    /**
     * Set the value of [can_view_schedules_7] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewSchedules7($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_schedules_7 !== $v) {
            $this->can_view_schedules_7 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_SCHEDULES_7] = true;
        }

        return $this;
    } // setCanViewSchedules7()

    /**
     * Set the value of [can_edit_schedules_7] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanEditSchedules7($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_edit_schedules_7 !== $v) {
            $this->can_edit_schedules_7 = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_EDIT_SCHEDULES_7] = true;
        }

        return $this;
    } // setCanEditSchedules7()

    /**
     * Set the value of [can_view_dashboard] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewDashboard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_dashboard !== $v) {
            $this->can_view_dashboard = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_DASHBOARD] = true;
        }

        return $this;
    } // setCanViewDashboard()

    /**
     * Set the value of [notify_on_bookings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setNotifyOnBookings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notify_on_bookings !== $v) {
            $this->notify_on_bookings = $v;
            $this->modifiedColumns[GroupTableMap::COL_NOTIFY_ON_BOOKINGS] = true;
        }

        return $this;
    } // setNotifyOnBookings()

    /**
     * Set the value of [can_manage_guest_bookings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanManageGuestBookings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_manage_guest_bookings !== $v) {
            $this->can_manage_guest_bookings = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS] = true;
        }

        return $this;
    } // setCanManageGuestBookings()

    /**
     * Set the value of [can_manage_guest_forms] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanManageGuestForms($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_manage_guest_forms !== $v) {
            $this->can_manage_guest_forms = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_MANAGE_GUEST_FORMS] = true;
        }

        return $this;
    } // setCanManageGuestForms()

    /**
     * Set the value of [can_view_financial] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewFinancial($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_financial !== $v) {
            $this->can_view_financial = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_FINANCIAL] = true;
        }

        return $this;
    } // setCanViewFinancial()

    /**
     * Set the value of [can_view_today_bookings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanViewTodayBookings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_view_today_bookings !== $v) {
            $this->can_view_today_bookings = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_VIEW_TODAY_BOOKINGS] = true;
        }

        return $this;
    } // setCanViewTodayBookings()

    /**
     * Set the value of [dashboard_top] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setDashboardTop($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dashboard_top !== $v) {
            $this->dashboard_top = $v;
            $this->modifiedColumns[GroupTableMap::COL_DASHBOARD_TOP] = true;
        }

        return $this;
    } // setDashboardTop()

    /**
     * Set the value of [dashboard_middle] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setDashboardMiddle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dashboard_middle !== $v) {
            $this->dashboard_middle = $v;
            $this->modifiedColumns[GroupTableMap::COL_DASHBOARD_MIDDLE] = true;
        }

        return $this;
    } // setDashboardMiddle()

    /**
     * Set the value of [dashboard_bottom] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setDashboardBottom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dashboard_bottom !== $v) {
            $this->dashboard_bottom = $v;
            $this->modifiedColumns[GroupTableMap::COL_DASHBOARD_BOTTOM] = true;
        }

        return $this;
    } // setDashboardBottom()

    /**
     * Set the value of [calendar_header_right] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCalendarHeaderRight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_header_right !== $v) {
            $this->calendar_header_right = $v;
            $this->modifiedColumns[GroupTableMap::COL_CALENDAR_HEADER_RIGHT] = true;
        }

        return $this;
    } // setCalendarHeaderRight()

    /**
     * Set the value of [can_manage_guest_settings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function setCanManageGuestSettings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->can_manage_guest_settings !== $v) {
            $this->can_manage_guest_settings = $v;
            $this->modifiedColumns[GroupTableMap::COL_CAN_MANAGE_GUEST_SETTINGS] = true;
        }

        return $this;
    } // setCanManageGuestSettings()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->include_in_provider_list !== 'n') {
                return false;
            }

            if ($this->can_view_other_profiles !== 'n') {
                return false;
            }

            if ($this->can_edit_other_profiles !== 'n') {
                return false;
            }

            if ($this->can_delete_services !== 'n') {
                return false;
            }

            if ($this->can_edit_services !== 'n') {
                return false;
            }

            if ($this->can_add_schedule !== 'y') {
                return false;
            }

            if ($this->can_admin_guest !== 'n') {
                return false;
            }

            if ($this->can_admin_calendar !== 'n') {
                return false;
            }

            if ($this->can_admin_providers !== 'n') {
                return false;
            }

            if ($this->can_admin_services !== 'n') {
                return false;
            }

            if ($this->can_admin_facilities !== 'n') {
                return false;
            }

            if ($this->can_admin_activities !== 'n') {
                return false;
            }

            if ($this->can_admin_packages !== 'n') {
                return false;
            }

            if ($this->can_admin_reports !== 'n') {
                return false;
            }

            if ($this->location !== '') {
                return false;
            }

            if ($this->can_view_schedules_1 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_1 !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_2 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_2 !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_3 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_3 !== 'n') {
                return false;
            }

            if ($this->include_in_audit_list !== 'n') {
                return false;
            }

            if ($this->can_edit_completed_forms !== 'n') {
                return false;
            }

            if ($this->can_assign_schedules !== 'n') {
                return false;
            }

            if ($this->can_view_other_schedule !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_4 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_4 !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_5 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_5 !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_6 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_6 !== 'n') {
                return false;
            }

            if ($this->can_view_schedules_7 !== 'n') {
                return false;
            }

            if ($this->can_edit_schedules_7 !== 'n') {
                return false;
            }

            if ($this->can_view_dashboard !== 'n') {
                return false;
            }

            if ($this->notify_on_bookings !== 'n') {
                return false;
            }

            if ($this->can_manage_guest_bookings !== 'n') {
                return false;
            }

            if ($this->can_manage_guest_forms !== 'n') {
                return false;
            }

            if ($this->can_view_financial !== 'n') {
                return false;
            }

            if ($this->can_view_today_bookings !== 'n') {
                return false;
            }

            if ($this->can_manage_guest_settings !== 'n') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GroupTableMap::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GroupTableMap::translateFieldName('GroupCd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_cd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GroupTableMap::translateFieldName('GroupName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GroupTableMap::translateFieldName('DefaultCalendarView', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_calendar_view = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GroupTableMap::translateFieldName('IncludeInProviderList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->include_in_provider_list = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GroupTableMap::translateFieldName('CanViewOtherProfiles', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_other_profiles = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GroupTableMap::translateFieldName('CanEditOtherProfiles', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_other_profiles = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : GroupTableMap::translateFieldName('CanDeleteServices', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_delete_services = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : GroupTableMap::translateFieldName('CanEditServices', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_services = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : GroupTableMap::translateFieldName('CanAddSchedule', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_add_schedule = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : GroupTableMap::translateFieldName('CanAdminGuest', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_guest = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : GroupTableMap::translateFieldName('CanAdminCalendar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_calendar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : GroupTableMap::translateFieldName('CanAdminProviders', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_providers = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : GroupTableMap::translateFieldName('CanAdminServices', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_services = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : GroupTableMap::translateFieldName('CanAdminFacilities', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_facilities = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : GroupTableMap::translateFieldName('CanAdminActivities', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_activities = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : GroupTableMap::translateFieldName('CanAdminPackages', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_packages = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : GroupTableMap::translateFieldName('CanAdminReports', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_admin_reports = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : GroupTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : GroupTableMap::translateFieldName('Forms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->forms = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : GroupTableMap::translateFieldName('IncludeInAuditList', TableMap::TYPE_PHPNAME, $indexType)];
            $this->include_in_audit_list = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : GroupTableMap::translateFieldName('CanEditCompletedForms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_completed_forms = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : GroupTableMap::translateFieldName('CanAssignSchedules', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_assign_schedules = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : GroupTableMap::translateFieldName('CanViewOtherSchedule', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_other_schedule = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_4 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_4 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_6 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_6 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : GroupTableMap::translateFieldName('CanViewSchedules7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_schedules_7 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : GroupTableMap::translateFieldName('CanEditSchedules7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_edit_schedules_7 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : GroupTableMap::translateFieldName('CanViewDashboard', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_dashboard = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : GroupTableMap::translateFieldName('NotifyOnBookings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notify_on_bookings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : GroupTableMap::translateFieldName('CanManageGuestBookings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_manage_guest_bookings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : GroupTableMap::translateFieldName('CanManageGuestForms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_manage_guest_forms = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : GroupTableMap::translateFieldName('CanViewFinancial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_financial = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : GroupTableMap::translateFieldName('CanViewTodayBookings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_view_today_bookings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : GroupTableMap::translateFieldName('DashboardTop', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dashboard_top = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : GroupTableMap::translateFieldName('DashboardMiddle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dashboard_middle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : GroupTableMap::translateFieldName('DashboardBottom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dashboard_bottom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : GroupTableMap::translateFieldName('CalendarHeaderRight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_header_right = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : GroupTableMap::translateFieldName('CanManageGuestSettings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_manage_guest_settings = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 49; // 49 = GroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Group'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Group::setDeleted()
     * @see Group::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGroupQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                GroupTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersScheduledForDeletion as $user) {
                        // need to save related object because we set the relation to null
                        $user->save($con);
                    }
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[GroupTableMap::COL_GROUP_ID] = true;
        if (null !== $this->group_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GroupTableMap::COL_GROUP_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GroupTableMap::COL_GROUP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'group_id';
        }
        if ($this->isColumnModified(GroupTableMap::COL_GROUP_CD)) {
            $modifiedColumns[':p' . $index++]  = 'group_cd';
        }
        if ($this->isColumnModified(GroupTableMap::COL_GROUP_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'group_name';
        }
        if ($this->isColumnModified(GroupTableMap::COL_DEFAULT_CALENDAR_VIEW)) {
            $modifiedColumns[':p' . $index++]  = 'default_calendar_view';
        }
        if ($this->isColumnModified(GroupTableMap::COL_INCLUDE_IN_PROVIDER_LIST)) {
            $modifiedColumns[':p' . $index++]  = 'include_in_provider_list';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_OTHER_PROFILES)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_other_profiles';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_OTHER_PROFILES)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_other_profiles';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_DELETE_SERVICES)) {
            $modifiedColumns[':p' . $index++]  = 'can_delete_services';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SERVICES)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_services';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADD_SCHEDULE)) {
            $modifiedColumns[':p' . $index++]  = 'can_add_schedule';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_GUEST)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_guest';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_CALENDAR)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_calendar';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_PROVIDERS)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_providers';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_SERVICES)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_services';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_FACILITIES)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_facilities';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_ACTIVITIES)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_activities';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_PACKAGES)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_packages';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_REPORTS)) {
            $modifiedColumns[':p' . $index++]  = 'can_admin_reports';
        }
        if ($this->isColumnModified(GroupTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(GroupTableMap::COL_FORMS)) {
            $modifiedColumns[':p' . $index++]  = 'forms';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_1)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_1';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_1)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_1';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_2)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_2';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_2)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_2';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_3)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_3';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_3)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_3';
        }
        if ($this->isColumnModified(GroupTableMap::COL_INCLUDE_IN_AUDIT_LIST)) {
            $modifiedColumns[':p' . $index++]  = 'include_in_audit_list';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_COMPLETED_FORMS)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_completed_forms';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ASSIGN_SCHEDULES)) {
            $modifiedColumns[':p' . $index++]  = 'can_assign_schedules';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_OTHER_SCHEDULE)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_other_schedule';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_4)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_4';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_4)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_4';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_5)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_5';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_5)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_5';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_6)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_6';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_6)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_6';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_7)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_schedules_7';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_7)) {
            $modifiedColumns[':p' . $index++]  = 'can_edit_schedules_7';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_DASHBOARD)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_dashboard';
        }
        if ($this->isColumnModified(GroupTableMap::COL_NOTIFY_ON_BOOKINGS)) {
            $modifiedColumns[':p' . $index++]  = 'notify_on_bookings';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS)) {
            $modifiedColumns[':p' . $index++]  = 'can_manage_guest_bookings';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_FORMS)) {
            $modifiedColumns[':p' . $index++]  = 'can_manage_guest_forms';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_FINANCIAL)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_financial';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_TODAY_BOOKINGS)) {
            $modifiedColumns[':p' . $index++]  = 'can_view_today_bookings';
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_TOP)) {
            $modifiedColumns[':p' . $index++]  = 'dashboard_top';
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_MIDDLE)) {
            $modifiedColumns[':p' . $index++]  = 'dashboard_middle';
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_BOTTOM)) {
            $modifiedColumns[':p' . $index++]  = 'dashboard_bottom';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CALENDAR_HEADER_RIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_header_right';
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_SETTINGS)) {
            $modifiedColumns[':p' . $index++]  = 'can_manage_guest_settings';
        }

        $sql = sprintf(
            'INSERT INTO tf_groups (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'group_id':
                        $stmt->bindValue($identifier, $this->group_id, PDO::PARAM_INT);
                        break;
                    case 'group_cd':
                        $stmt->bindValue($identifier, $this->group_cd, PDO::PARAM_STR);
                        break;
                    case 'group_name':
                        $stmt->bindValue($identifier, $this->group_name, PDO::PARAM_STR);
                        break;
                    case 'default_calendar_view':
                        $stmt->bindValue($identifier, $this->default_calendar_view, PDO::PARAM_STR);
                        break;
                    case 'include_in_provider_list':
                        $stmt->bindValue($identifier, $this->include_in_provider_list, PDO::PARAM_STR);
                        break;
                    case 'can_view_other_profiles':
                        $stmt->bindValue($identifier, $this->can_view_other_profiles, PDO::PARAM_STR);
                        break;
                    case 'can_edit_other_profiles':
                        $stmt->bindValue($identifier, $this->can_edit_other_profiles, PDO::PARAM_STR);
                        break;
                    case 'can_delete_services':
                        $stmt->bindValue($identifier, $this->can_delete_services, PDO::PARAM_STR);
                        break;
                    case 'can_edit_services':
                        $stmt->bindValue($identifier, $this->can_edit_services, PDO::PARAM_STR);
                        break;
                    case 'can_add_schedule':
                        $stmt->bindValue($identifier, $this->can_add_schedule, PDO::PARAM_STR);
                        break;
                    case 'can_admin_guest':
                        $stmt->bindValue($identifier, $this->can_admin_guest, PDO::PARAM_STR);
                        break;
                    case 'can_admin_calendar':
                        $stmt->bindValue($identifier, $this->can_admin_calendar, PDO::PARAM_STR);
                        break;
                    case 'can_admin_providers':
                        $stmt->bindValue($identifier, $this->can_admin_providers, PDO::PARAM_STR);
                        break;
                    case 'can_admin_services':
                        $stmt->bindValue($identifier, $this->can_admin_services, PDO::PARAM_STR);
                        break;
                    case 'can_admin_facilities':
                        $stmt->bindValue($identifier, $this->can_admin_facilities, PDO::PARAM_STR);
                        break;
                    case 'can_admin_activities':
                        $stmt->bindValue($identifier, $this->can_admin_activities, PDO::PARAM_STR);
                        break;
                    case 'can_admin_packages':
                        $stmt->bindValue($identifier, $this->can_admin_packages, PDO::PARAM_STR);
                        break;
                    case 'can_admin_reports':
                        $stmt->bindValue($identifier, $this->can_admin_reports, PDO::PARAM_STR);
                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
                        break;
                    case 'forms':
                        $stmt->bindValue($identifier, $this->forms, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_1':
                        $stmt->bindValue($identifier, $this->can_view_schedules_1, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_1':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_1, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_2':
                        $stmt->bindValue($identifier, $this->can_view_schedules_2, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_2':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_2, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_3':
                        $stmt->bindValue($identifier, $this->can_view_schedules_3, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_3':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_3, PDO::PARAM_STR);
                        break;
                    case 'include_in_audit_list':
                        $stmt->bindValue($identifier, $this->include_in_audit_list, PDO::PARAM_STR);
                        break;
                    case 'can_edit_completed_forms':
                        $stmt->bindValue($identifier, $this->can_edit_completed_forms, PDO::PARAM_STR);
                        break;
                    case 'can_assign_schedules':
                        $stmt->bindValue($identifier, $this->can_assign_schedules, PDO::PARAM_STR);
                        break;
                    case 'can_view_other_schedule':
                        $stmt->bindValue($identifier, $this->can_view_other_schedule, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_4':
                        $stmt->bindValue($identifier, $this->can_view_schedules_4, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_4':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_4, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_5':
                        $stmt->bindValue($identifier, $this->can_view_schedules_5, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_5':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_5, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_6':
                        $stmt->bindValue($identifier, $this->can_view_schedules_6, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_6':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_6, PDO::PARAM_STR);
                        break;
                    case 'can_view_schedules_7':
                        $stmt->bindValue($identifier, $this->can_view_schedules_7, PDO::PARAM_STR);
                        break;
                    case 'can_edit_schedules_7':
                        $stmt->bindValue($identifier, $this->can_edit_schedules_7, PDO::PARAM_STR);
                        break;
                    case 'can_view_dashboard':
                        $stmt->bindValue($identifier, $this->can_view_dashboard, PDO::PARAM_STR);
                        break;
                    case 'notify_on_bookings':
                        $stmt->bindValue($identifier, $this->notify_on_bookings, PDO::PARAM_STR);
                        break;
                    case 'can_manage_guest_bookings':
                        $stmt->bindValue($identifier, $this->can_manage_guest_bookings, PDO::PARAM_STR);
                        break;
                    case 'can_manage_guest_forms':
                        $stmt->bindValue($identifier, $this->can_manage_guest_forms, PDO::PARAM_STR);
                        break;
                    case 'can_view_financial':
                        $stmt->bindValue($identifier, $this->can_view_financial, PDO::PARAM_STR);
                        break;
                    case 'can_view_today_bookings':
                        $stmt->bindValue($identifier, $this->can_view_today_bookings, PDO::PARAM_STR);
                        break;
                    case 'dashboard_top':
                        $stmt->bindValue($identifier, $this->dashboard_top, PDO::PARAM_STR);
                        break;
                    case 'dashboard_middle':
                        $stmt->bindValue($identifier, $this->dashboard_middle, PDO::PARAM_STR);
                        break;
                    case 'dashboard_bottom':
                        $stmt->bindValue($identifier, $this->dashboard_bottom, PDO::PARAM_STR);
                        break;
                    case 'calendar_header_right':
                        $stmt->bindValue($identifier, $this->calendar_header_right, PDO::PARAM_STR);
                        break;
                    case 'can_manage_guest_settings':
                        $stmt->bindValue($identifier, $this->can_manage_guest_settings, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setGroupId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = GroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getGroupId();
                break;
            case 1:
                return $this->getGroupCd();
                break;
            case 2:
                return $this->getGroupName();
                break;
            case 3:
                return $this->getDefaultCalendarView();
                break;
            case 4:
                return $this->getIncludeInProviderList();
                break;
            case 5:
                return $this->getCanViewOtherProfiles();
                break;
            case 6:
                return $this->getCanEditOtherProfiles();
                break;
            case 7:
                return $this->getCanDeleteServices();
                break;
            case 8:
                return $this->getCanEditServices();
                break;
            case 9:
                return $this->getCanAddSchedule();
                break;
            case 10:
                return $this->getCanAdminGuest();
                break;
            case 11:
                return $this->getCanAdminCalendar();
                break;
            case 12:
                return $this->getCanAdminProviders();
                break;
            case 13:
                return $this->getCanAdminServices();
                break;
            case 14:
                return $this->getCanAdminFacilities();
                break;
            case 15:
                return $this->getCanAdminActivities();
                break;
            case 16:
                return $this->getCanAdminPackages();
                break;
            case 17:
                return $this->getCanAdminReports();
                break;
            case 18:
                return $this->getLocation();
                break;
            case 19:
                return $this->getForms();
                break;
            case 20:
                return $this->getCanViewSchedules1();
                break;
            case 21:
                return $this->getCanEditSchedules1();
                break;
            case 22:
                return $this->getCanViewSchedules2();
                break;
            case 23:
                return $this->getCanEditSchedules2();
                break;
            case 24:
                return $this->getCanViewSchedules3();
                break;
            case 25:
                return $this->getCanEditSchedules3();
                break;
            case 26:
                return $this->getIncludeInAuditList();
                break;
            case 27:
                return $this->getCanEditCompletedForms();
                break;
            case 28:
                return $this->getCanAssignSchedules();
                break;
            case 29:
                return $this->getCanViewOtherSchedule();
                break;
            case 30:
                return $this->getCanViewSchedules4();
                break;
            case 31:
                return $this->getCanEditSchedules4();
                break;
            case 32:
                return $this->getCanViewSchedules5();
                break;
            case 33:
                return $this->getCanEditSchedules5();
                break;
            case 34:
                return $this->getCanViewSchedules6();
                break;
            case 35:
                return $this->getCanEditSchedules6();
                break;
            case 36:
                return $this->getCanViewSchedules7();
                break;
            case 37:
                return $this->getCanEditSchedules7();
                break;
            case 38:
                return $this->getCanViewDashboard();
                break;
            case 39:
                return $this->getNotifyOnBookings();
                break;
            case 40:
                return $this->getCanManageGuestBookings();
                break;
            case 41:
                return $this->getCanManageGuestForms();
                break;
            case 42:
                return $this->getCanViewFinancial();
                break;
            case 43:
                return $this->getCanViewTodayBookings();
                break;
            case 44:
                return $this->getDashboardTop();
                break;
            case 45:
                return $this->getDashboardMiddle();
                break;
            case 46:
                return $this->getDashboardBottom();
                break;
            case 47:
                return $this->getCalendarHeaderRight();
                break;
            case 48:
                return $this->getCanManageGuestSettings();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Group'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Group'][$this->hashCode()] = true;
        $keys = GroupTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getGroupId(),
            $keys[1] => $this->getGroupCd(),
            $keys[2] => $this->getGroupName(),
            $keys[3] => $this->getDefaultCalendarView(),
            $keys[4] => $this->getIncludeInProviderList(),
            $keys[5] => $this->getCanViewOtherProfiles(),
            $keys[6] => $this->getCanEditOtherProfiles(),
            $keys[7] => $this->getCanDeleteServices(),
            $keys[8] => $this->getCanEditServices(),
            $keys[9] => $this->getCanAddSchedule(),
            $keys[10] => $this->getCanAdminGuest(),
            $keys[11] => $this->getCanAdminCalendar(),
            $keys[12] => $this->getCanAdminProviders(),
            $keys[13] => $this->getCanAdminServices(),
            $keys[14] => $this->getCanAdminFacilities(),
            $keys[15] => $this->getCanAdminActivities(),
            $keys[16] => $this->getCanAdminPackages(),
            $keys[17] => $this->getCanAdminReports(),
            $keys[18] => $this->getLocation(),
            $keys[19] => $this->getForms(),
            $keys[20] => $this->getCanViewSchedules1(),
            $keys[21] => $this->getCanEditSchedules1(),
            $keys[22] => $this->getCanViewSchedules2(),
            $keys[23] => $this->getCanEditSchedules2(),
            $keys[24] => $this->getCanViewSchedules3(),
            $keys[25] => $this->getCanEditSchedules3(),
            $keys[26] => $this->getIncludeInAuditList(),
            $keys[27] => $this->getCanEditCompletedForms(),
            $keys[28] => $this->getCanAssignSchedules(),
            $keys[29] => $this->getCanViewOtherSchedule(),
            $keys[30] => $this->getCanViewSchedules4(),
            $keys[31] => $this->getCanEditSchedules4(),
            $keys[32] => $this->getCanViewSchedules5(),
            $keys[33] => $this->getCanEditSchedules5(),
            $keys[34] => $this->getCanViewSchedules6(),
            $keys[35] => $this->getCanEditSchedules6(),
            $keys[36] => $this->getCanViewSchedules7(),
            $keys[37] => $this->getCanEditSchedules7(),
            $keys[38] => $this->getCanViewDashboard(),
            $keys[39] => $this->getNotifyOnBookings(),
            $keys[40] => $this->getCanManageGuestBookings(),
            $keys[41] => $this->getCanManageGuestForms(),
            $keys[42] => $this->getCanViewFinancial(),
            $keys[43] => $this->getCanViewTodayBookings(),
            $keys[44] => $this->getDashboardTop(),
            $keys[45] => $this->getDashboardMiddle(),
            $keys[46] => $this->getDashboardBottom(),
            $keys[47] => $this->getCalendarHeaderRight(),
            $keys[48] => $this->getCanManageGuestSettings(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->collUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\TheFarm\Models\Group
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = GroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Group
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setGroupId($value);
                break;
            case 1:
                $this->setGroupCd($value);
                break;
            case 2:
                $this->setGroupName($value);
                break;
            case 3:
                $this->setDefaultCalendarView($value);
                break;
            case 4:
                $this->setIncludeInProviderList($value);
                break;
            case 5:
                $this->setCanViewOtherProfiles($value);
                break;
            case 6:
                $this->setCanEditOtherProfiles($value);
                break;
            case 7:
                $this->setCanDeleteServices($value);
                break;
            case 8:
                $this->setCanEditServices($value);
                break;
            case 9:
                $this->setCanAddSchedule($value);
                break;
            case 10:
                $this->setCanAdminGuest($value);
                break;
            case 11:
                $this->setCanAdminCalendar($value);
                break;
            case 12:
                $this->setCanAdminProviders($value);
                break;
            case 13:
                $this->setCanAdminServices($value);
                break;
            case 14:
                $this->setCanAdminFacilities($value);
                break;
            case 15:
                $this->setCanAdminActivities($value);
                break;
            case 16:
                $this->setCanAdminPackages($value);
                break;
            case 17:
                $this->setCanAdminReports($value);
                break;
            case 18:
                $this->setLocation($value);
                break;
            case 19:
                $this->setForms($value);
                break;
            case 20:
                $this->setCanViewSchedules1($value);
                break;
            case 21:
                $this->setCanEditSchedules1($value);
                break;
            case 22:
                $this->setCanViewSchedules2($value);
                break;
            case 23:
                $this->setCanEditSchedules2($value);
                break;
            case 24:
                $this->setCanViewSchedules3($value);
                break;
            case 25:
                $this->setCanEditSchedules3($value);
                break;
            case 26:
                $this->setIncludeInAuditList($value);
                break;
            case 27:
                $this->setCanEditCompletedForms($value);
                break;
            case 28:
                $this->setCanAssignSchedules($value);
                break;
            case 29:
                $this->setCanViewOtherSchedule($value);
                break;
            case 30:
                $this->setCanViewSchedules4($value);
                break;
            case 31:
                $this->setCanEditSchedules4($value);
                break;
            case 32:
                $this->setCanViewSchedules5($value);
                break;
            case 33:
                $this->setCanEditSchedules5($value);
                break;
            case 34:
                $this->setCanViewSchedules6($value);
                break;
            case 35:
                $this->setCanEditSchedules6($value);
                break;
            case 36:
                $this->setCanViewSchedules7($value);
                break;
            case 37:
                $this->setCanEditSchedules7($value);
                break;
            case 38:
                $this->setCanViewDashboard($value);
                break;
            case 39:
                $this->setNotifyOnBookings($value);
                break;
            case 40:
                $this->setCanManageGuestBookings($value);
                break;
            case 41:
                $this->setCanManageGuestForms($value);
                break;
            case 42:
                $this->setCanViewFinancial($value);
                break;
            case 43:
                $this->setCanViewTodayBookings($value);
                break;
            case 44:
                $this->setDashboardTop($value);
                break;
            case 45:
                $this->setDashboardMiddle($value);
                break;
            case 46:
                $this->setDashboardBottom($value);
                break;
            case 47:
                $this->setCalendarHeaderRight($value);
                break;
            case 48:
                $this->setCanManageGuestSettings($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = GroupTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setGroupId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setGroupCd($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setGroupName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDefaultCalendarView($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIncludeInProviderList($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCanViewOtherProfiles($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCanEditOtherProfiles($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCanDeleteServices($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCanEditServices($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCanAddSchedule($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCanAdminGuest($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCanAdminCalendar($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCanAdminProviders($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCanAdminServices($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCanAdminFacilities($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCanAdminActivities($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCanAdminPackages($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCanAdminReports($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setLocation($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setForms($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setCanViewSchedules1($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCanEditSchedules1($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCanViewSchedules2($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setCanEditSchedules2($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setCanViewSchedules3($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setCanEditSchedules3($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setIncludeInAuditList($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setCanEditCompletedForms($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setCanAssignSchedules($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setCanViewOtherSchedule($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setCanViewSchedules4($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setCanEditSchedules4($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setCanViewSchedules5($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setCanEditSchedules5($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setCanViewSchedules6($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setCanEditSchedules6($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setCanViewSchedules7($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setCanEditSchedules7($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setCanViewDashboard($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setNotifyOnBookings($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setCanManageGuestBookings($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setCanManageGuestForms($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setCanViewFinancial($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setCanViewTodayBookings($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setDashboardTop($arr[$keys[44]]);
        }
        if (array_key_exists($keys[45], $arr)) {
            $this->setDashboardMiddle($arr[$keys[45]]);
        }
        if (array_key_exists($keys[46], $arr)) {
            $this->setDashboardBottom($arr[$keys[46]]);
        }
        if (array_key_exists($keys[47], $arr)) {
            $this->setCalendarHeaderRight($arr[$keys[47]]);
        }
        if (array_key_exists($keys[48], $arr)) {
            $this->setCanManageGuestSettings($arr[$keys[48]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\TheFarm\Models\Group The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GroupTableMap::COL_GROUP_ID)) {
            $criteria->add(GroupTableMap::COL_GROUP_ID, $this->group_id);
        }
        if ($this->isColumnModified(GroupTableMap::COL_GROUP_CD)) {
            $criteria->add(GroupTableMap::COL_GROUP_CD, $this->group_cd);
        }
        if ($this->isColumnModified(GroupTableMap::COL_GROUP_NAME)) {
            $criteria->add(GroupTableMap::COL_GROUP_NAME, $this->group_name);
        }
        if ($this->isColumnModified(GroupTableMap::COL_DEFAULT_CALENDAR_VIEW)) {
            $criteria->add(GroupTableMap::COL_DEFAULT_CALENDAR_VIEW, $this->default_calendar_view);
        }
        if ($this->isColumnModified(GroupTableMap::COL_INCLUDE_IN_PROVIDER_LIST)) {
            $criteria->add(GroupTableMap::COL_INCLUDE_IN_PROVIDER_LIST, $this->include_in_provider_list);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_OTHER_PROFILES)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_OTHER_PROFILES, $this->can_view_other_profiles);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_OTHER_PROFILES)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_OTHER_PROFILES, $this->can_edit_other_profiles);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_DELETE_SERVICES)) {
            $criteria->add(GroupTableMap::COL_CAN_DELETE_SERVICES, $this->can_delete_services);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SERVICES)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SERVICES, $this->can_edit_services);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADD_SCHEDULE)) {
            $criteria->add(GroupTableMap::COL_CAN_ADD_SCHEDULE, $this->can_add_schedule);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_GUEST)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_GUEST, $this->can_admin_guest);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_CALENDAR)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_CALENDAR, $this->can_admin_calendar);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_PROVIDERS)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_PROVIDERS, $this->can_admin_providers);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_SERVICES)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_SERVICES, $this->can_admin_services);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_FACILITIES)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_FACILITIES, $this->can_admin_facilities);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_ACTIVITIES)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_ACTIVITIES, $this->can_admin_activities);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_PACKAGES)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_PACKAGES, $this->can_admin_packages);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ADMIN_REPORTS)) {
            $criteria->add(GroupTableMap::COL_CAN_ADMIN_REPORTS, $this->can_admin_reports);
        }
        if ($this->isColumnModified(GroupTableMap::COL_LOCATION)) {
            $criteria->add(GroupTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(GroupTableMap::COL_FORMS)) {
            $criteria->add(GroupTableMap::COL_FORMS, $this->forms);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_1)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_1, $this->can_view_schedules_1);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_1)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_1, $this->can_edit_schedules_1);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_2)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_2, $this->can_view_schedules_2);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_2)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_2, $this->can_edit_schedules_2);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_3)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_3, $this->can_view_schedules_3);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_3)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_3, $this->can_edit_schedules_3);
        }
        if ($this->isColumnModified(GroupTableMap::COL_INCLUDE_IN_AUDIT_LIST)) {
            $criteria->add(GroupTableMap::COL_INCLUDE_IN_AUDIT_LIST, $this->include_in_audit_list);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_COMPLETED_FORMS)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_COMPLETED_FORMS, $this->can_edit_completed_forms);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_ASSIGN_SCHEDULES)) {
            $criteria->add(GroupTableMap::COL_CAN_ASSIGN_SCHEDULES, $this->can_assign_schedules);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_OTHER_SCHEDULE)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_OTHER_SCHEDULE, $this->can_view_other_schedule);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_4)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_4, $this->can_view_schedules_4);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_4)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_4, $this->can_edit_schedules_4);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_5)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_5, $this->can_view_schedules_5);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_5)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_5, $this->can_edit_schedules_5);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_6)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_6, $this->can_view_schedules_6);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_6)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_6, $this->can_edit_schedules_6);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_SCHEDULES_7)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_SCHEDULES_7, $this->can_view_schedules_7);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_EDIT_SCHEDULES_7)) {
            $criteria->add(GroupTableMap::COL_CAN_EDIT_SCHEDULES_7, $this->can_edit_schedules_7);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_DASHBOARD)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_DASHBOARD, $this->can_view_dashboard);
        }
        if ($this->isColumnModified(GroupTableMap::COL_NOTIFY_ON_BOOKINGS)) {
            $criteria->add(GroupTableMap::COL_NOTIFY_ON_BOOKINGS, $this->notify_on_bookings);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS)) {
            $criteria->add(GroupTableMap::COL_CAN_MANAGE_GUEST_BOOKINGS, $this->can_manage_guest_bookings);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_FORMS)) {
            $criteria->add(GroupTableMap::COL_CAN_MANAGE_GUEST_FORMS, $this->can_manage_guest_forms);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_FINANCIAL)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_FINANCIAL, $this->can_view_financial);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_VIEW_TODAY_BOOKINGS)) {
            $criteria->add(GroupTableMap::COL_CAN_VIEW_TODAY_BOOKINGS, $this->can_view_today_bookings);
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_TOP)) {
            $criteria->add(GroupTableMap::COL_DASHBOARD_TOP, $this->dashboard_top);
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_MIDDLE)) {
            $criteria->add(GroupTableMap::COL_DASHBOARD_MIDDLE, $this->dashboard_middle);
        }
        if ($this->isColumnModified(GroupTableMap::COL_DASHBOARD_BOTTOM)) {
            $criteria->add(GroupTableMap::COL_DASHBOARD_BOTTOM, $this->dashboard_bottom);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CALENDAR_HEADER_RIGHT)) {
            $criteria->add(GroupTableMap::COL_CALENDAR_HEADER_RIGHT, $this->calendar_header_right);
        }
        if ($this->isColumnModified(GroupTableMap::COL_CAN_MANAGE_GUEST_SETTINGS)) {
            $criteria->add(GroupTableMap::COL_CAN_MANAGE_GUEST_SETTINGS, $this->can_manage_guest_settings);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildGroupQuery::create();
        $criteria->add(GroupTableMap::COL_GROUP_ID, $this->group_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getGroupId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getGroupId();
    }

    /**
     * Generic method to set the primary key (group_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setGroupId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getGroupId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Group (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setGroupCd($this->getGroupCd());
        $copyObj->setGroupName($this->getGroupName());
        $copyObj->setDefaultCalendarView($this->getDefaultCalendarView());
        $copyObj->setIncludeInProviderList($this->getIncludeInProviderList());
        $copyObj->setCanViewOtherProfiles($this->getCanViewOtherProfiles());
        $copyObj->setCanEditOtherProfiles($this->getCanEditOtherProfiles());
        $copyObj->setCanDeleteServices($this->getCanDeleteServices());
        $copyObj->setCanEditServices($this->getCanEditServices());
        $copyObj->setCanAddSchedule($this->getCanAddSchedule());
        $copyObj->setCanAdminGuest($this->getCanAdminGuest());
        $copyObj->setCanAdminCalendar($this->getCanAdminCalendar());
        $copyObj->setCanAdminProviders($this->getCanAdminProviders());
        $copyObj->setCanAdminServices($this->getCanAdminServices());
        $copyObj->setCanAdminFacilities($this->getCanAdminFacilities());
        $copyObj->setCanAdminActivities($this->getCanAdminActivities());
        $copyObj->setCanAdminPackages($this->getCanAdminPackages());
        $copyObj->setCanAdminReports($this->getCanAdminReports());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setForms($this->getForms());
        $copyObj->setCanViewSchedules1($this->getCanViewSchedules1());
        $copyObj->setCanEditSchedules1($this->getCanEditSchedules1());
        $copyObj->setCanViewSchedules2($this->getCanViewSchedules2());
        $copyObj->setCanEditSchedules2($this->getCanEditSchedules2());
        $copyObj->setCanViewSchedules3($this->getCanViewSchedules3());
        $copyObj->setCanEditSchedules3($this->getCanEditSchedules3());
        $copyObj->setIncludeInAuditList($this->getIncludeInAuditList());
        $copyObj->setCanEditCompletedForms($this->getCanEditCompletedForms());
        $copyObj->setCanAssignSchedules($this->getCanAssignSchedules());
        $copyObj->setCanViewOtherSchedule($this->getCanViewOtherSchedule());
        $copyObj->setCanViewSchedules4($this->getCanViewSchedules4());
        $copyObj->setCanEditSchedules4($this->getCanEditSchedules4());
        $copyObj->setCanViewSchedules5($this->getCanViewSchedules5());
        $copyObj->setCanEditSchedules5($this->getCanEditSchedules5());
        $copyObj->setCanViewSchedules6($this->getCanViewSchedules6());
        $copyObj->setCanEditSchedules6($this->getCanEditSchedules6());
        $copyObj->setCanViewSchedules7($this->getCanViewSchedules7());
        $copyObj->setCanEditSchedules7($this->getCanEditSchedules7());
        $copyObj->setCanViewDashboard($this->getCanViewDashboard());
        $copyObj->setNotifyOnBookings($this->getNotifyOnBookings());
        $copyObj->setCanManageGuestBookings($this->getCanManageGuestBookings());
        $copyObj->setCanManageGuestForms($this->getCanManageGuestForms());
        $copyObj->setCanViewFinancial($this->getCanViewFinancial());
        $copyObj->setCanViewTodayBookings($this->getCanViewTodayBookings());
        $copyObj->setDashboardTop($this->getDashboardTop());
        $copyObj->setDashboardMiddle($this->getDashboardMiddle());
        $copyObj->setDashboardBottom($this->getDashboardBottom());
        $copyObj->setCalendarHeaderRight($this->getCalendarHeaderRight());
        $copyObj->setCanManageGuestSettings($this->getCanManageGuestSettings());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setGroupId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \TheFarm\Models\Group Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('User' == $relationName) {
            $this->initUsers();
            return;
        }
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsers collection loaded partially.
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTableMap::getTableMap()->getCollectionClassName();

        $this->collUsers = new $collectionClassName;
        $this->collUsers->setModel('\TheFarm\Models\User');
    }

    /**
     * Gets an array of ChildUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     * @throws PropelException
     */
    public function getUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = ChildUserQuery::create(null, $criteria)
                    ->filterByGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                        $this->initUsers(false);

                        foreach ($collUsers as $obj) {
                            if (false == $this->collUsers->contains($obj)) {
                                $this->collUsers->append($obj);
                            }
                        }

                        $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if ($partial && $this->collUsers) {
                    foreach ($this->collUsers as $obj) {
                        if ($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of ChildUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $users A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGroup The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setGroup(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsers());
            }

            $query = ChildUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGroup($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\TheFarm\Models\Group The current object (for fluent API support)
     */
    public function addUser(ChildUser $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }

        if (!$this->collUsers->contains($l)) {
            $this->doAddUser($l);

            if ($this->usersScheduledForDeletion and $this->usersScheduledForDeletion->contains($l)) {
                $this->usersScheduledForDeletion->remove($this->usersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUser $user The ChildUser object to add.
     */
    protected function doAddUser(ChildUser $user)
    {
        $this->collUsers[]= $user;
        $user->setGroup($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildGroup The current object (for fluent API support)
     */
    public function removeUser(ChildUser $user)
    {
        if ($this->getUsers()->contains($user)) {
            $pos = $this->collUsers->search($user);
            $this->collUsers->remove($pos);
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
            $user->setGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Group is new, it will return
     * an empty collection; or if this Group has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Group.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getUsersJoinLocation(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserQuery::create(null, $criteria);
        $query->joinWith('Location', $joinBehavior);

        return $this->getUsers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->group_id = null;
        $this->group_cd = null;
        $this->group_name = null;
        $this->default_calendar_view = null;
        $this->include_in_provider_list = null;
        $this->can_view_other_profiles = null;
        $this->can_edit_other_profiles = null;
        $this->can_delete_services = null;
        $this->can_edit_services = null;
        $this->can_add_schedule = null;
        $this->can_admin_guest = null;
        $this->can_admin_calendar = null;
        $this->can_admin_providers = null;
        $this->can_admin_services = null;
        $this->can_admin_facilities = null;
        $this->can_admin_activities = null;
        $this->can_admin_packages = null;
        $this->can_admin_reports = null;
        $this->location = null;
        $this->forms = null;
        $this->can_view_schedules_1 = null;
        $this->can_edit_schedules_1 = null;
        $this->can_view_schedules_2 = null;
        $this->can_edit_schedules_2 = null;
        $this->can_view_schedules_3 = null;
        $this->can_edit_schedules_3 = null;
        $this->include_in_audit_list = null;
        $this->can_edit_completed_forms = null;
        $this->can_assign_schedules = null;
        $this->can_view_other_schedule = null;
        $this->can_view_schedules_4 = null;
        $this->can_edit_schedules_4 = null;
        $this->can_view_schedules_5 = null;
        $this->can_edit_schedules_5 = null;
        $this->can_view_schedules_6 = null;
        $this->can_edit_schedules_6 = null;
        $this->can_view_schedules_7 = null;
        $this->can_edit_schedules_7 = null;
        $this->can_view_dashboard = null;
        $this->notify_on_bookings = null;
        $this->can_manage_guest_bookings = null;
        $this->can_manage_guest_forms = null;
        $this->can_view_financial = null;
        $this->can_view_today_bookings = null;
        $this->dashboard_top = null;
        $this->dashboard_middle = null;
        $this->dashboard_bottom = null;
        $this->calendar_header_right = null;
        $this->can_manage_guest_settings = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GroupTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
