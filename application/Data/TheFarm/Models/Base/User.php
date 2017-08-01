<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\Group as ChildGroup;
use TheFarm\Models\GroupQuery as ChildGroupQuery;
use TheFarm\Models\Location as ChildLocation;
use TheFarm\Models\LocationQuery as ChildLocationQuery;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\UserTableMap;

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
     * The value for the contact_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $contact_id;

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
     * @var        ChildContact
     */
    protected $aContact;

    /**
     * @var        ChildGroup
     */
    protected $aGroup;

    /**
     * @var        ChildLocation
     */
    protected $aLocation;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->contact_id = 0;
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
     * Get the [contact_id] column value.
     *
     * @return int
     */
    public function getContactId()
    {
        return $this->contact_id;
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
     * Set the value of [contact_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     */
    public function setContactId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->contact_id !== $v) {
            $this->contact_id = $v;
            $this->modifiedColumns[UserTableMap::COL_CONTACT_ID] = true;
        }

        if ($this->aContact !== null && $this->aContact->getContactId() !== $v) {
            $this->aContact = null;
        }

        return $this;
    } // setContactId()

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
            if ($this->contact_id !== 0) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_id = (null !== $col) ? (int) $col : null;

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
        if ($this->aContact !== null && $this->contact_id !== $this->aContact->getContactId()) {
            $this->aContact = null;
        }
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

            $this->aContact = null;
            $this->aGroup = null;
            $this->aLocation = null;
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

            if ($this->aContact !== null) {
                if ($this->aContact->isModified() || $this->aContact->isNew()) {
                    $affectedRows += $this->aContact->save($con);
                }
                $this->setContact($this->aContact);
            }

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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_CONTACT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'contact_id';
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
                    case 'contact_id':
                        $stmt->bindValue($identifier, $this->contact_id, PDO::PARAM_INT);
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
                return $this->getContactId();
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
            $keys[0] => $this->getContactId(),
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
            if (null !== $this->aContact) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'contact';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_contacts';
                        break;
                    default:
                        $key = 'Contact';
                }

                $result[$key] = $this->aContact->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
                $this->setContactId($value);
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
            $this->setContactId($arr[$keys[0]]);
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

        if ($this->isColumnModified(UserTableMap::COL_CONTACT_ID)) {
            $criteria->add(UserTableMap::COL_CONTACT_ID, $this->contact_id);
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
        $criteria->add(UserTableMap::COL_CONTACT_ID, $this->contact_id);

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
        $validPk = null !== $this->getContactId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation contact_fk to table tf_contacts
        if ($this->aContact && $hash = spl_object_hash($this->aContact)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

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
        return $this->getContactId();
    }

    /**
     * Generic method to set the primary key (contact_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setContactId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getContactId();
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
        $copyObj->setContactId($this->getContactId());
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
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * Declares an association between this object and a ChildContact object.
     *
     * @param  ChildContact $v
     * @return $this|\TheFarm\Models\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContact(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setContactId(0);
        } else {
            $this->setContactId($v->getContactId());
        }

        $this->aContact = $v;

        // Add binding for other direction of this 1:1 relationship.
        if ($v !== null) {
            $v->setUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildContact object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildContact The associated ChildContact object.
     * @throws PropelException
     */
    public function getContact(ConnectionInterface $con = null)
    {
        if ($this->aContact === null && ($this->contact_id !== null)) {
            $this->aContact = ChildContactQuery::create()->findPk($this->contact_id, $con);
            // Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
            $this->aContact->setUser($this);
        }

        return $this->aContact;
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aContact) {
            $this->aContact->removeUser($this);
        }
        if (null !== $this->aGroup) {
            $this->aGroup->removeUser($this);
        }
        if (null !== $this->aLocation) {
            $this->aLocation->removeUser($this);
        }
        $this->contact_id = null;
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
        } // if ($deep)

        $this->aContact = null;
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
