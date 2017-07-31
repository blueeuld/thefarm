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
use TheFarm\Models\Booking as ChildBooking;
use TheFarm\Models\BookingEvent as ChildBookingEvent;
use TheFarm\Models\BookingEventQuery as ChildBookingEventQuery;
use TheFarm\Models\BookingEventUser as ChildBookingEventUser;
use TheFarm\Models\BookingEventUserQuery as ChildBookingEventUserQuery;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\ItemsRelatedUser as ChildItemsRelatedUser;
use TheFarm\Models\ItemsRelatedUserQuery as ChildItemsRelatedUserQuery;
use TheFarm\Models\Position as ChildPosition;
use TheFarm\Models\PositionQuery as ChildPositionQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\BookingEventTableMap;
use TheFarm\Models\Map\BookingEventUserTableMap;
use TheFarm\Models\Map\BookingTableMap;
use TheFarm\Models\Map\ContactTableMap;
use TheFarm\Models\Map\ItemsRelatedUserTableMap;

/**
 * Base class that represents a row from the 'tf_contacts' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Contact implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\ContactTableMap';


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
     * @var        int
     */
    protected $contact_id;

    /**
     * The value for the first_name field.
     *
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     *
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the middle_name field.
     *
     * @var        string
     */
    protected $middle_name;

    /**
     * The value for the email field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $email;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the date_joined field.
     *
     * @var        DateTime
     */
    protected $date_joined;

    /**
     * The value for the avatar field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $avatar;

    /**
     * The value for the civil_status field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $civil_status;

    /**
     * The value for the nationality field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $nationality;

    /**
     * The value for the country_dominicile field.
     *
     * Note: this column has a database default value of: 'PH'
     * @var        string
     */
    protected $country_dominicile;

    /**
     * The value for the etnic_origin field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $etnic_origin;

    /**
     * The value for the dob field.
     *
     * @var        DateTime
     */
    protected $dob;

    /**
     * The value for the place_of_birth field.
     *
     * @var        string
     */
    protected $place_of_birth;

    /**
     * The value for the age field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $age;

    /**
     * The value for the gender field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $gender;

    /**
     * The value for the height field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $height;

    /**
     * The value for the weight field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $weight;

    /**
     * The value for the phone field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $phone;

    /**
     * The value for the position_cd field.
     *
     * @var        string
     */
    protected $position_cd;

    /**
     * The value for the is_active field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $is_active;

    /**
     * The value for the verification_key field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $verification_key;

    /**
     * The value for the verified field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $verified;

    /**
     * The value for the nickname field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $nickname;

    /**
     * The value for the bio field.
     *
     * @var        string
     */
    protected $bio;

    /**
     * The value for the approved field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $approved;

    /**
     * The value for the activation_code field.
     *
     * @var        int
     */
    protected $activation_code;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: 'n'
     * @var        string
     */
    protected $active;

    /**
     * @var        ChildPosition
     */
    protected $aPosition;

    /**
     * @var        ObjectCollection|ChildBookingEventUser[] Collection to store aggregation of ChildBookingEventUser objects.
     */
    protected $collBookingEventUsers;
    protected $collBookingEventUsersPartial;

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
    protected $collBookingsRelatedByAuthorId;
    protected $collBookingsRelatedByAuthorIdPartial;

    /**
     * @var        ObjectCollection|ChildBooking[] Collection to store aggregation of ChildBooking objects.
     */
    protected $collBookingsRelatedByGuestId;
    protected $collBookingsRelatedByGuestIdPartial;

    /**
     * @var        ObjectCollection|ChildItemsRelatedUser[] Collection to store aggregation of ChildItemsRelatedUser objects.
     */
    protected $collItemsRelatedUsers;
    protected $collItemsRelatedUsersPartial;

    /**
     * @var        ChildUser one-to-one related ChildUser object
     */
    protected $singleUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEventUser[]
     */
    protected $bookingEventUsersScheduledForDeletion = null;

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
    protected $bookingsRelatedByAuthorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooking[]
     */
    protected $bookingsRelatedByGuestIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemsRelatedUser[]
     */
    protected $itemsRelatedUsersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->email = '';
        $this->avatar = '';
        $this->civil_status = '';
        $this->nationality = '';
        $this->country_dominicile = 'PH';
        $this->etnic_origin = '';
        $this->age = 0;
        $this->gender = '';
        $this->height = '';
        $this->weight = '';
        $this->phone = '';
        $this->is_active = 0;
        $this->verification_key = '';
        $this->verified = 'n';
        $this->nickname = '';
        $this->approved = 'y';
        $this->active = 'n';
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Contact object.
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
     * Compares this with another <code>Contact</code> instance.  If
     * <code>obj</code> is an instance of <code>Contact</code>, delegates to
     * <code>equals(Contact)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Contact The current object, for fluid interface
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
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [middle_name] column value.
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get the [optionally formatted] temporal [date_joined] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateJoined($format = NULL)
    {
        if ($format === null) {
            return $this->date_joined;
        } else {
            return $this->date_joined instanceof \DateTimeInterface ? $this->date_joined->format($format) : null;
        }
    }

    /**
     * Get the [avatar] column value.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the [civil_status] column value.
     *
     * @return string
     */
    public function getCivilStatus()
    {
        return $this->civil_status;
    }

    /**
     * Get the [nationality] column value.
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Get the [country_dominicile] column value.
     *
     * @return string
     */
    public function getCountryDominicile()
    {
        return $this->country_dominicile;
    }

    /**
     * Get the [etnic_origin] column value.
     *
     * @return string
     */
    public function getEtnicOrigin()
    {
        return $this->etnic_origin;
    }

    /**
     * Get the [optionally formatted] temporal [dob] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDob($format = NULL)
    {
        if ($format === null) {
            return $this->dob;
        } else {
            return $this->dob instanceof \DateTimeInterface ? $this->dob->format($format) : null;
        }
    }

    /**
     * Get the [place_of_birth] column value.
     *
     * @return string
     */
    public function getPlaceOfBirth()
    {
        return $this->place_of_birth;
    }

    /**
     * Get the [age] column value.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [height] column value.
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the [weight] column value.
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [position_cd] column value.
     *
     * @return string
     */
    public function getPositionCd()
    {
        return $this->position_cd;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [verification_key] column value.
     *
     * @return string
     */
    public function getVerificationKey()
    {
        return $this->verification_key;
    }

    /**
     * Get the [verified] column value.
     *
     * @return string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the [nickname] column value.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Get the [bio] column value.
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Get the [approved] column value.
     *
     * @return string
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Get the [activation_code] column value.
     *
     * @return int
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }

    /**
     * Get the [active] column value.
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of [contact_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setContactId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->contact_id !== $v) {
            $this->contact_id = $v;
            $this->modifiedColumns[ContactTableMap::COL_CONTACT_ID] = true;
        }

        return $this;
    } // setContactId()

    /**
     * Set the value of [first_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[ContactTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    } // setFirstName()

    /**
     * Set the value of [last_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[ContactTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    } // setLastName()

    /**
     * Set the value of [middle_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setMiddleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->middle_name !== $v) {
            $this->middle_name = $v;
            $this->modifiedColumns[ContactTableMap::COL_MIDDLE_NAME] = true;
        }

        return $this;
    } // setMiddleName()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[ContactTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[ContactTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Sets the value of [date_joined] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setDateJoined($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_joined !== null || $dt !== null) {
            if ($this->date_joined === null || $dt === null || $dt->format("Y-m-d") !== $this->date_joined->format("Y-m-d")) {
                $this->date_joined = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ContactTableMap::COL_DATE_JOINED] = true;
            }
        } // if either are not null

        return $this;
    } // setDateJoined()

    /**
     * Set the value of [avatar] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->avatar !== $v) {
            $this->avatar = $v;
            $this->modifiedColumns[ContactTableMap::COL_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [civil_status] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setCivilStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->civil_status !== $v) {
            $this->civil_status = $v;
            $this->modifiedColumns[ContactTableMap::COL_CIVIL_STATUS] = true;
        }

        return $this;
    } // setCivilStatus()

    /**
     * Set the value of [nationality] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setNationality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nationality !== $v) {
            $this->nationality = $v;
            $this->modifiedColumns[ContactTableMap::COL_NATIONALITY] = true;
        }

        return $this;
    } // setNationality()

    /**
     * Set the value of [country_dominicile] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setCountryDominicile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country_dominicile !== $v) {
            $this->country_dominicile = $v;
            $this->modifiedColumns[ContactTableMap::COL_COUNTRY_DOMINICILE] = true;
        }

        return $this;
    } // setCountryDominicile()

    /**
     * Set the value of [etnic_origin] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setEtnicOrigin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->etnic_origin !== $v) {
            $this->etnic_origin = $v;
            $this->modifiedColumns[ContactTableMap::COL_ETNIC_ORIGIN] = true;
        }

        return $this;
    } // setEtnicOrigin()

    /**
     * Sets the value of [dob] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setDob($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dob !== null || $dt !== null) {
            if ($this->dob === null || $dt === null || $dt->format("Y-m-d") !== $this->dob->format("Y-m-d")) {
                $this->dob = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ContactTableMap::COL_DOB] = true;
            }
        } // if either are not null

        return $this;
    } // setDob()

    /**
     * Set the value of [place_of_birth] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setPlaceOfBirth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->place_of_birth !== $v) {
            $this->place_of_birth = $v;
            $this->modifiedColumns[ContactTableMap::COL_PLACE_OF_BIRTH] = true;
        }

        return $this;
    } // setPlaceOfBirth()

    /**
     * Set the value of [age] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setAge($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->age !== $v) {
            $this->age = $v;
            $this->modifiedColumns[ContactTableMap::COL_AGE] = true;
        }

        return $this;
    } // setAge()

    /**
     * Set the value of [gender] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[ContactTableMap::COL_GENDER] = true;
        }

        return $this;
    } // setGender()

    /**
     * Set the value of [height] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[ContactTableMap::COL_HEIGHT] = true;
        }

        return $this;
    } // setHeight()

    /**
     * Set the value of [weight] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setWeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->weight !== $v) {
            $this->weight = $v;
            $this->modifiedColumns[ContactTableMap::COL_WEIGHT] = true;
        }

        return $this;
    } // setWeight()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[ContactTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [position_cd] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setPositionCd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_cd !== $v) {
            $this->position_cd = $v;
            $this->modifiedColumns[ContactTableMap::COL_POSITION_CD] = true;
        }

        if ($this->aPosition !== null && $this->aPosition->getPositionCd() !== $v) {
            $this->aPosition = null;
        }

        return $this;
    } // setPositionCd()

    /**
     * Set the value of [is_active] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[ContactTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    } // setIsActive()

    /**
     * Set the value of [verification_key] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setVerificationKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->verification_key !== $v) {
            $this->verification_key = $v;
            $this->modifiedColumns[ContactTableMap::COL_VERIFICATION_KEY] = true;
        }

        return $this;
    } // setVerificationKey()

    /**
     * Set the value of [verified] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setVerified($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->verified !== $v) {
            $this->verified = $v;
            $this->modifiedColumns[ContactTableMap::COL_VERIFIED] = true;
        }

        return $this;
    } // setVerified()

    /**
     * Set the value of [nickname] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setNickname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nickname !== $v) {
            $this->nickname = $v;
            $this->modifiedColumns[ContactTableMap::COL_NICKNAME] = true;
        }

        return $this;
    } // setNickname()

    /**
     * Set the value of [bio] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setBio($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bio !== $v) {
            $this->bio = $v;
            $this->modifiedColumns[ContactTableMap::COL_BIO] = true;
        }

        return $this;
    } // setBio()

    /**
     * Set the value of [approved] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setApproved($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->approved !== $v) {
            $this->approved = $v;
            $this->modifiedColumns[ContactTableMap::COL_APPROVED] = true;
        }

        return $this;
    } // setApproved()

    /**
     * Set the value of [activation_code] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setActivationCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->activation_code !== $v) {
            $this->activation_code = $v;
            $this->modifiedColumns[ContactTableMap::COL_ACTIVATION_CODE] = true;
        }

        return $this;
    } // setActivationCode()

    /**
     * Set the value of [active] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[ContactTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

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
            if ($this->email !== '') {
                return false;
            }

            if ($this->avatar !== '') {
                return false;
            }

            if ($this->civil_status !== '') {
                return false;
            }

            if ($this->nationality !== '') {
                return false;
            }

            if ($this->country_dominicile !== 'PH') {
                return false;
            }

            if ($this->etnic_origin !== '') {
                return false;
            }

            if ($this->age !== 0) {
                return false;
            }

            if ($this->gender !== '') {
                return false;
            }

            if ($this->height !== '') {
                return false;
            }

            if ($this->weight !== '') {
                return false;
            }

            if ($this->phone !== '') {
                return false;
            }

            if ($this->is_active !== 0) {
                return false;
            }

            if ($this->verification_key !== '') {
                return false;
            }

            if ($this->verified !== 'n') {
                return false;
            }

            if ($this->nickname !== '') {
                return false;
            }

            if ($this->approved !== 'y') {
                return false;
            }

            if ($this->active !== 'n') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ContactTableMap::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ContactTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ContactTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ContactTableMap::translateFieldName('MiddleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->middle_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ContactTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ContactTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ContactTableMap::translateFieldName('DateJoined', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_joined = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ContactTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ContactTableMap::translateFieldName('CivilStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->civil_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ContactTableMap::translateFieldName('Nationality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nationality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ContactTableMap::translateFieldName('CountryDominicile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_dominicile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ContactTableMap::translateFieldName('EtnicOrigin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->etnic_origin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ContactTableMap::translateFieldName('Dob', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->dob = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ContactTableMap::translateFieldName('PlaceOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place_of_birth = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ContactTableMap::translateFieldName('Age', TableMap::TYPE_PHPNAME, $indexType)];
            $this->age = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ContactTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ContactTableMap::translateFieldName('Height', TableMap::TYPE_PHPNAME, $indexType)];
            $this->height = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ContactTableMap::translateFieldName('Weight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weight = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ContactTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ContactTableMap::translateFieldName('PositionCd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_cd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ContactTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ContactTableMap::translateFieldName('VerificationKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verification_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ContactTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ContactTableMap::translateFieldName('Nickname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nickname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ContactTableMap::translateFieldName('Bio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bio = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ContactTableMap::translateFieldName('Approved', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ContactTableMap::translateFieldName('ActivationCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activation_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ContactTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 28; // 28 = ContactTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Contact'), 0, $e);
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
        if ($this->aPosition !== null && $this->position_cd !== $this->aPosition->getPositionCd()) {
            $this->aPosition = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ContactTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildContactQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPosition = null;
            $this->collBookingEventUsers = null;

            $this->collBookingEventsRelatedByAuthorId = null;

            $this->collBookingEventsRelatedByCalledBy = null;

            $this->collBookingEventsRelatedByCancelledBy = null;

            $this->collBookingEventsRelatedByDeletedBy = null;

            $this->collBookingsRelatedByAuthorId = null;

            $this->collBookingsRelatedByGuestId = null;

            $this->collItemsRelatedUsers = null;

            $this->singleUser = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Contact::setDeleted()
     * @see Contact::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildContactQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
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
                ContactTableMap::addInstanceToPool($this);
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

            if ($this->aPosition !== null) {
                if ($this->aPosition->isModified() || $this->aPosition->isNew()) {
                    $affectedRows += $this->aPosition->save($con);
                }
                $this->setPosition($this->aPosition);
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

            if ($this->bookingEventUsersScheduledForDeletion !== null) {
                if (!$this->bookingEventUsersScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingEventUserQuery::create()
                        ->filterByPrimaryKeys($this->bookingEventUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingEventUsersScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventUsers !== null) {
                foreach ($this->collBookingEventUsers as $referrerFK) {
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

            if ($this->bookingsRelatedByAuthorIdScheduledForDeletion !== null) {
                if (!$this->bookingsRelatedByAuthorIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingsRelatedByAuthorIdScheduledForDeletion as $bookingRelatedByAuthorId) {
                        // need to save related object because we set the relation to null
                        $bookingRelatedByAuthorId->save($con);
                    }
                    $this->bookingsRelatedByAuthorIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingsRelatedByAuthorId !== null) {
                foreach ($this->collBookingsRelatedByAuthorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingsRelatedByGuestIdScheduledForDeletion !== null) {
                if (!$this->bookingsRelatedByGuestIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingsRelatedByGuestIdScheduledForDeletion as $bookingRelatedByGuestId) {
                        // need to save related object because we set the relation to null
                        $bookingRelatedByGuestId->save($con);
                    }
                    $this->bookingsRelatedByGuestIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingsRelatedByGuestId !== null) {
                foreach ($this->collBookingsRelatedByGuestId as $referrerFK) {
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

            if ($this->singleUser !== null) {
                if (!$this->singleUser->isDeleted() && ($this->singleUser->isNew() || $this->singleUser->isModified())) {
                    $affectedRows += $this->singleUser->save($con);
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

        $this->modifiedColumns[ContactTableMap::COL_CONTACT_ID] = true;
        if (null !== $this->contact_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ContactTableMap::COL_CONTACT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ContactTableMap::COL_CONTACT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'contact_id';
        }
        if ($this->isColumnModified(ContactTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(ContactTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(ContactTableMap::COL_MIDDLE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'middle_name';
        }
        if ($this->isColumnModified(ContactTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(ContactTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(ContactTableMap::COL_DATE_JOINED)) {
            $modifiedColumns[':p' . $index++]  = 'date_joined';
        }
        if ($this->isColumnModified(ContactTableMap::COL_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'avatar';
        }
        if ($this->isColumnModified(ContactTableMap::COL_CIVIL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'civil_status';
        }
        if ($this->isColumnModified(ContactTableMap::COL_NATIONALITY)) {
            $modifiedColumns[':p' . $index++]  = 'nationality';
        }
        if ($this->isColumnModified(ContactTableMap::COL_COUNTRY_DOMINICILE)) {
            $modifiedColumns[':p' . $index++]  = 'country_dominicile';
        }
        if ($this->isColumnModified(ContactTableMap::COL_ETNIC_ORIGIN)) {
            $modifiedColumns[':p' . $index++]  = 'etnic_origin';
        }
        if ($this->isColumnModified(ContactTableMap::COL_DOB)) {
            $modifiedColumns[':p' . $index++]  = 'dob';
        }
        if ($this->isColumnModified(ContactTableMap::COL_PLACE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'place_of_birth';
        }
        if ($this->isColumnModified(ContactTableMap::COL_AGE)) {
            $modifiedColumns[':p' . $index++]  = 'age';
        }
        if ($this->isColumnModified(ContactTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(ContactTableMap::COL_HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'height';
        }
        if ($this->isColumnModified(ContactTableMap::COL_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'weight';
        }
        if ($this->isColumnModified(ContactTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(ContactTableMap::COL_POSITION_CD)) {
            $modifiedColumns[':p' . $index++]  = 'position_cd';
        }
        if ($this->isColumnModified(ContactTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(ContactTableMap::COL_VERIFICATION_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'verification_key';
        }
        if ($this->isColumnModified(ContactTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'verified';
        }
        if ($this->isColumnModified(ContactTableMap::COL_NICKNAME)) {
            $modifiedColumns[':p' . $index++]  = 'nickname';
        }
        if ($this->isColumnModified(ContactTableMap::COL_BIO)) {
            $modifiedColumns[':p' . $index++]  = 'bio';
        }
        if ($this->isColumnModified(ContactTableMap::COL_APPROVED)) {
            $modifiedColumns[':p' . $index++]  = 'approved';
        }
        if ($this->isColumnModified(ContactTableMap::COL_ACTIVATION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'activation_code';
        }
        if ($this->isColumnModified(ContactTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }

        $sql = sprintf(
            'INSERT INTO tf_contacts (%s) VALUES (%s)',
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
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case 'middle_name':
                        $stmt->bindValue($identifier, $this->middle_name, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'date_joined':
                        $stmt->bindValue($identifier, $this->date_joined ? $this->date_joined->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'avatar':
                        $stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
                        break;
                    case 'civil_status':
                        $stmt->bindValue($identifier, $this->civil_status, PDO::PARAM_STR);
                        break;
                    case 'nationality':
                        $stmt->bindValue($identifier, $this->nationality, PDO::PARAM_STR);
                        break;
                    case 'country_dominicile':
                        $stmt->bindValue($identifier, $this->country_dominicile, PDO::PARAM_STR);
                        break;
                    case 'etnic_origin':
                        $stmt->bindValue($identifier, $this->etnic_origin, PDO::PARAM_STR);
                        break;
                    case 'dob':
                        $stmt->bindValue($identifier, $this->dob ? $this->dob->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'place_of_birth':
                        $stmt->bindValue($identifier, $this->place_of_birth, PDO::PARAM_STR);
                        break;
                    case 'age':
                        $stmt->bindValue($identifier, $this->age, PDO::PARAM_INT);
                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);
                        break;
                    case 'height':
                        $stmt->bindValue($identifier, $this->height, PDO::PARAM_STR);
                        break;
                    case 'weight':
                        $stmt->bindValue($identifier, $this->weight, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'position_cd':
                        $stmt->bindValue($identifier, $this->position_cd, PDO::PARAM_STR);
                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, $this->is_active, PDO::PARAM_INT);
                        break;
                    case 'verification_key':
                        $stmt->bindValue($identifier, $this->verification_key, PDO::PARAM_STR);
                        break;
                    case 'verified':
                        $stmt->bindValue($identifier, $this->verified, PDO::PARAM_STR);
                        break;
                    case 'nickname':
                        $stmt->bindValue($identifier, $this->nickname, PDO::PARAM_STR);
                        break;
                    case 'bio':
                        $stmt->bindValue($identifier, $this->bio, PDO::PARAM_STR);
                        break;
                    case 'approved':
                        $stmt->bindValue($identifier, $this->approved, PDO::PARAM_STR);
                        break;
                    case 'activation_code':
                        $stmt->bindValue($identifier, $this->activation_code, PDO::PARAM_INT);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, $this->active, PDO::PARAM_STR);
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
        $this->setContactId($pk);

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
        $pos = ContactTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFirstName();
                break;
            case 2:
                return $this->getLastName();
                break;
            case 3:
                return $this->getMiddleName();
                break;
            case 4:
                return $this->getEmail();
                break;
            case 5:
                return $this->getTitle();
                break;
            case 6:
                return $this->getDateJoined();
                break;
            case 7:
                return $this->getAvatar();
                break;
            case 8:
                return $this->getCivilStatus();
                break;
            case 9:
                return $this->getNationality();
                break;
            case 10:
                return $this->getCountryDominicile();
                break;
            case 11:
                return $this->getEtnicOrigin();
                break;
            case 12:
                return $this->getDob();
                break;
            case 13:
                return $this->getPlaceOfBirth();
                break;
            case 14:
                return $this->getAge();
                break;
            case 15:
                return $this->getGender();
                break;
            case 16:
                return $this->getHeight();
                break;
            case 17:
                return $this->getWeight();
                break;
            case 18:
                return $this->getPhone();
                break;
            case 19:
                return $this->getPositionCd();
                break;
            case 20:
                return $this->getIsActive();
                break;
            case 21:
                return $this->getVerificationKey();
                break;
            case 22:
                return $this->getVerified();
                break;
            case 23:
                return $this->getNickname();
                break;
            case 24:
                return $this->getBio();
                break;
            case 25:
                return $this->getApproved();
                break;
            case 26:
                return $this->getActivationCode();
                break;
            case 27:
                return $this->getActive();
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

        if (isset($alreadyDumpedObjects['Contact'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Contact'][$this->hashCode()] = true;
        $keys = ContactTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getContactId(),
            $keys[1] => $this->getFirstName(),
            $keys[2] => $this->getLastName(),
            $keys[3] => $this->getMiddleName(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getTitle(),
            $keys[6] => $this->getDateJoined(),
            $keys[7] => $this->getAvatar(),
            $keys[8] => $this->getCivilStatus(),
            $keys[9] => $this->getNationality(),
            $keys[10] => $this->getCountryDominicile(),
            $keys[11] => $this->getEtnicOrigin(),
            $keys[12] => $this->getDob(),
            $keys[13] => $this->getPlaceOfBirth(),
            $keys[14] => $this->getAge(),
            $keys[15] => $this->getGender(),
            $keys[16] => $this->getHeight(),
            $keys[17] => $this->getWeight(),
            $keys[18] => $this->getPhone(),
            $keys[19] => $this->getPositionCd(),
            $keys[20] => $this->getIsActive(),
            $keys[21] => $this->getVerificationKey(),
            $keys[22] => $this->getVerified(),
            $keys[23] => $this->getNickname(),
            $keys[24] => $this->getBio(),
            $keys[25] => $this->getApproved(),
            $keys[26] => $this->getActivationCode(),
            $keys[27] => $this->getActive(),
        );
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'position';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_position';
                        break;
                    default:
                        $key = 'Position';
                }

                $result[$key] = $this->aPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBookingEventUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_event_userss';
                        break;
                    default:
                        $key = 'BookingEventUsers';
                }

                $result[$key] = $this->collBookingEventUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collBookingsRelatedByAuthorId) {

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

                $result[$key] = $this->collBookingsRelatedByAuthorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingsRelatedByGuestId) {

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

                $result[$key] = $this->collBookingsRelatedByGuestId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->singleUser) {

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

                $result[$key] = $this->singleUser->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
     * @return $this|\TheFarm\Models\Contact
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ContactTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Contact
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setContactId($value);
                break;
            case 1:
                $this->setFirstName($value);
                break;
            case 2:
                $this->setLastName($value);
                break;
            case 3:
                $this->setMiddleName($value);
                break;
            case 4:
                $this->setEmail($value);
                break;
            case 5:
                $this->setTitle($value);
                break;
            case 6:
                $this->setDateJoined($value);
                break;
            case 7:
                $this->setAvatar($value);
                break;
            case 8:
                $this->setCivilStatus($value);
                break;
            case 9:
                $this->setNationality($value);
                break;
            case 10:
                $this->setCountryDominicile($value);
                break;
            case 11:
                $this->setEtnicOrigin($value);
                break;
            case 12:
                $this->setDob($value);
                break;
            case 13:
                $this->setPlaceOfBirth($value);
                break;
            case 14:
                $this->setAge($value);
                break;
            case 15:
                $this->setGender($value);
                break;
            case 16:
                $this->setHeight($value);
                break;
            case 17:
                $this->setWeight($value);
                break;
            case 18:
                $this->setPhone($value);
                break;
            case 19:
                $this->setPositionCd($value);
                break;
            case 20:
                $this->setIsActive($value);
                break;
            case 21:
                $this->setVerificationKey($value);
                break;
            case 22:
                $this->setVerified($value);
                break;
            case 23:
                $this->setNickname($value);
                break;
            case 24:
                $this->setBio($value);
                break;
            case 25:
                $this->setApproved($value);
                break;
            case 26:
                $this->setActivationCode($value);
                break;
            case 27:
                $this->setActive($value);
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
        $keys = ContactTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setContactId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFirstName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLastName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMiddleName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEmail($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTitle($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDateJoined($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAvatar($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCivilStatus($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setNationality($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCountryDominicile($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setEtnicOrigin($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDob($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPlaceOfBirth($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAge($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setGender($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setHeight($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setWeight($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setPhone($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setPositionCd($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setIsActive($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setVerificationKey($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setVerified($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setNickname($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setBio($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setApproved($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setActivationCode($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setActive($arr[$keys[27]]);
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
     * @return $this|\TheFarm\Models\Contact The current object, for fluid interface
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
        $criteria = new Criteria(ContactTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ContactTableMap::COL_CONTACT_ID)) {
            $criteria->add(ContactTableMap::COL_CONTACT_ID, $this->contact_id);
        }
        if ($this->isColumnModified(ContactTableMap::COL_FIRST_NAME)) {
            $criteria->add(ContactTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(ContactTableMap::COL_LAST_NAME)) {
            $criteria->add(ContactTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(ContactTableMap::COL_MIDDLE_NAME)) {
            $criteria->add(ContactTableMap::COL_MIDDLE_NAME, $this->middle_name);
        }
        if ($this->isColumnModified(ContactTableMap::COL_EMAIL)) {
            $criteria->add(ContactTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(ContactTableMap::COL_TITLE)) {
            $criteria->add(ContactTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(ContactTableMap::COL_DATE_JOINED)) {
            $criteria->add(ContactTableMap::COL_DATE_JOINED, $this->date_joined);
        }
        if ($this->isColumnModified(ContactTableMap::COL_AVATAR)) {
            $criteria->add(ContactTableMap::COL_AVATAR, $this->avatar);
        }
        if ($this->isColumnModified(ContactTableMap::COL_CIVIL_STATUS)) {
            $criteria->add(ContactTableMap::COL_CIVIL_STATUS, $this->civil_status);
        }
        if ($this->isColumnModified(ContactTableMap::COL_NATIONALITY)) {
            $criteria->add(ContactTableMap::COL_NATIONALITY, $this->nationality);
        }
        if ($this->isColumnModified(ContactTableMap::COL_COUNTRY_DOMINICILE)) {
            $criteria->add(ContactTableMap::COL_COUNTRY_DOMINICILE, $this->country_dominicile);
        }
        if ($this->isColumnModified(ContactTableMap::COL_ETNIC_ORIGIN)) {
            $criteria->add(ContactTableMap::COL_ETNIC_ORIGIN, $this->etnic_origin);
        }
        if ($this->isColumnModified(ContactTableMap::COL_DOB)) {
            $criteria->add(ContactTableMap::COL_DOB, $this->dob);
        }
        if ($this->isColumnModified(ContactTableMap::COL_PLACE_OF_BIRTH)) {
            $criteria->add(ContactTableMap::COL_PLACE_OF_BIRTH, $this->place_of_birth);
        }
        if ($this->isColumnModified(ContactTableMap::COL_AGE)) {
            $criteria->add(ContactTableMap::COL_AGE, $this->age);
        }
        if ($this->isColumnModified(ContactTableMap::COL_GENDER)) {
            $criteria->add(ContactTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(ContactTableMap::COL_HEIGHT)) {
            $criteria->add(ContactTableMap::COL_HEIGHT, $this->height);
        }
        if ($this->isColumnModified(ContactTableMap::COL_WEIGHT)) {
            $criteria->add(ContactTableMap::COL_WEIGHT, $this->weight);
        }
        if ($this->isColumnModified(ContactTableMap::COL_PHONE)) {
            $criteria->add(ContactTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(ContactTableMap::COL_POSITION_CD)) {
            $criteria->add(ContactTableMap::COL_POSITION_CD, $this->position_cd);
        }
        if ($this->isColumnModified(ContactTableMap::COL_IS_ACTIVE)) {
            $criteria->add(ContactTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(ContactTableMap::COL_VERIFICATION_KEY)) {
            $criteria->add(ContactTableMap::COL_VERIFICATION_KEY, $this->verification_key);
        }
        if ($this->isColumnModified(ContactTableMap::COL_VERIFIED)) {
            $criteria->add(ContactTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(ContactTableMap::COL_NICKNAME)) {
            $criteria->add(ContactTableMap::COL_NICKNAME, $this->nickname);
        }
        if ($this->isColumnModified(ContactTableMap::COL_BIO)) {
            $criteria->add(ContactTableMap::COL_BIO, $this->bio);
        }
        if ($this->isColumnModified(ContactTableMap::COL_APPROVED)) {
            $criteria->add(ContactTableMap::COL_APPROVED, $this->approved);
        }
        if ($this->isColumnModified(ContactTableMap::COL_ACTIVATION_CODE)) {
            $criteria->add(ContactTableMap::COL_ACTIVATION_CODE, $this->activation_code);
        }
        if ($this->isColumnModified(ContactTableMap::COL_ACTIVE)) {
            $criteria->add(ContactTableMap::COL_ACTIVE, $this->active);
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
        $criteria = ChildContactQuery::create();
        $criteria->add(ContactTableMap::COL_CONTACT_ID, $this->contact_id);

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
     * @param      object $copyObj An object of \TheFarm\Models\Contact (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setMiddleName($this->getMiddleName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setDateJoined($this->getDateJoined());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setCivilStatus($this->getCivilStatus());
        $copyObj->setNationality($this->getNationality());
        $copyObj->setCountryDominicile($this->getCountryDominicile());
        $copyObj->setEtnicOrigin($this->getEtnicOrigin());
        $copyObj->setDob($this->getDob());
        $copyObj->setPlaceOfBirth($this->getPlaceOfBirth());
        $copyObj->setAge($this->getAge());
        $copyObj->setGender($this->getGender());
        $copyObj->setHeight($this->getHeight());
        $copyObj->setWeight($this->getWeight());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setPositionCd($this->getPositionCd());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setVerificationKey($this->getVerificationKey());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setNickname($this->getNickname());
        $copyObj->setBio($this->getBio());
        $copyObj->setApproved($this->getApproved());
        $copyObj->setActivationCode($this->getActivationCode());
        $copyObj->setActive($this->getActive());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingEventUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventUser($relObj->copy($deepCopy));
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

            foreach ($this->getBookingsRelatedByAuthorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingRelatedByAuthorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingsRelatedByGuestId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingRelatedByGuestId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemsRelatedUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemsRelatedUser($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getUser();
            if ($relObj) {
                $copyObj->setUser($relObj->copy($deepCopy));
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setContactId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Contact Clone of current object.
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
     * Declares an association between this object and a ChildPosition object.
     *
     * @param  ChildPosition $v
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPosition(ChildPosition $v = null)
    {
        if ($v === null) {
            $this->setPositionCd(NULL);
        } else {
            $this->setPositionCd($v->getPositionCd());
        }

        $this->aPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPosition object, it will not be re-added.
        if ($v !== null) {
            $v->addContact($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPosition object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPosition The associated ChildPosition object.
     * @throws PropelException
     */
    public function getPosition(ConnectionInterface $con = null)
    {
        if ($this->aPosition === null && (($this->position_cd !== "" && $this->position_cd !== null))) {
            $this->aPosition = ChildPositionQuery::create()->findPk($this->position_cd, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPosition->addContacts($this);
             */
        }

        return $this->aPosition;
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
        if ('BookingEventUser' == $relationName) {
            $this->initBookingEventUsers();
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
        if ('BookingRelatedByAuthorId' == $relationName) {
            $this->initBookingsRelatedByAuthorId();
            return;
        }
        if ('BookingRelatedByGuestId' == $relationName) {
            $this->initBookingsRelatedByGuestId();
            return;
        }
        if ('ItemsRelatedUser' == $relationName) {
            $this->initItemsRelatedUsers();
            return;
        }
    }

    /**
     * Clears out the collBookingEventUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventUsers()
     */
    public function clearBookingEventUsers()
    {
        $this->collBookingEventUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventUsers collection loaded partially.
     */
    public function resetPartialBookingEventUsers($v = true)
    {
        $this->collBookingEventUsersPartial = $v;
    }

    /**
     * Initializes the collBookingEventUsers collection.
     *
     * By default this just sets the collBookingEventUsers collection to an empty array (like clearcollBookingEventUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventUsers($overrideExisting = true)
    {
        if (null !== $this->collBookingEventUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventUserTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventUsers = new $collectionClassName;
        $this->collBookingEventUsers->setModel('\TheFarm\Models\BookingEventUser');
    }

    /**
     * Gets an array of ChildBookingEventUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEventUser[] List of ChildBookingEventUser objects
     * @throws PropelException
     */
    public function getBookingEventUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventUsersPartial && !$this->isNew();
        if (null === $this->collBookingEventUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventUsers) {
                // return empty collection
                $this->initBookingEventUsers();
            } else {
                $collBookingEventUsers = ChildBookingEventUserQuery::create(null, $criteria)
                    ->filterByContact($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventUsersPartial && count($collBookingEventUsers)) {
                        $this->initBookingEventUsers(false);

                        foreach ($collBookingEventUsers as $obj) {
                            if (false == $this->collBookingEventUsers->contains($obj)) {
                                $this->collBookingEventUsers->append($obj);
                            }
                        }

                        $this->collBookingEventUsersPartial = true;
                    }

                    return $collBookingEventUsers;
                }

                if ($partial && $this->collBookingEventUsers) {
                    foreach ($this->collBookingEventUsers as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventUsers[] = $obj;
                        }
                    }
                }

                $this->collBookingEventUsers = $collBookingEventUsers;
                $this->collBookingEventUsersPartial = false;
            }
        }

        return $this->collBookingEventUsers;
    }

    /**
     * Sets a collection of ChildBookingEventUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventUsers(Collection $bookingEventUsers, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEventUser[] $bookingEventUsersToDelete */
        $bookingEventUsersToDelete = $this->getBookingEventUsers(new Criteria(), $con)->diff($bookingEventUsers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bookingEventUsersScheduledForDeletion = clone $bookingEventUsersToDelete;

        foreach ($bookingEventUsersToDelete as $bookingEventUserRemoved) {
            $bookingEventUserRemoved->setContact(null);
        }

        $this->collBookingEventUsers = null;
        foreach ($bookingEventUsers as $bookingEventUser) {
            $this->addBookingEventUser($bookingEventUser);
        }

        $this->collBookingEventUsers = $bookingEventUsers;
        $this->collBookingEventUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEventUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEventUser objects.
     * @throws PropelException
     */
    public function countBookingEventUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventUsersPartial && !$this->isNew();
        if (null === $this->collBookingEventUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventUsers());
            }

            $query = ChildBookingEventUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collBookingEventUsers);
    }

    /**
     * Method called to associate a ChildBookingEventUser object to this object
     * through the ChildBookingEventUser foreign key attribute.
     *
     * @param  ChildBookingEventUser $l ChildBookingEventUser
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingEventUser(ChildBookingEventUser $l)
    {
        if ($this->collBookingEventUsers === null) {
            $this->initBookingEventUsers();
            $this->collBookingEventUsersPartial = true;
        }

        if (!$this->collBookingEventUsers->contains($l)) {
            $this->doAddBookingEventUser($l);

            if ($this->bookingEventUsersScheduledForDeletion and $this->bookingEventUsersScheduledForDeletion->contains($l)) {
                $this->bookingEventUsersScheduledForDeletion->remove($this->bookingEventUsersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEventUser $bookingEventUser The ChildBookingEventUser object to add.
     */
    protected function doAddBookingEventUser(ChildBookingEventUser $bookingEventUser)
    {
        $this->collBookingEventUsers[]= $bookingEventUser;
        $bookingEventUser->setContact($this);
    }

    /**
     * @param  ChildBookingEventUser $bookingEventUser The ChildBookingEventUser object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingEventUser(ChildBookingEventUser $bookingEventUser)
    {
        if ($this->getBookingEventUsers()->contains($bookingEventUser)) {
            $pos = $this->collBookingEventUsers->search($bookingEventUser);
            $this->collBookingEventUsers->remove($pos);
            if (null === $this->bookingEventUsersScheduledForDeletion) {
                $this->bookingEventUsersScheduledForDeletion = clone $this->collBookingEventUsers;
                $this->bookingEventUsersScheduledForDeletion->clear();
            }
            $this->bookingEventUsersScheduledForDeletion[]= clone $bookingEventUser;
            $bookingEventUser->setContact(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEventUser[] List of ChildBookingEventUser objects
     */
    public function getBookingEventUsersJoinBookingEvent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventUserQuery::create(null, $criteria);
        $query->joinWith('BookingEvent', $joinBehavior);

        return $this->getBookingEventUsers($query, $con);
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
     * If this ChildContact is new, it will return
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
                    ->filterByContactRelatedByAuthorId($this)
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
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByAuthorId(Collection $bookingEventsRelatedByAuthorId, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByAuthorIdToDelete */
        $bookingEventsRelatedByAuthorIdToDelete = $this->getBookingEventsRelatedByAuthorId(new Criteria(), $con)->diff($bookingEventsRelatedByAuthorId);


        $this->bookingEventsRelatedByAuthorIdScheduledForDeletion = $bookingEventsRelatedByAuthorIdToDelete;

        foreach ($bookingEventsRelatedByAuthorIdToDelete as $bookingEventRelatedByAuthorIdRemoved) {
            $bookingEventRelatedByAuthorIdRemoved->setContactRelatedByAuthorId(null);
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
                ->filterByContactRelatedByAuthorId($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByAuthorId);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
        $bookingEventRelatedByAuthorId->setContactRelatedByAuthorId($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByAuthorId The ChildBookingEvent object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventRelatedByAuthorId->setContactRelatedByAuthorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByAuthorIdJoinBookingItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('BookingItem', $joinBehavior);

        return $this->getBookingEventsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * If this ChildContact is new, it will return
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
                    ->filterByContactRelatedByCalledBy($this)
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
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByCalledBy(Collection $bookingEventsRelatedByCalledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByCalledByToDelete */
        $bookingEventsRelatedByCalledByToDelete = $this->getBookingEventsRelatedByCalledBy(new Criteria(), $con)->diff($bookingEventsRelatedByCalledBy);


        $this->bookingEventsRelatedByCalledByScheduledForDeletion = $bookingEventsRelatedByCalledByToDelete;

        foreach ($bookingEventsRelatedByCalledByToDelete as $bookingEventRelatedByCalledByRemoved) {
            $bookingEventRelatedByCalledByRemoved->setContactRelatedByCalledBy(null);
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
                ->filterByContactRelatedByCalledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByCalledBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
        $bookingEventRelatedByCalledBy->setContactRelatedByCalledBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByCalledBy The ChildBookingEvent object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventRelatedByCalledBy->setContactRelatedByCalledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCalledByJoinBookingItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('BookingItem', $joinBehavior);

        return $this->getBookingEventsRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * If this ChildContact is new, it will return
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
                    ->filterByContactRelatedByCancelledBy($this)
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
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByCancelledBy(Collection $bookingEventsRelatedByCancelledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByCancelledByToDelete */
        $bookingEventsRelatedByCancelledByToDelete = $this->getBookingEventsRelatedByCancelledBy(new Criteria(), $con)->diff($bookingEventsRelatedByCancelledBy);


        $this->bookingEventsRelatedByCancelledByScheduledForDeletion = $bookingEventsRelatedByCancelledByToDelete;

        foreach ($bookingEventsRelatedByCancelledByToDelete as $bookingEventRelatedByCancelledByRemoved) {
            $bookingEventRelatedByCancelledByRemoved->setContactRelatedByCancelledBy(null);
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
                ->filterByContactRelatedByCancelledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByCancelledBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
        $bookingEventRelatedByCancelledBy->setContactRelatedByCancelledBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByCancelledBy The ChildBookingEvent object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventRelatedByCancelledBy->setContactRelatedByCancelledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByCancelledByJoinBookingItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('BookingItem', $joinBehavior);

        return $this->getBookingEventsRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * If this ChildContact is new, it will return
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
                    ->filterByContactRelatedByDeletedBy($this)
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
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventsRelatedByDeletedBy(Collection $bookingEventsRelatedByDeletedBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsRelatedByDeletedByToDelete */
        $bookingEventsRelatedByDeletedByToDelete = $this->getBookingEventsRelatedByDeletedBy(new Criteria(), $con)->diff($bookingEventsRelatedByDeletedBy);


        $this->bookingEventsRelatedByDeletedByScheduledForDeletion = $bookingEventsRelatedByDeletedByToDelete;

        foreach ($bookingEventsRelatedByDeletedByToDelete as $bookingEventRelatedByDeletedByRemoved) {
            $bookingEventRelatedByDeletedByRemoved->setContactRelatedByDeletedBy(null);
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
                ->filterByContactRelatedByDeletedBy($this)
                ->count($con);
        }

        return count($this->collBookingEventsRelatedByDeletedBy);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
        $bookingEventRelatedByDeletedBy->setContactRelatedByDeletedBy($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEventRelatedByDeletedBy The ChildBookingEvent object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventRelatedByDeletedBy->setContactRelatedByDeletedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsRelatedByDeletedByJoinBookingItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('BookingItem', $joinBehavior);

        return $this->getBookingEventsRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventsRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
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
     * Clears out the collBookingsRelatedByAuthorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingsRelatedByAuthorId()
     */
    public function clearBookingsRelatedByAuthorId()
    {
        $this->collBookingsRelatedByAuthorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingsRelatedByAuthorId collection loaded partially.
     */
    public function resetPartialBookingsRelatedByAuthorId($v = true)
    {
        $this->collBookingsRelatedByAuthorIdPartial = $v;
    }

    /**
     * Initializes the collBookingsRelatedByAuthorId collection.
     *
     * By default this just sets the collBookingsRelatedByAuthorId collection to an empty array (like clearcollBookingsRelatedByAuthorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingsRelatedByAuthorId($overrideExisting = true)
    {
        if (null !== $this->collBookingsRelatedByAuthorId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingsRelatedByAuthorId = new $collectionClassName;
        $this->collBookingsRelatedByAuthorId->setModel('\TheFarm\Models\Booking');
    }

    /**
     * Gets an array of ChildBooking objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     * @throws PropelException
     */
    public function getBookingsRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingsRelatedByAuthorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingsRelatedByAuthorId) {
                // return empty collection
                $this->initBookingsRelatedByAuthorId();
            } else {
                $collBookingsRelatedByAuthorId = ChildBookingQuery::create(null, $criteria)
                    ->filterByContactRelatedByAuthorId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingsRelatedByAuthorIdPartial && count($collBookingsRelatedByAuthorId)) {
                        $this->initBookingsRelatedByAuthorId(false);

                        foreach ($collBookingsRelatedByAuthorId as $obj) {
                            if (false == $this->collBookingsRelatedByAuthorId->contains($obj)) {
                                $this->collBookingsRelatedByAuthorId->append($obj);
                            }
                        }

                        $this->collBookingsRelatedByAuthorIdPartial = true;
                    }

                    return $collBookingsRelatedByAuthorId;
                }

                if ($partial && $this->collBookingsRelatedByAuthorId) {
                    foreach ($this->collBookingsRelatedByAuthorId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingsRelatedByAuthorId[] = $obj;
                        }
                    }
                }

                $this->collBookingsRelatedByAuthorId = $collBookingsRelatedByAuthorId;
                $this->collBookingsRelatedByAuthorIdPartial = false;
            }
        }

        return $this->collBookingsRelatedByAuthorId;
    }

    /**
     * Sets a collection of ChildBooking objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingsRelatedByAuthorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingsRelatedByAuthorId(Collection $bookingsRelatedByAuthorId, ConnectionInterface $con = null)
    {
        /** @var ChildBooking[] $bookingsRelatedByAuthorIdToDelete */
        $bookingsRelatedByAuthorIdToDelete = $this->getBookingsRelatedByAuthorId(new Criteria(), $con)->diff($bookingsRelatedByAuthorId);


        $this->bookingsRelatedByAuthorIdScheduledForDeletion = $bookingsRelatedByAuthorIdToDelete;

        foreach ($bookingsRelatedByAuthorIdToDelete as $bookingRelatedByAuthorIdRemoved) {
            $bookingRelatedByAuthorIdRemoved->setContactRelatedByAuthorId(null);
        }

        $this->collBookingsRelatedByAuthorId = null;
        foreach ($bookingsRelatedByAuthorId as $bookingRelatedByAuthorId) {
            $this->addBookingRelatedByAuthorId($bookingRelatedByAuthorId);
        }

        $this->collBookingsRelatedByAuthorId = $bookingsRelatedByAuthorId;
        $this->collBookingsRelatedByAuthorIdPartial = false;

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
    public function countBookingsRelatedByAuthorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingsRelatedByAuthorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingsRelatedByAuthorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingsRelatedByAuthorId());
            }

            $query = ChildBookingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByAuthorId($this)
                ->count($con);
        }

        return count($this->collBookingsRelatedByAuthorId);
    }

    /**
     * Method called to associate a ChildBooking object to this object
     * through the ChildBooking foreign key attribute.
     *
     * @param  ChildBooking $l ChildBooking
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingRelatedByAuthorId(ChildBooking $l)
    {
        if ($this->collBookingsRelatedByAuthorId === null) {
            $this->initBookingsRelatedByAuthorId();
            $this->collBookingsRelatedByAuthorIdPartial = true;
        }

        if (!$this->collBookingsRelatedByAuthorId->contains($l)) {
            $this->doAddBookingRelatedByAuthorId($l);

            if ($this->bookingsRelatedByAuthorIdScheduledForDeletion and $this->bookingsRelatedByAuthorIdScheduledForDeletion->contains($l)) {
                $this->bookingsRelatedByAuthorIdScheduledForDeletion->remove($this->bookingsRelatedByAuthorIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooking $bookingRelatedByAuthorId The ChildBooking object to add.
     */
    protected function doAddBookingRelatedByAuthorId(ChildBooking $bookingRelatedByAuthorId)
    {
        $this->collBookingsRelatedByAuthorId[]= $bookingRelatedByAuthorId;
        $bookingRelatedByAuthorId->setContactRelatedByAuthorId($this);
    }

    /**
     * @param  ChildBooking $bookingRelatedByAuthorId The ChildBooking object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingRelatedByAuthorId(ChildBooking $bookingRelatedByAuthorId)
    {
        if ($this->getBookingsRelatedByAuthorId()->contains($bookingRelatedByAuthorId)) {
            $pos = $this->collBookingsRelatedByAuthorId->search($bookingRelatedByAuthorId);
            $this->collBookingsRelatedByAuthorId->remove($pos);
            if (null === $this->bookingsRelatedByAuthorIdScheduledForDeletion) {
                $this->bookingsRelatedByAuthorIdScheduledForDeletion = clone $this->collBookingsRelatedByAuthorId;
                $this->bookingsRelatedByAuthorIdScheduledForDeletion->clear();
            }
            $this->bookingsRelatedByAuthorIdScheduledForDeletion[]= $bookingRelatedByAuthorId;
            $bookingRelatedByAuthorId->setContactRelatedByAuthorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByAuthorIdJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getBookingsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByAuthorIdJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingsRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByAuthorIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingsRelatedByAuthorId($query, $con);
    }

    /**
     * Clears out the collBookingsRelatedByGuestId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingsRelatedByGuestId()
     */
    public function clearBookingsRelatedByGuestId()
    {
        $this->collBookingsRelatedByGuestId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingsRelatedByGuestId collection loaded partially.
     */
    public function resetPartialBookingsRelatedByGuestId($v = true)
    {
        $this->collBookingsRelatedByGuestIdPartial = $v;
    }

    /**
     * Initializes the collBookingsRelatedByGuestId collection.
     *
     * By default this just sets the collBookingsRelatedByGuestId collection to an empty array (like clearcollBookingsRelatedByGuestId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingsRelatedByGuestId($overrideExisting = true)
    {
        if (null !== $this->collBookingsRelatedByGuestId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingsRelatedByGuestId = new $collectionClassName;
        $this->collBookingsRelatedByGuestId->setModel('\TheFarm\Models\Booking');
    }

    /**
     * Gets an array of ChildBooking objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     * @throws PropelException
     */
    public function getBookingsRelatedByGuestId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsRelatedByGuestIdPartial && !$this->isNew();
        if (null === $this->collBookingsRelatedByGuestId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingsRelatedByGuestId) {
                // return empty collection
                $this->initBookingsRelatedByGuestId();
            } else {
                $collBookingsRelatedByGuestId = ChildBookingQuery::create(null, $criteria)
                    ->filterByContactRelatedByGuestId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingsRelatedByGuestIdPartial && count($collBookingsRelatedByGuestId)) {
                        $this->initBookingsRelatedByGuestId(false);

                        foreach ($collBookingsRelatedByGuestId as $obj) {
                            if (false == $this->collBookingsRelatedByGuestId->contains($obj)) {
                                $this->collBookingsRelatedByGuestId->append($obj);
                            }
                        }

                        $this->collBookingsRelatedByGuestIdPartial = true;
                    }

                    return $collBookingsRelatedByGuestId;
                }

                if ($partial && $this->collBookingsRelatedByGuestId) {
                    foreach ($this->collBookingsRelatedByGuestId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingsRelatedByGuestId[] = $obj;
                        }
                    }
                }

                $this->collBookingsRelatedByGuestId = $collBookingsRelatedByGuestId;
                $this->collBookingsRelatedByGuestIdPartial = false;
            }
        }

        return $this->collBookingsRelatedByGuestId;
    }

    /**
     * Sets a collection of ChildBooking objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingsRelatedByGuestId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingsRelatedByGuestId(Collection $bookingsRelatedByGuestId, ConnectionInterface $con = null)
    {
        /** @var ChildBooking[] $bookingsRelatedByGuestIdToDelete */
        $bookingsRelatedByGuestIdToDelete = $this->getBookingsRelatedByGuestId(new Criteria(), $con)->diff($bookingsRelatedByGuestId);


        $this->bookingsRelatedByGuestIdScheduledForDeletion = $bookingsRelatedByGuestIdToDelete;

        foreach ($bookingsRelatedByGuestIdToDelete as $bookingRelatedByGuestIdRemoved) {
            $bookingRelatedByGuestIdRemoved->setContactRelatedByGuestId(null);
        }

        $this->collBookingsRelatedByGuestId = null;
        foreach ($bookingsRelatedByGuestId as $bookingRelatedByGuestId) {
            $this->addBookingRelatedByGuestId($bookingRelatedByGuestId);
        }

        $this->collBookingsRelatedByGuestId = $bookingsRelatedByGuestId;
        $this->collBookingsRelatedByGuestIdPartial = false;

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
    public function countBookingsRelatedByGuestId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsRelatedByGuestIdPartial && !$this->isNew();
        if (null === $this->collBookingsRelatedByGuestId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingsRelatedByGuestId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingsRelatedByGuestId());
            }

            $query = ChildBookingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByGuestId($this)
                ->count($con);
        }

        return count($this->collBookingsRelatedByGuestId);
    }

    /**
     * Method called to associate a ChildBooking object to this object
     * through the ChildBooking foreign key attribute.
     *
     * @param  ChildBooking $l ChildBooking
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingRelatedByGuestId(ChildBooking $l)
    {
        if ($this->collBookingsRelatedByGuestId === null) {
            $this->initBookingsRelatedByGuestId();
            $this->collBookingsRelatedByGuestIdPartial = true;
        }

        if (!$this->collBookingsRelatedByGuestId->contains($l)) {
            $this->doAddBookingRelatedByGuestId($l);

            if ($this->bookingsRelatedByGuestIdScheduledForDeletion and $this->bookingsRelatedByGuestIdScheduledForDeletion->contains($l)) {
                $this->bookingsRelatedByGuestIdScheduledForDeletion->remove($this->bookingsRelatedByGuestIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooking $bookingRelatedByGuestId The ChildBooking object to add.
     */
    protected function doAddBookingRelatedByGuestId(ChildBooking $bookingRelatedByGuestId)
    {
        $this->collBookingsRelatedByGuestId[]= $bookingRelatedByGuestId;
        $bookingRelatedByGuestId->setContactRelatedByGuestId($this);
    }

    /**
     * @param  ChildBooking $bookingRelatedByGuestId The ChildBooking object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingRelatedByGuestId(ChildBooking $bookingRelatedByGuestId)
    {
        if ($this->getBookingsRelatedByGuestId()->contains($bookingRelatedByGuestId)) {
            $pos = $this->collBookingsRelatedByGuestId->search($bookingRelatedByGuestId);
            $this->collBookingsRelatedByGuestId->remove($pos);
            if (null === $this->bookingsRelatedByGuestIdScheduledForDeletion) {
                $this->bookingsRelatedByGuestIdScheduledForDeletion = clone $this->collBookingsRelatedByGuestId;
                $this->bookingsRelatedByGuestIdScheduledForDeletion->clear();
            }
            $this->bookingsRelatedByGuestIdScheduledForDeletion[]= $bookingRelatedByGuestId;
            $bookingRelatedByGuestId->setContactRelatedByGuestId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByGuestIdJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getBookingsRelatedByGuestId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByGuestIdJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getBookingsRelatedByGuestId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingsRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsRelatedByGuestIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingsRelatedByGuestId($query, $con);
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
     * If this ChildContact is new, it will return
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
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setItemsRelatedUsers(Collection $itemsRelatedUsers, ConnectionInterface $con = null)
    {
        /** @var ChildItemsRelatedUser[] $itemsRelatedUsersToDelete */
        $itemsRelatedUsersToDelete = $this->getItemsRelatedUsers(new Criteria(), $con)->diff($itemsRelatedUsers);


        $this->itemsRelatedUsersScheduledForDeletion = $itemsRelatedUsersToDelete;

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
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
     * @return $this|ChildContact The current object (for fluent API support)
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
     * Gets a single ChildUser object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildUser
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {

        if ($this->singleUser === null && !$this->isNew()) {
            $this->singleUser = ChildUserQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleUser;
    }

    /**
     * Sets a single ChildUser object as related to this object by a one-to-one relationship.
     *
     * @param  ChildUser $v ChildUser
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        $this->singleUser = $v;

        // Make sure that that the passed-in ChildUser isn't already associated with this object
        if ($v !== null && $v->getContact(null, false) === null) {
            $v->setContact($this);
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
        if (null !== $this->aPosition) {
            $this->aPosition->removeContact($this);
        }
        $this->contact_id = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->middle_name = null;
        $this->email = null;
        $this->title = null;
        $this->date_joined = null;
        $this->avatar = null;
        $this->civil_status = null;
        $this->nationality = null;
        $this->country_dominicile = null;
        $this->etnic_origin = null;
        $this->dob = null;
        $this->place_of_birth = null;
        $this->age = null;
        $this->gender = null;
        $this->height = null;
        $this->weight = null;
        $this->phone = null;
        $this->position_cd = null;
        $this->is_active = null;
        $this->verification_key = null;
        $this->verified = null;
        $this->nickname = null;
        $this->bio = null;
        $this->approved = null;
        $this->activation_code = null;
        $this->active = null;
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
            if ($this->collBookingEventUsers) {
                foreach ($this->collBookingEventUsers as $o) {
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
            if ($this->collBookingsRelatedByAuthorId) {
                foreach ($this->collBookingsRelatedByAuthorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingsRelatedByGuestId) {
                foreach ($this->collBookingsRelatedByGuestId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemsRelatedUsers) {
                foreach ($this->collItemsRelatedUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleUser) {
                $this->singleUser->clearAllReferences($deep);
            }
        } // if ($deep)

        $this->collBookingEventUsers = null;
        $this->collBookingEventsRelatedByAuthorId = null;
        $this->collBookingEventsRelatedByCalledBy = null;
        $this->collBookingEventsRelatedByCancelledBy = null;
        $this->collBookingEventsRelatedByDeletedBy = null;
        $this->collBookingsRelatedByAuthorId = null;
        $this->collBookingsRelatedByGuestId = null;
        $this->collItemsRelatedUsers = null;
        $this->singleUser = null;
        $this->aPosition = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ContactTableMap::DEFAULT_STRING_FORMAT);
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
