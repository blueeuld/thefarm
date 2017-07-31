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
use TheFarm\Models\BookingAttachments as ChildBookingAttachments;
use TheFarm\Models\BookingAttachmentsQuery as ChildBookingAttachmentsQuery;
use TheFarm\Models\BookingItems as ChildBookingItems;
use TheFarm\Models\BookingItemsQuery as ChildBookingItemsQuery;
use TheFarm\Models\Bookings as ChildBookings;
use TheFarm\Models\BookingsQuery as ChildBookingsQuery;
use TheFarm\Models\Contacts as ChildContacts;
use TheFarm\Models\ContactsQuery as ChildContactsQuery;
use TheFarm\Models\EventStatus as ChildEventStatus;
use TheFarm\Models\EventStatusQuery as ChildEventStatusQuery;
use TheFarm\Models\FormEntries as ChildFormEntries;
use TheFarm\Models\FormEntriesQuery as ChildFormEntriesQuery;
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\Packages as ChildPackages;
use TheFarm\Models\PackagesQuery as ChildPackagesQuery;
use TheFarm\Models\Map\BookingAttachmentsTableMap;
use TheFarm\Models\Map\BookingItemsTableMap;
use TheFarm\Models\Map\BookingsTableMap;
use TheFarm\Models\Map\FormEntriesTableMap;

/**
 * Base class that represents a row from the 'tf_bookings' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Bookings implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\BookingsTableMap';


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
     * @var        ChildContacts
     */
    protected $aContactsRelatedByAuthorId;

    /**
     * @var        ChildContacts
     */
    protected $aContactsRelatedByGuestId;

    /**
     * @var        ChildPackages
     */
    protected $aPackages;

    /**
     * @var        ChildItems
     */
    protected $aItems;

    /**
     * @var        ChildEventStatus
     */
    protected $aEventStatus;

    /**
     * @var        ObjectCollection|ChildBookingAttachments[] Collection to store aggregation of ChildBookingAttachments objects.
     */
    protected $collBookingAttachmentss;
    protected $collBookingAttachmentssPartial;

    /**
     * @var        ObjectCollection|ChildBookingItems[] Collection to store aggregation of ChildBookingItems objects.
     */
    protected $collBookingItemss;
    protected $collBookingItemssPartial;

    /**
     * @var        ObjectCollection|ChildFormEntries[] Collection to store aggregation of ChildFormEntries objects.
     */
    protected $collFormEntriess;
    protected $collFormEntriessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingAttachments[]
     */
    protected $bookingAttachmentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingItems[]
     */
    protected $bookingItemssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFormEntries[]
     */
    protected $formEntriessScheduledForDeletion = null;

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
     * Initializes internal state of TheFarm\Models\Base\Bookings object.
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
     * Compares this with another <code>Bookings</code> instance.  If
     * <code>obj</code> is an instance of <code>Bookings</code>, delegates to
     * <code>equals(Bookings)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Bookings The current object, for fluid interface
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
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setBookingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_id !== $v) {
            $this->booking_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_BOOKING_ID] = true;
        }

        return $this;
    } // setBookingId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[BookingsTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [package_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setPackageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_id !== $v) {
            $this->package_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_PACKAGE_ID] = true;
        }

        if ($this->aPackages !== null && $this->aPackages->getPackageId() !== $v) {
            $this->aPackages = null;
        }

        return $this;
    } // setPackageId()

    /**
     * Set the value of [start_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[BookingsTableMap::COL_START_DATE] = true;
        }

        return $this;
    } // setStartDate()

    /**
     * Set the value of [end_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[BookingsTableMap::COL_END_DATE] = true;
        }

        return $this;
    } // setEndDate()

    /**
     * Set the value of [notes] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[BookingsTableMap::COL_NOTES] = true;
        }

        return $this;
    } // setNotes()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[BookingsTableMap::COL_STATUS] = true;
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
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setGuestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->guest_id !== $v) {
            $this->guest_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_GUEST_ID] = true;
        }

        if ($this->aContactsRelatedByGuestId !== null && $this->aContactsRelatedByGuestId->getContactId() !== $v) {
            $this->aContactsRelatedByGuestId = null;
        }

        return $this;
    } // setGuestId()

    /**
     * Set the value of [fax] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[BookingsTableMap::COL_FAX] = true;
        }

        return $this;
    } // setFax()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_AUTHOR_ID] = true;
        }

        if ($this->aContactsRelatedByAuthorId !== null && $this->aContactsRelatedByAuthorId->getContactId() !== $v) {
            $this->aContactsRelatedByAuthorId = null;
        }

        return $this;
    } // setAuthorId()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[BookingsTableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[BookingsTableMap::COL_EDIT_DATE] = true;
        }

        return $this;
    } // setEditDate()

    /**
     * Set the value of [personalized] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setPersonalized($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->personalized !== $v) {
            $this->personalized = $v;
            $this->modifiedColumns[BookingsTableMap::COL_PERSONALIZED] = true;
        }

        return $this;
    } // setPersonalized()

    /**
     * Set the value of [room_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setRoomId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->room_id !== $v) {
            $this->room_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_ROOM_ID] = true;
        }

        if ($this->aItems !== null && $this->aItems->getItemId() !== $v) {
            $this->aItems = null;
        }

        return $this;
    } // setRoomId()

    /**
     * Set the value of [restrictions] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setRestrictions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->restrictions !== $v) {
            $this->restrictions = $v;
            $this->modifiedColumns[BookingsTableMap::COL_RESTRICTIONS] = true;
        }

        return $this;
    } // setRestrictions()

    /**
     * Set the value of [package_type_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function setPackageTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_type_id !== $v) {
            $this->package_type_id = $v;
            $this->modifiedColumns[BookingsTableMap::COL_PACKAGE_TYPE_ID] = true;
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
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
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
            $this->modifiedColumns[BookingsTableMap::COL_IS_ACTIVE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookingsTableMap::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookingsTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookingsTableMap::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookingsTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookingsTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookingsTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookingsTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BookingsTableMap::translateFieldName('GuestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->guest_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BookingsTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BookingsTableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BookingsTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BookingsTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BookingsTableMap::translateFieldName('Personalized', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personalized = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BookingsTableMap::translateFieldName('RoomId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->room_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BookingsTableMap::translateFieldName('Restrictions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restrictions = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : BookingsTableMap::translateFieldName('PackageTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : BookingsTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = BookingsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Bookings'), 0, $e);
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
        if ($this->aPackages !== null && $this->package_id !== $this->aPackages->getPackageId()) {
            $this->aPackages = null;
        }
        if ($this->aEventStatus !== null && $this->status !== $this->aEventStatus->getStatusCd()) {
            $this->aEventStatus = null;
        }
        if ($this->aContactsRelatedByGuestId !== null && $this->guest_id !== $this->aContactsRelatedByGuestId->getContactId()) {
            $this->aContactsRelatedByGuestId = null;
        }
        if ($this->aContactsRelatedByAuthorId !== null && $this->author_id !== $this->aContactsRelatedByAuthorId->getContactId()) {
            $this->aContactsRelatedByAuthorId = null;
        }
        if ($this->aItems !== null && $this->room_id !== $this->aItems->getItemId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(BookingsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookingsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aContactsRelatedByAuthorId = null;
            $this->aContactsRelatedByGuestId = null;
            $this->aPackages = null;
            $this->aItems = null;
            $this->aEventStatus = null;
            $this->collBookingAttachmentss = null;

            $this->collBookingItemss = null;

            $this->collFormEntriess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Bookings::setDeleted()
     * @see Bookings::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookingsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
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
                BookingsTableMap::addInstanceToPool($this);
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

            if ($this->aContactsRelatedByAuthorId !== null) {
                if ($this->aContactsRelatedByAuthorId->isModified() || $this->aContactsRelatedByAuthorId->isNew()) {
                    $affectedRows += $this->aContactsRelatedByAuthorId->save($con);
                }
                $this->setContactsRelatedByAuthorId($this->aContactsRelatedByAuthorId);
            }

            if ($this->aContactsRelatedByGuestId !== null) {
                if ($this->aContactsRelatedByGuestId->isModified() || $this->aContactsRelatedByGuestId->isNew()) {
                    $affectedRows += $this->aContactsRelatedByGuestId->save($con);
                }
                $this->setContactsRelatedByGuestId($this->aContactsRelatedByGuestId);
            }

            if ($this->aPackages !== null) {
                if ($this->aPackages->isModified() || $this->aPackages->isNew()) {
                    $affectedRows += $this->aPackages->save($con);
                }
                $this->setPackages($this->aPackages);
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

            if ($this->bookingAttachmentssScheduledForDeletion !== null) {
                if (!$this->bookingAttachmentssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingAttachmentsQuery::create()
                        ->filterByPrimaryKeys($this->bookingAttachmentssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingAttachmentssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingAttachmentss !== null) {
                foreach ($this->collBookingAttachmentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingItemssScheduledForDeletion !== null) {
                if (!$this->bookingItemssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingItemsQuery::create()
                        ->filterByPrimaryKeys($this->bookingItemssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingItemssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingItemss !== null) {
                foreach ($this->collBookingItemss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->formEntriessScheduledForDeletion !== null) {
                if (!$this->formEntriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->formEntriessScheduledForDeletion as $formEntries) {
                        // need to save related object because we set the relation to null
                        $formEntries->save($con);
                    }
                    $this->formEntriessScheduledForDeletion = null;
                }
            }

            if ($this->collFormEntriess !== null) {
                foreach ($this->collFormEntriess as $referrerFK) {
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

        $this->modifiedColumns[BookingsTableMap::COL_BOOKING_ID] = true;
        if (null !== $this->booking_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookingsTableMap::COL_BOOKING_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookingsTableMap::COL_BOOKING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PACKAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_GUEST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'guest_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'fax';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PERSONALIZED)) {
            $modifiedColumns[':p' . $index++]  = 'personalized';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_ROOM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'room_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_RESTRICTIONS)) {
            $modifiedColumns[':p' . $index++]  = 'restrictions';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PACKAGE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_type_id';
        }
        if ($this->isColumnModified(BookingsTableMap::COL_IS_ACTIVE)) {
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
        $pos = BookingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

        if (isset($alreadyDumpedObjects['Bookings'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Bookings'][$this->hashCode()] = true;
        $keys = BookingsTableMap::getFieldNames($keyType);
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
            if (null !== $this->aContactsRelatedByAuthorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'contacts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_contacts';
                        break;
                    default:
                        $key = 'Contacts';
                }

                $result[$key] = $this->aContactsRelatedByAuthorId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aContactsRelatedByGuestId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'contacts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_contacts';
                        break;
                    default:
                        $key = 'Contacts';
                }

                $result[$key] = $this->aContactsRelatedByGuestId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPackages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_packages';
                        break;
                    default:
                        $key = 'Packages';
                }

                $result[$key] = $this->aPackages->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBookingAttachmentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingAttachmentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_attachmentss';
                        break;
                    default:
                        $key = 'BookingAttachmentss';
                }

                $result[$key] = $this->collBookingAttachmentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingItemss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingItemss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_itemss';
                        break;
                    default:
                        $key = 'BookingItemss';
                }

                $result[$key] = $this->collBookingItemss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFormEntriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formEntriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_form_entriess';
                        break;
                    default:
                        $key = 'FormEntriess';
                }

                $result[$key] = $this->collFormEntriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Bookings
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Bookings
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
        $keys = BookingsTableMap::getFieldNames($keyType);

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
     * @return $this|\TheFarm\Models\Bookings The current object, for fluid interface
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
        $criteria = new Criteria(BookingsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookingsTableMap::COL_BOOKING_ID)) {
            $criteria->add(BookingsTableMap::COL_BOOKING_ID, $this->booking_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_TITLE)) {
            $criteria->add(BookingsTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PACKAGE_ID)) {
            $criteria->add(BookingsTableMap::COL_PACKAGE_ID, $this->package_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_START_DATE)) {
            $criteria->add(BookingsTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_END_DATE)) {
            $criteria->add(BookingsTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_NOTES)) {
            $criteria->add(BookingsTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_STATUS)) {
            $criteria->add(BookingsTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_GUEST_ID)) {
            $criteria->add(BookingsTableMap::COL_GUEST_ID, $this->guest_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_FAX)) {
            $criteria->add(BookingsTableMap::COL_FAX, $this->fax);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_AUTHOR_ID)) {
            $criteria->add(BookingsTableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_ENTRY_DATE)) {
            $criteria->add(BookingsTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_EDIT_DATE)) {
            $criteria->add(BookingsTableMap::COL_EDIT_DATE, $this->edit_date);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PERSONALIZED)) {
            $criteria->add(BookingsTableMap::COL_PERSONALIZED, $this->personalized);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_ROOM_ID)) {
            $criteria->add(BookingsTableMap::COL_ROOM_ID, $this->room_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_RESTRICTIONS)) {
            $criteria->add(BookingsTableMap::COL_RESTRICTIONS, $this->restrictions);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_PACKAGE_TYPE_ID)) {
            $criteria->add(BookingsTableMap::COL_PACKAGE_TYPE_ID, $this->package_type_id);
        }
        if ($this->isColumnModified(BookingsTableMap::COL_IS_ACTIVE)) {
            $criteria->add(BookingsTableMap::COL_IS_ACTIVE, $this->is_active);
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
        $criteria = ChildBookingsQuery::create();
        $criteria->add(BookingsTableMap::COL_BOOKING_ID, $this->booking_id);

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
     * @param      object $copyObj An object of \TheFarm\Models\Bookings (or compatible) type.
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

            foreach ($this->getBookingAttachmentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingAttachments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingItemss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingItems($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFormEntriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFormEntries($relObj->copy($deepCopy));
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
     * @return \TheFarm\Models\Bookings Clone of current object.
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
     * Declares an association between this object and a ChildContacts object.
     *
     * @param  ChildContacts $v
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactsRelatedByAuthorId(ChildContacts $v = null)
    {
        if ($v === null) {
            $this->setAuthorId(1);
        } else {
            $this->setAuthorId($v->getContactId());
        }

        $this->aContactsRelatedByAuthorId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContacts object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingsRelatedByAuthorId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildContacts object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildContacts The associated ChildContacts object.
     * @throws PropelException
     */
    public function getContactsRelatedByAuthorId(ConnectionInterface $con = null)
    {
        if ($this->aContactsRelatedByAuthorId === null && ($this->author_id !== null)) {
            $this->aContactsRelatedByAuthorId = ChildContactsQuery::create()->findPk($this->author_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactsRelatedByAuthorId->addBookingssRelatedByAuthorId($this);
             */
        }

        return $this->aContactsRelatedByAuthorId;
    }

    /**
     * Declares an association between this object and a ChildContacts object.
     *
     * @param  ChildContacts $v
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactsRelatedByGuestId(ChildContacts $v = null)
    {
        if ($v === null) {
            $this->setGuestId(NULL);
        } else {
            $this->setGuestId($v->getContactId());
        }

        $this->aContactsRelatedByGuestId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildContacts object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingsRelatedByGuestId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildContacts object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildContacts The associated ChildContacts object.
     * @throws PropelException
     */
    public function getContactsRelatedByGuestId(ConnectionInterface $con = null)
    {
        if ($this->aContactsRelatedByGuestId === null && ($this->guest_id !== null)) {
            $this->aContactsRelatedByGuestId = ChildContactsQuery::create()->findPk($this->guest_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactsRelatedByGuestId->addBookingssRelatedByGuestId($this);
             */
        }

        return $this->aContactsRelatedByGuestId;
    }

    /**
     * Declares an association between this object and a ChildPackages object.
     *
     * @param  ChildPackages $v
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPackages(ChildPackages $v = null)
    {
        if ($v === null) {
            $this->setPackageId(NULL);
        } else {
            $this->setPackageId($v->getPackageId());
        }

        $this->aPackages = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPackages object, it will not be re-added.
        if ($v !== null) {
            $v->addBookings($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPackages object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPackages The associated ChildPackages object.
     * @throws PropelException
     */
    public function getPackages(ConnectionInterface $con = null)
    {
        if ($this->aPackages === null && ($this->package_id !== null)) {
            $this->aPackages = ChildPackagesQuery::create()->findPk($this->package_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPackages->addBookingss($this);
             */
        }

        return $this->aPackages;
    }

    /**
     * Declares an association between this object and a ChildItems object.
     *
     * @param  ChildItems $v
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setItems(ChildItems $v = null)
    {
        if ($v === null) {
            $this->setRoomId(NULL);
        } else {
            $this->setRoomId($v->getItemId());
        }

        $this->aItems = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildItems object, it will not be re-added.
        if ($v !== null) {
            $v->addBookings($this);
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
        if ($this->aItems === null && ($this->room_id !== null)) {
            $this->aItems = ChildItemsQuery::create()->findPk($this->room_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aItems->addBookingss($this);
             */
        }

        return $this->aItems;
    }

    /**
     * Declares an association between this object and a ChildEventStatus object.
     *
     * @param  ChildEventStatus $v
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
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
            $v->addBookings($this);
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
                $this->aEventStatus->addBookingss($this);
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
        if ('BookingAttachments' == $relationName) {
            $this->initBookingAttachmentss();
            return;
        }
        if ('BookingItems' == $relationName) {
            $this->initBookingItemss();
            return;
        }
        if ('FormEntries' == $relationName) {
            $this->initFormEntriess();
            return;
        }
    }

    /**
     * Clears out the collBookingAttachmentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingAttachmentss()
     */
    public function clearBookingAttachmentss()
    {
        $this->collBookingAttachmentss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingAttachmentss collection loaded partially.
     */
    public function resetPartialBookingAttachmentss($v = true)
    {
        $this->collBookingAttachmentssPartial = $v;
    }

    /**
     * Initializes the collBookingAttachmentss collection.
     *
     * By default this just sets the collBookingAttachmentss collection to an empty array (like clearcollBookingAttachmentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingAttachmentss($overrideExisting = true)
    {
        if (null !== $this->collBookingAttachmentss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingAttachmentsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingAttachmentss = new $collectionClassName;
        $this->collBookingAttachmentss->setModel('\TheFarm\Models\BookingAttachments');
    }

    /**
     * Gets an array of ChildBookingAttachments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingAttachments[] List of ChildBookingAttachments objects
     * @throws PropelException
     */
    public function getBookingAttachmentss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingAttachmentssPartial && !$this->isNew();
        if (null === $this->collBookingAttachmentss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingAttachmentss) {
                // return empty collection
                $this->initBookingAttachmentss();
            } else {
                $collBookingAttachmentss = ChildBookingAttachmentsQuery::create(null, $criteria)
                    ->filterByBookings($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingAttachmentssPartial && count($collBookingAttachmentss)) {
                        $this->initBookingAttachmentss(false);

                        foreach ($collBookingAttachmentss as $obj) {
                            if (false == $this->collBookingAttachmentss->contains($obj)) {
                                $this->collBookingAttachmentss->append($obj);
                            }
                        }

                        $this->collBookingAttachmentssPartial = true;
                    }

                    return $collBookingAttachmentss;
                }

                if ($partial && $this->collBookingAttachmentss) {
                    foreach ($this->collBookingAttachmentss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingAttachmentss[] = $obj;
                        }
                    }
                }

                $this->collBookingAttachmentss = $collBookingAttachmentss;
                $this->collBookingAttachmentssPartial = false;
            }
        }

        return $this->collBookingAttachmentss;
    }

    /**
     * Sets a collection of ChildBookingAttachments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingAttachmentss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function setBookingAttachmentss(Collection $bookingAttachmentss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingAttachments[] $bookingAttachmentssToDelete */
        $bookingAttachmentssToDelete = $this->getBookingAttachmentss(new Criteria(), $con)->diff($bookingAttachmentss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bookingAttachmentssScheduledForDeletion = clone $bookingAttachmentssToDelete;

        foreach ($bookingAttachmentssToDelete as $bookingAttachmentsRemoved) {
            $bookingAttachmentsRemoved->setBookings(null);
        }

        $this->collBookingAttachmentss = null;
        foreach ($bookingAttachmentss as $bookingAttachments) {
            $this->addBookingAttachments($bookingAttachments);
        }

        $this->collBookingAttachmentss = $bookingAttachmentss;
        $this->collBookingAttachmentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingAttachments objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingAttachments objects.
     * @throws PropelException
     */
    public function countBookingAttachmentss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingAttachmentssPartial && !$this->isNew();
        if (null === $this->collBookingAttachmentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingAttachmentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingAttachmentss());
            }

            $query = ChildBookingAttachmentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookings($this)
                ->count($con);
        }

        return count($this->collBookingAttachmentss);
    }

    /**
     * Method called to associate a ChildBookingAttachments object to this object
     * through the ChildBookingAttachments foreign key attribute.
     *
     * @param  ChildBookingAttachments $l ChildBookingAttachments
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function addBookingAttachments(ChildBookingAttachments $l)
    {
        if ($this->collBookingAttachmentss === null) {
            $this->initBookingAttachmentss();
            $this->collBookingAttachmentssPartial = true;
        }

        if (!$this->collBookingAttachmentss->contains($l)) {
            $this->doAddBookingAttachments($l);

            if ($this->bookingAttachmentssScheduledForDeletion and $this->bookingAttachmentssScheduledForDeletion->contains($l)) {
                $this->bookingAttachmentssScheduledForDeletion->remove($this->bookingAttachmentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingAttachments $bookingAttachments The ChildBookingAttachments object to add.
     */
    protected function doAddBookingAttachments(ChildBookingAttachments $bookingAttachments)
    {
        $this->collBookingAttachmentss[]= $bookingAttachments;
        $bookingAttachments->setBookings($this);
    }

    /**
     * @param  ChildBookingAttachments $bookingAttachments The ChildBookingAttachments object to remove.
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function removeBookingAttachments(ChildBookingAttachments $bookingAttachments)
    {
        if ($this->getBookingAttachmentss()->contains($bookingAttachments)) {
            $pos = $this->collBookingAttachmentss->search($bookingAttachments);
            $this->collBookingAttachmentss->remove($pos);
            if (null === $this->bookingAttachmentssScheduledForDeletion) {
                $this->bookingAttachmentssScheduledForDeletion = clone $this->collBookingAttachmentss;
                $this->bookingAttachmentssScheduledForDeletion->clear();
            }
            $this->bookingAttachmentssScheduledForDeletion[]= clone $bookingAttachments;
            $bookingAttachments->setBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bookings is new, it will return
     * an empty collection; or if this Bookings has previously
     * been saved, it will retrieve related BookingAttachmentss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bookings.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingAttachments[] List of ChildBookingAttachments objects
     */
    public function getBookingAttachmentssJoinFiles(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingAttachmentsQuery::create(null, $criteria);
        $query->joinWith('Files', $joinBehavior);

        return $this->getBookingAttachmentss($query, $con);
    }

    /**
     * Clears out the collBookingItemss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingItemss()
     */
    public function clearBookingItemss()
    {
        $this->collBookingItemss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingItemss collection loaded partially.
     */
    public function resetPartialBookingItemss($v = true)
    {
        $this->collBookingItemssPartial = $v;
    }

    /**
     * Initializes the collBookingItemss collection.
     *
     * By default this just sets the collBookingItemss collection to an empty array (like clearcollBookingItemss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingItemss($overrideExisting = true)
    {
        if (null !== $this->collBookingItemss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingItemsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingItemss = new $collectionClassName;
        $this->collBookingItemss->setModel('\TheFarm\Models\BookingItems');
    }

    /**
     * Gets an array of ChildBookingItems objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingItems[] List of ChildBookingItems objects
     * @throws PropelException
     */
    public function getBookingItemss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemssPartial && !$this->isNew();
        if (null === $this->collBookingItemss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingItemss) {
                // return empty collection
                $this->initBookingItemss();
            } else {
                $collBookingItemss = ChildBookingItemsQuery::create(null, $criteria)
                    ->filterByBookings($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingItemssPartial && count($collBookingItemss)) {
                        $this->initBookingItemss(false);

                        foreach ($collBookingItemss as $obj) {
                            if (false == $this->collBookingItemss->contains($obj)) {
                                $this->collBookingItemss->append($obj);
                            }
                        }

                        $this->collBookingItemssPartial = true;
                    }

                    return $collBookingItemss;
                }

                if ($partial && $this->collBookingItemss) {
                    foreach ($this->collBookingItemss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingItemss[] = $obj;
                        }
                    }
                }

                $this->collBookingItemss = $collBookingItemss;
                $this->collBookingItemssPartial = false;
            }
        }

        return $this->collBookingItemss;
    }

    /**
     * Sets a collection of ChildBookingItems objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingItemss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function setBookingItemss(Collection $bookingItemss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingItems[] $bookingItemssToDelete */
        $bookingItemssToDelete = $this->getBookingItemss(new Criteria(), $con)->diff($bookingItemss);


        $this->bookingItemssScheduledForDeletion = $bookingItemssToDelete;

        foreach ($bookingItemssToDelete as $bookingItemsRemoved) {
            $bookingItemsRemoved->setBookings(null);
        }

        $this->collBookingItemss = null;
        foreach ($bookingItemss as $bookingItems) {
            $this->addBookingItems($bookingItems);
        }

        $this->collBookingItemss = $bookingItemss;
        $this->collBookingItemssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingItems objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingItems objects.
     * @throws PropelException
     */
    public function countBookingItemss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemssPartial && !$this->isNew();
        if (null === $this->collBookingItemss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingItemss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingItemss());
            }

            $query = ChildBookingItemsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookings($this)
                ->count($con);
        }

        return count($this->collBookingItemss);
    }

    /**
     * Method called to associate a ChildBookingItems object to this object
     * through the ChildBookingItems foreign key attribute.
     *
     * @param  ChildBookingItems $l ChildBookingItems
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function addBookingItems(ChildBookingItems $l)
    {
        if ($this->collBookingItemss === null) {
            $this->initBookingItemss();
            $this->collBookingItemssPartial = true;
        }

        if (!$this->collBookingItemss->contains($l)) {
            $this->doAddBookingItems($l);

            if ($this->bookingItemssScheduledForDeletion and $this->bookingItemssScheduledForDeletion->contains($l)) {
                $this->bookingItemssScheduledForDeletion->remove($this->bookingItemssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingItems $bookingItems The ChildBookingItems object to add.
     */
    protected function doAddBookingItems(ChildBookingItems $bookingItems)
    {
        $this->collBookingItemss[]= $bookingItems;
        $bookingItems->setBookings($this);
    }

    /**
     * @param  ChildBookingItems $bookingItems The ChildBookingItems object to remove.
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function removeBookingItems(ChildBookingItems $bookingItems)
    {
        if ($this->getBookingItemss()->contains($bookingItems)) {
            $pos = $this->collBookingItemss->search($bookingItems);
            $this->collBookingItemss->remove($pos);
            if (null === $this->bookingItemssScheduledForDeletion) {
                $this->bookingItemssScheduledForDeletion = clone $this->collBookingItemss;
                $this->bookingItemssScheduledForDeletion->clear();
            }
            $this->bookingItemssScheduledForDeletion[]= clone $bookingItems;
            $bookingItems->setBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bookings is new, it will return
     * an empty collection; or if this Bookings has previously
     * been saved, it will retrieve related BookingItemss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bookings.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingItems[] List of ChildBookingItems objects
     */
    public function getBookingItemssJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingItemsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingItemss($query, $con);
    }

    /**
     * Clears out the collFormEntriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFormEntriess()
     */
    public function clearFormEntriess()
    {
        $this->collFormEntriess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFormEntriess collection loaded partially.
     */
    public function resetPartialFormEntriess($v = true)
    {
        $this->collFormEntriessPartial = $v;
    }

    /**
     * Initializes the collFormEntriess collection.
     *
     * By default this just sets the collFormEntriess collection to an empty array (like clearcollFormEntriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFormEntriess($overrideExisting = true)
    {
        if (null !== $this->collFormEntriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = FormEntriesTableMap::getTableMap()->getCollectionClassName();

        $this->collFormEntriess = new $collectionClassName;
        $this->collFormEntriess->setModel('\TheFarm\Models\FormEntries');
    }

    /**
     * Gets an array of ChildFormEntries objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookings is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFormEntries[] List of ChildFormEntries objects
     * @throws PropelException
     */
    public function getFormEntriess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriessPartial && !$this->isNew();
        if (null === $this->collFormEntriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFormEntriess) {
                // return empty collection
                $this->initFormEntriess();
            } else {
                $collFormEntriess = ChildFormEntriesQuery::create(null, $criteria)
                    ->filterByBookings($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFormEntriessPartial && count($collFormEntriess)) {
                        $this->initFormEntriess(false);

                        foreach ($collFormEntriess as $obj) {
                            if (false == $this->collFormEntriess->contains($obj)) {
                                $this->collFormEntriess->append($obj);
                            }
                        }

                        $this->collFormEntriessPartial = true;
                    }

                    return $collFormEntriess;
                }

                if ($partial && $this->collFormEntriess) {
                    foreach ($this->collFormEntriess as $obj) {
                        if ($obj->isNew()) {
                            $collFormEntriess[] = $obj;
                        }
                    }
                }

                $this->collFormEntriess = $collFormEntriess;
                $this->collFormEntriessPartial = false;
            }
        }

        return $this->collFormEntriess;
    }

    /**
     * Sets a collection of ChildFormEntries objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $formEntriess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function setFormEntriess(Collection $formEntriess, ConnectionInterface $con = null)
    {
        /** @var ChildFormEntries[] $formEntriessToDelete */
        $formEntriessToDelete = $this->getFormEntriess(new Criteria(), $con)->diff($formEntriess);


        $this->formEntriessScheduledForDeletion = $formEntriessToDelete;

        foreach ($formEntriessToDelete as $formEntriesRemoved) {
            $formEntriesRemoved->setBookings(null);
        }

        $this->collFormEntriess = null;
        foreach ($formEntriess as $formEntries) {
            $this->addFormEntries($formEntries);
        }

        $this->collFormEntriess = $formEntriess;
        $this->collFormEntriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FormEntries objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FormEntries objects.
     * @throws PropelException
     */
    public function countFormEntriess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriessPartial && !$this->isNew();
        if (null === $this->collFormEntriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFormEntriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFormEntriess());
            }

            $query = ChildFormEntriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookings($this)
                ->count($con);
        }

        return count($this->collFormEntriess);
    }

    /**
     * Method called to associate a ChildFormEntries object to this object
     * through the ChildFormEntries foreign key attribute.
     *
     * @param  ChildFormEntries $l ChildFormEntries
     * @return $this|\TheFarm\Models\Bookings The current object (for fluent API support)
     */
    public function addFormEntries(ChildFormEntries $l)
    {
        if ($this->collFormEntriess === null) {
            $this->initFormEntriess();
            $this->collFormEntriessPartial = true;
        }

        if (!$this->collFormEntriess->contains($l)) {
            $this->doAddFormEntries($l);

            if ($this->formEntriessScheduledForDeletion and $this->formEntriessScheduledForDeletion->contains($l)) {
                $this->formEntriessScheduledForDeletion->remove($this->formEntriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFormEntries $formEntries The ChildFormEntries object to add.
     */
    protected function doAddFormEntries(ChildFormEntries $formEntries)
    {
        $this->collFormEntriess[]= $formEntries;
        $formEntries->setBookings($this);
    }

    /**
     * @param  ChildFormEntries $formEntries The ChildFormEntries object to remove.
     * @return $this|ChildBookings The current object (for fluent API support)
     */
    public function removeFormEntries(ChildFormEntries $formEntries)
    {
        if ($this->getFormEntriess()->contains($formEntries)) {
            $pos = $this->collFormEntriess->search($formEntries);
            $this->collFormEntriess->remove($pos);
            if (null === $this->formEntriessScheduledForDeletion) {
                $this->formEntriessScheduledForDeletion = clone $this->collFormEntriess;
                $this->formEntriessScheduledForDeletion->clear();
            }
            $this->formEntriessScheduledForDeletion[]= $formEntries;
            $formEntries->setBookings(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bookings is new, it will return
     * an empty collection; or if this Bookings has previously
     * been saved, it will retrieve related FormEntriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bookings.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntries[] List of ChildFormEntries objects
     */
    public function getFormEntriessJoinFields(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntriesQuery::create(null, $criteria);
        $query->joinWith('Fields', $joinBehavior);

        return $this->getFormEntriess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bookings is new, it will return
     * an empty collection; or if this Bookings has previously
     * been saved, it will retrieve related FormEntriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bookings.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntries[] List of ChildFormEntries objects
     */
    public function getFormEntriessJoinForms(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntriesQuery::create(null, $criteria);
        $query->joinWith('Forms', $joinBehavior);

        return $this->getFormEntriess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aContactsRelatedByAuthorId) {
            $this->aContactsRelatedByAuthorId->removeBookingsRelatedByAuthorId($this);
        }
        if (null !== $this->aContactsRelatedByGuestId) {
            $this->aContactsRelatedByGuestId->removeBookingsRelatedByGuestId($this);
        }
        if (null !== $this->aPackages) {
            $this->aPackages->removeBookings($this);
        }
        if (null !== $this->aItems) {
            $this->aItems->removeBookings($this);
        }
        if (null !== $this->aEventStatus) {
            $this->aEventStatus->removeBookings($this);
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
            if ($this->collBookingAttachmentss) {
                foreach ($this->collBookingAttachmentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingItemss) {
                foreach ($this->collBookingItemss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFormEntriess) {
                foreach ($this->collFormEntriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingAttachmentss = null;
        $this->collBookingItemss = null;
        $this->collFormEntriess = null;
        $this->aContactsRelatedByAuthorId = null;
        $this->aContactsRelatedByGuestId = null;
        $this->aPackages = null;
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
        return (string) $this->exportTo(BookingsTableMap::DEFAULT_STRING_FORMAT);
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
