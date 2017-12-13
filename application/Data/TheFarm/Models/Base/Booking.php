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
use TheFarm\Models\BookingAttachment as ChildBookingAttachment;
use TheFarm\Models\BookingAttachmentQuery as ChildBookingAttachmentQuery;
use TheFarm\Models\BookingEvent as ChildBookingEvent;
use TheFarm\Models\BookingEventQuery as ChildBookingEventQuery;
use TheFarm\Models\BookingItem as ChildBookingItem;
use TheFarm\Models\BookingItemQuery as ChildBookingItemQuery;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\EventStatus as ChildEventStatus;
use TheFarm\Models\EventStatusQuery as ChildEventStatusQuery;
use TheFarm\Models\FormEntry as ChildFormEntry;
use TheFarm\Models\FormEntryQuery as ChildFormEntryQuery;
use TheFarm\Models\Item as ChildItem;
use TheFarm\Models\ItemQuery as ChildItemQuery;
use TheFarm\Models\Package as ChildPackage;
use TheFarm\Models\PackageQuery as ChildPackageQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\BookingAttachmentTableMap;
use TheFarm\Models\Map\BookingEventTableMap;
use TheFarm\Models\Map\BookingItemTableMap;
use TheFarm\Models\Map\BookingTableMap;
use TheFarm\Models\Map\FormEntryTableMap;

/**
 * Base class that represents a row from the 'tf_bookings' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Booking implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\BookingTableMap';


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
     * The value for the booking_id field.
     *
     * @var        int
     */
    protected $booking_id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the package_id field.
     *
     * @var        int
     */
    protected $package_id;

    /**
     * The value for the start_date field.
     *
     * @var        int
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        int
     */
    protected $end_date;

    /**
     * The value for the notes field.
     *
     * @var        string
     */
    protected $notes;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the guest_id field.
     *
     * @var        int
     */
    protected $guest_id;

    /**
     * The value for the fax field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $fax;

    /**
     * The value for the author_id field.
     *
     * Note: this column has a database default value of: 1
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
     * The value for the personalized field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $personalized;

    /**
     * The value for the room_id field.
     *
     * @var        int
     */
    protected $room_id;

    /**
     * The value for the restrictions field.
     *
     * @var        string
     */
    protected $restrictions;

    /**
     * The value for the package_type_id field.
     *
     * @var        int
     */
    protected $package_type_id;

    /**
     * The value for the is_active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ChildContact
     */
    protected $aContact;

    /**
     * @var        ChildPackage
     */
    protected $aPackage;

    /**
     * @var        ChildItem
     */
    protected $aRoom;

    /**
     * @var        ChildEventStatus
     */
    protected $aEventStatus;

    /**
     * @var        ObjectCollection|ChildBookingAttachment[] Collection to store aggregation of ChildBookingAttachment objects.
     */
    protected $collBookingAttachments;
    protected $collBookingAttachmentsPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEvents;
    protected $collBookingEventsPartial;

    /**
     * @var        ObjectCollection|ChildBookingItem[] Collection to store aggregation of ChildBookingItem objects.
     */
    protected $collBookingItems;
    protected $collBookingItemsPartial;

    /**
     * @var        ObjectCollection|ChildFormEntry[] Collection to store aggregation of ChildFormEntry objects.
     */
    protected $collFormEntries;
    protected $collFormEntriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingAttachment[]
     */
    protected $bookingAttachmentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingItem[]
     */
    protected $bookingItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFormEntry[]
     */
    protected $formEntriesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->fax = 0;
        $this->author_id = 1;
        $this->entry_date = 0;
        $this->edit_date = 0;
        $this->personalized = 0;
        $this->is_active = true;
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Booking object.
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
     * Compares this with another <code>Booking</code> instance.  If
     * <code>obj</code> is an instance of <code>Booking</code>, delegates to
     * <code>equals(Booking)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Booking The current object, for fluid interface
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
     * Get the [booking_id] column value.
     *
     * @return int
     */
    public function getBookingId()
    {
        return $this->booking_id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [package_id] column value.
     *
     * @return int
     */
    public function getPackageId()
    {
        return $this->package_id;
    }

    /**
     * Get the [start_date] column value.
     *
     * @return int
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Get the [end_date] column value.
     *
     * @return int
     */
    public function getEndDate()
    {
        return $this->end_date;
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
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [guest_id] column value.
     *
     * @return int
     */
    public function getGuestId()
    {
        return $this->guest_id;
    }

    /**
     * Get the [fax] column value.
     *
     * @return int
     */
    public function getFax()
    {
        return $this->fax;
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
     * Get the [personalized] column value.
     *
     * @return int
     */
    public function getPersonalized()
    {
        return $this->personalized;
    }

    /**
     * Get the [room_id] column value.
     *
     * @return int
     */
    public function getRoomId()
    {
        return $this->room_id;
    }

    /**
     * Get the [restrictions] column value.
     *
     * @return string
     */
    public function getRestrictions()
    {
        return $this->restrictions;
    }

    /**
     * Get the [package_type_id] column value.
     *
     * @return int
     */
    public function getPackageTypeId()
    {
        return $this->package_type_id;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Set the value of [booking_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setBookingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_id !== $v) {
            $this->booking_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_BOOKING_ID] = true;
        }

        return $this;
    } // setBookingId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[BookingTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [package_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setPackageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_id !== $v) {
            $this->package_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_PACKAGE_ID] = true;
        }

        if ($this->aPackage !== null && $this->aPackage->getPackageId() !== $v) {
            $this->aPackage = null;
        }

        return $this;
    } // setPackageId()

    /**
     * Set the value of [start_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[BookingTableMap::COL_START_DATE] = true;
        }

        return $this;
    } // setStartDate()

    /**
     * Set the value of [end_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[BookingTableMap::COL_END_DATE] = true;
        }

        return $this;
    } // setEndDate()

    /**
     * Set the value of [notes] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[BookingTableMap::COL_NOTES] = true;
        }

        return $this;
    } // setNotes()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[BookingTableMap::COL_STATUS] = true;
        }

        if ($this->aEventStatus !== null && $this->aEventStatus->getStatusCd() !== $v) {
            $this->aEventStatus = null;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [guest_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setGuestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->guest_id !== $v) {
            $this->guest_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_GUEST_ID] = true;
        }

        if ($this->aContact !== null && $this->aContact->getContactId() !== $v) {
            $this->aContact = null;
        }

        return $this;
    } // setGuestId()

    /**
     * Set the value of [fax] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[BookingTableMap::COL_FAX] = true;
        }

        return $this;
    } // setFax()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_AUTHOR_ID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getUserId() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setAuthorId()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[BookingTableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[BookingTableMap::COL_EDIT_DATE] = true;
        }

        return $this;
    } // setEditDate()

    /**
     * Set the value of [personalized] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setPersonalized($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->personalized !== $v) {
            $this->personalized = $v;
            $this->modifiedColumns[BookingTableMap::COL_PERSONALIZED] = true;
        }

        return $this;
    } // setPersonalized()

    /**
     * Set the value of [room_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setRoomId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->room_id !== $v) {
            $this->room_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_ROOM_ID] = true;
        }

        if ($this->aRoom !== null && $this->aRoom->getItemId() !== $v) {
            $this->aRoom = null;
        }

        return $this;
    } // setRoomId()

    /**
     * Set the value of [restrictions] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setRestrictions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->restrictions !== $v) {
            $this->restrictions = $v;
            $this->modifiedColumns[BookingTableMap::COL_RESTRICTIONS] = true;
        }

        return $this;
    } // setRestrictions()

    /**
     * Set the value of [package_type_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setPackageTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_type_id !== $v) {
            $this->package_type_id = $v;
            $this->modifiedColumns[BookingTableMap::COL_PACKAGE_TYPE_ID] = true;
        }

        return $this;
    } // setPackageTypeId()

    /**
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[BookingTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    } // setIsActive()

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
            if ($this->fax !== 0) {
                return false;
            }

            if ($this->author_id !== 1) {
                return false;
            }

            if ($this->entry_date !== 0) {
                return false;
            }

            if ($this->edit_date !== 0) {
                return false;
            }

            if ($this->personalized !== 0) {
                return false;
            }

            if ($this->is_active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookingTableMap::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookingTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookingTableMap::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookingTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookingTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookingTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookingTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BookingTableMap::translateFieldName('GuestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->guest_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BookingTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BookingTableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BookingTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BookingTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BookingTableMap::translateFieldName('Personalized', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personalized = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BookingTableMap::translateFieldName('RoomId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->room_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BookingTableMap::translateFieldName('Restrictions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restrictions = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : BookingTableMap::translateFieldName('PackageTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : BookingTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = BookingTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Booking'), 0, $e);
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
        if ($this->aPackage !== null && $this->package_id !== $this->aPackage->getPackageId()) {
            $this->aPackage = null;
        }
        if ($this->aEventStatus !== null && $this->status !== $this->aEventStatus->getStatusCd()) {
            $this->aEventStatus = null;
        }
        if ($this->aContact !== null && $this->guest_id !== $this->aContact->getContactId()) {
            $this->aContact = null;
        }
        if ($this->aUser !== null && $this->author_id !== $this->aUser->getUserId()) {
            $this->aUser = null;
        }
        if ($this->aRoom !== null && $this->room_id !== $this->aRoom->getItemId()) {
            $this->aRoom = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BookingTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookingQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->aContact = null;
            $this->aPackage = null;
            $this->aRoom = null;
            $this->aEventStatus = null;
            $this->collBookingAttachments = null;

            $this->collBookingEvents = null;

            $this->collBookingItems = null;

            $this->collFormEntries = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Booking::setDeleted()
     * @see Booking::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookingQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
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
                BookingTableMap::addInstanceToPool($this);
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

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aContact !== null) {
                if ($this->aContact->isModified() || $this->aContact->isNew()) {
                    $affectedRows += $this->aContact->save($con);
                }
                $this->setContact($this->aContact);
            }

            if ($this->aPackage !== null) {
                if ($this->aPackage->isModified() || $this->aPackage->isNew()) {
                    $affectedRows += $this->aPackage->save($con);
                }
                $this->setPackage($this->aPackage);
            }

            if ($this->aRoom !== null) {
                if ($this->aRoom->isModified() || $this->aRoom->isNew()) {
                    $affectedRows += $this->aRoom->save($con);
                }
                $this->setRoom($this->aRoom);
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

            if ($this->bookingAttachmentsScheduledForDeletion !== null) {
                if (!$this->bookingAttachmentsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingAttachmentQuery::create()
                        ->filterByPrimaryKeys($this->bookingAttachmentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingAttachmentsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingAttachments !== null) {
                foreach ($this->collBookingAttachments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventsScheduledForDeletion !== null) {
                if (!$this->bookingEventsScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsScheduledForDeletion as $bookingEvent) {
                        // need to save related object because we set the relation to null
                        $bookingEvent->save($con);
                    }
                    $this->bookingEventsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEvents !== null) {
                foreach ($this->collBookingEvents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingItemsScheduledForDeletion !== null) {
                if (!$this->bookingItemsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingItemQuery::create()
                        ->filterByPrimaryKeys($this->bookingItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingItemsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingItems !== null) {
                foreach ($this->collBookingItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->formEntriesScheduledForDeletion !== null) {
                if (!$this->formEntriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->formEntriesScheduledForDeletion as $formEntry) {
                        // need to save related object because we set the relation to null
                        $formEntry->save($con);
                    }
                    $this->formEntriesScheduledForDeletion = null;
                }
            }

            if ($this->collFormEntries !== null) {
                foreach ($this->collFormEntries as $referrerFK) {
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

        $this->modifiedColumns[BookingTableMap::COL_BOOKING_ID] = true;
        if (null !== $this->booking_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookingTableMap::COL_BOOKING_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookingTableMap::COL_BOOKING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(BookingTableMap::COL_PACKAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(BookingTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(BookingTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(BookingTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BookingTableMap::COL_GUEST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'guest_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'fax';
        }
        if ($this->isColumnModified(BookingTableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(BookingTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }
        if ($this->isColumnModified(BookingTableMap::COL_PERSONALIZED)) {
            $modifiedColumns[':p' . $index++]  = 'personalized';
        }
        if ($this->isColumnModified(BookingTableMap::COL_ROOM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'room_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_RESTRICTIONS)) {
            $modifiedColumns[':p' . $index++]  = 'restrictions';
        }
        if ($this->isColumnModified(BookingTableMap::COL_PACKAGE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_type_id';
        }
        if ($this->isColumnModified(BookingTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }

        $sql = sprintf(
            'INSERT INTO tf_bookings (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'booking_id':
                        $stmt->bindValue($identifier, $this->booking_id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'package_id':
                        $stmt->bindValue($identifier, $this->package_id, PDO::PARAM_INT);
                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date, PDO::PARAM_INT);
                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date, PDO::PARAM_INT);
                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'guest_id':
                        $stmt->bindValue($identifier, $this->guest_id, PDO::PARAM_INT);
                        break;
                    case 'fax':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_INT);
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
                    case 'personalized':
                        $stmt->bindValue($identifier, $this->personalized, PDO::PARAM_INT);
                        break;
                    case 'room_id':
                        $stmt->bindValue($identifier, $this->room_id, PDO::PARAM_INT);
                        break;
                    case 'restrictions':
                        $stmt->bindValue($identifier, $this->restrictions, PDO::PARAM_STR);
                        break;
                    case 'package_type_id':
                        $stmt->bindValue($identifier, $this->package_type_id, PDO::PARAM_INT);
                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);
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
        $this->setBookingId($pk);

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
        $pos = BookingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBookingId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getPackageId();
                break;
            case 3:
                return $this->getStartDate();
                break;
            case 4:
                return $this->getEndDate();
                break;
            case 5:
                return $this->getNotes();
                break;
            case 6:
                return $this->getStatus();
                break;
            case 7:
                return $this->getGuestId();
                break;
            case 8:
                return $this->getFax();
                break;
            case 9:
                return $this->getAuthorId();
                break;
            case 10:
                return $this->getEntryDate();
                break;
            case 11:
                return $this->getEditDate();
                break;
            case 12:
                return $this->getPersonalized();
                break;
            case 13:
                return $this->getRoomId();
                break;
            case 14:
                return $this->getRestrictions();
                break;
            case 15:
                return $this->getPackageTypeId();
                break;
            case 16:
                return $this->getIsActive();
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

        if (isset($alreadyDumpedObjects['Booking'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Booking'][$this->hashCode()] = true;
        $keys = BookingTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBookingId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getPackageId(),
            $keys[3] => $this->getStartDate(),
            $keys[4] => $this->getEndDate(),
            $keys[5] => $this->getNotes(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getGuestId(),
            $keys[8] => $this->getFax(),
            $keys[9] => $this->getAuthorId(),
            $keys[10] => $this->getEntryDate(),
            $keys[11] => $this->getEditDate(),
            $keys[12] => $this->getPersonalized(),
            $keys[13] => $this->getRoomId(),
            $keys[14] => $this->getRestrictions(),
            $keys[15] => $this->getPackageTypeId(),
            $keys[16] => $this->getIsActive(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_users';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aPackage) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'package';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_packages';
                        break;
                    default:
                        $key = 'Package';
                }

                $result[$key] = $this->aPackage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRoom) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'item';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items';
                        break;
                    default:
                        $key = 'Room';
                }

                $result[$key] = $this->aRoom->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBookingAttachments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingAttachments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_attachmentss';
                        break;
                    default:
                        $key = 'BookingAttachments';
                }

                $result[$key] = $this->collBookingAttachments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEvents) {

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

                $result[$key] = $this->collBookingEvents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_itemss';
                        break;
                    default:
                        $key = 'BookingItems';
                }

                $result[$key] = $this->collBookingItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFormEntries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formEntries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_form_entriess';
                        break;
                    default:
                        $key = 'FormEntries';
                }

                $result[$key] = $this->collFormEntries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Booking
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Booking
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBookingId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setPackageId($value);
                break;
            case 3:
                $this->setStartDate($value);
                break;
            case 4:
                $this->setEndDate($value);
                break;
            case 5:
                $this->setNotes($value);
                break;
            case 6:
                $this->setStatus($value);
                break;
            case 7:
                $this->setGuestId($value);
                break;
            case 8:
                $this->setFax($value);
                break;
            case 9:
                $this->setAuthorId($value);
                break;
            case 10:
                $this->setEntryDate($value);
                break;
            case 11:
                $this->setEditDate($value);
                break;
            case 12:
                $this->setPersonalized($value);
                break;
            case 13:
                $this->setRoomId($value);
                break;
            case 14:
                $this->setRestrictions($value);
                break;
            case 15:
                $this->setPackageTypeId($value);
                break;
            case 16:
                $this->setIsActive($value);
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
        $keys = BookingTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBookingId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPackageId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStartDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEndDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNotes($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGuestId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFax($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAuthorId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEntryDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setEditDate($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPersonalized($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRoomId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setRestrictions($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPackageTypeId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIsActive($arr[$keys[16]]);
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
     * @return $this|\TheFarm\Models\Booking The current object, for fluid interface
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
        $criteria = new Criteria(BookingTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookingTableMap::COL_BOOKING_ID)) {
            $criteria->add(BookingTableMap::COL_BOOKING_ID, $this->booking_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_TITLE)) {
            $criteria->add(BookingTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(BookingTableMap::COL_PACKAGE_ID)) {
            $criteria->add(BookingTableMap::COL_PACKAGE_ID, $this->package_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_START_DATE)) {
            $criteria->add(BookingTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(BookingTableMap::COL_END_DATE)) {
            $criteria->add(BookingTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(BookingTableMap::COL_NOTES)) {
            $criteria->add(BookingTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(BookingTableMap::COL_STATUS)) {
            $criteria->add(BookingTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BookingTableMap::COL_GUEST_ID)) {
            $criteria->add(BookingTableMap::COL_GUEST_ID, $this->guest_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_FAX)) {
            $criteria->add(BookingTableMap::COL_FAX, $this->fax);
        }
        if ($this->isColumnModified(BookingTableMap::COL_AUTHOR_ID)) {
            $criteria->add(BookingTableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_ENTRY_DATE)) {
            $criteria->add(BookingTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(BookingTableMap::COL_EDIT_DATE)) {
            $criteria->add(BookingTableMap::COL_EDIT_DATE, $this->edit_date);
        }
        if ($this->isColumnModified(BookingTableMap::COL_PERSONALIZED)) {
            $criteria->add(BookingTableMap::COL_PERSONALIZED, $this->personalized);
        }
        if ($this->isColumnModified(BookingTableMap::COL_ROOM_ID)) {
            $criteria->add(BookingTableMap::COL_ROOM_ID, $this->room_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_RESTRICTIONS)) {
            $criteria->add(BookingTableMap::COL_RESTRICTIONS, $this->restrictions);
        }
        if ($this->isColumnModified(BookingTableMap::COL_PACKAGE_TYPE_ID)) {
            $criteria->add(BookingTableMap::COL_PACKAGE_TYPE_ID, $this->package_type_id);
        }
        if ($this->isColumnModified(BookingTableMap::COL_IS_ACTIVE)) {
            $criteria->add(BookingTableMap::COL_IS_ACTIVE, $this->is_active);
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
        $criteria = ChildBookingQuery::create();
        $criteria->add(BookingTableMap::COL_BOOKING_ID, $this->booking_id);

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
        $validPk = null !== $this->getBookingId();

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
        return $this->getBookingId();
    }

    /**
     * Generic method to set the primary key (booking_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBookingId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getBookingId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Booking (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setPackageId($this->getPackageId());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setGuestId($this->getGuestId());
        $copyObj->setFax($this->getFax());
        $copyObj->setAuthorId($this->getAuthorId());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());
        $copyObj->setPersonalized($this->getPersonalized());
        $copyObj->setRoomId($this->getRoomId());
        $copyObj->setRestrictions($this->getRestrictions());
        $copyObj->setPackageTypeId($this->getPackageTypeId());
        $copyObj->setIsActive($this->getIsActive());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingAttachments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingAttachment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEvent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFormEntries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFormEntry($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBookingId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Booking Clone of current object.
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
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setAuthorId(1);
        } else {
            $this->setAuthorId($v->getUserId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addBooking($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->author_id !== null)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->author_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addBookings($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a ChildContact object.
     *
     * @param  ChildContact $v
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContact(ChildContact $v = null)
    {
        if ($v === null) {
            $this->setGuestId(NULL);
        } else {
            $this->setGuestId($v->getContactId());
        }

        $this->aContact = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContact object, it will not be re-added.
        if ($v !== null) {
            $v->addBooking($this);
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
        if ($this->aContact === null && ($this->guest_id !== null)) {
            $this->aContact = ChildContactQuery::create()->findPk($this->guest_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContact->addBookings($this);
             */
        }

        return $this->aContact;
    }

    /**
     * Declares an association between this object and a ChildPackage object.
     *
     * @param  ChildPackage $v
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPackage(ChildPackage $v = null)
    {
        if ($v === null) {
            $this->setPackageId(NULL);
        } else {
            $this->setPackageId($v->getPackageId());
        }

        $this->aPackage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPackage object, it will not be re-added.
        if ($v !== null) {
            $v->addBooking($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPackage object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPackage The associated ChildPackage object.
     * @throws PropelException
     */
    public function getPackage(ConnectionInterface $con = null)
    {
        if ($this->aPackage === null && ($this->package_id !== null)) {
            $this->aPackage = ChildPackageQuery::create()->findPk($this->package_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPackage->addBookings($this);
             */
        }

        return $this->aPackage;
    }

    /**
     * Declares an association between this object and a ChildItem object.
     *
     * @param  ChildItem $v
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRoom(ChildItem $v = null)
    {
        if ($v === null) {
            $this->setRoomId(NULL);
        } else {
            $this->setRoomId($v->getItemId());
        }

        $this->aRoom = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildItem object, it will not be re-added.
        if ($v !== null) {
            $v->addBooking($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildItem object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildItem The associated ChildItem object.
     * @throws PropelException
     */
    public function getRoom(ConnectionInterface $con = null)
    {
        if ($this->aRoom === null && ($this->room_id !== null)) {
            $this->aRoom = ChildItemQuery::create()->findPk($this->room_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRoom->addBookings($this);
             */
        }

        return $this->aRoom;
    }

    /**
     * Declares an association between this object and a ChildEventStatus object.
     *
     * @param  ChildEventStatus $v
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
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
            $v->addBooking($this);
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
                $this->aEventStatus->addBookings($this);
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
        if ('BookingAttachment' == $relationName) {
            $this->initBookingAttachments();
            return;
        }
        if ('BookingEvent' == $relationName) {
            $this->initBookingEvents();
            return;
        }
        if ('BookingItem' == $relationName) {
            $this->initBookingItems();
            return;
        }
        if ('FormEntry' == $relationName) {
            $this->initFormEntries();
            return;
        }
    }

    /**
     * Clears out the collBookingAttachments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingAttachments()
     */
    public function clearBookingAttachments()
    {
        $this->collBookingAttachments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingAttachments collection loaded partially.
     */
    public function resetPartialBookingAttachments($v = true)
    {
        $this->collBookingAttachmentsPartial = $v;
    }

    /**
     * Initializes the collBookingAttachments collection.
     *
     * By default this just sets the collBookingAttachments collection to an empty array (like clearcollBookingAttachments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingAttachments($overrideExisting = true)
    {
        if (null !== $this->collBookingAttachments && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingAttachmentTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingAttachments = new $collectionClassName;
        $this->collBookingAttachments->setModel('\TheFarm\Models\BookingAttachment');
    }

    /**
     * Gets an array of ChildBookingAttachment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooking is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingAttachment[] List of ChildBookingAttachment objects
     * @throws PropelException
     */
    public function getBookingAttachments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingAttachmentsPartial && !$this->isNew();
        if (null === $this->collBookingAttachments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingAttachments) {
                // return empty collection
                $this->initBookingAttachments();
            } else {
                $collBookingAttachments = ChildBookingAttachmentQuery::create(null, $criteria)
                    ->filterByBooking($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingAttachmentsPartial && count($collBookingAttachments)) {
                        $this->initBookingAttachments(false);

                        foreach ($collBookingAttachments as $obj) {
                            if (false == $this->collBookingAttachments->contains($obj)) {
                                $this->collBookingAttachments->append($obj);
                            }
                        }

                        $this->collBookingAttachmentsPartial = true;
                    }

                    return $collBookingAttachments;
                }

                if ($partial && $this->collBookingAttachments) {
                    foreach ($this->collBookingAttachments as $obj) {
                        if ($obj->isNew()) {
                            $collBookingAttachments[] = $obj;
                        }
                    }
                }

                $this->collBookingAttachments = $collBookingAttachments;
                $this->collBookingAttachmentsPartial = false;
            }
        }

        return $this->collBookingAttachments;
    }

    /**
     * Sets a collection of ChildBookingAttachment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingAttachments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function setBookingAttachments(Collection $bookingAttachments, ConnectionInterface $con = null)
    {
        /** @var ChildBookingAttachment[] $bookingAttachmentsToDelete */
        $bookingAttachmentsToDelete = $this->getBookingAttachments(new Criteria(), $con)->diff($bookingAttachments);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bookingAttachmentsScheduledForDeletion = clone $bookingAttachmentsToDelete;

        foreach ($bookingAttachmentsToDelete as $bookingAttachmentRemoved) {
            $bookingAttachmentRemoved->setBooking(null);
        }

        $this->collBookingAttachments = null;
        foreach ($bookingAttachments as $bookingAttachment) {
            $this->addBookingAttachment($bookingAttachment);
        }

        $this->collBookingAttachments = $bookingAttachments;
        $this->collBookingAttachmentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingAttachment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingAttachment objects.
     * @throws PropelException
     */
    public function countBookingAttachments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingAttachmentsPartial && !$this->isNew();
        if (null === $this->collBookingAttachments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingAttachments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingAttachments());
            }

            $query = ChildBookingAttachmentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooking($this)
                ->count($con);
        }

        return count($this->collBookingAttachments);
    }

    /**
     * Method called to associate a ChildBookingAttachment object to this object
     * through the ChildBookingAttachment foreign key attribute.
     *
     * @param  ChildBookingAttachment $l ChildBookingAttachment
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function addBookingAttachment(ChildBookingAttachment $l)
    {
        if ($this->collBookingAttachments === null) {
            $this->initBookingAttachments();
            $this->collBookingAttachmentsPartial = true;
        }

        if (!$this->collBookingAttachments->contains($l)) {
            $this->doAddBookingAttachment($l);

            if ($this->bookingAttachmentsScheduledForDeletion and $this->bookingAttachmentsScheduledForDeletion->contains($l)) {
                $this->bookingAttachmentsScheduledForDeletion->remove($this->bookingAttachmentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingAttachment $bookingAttachment The ChildBookingAttachment object to add.
     */
    protected function doAddBookingAttachment(ChildBookingAttachment $bookingAttachment)
    {
        $this->collBookingAttachments[]= $bookingAttachment;
        $bookingAttachment->setBooking($this);
    }

    /**
     * @param  ChildBookingAttachment $bookingAttachment The ChildBookingAttachment object to remove.
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function removeBookingAttachment(ChildBookingAttachment $bookingAttachment)
    {
        if ($this->getBookingAttachments()->contains($bookingAttachment)) {
            $pos = $this->collBookingAttachments->search($bookingAttachment);
            $this->collBookingAttachments->remove($pos);
            if (null === $this->bookingAttachmentsScheduledForDeletion) {
                $this->bookingAttachmentsScheduledForDeletion = clone $this->collBookingAttachments;
                $this->bookingAttachmentsScheduledForDeletion->clear();
            }
            $this->bookingAttachmentsScheduledForDeletion[]= clone $bookingAttachment;
            $bookingAttachment->setBooking(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingAttachments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingAttachment[] List of ChildBookingAttachment objects
     */
    public function getBookingAttachmentsJoinFiles(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingAttachmentQuery::create(null, $criteria);
        $query->joinWith('Files', $joinBehavior);

        return $this->getBookingAttachments($query, $con);
    }

    /**
     * Clears out the collBookingEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEvents()
     */
    public function clearBookingEvents()
    {
        $this->collBookingEvents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEvents collection loaded partially.
     */
    public function resetPartialBookingEvents($v = true)
    {
        $this->collBookingEventsPartial = $v;
    }

    /**
     * Initializes the collBookingEvents collection.
     *
     * By default this just sets the collBookingEvents collection to an empty array (like clearcollBookingEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEvents($overrideExisting = true)
    {
        if (null !== $this->collBookingEvents && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEvents = new $collectionClassName;
        $this->collBookingEvents->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooking is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEvents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsPartial && !$this->isNew();
        if (null === $this->collBookingEvents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEvents) {
                // return empty collection
                $this->initBookingEvents();
            } else {
                $collBookingEvents = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByBooking($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsPartial && count($collBookingEvents)) {
                        $this->initBookingEvents(false);

                        foreach ($collBookingEvents as $obj) {
                            if (false == $this->collBookingEvents->contains($obj)) {
                                $this->collBookingEvents->append($obj);
                            }
                        }

                        $this->collBookingEventsPartial = true;
                    }

                    return $collBookingEvents;
                }

                if ($partial && $this->collBookingEvents) {
                    foreach ($this->collBookingEvents as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEvents[] = $obj;
                        }
                    }
                }

                $this->collBookingEvents = $collBookingEvents;
                $this->collBookingEventsPartial = false;
            }
        }

        return $this->collBookingEvents;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEvents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function setBookingEvents(Collection $bookingEvents, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsToDelete */
        $bookingEventsToDelete = $this->getBookingEvents(new Criteria(), $con)->diff($bookingEvents);


        $this->bookingEventsScheduledForDeletion = $bookingEventsToDelete;

        foreach ($bookingEventsToDelete as $bookingEventRemoved) {
            $bookingEventRemoved->setBooking(null);
        }

        $this->collBookingEvents = null;
        foreach ($bookingEvents as $bookingEvent) {
            $this->addBookingEvent($bookingEvent);
        }

        $this->collBookingEvents = $bookingEvents;
        $this->collBookingEventsPartial = false;

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
    public function countBookingEvents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsPartial && !$this->isNew();
        if (null === $this->collBookingEvents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEvents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEvents());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooking($this)
                ->count($con);
        }

        return count($this->collBookingEvents);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function addBookingEvent(ChildBookingEvent $l)
    {
        if ($this->collBookingEvents === null) {
            $this->initBookingEvents();
            $this->collBookingEventsPartial = true;
        }

        if (!$this->collBookingEvents->contains($l)) {
            $this->doAddBookingEvent($l);

            if ($this->bookingEventsScheduledForDeletion and $this->bookingEventsScheduledForDeletion->contains($l)) {
                $this->bookingEventsScheduledForDeletion->remove($this->bookingEventsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEvent The ChildBookingEvent object to add.
     */
    protected function doAddBookingEvent(ChildBookingEvent $bookingEvent)
    {
        $this->collBookingEvents[]= $bookingEvent;
        $bookingEvent->setBooking($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEvent The ChildBookingEvent object to remove.
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function removeBookingEvent(ChildBookingEvent $bookingEvent)
    {
        if ($this->getBookingEvents()->contains($bookingEvent)) {
            $pos = $this->collBookingEvents->search($bookingEvent);
            $this->collBookingEvents->remove($pos);
            if (null === $this->bookingEventsScheduledForDeletion) {
                $this->bookingEventsScheduledForDeletion = clone $this->collBookingEvents;
                $this->bookingEventsScheduledForDeletion->clear();
            }
            $this->bookingEventsScheduledForDeletion[]= $bookingEvent;
            $bookingEvent->setBooking(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinUserRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByAuthorId', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinUserRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCalledBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinUserRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCancelledBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinUserRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByDeletedBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }

    /**
     * Clears out the collBookingItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingItems()
     */
    public function clearBookingItems()
    {
        $this->collBookingItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingItems collection loaded partially.
     */
    public function resetPartialBookingItems($v = true)
    {
        $this->collBookingItemsPartial = $v;
    }

    /**
     * Initializes the collBookingItems collection.
     *
     * By default this just sets the collBookingItems collection to an empty array (like clearcollBookingItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingItems($overrideExisting = true)
    {
        if (null !== $this->collBookingItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingItemTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingItems = new $collectionClassName;
        $this->collBookingItems->setModel('\TheFarm\Models\BookingItem');
    }

    /**
     * Gets an array of ChildBookingItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooking is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingItem[] List of ChildBookingItem objects
     * @throws PropelException
     */
    public function getBookingItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemsPartial && !$this->isNew();
        if (null === $this->collBookingItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingItems) {
                // return empty collection
                $this->initBookingItems();
            } else {
                $collBookingItems = ChildBookingItemQuery::create(null, $criteria)
                    ->filterByBooking($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingItemsPartial && count($collBookingItems)) {
                        $this->initBookingItems(false);

                        foreach ($collBookingItems as $obj) {
                            if (false == $this->collBookingItems->contains($obj)) {
                                $this->collBookingItems->append($obj);
                            }
                        }

                        $this->collBookingItemsPartial = true;
                    }

                    return $collBookingItems;
                }

                if ($partial && $this->collBookingItems) {
                    foreach ($this->collBookingItems as $obj) {
                        if ($obj->isNew()) {
                            $collBookingItems[] = $obj;
                        }
                    }
                }

                $this->collBookingItems = $collBookingItems;
                $this->collBookingItemsPartial = false;
            }
        }

        return $this->collBookingItems;
    }

    /**
     * Sets a collection of ChildBookingItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingItems A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function setBookingItems(Collection $bookingItems, ConnectionInterface $con = null)
    {
        /** @var ChildBookingItem[] $bookingItemsToDelete */
        $bookingItemsToDelete = $this->getBookingItems(new Criteria(), $con)->diff($bookingItems);


        $this->bookingItemsScheduledForDeletion = $bookingItemsToDelete;

        foreach ($bookingItemsToDelete as $bookingItemRemoved) {
            $bookingItemRemoved->setBooking(null);
        }

        $this->collBookingItems = null;
        foreach ($bookingItems as $bookingItem) {
            $this->addBookingItem($bookingItem);
        }

        $this->collBookingItems = $bookingItems;
        $this->collBookingItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingItem objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingItem objects.
     * @throws PropelException
     */
    public function countBookingItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemsPartial && !$this->isNew();
        if (null === $this->collBookingItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingItems());
            }

            $query = ChildBookingItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooking($this)
                ->count($con);
        }

        return count($this->collBookingItems);
    }

    /**
     * Method called to associate a ChildBookingItem object to this object
     * through the ChildBookingItem foreign key attribute.
     *
     * @param  ChildBookingItem $l ChildBookingItem
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function addBookingItem(ChildBookingItem $l)
    {
        if ($this->collBookingItems === null) {
            $this->initBookingItems();
            $this->collBookingItemsPartial = true;
        }

        if (!$this->collBookingItems->contains($l)) {
            $this->doAddBookingItem($l);

            if ($this->bookingItemsScheduledForDeletion and $this->bookingItemsScheduledForDeletion->contains($l)) {
                $this->bookingItemsScheduledForDeletion->remove($this->bookingItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingItem $bookingItem The ChildBookingItem object to add.
     */
    protected function doAddBookingItem(ChildBookingItem $bookingItem)
    {
        $this->collBookingItems[]= $bookingItem;
        $bookingItem->setBooking($this);
    }

    /**
     * @param  ChildBookingItem $bookingItem The ChildBookingItem object to remove.
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function removeBookingItem(ChildBookingItem $bookingItem)
    {
        if ($this->getBookingItems()->contains($bookingItem)) {
            $pos = $this->collBookingItems->search($bookingItem);
            $this->collBookingItems->remove($pos);
            if (null === $this->bookingItemsScheduledForDeletion) {
                $this->bookingItemsScheduledForDeletion = clone $this->collBookingItems;
                $this->bookingItemsScheduledForDeletion->clear();
            }
            $this->bookingItemsScheduledForDeletion[]= clone $bookingItem;
            $bookingItem->setBooking(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related BookingItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingItem[] List of ChildBookingItem objects
     */
    public function getBookingItemsJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingItemQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingItems($query, $con);
    }

    /**
     * Clears out the collFormEntries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFormEntries()
     */
    public function clearFormEntries()
    {
        $this->collFormEntries = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFormEntries collection loaded partially.
     */
    public function resetPartialFormEntries($v = true)
    {
        $this->collFormEntriesPartial = $v;
    }

    /**
     * Initializes the collFormEntries collection.
     *
     * By default this just sets the collFormEntries collection to an empty array (like clearcollFormEntries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFormEntries($overrideExisting = true)
    {
        if (null !== $this->collFormEntries && !$overrideExisting) {
            return;
        }

        $collectionClassName = FormEntryTableMap::getTableMap()->getCollectionClassName();

        $this->collFormEntries = new $collectionClassName;
        $this->collFormEntries->setModel('\TheFarm\Models\FormEntry');
    }

    /**
     * Gets an array of ChildFormEntry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBooking is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     * @throws PropelException
     */
    public function getFormEntries(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriesPartial && !$this->isNew();
        if (null === $this->collFormEntries || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFormEntries) {
                // return empty collection
                $this->initFormEntries();
            } else {
                $collFormEntries = ChildFormEntryQuery::create(null, $criteria)
                    ->filterByBooking($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFormEntriesPartial && count($collFormEntries)) {
                        $this->initFormEntries(false);

                        foreach ($collFormEntries as $obj) {
                            if (false == $this->collFormEntries->contains($obj)) {
                                $this->collFormEntries->append($obj);
                            }
                        }

                        $this->collFormEntriesPartial = true;
                    }

                    return $collFormEntries;
                }

                if ($partial && $this->collFormEntries) {
                    foreach ($this->collFormEntries as $obj) {
                        if ($obj->isNew()) {
                            $collFormEntries[] = $obj;
                        }
                    }
                }

                $this->collFormEntries = $collFormEntries;
                $this->collFormEntriesPartial = false;
            }
        }

        return $this->collFormEntries;
    }

    /**
     * Sets a collection of ChildFormEntry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $formEntries A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function setFormEntries(Collection $formEntries, ConnectionInterface $con = null)
    {
        /** @var ChildFormEntry[] $formEntriesToDelete */
        $formEntriesToDelete = $this->getFormEntries(new Criteria(), $con)->diff($formEntries);


        $this->formEntriesScheduledForDeletion = $formEntriesToDelete;

        foreach ($formEntriesToDelete as $formEntryRemoved) {
            $formEntryRemoved->setBooking(null);
        }

        $this->collFormEntries = null;
        foreach ($formEntries as $formEntry) {
            $this->addFormEntry($formEntry);
        }

        $this->collFormEntries = $formEntries;
        $this->collFormEntriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FormEntry objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FormEntry objects.
     * @throws PropelException
     */
    public function countFormEntries(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriesPartial && !$this->isNew();
        if (null === $this->collFormEntries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFormEntries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFormEntries());
            }

            $query = ChildFormEntryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBooking($this)
                ->count($con);
        }

        return count($this->collFormEntries);
    }

    /**
     * Method called to associate a ChildFormEntry object to this object
     * through the ChildFormEntry foreign key attribute.
     *
     * @param  ChildFormEntry $l ChildFormEntry
     * @return $this|\TheFarm\Models\Booking The current object (for fluent API support)
     */
    public function addFormEntry(ChildFormEntry $l)
    {
        if ($this->collFormEntries === null) {
            $this->initFormEntries();
            $this->collFormEntriesPartial = true;
        }

        if (!$this->collFormEntries->contains($l)) {
            $this->doAddFormEntry($l);

            if ($this->formEntriesScheduledForDeletion and $this->formEntriesScheduledForDeletion->contains($l)) {
                $this->formEntriesScheduledForDeletion->remove($this->formEntriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFormEntry $formEntry The ChildFormEntry object to add.
     */
    protected function doAddFormEntry(ChildFormEntry $formEntry)
    {
        $this->collFormEntries[]= $formEntry;
        $formEntry->setBooking($this);
    }

    /**
     * @param  ChildFormEntry $formEntry The ChildFormEntry object to remove.
     * @return $this|ChildBooking The current object (for fluent API support)
     */
    public function removeFormEntry(ChildFormEntry $formEntry)
    {
        if ($this->getFormEntries()->contains($formEntry)) {
            $pos = $this->collFormEntries->search($formEntry);
            $this->collFormEntries->remove($pos);
            if (null === $this->formEntriesScheduledForDeletion) {
                $this->formEntriesScheduledForDeletion = clone $this->collFormEntries;
                $this->formEntriesScheduledForDeletion->clear();
            }
            $this->formEntriesScheduledForDeletion[]= $formEntry;
            $formEntry->setBooking(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related FormEntries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     */
    public function getFormEntriesJoinField(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntryQuery::create(null, $criteria);
        $query->joinWith('Field', $joinBehavior);

        return $this->getFormEntries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Booking is new, it will return
     * an empty collection; or if this Booking has previously
     * been saved, it will retrieve related FormEntries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Booking.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     */
    public function getFormEntriesJoinForm(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntryQuery::create(null, $criteria);
        $query->joinWith('Form', $joinBehavior);

        return $this->getFormEntries($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUser) {
            $this->aUser->removeBooking($this);
        }
        if (null !== $this->aContact) {
            $this->aContact->removeBooking($this);
        }
        if (null !== $this->aPackage) {
            $this->aPackage->removeBooking($this);
        }
        if (null !== $this->aRoom) {
            $this->aRoom->removeBooking($this);
        }
        if (null !== $this->aEventStatus) {
            $this->aEventStatus->removeBooking($this);
        }
        $this->booking_id = null;
        $this->title = null;
        $this->package_id = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->notes = null;
        $this->status = null;
        $this->guest_id = null;
        $this->fax = null;
        $this->author_id = null;
        $this->entry_date = null;
        $this->edit_date = null;
        $this->personalized = null;
        $this->room_id = null;
        $this->restrictions = null;
        $this->package_type_id = null;
        $this->is_active = null;
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
            if ($this->collBookingAttachments) {
                foreach ($this->collBookingAttachments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEvents) {
                foreach ($this->collBookingEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingItems) {
                foreach ($this->collBookingItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFormEntries) {
                foreach ($this->collFormEntries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingAttachments = null;
        $this->collBookingEvents = null;
        $this->collBookingItems = null;
        $this->collFormEntries = null;
        $this->aUser = null;
        $this->aContact = null;
        $this->aPackage = null;
        $this->aRoom = null;
        $this->aEventStatus = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BookingTableMap::DEFAULT_STRING_FORMAT);
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
