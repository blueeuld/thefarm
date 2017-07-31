<?php

namespace TheFarm\Models\Base;

use \DateTime;
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
use Propel\Runtime\Util\PropelDateTime;
use TheFarm\Models\BookingEventUsers as ChildBookingEventUsers;
use TheFarm\Models\BookingEventUsersQuery as ChildBookingEventUsersQuery;
use TheFarm\Models\BookingEvents as ChildBookingEvents;
use TheFarm\Models\BookingEventsQuery as ChildBookingEventsQuery;
use TheFarm\Models\BookingItems as ChildBookingItems;
use TheFarm\Models\BookingItemsQuery as ChildBookingItemsQuery;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\EventStatus as ChildEventStatus;
use TheFarm\Models\EventStatusQuery as ChildEventStatusQuery;
use TheFarm\Models\Facilities as ChildFacilities;
use TheFarm\Models\FacilitiesQuery as ChildFacilitiesQuery;
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\Map\BookingEventUsersTableMap;
use TheFarm\Models\Map\BookingEventsTableMap;

/**
 * Base class that represents a row from the 'tf_booking_events' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class BookingEvents implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\BookingEventsTableMap';


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
     * The value for the event_id field.
     *
     * @var        int
     */
    protected $event_id;

    /**
     * The value for the event_title field.
     *
     * @var        string
     */
    protected $event_title;

    /**
     * The value for the start_dt field.
     *
     * @var        DateTime
     */
    protected $start_dt;

    /**
     * The value for the end_dt field.
     *
     * @var        DateTime
     */
    protected $end_dt;

    /**
     * The value for the facility_id field.
     *
     * @var        int
     */
    protected $facility_id;

    /**
     * The value for the all_day field.
     *
     * @var        int
     */
    protected $all_day;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the author_id field.
     *
     * @var        int
     */
    protected $author_id;

    /**
     * The value for the entry_date field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $entry_date;

    /**
     * The value for the edit_date field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $edit_date;

    /**
     * The value for the notes field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $notes;

    /**
     * The value for the called_by field.
     *
     * @var        int
     */
    protected $called_by;

    /**
     * The value for the cancelled_by field.
     *
     * @var        int
     */
    protected $cancelled_by;

    /**
     * The value for the cancelled_reason field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $cancelled_reason;

    /**
     * The value for the date_cancelled field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $date_cancelled;

    /**
     * The value for the personalized field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $personalized;

    /**
     * The value for the booking_item_id field.
     *
     * @var        int
     */
    protected $booking_item_id;

    /**
     * The value for the is_active field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $is_active;

    /**
     * The value for the deleted_date field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $deleted_date;

    /**
     * The value for the deleted_by field.
     *
     * @var        int
     */
    protected $deleted_by;

    /**
     * The value for the item_id field.
     *
     * @var        int
     */
    protected $item_id;

    /**
     * The value for the is_kids field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $is_kids;

    /**
     * The value for the incl_os_done_number field.
     *
     * @var        string
     */
    protected $incl_os_done_number;

    /**
     * The value for the incl_os_done_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $incl_os_done_amount;

    /**
     * The value for the foc_os_done_number field.
     *
     * @var        string
     */
    protected $foc_os_done_number;

    /**
     * The value for the foc_os_done_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $foc_os_done_amount;

    /**
     * The value for the not_incl_os_done_number field.
     *
     * @var        string
     */
    protected $not_incl_os_done_number;

    /**
     * The value for the not_incl_os_done_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $not_incl_os_done_amount;

    /**
     * The value for the incl field.
     *
     * @var        int
     */
    protected $incl;

    /**
     * The value for the not_incl field.
     *
     * @var        int
     */
    protected $not_incl;

    /**
     * The value for the foc field.
     *
     * @var        int
     */
    protected $foc;

    /**
     * @var        ChildContact
     */
    protected $aContactRelatedByAuthorId;

    /**
     * @var        ChildBookingItems
     */
    protected $aBookingItems;

    /**
     * @var        ChildContact
     */
    protected $aContactRelatedByCalledBy;

    /**
     * @var        ChildContact
     */
    protected $aContactRelatedByCancelledBy;

    /**
     * @var        ChildContact
     */
    protected $aContactRelatedByDeletedBy;

    /**
     * @var        ChildFacilities
     */
    protected $aFacilities;

    /**
     * @var        ChildItems
     */
    protected $aItems;

    /**
     * @var        ChildEventStatus
     */
    protected $aEventStatus;

    /**
     * @var        ObjectCollection|ChildBookingEventUsers[] Collection to store aggregation of ChildBookingEventUsers objects.
     */
    protected $collBookingEventUserss;
    protected $collBookingEventUserssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEventUsers[]
     */
    protected $bookingEventUserssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->entry_date = 0;
        $this->edit_date = 0;
        $this->notes = '';
        $this->cancelled_reason = '';
        $this->date_cancelled = 0;
        $this->personalized = '';
        $this->is_active = 'n';
        $this->deleted_date = 0;
        $this->is_kids = 'n';
        $this->incl_os_done_amount = '0.00';
        $this->foc_os_done_amount = '0.00';
        $this->not_incl_os_done_amount = '0.00';
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\BookingEvents object.
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
     * Compares this with another <code>BookingEvents</code> instance.  If
     * <code>obj</code> is an instance of <code>BookingEvents</code>, delegates to
     * <code>equals(BookingEvents)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|BookingEvents The current object, for fluid interface
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
     * Get the [event_id] column value.
     *
     * @return int
     */
    public function getEventId()
    {
        return $this->event_id;
    }

    /**
     * Get the [event_title] column value.
     *
     * @return string
     */
    public function getEventTitle()
    {
        return $this->event_title;
    }

    /**
     * Get the [optionally formatted] temporal [start_dt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartDt($format = NULL)
    {
        if ($format === null) {
            return $this->start_dt;
        } else {
            return $this->start_dt instanceof \DateTimeInterface ? $this->start_dt->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_dt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndDt($format = NULL)
    {
        if ($format === null) {
            return $this->end_dt;
        } else {
            return $this->end_dt instanceof \DateTimeInterface ? $this->end_dt->format($format) : null;
        }
    }

    /**
     * Get the [facility_id] column value.
     *
     * @return int
     */
    public function getFacilityId()
    {
        return $this->facility_id;
    }

    /**
     * Get the [all_day] column value.
     *
     * @return int
     */
    public function getAllDay()
    {
        return $this->all_day;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [author_id] column value.
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Get the [entry_date] column value.
     *
     * @return int
     */
    public function getEntryDate()
    {
        return $this->entry_date;
    }

    /**
     * Get the [edit_date] column value.
     *
     * @return int
     */
    public function getEditDate()
    {
        return $this->edit_date;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get the [called_by] column value.
     *
     * @return int
     */
    public function getCalledBy()
    {
        return $this->called_by;
    }

    /**
     * Get the [cancelled_by] column value.
     *
     * @return int
     */
    public function getCancelledBy()
    {
        return $this->cancelled_by;
    }

    /**
     * Get the [cancelled_reason] column value.
     *
     * @return string
     */
    public function getCancelledReason()
    {
        return $this->cancelled_reason;
    }

    /**
     * Get the [date_cancelled] column value.
     *
     * @return int
     */
    public function getDateCancelled()
    {
        return $this->date_cancelled;
    }

    /**
     * Get the [personalized] column value.
     *
     * @return string
     */
    public function getPersonalized()
    {
        return $this->personalized;
    }

    /**
     * Get the [booking_item_id] column value.
     *
     * @return int
     */
    public function getBookingItemId()
    {
        return $this->booking_item_id;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [deleted_date] column value.
     *
     * @return int
     */
    public function getDeletedDate()
    {
        return $this->deleted_date;
    }

    /**
     * Get the [deleted_by] column value.
     *
     * @return int
     */
    public function getDeletedBy()
    {
        return $this->deleted_by;
    }

    /**
     * Get the [item_id] column value.
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Get the [is_kids] column value.
     *
     * @return string
     */
    public function getIsKids()
    {
        return $this->is_kids;
    }

    /**
     * Get the [incl_os_done_number] column value.
     *
     * @return string
     */
    public function getInclOsDoneNumber()
    {
        return $this->incl_os_done_number;
    }

    /**
     * Get the [incl_os_done_amount] column value.
     *
     * @return string
     */
    public function getInclOsDoneAmount()
    {
        return $this->incl_os_done_amount;
    }

    /**
     * Get the [foc_os_done_number] column value.
     *
     * @return string
     */
    public function getFocOsDoneNumber()
    {
        return $this->foc_os_done_number;
    }

    /**
     * Get the [foc_os_done_amount] column value.
     *
     * @return string
     */
    public function getFocOsDoneAmount()
    {
        return $this->foc_os_done_amount;
    }

    /**
     * Get the [not_incl_os_done_number] column value.
     *
     * @return string
     */
    public function getNotInclOsDoneNumber()
    {
        return $this->not_incl_os_done_number;
    }

    /**
     * Get the [not_incl_os_done_amount] column value.
     *
     * @return string
     */
    public function getNotInclOsDoneAmount()
    {
        return $this->not_incl_os_done_amount;
    }

    /**
     * Get the [incl] column value.
     *
     * @return int
     */
    public function getIncl()
    {
        return $this->incl;
    }

    /**
     * Get the [not_incl] column value.
     *
     * @return int
     */
    public function getNotIncl()
    {
        return $this->not_incl;
    }

    /**
     * Get the [foc] column value.
     *
     * @return int
     */
    public function getFoc()
    {
        return $this->foc;
    }

    /**
     * Set the value of [event_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setEventId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->event_id !== $v) {
            $this->event_id = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_EVENT_ID] = true;
        }

        return $this;
    } // setEventId()

    /**
     * Set the value of [event_title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setEventTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->event_title !== $v) {
            $this->event_title = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_EVENT_TITLE] = true;
        }

        return $this;
    } // setEventTitle()

    /**
     * Sets the value of [start_dt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setStartDt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_dt !== null || $dt !== null) {
            if ($this->start_dt === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_dt->format("Y-m-d H:i:s.u")) {
                $this->start_dt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookingEventsTableMap::COL_START_DT] = true;
            }
        } // if either are not null

        return $this;
    } // setStartDt()

    /**
     * Sets the value of [end_dt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setEndDt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_dt !== null || $dt !== null) {
            if ($this->end_dt === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->end_dt->format("Y-m-d H:i:s.u")) {
                $this->end_dt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookingEventsTableMap::COL_END_DT] = true;
            }
        } // if either are not null

        return $this;
    } // setEndDt()

    /**
     * Set the value of [facility_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setFacilityId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->facility_id !== $v) {
            $this->facility_id = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_FACILITY_ID] = true;
        }

        if ($this->aFacilities !== null && $this->aFacilities->getFacilityId() !== $v) {
            $this->aFacilities = null;
        }

        return $this;
    } // setFacilityId()

    /**
     * Set the value of [all_day] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setAllDay($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->all_day !== $v) {
            $this->all_day = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_ALL_DAY] = true;
        }

        return $this;
    } // setAllDay()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_STATUS] = true;
        }

        if ($this->aEventStatus !== null && $this->aEventStatus->getStatusCd() !== $v) {
            $this->aEventStatus = null;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_AUTHOR_ID] = true;
        }

        if ($this->aContactRelatedByAuthorId !== null && $this->aContactRelatedByAuthorId->getContactId() !== $v) {
            $this->aContactRelatedByAuthorId = null;
        }

        return $this;
    } // setAuthorId()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_EDIT_DATE] = true;
        }

        return $this;
    } // setEditDate()

    /**
     * Set the value of [notes] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_NOTES] = true;
        }

        return $this;
    } // setNotes()

    /**
     * Set the value of [called_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setCalledBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->called_by !== $v) {
            $this->called_by = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_CALLED_BY] = true;
        }

        if ($this->aContactRelatedByCalledBy !== null && $this->aContactRelatedByCalledBy->getContactId() !== $v) {
            $this->aContactRelatedByCalledBy = null;
        }

        return $this;
    } // setCalledBy()

    /**
     * Set the value of [cancelled_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setCancelledBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cancelled_by !== $v) {
            $this->cancelled_by = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_CANCELLED_BY] = true;
        }

        if ($this->aContactRelatedByCancelledBy !== null && $this->aContactRelatedByCancelledBy->getContactId() !== $v) {
            $this->aContactRelatedByCancelledBy = null;
        }

        return $this;
    } // setCancelledBy()

    /**
     * Set the value of [cancelled_reason] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setCancelledReason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cancelled_reason !== $v) {
            $this->cancelled_reason = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_CANCELLED_REASON] = true;
        }

        return $this;
    } // setCancelledReason()

    /**
     * Set the value of [date_cancelled] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setDateCancelled($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->date_cancelled !== $v) {
            $this->date_cancelled = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_DATE_CANCELLED] = true;
        }

        return $this;
    } // setDateCancelled()

    /**
     * Set the value of [personalized] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setPersonalized($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->personalized !== $v) {
            $this->personalized = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_PERSONALIZED] = true;
        }

        return $this;
    } // setPersonalized()

    /**
     * Set the value of [booking_item_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setBookingItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_item_id !== $v) {
            $this->booking_item_id = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_BOOKING_ITEM_ID] = true;
        }

        if ($this->aBookingItems !== null && $this->aBookingItems->getBookingItemId() !== $v) {
            $this->aBookingItems = null;
        }

        return $this;
    } // setBookingItemId()

    /**
     * Set the value of [is_active] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    } // setIsActive()

    /**
     * Set the value of [deleted_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setDeletedDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->deleted_date !== $v) {
            $this->deleted_date = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_DELETED_DATE] = true;
        }

        return $this;
    } // setDeletedDate()

    /**
     * Set the value of [deleted_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setDeletedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->deleted_by !== $v) {
            $this->deleted_by = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_DELETED_BY] = true;
        }

        if ($this->aContactRelatedByDeletedBy !== null && $this->aContactRelatedByDeletedBy->getContactId() !== $v) {
            $this->aContactRelatedByDeletedBy = null;
        }

        return $this;
    } // setDeletedBy()

    /**
     * Set the value of [item_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_id !== $v) {
            $this->item_id = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_ITEM_ID] = true;
        }

        if ($this->aItems !== null && $this->aItems->getItemId() !== $v) {
            $this->aItems = null;
        }

        return $this;
    } // setItemId()

    /**
     * Set the value of [is_kids] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setIsKids($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->is_kids !== $v) {
            $this->is_kids = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_IS_KIDS] = true;
        }

        return $this;
    } // setIsKids()

    /**
     * Set the value of [incl_os_done_number] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setInclOsDoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->incl_os_done_number !== $v) {
            $this->incl_os_done_number = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_INCL_OS_DONE_NUMBER] = true;
        }

        return $this;
    } // setInclOsDoneNumber()

    /**
     * Set the value of [incl_os_done_amount] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setInclOsDoneAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->incl_os_done_amount !== $v) {
            $this->incl_os_done_amount = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT] = true;
        }

        return $this;
    } // setInclOsDoneAmount()

    /**
     * Set the value of [foc_os_done_number] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setFocOsDoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->foc_os_done_number !== $v) {
            $this->foc_os_done_number = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_FOC_OS_DONE_NUMBER] = true;
        }

        return $this;
    } // setFocOsDoneNumber()

    /**
     * Set the value of [foc_os_done_amount] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setFocOsDoneAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->foc_os_done_amount !== $v) {
            $this->foc_os_done_amount = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT] = true;
        }

        return $this;
    } // setFocOsDoneAmount()

    /**
     * Set the value of [not_incl_os_done_number] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setNotInclOsDoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->not_incl_os_done_number !== $v) {
            $this->not_incl_os_done_number = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_NOT_INCL_OS_DONE_NUMBER] = true;
        }

        return $this;
    } // setNotInclOsDoneNumber()

    /**
     * Set the value of [not_incl_os_done_amount] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setNotInclOsDoneAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->not_incl_os_done_amount !== $v) {
            $this->not_incl_os_done_amount = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT] = true;
        }

        return $this;
    } // setNotInclOsDoneAmount()

    /**
     * Set the value of [incl] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setIncl($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->incl !== $v) {
            $this->incl = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_INCL] = true;
        }

        return $this;
    } // setIncl()

    /**
     * Set the value of [not_incl] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setNotIncl($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->not_incl !== $v) {
            $this->not_incl = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_NOT_INCL] = true;
        }

        return $this;
    } // setNotIncl()

    /**
     * Set the value of [foc] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function setFoc($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->foc !== $v) {
            $this->foc = $v;
            $this->modifiedColumns[BookingEventsTableMap::COL_FOC] = true;
        }

        return $this;
    } // setFoc()

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
            if ($this->entry_date !== 0) {
                return false;
            }

            if ($this->edit_date !== 0) {
                return false;
            }

            if ($this->notes !== '') {
                return false;
            }

            if ($this->cancelled_reason !== '') {
                return false;
            }

            if ($this->date_cancelled !== 0) {
                return false;
            }

            if ($this->personalized !== '') {
                return false;
            }

            if ($this->is_active !== 'n') {
                return false;
            }

            if ($this->deleted_date !== 0) {
                return false;
            }

            if ($this->is_kids !== 'n') {
                return false;
            }

            if ($this->incl_os_done_amount !== '0.00') {
                return false;
            }

            if ($this->foc_os_done_amount !== '0.00') {
                return false;
            }

            if ($this->not_incl_os_done_amount !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookingEventsTableMap::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->event_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookingEventsTableMap::translateFieldName('EventTitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->event_title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookingEventsTableMap::translateFieldName('StartDt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->start_dt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookingEventsTableMap::translateFieldName('EndDt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->end_dt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookingEventsTableMap::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->facility_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookingEventsTableMap::translateFieldName('AllDay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->all_day = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookingEventsTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BookingEventsTableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BookingEventsTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BookingEventsTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BookingEventsTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BookingEventsTableMap::translateFieldName('CalledBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->called_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BookingEventsTableMap::translateFieldName('CancelledBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cancelled_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BookingEventsTableMap::translateFieldName('CancelledReason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cancelled_reason = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BookingEventsTableMap::translateFieldName('DateCancelled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_cancelled = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : BookingEventsTableMap::translateFieldName('Personalized', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personalized = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : BookingEventsTableMap::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : BookingEventsTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : BookingEventsTableMap::translateFieldName('DeletedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->deleted_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : BookingEventsTableMap::translateFieldName('DeletedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->deleted_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : BookingEventsTableMap::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : BookingEventsTableMap::translateFieldName('IsKids', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_kids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : BookingEventsTableMap::translateFieldName('InclOsDoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->incl_os_done_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : BookingEventsTableMap::translateFieldName('InclOsDoneAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->incl_os_done_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : BookingEventsTableMap::translateFieldName('FocOsDoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->foc_os_done_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : BookingEventsTableMap::translateFieldName('FocOsDoneAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->foc_os_done_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : BookingEventsTableMap::translateFieldName('NotInclOsDoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->not_incl_os_done_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : BookingEventsTableMap::translateFieldName('NotInclOsDoneAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->not_incl_os_done_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : BookingEventsTableMap::translateFieldName('Incl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->incl = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : BookingEventsTableMap::translateFieldName('NotIncl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->not_incl = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : BookingEventsTableMap::translateFieldName('Foc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->foc = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 31; // 31 = BookingEventsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\BookingEvents'), 0, $e);
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
        if ($this->aFacilities !== null && $this->facility_id !== $this->aFacilities->getFacilityId()) {
            $this->aFacilities = null;
        }
        if ($this->aEventStatus !== null && $this->status !== $this->aEventStatus->getStatusCd()) {
            $this->aEventStatus = null;
        }
        if ($this->aContactRelatedByAuthorId !== null && $this->author_id !== $this->aContactRelatedByAuthorId->getContactId()) {
            $this->aContactRelatedByAuthorId = null;
        }
        if ($this->aContactRelatedByCalledBy !== null && $this->called_by !== $this->aContactRelatedByCalledBy->getContactId()) {
            $this->aContactRelatedByCalledBy = null;
        }
        if ($this->aContactRelatedByCancelledBy !== null && $this->cancelled_by !== $this->aContactRelatedByCancelledBy->getContactId()) {
            $this->aContactRelatedByCancelledBy = null;
        }
        if ($this->aBookingItems !== null && $this->booking_item_id !== $this->aBookingItems->getBookingItemId()) {
            $this->aBookingItems = null;
        }
        if ($this->aContactRelatedByDeletedBy !== null && $this->deleted_by !== $this->aContactRelatedByDeletedBy->getContactId()) {
            $this->aContactRelatedByDeletedBy = null;
        }
        if ($this->aItems !== null && $this->item_id !== $this->aItems->getItemId()) {
            $this->aItems = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BookingEventsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookingEventsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aContactRelatedByAuthorId = null;
            $this->aBookingItems = null;
            $this->aContactRelatedByCalledBy = null;
            $this->aContactRelatedByCancelledBy = null;
            $this->aContactRelatedByDeletedBy = null;
            $this->aFacilities = null;
            $this->aItems = null;
            $this->aEventStatus = null;
            $this->collBookingEventUserss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see BookingEvents::setDeleted()
     * @see BookingEvents::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookingEventsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventsTableMap::DATABASE_NAME);
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
                BookingEventsTableMap::addInstanceToPool($this);
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

            if ($this->aContactRelatedByAuthorId !== null) {
                if ($this->aContactRelatedByAuthorId->isModified() || $this->aContactRelatedByAuthorId->isNew()) {
                    $affectedRows += $this->aContactRelatedByAuthorId->save($con);
                }
                $this->setContactRelatedByAuthorId($this->aContactRelatedByAuthorId);
            }

            if ($this->aBookingItems !== null) {
                if ($this->aBookingItems->isModified() || $this->aBookingItems->isNew()) {
                    $affectedRows += $this->aBookingItems->save($con);
                }
                $this->setBookingItems($this->aBookingItems);
            }

            if ($this->aContactRelatedByCalledBy !== null) {
                if ($this->aContactRelatedByCalledBy->isModified() || $this->aContactRelatedByCalledBy->isNew()) {
                    $affectedRows += $this->aContactRelatedByCalledBy->save($con);
                }
                $this->setContactRelatedByCalledBy($this->aContactRelatedByCalledBy);
            }

            if ($this->aContactRelatedByCancelledBy !== null) {
                if ($this->aContactRelatedByCancelledBy->isModified() || $this->aContactRelatedByCancelledBy->isNew()) {
                    $affectedRows += $this->aContactRelatedByCancelledBy->save($con);
                }
                $this->setContactRelatedByCancelledBy($this->aContactRelatedByCancelledBy);
            }

            if ($this->aContactRelatedByDeletedBy !== null) {
                if ($this->aContactRelatedByDeletedBy->isModified() || $this->aContactRelatedByDeletedBy->isNew()) {
                    $affectedRows += $this->aContactRelatedByDeletedBy->save($con);
                }
                $this->setContactRelatedByDeletedBy($this->aContactRelatedByDeletedBy);
            }

            if ($this->aFacilities !== null) {
                if ($this->aFacilities->isModified() || $this->aFacilities->isNew()) {
                    $affectedRows += $this->aFacilities->save($con);
                }
                $this->setFacilities($this->aFacilities);
            }

            if ($this->aItems !== null) {
                if ($this->aItems->isModified() || $this->aItems->isNew()) {
                    $affectedRows += $this->aItems->save($con);
                }
                $this->setItems($this->aItems);
            }

            if ($this->aEventStatus !== null) {
                if ($this->aEventStatus->isModified() || $this->aEventStatus->isNew()) {
                    $affectedRows += $this->aEventStatus->save($con);
                }
                $this->setEventStatus($this->aEventStatus);
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

            if ($this->bookingEventUserssScheduledForDeletion !== null) {
                if (!$this->bookingEventUserssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingEventUsersQuery::create()
                        ->filterByPrimaryKeys($this->bookingEventUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingEventUserssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventUserss !== null) {
                foreach ($this->collBookingEventUserss as $referrerFK) {
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

        $this->modifiedColumns[BookingEventsTableMap::COL_EVENT_ID] = true;
        if (null !== $this->event_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookingEventsTableMap::COL_EVENT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookingEventsTableMap::COL_EVENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'event_id';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_EVENT_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'event_title';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_START_DT)) {
            $modifiedColumns[':p' . $index++]  = 'start_dt';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_END_DT)) {
            $modifiedColumns[':p' . $index++]  = 'end_dt';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FACILITY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'facility_id';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ALL_DAY)) {
            $modifiedColumns[':p' . $index++]  = 'all_day';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CALLED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'called_by';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CANCELLED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'cancelled_by';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CANCELLED_REASON)) {
            $modifiedColumns[':p' . $index++]  = 'cancelled_reason';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DATE_CANCELLED)) {
            $modifiedColumns[':p' . $index++]  = 'date_cancelled';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_PERSONALIZED)) {
            $modifiedColumns[':p' . $index++]  = 'personalized';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_BOOKING_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_item_id';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DELETED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'deleted_date';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DELETED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'deleted_by';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'item_id';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_IS_KIDS)) {
            $modifiedColumns[':p' . $index++]  = 'is_kids';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL_OS_DONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'incl_os_done_number';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'incl_os_done_amount';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC_OS_DONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'foc_os_done_number';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'foc_os_done_amount';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'not_incl_os_done_number';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'not_incl_os_done_amount';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL)) {
            $modifiedColumns[':p' . $index++]  = 'incl';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL)) {
            $modifiedColumns[':p' . $index++]  = 'not_incl';
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC)) {
            $modifiedColumns[':p' . $index++]  = 'foc';
        }

        $sql = sprintf(
            'INSERT INTO tf_booking_events (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'event_id':
                        $stmt->bindValue($identifier, $this->event_id, PDO::PARAM_INT);
                        break;
                    case 'event_title':
                        $stmt->bindValue($identifier, $this->event_title, PDO::PARAM_STR);
                        break;
                    case 'start_dt':
                        $stmt->bindValue($identifier, $this->start_dt ? $this->start_dt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'end_dt':
                        $stmt->bindValue($identifier, $this->end_dt ? $this->end_dt->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'facility_id':
                        $stmt->bindValue($identifier, $this->facility_id, PDO::PARAM_INT);
                        break;
                    case 'all_day':
                        $stmt->bindValue($identifier, $this->all_day, PDO::PARAM_INT);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'author_id':
                        $stmt->bindValue($identifier, $this->author_id, PDO::PARAM_INT);
                        break;
                    case 'entry_date':
                        $stmt->bindValue($identifier, $this->entry_date, PDO::PARAM_INT);
                        break;
                    case 'edit_date':
                        $stmt->bindValue($identifier, $this->edit_date, PDO::PARAM_INT);
                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);
                        break;
                    case 'called_by':
                        $stmt->bindValue($identifier, $this->called_by, PDO::PARAM_INT);
                        break;
                    case 'cancelled_by':
                        $stmt->bindValue($identifier, $this->cancelled_by, PDO::PARAM_INT);
                        break;
                    case 'cancelled_reason':
                        $stmt->bindValue($identifier, $this->cancelled_reason, PDO::PARAM_STR);
                        break;
                    case 'date_cancelled':
                        $stmt->bindValue($identifier, $this->date_cancelled, PDO::PARAM_INT);
                        break;
                    case 'personalized':
                        $stmt->bindValue($identifier, $this->personalized, PDO::PARAM_STR);
                        break;
                    case 'booking_item_id':
                        $stmt->bindValue($identifier, $this->booking_item_id, PDO::PARAM_INT);
                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, $this->is_active, PDO::PARAM_STR);
                        break;
                    case 'deleted_date':
                        $stmt->bindValue($identifier, $this->deleted_date, PDO::PARAM_INT);
                        break;
                    case 'deleted_by':
                        $stmt->bindValue($identifier, $this->deleted_by, PDO::PARAM_INT);
                        break;
                    case 'item_id':
                        $stmt->bindValue($identifier, $this->item_id, PDO::PARAM_INT);
                        break;
                    case 'is_kids':
                        $stmt->bindValue($identifier, $this->is_kids, PDO::PARAM_STR);
                        break;
                    case 'incl_os_done_number':
                        $stmt->bindValue($identifier, $this->incl_os_done_number, PDO::PARAM_STR);
                        break;
                    case 'incl_os_done_amount':
                        $stmt->bindValue($identifier, $this->incl_os_done_amount, PDO::PARAM_STR);
                        break;
                    case 'foc_os_done_number':
                        $stmt->bindValue($identifier, $this->foc_os_done_number, PDO::PARAM_STR);
                        break;
                    case 'foc_os_done_amount':
                        $stmt->bindValue($identifier, $this->foc_os_done_amount, PDO::PARAM_STR);
                        break;
                    case 'not_incl_os_done_number':
                        $stmt->bindValue($identifier, $this->not_incl_os_done_number, PDO::PARAM_STR);
                        break;
                    case 'not_incl_os_done_amount':
                        $stmt->bindValue($identifier, $this->not_incl_os_done_amount, PDO::PARAM_STR);
                        break;
                    case 'incl':
                        $stmt->bindValue($identifier, $this->incl, PDO::PARAM_INT);
                        break;
                    case 'not_incl':
                        $stmt->bindValue($identifier, $this->not_incl, PDO::PARAM_INT);
                        break;
                    case 'foc':
                        $stmt->bindValue($identifier, $this->foc, PDO::PARAM_INT);
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
        $this->setEventId($pk);

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
        $pos = BookingEventsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEventId();
                break;
            case 1:
                return $this->getEventTitle();
                break;
            case 2:
                return $this->getStartDt();
                break;
            case 3:
                return $this->getEndDt();
                break;
            case 4:
                return $this->getFacilityId();
                break;
            case 5:
                return $this->getAllDay();
                break;
            case 6:
                return $this->getStatus();
                break;
            case 7:
                return $this->getAuthorId();
                break;
            case 8:
                return $this->getEntryDate();
                break;
            case 9:
                return $this->getEditDate();
                break;
            case 10:
                return $this->getNotes();
                break;
            case 11:
                return $this->getCalledBy();
                break;
            case 12:
                return $this->getCancelledBy();
                break;
            case 13:
                return $this->getCancelledReason();
                break;
            case 14:
                return $this->getDateCancelled();
                break;
            case 15:
                return $this->getPersonalized();
                break;
            case 16:
                return $this->getBookingItemId();
                break;
            case 17:
                return $this->getIsActive();
                break;
            case 18:
                return $this->getDeletedDate();
                break;
            case 19:
                return $this->getDeletedBy();
                break;
            case 20:
                return $this->getItemId();
                break;
            case 21:
                return $this->getIsKids();
                break;
            case 22:
                return $this->getInclOsDoneNumber();
                break;
            case 23:
                return $this->getInclOsDoneAmount();
                break;
            case 24:
                return $this->getFocOsDoneNumber();
                break;
            case 25:
                return $this->getFocOsDoneAmount();
                break;
            case 26:
                return $this->getNotInclOsDoneNumber();
                break;
            case 27:
                return $this->getNotInclOsDoneAmount();
                break;
            case 28:
                return $this->getIncl();
                break;
            case 29:
                return $this->getNotIncl();
                break;
            case 30:
                return $this->getFoc();
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

        if (isset($alreadyDumpedObjects['BookingEvents'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BookingEvents'][$this->hashCode()] = true;
        $keys = BookingEventsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEventId(),
            $keys[1] => $this->getEventTitle(),
            $keys[2] => $this->getStartDt(),
            $keys[3] => $this->getEndDt(),
            $keys[4] => $this->getFacilityId(),
            $keys[5] => $this->getAllDay(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getAuthorId(),
            $keys[8] => $this->getEntryDate(),
            $keys[9] => $this->getEditDate(),
            $keys[10] => $this->getNotes(),
            $keys[11] => $this->getCalledBy(),
            $keys[12] => $this->getCancelledBy(),
            $keys[13] => $this->getCancelledReason(),
            $keys[14] => $this->getDateCancelled(),
            $keys[15] => $this->getPersonalized(),
            $keys[16] => $this->getBookingItemId(),
            $keys[17] => $this->getIsActive(),
            $keys[18] => $this->getDeletedDate(),
            $keys[19] => $this->getDeletedBy(),
            $keys[20] => $this->getItemId(),
            $keys[21] => $this->getIsKids(),
            $keys[22] => $this->getInclOsDoneNumber(),
            $keys[23] => $this->getInclOsDoneAmount(),
            $keys[24] => $this->getFocOsDoneNumber(),
            $keys[25] => $this->getFocOsDoneAmount(),
            $keys[26] => $this->getNotInclOsDoneNumber(),
            $keys[27] => $this->getNotInclOsDoneAmount(),
            $keys[28] => $this->getIncl(),
            $keys[29] => $this->getNotIncl(),
            $keys[30] => $this->getFoc(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aContactRelatedByAuthorId) {

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

                $result[$key] = $this->aContactRelatedByAuthorId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBookingItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_items';
                        break;
                    default:
                        $key = 'BookingItems';
                }

                $result[$key] = $this->aBookingItems->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aContactRelatedByCalledBy) {

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

                $result[$key] = $this->aContactRelatedByCalledBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aContactRelatedByCancelledBy) {

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

                $result[$key] = $this->aContactRelatedByCancelledBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aContactRelatedByDeletedBy) {

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

                $result[$key] = $this->aContactRelatedByDeletedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFacilities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'facilities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_facilities';
                        break;
                    default:
                        $key = 'Facilities';
                }

                $result[$key] = $this->aFacilities->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'items';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items';
                        break;
                    default:
                        $key = 'Items';
                }

                $result[$key] = $this->aItems->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEventStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'eventStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_event_status';
                        break;
                    default:
                        $key = 'EventStatus';
                }

                $result[$key] = $this->aEventStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBookingEventUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventUserss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_event_userss';
                        break;
                    default:
                        $key = 'BookingEventUserss';
                }

                $result[$key] = $this->collBookingEventUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\BookingEvents
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookingEventsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\BookingEvents
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEventId($value);
                break;
            case 1:
                $this->setEventTitle($value);
                break;
            case 2:
                $this->setStartDt($value);
                break;
            case 3:
                $this->setEndDt($value);
                break;
            case 4:
                $this->setFacilityId($value);
                break;
            case 5:
                $this->setAllDay($value);
                break;
            case 6:
                $this->setStatus($value);
                break;
            case 7:
                $this->setAuthorId($value);
                break;
            case 8:
                $this->setEntryDate($value);
                break;
            case 9:
                $this->setEditDate($value);
                break;
            case 10:
                $this->setNotes($value);
                break;
            case 11:
                $this->setCalledBy($value);
                break;
            case 12:
                $this->setCancelledBy($value);
                break;
            case 13:
                $this->setCancelledReason($value);
                break;
            case 14:
                $this->setDateCancelled($value);
                break;
            case 15:
                $this->setPersonalized($value);
                break;
            case 16:
                $this->setBookingItemId($value);
                break;
            case 17:
                $this->setIsActive($value);
                break;
            case 18:
                $this->setDeletedDate($value);
                break;
            case 19:
                $this->setDeletedBy($value);
                break;
            case 20:
                $this->setItemId($value);
                break;
            case 21:
                $this->setIsKids($value);
                break;
            case 22:
                $this->setInclOsDoneNumber($value);
                break;
            case 23:
                $this->setInclOsDoneAmount($value);
                break;
            case 24:
                $this->setFocOsDoneNumber($value);
                break;
            case 25:
                $this->setFocOsDoneAmount($value);
                break;
            case 26:
                $this->setNotInclOsDoneNumber($value);
                break;
            case 27:
                $this->setNotInclOsDoneAmount($value);
                break;
            case 28:
                $this->setIncl($value);
                break;
            case 29:
                $this->setNotIncl($value);
                break;
            case 30:
                $this->setFoc($value);
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
        $keys = BookingEventsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEventId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEventTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStartDt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEndDt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFacilityId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAllDay($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAuthorId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEntryDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEditDate($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setNotes($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCalledBy($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCancelledBy($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCancelledReason($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setDateCancelled($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPersonalized($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setBookingItemId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setIsActive($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setDeletedDate($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setDeletedBy($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setItemId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setIsKids($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setInclOsDoneNumber($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setInclOsDoneAmount($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setFocOsDoneNumber($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setFocOsDoneAmount($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setNotInclOsDoneNumber($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setNotInclOsDoneAmount($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setIncl($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setNotIncl($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setFoc($arr[$keys[30]]);
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
     * @return $this|\TheFarm\Models\BookingEvents The current object, for fluid interface
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
        $criteria = new Criteria(BookingEventsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookingEventsTableMap::COL_EVENT_ID)) {
            $criteria->add(BookingEventsTableMap::COL_EVENT_ID, $this->event_id);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_EVENT_TITLE)) {
            $criteria->add(BookingEventsTableMap::COL_EVENT_TITLE, $this->event_title);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_START_DT)) {
            $criteria->add(BookingEventsTableMap::COL_START_DT, $this->start_dt);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_END_DT)) {
            $criteria->add(BookingEventsTableMap::COL_END_DT, $this->end_dt);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FACILITY_ID)) {
            $criteria->add(BookingEventsTableMap::COL_FACILITY_ID, $this->facility_id);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ALL_DAY)) {
            $criteria->add(BookingEventsTableMap::COL_ALL_DAY, $this->all_day);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_STATUS)) {
            $criteria->add(BookingEventsTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_AUTHOR_ID)) {
            $criteria->add(BookingEventsTableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ENTRY_DATE)) {
            $criteria->add(BookingEventsTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_EDIT_DATE)) {
            $criteria->add(BookingEventsTableMap::COL_EDIT_DATE, $this->edit_date);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOTES)) {
            $criteria->add(BookingEventsTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CALLED_BY)) {
            $criteria->add(BookingEventsTableMap::COL_CALLED_BY, $this->called_by);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CANCELLED_BY)) {
            $criteria->add(BookingEventsTableMap::COL_CANCELLED_BY, $this->cancelled_by);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_CANCELLED_REASON)) {
            $criteria->add(BookingEventsTableMap::COL_CANCELLED_REASON, $this->cancelled_reason);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DATE_CANCELLED)) {
            $criteria->add(BookingEventsTableMap::COL_DATE_CANCELLED, $this->date_cancelled);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_PERSONALIZED)) {
            $criteria->add(BookingEventsTableMap::COL_PERSONALIZED, $this->personalized);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_BOOKING_ITEM_ID)) {
            $criteria->add(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $this->booking_item_id);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_IS_ACTIVE)) {
            $criteria->add(BookingEventsTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DELETED_DATE)) {
            $criteria->add(BookingEventsTableMap::COL_DELETED_DATE, $this->deleted_date);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_DELETED_BY)) {
            $criteria->add(BookingEventsTableMap::COL_DELETED_BY, $this->deleted_by);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_ITEM_ID)) {
            $criteria->add(BookingEventsTableMap::COL_ITEM_ID, $this->item_id);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_IS_KIDS)) {
            $criteria->add(BookingEventsTableMap::COL_IS_KIDS, $this->is_kids);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL_OS_DONE_NUMBER)) {
            $criteria->add(BookingEventsTableMap::COL_INCL_OS_DONE_NUMBER, $this->incl_os_done_number);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT)) {
            $criteria->add(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT, $this->incl_os_done_amount);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC_OS_DONE_NUMBER)) {
            $criteria->add(BookingEventsTableMap::COL_FOC_OS_DONE_NUMBER, $this->foc_os_done_number);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT)) {
            $criteria->add(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT, $this->foc_os_done_amount);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_NUMBER)) {
            $criteria->add(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_NUMBER, $this->not_incl_os_done_number);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT)) {
            $criteria->add(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $this->not_incl_os_done_amount);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_INCL)) {
            $criteria->add(BookingEventsTableMap::COL_INCL, $this->incl);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_NOT_INCL)) {
            $criteria->add(BookingEventsTableMap::COL_NOT_INCL, $this->not_incl);
        }
        if ($this->isColumnModified(BookingEventsTableMap::COL_FOC)) {
            $criteria->add(BookingEventsTableMap::COL_FOC, $this->foc);
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
        $criteria = ChildBookingEventsQuery::create();
        $criteria->add(BookingEventsTableMap::COL_EVENT_ID, $this->event_id);

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
        $validPk = null !== $this->getEventId();

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
        return $this->getEventId();
    }

    /**
     * Generic method to set the primary key (event_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setEventId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getEventId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\BookingEvents (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEventTitle($this->getEventTitle());
        $copyObj->setStartDt($this->getStartDt());
        $copyObj->setEndDt($this->getEndDt());
        $copyObj->setFacilityId($this->getFacilityId());
        $copyObj->setAllDay($this->getAllDay());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setAuthorId($this->getAuthorId());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setCalledBy($this->getCalledBy());
        $copyObj->setCancelledBy($this->getCancelledBy());
        $copyObj->setCancelledReason($this->getCancelledReason());
        $copyObj->setDateCancelled($this->getDateCancelled());
        $copyObj->setPersonalized($this->getPersonalized());
        $copyObj->setBookingItemId($this->getBookingItemId());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setDeletedDate($this->getDeletedDate());
        $copyObj->setDeletedBy($this->getDeletedBy());
        $copyObj->setItemId($this->getItemId());
        $copyObj->setIsKids($this->getIsKids());
        $copyObj->setInclOsDoneNumber($this->getInclOsDoneNumber());
        $copyObj->setInclOsDoneAmount($this->getInclOsDoneAmount());
        $copyObj->setFocOsDoneNumber($this->getFocOsDoneNumber());
        $copyObj->setFocOsDoneAmount($this->getFocOsDoneAmount());
        $copyObj->setNotInclOsDoneNumber($this->getNotInclOsDoneNumber());
        $copyObj->setNotInclOsDoneAmount($this->getNotInclOsDoneAmount());
        $copyObj->setIncl($this->getIncl());
        $copyObj->setNotIncl($this->getNotIncl());
        $copyObj->setFoc($this->getFoc());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingEventUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventUsers($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEventId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\BookingEvents Clone of current object.
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
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByAuthorId(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setAuthorId(NULL);
        } else {
            $this->setAuthorId($v->getContactId());
        }

        $this->aContactRelatedByAuthorId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContact object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEventsRelatedByAuthorId($this);
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
    public function getContactRelatedByAuthorId(ConnectionInterface $con = null)
    {
        if ($this->aContactRelatedByAuthorId === null && ($this->author_id !== null)) {
            $this->aContactRelatedByAuthorId = ChildContactQuery::create()->findPk($this->author_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByAuthorId->addBookingEventssRelatedByAuthorId($this);
             */
        }

        return $this->aContactRelatedByAuthorId;
    }

    /**
     * Declares an association between this object and a ChildBookingItems object.
     *
     * @param  ChildBookingItems $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBookingItems(ChildBookingItems $v = null)
    {
        if ($v === null) {
            $this->setBookingItemId(NULL);
        } else {
            $this->setBookingItemId($v->getBookingItemId());
        }

        $this->aBookingItems = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBookingItems object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEvents($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBookingItems object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBookingItems The associated ChildBookingItems object.
     * @throws PropelException
     */
    public function getBookingItems(ConnectionInterface $con = null)
    {
        if ($this->aBookingItems === null && ($this->booking_item_id !== null)) {
            $this->aBookingItems = ChildBookingItemsQuery::create()->findPk($this->booking_item_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBookingItems->addBookingEventss($this);
             */
        }

        return $this->aBookingItems;
    }

    /**
     * Declares an association between this object and a ChildContact object.
     *
     * @param  ChildContact $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByCalledBy(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setCalledBy(NULL);
        } else {
            $this->setCalledBy($v->getContactId());
        }

        $this->aContactRelatedByCalledBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContact object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEventsRelatedByCalledBy($this);
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
    public function getContactRelatedByCalledBy(ConnectionInterface $con = null)
    {
        if ($this->aContactRelatedByCalledBy === null && ($this->called_by !== null)) {
            $this->aContactRelatedByCalledBy = ChildContactQuery::create()->findPk($this->called_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByCalledBy->addBookingEventssRelatedByCalledBy($this);
             */
        }

        return $this->aContactRelatedByCalledBy;
    }

    /**
     * Declares an association between this object and a ChildContact object.
     *
     * @param  ChildContact $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByCancelledBy(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setCancelledBy(NULL);
        } else {
            $this->setCancelledBy($v->getContactId());
        }

        $this->aContactRelatedByCancelledBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContact object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEventsRelatedByCancelledBy($this);
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
    public function getContactRelatedByCancelledBy(ConnectionInterface $con = null)
    {
        if ($this->aContactRelatedByCancelledBy === null && ($this->cancelled_by !== null)) {
            $this->aContactRelatedByCancelledBy = ChildContactQuery::create()->findPk($this->cancelled_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByCancelledBy->addBookingEventssRelatedByCancelledBy($this);
             */
        }

        return $this->aContactRelatedByCancelledBy;
    }

    /**
     * Declares an association between this object and a ChildContact object.
     *
     * @param  ChildContact $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByDeletedBy(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setDeletedBy(NULL);
        } else {
            $this->setDeletedBy($v->getContactId());
        }

        $this->aContactRelatedByDeletedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContact object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEventsRelatedByDeletedBy($this);
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
    public function getContactRelatedByDeletedBy(ConnectionInterface $con = null)
    {
        if ($this->aContactRelatedByDeletedBy === null && ($this->deleted_by !== null)) {
            $this->aContactRelatedByDeletedBy = ChildContactQuery::create()->findPk($this->deleted_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByDeletedBy->addBookingEventssRelatedByDeletedBy($this);
             */
        }

        return $this->aContactRelatedByDeletedBy;
    }

    /**
     * Declares an association between this object and a ChildFacilities object.
     *
     * @param  ChildFacilities $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFacilities(ChildFacilities $v = null)
    {
        if ($v === null) {
            $this->setFacilityId(NULL);
        } else {
            $this->setFacilityId($v->getFacilityId());
        }

        $this->aFacilities = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFacilities object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEvents($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFacilities object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFacilities The associated ChildFacilities object.
     * @throws PropelException
     */
    public function getFacilities(ConnectionInterface $con = null)
    {
        if ($this->aFacilities === null && ($this->facility_id !== null)) {
            $this->aFacilities = ChildFacilitiesQuery::create()->findPk($this->facility_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFacilities->addBookingEventss($this);
             */
        }

        return $this->aFacilities;
    }

    /**
     * Declares an association between this object and a ChildItems object.
     *
     * @param  ChildItems $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setItems(ChildItems $v = null)
    {
        if ($v === null) {
            $this->setItemId(NULL);
        } else {
            $this->setItemId($v->getItemId());
        }

        $this->aItems = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildItems object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEvents($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildItems object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildItems The associated ChildItems object.
     * @throws PropelException
     */
    public function getItems(ConnectionInterface $con = null)
    {
        if ($this->aItems === null && ($this->item_id !== null)) {
            $this->aItems = ChildItemsQuery::create()->findPk($this->item_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aItems->addBookingEventss($this);
             */
        }

        return $this->aItems;
    }

    /**
     * Declares an association between this object and a ChildEventStatus object.
     *
     * @param  ChildEventStatus $v
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEventStatus(ChildEventStatus $v = null)
    {
        if ($v === null) {
            $this->setStatus(NULL);
        } else {
            $this->setStatus($v->getStatusCd());
        }

        $this->aEventStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEventStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingEvents($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEventStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEventStatus The associated ChildEventStatus object.
     * @throws PropelException
     */
    public function getEventStatus(ConnectionInterface $con = null)
    {
        if ($this->aEventStatus === null && (($this->status !== "" && $this->status !== null))) {
            $this->aEventStatus = ChildEventStatusQuery::create()->findPk($this->status, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEventStatus->addBookingEventss($this);
             */
        }

        return $this->aEventStatus;
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
        if ('BookingEventUsers' == $relationName) {
            $this->initBookingEventUserss();
            return;
        }
    }

    /**
     * Clears out the collBookingEventUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventUserss()
     */
    public function clearBookingEventUserss()
    {
        $this->collBookingEventUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventUserss collection loaded partially.
     */
    public function resetPartialBookingEventUserss($v = true)
    {
        $this->collBookingEventUserssPartial = $v;
    }

    /**
     * Initializes the collBookingEventUserss collection.
     *
     * By default this just sets the collBookingEventUserss collection to an empty array (like clearcollBookingEventUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventUserss($overrideExisting = true)
    {
        if (null !== $this->collBookingEventUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventUsersTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventUserss = new $collectionClassName;
        $this->collBookingEventUserss->setModel('\TheFarm\Models\BookingEventUsers');
    }

    /**
     * Gets an array of ChildBookingEventUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookingEvents is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEventUsers[] List of ChildBookingEventUsers objects
     * @throws PropelException
     */
    public function getBookingEventUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventUserssPartial && !$this->isNew();
        if (null === $this->collBookingEventUserss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventUserss) {
                // return empty collection
                $this->initBookingEventUserss();
            } else {
                $collBookingEventUserss = ChildBookingEventUsersQuery::create(null, $criteria)
                    ->filterByBookingEvents($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventUserssPartial && count($collBookingEventUserss)) {
                        $this->initBookingEventUserss(false);

                        foreach ($collBookingEventUserss as $obj) {
                            if (false == $this->collBookingEventUserss->contains($obj)) {
                                $this->collBookingEventUserss->append($obj);
                            }
                        }

                        $this->collBookingEventUserssPartial = true;
                    }

                    return $collBookingEventUserss;
                }

                if ($partial && $this->collBookingEventUserss) {
                    foreach ($this->collBookingEventUserss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventUserss[] = $obj;
                        }
                    }
                }

                $this->collBookingEventUserss = $collBookingEventUserss;
                $this->collBookingEventUserssPartial = false;
            }
        }

        return $this->collBookingEventUserss;
    }

    /**
     * Sets a collection of ChildBookingEventUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventUserss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookingEvents The current object (for fluent API support)
     */
    public function setBookingEventUserss(Collection $bookingEventUserss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEventUsers[] $bookingEventUserssToDelete */
        $bookingEventUserssToDelete = $this->getBookingEventUserss(new Criteria(), $con)->diff($bookingEventUserss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bookingEventUserssScheduledForDeletion = clone $bookingEventUserssToDelete;

        foreach ($bookingEventUserssToDelete as $bookingEventUsersRemoved) {
            $bookingEventUsersRemoved->setBookingEvents(null);
        }

        $this->collBookingEventUserss = null;
        foreach ($bookingEventUserss as $bookingEventUsers) {
            $this->addBookingEventUsers($bookingEventUsers);
        }

        $this->collBookingEventUserss = $bookingEventUserss;
        $this->collBookingEventUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEventUsers objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEventUsers objects.
     * @throws PropelException
     */
    public function countBookingEventUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventUserssPartial && !$this->isNew();
        if (null === $this->collBookingEventUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventUserss());
            }

            $query = ChildBookingEventUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookingEvents($this)
                ->count($con);
        }

        return count($this->collBookingEventUserss);
    }

    /**
     * Method called to associate a ChildBookingEventUsers object to this object
     * through the ChildBookingEventUsers foreign key attribute.
     *
     * @param  ChildBookingEventUsers $l ChildBookingEventUsers
     * @return $this|\TheFarm\Models\BookingEvents The current object (for fluent API support)
     */
    public function addBookingEventUsers(ChildBookingEventUsers $l)
    {
        if ($this->collBookingEventUserss === null) {
            $this->initBookingEventUserss();
            $this->collBookingEventUserssPartial = true;
        }

        if (!$this->collBookingEventUserss->contains($l)) {
            $this->doAddBookingEventUsers($l);

            if ($this->bookingEventUserssScheduledForDeletion and $this->bookingEventUserssScheduledForDeletion->contains($l)) {
                $this->bookingEventUserssScheduledForDeletion->remove($this->bookingEventUserssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEventUsers $bookingEventUsers The ChildBookingEventUsers object to add.
     */
    protected function doAddBookingEventUsers(ChildBookingEventUsers $bookingEventUsers)
    {
        $this->collBookingEventUserss[]= $bookingEventUsers;
        $bookingEventUsers->setBookingEvents($this);
    }

    /**
     * @param  ChildBookingEventUsers $bookingEventUsers The ChildBookingEventUsers object to remove.
     * @return $this|ChildBookingEvents The current object (for fluent API support)
     */
    public function removeBookingEventUsers(ChildBookingEventUsers $bookingEventUsers)
    {
        if ($this->getBookingEventUserss()->contains($bookingEventUsers)) {
            $pos = $this->collBookingEventUserss->search($bookingEventUsers);
            $this->collBookingEventUserss->remove($pos);
            if (null === $this->bookingEventUserssScheduledForDeletion) {
                $this->bookingEventUserssScheduledForDeletion = clone $this->collBookingEventUserss;
                $this->bookingEventUserssScheduledForDeletion->clear();
            }
            $this->bookingEventUserssScheduledForDeletion[]= clone $bookingEventUsers;
            $bookingEventUsers->setBookingEvents(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingEvents is new, it will return
     * an empty collection; or if this BookingEvents has previously
     * been saved, it will retrieve related BookingEventUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingEvents.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEventUsers[] List of ChildBookingEventUsers objects
     */
    public function getBookingEventUserssJoinContact(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventUsersQuery::create(null, $criteria);
        $query->joinWith('Contact', $joinBehavior);

        return $this->getBookingEventUserss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aContactRelatedByAuthorId) {
            $this->aContactRelatedByAuthorId->removeBookingEventsRelatedByAuthorId($this);
        }
        if (null !== $this->aBookingItems) {
            $this->aBookingItems->removeBookingEvents($this);
        }
        if (null !== $this->aContactRelatedByCalledBy) {
            $this->aContactRelatedByCalledBy->removeBookingEventsRelatedByCalledBy($this);
        }
        if (null !== $this->aContactRelatedByCancelledBy) {
            $this->aContactRelatedByCancelledBy->removeBookingEventsRelatedByCancelledBy($this);
        }
        if (null !== $this->aContactRelatedByDeletedBy) {
            $this->aContactRelatedByDeletedBy->removeBookingEventsRelatedByDeletedBy($this);
        }
        if (null !== $this->aFacilities) {
            $this->aFacilities->removeBookingEvents($this);
        }
        if (null !== $this->aItems) {
            $this->aItems->removeBookingEvents($this);
        }
        if (null !== $this->aEventStatus) {
            $this->aEventStatus->removeBookingEvents($this);
        }
        $this->event_id = null;
        $this->event_title = null;
        $this->start_dt = null;
        $this->end_dt = null;
        $this->facility_id = null;
        $this->all_day = null;
        $this->status = null;
        $this->author_id = null;
        $this->entry_date = null;
        $this->edit_date = null;
        $this->notes = null;
        $this->called_by = null;
        $this->cancelled_by = null;
        $this->cancelled_reason = null;
        $this->date_cancelled = null;
        $this->personalized = null;
        $this->booking_item_id = null;
        $this->is_active = null;
        $this->deleted_date = null;
        $this->deleted_by = null;
        $this->item_id = null;
        $this->is_kids = null;
        $this->incl_os_done_number = null;
        $this->incl_os_done_amount = null;
        $this->foc_os_done_number = null;
        $this->foc_os_done_amount = null;
        $this->not_incl_os_done_number = null;
        $this->not_incl_os_done_amount = null;
        $this->incl = null;
        $this->not_incl = null;
        $this->foc = null;
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
            if ($this->collBookingEventUserss) {
                foreach ($this->collBookingEventUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingEventUserss = null;
        $this->aContactRelatedByAuthorId = null;
        $this->aBookingItems = null;
        $this->aContactRelatedByCalledBy = null;
        $this->aContactRelatedByCancelledBy = null;
        $this->aContactRelatedByDeletedBy = null;
        $this->aFacilities = null;
        $this->aItems = null;
        $this->aEventStatus = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BookingEventsTableMap::DEFAULT_STRING_FORMAT);
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
