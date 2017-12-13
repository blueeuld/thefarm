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
use TheFarm\Models\Booking as ChildBooking;
use TheFarm\Models\BookingEvent as ChildBookingEvent;
use TheFarm\Models\BookingEventQuery as ChildBookingEventQuery;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\EventUser as ChildEventUser;
use TheFarm\Models\EventUserQuery as ChildEventUserQuery;
use TheFarm\Models\Group as ChildGroup;
use TheFarm\Models\GroupQuery as ChildGroupQuery;
use TheFarm\Models\Item as ChildItem;
use TheFarm\Models\ItemQuery as ChildItemQuery;
use TheFarm\Models\ItemsRelatedUser as ChildItemsRelatedUser;
use TheFarm\Models\ItemsRelatedUserQuery as ChildItemsRelatedUserQuery;
use TheFarm\Models\Location as ChildLocation;
use TheFarm\Models\LocationQuery as ChildLocationQuery;
use TheFarm\Models\ProviderSchedule as ChildProviderSchedule;
use TheFarm\Models\ProviderScheduleQuery as ChildProviderScheduleQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\UserWorkPlanDay as ChildUserWorkPlanDay;
use TheFarm\Models\UserWorkPlanDayQuery as ChildUserWorkPlanDayQuery;
use TheFarm\Models\Map\BookingEventTableMap;
use TheFarm\Models\Map\BookingTableMap;
use TheFarm\Models\Map\EventUserTableMap;
use TheFarm\Models\Map\ItemsRelatedUserTableMap;
use TheFarm\Models\Map\ProviderScheduleTableMap;
use TheFarm\Models\Map\UserTableMap;
use TheFarm\Models\Map\UserWorkPlanDayTableMap;

/**
 * Base class that represents a row from the 'tf_users' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\UserTableMap';


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
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the username field.
     *
     * @var        string
     */
    protected $username;

    /**
     * The value for the group_id field.
     *
     * @var        int
     */
    protected $group_id;

    /**
     * The value for the last_login field.
     *
     * @var        int
     */
    protected $last_login;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the work_plan field.
     *
     * @var        string
     */
    protected $work_plan;

    /**
     * The value for the work_plan_code field.
     *
     * @var        string
     */
    protected $work_plan_code;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the facebook_id field.
     *
     * @var        string
     */
    protected $facebook_id;

    /**
     * The value for the user_order field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $user_order;

    /**
     * The value for the calendar_view_positions field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $calendar_view_positions;

    /**
     * The value for the calendar_view_status field.
     *
     * @var        string
     */
    protected $calendar_view_status;

    /**
     * The value for the calendar_show_my_schedule_only field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $calendar_show_my_schedule_only;

    /**
     * The value for the calendar_view_locations field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $calendar_view_locations;

    /**
     * The value for the preferences field.
     *
     * @var        string
     */
    protected $preferences;

    /**
     * The value for the calendar_show_no_schedule field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $calendar_show_no_schedule;

    /**
     * @var        ChildGroup
     */
    protected $aGroup;

    /**
     * @var        ChildLocation
     */
    protected $aLocation;

    /**
     * @var        ObjectCollection|ChildEventUser[] Collection to store aggregation of ChildEventUser objects.
     */
    protected $collEventUsers;
    protected $collEventUsersPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEventsRelatedByAuthorId;
    protected $collBookingEventsRelatedByAuthorIdPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEventsRelatedByCalledBy;
    protected $collBookingEventsRelatedByCalledByPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEventsRelatedByCancelledBy;
    protected $collBookingEventsRelatedByCancelledByPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEventsRelatedByDeletedBy;
    protected $collBookingEventsRelatedByDeletedByPartial;

    /**
     * @var        ObjectCollection|ChildBooking[] Collection to store aggregation of ChildBooking objects.
     */
    protected $collBookings;
    protected $collBookingsPartial;

    /**
     * @var        ObjectCollection|ChildItemsRelatedUser[] Collection to store aggregation of ChildItemsRelatedUser objects.
     */
    protected $collItemsRelatedUsers;
    protected $collItemsRelatedUsersPartial;

    /**
     * @var        ObjectCollection|ChildUserWorkPlanDay[] Collection to store aggregation of ChildUserWorkPlanDay objects.
     */
    protected $collUserWorkPlanDays;
    protected $collUserWorkPlanDaysPartial;

    /**
     * @var        ObjectCollection|ChildProviderSchedule[] Collection to store aggregation of ChildProviderSchedule objects.
     */
    protected $collProviderSchedules;
    protected $collProviderSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildItem[] Cross Collection to store aggregation of ChildItem objects.
     */
    protected $collItems;

    /**
     * @var bool
     */
    protected $collItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItem[]
     */
    protected $itemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEventUser[]
     */
    protected $eventUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsRelatedByAuthorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsRelatedByCalledByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsRelatedByCancelledByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsRelatedByDeletedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooking[]
     */
    protected $bookingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemsRelatedUser[]
     */
    protected $itemsRelatedUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserWorkPlanDay[]
     */
    protected $userWorkPlanDaysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProviderSchedule[]
     */
    protected $providerSchedulesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->user_order = 0;
        $this->calendar_view_positions = '';
        $this->calendar_show_my_schedule_only = 'y';
        $this->calendar_view_locations = '';
        $this->calendar_show_no_schedule = 'y';
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
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
     * Get the [last_login] column value.
     *
     * @return int
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [work_plan] column value.
     *
     * @return string
     */
    public function getWorkPlan()
    {
        return $this->work_plan;
    }

    /**
     * Get the [work_plan_code] column value.
     *
     * @return string
     */
    public function getWorkPlanCode()
    {
        return $this->work_plan_code;
    }

    /**
     * Get the [location_id] column value.
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Get the [facebook_id] column value.
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Get the [user_order] column value.
     *
     * @return int
     */
    public function getUserOrder()
    {
        return $this->user_order;
    }

    /**
     * Get the [calendar_view_positions] column value.
     *
     * @return string
     */
    public function getCalendarViewPositions()
    {
        return $this->calendar_view_positions;
    }

    /**
     * Get the [calendar_view_status] column value.
     *
     * @return string
     */
    public function getCalendarViewStatus()
    {
        return $this->calendar_view_status;
    }

    /**
     * Get the [calendar_show_my_schedule_only] column value.
     *
     * @return string
     */
    public function getCalendarShowMyScheduleOnly()
    {
        return $this->calendar_show_my_schedule_only;
    }

    /**
     * Get the [calendar_view_locations] column value.
     *
     * @return string
     */
    public function getCalendarViewLocations()
    {
        return $this->calendar_view_locations;
    }

    /**
     * Get the [preferences] column value.
     *
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * Get the [calendar_show_no_schedule] column value.
     *
     * @return string
     */
    public function getCalendarShowNoSchedule()
    {
        return $this->calendar_show_no_schedule;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_ID] = true;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UserTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [group_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setGroupId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->group_id !== $v) {
            $this->group_id = $v;
            $this->modifiedColumns[UserTableMap::COL_GROUP_ID] = true;
        }

        if ($this->aGroup !== null && $this->aGroup->getGroupId() !== $v) {
            $this->aGroup = null;
        }

        return $this;
    } // setGroupId()

    /**
     * Set the value of [last_login] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_login !== $v) {
            $this->last_login = $v;
            $this->modifiedColumns[UserTableMap::COL_LAST_LOGIN] = true;
        }

        return $this;
    } // setLastLogin()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UserTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [work_plan] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setWorkPlan($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->work_plan !== $v) {
            $this->work_plan = $v;
            $this->modifiedColumns[UserTableMap::COL_WORK_PLAN] = true;
        }

        return $this;
    } // setWorkPlan()

    /**
     * Set the value of [work_plan_code] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setWorkPlanCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->work_plan_code !== $v) {
            $this->work_plan_code = $v;
            $this->modifiedColumns[UserTableMap::COL_WORK_PLAN_CODE] = true;
        }

        return $this;
    } // setWorkPlanCode()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[UserTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aLocation !== null && $this->aLocation->getLocationId() !== $v) {
            $this->aLocation = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [facebook_id] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setFacebookId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->facebook_id !== $v) {
            $this->facebook_id = $v;
            $this->modifiedColumns[UserTableMap::COL_FACEBOOK_ID] = true;
        }

        return $this;
    } // setFacebookId()

    /**
     * Set the value of [user_order] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setUserOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_order !== $v) {
            $this->user_order = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_ORDER] = true;
        }

        return $this;
    } // setUserOrder()

    /**
     * Set the value of [calendar_view_positions] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setCalendarViewPositions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_view_positions !== $v) {
            $this->calendar_view_positions = $v;
            $this->modifiedColumns[UserTableMap::COL_CALENDAR_VIEW_POSITIONS] = true;
        }

        return $this;
    } // setCalendarViewPositions()

    /**
     * Set the value of [calendar_view_status] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setCalendarViewStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_view_status !== $v) {
            $this->calendar_view_status = $v;
            $this->modifiedColumns[UserTableMap::COL_CALENDAR_VIEW_STATUS] = true;
        }

        return $this;
    } // setCalendarViewStatus()

    /**
     * Set the value of [calendar_show_my_schedule_only] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setCalendarShowMyScheduleOnly($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_show_my_schedule_only !== $v) {
            $this->calendar_show_my_schedule_only = $v;
            $this->modifiedColumns[UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY] = true;
        }

        return $this;
    } // setCalendarShowMyScheduleOnly()

    /**
     * Set the value of [calendar_view_locations] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setCalendarViewLocations($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_view_locations !== $v) {
            $this->calendar_view_locations = $v;
            $this->modifiedColumns[UserTableMap::COL_CALENDAR_VIEW_LOCATIONS] = true;
        }

        return $this;
    } // setCalendarViewLocations()

    /**
     * Set the value of [preferences] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setPreferences($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->preferences !== $v) {
            $this->preferences = $v;
            $this->modifiedColumns[UserTableMap::COL_PREFERENCES] = true;
        }

        return $this;
    } // setPreferences()

    /**
     * Set the value of [calendar_show_no_schedule] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setCalendarShowNoSchedule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calendar_show_no_schedule !== $v) {
            $this->calendar_show_no_schedule = $v;
            $this->modifiedColumns[UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE] = true;
        }

        return $this;
    } // setCalendarShowNoSchedule()

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
            if ($this->user_order !== 0) {
                return false;
            }

            if ($this->calendar_view_positions !== '') {
                return false;
            }

            if ($this->calendar_show_my_schedule_only !== 'y') {
                return false;
            }

            if ($this->calendar_view_locations !== '') {
                return false;
            }

            if ($this->calendar_show_no_schedule !== 'y') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('WorkPlan', TableMap::TYPE_PHPNAME, $indexType)];
            $this->work_plan = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('WorkPlanCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->work_plan_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserTableMap::translateFieldName('FacebookId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->facebook_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UserTableMap::translateFieldName('UserOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UserTableMap::translateFieldName('CalendarViewPositions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_view_positions = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UserTableMap::translateFieldName('CalendarViewStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_view_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UserTableMap::translateFieldName('CalendarShowMyScheduleOnly', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_show_my_schedule_only = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UserTableMap::translateFieldName('CalendarViewLocations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_view_locations = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UserTableMap::translateFieldName('Preferences', TableMap::TYPE_PHPNAME, $indexType)];
            $this->preferences = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UserTableMap::translateFieldName('CalendarShowNoSchedule', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calendar_show_no_schedule = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\User'), 0, $e);
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
        if ($this->aGroup !== null && $this->group_id !== $this->aGroup->getGroupId()) {
            $this->aGroup = null;
        }
        if ($this->aLocation !== null && $this->location_id !== $this->aLocation->getLocationId()) {
            $this->aLocation = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGroup = null;
            $this->aLocation = null;
            $this->collEventUsers = null;

            $this->collBookingEventsRelatedByAuthorId = null;

            $this->collBookingEventsRelatedByCalledBy = null;

            $this->collBookingEventsRelatedByCancelledBy = null;

            $this->collBookingEventsRelatedByDeletedBy = null;

            $this->collBookings = null;

            $this->collItemsRelatedUsers = null;

            $this->collUserWorkPlanDays = null;

            $this->collProviderSchedules = null;

            $this->collItems = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aGroup !== null) {
                if ($this->aGroup->isModified() || $this->aGroup->isNew()) {
                    $affectedRows += $this->aGroup->save($con);
                }
                $this->setGroup($this->aGroup);
            }

            if ($this->aLocation !== null) {
                if ($this->aLocation->isModified() || $this->aLocation->isNew()) {
                    $affectedRows += $this->aLocation->save($con);
                }
                $this->setLocation($this->aLocation);
            }

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

            if ($this->itemsScheduledForDeletion !== null) {
                if (!$this->itemsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->itemsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getUserId();
                        $entryPk[0] = $entry->getItemId();
                        $pks[] = $entryPk;
                    }

                    \TheFarm\Models\ItemsRelatedUserQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->itemsScheduledForDeletion = null;
                }

            }

            if ($this->collItems) {
                foreach ($this->collItems as $item) {
                    if (!$item->isDeleted() && ($item->isNew() || $item->isModified())) {
                        $item->save($con);
                    }
                }
            }


            if ($this->eventUsersScheduledForDeletion !== null) {
                if (!$this->eventUsersScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\EventUserQuery::create()
                        ->filterByPrimaryKeys($this->eventUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->eventUsersScheduledForDeletion = null;
                }
            }

            if ($this->collEventUsers !== null) {
                foreach ($this->collEventUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventsRelatedByAuthorIdScheduledForDeletion !== null) {
                if (!$this->bookingEventsRelatedByAuthorIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsRelatedByAuthorIdScheduledForDeletion as $bookingEventRelatedByAuthorId) {
                        // need to save related object because we set the relation to null
                        $bookingEventRelatedByAuthorId->save($con);
                    }
                    $this->bookingEventsRelatedByAuthorIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventsRelatedByAuthorId !== null) {
                foreach ($this->collBookingEventsRelatedByAuthorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventsRelatedByCalledByScheduledForDeletion !== null) {
                if (!$this->bookingEventsRelatedByCalledByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsRelatedByCalledByScheduledForDeletion as $bookingEventRelatedByCalledBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventRelatedByCalledBy->save($con);
                    }
                    $this->bookingEventsRelatedByCalledByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventsRelatedByCalledBy !== null) {
                foreach ($this->collBookingEventsRelatedByCalledBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventsRelatedByCancelledByScheduledForDeletion !== null) {
                if (!$this->bookingEventsRelatedByCancelledByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsRelatedByCancelledByScheduledForDeletion as $bookingEventRelatedByCancelledBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventRelatedByCancelledBy->save($con);
                    }
                    $this->bookingEventsRelatedByCancelledByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventsRelatedByCancelledBy !== null) {
                foreach ($this->collBookingEventsRelatedByCancelledBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventsRelatedByDeletedByScheduledForDeletion !== null) {
                if (!$this->bookingEventsRelatedByDeletedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsRelatedByDeletedByScheduledForDeletion as $bookingEventRelatedByDeletedBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventRelatedByDeletedBy->save($con);
                    }
                    $this->bookingEventsRelatedByDeletedByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventsRelatedByDeletedBy !== null) {
                foreach ($this->collBookingEventsRelatedByDeletedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingsScheduledForDeletion !== null) {
                if (!$this->bookingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingsScheduledForDeletion as $booking) {
                        // need to save related object because we set the relation to null
                        $booking->save($con);
                    }
                    $this->bookingsScheduledForDeletion = null;
                }
            }

            if ($this->collBookings !== null) {
                foreach ($this->collBookings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemsRelatedUsersScheduledForDeletion !== null) {
                if (!$this->itemsRelatedUsersScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemsRelatedUserQuery::create()
                        ->filterByPrimaryKeys($this->itemsRelatedUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemsRelatedUsersScheduledForDeletion = null;
                }
            }

            if ($this->collItemsRelatedUsers !== null) {
                foreach ($this->collItemsRelatedUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userWorkPlanDaysScheduledForDeletion !== null) {
                if (!$this->userWorkPlanDaysScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\UserWorkPlanDayQuery::create()
                        ->filterByPrimaryKeys($this->userWorkPlanDaysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userWorkPlanDaysScheduledForDeletion = null;
                }
            }

            if ($this->collUserWorkPlanDays !== null) {
                foreach ($this->collUserWorkPlanDays as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->providerSchedulesScheduledForDeletion !== null) {
                if (!$this->providerSchedulesScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ProviderScheduleQuery::create()
                        ->filterByPrimaryKeys($this->providerSchedulesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->providerSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collProviderSchedules !== null) {
                foreach ($this->collProviderSchedules as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_USER_ID] = true;
        if (null !== $this->user_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_USER_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UserTableMap::COL_GROUP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'group_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UserTableMap::COL_WORK_PLAN)) {
            $modifiedColumns[':p' . $index++]  = 'work_plan';
        }
        if ($this->isColumnModified(UserTableMap::COL_WORK_PLAN_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'work_plan_code';
        }
        if ($this->isColumnModified(UserTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_FACEBOOK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'facebook_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'user_order';
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_POSITIONS)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_view_positions';
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_view_status';
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_show_my_schedule_only';
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_LOCATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_view_locations';
        }
        if ($this->isColumnModified(UserTableMap::COL_PREFERENCES)) {
            $modifiedColumns[':p' . $index++]  = 'preferences';
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE)) {
            $modifiedColumns[':p' . $index++]  = 'calendar_show_no_schedule';
        }

        $sql = sprintf(
            'INSERT INTO tf_users (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'group_id':
                        $stmt->bindValue($identifier, $this->group_id, PDO::PARAM_INT);
                        break;
                    case 'last_login':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'work_plan':
                        $stmt->bindValue($identifier, $this->work_plan, PDO::PARAM_STR);
                        break;
                    case 'work_plan_code':
                        $stmt->bindValue($identifier, $this->work_plan_code, PDO::PARAM_STR);
                        break;
                    case 'location_id':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'facebook_id':
                        $stmt->bindValue($identifier, $this->facebook_id, PDO::PARAM_STR);
                        break;
                    case 'user_order':
                        $stmt->bindValue($identifier, $this->user_order, PDO::PARAM_INT);
                        break;
                    case 'calendar_view_positions':
                        $stmt->bindValue($identifier, $this->calendar_view_positions, PDO::PARAM_STR);
                        break;
                    case 'calendar_view_status':
                        $stmt->bindValue($identifier, $this->calendar_view_status, PDO::PARAM_STR);
                        break;
                    case 'calendar_show_my_schedule_only':
                        $stmt->bindValue($identifier, $this->calendar_show_my_schedule_only, PDO::PARAM_STR);
                        break;
                    case 'calendar_view_locations':
                        $stmt->bindValue($identifier, $this->calendar_view_locations, PDO::PARAM_STR);
                        break;
                    case 'preferences':
                        $stmt->bindValue($identifier, $this->preferences, PDO::PARAM_STR);
                        break;
                    case 'calendar_show_no_schedule':
                        $stmt->bindValue($identifier, $this->calendar_show_no_schedule, PDO::PARAM_STR);
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
        $this->setUserId($pk);

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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUserId();
                break;
            case 1:
                return $this->getUsername();
                break;
            case 2:
                return $this->getGroupId();
                break;
            case 3:
                return $this->getLastLogin();
                break;
            case 4:
                return $this->getPassword();
                break;
            case 5:
                return $this->getWorkPlan();
                break;
            case 6:
                return $this->getWorkPlanCode();
                break;
            case 7:
                return $this->getLocationId();
                break;
            case 8:
                return $this->getFacebookId();
                break;
            case 9:
                return $this->getUserOrder();
                break;
            case 10:
                return $this->getCalendarViewPositions();
                break;
            case 11:
                return $this->getCalendarViewStatus();
                break;
            case 12:
                return $this->getCalendarShowMyScheduleOnly();
                break;
            case 13:
                return $this->getCalendarViewLocations();
                break;
            case 14:
                return $this->getPreferences();
                break;
            case 15:
                return $this->getCalendarShowNoSchedule();
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUserId(),
            $keys[1] => $this->getUsername(),
            $keys[2] => $this->getGroupId(),
            $keys[3] => $this->getLastLogin(),
            $keys[4] => $this->getPassword(),
            $keys[5] => $this->getWorkPlan(),
            $keys[6] => $this->getWorkPlanCode(),
            $keys[7] => $this->getLocationId(),
            $keys[8] => $this->getFacebookId(),
            $keys[9] => $this->getUserOrder(),
            $keys[10] => $this->getCalendarViewPositions(),
            $keys[11] => $this->getCalendarViewStatus(),
            $keys[12] => $this->getCalendarShowMyScheduleOnly(),
            $keys[13] => $this->getCalendarViewLocations(),
            $keys[14] => $this->getPreferences(),
            $keys[15] => $this->getCalendarShowNoSchedule(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGroup) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'group';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_groups';
                        break;
                    default:
                        $key = 'Group';
                }

                $result[$key] = $this->aGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLocation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'location';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_locations';
                        break;
                    default:
                        $key = 'Location';
                }

                $result[$key] = $this->aLocation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEventUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'eventUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_event_userss';
                        break;
                    default:
                        $key = 'EventUsers';
                }

                $result[$key] = $this->collEventUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventsRelatedByAuthorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEvents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEvents';
                }

                $result[$key] = $this->collBookingEventsRelatedByAuthorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventsRelatedByCalledBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEvents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEvents';
                }

                $result[$key] = $this->collBookingEventsRelatedByCalledBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventsRelatedByCancelledBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEvents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEvents';
                }

                $result[$key] = $this->collBookingEventsRelatedByCancelledBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventsRelatedByDeletedBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEvents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEvents';
                }

                $result[$key] = $this->collBookingEventsRelatedByDeletedBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookingss';
                        break;
                    default:
                        $key = 'Bookings';
                }

                $result[$key] = $this->collBookings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItemsRelatedUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemsRelatedUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items_related_userss';
                        break;
                    default:
                        $key = 'ItemsRelatedUsers';
                }

                $result[$key] = $this->collItemsRelatedUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserWorkPlanDays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userWorkPlanDays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user_work_plan_days';
                        break;
                    default:
                        $key = 'UserWorkPlanDays';
                }

                $result[$key] = $this->collUserWorkPlanDays->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProviderSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'providerSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user_work_plan_times';
                        break;
                    default:
                        $key = 'ProviderSchedules';
                }

                $result[$key] = $this->collProviderSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUserId($value);
                break;
            case 1:
                $this->setUsername($value);
                break;
            case 2:
                $this->setGroupId($value);
                break;
            case 3:
                $this->setLastLogin($value);
                break;
            case 4:
                $this->setPassword($value);
                break;
            case 5:
                $this->setWorkPlan($value);
                break;
            case 6:
                $this->setWorkPlanCode($value);
                break;
            case 7:
                $this->setLocationId($value);
                break;
            case 8:
                $this->setFacebookId($value);
                break;
            case 9:
                $this->setUserOrder($value);
                break;
            case 10:
                $this->setCalendarViewPositions($value);
                break;
            case 11:
                $this->setCalendarViewStatus($value);
                break;
            case 12:
                $this->setCalendarShowMyScheduleOnly($value);
                break;
            case 13:
                $this->setCalendarViewLocations($value);
                break;
            case 14:
                $this->setPreferences($value);
                break;
            case 15:
                $this->setCalendarShowNoSchedule($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUserId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUsername($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setGroupId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLastLogin($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPassword($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setWorkPlan($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setWorkPlanCode($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLocationId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFacebookId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUserOrder($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCalendarViewPositions($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCalendarViewStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCalendarShowMyScheduleOnly($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCalendarViewLocations($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPreferences($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCalendarShowNoSchedule($arr[$keys[15]]);
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
     * @return $this|\TheFarm\Models\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_USER_ID)) {
            $criteria->add(UserTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $criteria->add(UserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UserTableMap::COL_GROUP_ID)) {
            $criteria->add(UserTableMap::COL_GROUP_ID, $this->group_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UserTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $criteria->add(UserTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UserTableMap::COL_WORK_PLAN)) {
            $criteria->add(UserTableMap::COL_WORK_PLAN, $this->work_plan);
        }
        if ($this->isColumnModified(UserTableMap::COL_WORK_PLAN_CODE)) {
            $criteria->add(UserTableMap::COL_WORK_PLAN_CODE, $this->work_plan_code);
        }
        if ($this->isColumnModified(UserTableMap::COL_LOCATION_ID)) {
            $criteria->add(UserTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_FACEBOOK_ID)) {
            $criteria->add(UserTableMap::COL_FACEBOOK_ID, $this->facebook_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ORDER)) {
            $criteria->add(UserTableMap::COL_USER_ORDER, $this->user_order);
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_POSITIONS)) {
            $criteria->add(UserTableMap::COL_CALENDAR_VIEW_POSITIONS, $this->calendar_view_positions);
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_STATUS)) {
            $criteria->add(UserTableMap::COL_CALENDAR_VIEW_STATUS, $this->calendar_view_status);
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY)) {
            $criteria->add(UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY, $this->calendar_show_my_schedule_only);
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_VIEW_LOCATIONS)) {
            $criteria->add(UserTableMap::COL_CALENDAR_VIEW_LOCATIONS, $this->calendar_view_locations);
        }
        if ($this->isColumnModified(UserTableMap::COL_PREFERENCES)) {
            $criteria->add(UserTableMap::COL_PREFERENCES, $this->preferences);
        }
        if ($this->isColumnModified(UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE)) {
            $criteria->add(UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE, $this->calendar_show_no_schedule);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_USER_ID, $this->user_id);

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
        $validPk = null !== $this->getUserId();

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
        return $this->getUserId();
    }

    /**
     * Generic method to set the primary key (user_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUserId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getUserId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setGroupId($this->getGroupId());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setWorkPlan($this->getWorkPlan());
        $copyObj->setWorkPlanCode($this->getWorkPlanCode());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setFacebookId($this->getFacebookId());
        $copyObj->setUserOrder($this->getUserOrder());
        $copyObj->setCalendarViewPositions($this->getCalendarViewPositions());
        $copyObj->setCalendarViewStatus($this->getCalendarViewStatus());
        $copyObj->setCalendarShowMyScheduleOnly($this->getCalendarShowMyScheduleOnly());
        $copyObj->setCalendarViewLocations($this->getCalendarViewLocations());
        $copyObj->setPreferences($this->getPreferences());
        $copyObj->setCalendarShowNoSchedule($this->getCalendarShowNoSchedule());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEventUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventsRelatedByAuthorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventRelatedByAuthorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventsRelatedByCalledBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventRelatedByCalledBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventsRelatedByCancelledBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventRelatedByCancelledBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventsRelatedByDeletedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventRelatedByDeletedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooking($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemsRelatedUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemsRelatedUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserWorkPlanDays() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserWorkPlanDay($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProviderSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProviderSchedule($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUserId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\User Clone of current object.
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
     * Declares an association between this object and a ChildGroup object.
     *
     * @param  ChildGroup $v
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGroup(ChildGroup $v = null)
    {
        if ($v === null) {
            $this->setGroupId(NULL);
        } else {
            $this->setGroupId($v->getGroupId());
        }

        $this->aGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGroup object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildGroup The associated ChildGroup object.
     * @throws PropelException
     */
    public function getGroup(ConnectionInterface $con = null)
    {
        if ($this->aGroup === null && ($this->group_id !== null)) {
            $this->aGroup = ChildGroupQuery::create()->findPk($this->group_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGroup->addUsers($this);
             */
        }

        return $this->aGroup;
    }

    /**
     * Declares an association between this object and a ChildLocation object.
     *
     * @param  ChildLocation $v
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLocation(ChildLocation $v = null)
    {
        if ($v === null) {
            $this->setLocationId(NULL);
        } else {
            $this->setLocationId($v->getLocationId());
        }

        $this->aLocation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLocation object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLocation object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLocation The associated ChildLocation object.
     * @throws PropelException
     */
    public function getLocation(ConnectionInterface $con = null)
    {
        if ($this->aLocation === null && ($this->location_id !== null)) {
            $this->aLocation = ChildLocationQuery::create()->findPk($this->location_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocation->addUsers($this);
             */
        }

        return $this->aLocation;
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
        if ('EventUser' == $relationName) {
            $this->initEventUsers();
            return;
        }
        if ('BookingEventRelatedByAuthorId' == $relationName) {
            $this->initBookingEventsRelatedByAuthorId();
            return;
        }
        if ('BookingEventRelatedByCalledBy' == $relationName) {
            $this->initBookingEventsRelatedByCalledBy();
            return;
        }
        if ('BookingEventRelatedByCancelledBy' == $relationName) {
            $this->initBookingEventsRelatedByCancelledBy();
            return;
        }
        if ('BookingEventRelatedByDeletedBy' == $relationName) {
            $this->initBookingEventsRelatedByDeletedBy();
            return;
        }
        if ('Booking' == $relationName) {
            $this->initBookings();
            return;
        }
        if ('ItemsRelatedUser' == $relationName) {
            $this->initItemsRelatedUsers();
            return;
        }
        if ('UserWorkPlanDay' == $relationName) {
            $this->initUserWorkPlanDays();
            return;
        }
        if ('ProviderSchedule' == $relationName) {
            $this->initProviderSchedules();
            return;
        }
    }

    /**
     * Clears out the collEventUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEventUsers()
     */
    public function clearEventUsers()
    {
        $this->collEventUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEventUsers collection loaded partially.
     */
    public function resetPartialEventUsers($v = true)
    {
        $this->collEventUsersPartial = $v;
    }

    /**
     * Initializes the collEventUsers collection.
     *
     * By default this just sets the collEventUsers collection to an empty array (like clearcollEventUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventUsers($overrideExisting = true)
    {
        if (null !== $this->collEventUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = EventUserTableMap::getTableMap()->getCollectionClassName();

        $this->collEventUsers = new $collectionClassName;
        $this->collEventUsers->setModel('\TheFarm\Models\EventUser');
    }

    /**
     * Gets an array of ChildEventUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEventUser[] List of ChildEventUser objects
     * @throws PropelException
     */
    public function getEventUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEventUsersPartial && !$this->isNew();
        if (null === $this->collEventUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEventUsers) {
                // return empty collection
                $this->initEventUsers();
            } else {
                $collEventUsers = ChildEventUserQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventUsersPartial && count($collEventUsers)) {
                        $this->initEventUsers(false);

                        foreach ($collEventUsers as $obj) {
                            if (false == $this->collEventUsers->contains($obj)) {
                                $this->collEventUsers->append($obj);
                            }
                        }

                        $this->collEventUsersPartial = true;
                    }

                    return $collEventUsers;
                }

                if ($partial && $this->collEventUsers) {
                    foreach ($this->collEventUsers as $obj) {
                        if ($obj->isNew()) {
                            $collEventUsers[] = $obj;
                        }
                    }
                }

                $this->collEventUsers = $collEventUsers;
                $this->collEventUsersPartial = false;
            }
        }

        return $this->collEventUsers;
    }

    /**
     * Sets a collection of ChildEventUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $eventUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setEventUsers(Collection $eventUsers, ConnectionInterface $con = null)
    {
        /** @var ChildEventUser[] $eventUsersToDelete */
        $eventUsersToDelete = $this->getEventUsers(new Criteria(), $con)->diff($eventUsers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->eventUsersScheduledForDeletion = clone $eventUsersToDelete;

        foreach ($eventUsersToDelete as $eventUserRemoved) {
            $eventUserRemoved->setUser(null);
        }

        $this->collEventUsers = null;
        foreach ($eventUsers as $eventUser) {
            $this->addEventUser($eventUser);
        }

        $this->collEventUsers = $eventUsers;
        $this->collEventUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EventUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related EventUser objects.
     * @throws PropelException
     */
    public function countEventUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEventUsersPartial && !$this->isNew();
        if (null === $this->collEventUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventUsers());
            }

            $query = ChildEventUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collEventUsers);
    }

    /**
     * Method called to associate a ChildEventUser object to this object
     * through the ChildEventUser foreign key attribute.
     *
     * @param  ChildEventUser $l ChildEventUser
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addEventUser(ChildEventUser $l)
    {
        if ($this->collEventUsers === null) {
            $this->initEventUsers();
            $this->collEventUsersPartial = true;
        }

        if (!$this->collEventUsers->contains($l)) {
            $this->doAddEventUser($l);

            if ($this->eventUsersScheduledForDeletion and $this->eventUsersScheduledForDeletion->contains($l)) {
                $this->eventUsersScheduledForDeletion->remove($this->eventUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEventUser $eventUser The ChildEventUser object to add.
     */
    protected function doAddEventUser(ChildEventUser $eventUser)
    {
        $this->collEventUsers[]= $eventUser;
        $eventUser->setUser($this);
    }

    /**
     * @param  ChildEventUser $eventUser The ChildEventUser object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeEventUser(ChildEventUser $eventUser)
    {
        if ($this->getEventUsers()->contains($eventUser)) {
            $pos = $this->collEventUsers->search($eventUser);
            $this->collEventUsers->remove($pos);
            if (null === $this->eventUsersScheduledForDeletion) {
                $this->eventUsersScheduledForDeletion = clone $this->collEventUsers;
                $this->eventUsersScheduledForDeletion->clear();
            }
            $this->eventUsersScheduledForDeletion[]= clone $eventUser;
            $eventUser->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related EventUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEventUser[] List of ChildEventUser objects
     */
    public function getEventUsersJoinBookingEvent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventUserQuery::create(null, $criteria);
        $query->joinWith('BookingEvent', $joinBehavior);

        return $this->getEventUsers($query, $con);
    }

    /**
     * Clears out the collBookingEventsRelatedByAuthorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventsRelatedByAuthorId()
     */
    public function clearBookingEventsRelatedByAuthorId()
    {
        $this->collBookingEventsRelatedByAuthorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventsRelatedByAuthorId collection loaded partially.
     */
    public function resetPartialBookingEventsRelatedByAuthorId($v = true)
    {
        $this->collBookingEventsRelatedByAuthorIdPartial = $v;
    }

    /**
     * Initializes the collBookingEventsRelatedByAuthorId collection.
     *
     * By default this just sets the collBookingEventsRelatedByAuthorId collection to an empty array (like clearcollBookingEventsRelatedByAuthorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventsRelatedByAuthorId($overrideExisting = true)
    {
        if (null !== $this->collBookingEventsRelatedByAuthorId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventsRelatedByAuthorId = new $collectionClassName;
        $this->collBookingEventsRelatedByAuthorId->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEventsRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByAuthorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByAuthorId) {
                // return empty collection
                $this->initBookingEventsRelatedByAuthorId();
            } else {
                $collBookingEventsRelatedByAuthorId = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByUserRelatedByAuthorId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsRelatedByAuthorIdPartial && count($collBookingEventsRelatedByAuthorId)) {
                        $this->initBookingEventsRelatedByAuthorId(false);

                        foreach ($collBookingEventsRelatedByAuthorId as $obj) {
                            if (false == $this->collBookingEventsRelatedByAuthorId->contains($obj)) {
                                $this->collBookingEventsRelatedByAuthorId->append($obj);
                            }
                        }

                        $this->collBookingEventsRelatedByAuthorIdPartial = true;
                    }

                    return $collBookingEventsRelatedByAuthorId;
                }

                if ($partial && $this->collBookingEventsRelatedByAuthorId) {
                    foreach ($this->collBookingEventsRelatedByAuthorId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventsRelatedByAuthorId[] = $obj;
                        }
                    }
                }

                $this->collBookingEventsRelatedByAuthorId = $collBookingEventsRelatedByAuthorId;
                $this->collBookingEventsRelatedByAuthorIdPartial = false;
            }
        }

        return $this->collBookingEventsRelatedByAuthorId;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventsRelatedByAuthorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByAuthorId(Collection $bookingEventsRelatedByAuthorId, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByAuthorIdToDelete */
        $bookingEventsRelatedByAuthorIdToDelete = $this->getBookingEventsRelatedByAuthorId(new Criteria(), $con)->diff($bookingEventsRelatedByAuthorId);


        $this->bookingEventsRelatedByAuthorIdScheduledForDeletion = $bookingEventsRelatedByAuthorIdToDelete;

        foreach ($bookingEventsRelatedByAuthorIdToDelete as $bookingEventRelatedByAuthorIdRemoved) {
            $bookingEventRelatedByAuthorIdRemoved->setUserRelatedByAuthorId(null);
        }

        $this->collBookingEventsRelatedByAuthorId = null;
        foreach ($bookingEventsRelatedByAuthorId as $bookingEventRelatedByAuthorId) {
            $this->addBookingEventRelatedByAuthorId($bookingEventRelatedByAuthorId);
        }

        $this->collBookingEventsRelatedByAuthorId = $bookingEventsRelatedByAuthorId;
        $this->collBookingEventsRelatedByAuthorIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvent objects.
     * @throws PropelException
     */
    public function countBookingEventsRelatedByAuthorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByAuthorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByAuthorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventsRelatedByAuthorId());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByAuthorId($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByAuthorId);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addBookingEventRelatedByAuthorId(ChildBookingEvent $l)
    {
        if ($this->collBookingEventsRelatedByAuthorId === null) {
            $this->initBookingEventsRelatedByAuthorId();
            $this->collBookingEventsRelatedByAuthorIdPartial = true;
        }

        if (!$this->collBookingEventsRelatedByAuthorId->contains($l)) {
            $this->doAddBookingEventRelatedByAuthorId($l);

            if ($this->bookingEventsRelatedByAuthorIdScheduledForDeletion and $this->bookingEventsRelatedByAuthorIdScheduledForDeletion->contains($l)) {
                $this->bookingEventsRelatedByAuthorIdScheduledForDeletion->remove($this->bookingEventsRelatedByAuthorIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEventRelatedByAuthorId The ChildBookingEvent object to add.
     */
    protected function doAddBookingEventRelatedByAuthorId(ChildBookingEvent $bookingEventRelatedByAuthorId)
    {
        $this->collBookingEventsRelatedByAuthorId[]= $bookingEventRelatedByAuthorId;
        $bookingEventRelatedByAuthorId->setUserRelatedByAuthorId($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByAuthorId The ChildBookingEvent object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeBookingEventRelatedByAuthorId(ChildBookingEvent $bookingEventRelatedByAuthorId)
    {
        if ($this->getBookingEventsRelatedByAuthorId()->contains($bookingEventRelatedByAuthorId)) {
            $pos = $this->collBookingEventsRelatedByAuthorId->search($bookingEventRelatedByAuthorId);
            $this->collBookingEventsRelatedByAuthorId->remove($pos);
            if (null === $this->bookingEventsRelatedByAuthorIdScheduledForDeletion) {
                $this->bookingEventsRelatedByAuthorIdScheduledForDeletion = clone $this->collBookingEventsRelatedByAuthorId;
                $this->bookingEventsRelatedByAuthorIdScheduledForDeletion->clear();
            }
            $this->bookingEventsRelatedByAuthorIdScheduledForDeletion[]= $bookingEventRelatedByAuthorId;
            $bookingEventRelatedByAuthorId->setUserRelatedByAuthorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByAuthorIdJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEventsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByAuthorIdJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEventsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByAuthorIdJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingEventsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByAuthorIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventsRelatedByAuthorId($query, $con);
    }

    /**
     * Clears out the collBookingEventsRelatedByCalledBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventsRelatedByCalledBy()
     */
    public function clearBookingEventsRelatedByCalledBy()
    {
        $this->collBookingEventsRelatedByCalledBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventsRelatedByCalledBy collection loaded partially.
     */
    public function resetPartialBookingEventsRelatedByCalledBy($v = true)
    {
        $this->collBookingEventsRelatedByCalledByPartial = $v;
    }

    /**
     * Initializes the collBookingEventsRelatedByCalledBy collection.
     *
     * By default this just sets the collBookingEventsRelatedByCalledBy collection to an empty array (like clearcollBookingEventsRelatedByCalledBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventsRelatedByCalledBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventsRelatedByCalledBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventsRelatedByCalledBy = new $collectionClassName;
        $this->collBookingEventsRelatedByCalledBy->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEventsRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByCalledByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByCalledBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByCalledBy) {
                // return empty collection
                $this->initBookingEventsRelatedByCalledBy();
            } else {
                $collBookingEventsRelatedByCalledBy = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByUserRelatedByCalledBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsRelatedByCalledByPartial && count($collBookingEventsRelatedByCalledBy)) {
                        $this->initBookingEventsRelatedByCalledBy(false);

                        foreach ($collBookingEventsRelatedByCalledBy as $obj) {
                            if (false == $this->collBookingEventsRelatedByCalledBy->contains($obj)) {
                                $this->collBookingEventsRelatedByCalledBy->append($obj);
                            }
                        }

                        $this->collBookingEventsRelatedByCalledByPartial = true;
                    }

                    return $collBookingEventsRelatedByCalledBy;
                }

                if ($partial && $this->collBookingEventsRelatedByCalledBy) {
                    foreach ($this->collBookingEventsRelatedByCalledBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventsRelatedByCalledBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventsRelatedByCalledBy = $collBookingEventsRelatedByCalledBy;
                $this->collBookingEventsRelatedByCalledByPartial = false;
            }
        }

        return $this->collBookingEventsRelatedByCalledBy;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventsRelatedByCalledBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByCalledBy(Collection $bookingEventsRelatedByCalledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByCalledByToDelete */
        $bookingEventsRelatedByCalledByToDelete = $this->getBookingEventsRelatedByCalledBy(new Criteria(), $con)->diff($bookingEventsRelatedByCalledBy);


        $this->bookingEventsRelatedByCalledByScheduledForDeletion = $bookingEventsRelatedByCalledByToDelete;

        foreach ($bookingEventsRelatedByCalledByToDelete as $bookingEventRelatedByCalledByRemoved) {
            $bookingEventRelatedByCalledByRemoved->setUserRelatedByCalledBy(null);
        }

        $this->collBookingEventsRelatedByCalledBy = null;
        foreach ($bookingEventsRelatedByCalledBy as $bookingEventRelatedByCalledBy) {
            $this->addBookingEventRelatedByCalledBy($bookingEventRelatedByCalledBy);
        }

        $this->collBookingEventsRelatedByCalledBy = $bookingEventsRelatedByCalledBy;
        $this->collBookingEventsRelatedByCalledByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvent objects.
     * @throws PropelException
     */
    public function countBookingEventsRelatedByCalledBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByCalledByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByCalledBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByCalledBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventsRelatedByCalledBy());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCalledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByCalledBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addBookingEventRelatedByCalledBy(ChildBookingEvent $l)
    {
        if ($this->collBookingEventsRelatedByCalledBy === null) {
            $this->initBookingEventsRelatedByCalledBy();
            $this->collBookingEventsRelatedByCalledByPartial = true;
        }

        if (!$this->collBookingEventsRelatedByCalledBy->contains($l)) {
            $this->doAddBookingEventRelatedByCalledBy($l);

            if ($this->bookingEventsRelatedByCalledByScheduledForDeletion and $this->bookingEventsRelatedByCalledByScheduledForDeletion->contains($l)) {
                $this->bookingEventsRelatedByCalledByScheduledForDeletion->remove($this->bookingEventsRelatedByCalledByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEventRelatedByCalledBy The ChildBookingEvent object to add.
     */
    protected function doAddBookingEventRelatedByCalledBy(ChildBookingEvent $bookingEventRelatedByCalledBy)
    {
        $this->collBookingEventsRelatedByCalledBy[]= $bookingEventRelatedByCalledBy;
        $bookingEventRelatedByCalledBy->setUserRelatedByCalledBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByCalledBy The ChildBookingEvent object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeBookingEventRelatedByCalledBy(ChildBookingEvent $bookingEventRelatedByCalledBy)
    {
        if ($this->getBookingEventsRelatedByCalledBy()->contains($bookingEventRelatedByCalledBy)) {
            $pos = $this->collBookingEventsRelatedByCalledBy->search($bookingEventRelatedByCalledBy);
            $this->collBookingEventsRelatedByCalledBy->remove($pos);
            if (null === $this->bookingEventsRelatedByCalledByScheduledForDeletion) {
                $this->bookingEventsRelatedByCalledByScheduledForDeletion = clone $this->collBookingEventsRelatedByCalledBy;
                $this->bookingEventsRelatedByCalledByScheduledForDeletion->clear();
            }
            $this->bookingEventsRelatedByCalledByScheduledForDeletion[]= $bookingEventRelatedByCalledBy;
            $bookingEventRelatedByCalledBy->setUserRelatedByCalledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCalledByJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEventsRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCalledByJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEventsRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCalledByJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingEventsRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCalledByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventsRelatedByCalledBy($query, $con);
    }

    /**
     * Clears out the collBookingEventsRelatedByCancelledBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventsRelatedByCancelledBy()
     */
    public function clearBookingEventsRelatedByCancelledBy()
    {
        $this->collBookingEventsRelatedByCancelledBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventsRelatedByCancelledBy collection loaded partially.
     */
    public function resetPartialBookingEventsRelatedByCancelledBy($v = true)
    {
        $this->collBookingEventsRelatedByCancelledByPartial = $v;
    }

    /**
     * Initializes the collBookingEventsRelatedByCancelledBy collection.
     *
     * By default this just sets the collBookingEventsRelatedByCancelledBy collection to an empty array (like clearcollBookingEventsRelatedByCancelledBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventsRelatedByCancelledBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventsRelatedByCancelledBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventsRelatedByCancelledBy = new $collectionClassName;
        $this->collBookingEventsRelatedByCancelledBy->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEventsRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByCancelledByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByCancelledBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByCancelledBy) {
                // return empty collection
                $this->initBookingEventsRelatedByCancelledBy();
            } else {
                $collBookingEventsRelatedByCancelledBy = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByUserRelatedByCancelledBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsRelatedByCancelledByPartial && count($collBookingEventsRelatedByCancelledBy)) {
                        $this->initBookingEventsRelatedByCancelledBy(false);

                        foreach ($collBookingEventsRelatedByCancelledBy as $obj) {
                            if (false == $this->collBookingEventsRelatedByCancelledBy->contains($obj)) {
                                $this->collBookingEventsRelatedByCancelledBy->append($obj);
                            }
                        }

                        $this->collBookingEventsRelatedByCancelledByPartial = true;
                    }

                    return $collBookingEventsRelatedByCancelledBy;
                }

                if ($partial && $this->collBookingEventsRelatedByCancelledBy) {
                    foreach ($this->collBookingEventsRelatedByCancelledBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventsRelatedByCancelledBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventsRelatedByCancelledBy = $collBookingEventsRelatedByCancelledBy;
                $this->collBookingEventsRelatedByCancelledByPartial = false;
            }
        }

        return $this->collBookingEventsRelatedByCancelledBy;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventsRelatedByCancelledBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByCancelledBy(Collection $bookingEventsRelatedByCancelledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByCancelledByToDelete */
        $bookingEventsRelatedByCancelledByToDelete = $this->getBookingEventsRelatedByCancelledBy(new Criteria(), $con)->diff($bookingEventsRelatedByCancelledBy);


        $this->bookingEventsRelatedByCancelledByScheduledForDeletion = $bookingEventsRelatedByCancelledByToDelete;

        foreach ($bookingEventsRelatedByCancelledByToDelete as $bookingEventRelatedByCancelledByRemoved) {
            $bookingEventRelatedByCancelledByRemoved->setUserRelatedByCancelledBy(null);
        }

        $this->collBookingEventsRelatedByCancelledBy = null;
        foreach ($bookingEventsRelatedByCancelledBy as $bookingEventRelatedByCancelledBy) {
            $this->addBookingEventRelatedByCancelledBy($bookingEventRelatedByCancelledBy);
        }

        $this->collBookingEventsRelatedByCancelledBy = $bookingEventsRelatedByCancelledBy;
        $this->collBookingEventsRelatedByCancelledByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvent objects.
     * @throws PropelException
     */
    public function countBookingEventsRelatedByCancelledBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByCancelledByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByCancelledBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByCancelledBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventsRelatedByCancelledBy());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCancelledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByCancelledBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addBookingEventRelatedByCancelledBy(ChildBookingEvent $l)
    {
        if ($this->collBookingEventsRelatedByCancelledBy === null) {
            $this->initBookingEventsRelatedByCancelledBy();
            $this->collBookingEventsRelatedByCancelledByPartial = true;
        }

        if (!$this->collBookingEventsRelatedByCancelledBy->contains($l)) {
            $this->doAddBookingEventRelatedByCancelledBy($l);

            if ($this->bookingEventsRelatedByCancelledByScheduledForDeletion and $this->bookingEventsRelatedByCancelledByScheduledForDeletion->contains($l)) {
                $this->bookingEventsRelatedByCancelledByScheduledForDeletion->remove($this->bookingEventsRelatedByCancelledByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEventRelatedByCancelledBy The ChildBookingEvent object to add.
     */
    protected function doAddBookingEventRelatedByCancelledBy(ChildBookingEvent $bookingEventRelatedByCancelledBy)
    {
        $this->collBookingEventsRelatedByCancelledBy[]= $bookingEventRelatedByCancelledBy;
        $bookingEventRelatedByCancelledBy->setUserRelatedByCancelledBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByCancelledBy The ChildBookingEvent object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeBookingEventRelatedByCancelledBy(ChildBookingEvent $bookingEventRelatedByCancelledBy)
    {
        if ($this->getBookingEventsRelatedByCancelledBy()->contains($bookingEventRelatedByCancelledBy)) {
            $pos = $this->collBookingEventsRelatedByCancelledBy->search($bookingEventRelatedByCancelledBy);
            $this->collBookingEventsRelatedByCancelledBy->remove($pos);
            if (null === $this->bookingEventsRelatedByCancelledByScheduledForDeletion) {
                $this->bookingEventsRelatedByCancelledByScheduledForDeletion = clone $this->collBookingEventsRelatedByCancelledBy;
                $this->bookingEventsRelatedByCancelledByScheduledForDeletion->clear();
            }
            $this->bookingEventsRelatedByCancelledByScheduledForDeletion[]= $bookingEventRelatedByCancelledBy;
            $bookingEventRelatedByCancelledBy->setUserRelatedByCancelledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCancelledByJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEventsRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCancelledByJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEventsRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCancelledByJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingEventsRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCancelledByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventsRelatedByCancelledBy($query, $con);
    }

    /**
     * Clears out the collBookingEventsRelatedByDeletedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventsRelatedByDeletedBy()
     */
    public function clearBookingEventsRelatedByDeletedBy()
    {
        $this->collBookingEventsRelatedByDeletedBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventsRelatedByDeletedBy collection loaded partially.
     */
    public function resetPartialBookingEventsRelatedByDeletedBy($v = true)
    {
        $this->collBookingEventsRelatedByDeletedByPartial = $v;
    }

    /**
     * Initializes the collBookingEventsRelatedByDeletedBy collection.
     *
     * By default this just sets the collBookingEventsRelatedByDeletedBy collection to an empty array (like clearcollBookingEventsRelatedByDeletedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventsRelatedByDeletedBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventsRelatedByDeletedBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventsRelatedByDeletedBy = new $collectionClassName;
        $this->collBookingEventsRelatedByDeletedBy->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEventsRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByDeletedByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByDeletedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByDeletedBy) {
                // return empty collection
                $this->initBookingEventsRelatedByDeletedBy();
            } else {
                $collBookingEventsRelatedByDeletedBy = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByUserRelatedByDeletedBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsRelatedByDeletedByPartial && count($collBookingEventsRelatedByDeletedBy)) {
                        $this->initBookingEventsRelatedByDeletedBy(false);

                        foreach ($collBookingEventsRelatedByDeletedBy as $obj) {
                            if (false == $this->collBookingEventsRelatedByDeletedBy->contains($obj)) {
                                $this->collBookingEventsRelatedByDeletedBy->append($obj);
                            }
                        }

                        $this->collBookingEventsRelatedByDeletedByPartial = true;
                    }

                    return $collBookingEventsRelatedByDeletedBy;
                }

                if ($partial && $this->collBookingEventsRelatedByDeletedBy) {
                    foreach ($this->collBookingEventsRelatedByDeletedBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventsRelatedByDeletedBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventsRelatedByDeletedBy = $collBookingEventsRelatedByDeletedBy;
                $this->collBookingEventsRelatedByDeletedByPartial = false;
            }
        }

        return $this->collBookingEventsRelatedByDeletedBy;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventsRelatedByDeletedBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByDeletedBy(Collection $bookingEventsRelatedByDeletedBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByDeletedByToDelete */
        $bookingEventsRelatedByDeletedByToDelete = $this->getBookingEventsRelatedByDeletedBy(new Criteria(), $con)->diff($bookingEventsRelatedByDeletedBy);


        $this->bookingEventsRelatedByDeletedByScheduledForDeletion = $bookingEventsRelatedByDeletedByToDelete;

        foreach ($bookingEventsRelatedByDeletedByToDelete as $bookingEventRelatedByDeletedByRemoved) {
            $bookingEventRelatedByDeletedByRemoved->setUserRelatedByDeletedBy(null);
        }

        $this->collBookingEventsRelatedByDeletedBy = null;
        foreach ($bookingEventsRelatedByDeletedBy as $bookingEventRelatedByDeletedBy) {
            $this->addBookingEventRelatedByDeletedBy($bookingEventRelatedByDeletedBy);
        }

        $this->collBookingEventsRelatedByDeletedBy = $bookingEventsRelatedByDeletedBy;
        $this->collBookingEventsRelatedByDeletedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvent objects.
     * @throws PropelException
     */
    public function countBookingEventsRelatedByDeletedBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsRelatedByDeletedByPartial && !$this->isNew();
        if (null === $this->collBookingEventsRelatedByDeletedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventsRelatedByDeletedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventsRelatedByDeletedBy());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByDeletedBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByDeletedBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addBookingEventRelatedByDeletedBy(ChildBookingEvent $l)
    {
        if ($this->collBookingEventsRelatedByDeletedBy === null) {
            $this->initBookingEventsRelatedByDeletedBy();
            $this->collBookingEventsRelatedByDeletedByPartial = true;
        }

        if (!$this->collBookingEventsRelatedByDeletedBy->contains($l)) {
            $this->doAddBookingEventRelatedByDeletedBy($l);

            if ($this->bookingEventsRelatedByDeletedByScheduledForDeletion and $this->bookingEventsRelatedByDeletedByScheduledForDeletion->contains($l)) {
                $this->bookingEventsRelatedByDeletedByScheduledForDeletion->remove($this->bookingEventsRelatedByDeletedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEventRelatedByDeletedBy The ChildBookingEvent object to add.
     */
    protected function doAddBookingEventRelatedByDeletedBy(ChildBookingEvent $bookingEventRelatedByDeletedBy)
    {
        $this->collBookingEventsRelatedByDeletedBy[]= $bookingEventRelatedByDeletedBy;
        $bookingEventRelatedByDeletedBy->setUserRelatedByDeletedBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByDeletedBy The ChildBookingEvent object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeBookingEventRelatedByDeletedBy(ChildBookingEvent $bookingEventRelatedByDeletedBy)
    {
        if ($this->getBookingEventsRelatedByDeletedBy()->contains($bookingEventRelatedByDeletedBy)) {
            $pos = $this->collBookingEventsRelatedByDeletedBy->search($bookingEventRelatedByDeletedBy);
            $this->collBookingEventsRelatedByDeletedBy->remove($pos);
            if (null === $this->bookingEventsRelatedByDeletedByScheduledForDeletion) {
                $this->bookingEventsRelatedByDeletedByScheduledForDeletion = clone $this->collBookingEventsRelatedByDeletedBy;
                $this->bookingEventsRelatedByDeletedByScheduledForDeletion->clear();
            }
            $this->bookingEventsRelatedByDeletedByScheduledForDeletion[]= $bookingEventRelatedByDeletedBy;
            $bookingEventRelatedByDeletedBy->setUserRelatedByDeletedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByDeletedByJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEventsRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByDeletedByJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEventsRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByDeletedByJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingEventsRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByDeletedByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventsRelatedByDeletedBy($query, $con);
    }

    /**
     * Clears out the collBookings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookings()
     */
    public function clearBookings()
    {
        $this->collBookings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookings collection loaded partially.
     */
    public function resetPartialBookings($v = true)
    {
        $this->collBookingsPartial = $v;
    }

    /**
     * Initializes the collBookings collection.
     *
     * By default this just sets the collBookings collection to an empty array (like clearcollBookings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookings($overrideExisting = true)
    {
        if (null !== $this->collBookings && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingTableMap::getTableMap()->getCollectionClassName();

        $this->collBookings = new $collectionClassName;
        $this->collBookings->setModel('\TheFarm\Models\Booking');
    }

    /**
     * Gets an array of ChildBooking objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     * @throws PropelException
     */
    public function getBookings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsPartial && !$this->isNew();
        if (null === $this->collBookings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookings) {
                // return empty collection
                $this->initBookings();
            } else {
                $collBookings = ChildBookingQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingsPartial && count($collBookings)) {
                        $this->initBookings(false);

                        foreach ($collBookings as $obj) {
                            if (false == $this->collBookings->contains($obj)) {
                                $this->collBookings->append($obj);
                            }
                        }

                        $this->collBookingsPartial = true;
                    }

                    return $collBookings;
                }

                if ($partial && $this->collBookings) {
                    foreach ($this->collBookings as $obj) {
                        if ($obj->isNew()) {
                            $collBookings[] = $obj;
                        }
                    }
                }

                $this->collBookings = $collBookings;
                $this->collBookingsPartial = false;
            }
        }

        return $this->collBookings;
    }

    /**
     * Sets a collection of ChildBooking objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setBookings(Collection $bookings, ConnectionInterface $con = null)
    {
        /** @var ChildBooking[] $bookingsToDelete */
        $bookingsToDelete = $this->getBookings(new Criteria(), $con)->diff($bookings);


        $this->bookingsScheduledForDeletion = $bookingsToDelete;

        foreach ($bookingsToDelete as $bookingRemoved) {
            $bookingRemoved->setUser(null);
        }

        $this->collBookings = null;
        foreach ($bookings as $booking) {
            $this->addBooking($booking);
        }

        $this->collBookings = $bookings;
        $this->collBookingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Booking objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Booking objects.
     * @throws PropelException
     */
    public function countBookings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsPartial && !$this->isNew();
        if (null === $this->collBookings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookings());
            }

            $query = ChildBookingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collBookings);
    }

    /**
     * Method called to associate a ChildBooking object to this object
     * through the ChildBooking foreign key attribute.
     *
     * @param  ChildBooking $l ChildBooking
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addBooking(ChildBooking $l)
    {
        if ($this->collBookings === null) {
            $this->initBookings();
            $this->collBookingsPartial = true;
        }

        if (!$this->collBookings->contains($l)) {
            $this->doAddBooking($l);

            if ($this->bookingsScheduledForDeletion and $this->bookingsScheduledForDeletion->contains($l)) {
                $this->bookingsScheduledForDeletion->remove($this->bookingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooking $booking The ChildBooking object to add.
     */
    protected function doAddBooking(ChildBooking $booking)
    {
        $this->collBookings[]= $booking;
        $booking->setUser($this);
    }

    /**
     * @param  ChildBooking $booking The ChildBooking object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeBooking(ChildBooking $booking)
    {
        if ($this->getBookings()->contains($booking)) {
            $pos = $this->collBookings->search($booking);
            $this->collBookings->remove($pos);
            if (null === $this->bookingsScheduledForDeletion) {
                $this->bookingsScheduledForDeletion = clone $this->collBookings;
                $this->bookingsScheduledForDeletion->clear();
            }
            $this->bookingsScheduledForDeletion[]= $booking;
            $booking->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinContact(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Contact', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinRoom(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Room', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookings($query, $con);
    }

    /**
     * Clears out the collItemsRelatedUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemsRelatedUsers()
     */
    public function clearItemsRelatedUsers()
    {
        $this->collItemsRelatedUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemsRelatedUsers collection loaded partially.
     */
    public function resetPartialItemsRelatedUsers($v = true)
    {
        $this->collItemsRelatedUsersPartial = $v;
    }

    /**
     * Initializes the collItemsRelatedUsers collection.
     *
     * By default this just sets the collItemsRelatedUsers collection to an empty array (like clearcollItemsRelatedUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemsRelatedUsers($overrideExisting = true)
    {
        if (null !== $this->collItemsRelatedUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemsRelatedUserTableMap::getTableMap()->getCollectionClassName();

        $this->collItemsRelatedUsers = new $collectionClassName;
        $this->collItemsRelatedUsers->setModel('\TheFarm\Models\ItemsRelatedUser');
    }

    /**
     * Gets an array of ChildItemsRelatedUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemsRelatedUser[] List of ChildItemsRelatedUser objects
     * @throws PropelException
     */
    public function getItemsRelatedUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedUsersPartial && !$this->isNew();
        if (null === $this->collItemsRelatedUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedUsers) {
                // return empty collection
                $this->initItemsRelatedUsers();
            } else {
                $collItemsRelatedUsers = ChildItemsRelatedUserQuery::create(null, $criteria)
                    ->filterByContact($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemsRelatedUsersPartial && count($collItemsRelatedUsers)) {
                        $this->initItemsRelatedUsers(false);

                        foreach ($collItemsRelatedUsers as $obj) {
                            if (false == $this->collItemsRelatedUsers->contains($obj)) {
                                $this->collItemsRelatedUsers->append($obj);
                            }
                        }

                        $this->collItemsRelatedUsersPartial = true;
                    }

                    return $collItemsRelatedUsers;
                }

                if ($partial && $this->collItemsRelatedUsers) {
                    foreach ($this->collItemsRelatedUsers as $obj) {
                        if ($obj->isNew()) {
                            $collItemsRelatedUsers[] = $obj;
                        }
                    }
                }

                $this->collItemsRelatedUsers = $collItemsRelatedUsers;
                $this->collItemsRelatedUsersPartial = false;
            }
        }

        return $this->collItemsRelatedUsers;
    }

    /**
     * Sets a collection of ChildItemsRelatedUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemsRelatedUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setItemsRelatedUsers(Collection $itemsRelatedUsers, ConnectionInterface $con = null)
    {
        /** @var ChildItemsRelatedUser[] $itemsRelatedUsersToDelete */
        $itemsRelatedUsersToDelete = $this->getItemsRelatedUsers(new Criteria(), $con)->diff($itemsRelatedUsers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->itemsRelatedUsersScheduledForDeletion = clone $itemsRelatedUsersToDelete;

        foreach ($itemsRelatedUsersToDelete as $itemsRelatedUserRemoved) {
            $itemsRelatedUserRemoved->setContact(null);
        }

        $this->collItemsRelatedUsers = null;
        foreach ($itemsRelatedUsers as $itemsRelatedUser) {
            $this->addItemsRelatedUser($itemsRelatedUser);
        }

        $this->collItemsRelatedUsers = $itemsRelatedUsers;
        $this->collItemsRelatedUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemsRelatedUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemsRelatedUser objects.
     * @throws PropelException
     */
    public function countItemsRelatedUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedUsersPartial && !$this->isNew();
        if (null === $this->collItemsRelatedUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemsRelatedUsers());
            }

            $query = ChildItemsRelatedUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collItemsRelatedUsers);
    }

    /**
     * Method called to associate a ChildItemsRelatedUser object to this object
     * through the ChildItemsRelatedUser foreign key attribute.
     *
     * @param  ChildItemsRelatedUser $l ChildItemsRelatedUser
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addItemsRelatedUser(ChildItemsRelatedUser $l)
    {
        if ($this->collItemsRelatedUsers === null) {
            $this->initItemsRelatedUsers();
            $this->collItemsRelatedUsersPartial = true;
        }

        if (!$this->collItemsRelatedUsers->contains($l)) {
            $this->doAddItemsRelatedUser($l);

            if ($this->itemsRelatedUsersScheduledForDeletion and $this->itemsRelatedUsersScheduledForDeletion->contains($l)) {
                $this->itemsRelatedUsersScheduledForDeletion->remove($this->itemsRelatedUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemsRelatedUser $itemsRelatedUser The ChildItemsRelatedUser object to add.
     */
    protected function doAddItemsRelatedUser(ChildItemsRelatedUser $itemsRelatedUser)
    {
        $this->collItemsRelatedUsers[]= $itemsRelatedUser;
        $itemsRelatedUser->setContact($this);
    }

    /**
     * @param  ChildItemsRelatedUser $itemsRelatedUser The ChildItemsRelatedUser object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeItemsRelatedUser(ChildItemsRelatedUser $itemsRelatedUser)
    {
        if ($this->getItemsRelatedUsers()->contains($itemsRelatedUser)) {
            $pos = $this->collItemsRelatedUsers->search($itemsRelatedUser);
            $this->collItemsRelatedUsers->remove($pos);
            if (null === $this->itemsRelatedUsersScheduledForDeletion) {
                $this->itemsRelatedUsersScheduledForDeletion = clone $this->collItemsRelatedUsers;
                $this->itemsRelatedUsersScheduledForDeletion->clear();
            }
            $this->itemsRelatedUsersScheduledForDeletion[]= clone $itemsRelatedUser;
            $itemsRelatedUser->setContact(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ItemsRelatedUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemsRelatedUser[] List of ChildItemsRelatedUser objects
     */
    public function getItemsRelatedUsersJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemsRelatedUserQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getItemsRelatedUsers($query, $con);
    }

    /**
     * Clears out the collUserWorkPlanDays collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserWorkPlanDays()
     */
    public function clearUserWorkPlanDays()
    {
        $this->collUserWorkPlanDays = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserWorkPlanDays collection loaded partially.
     */
    public function resetPartialUserWorkPlanDays($v = true)
    {
        $this->collUserWorkPlanDaysPartial = $v;
    }

    /**
     * Initializes the collUserWorkPlanDays collection.
     *
     * By default this just sets the collUserWorkPlanDays collection to an empty array (like clearcollUserWorkPlanDays());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserWorkPlanDays($overrideExisting = true)
    {
        if (null !== $this->collUserWorkPlanDays && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserWorkPlanDayTableMap::getTableMap()->getCollectionClassName();

        $this->collUserWorkPlanDays = new $collectionClassName;
        $this->collUserWorkPlanDays->setModel('\TheFarm\Models\UserWorkPlanDay');
    }

    /**
     * Gets an array of ChildUserWorkPlanDay objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserWorkPlanDay[] List of ChildUserWorkPlanDay objects
     * @throws PropelException
     */
    public function getUserWorkPlanDays(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWorkPlanDaysPartial && !$this->isNew();
        if (null === $this->collUserWorkPlanDays || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserWorkPlanDays) {
                // return empty collection
                $this->initUserWorkPlanDays();
            } else {
                $collUserWorkPlanDays = ChildUserWorkPlanDayQuery::create(null, $criteria)
                    ->filterByContact($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserWorkPlanDaysPartial && count($collUserWorkPlanDays)) {
                        $this->initUserWorkPlanDays(false);

                        foreach ($collUserWorkPlanDays as $obj) {
                            if (false == $this->collUserWorkPlanDays->contains($obj)) {
                                $this->collUserWorkPlanDays->append($obj);
                            }
                        }

                        $this->collUserWorkPlanDaysPartial = true;
                    }

                    return $collUserWorkPlanDays;
                }

                if ($partial && $this->collUserWorkPlanDays) {
                    foreach ($this->collUserWorkPlanDays as $obj) {
                        if ($obj->isNew()) {
                            $collUserWorkPlanDays[] = $obj;
                        }
                    }
                }

                $this->collUserWorkPlanDays = $collUserWorkPlanDays;
                $this->collUserWorkPlanDaysPartial = false;
            }
        }

        return $this->collUserWorkPlanDays;
    }

    /**
     * Sets a collection of ChildUserWorkPlanDay objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userWorkPlanDays A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserWorkPlanDays(Collection $userWorkPlanDays, ConnectionInterface $con = null)
    {
        /** @var ChildUserWorkPlanDay[] $userWorkPlanDaysToDelete */
        $userWorkPlanDaysToDelete = $this->getUserWorkPlanDays(new Criteria(), $con)->diff($userWorkPlanDays);


        $this->userWorkPlanDaysScheduledForDeletion = $userWorkPlanDaysToDelete;

        foreach ($userWorkPlanDaysToDelete as $userWorkPlanDayRemoved) {
            $userWorkPlanDayRemoved->setContact(null);
        }

        $this->collUserWorkPlanDays = null;
        foreach ($userWorkPlanDays as $userWorkPlanDay) {
            $this->addUserWorkPlanDay($userWorkPlanDay);
        }

        $this->collUserWorkPlanDays = $userWorkPlanDays;
        $this->collUserWorkPlanDaysPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserWorkPlanDay objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserWorkPlanDay objects.
     * @throws PropelException
     */
    public function countUserWorkPlanDays(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWorkPlanDaysPartial && !$this->isNew();
        if (null === $this->collUserWorkPlanDays || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserWorkPlanDays) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserWorkPlanDays());
            }

            $query = ChildUserWorkPlanDayQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collUserWorkPlanDays);
    }

    /**
     * Method called to associate a ChildUserWorkPlanDay object to this object
     * through the ChildUserWorkPlanDay foreign key attribute.
     *
     * @param  ChildUserWorkPlanDay $l ChildUserWorkPlanDay
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addUserWorkPlanDay(ChildUserWorkPlanDay $l)
    {
        if ($this->collUserWorkPlanDays === null) {
            $this->initUserWorkPlanDays();
            $this->collUserWorkPlanDaysPartial = true;
        }

        if (!$this->collUserWorkPlanDays->contains($l)) {
            $this->doAddUserWorkPlanDay($l);

            if ($this->userWorkPlanDaysScheduledForDeletion and $this->userWorkPlanDaysScheduledForDeletion->contains($l)) {
                $this->userWorkPlanDaysScheduledForDeletion->remove($this->userWorkPlanDaysScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserWorkPlanDay $userWorkPlanDay The ChildUserWorkPlanDay object to add.
     */
    protected function doAddUserWorkPlanDay(ChildUserWorkPlanDay $userWorkPlanDay)
    {
        $this->collUserWorkPlanDays[]= $userWorkPlanDay;
        $userWorkPlanDay->setContact($this);
    }

    /**
     * @param  ChildUserWorkPlanDay $userWorkPlanDay The ChildUserWorkPlanDay object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserWorkPlanDay(ChildUserWorkPlanDay $userWorkPlanDay)
    {
        if ($this->getUserWorkPlanDays()->contains($userWorkPlanDay)) {
            $pos = $this->collUserWorkPlanDays->search($userWorkPlanDay);
            $this->collUserWorkPlanDays->remove($pos);
            if (null === $this->userWorkPlanDaysScheduledForDeletion) {
                $this->userWorkPlanDaysScheduledForDeletion = clone $this->collUserWorkPlanDays;
                $this->userWorkPlanDaysScheduledForDeletion->clear();
            }
            $this->userWorkPlanDaysScheduledForDeletion[]= clone $userWorkPlanDay;
            $userWorkPlanDay->setContact(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserWorkPlanDays from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserWorkPlanDay[] List of ChildUserWorkPlanDay objects
     */
    public function getUserWorkPlanDaysJoinWorkPlan(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserWorkPlanDayQuery::create(null, $criteria);
        $query->joinWith('WorkPlan', $joinBehavior);

        return $this->getUserWorkPlanDays($query, $con);
    }

    /**
     * Clears out the collProviderSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProviderSchedules()
     */
    public function clearProviderSchedules()
    {
        $this->collProviderSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProviderSchedules collection loaded partially.
     */
    public function resetPartialProviderSchedules($v = true)
    {
        $this->collProviderSchedulesPartial = $v;
    }

    /**
     * Initializes the collProviderSchedules collection.
     *
     * By default this just sets the collProviderSchedules collection to an empty array (like clearcollProviderSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProviderSchedules($overrideExisting = true)
    {
        if (null !== $this->collProviderSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProviderScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collProviderSchedules = new $collectionClassName;
        $this->collProviderSchedules->setModel('\TheFarm\Models\ProviderSchedule');
    }

    /**
     * Gets an array of ChildProviderSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProviderSchedule[] List of ChildProviderSchedule objects
     * @throws PropelException
     */
    public function getProviderSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProviderSchedulesPartial && !$this->isNew();
        if (null === $this->collProviderSchedules || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProviderSchedules) {
                // return empty collection
                $this->initProviderSchedules();
            } else {
                $collProviderSchedules = ChildProviderScheduleQuery::create(null, $criteria)
                    ->filterByContact($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProviderSchedulesPartial && count($collProviderSchedules)) {
                        $this->initProviderSchedules(false);

                        foreach ($collProviderSchedules as $obj) {
                            if (false == $this->collProviderSchedules->contains($obj)) {
                                $this->collProviderSchedules->append($obj);
                            }
                        }

                        $this->collProviderSchedulesPartial = true;
                    }

                    return $collProviderSchedules;
                }

                if ($partial && $this->collProviderSchedules) {
                    foreach ($this->collProviderSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collProviderSchedules[] = $obj;
                        }
                    }
                }

                $this->collProviderSchedules = $collProviderSchedules;
                $this->collProviderSchedulesPartial = false;
            }
        }

        return $this->collProviderSchedules;
    }

    /**
     * Sets a collection of ChildProviderSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $providerSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setProviderSchedules(Collection $providerSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildProviderSchedule[] $providerSchedulesToDelete */
        $providerSchedulesToDelete = $this->getProviderSchedules(new Criteria(), $con)->diff($providerSchedules);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->providerSchedulesScheduledForDeletion = clone $providerSchedulesToDelete;

        foreach ($providerSchedulesToDelete as $providerScheduleRemoved) {
            $providerScheduleRemoved->setContact(null);
        }

        $this->collProviderSchedules = null;
        foreach ($providerSchedules as $providerSchedule) {
            $this->addProviderSchedule($providerSchedule);
        }

        $this->collProviderSchedules = $providerSchedules;
        $this->collProviderSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProviderSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProviderSchedule objects.
     * @throws PropelException
     */
    public function countProviderSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProviderSchedulesPartial && !$this->isNew();
        if (null === $this->collProviderSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProviderSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProviderSchedules());
            }

            $query = ChildProviderScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collProviderSchedules);
    }

    /**
     * Method called to associate a ChildProviderSchedule object to this object
     * through the ChildProviderSchedule foreign key attribute.
     *
     * @param  ChildProviderSchedule $l ChildProviderSchedule
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function addProviderSchedule(ChildProviderSchedule $l)
    {
        if ($this->collProviderSchedules === null) {
            $this->initProviderSchedules();
            $this->collProviderSchedulesPartial = true;
        }

        if (!$this->collProviderSchedules->contains($l)) {
            $this->doAddProviderSchedule($l);

            if ($this->providerSchedulesScheduledForDeletion and $this->providerSchedulesScheduledForDeletion->contains($l)) {
                $this->providerSchedulesScheduledForDeletion->remove($this->providerSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProviderSchedule $providerSchedule The ChildProviderSchedule object to add.
     */
    protected function doAddProviderSchedule(ChildProviderSchedule $providerSchedule)
    {
        $this->collProviderSchedules[]= $providerSchedule;
        $providerSchedule->setContact($this);
    }

    /**
     * @param  ChildProviderSchedule $providerSchedule The ChildProviderSchedule object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeProviderSchedule(ChildProviderSchedule $providerSchedule)
    {
        if ($this->getProviderSchedules()->contains($providerSchedule)) {
            $pos = $this->collProviderSchedules->search($providerSchedule);
            $this->collProviderSchedules->remove($pos);
            if (null === $this->providerSchedulesScheduledForDeletion) {
                $this->providerSchedulesScheduledForDeletion = clone $this->collProviderSchedules;
                $this->providerSchedulesScheduledForDeletion->clear();
            }
            $this->providerSchedulesScheduledForDeletion[]= clone $providerSchedule;
            $providerSchedule->setContact(null);
        }

        return $this;
    }

    /**
     * Clears out the collItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItems()
     */
    public function clearItems()
    {
        $this->collItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collItems crossRef collection.
     *
     * By default this just sets the collItems collection to an empty collection (like clearItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initItems()
    {
        $collectionClassName = ItemsRelatedUserTableMap::getTableMap()->getCollectionClassName();

        $this->collItems = new $collectionClassName;
        $this->collItemsPartial = true;
        $this->collItems->setModel('\TheFarm\Models\Item');
    }

    /**
     * Checks if the collItems collection is loaded.
     *
     * @return bool
     */
    public function isItemsLoaded()
    {
        return null !== $this->collItems;
    }

    /**
     * Gets a collection of ChildItem objects related by a many-to-many relationship
     * to the current object by way of the tf_items_related_users cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildItem[] List of ChildItem objects
     */
    public function getItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collItems) {
                    $this->initItems();
                }
            } else {

                $query = ChildItemQuery::create(null, $criteria)
                    ->filterByContact($this);
                $collItems = $query->find($con);
                if (null !== $criteria) {
                    return $collItems;
                }

                if ($partial && $this->collItems) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collItems as $obj) {
                        if (!$collItems->contains($obj)) {
                            $collItems[] = $obj;
                        }
                    }
                }

                $this->collItems = $collItems;
                $this->collItemsPartial = false;
            }
        }

        return $this->collItems;
    }

    /**
     * Sets a collection of Item objects related by a many-to-many relationship
     * to the current object by way of the tf_items_related_users cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $items A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setItems(Collection $items, ConnectionInterface $con = null)
    {
        $this->clearItems();
        $currentItems = $this->getItems();

        $itemsScheduledForDeletion = $currentItems->diff($items);

        foreach ($itemsScheduledForDeletion as $toDelete) {
            $this->removeItem($toDelete);
        }

        foreach ($items as $item) {
            if (!$currentItems->contains($item)) {
                $this->doAddItem($item);
            }
        }

        $this->collItemsPartial = false;
        $this->collItems = $items;

        return $this;
    }

    /**
     * Gets the number of Item objects related by a many-to-many relationship
     * to the current object by way of the tf_items_related_users cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Item objects
     */
    public function countItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItems) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getItems());
                }

                $query = ChildItemQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByContact($this)
                    ->count($con);
            }
        } else {
            return count($this->collItems);
        }
    }

    /**
     * Associate a ChildItem to this object
     * through the tf_items_related_users cross reference table.
     *
     * @param ChildItem $item
     * @return ChildUser The current object (for fluent API support)
     */
    public function addItem(ChildItem $item)
    {
        if ($this->collItems === null) {
            $this->initItems();
        }

        if (!$this->getItems()->contains($item)) {
            // only add it if the **same** object is not already associated
            $this->collItems->push($item);
            $this->doAddItem($item);
        }

        return $this;
    }

    /**
     *
     * @param ChildItem $item
     */
    protected function doAddItem(ChildItem $item)
    {
        $itemsRelatedUser = new ChildItemsRelatedUser();

        $itemsRelatedUser->setItem($item);

        $itemsRelatedUser->setContact($this);

        $this->addItemsRelatedUser($itemsRelatedUser);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$item->isContactsLoaded()) {
            $item->initContacts();
            $item->getContacts()->push($this);
        } elseif (!$item->getContacts()->contains($this)) {
            $item->getContacts()->push($this);
        }

    }

    /**
     * Remove item of this object
     * through the tf_items_related_users cross reference table.
     *
     * @param ChildItem $item
     * @return ChildUser The current object (for fluent API support)
     */
    public function removeItem(ChildItem $item)
    {
        if ($this->getItems()->contains($item)) {
            $itemsRelatedUser = new ChildItemsRelatedUser();
            $itemsRelatedUser->setItem($item);
            if ($item->isContactsLoaded()) {
                //remove the back reference if available
                $item->getContacts()->removeObject($this);
            }

            $itemsRelatedUser->setContact($this);
            $this->removeItemsRelatedUser(clone $itemsRelatedUser);
            $itemsRelatedUser->clear();

            $this->collItems->remove($this->collItems->search($item));

            if (null === $this->itemsScheduledForDeletion) {
                $this->itemsScheduledForDeletion = clone $this->collItems;
                $this->itemsScheduledForDeletion->clear();
            }

            $this->itemsScheduledForDeletion->push($item);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aGroup) {
            $this->aGroup->removeUser($this);
        }
        if (null !== $this->aLocation) {
            $this->aLocation->removeUser($this);
        }
        $this->user_id = null;
        $this->username = null;
        $this->group_id = null;
        $this->last_login = null;
        $this->password = null;
        $this->work_plan = null;
        $this->work_plan_code = null;
        $this->location_id = null;
        $this->facebook_id = null;
        $this->user_order = null;
        $this->calendar_view_positions = null;
        $this->calendar_view_status = null;
        $this->calendar_show_my_schedule_only = null;
        $this->calendar_view_locations = null;
        $this->preferences = null;
        $this->calendar_show_no_schedule = null;
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
            if ($this->collEventUsers) {
                foreach ($this->collEventUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventsRelatedByAuthorId) {
                foreach ($this->collBookingEventsRelatedByAuthorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventsRelatedByCalledBy) {
                foreach ($this->collBookingEventsRelatedByCalledBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventsRelatedByCancelledBy) {
                foreach ($this->collBookingEventsRelatedByCancelledBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventsRelatedByDeletedBy) {
                foreach ($this->collBookingEventsRelatedByDeletedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookings) {
                foreach ($this->collBookings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemsRelatedUsers) {
                foreach ($this->collItemsRelatedUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserWorkPlanDays) {
                foreach ($this->collUserWorkPlanDays as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProviderSchedules) {
                foreach ($this->collProviderSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItems) {
                foreach ($this->collItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEventUsers = null;
        $this->collBookingEventsRelatedByAuthorId = null;
        $this->collBookingEventsRelatedByCalledBy = null;
        $this->collBookingEventsRelatedByCancelledBy = null;
        $this->collBookingEventsRelatedByDeletedBy = null;
        $this->collBookings = null;
        $this->collItemsRelatedUsers = null;
        $this->collUserWorkPlanDays = null;
        $this->collProviderSchedules = null;
        $this->collItems = null;
        $this->aGroup = null;
        $this->aLocation = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
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
