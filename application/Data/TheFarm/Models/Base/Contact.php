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
use TheFarm\Models\Bookings as ChildBookings;
use TheFarm\Models\BookingsQuery as ChildBookingsQuery;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\ItemsRelatedUsers as ChildItemsRelatedUsers;
use TheFarm\Models\ItemsRelatedUsersQuery as ChildItemsRelatedUsersQuery;
use TheFarm\Models\Position as ChildPosition;
use TheFarm\Models\PositionQuery as ChildPositionQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\BookingEventUsersTableMap;
use TheFarm\Models\Map\BookingEventsTableMap;
use TheFarm\Models\Map\BookingsTableMap;
use TheFarm\Models\Map\ContactTableMap;
use TheFarm\Models\Map\ItemsRelatedUsersTableMap;

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
     * @var        boolean
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
     * @var        ObjectCollection|ChildBookingEventUsers[] Collection to store aggregation of ChildBookingEventUsers objects.
     */
    protected $collBookingEventUserss;
    protected $collBookingEventUserssPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventssRelatedByAuthorId;
    protected $collBookingEventssRelatedByAuthorIdPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventssRelatedByCalledBy;
    protected $collBookingEventssRelatedByCalledByPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventssRelatedByCancelledBy;
    protected $collBookingEventssRelatedByCancelledByPartial;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventssRelatedByDeletedBy;
    protected $collBookingEventssRelatedByDeletedByPartial;

    /**
     * @var        ObjectCollection|ChildBookings[] Collection to store aggregation of ChildBookings objects.
     */
    protected $collBookingssRelatedByAuthorId;
    protected $collBookingssRelatedByAuthorIdPartial;

    /**
     * @var        ObjectCollection|ChildBookings[] Collection to store aggregation of ChildBookings objects.
     */
    protected $collBookingssRelatedByGuestId;
    protected $collBookingssRelatedByGuestIdPartial;

    /**
     * @var        ObjectCollection|ChildItemsRelatedUsers[] Collection to store aggregation of ChildItemsRelatedUsers objects.
     */
    protected $collItemsRelatedUserss;
    protected $collItemsRelatedUserssPartial;

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
     * @var ObjectCollection|ChildBookingEventUsers[]
     */
    protected $bookingEventUserssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssRelatedByAuthorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssRelatedByCalledByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssRelatedByCancelledByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssRelatedByDeletedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookings[]
     */
    protected $bookingssRelatedByAuthorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookings[]
     */
    protected $bookingssRelatedByGuestIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemsRelatedUsers[]
     */
    protected $itemsRelatedUserssScheduledForDeletion = null;

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
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
            $this->is_active = (null !== $col) ? (boolean) $col : null;

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
            $this->collBookingEventUserss = null;

            $this->collBookingEventssRelatedByAuthorId = null;

            $this->collBookingEventssRelatedByCalledBy = null;

            $this->collBookingEventssRelatedByCancelledBy = null;

            $this->collBookingEventssRelatedByDeletedBy = null;

            $this->collBookingssRelatedByAuthorId = null;

            $this->collBookingssRelatedByGuestId = null;

            $this->collItemsRelatedUserss = null;

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

            if ($this->bookingEventssRelatedByAuthorIdScheduledForDeletion !== null) {
                if (!$this->bookingEventssRelatedByAuthorIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventssRelatedByAuthorIdScheduledForDeletion as $bookingEventsRelatedByAuthorId) {
                        // need to save related object because we set the relation to null
                        $bookingEventsRelatedByAuthorId->save($con);
                    }
                    $this->bookingEventssRelatedByAuthorIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventssRelatedByAuthorId !== null) {
                foreach ($this->collBookingEventssRelatedByAuthorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventssRelatedByCalledByScheduledForDeletion !== null) {
                if (!$this->bookingEventssRelatedByCalledByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventssRelatedByCalledByScheduledForDeletion as $bookingEventsRelatedByCalledBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventsRelatedByCalledBy->save($con);
                    }
                    $this->bookingEventssRelatedByCalledByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventssRelatedByCalledBy !== null) {
                foreach ($this->collBookingEventssRelatedByCalledBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventssRelatedByCancelledByScheduledForDeletion !== null) {
                if (!$this->bookingEventssRelatedByCancelledByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventssRelatedByCancelledByScheduledForDeletion as $bookingEventsRelatedByCancelledBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventsRelatedByCancelledBy->save($con);
                    }
                    $this->bookingEventssRelatedByCancelledByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventssRelatedByCancelledBy !== null) {
                foreach ($this->collBookingEventssRelatedByCancelledBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingEventssRelatedByDeletedByScheduledForDeletion !== null) {
                if (!$this->bookingEventssRelatedByDeletedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventssRelatedByDeletedByScheduledForDeletion as $bookingEventsRelatedByDeletedBy) {
                        // need to save related object because we set the relation to null
                        $bookingEventsRelatedByDeletedBy->save($con);
                    }
                    $this->bookingEventssRelatedByDeletedByScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventssRelatedByDeletedBy !== null) {
                foreach ($this->collBookingEventssRelatedByDeletedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingssRelatedByAuthorIdScheduledForDeletion !== null) {
                if (!$this->bookingssRelatedByAuthorIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingssRelatedByAuthorIdScheduledForDeletion as $bookingsRelatedByAuthorId) {
                        // need to save related object because we set the relation to null
                        $bookingsRelatedByAuthorId->save($con);
                    }
                    $this->bookingssRelatedByAuthorIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingssRelatedByAuthorId !== null) {
                foreach ($this->collBookingssRelatedByAuthorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingssRelatedByGuestIdScheduledForDeletion !== null) {
                if (!$this->bookingssRelatedByGuestIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingssRelatedByGuestIdScheduledForDeletion as $bookingsRelatedByGuestId) {
                        // need to save related object because we set the relation to null
                        $bookingsRelatedByGuestId->save($con);
                    }
                    $this->bookingssRelatedByGuestIdScheduledForDeletion = null;
                }
            }

            if ($this->collBookingssRelatedByGuestId !== null) {
                foreach ($this->collBookingssRelatedByGuestId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemsRelatedUserssScheduledForDeletion !== null) {
                if (!$this->itemsRelatedUserssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemsRelatedUsersQuery::create()
                        ->filterByPrimaryKeys($this->itemsRelatedUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemsRelatedUserssScheduledForDeletion = null;
                }
            }

            if ($this->collItemsRelatedUserss !== null) {
                foreach ($this->collItemsRelatedUserss as $referrerFK) {
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
                        $stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);
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
            if (null !== $this->collBookingEventssRelatedByAuthorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEventss';
                }

                $result[$key] = $this->collBookingEventssRelatedByAuthorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventssRelatedByCalledBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEventss';
                }

                $result[$key] = $this->collBookingEventssRelatedByCalledBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventssRelatedByCancelledBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEventss';
                }

                $result[$key] = $this->collBookingEventssRelatedByCancelledBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingEventssRelatedByDeletedBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEventss';
                }

                $result[$key] = $this->collBookingEventssRelatedByDeletedBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingssRelatedByAuthorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookingss';
                        break;
                    default:
                        $key = 'Bookingss';
                }

                $result[$key] = $this->collBookingssRelatedByAuthorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingssRelatedByGuestId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookingss';
                        break;
                    default:
                        $key = 'Bookingss';
                }

                $result[$key] = $this->collBookingssRelatedByGuestId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItemsRelatedUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemsRelatedUserss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items_related_userss';
                        break;
                    default:
                        $key = 'ItemsRelatedUserss';
                }

                $result[$key] = $this->collItemsRelatedUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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

            foreach ($this->getBookingEventUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventUsers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventssRelatedByAuthorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventsRelatedByAuthorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventssRelatedByCalledBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventsRelatedByCalledBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventssRelatedByCancelledBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventsRelatedByCancelledBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingEventssRelatedByDeletedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEventsRelatedByDeletedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingssRelatedByAuthorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingsRelatedByAuthorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingssRelatedByGuestId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingsRelatedByGuestId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemsRelatedUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemsRelatedUsers($relObj->copy($deepCopy));
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
        if ('BookingEventUsers' == $relationName) {
            $this->initBookingEventUserss();
            return;
        }
        if ('BookingEventsRelatedByAuthorId' == $relationName) {
            $this->initBookingEventssRelatedByAuthorId();
            return;
        }
        if ('BookingEventsRelatedByCalledBy' == $relationName) {
            $this->initBookingEventssRelatedByCalledBy();
            return;
        }
        if ('BookingEventsRelatedByCancelledBy' == $relationName) {
            $this->initBookingEventssRelatedByCancelledBy();
            return;
        }
        if ('BookingEventsRelatedByDeletedBy' == $relationName) {
            $this->initBookingEventssRelatedByDeletedBy();
            return;
        }
        if ('BookingsRelatedByAuthorId' == $relationName) {
            $this->initBookingssRelatedByAuthorId();
            return;
        }
        if ('BookingsRelatedByGuestId' == $relationName) {
            $this->initBookingssRelatedByGuestId();
            return;
        }
        if ('ItemsRelatedUsers' == $relationName) {
            $this->initItemsRelatedUserss();
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
     * If this ChildContact is new, it will return
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
                    ->filterByContact($this)
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
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventUsersRemoved->setContact(null);
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
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collBookingEventUserss);
    }

    /**
     * Method called to associate a ChildBookingEventUsers object to this object
     * through the ChildBookingEventUsers foreign key attribute.
     *
     * @param  ChildBookingEventUsers $l ChildBookingEventUsers
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
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
        $bookingEventUsers->setContact($this);
    }

    /**
     * @param  ChildBookingEventUsers $bookingEventUsers The ChildBookingEventUsers object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
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
            $bookingEventUsers->setContact(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEventUsers[] List of ChildBookingEventUsers objects
     */
    public function getBookingEventUserssJoinBookingEvents(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventUsersQuery::create(null, $criteria);
        $query->joinWith('BookingEvents', $joinBehavior);

        return $this->getBookingEventUserss($query, $con);
    }

    /**
     * Clears out the collBookingEventssRelatedByAuthorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventssRelatedByAuthorId()
     */
    public function clearBookingEventssRelatedByAuthorId()
    {
        $this->collBookingEventssRelatedByAuthorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventssRelatedByAuthorId collection loaded partially.
     */
    public function resetPartialBookingEventssRelatedByAuthorId($v = true)
    {
        $this->collBookingEventssRelatedByAuthorIdPartial = $v;
    }

    /**
     * Initializes the collBookingEventssRelatedByAuthorId collection.
     *
     * By default this just sets the collBookingEventssRelatedByAuthorId collection to an empty array (like clearcollBookingEventssRelatedByAuthorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventssRelatedByAuthorId($overrideExisting = true)
    {
        if (null !== $this->collBookingEventssRelatedByAuthorId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventssRelatedByAuthorId = new $collectionClassName;
        $this->collBookingEventssRelatedByAuthorId->setModel('\TheFarm\Models\BookingEvents');
    }

    /**
     * Gets an array of ChildBookingEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     * @throws PropelException
     */
    public function getBookingEventssRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByAuthorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByAuthorId) {
                // return empty collection
                $this->initBookingEventssRelatedByAuthorId();
            } else {
                $collBookingEventssRelatedByAuthorId = ChildBookingEventsQuery::create(null, $criteria)
                    ->filterByContactRelatedByAuthorId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventssRelatedByAuthorIdPartial && count($collBookingEventssRelatedByAuthorId)) {
                        $this->initBookingEventssRelatedByAuthorId(false);

                        foreach ($collBookingEventssRelatedByAuthorId as $obj) {
                            if (false == $this->collBookingEventssRelatedByAuthorId->contains($obj)) {
                                $this->collBookingEventssRelatedByAuthorId->append($obj);
                            }
                        }

                        $this->collBookingEventssRelatedByAuthorIdPartial = true;
                    }

                    return $collBookingEventssRelatedByAuthorId;
                }

                if ($partial && $this->collBookingEventssRelatedByAuthorId) {
                    foreach ($this->collBookingEventssRelatedByAuthorId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventssRelatedByAuthorId[] = $obj;
                        }
                    }
                }

                $this->collBookingEventssRelatedByAuthorId = $collBookingEventssRelatedByAuthorId;
                $this->collBookingEventssRelatedByAuthorIdPartial = false;
            }
        }

        return $this->collBookingEventssRelatedByAuthorId;
    }

    /**
     * Sets a collection of ChildBookingEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventssRelatedByAuthorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventssRelatedByAuthorId(Collection $bookingEventssRelatedByAuthorId, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssRelatedByAuthorIdToDelete */
        $bookingEventssRelatedByAuthorIdToDelete = $this->getBookingEventssRelatedByAuthorId(new Criteria(), $con)->diff($bookingEventssRelatedByAuthorId);


        $this->bookingEventssRelatedByAuthorIdScheduledForDeletion = $bookingEventssRelatedByAuthorIdToDelete;

        foreach ($bookingEventssRelatedByAuthorIdToDelete as $bookingEventsRelatedByAuthorIdRemoved) {
            $bookingEventsRelatedByAuthorIdRemoved->setContactRelatedByAuthorId(null);
        }

        $this->collBookingEventssRelatedByAuthorId = null;
        foreach ($bookingEventssRelatedByAuthorId as $bookingEventsRelatedByAuthorId) {
            $this->addBookingEventsRelatedByAuthorId($bookingEventsRelatedByAuthorId);
        }

        $this->collBookingEventssRelatedByAuthorId = $bookingEventssRelatedByAuthorId;
        $this->collBookingEventssRelatedByAuthorIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvents objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvents objects.
     * @throws PropelException
     */
    public function countBookingEventssRelatedByAuthorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByAuthorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByAuthorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventssRelatedByAuthorId());
            }

            $query = ChildBookingEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByAuthorId($this)
                ->count($con);
        }

        return count($this->collBookingEventssRelatedByAuthorId);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingEventsRelatedByAuthorId(ChildBookingEvents $l)
    {
        if ($this->collBookingEventssRelatedByAuthorId === null) {
            $this->initBookingEventssRelatedByAuthorId();
            $this->collBookingEventssRelatedByAuthorIdPartial = true;
        }

        if (!$this->collBookingEventssRelatedByAuthorId->contains($l)) {
            $this->doAddBookingEventsRelatedByAuthorId($l);

            if ($this->bookingEventssRelatedByAuthorIdScheduledForDeletion and $this->bookingEventssRelatedByAuthorIdScheduledForDeletion->contains($l)) {
                $this->bookingEventssRelatedByAuthorIdScheduledForDeletion->remove($this->bookingEventssRelatedByAuthorIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvents $bookingEventsRelatedByAuthorId The ChildBookingEvents object to add.
     */
    protected function doAddBookingEventsRelatedByAuthorId(ChildBookingEvents $bookingEventsRelatedByAuthorId)
    {
        $this->collBookingEventssRelatedByAuthorId[]= $bookingEventsRelatedByAuthorId;
        $bookingEventsRelatedByAuthorId->setContactRelatedByAuthorId($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEventsRelatedByAuthorId The ChildBookingEvents object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingEventsRelatedByAuthorId(ChildBookingEvents $bookingEventsRelatedByAuthorId)
    {
        if ($this->getBookingEventssRelatedByAuthorId()->contains($bookingEventsRelatedByAuthorId)) {
            $pos = $this->collBookingEventssRelatedByAuthorId->search($bookingEventsRelatedByAuthorId);
            $this->collBookingEventssRelatedByAuthorId->remove($pos);
            if (null === $this->bookingEventssRelatedByAuthorIdScheduledForDeletion) {
                $this->bookingEventssRelatedByAuthorIdScheduledForDeletion = clone $this->collBookingEventssRelatedByAuthorId;
                $this->bookingEventssRelatedByAuthorIdScheduledForDeletion->clear();
            }
            $this->bookingEventssRelatedByAuthorIdScheduledForDeletion[]= $bookingEventsRelatedByAuthorId;
            $bookingEventsRelatedByAuthorId->setContactRelatedByAuthorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByAuthorIdJoinBookingItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('BookingItems', $joinBehavior);

        return $this->getBookingEventssRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByAuthorIdJoinFacilities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Facilities', $joinBehavior);

        return $this->getBookingEventssRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByAuthorIdJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingEventssRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByAuthorIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventssRelatedByAuthorId($query, $con);
    }

    /**
     * Clears out the collBookingEventssRelatedByCalledBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventssRelatedByCalledBy()
     */
    public function clearBookingEventssRelatedByCalledBy()
    {
        $this->collBookingEventssRelatedByCalledBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventssRelatedByCalledBy collection loaded partially.
     */
    public function resetPartialBookingEventssRelatedByCalledBy($v = true)
    {
        $this->collBookingEventssRelatedByCalledByPartial = $v;
    }

    /**
     * Initializes the collBookingEventssRelatedByCalledBy collection.
     *
     * By default this just sets the collBookingEventssRelatedByCalledBy collection to an empty array (like clearcollBookingEventssRelatedByCalledBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventssRelatedByCalledBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventssRelatedByCalledBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventssRelatedByCalledBy = new $collectionClassName;
        $this->collBookingEventssRelatedByCalledBy->setModel('\TheFarm\Models\BookingEvents');
    }

    /**
     * Gets an array of ChildBookingEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     * @throws PropelException
     */
    public function getBookingEventssRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByCalledByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByCalledBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByCalledBy) {
                // return empty collection
                $this->initBookingEventssRelatedByCalledBy();
            } else {
                $collBookingEventssRelatedByCalledBy = ChildBookingEventsQuery::create(null, $criteria)
                    ->filterByContactRelatedByCalledBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventssRelatedByCalledByPartial && count($collBookingEventssRelatedByCalledBy)) {
                        $this->initBookingEventssRelatedByCalledBy(false);

                        foreach ($collBookingEventssRelatedByCalledBy as $obj) {
                            if (false == $this->collBookingEventssRelatedByCalledBy->contains($obj)) {
                                $this->collBookingEventssRelatedByCalledBy->append($obj);
                            }
                        }

                        $this->collBookingEventssRelatedByCalledByPartial = true;
                    }

                    return $collBookingEventssRelatedByCalledBy;
                }

                if ($partial && $this->collBookingEventssRelatedByCalledBy) {
                    foreach ($this->collBookingEventssRelatedByCalledBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventssRelatedByCalledBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventssRelatedByCalledBy = $collBookingEventssRelatedByCalledBy;
                $this->collBookingEventssRelatedByCalledByPartial = false;
            }
        }

        return $this->collBookingEventssRelatedByCalledBy;
    }

    /**
     * Sets a collection of ChildBookingEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventssRelatedByCalledBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventssRelatedByCalledBy(Collection $bookingEventssRelatedByCalledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssRelatedByCalledByToDelete */
        $bookingEventssRelatedByCalledByToDelete = $this->getBookingEventssRelatedByCalledBy(new Criteria(), $con)->diff($bookingEventssRelatedByCalledBy);


        $this->bookingEventssRelatedByCalledByScheduledForDeletion = $bookingEventssRelatedByCalledByToDelete;

        foreach ($bookingEventssRelatedByCalledByToDelete as $bookingEventsRelatedByCalledByRemoved) {
            $bookingEventsRelatedByCalledByRemoved->setContactRelatedByCalledBy(null);
        }

        $this->collBookingEventssRelatedByCalledBy = null;
        foreach ($bookingEventssRelatedByCalledBy as $bookingEventsRelatedByCalledBy) {
            $this->addBookingEventsRelatedByCalledBy($bookingEventsRelatedByCalledBy);
        }

        $this->collBookingEventssRelatedByCalledBy = $bookingEventssRelatedByCalledBy;
        $this->collBookingEventssRelatedByCalledByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvents objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvents objects.
     * @throws PropelException
     */
    public function countBookingEventssRelatedByCalledBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByCalledByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByCalledBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByCalledBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventssRelatedByCalledBy());
            }

            $query = ChildBookingEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByCalledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventssRelatedByCalledBy);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingEventsRelatedByCalledBy(ChildBookingEvents $l)
    {
        if ($this->collBookingEventssRelatedByCalledBy === null) {
            $this->initBookingEventssRelatedByCalledBy();
            $this->collBookingEventssRelatedByCalledByPartial = true;
        }

        if (!$this->collBookingEventssRelatedByCalledBy->contains($l)) {
            $this->doAddBookingEventsRelatedByCalledBy($l);

            if ($this->bookingEventssRelatedByCalledByScheduledForDeletion and $this->bookingEventssRelatedByCalledByScheduledForDeletion->contains($l)) {
                $this->bookingEventssRelatedByCalledByScheduledForDeletion->remove($this->bookingEventssRelatedByCalledByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvents $bookingEventsRelatedByCalledBy The ChildBookingEvents object to add.
     */
    protected function doAddBookingEventsRelatedByCalledBy(ChildBookingEvents $bookingEventsRelatedByCalledBy)
    {
        $this->collBookingEventssRelatedByCalledBy[]= $bookingEventsRelatedByCalledBy;
        $bookingEventsRelatedByCalledBy->setContactRelatedByCalledBy($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEventsRelatedByCalledBy The ChildBookingEvents object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingEventsRelatedByCalledBy(ChildBookingEvents $bookingEventsRelatedByCalledBy)
    {
        if ($this->getBookingEventssRelatedByCalledBy()->contains($bookingEventsRelatedByCalledBy)) {
            $pos = $this->collBookingEventssRelatedByCalledBy->search($bookingEventsRelatedByCalledBy);
            $this->collBookingEventssRelatedByCalledBy->remove($pos);
            if (null === $this->bookingEventssRelatedByCalledByScheduledForDeletion) {
                $this->bookingEventssRelatedByCalledByScheduledForDeletion = clone $this->collBookingEventssRelatedByCalledBy;
                $this->bookingEventssRelatedByCalledByScheduledForDeletion->clear();
            }
            $this->bookingEventssRelatedByCalledByScheduledForDeletion[]= $bookingEventsRelatedByCalledBy;
            $bookingEventsRelatedByCalledBy->setContactRelatedByCalledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCalledByJoinBookingItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('BookingItems', $joinBehavior);

        return $this->getBookingEventssRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCalledByJoinFacilities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Facilities', $joinBehavior);

        return $this->getBookingEventssRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCalledByJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingEventssRelatedByCalledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCalledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCalledByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventssRelatedByCalledBy($query, $con);
    }

    /**
     * Clears out the collBookingEventssRelatedByCancelledBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventssRelatedByCancelledBy()
     */
    public function clearBookingEventssRelatedByCancelledBy()
    {
        $this->collBookingEventssRelatedByCancelledBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventssRelatedByCancelledBy collection loaded partially.
     */
    public function resetPartialBookingEventssRelatedByCancelledBy($v = true)
    {
        $this->collBookingEventssRelatedByCancelledByPartial = $v;
    }

    /**
     * Initializes the collBookingEventssRelatedByCancelledBy collection.
     *
     * By default this just sets the collBookingEventssRelatedByCancelledBy collection to an empty array (like clearcollBookingEventssRelatedByCancelledBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventssRelatedByCancelledBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventssRelatedByCancelledBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventssRelatedByCancelledBy = new $collectionClassName;
        $this->collBookingEventssRelatedByCancelledBy->setModel('\TheFarm\Models\BookingEvents');
    }

    /**
     * Gets an array of ChildBookingEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     * @throws PropelException
     */
    public function getBookingEventssRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByCancelledByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByCancelledBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByCancelledBy) {
                // return empty collection
                $this->initBookingEventssRelatedByCancelledBy();
            } else {
                $collBookingEventssRelatedByCancelledBy = ChildBookingEventsQuery::create(null, $criteria)
                    ->filterByContactRelatedByCancelledBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventssRelatedByCancelledByPartial && count($collBookingEventssRelatedByCancelledBy)) {
                        $this->initBookingEventssRelatedByCancelledBy(false);

                        foreach ($collBookingEventssRelatedByCancelledBy as $obj) {
                            if (false == $this->collBookingEventssRelatedByCancelledBy->contains($obj)) {
                                $this->collBookingEventssRelatedByCancelledBy->append($obj);
                            }
                        }

                        $this->collBookingEventssRelatedByCancelledByPartial = true;
                    }

                    return $collBookingEventssRelatedByCancelledBy;
                }

                if ($partial && $this->collBookingEventssRelatedByCancelledBy) {
                    foreach ($this->collBookingEventssRelatedByCancelledBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventssRelatedByCancelledBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventssRelatedByCancelledBy = $collBookingEventssRelatedByCancelledBy;
                $this->collBookingEventssRelatedByCancelledByPartial = false;
            }
        }

        return $this->collBookingEventssRelatedByCancelledBy;
    }

    /**
     * Sets a collection of ChildBookingEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventssRelatedByCancelledBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventssRelatedByCancelledBy(Collection $bookingEventssRelatedByCancelledBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssRelatedByCancelledByToDelete */
        $bookingEventssRelatedByCancelledByToDelete = $this->getBookingEventssRelatedByCancelledBy(new Criteria(), $con)->diff($bookingEventssRelatedByCancelledBy);


        $this->bookingEventssRelatedByCancelledByScheduledForDeletion = $bookingEventssRelatedByCancelledByToDelete;

        foreach ($bookingEventssRelatedByCancelledByToDelete as $bookingEventsRelatedByCancelledByRemoved) {
            $bookingEventsRelatedByCancelledByRemoved->setContactRelatedByCancelledBy(null);
        }

        $this->collBookingEventssRelatedByCancelledBy = null;
        foreach ($bookingEventssRelatedByCancelledBy as $bookingEventsRelatedByCancelledBy) {
            $this->addBookingEventsRelatedByCancelledBy($bookingEventsRelatedByCancelledBy);
        }

        $this->collBookingEventssRelatedByCancelledBy = $bookingEventssRelatedByCancelledBy;
        $this->collBookingEventssRelatedByCancelledByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvents objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvents objects.
     * @throws PropelException
     */
    public function countBookingEventssRelatedByCancelledBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByCancelledByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByCancelledBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByCancelledBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventssRelatedByCancelledBy());
            }

            $query = ChildBookingEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByCancelledBy($this)
                ->count($con);
        }

        return count($this->collBookingEventssRelatedByCancelledBy);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingEventsRelatedByCancelledBy(ChildBookingEvents $l)
    {
        if ($this->collBookingEventssRelatedByCancelledBy === null) {
            $this->initBookingEventssRelatedByCancelledBy();
            $this->collBookingEventssRelatedByCancelledByPartial = true;
        }

        if (!$this->collBookingEventssRelatedByCancelledBy->contains($l)) {
            $this->doAddBookingEventsRelatedByCancelledBy($l);

            if ($this->bookingEventssRelatedByCancelledByScheduledForDeletion and $this->bookingEventssRelatedByCancelledByScheduledForDeletion->contains($l)) {
                $this->bookingEventssRelatedByCancelledByScheduledForDeletion->remove($this->bookingEventssRelatedByCancelledByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvents $bookingEventsRelatedByCancelledBy The ChildBookingEvents object to add.
     */
    protected function doAddBookingEventsRelatedByCancelledBy(ChildBookingEvents $bookingEventsRelatedByCancelledBy)
    {
        $this->collBookingEventssRelatedByCancelledBy[]= $bookingEventsRelatedByCancelledBy;
        $bookingEventsRelatedByCancelledBy->setContactRelatedByCancelledBy($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEventsRelatedByCancelledBy The ChildBookingEvents object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingEventsRelatedByCancelledBy(ChildBookingEvents $bookingEventsRelatedByCancelledBy)
    {
        if ($this->getBookingEventssRelatedByCancelledBy()->contains($bookingEventsRelatedByCancelledBy)) {
            $pos = $this->collBookingEventssRelatedByCancelledBy->search($bookingEventsRelatedByCancelledBy);
            $this->collBookingEventssRelatedByCancelledBy->remove($pos);
            if (null === $this->bookingEventssRelatedByCancelledByScheduledForDeletion) {
                $this->bookingEventssRelatedByCancelledByScheduledForDeletion = clone $this->collBookingEventssRelatedByCancelledBy;
                $this->bookingEventssRelatedByCancelledByScheduledForDeletion->clear();
            }
            $this->bookingEventssRelatedByCancelledByScheduledForDeletion[]= $bookingEventsRelatedByCancelledBy;
            $bookingEventsRelatedByCancelledBy->setContactRelatedByCancelledBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCancelledByJoinBookingItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('BookingItems', $joinBehavior);

        return $this->getBookingEventssRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCancelledByJoinFacilities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Facilities', $joinBehavior);

        return $this->getBookingEventssRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCancelledByJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingEventssRelatedByCancelledBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByCancelledBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByCancelledByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventssRelatedByCancelledBy($query, $con);
    }

    /**
     * Clears out the collBookingEventssRelatedByDeletedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventssRelatedByDeletedBy()
     */
    public function clearBookingEventssRelatedByDeletedBy()
    {
        $this->collBookingEventssRelatedByDeletedBy = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventssRelatedByDeletedBy collection loaded partially.
     */
    public function resetPartialBookingEventssRelatedByDeletedBy($v = true)
    {
        $this->collBookingEventssRelatedByDeletedByPartial = $v;
    }

    /**
     * Initializes the collBookingEventssRelatedByDeletedBy collection.
     *
     * By default this just sets the collBookingEventssRelatedByDeletedBy collection to an empty array (like clearcollBookingEventssRelatedByDeletedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventssRelatedByDeletedBy($overrideExisting = true)
    {
        if (null !== $this->collBookingEventssRelatedByDeletedBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventssRelatedByDeletedBy = new $collectionClassName;
        $this->collBookingEventssRelatedByDeletedBy->setModel('\TheFarm\Models\BookingEvents');
    }

    /**
     * Gets an array of ChildBookingEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     * @throws PropelException
     */
    public function getBookingEventssRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByDeletedByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByDeletedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByDeletedBy) {
                // return empty collection
                $this->initBookingEventssRelatedByDeletedBy();
            } else {
                $collBookingEventssRelatedByDeletedBy = ChildBookingEventsQuery::create(null, $criteria)
                    ->filterByContactRelatedByDeletedBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventssRelatedByDeletedByPartial && count($collBookingEventssRelatedByDeletedBy)) {
                        $this->initBookingEventssRelatedByDeletedBy(false);

                        foreach ($collBookingEventssRelatedByDeletedBy as $obj) {
                            if (false == $this->collBookingEventssRelatedByDeletedBy->contains($obj)) {
                                $this->collBookingEventssRelatedByDeletedBy->append($obj);
                            }
                        }

                        $this->collBookingEventssRelatedByDeletedByPartial = true;
                    }

                    return $collBookingEventssRelatedByDeletedBy;
                }

                if ($partial && $this->collBookingEventssRelatedByDeletedBy) {
                    foreach ($this->collBookingEventssRelatedByDeletedBy as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventssRelatedByDeletedBy[] = $obj;
                        }
                    }
                }

                $this->collBookingEventssRelatedByDeletedBy = $collBookingEventssRelatedByDeletedBy;
                $this->collBookingEventssRelatedByDeletedByPartial = false;
            }
        }

        return $this->collBookingEventssRelatedByDeletedBy;
    }

    /**
     * Sets a collection of ChildBookingEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventssRelatedByDeletedBy A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingEventssRelatedByDeletedBy(Collection $bookingEventssRelatedByDeletedBy, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssRelatedByDeletedByToDelete */
        $bookingEventssRelatedByDeletedByToDelete = $this->getBookingEventssRelatedByDeletedBy(new Criteria(), $con)->diff($bookingEventssRelatedByDeletedBy);


        $this->bookingEventssRelatedByDeletedByScheduledForDeletion = $bookingEventssRelatedByDeletedByToDelete;

        foreach ($bookingEventssRelatedByDeletedByToDelete as $bookingEventsRelatedByDeletedByRemoved) {
            $bookingEventsRelatedByDeletedByRemoved->setContactRelatedByDeletedBy(null);
        }

        $this->collBookingEventssRelatedByDeletedBy = null;
        foreach ($bookingEventssRelatedByDeletedBy as $bookingEventsRelatedByDeletedBy) {
            $this->addBookingEventsRelatedByDeletedBy($bookingEventsRelatedByDeletedBy);
        }

        $this->collBookingEventssRelatedByDeletedBy = $bookingEventssRelatedByDeletedBy;
        $this->collBookingEventssRelatedByDeletedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvents objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvents objects.
     * @throws PropelException
     */
    public function countBookingEventssRelatedByDeletedBy(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssRelatedByDeletedByPartial && !$this->isNew();
        if (null === $this->collBookingEventssRelatedByDeletedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventssRelatedByDeletedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventssRelatedByDeletedBy());
            }

            $query = ChildBookingEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByDeletedBy($this)
                ->count($con);
        }

        return count($this->collBookingEventssRelatedByDeletedBy);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingEventsRelatedByDeletedBy(ChildBookingEvents $l)
    {
        if ($this->collBookingEventssRelatedByDeletedBy === null) {
            $this->initBookingEventssRelatedByDeletedBy();
            $this->collBookingEventssRelatedByDeletedByPartial = true;
        }

        if (!$this->collBookingEventssRelatedByDeletedBy->contains($l)) {
            $this->doAddBookingEventsRelatedByDeletedBy($l);

            if ($this->bookingEventssRelatedByDeletedByScheduledForDeletion and $this->bookingEventssRelatedByDeletedByScheduledForDeletion->contains($l)) {
                $this->bookingEventssRelatedByDeletedByScheduledForDeletion->remove($this->bookingEventssRelatedByDeletedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvents $bookingEventsRelatedByDeletedBy The ChildBookingEvents object to add.
     */
    protected function doAddBookingEventsRelatedByDeletedBy(ChildBookingEvents $bookingEventsRelatedByDeletedBy)
    {
        $this->collBookingEventssRelatedByDeletedBy[]= $bookingEventsRelatedByDeletedBy;
        $bookingEventsRelatedByDeletedBy->setContactRelatedByDeletedBy($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEventsRelatedByDeletedBy The ChildBookingEvents object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingEventsRelatedByDeletedBy(ChildBookingEvents $bookingEventsRelatedByDeletedBy)
    {
        if ($this->getBookingEventssRelatedByDeletedBy()->contains($bookingEventsRelatedByDeletedBy)) {
            $pos = $this->collBookingEventssRelatedByDeletedBy->search($bookingEventsRelatedByDeletedBy);
            $this->collBookingEventssRelatedByDeletedBy->remove($pos);
            if (null === $this->bookingEventssRelatedByDeletedByScheduledForDeletion) {
                $this->bookingEventssRelatedByDeletedByScheduledForDeletion = clone $this->collBookingEventssRelatedByDeletedBy;
                $this->bookingEventssRelatedByDeletedByScheduledForDeletion->clear();
            }
            $this->bookingEventssRelatedByDeletedByScheduledForDeletion[]= $bookingEventsRelatedByDeletedBy;
            $bookingEventsRelatedByDeletedBy->setContactRelatedByDeletedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByDeletedByJoinBookingItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('BookingItems', $joinBehavior);

        return $this->getBookingEventssRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByDeletedByJoinFacilities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Facilities', $joinBehavior);

        return $this->getBookingEventssRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByDeletedByJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingEventssRelatedByDeletedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingEventssRelatedByDeletedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssRelatedByDeletedByJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventssRelatedByDeletedBy($query, $con);
    }

    /**
     * Clears out the collBookingssRelatedByAuthorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingssRelatedByAuthorId()
     */
    public function clearBookingssRelatedByAuthorId()
    {
        $this->collBookingssRelatedByAuthorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingssRelatedByAuthorId collection loaded partially.
     */
    public function resetPartialBookingssRelatedByAuthorId($v = true)
    {
        $this->collBookingssRelatedByAuthorIdPartial = $v;
    }

    /**
     * Initializes the collBookingssRelatedByAuthorId collection.
     *
     * By default this just sets the collBookingssRelatedByAuthorId collection to an empty array (like clearcollBookingssRelatedByAuthorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingssRelatedByAuthorId($overrideExisting = true)
    {
        if (null !== $this->collBookingssRelatedByAuthorId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingssRelatedByAuthorId = new $collectionClassName;
        $this->collBookingssRelatedByAuthorId->setModel('\TheFarm\Models\Bookings');
    }

    /**
     * Gets an array of ChildBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     * @throws PropelException
     */
    public function getBookingssRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingssRelatedByAuthorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingssRelatedByAuthorId) {
                // return empty collection
                $this->initBookingssRelatedByAuthorId();
            } else {
                $collBookingssRelatedByAuthorId = ChildBookingsQuery::create(null, $criteria)
                    ->filterByContactRelatedByAuthorId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingssRelatedByAuthorIdPartial && count($collBookingssRelatedByAuthorId)) {
                        $this->initBookingssRelatedByAuthorId(false);

                        foreach ($collBookingssRelatedByAuthorId as $obj) {
                            if (false == $this->collBookingssRelatedByAuthorId->contains($obj)) {
                                $this->collBookingssRelatedByAuthorId->append($obj);
                            }
                        }

                        $this->collBookingssRelatedByAuthorIdPartial = true;
                    }

                    return $collBookingssRelatedByAuthorId;
                }

                if ($partial && $this->collBookingssRelatedByAuthorId) {
                    foreach ($this->collBookingssRelatedByAuthorId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingssRelatedByAuthorId[] = $obj;
                        }
                    }
                }

                $this->collBookingssRelatedByAuthorId = $collBookingssRelatedByAuthorId;
                $this->collBookingssRelatedByAuthorIdPartial = false;
            }
        }

        return $this->collBookingssRelatedByAuthorId;
    }

    /**
     * Sets a collection of ChildBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingssRelatedByAuthorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingssRelatedByAuthorId(Collection $bookingssRelatedByAuthorId, ConnectionInterface $con = null)
    {
        /** @var ChildBookings[] $bookingssRelatedByAuthorIdToDelete */
        $bookingssRelatedByAuthorIdToDelete = $this->getBookingssRelatedByAuthorId(new Criteria(), $con)->diff($bookingssRelatedByAuthorId);


        $this->bookingssRelatedByAuthorIdScheduledForDeletion = $bookingssRelatedByAuthorIdToDelete;

        foreach ($bookingssRelatedByAuthorIdToDelete as $bookingsRelatedByAuthorIdRemoved) {
            $bookingsRelatedByAuthorIdRemoved->setContactRelatedByAuthorId(null);
        }

        $this->collBookingssRelatedByAuthorId = null;
        foreach ($bookingssRelatedByAuthorId as $bookingsRelatedByAuthorId) {
            $this->addBookingsRelatedByAuthorId($bookingsRelatedByAuthorId);
        }

        $this->collBookingssRelatedByAuthorId = $bookingssRelatedByAuthorId;
        $this->collBookingssRelatedByAuthorIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Bookings objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Bookings objects.
     * @throws PropelException
     */
    public function countBookingssRelatedByAuthorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssRelatedByAuthorIdPartial && !$this->isNew();
        if (null === $this->collBookingssRelatedByAuthorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingssRelatedByAuthorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingssRelatedByAuthorId());
            }

            $query = ChildBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByAuthorId($this)
                ->count($con);
        }

        return count($this->collBookingssRelatedByAuthorId);
    }

    /**
     * Method called to associate a ChildBookings object to this object
     * through the ChildBookings foreign key attribute.
     *
     * @param  ChildBookings $l ChildBookings
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingsRelatedByAuthorId(ChildBookings $l)
    {
        if ($this->collBookingssRelatedByAuthorId === null) {
            $this->initBookingssRelatedByAuthorId();
            $this->collBookingssRelatedByAuthorIdPartial = true;
        }

        if (!$this->collBookingssRelatedByAuthorId->contains($l)) {
            $this->doAddBookingsRelatedByAuthorId($l);

            if ($this->bookingssRelatedByAuthorIdScheduledForDeletion and $this->bookingssRelatedByAuthorIdScheduledForDeletion->contains($l)) {
                $this->bookingssRelatedByAuthorIdScheduledForDeletion->remove($this->bookingssRelatedByAuthorIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookings $bookingsRelatedByAuthorId The ChildBookings object to add.
     */
    protected function doAddBookingsRelatedByAuthorId(ChildBookings $bookingsRelatedByAuthorId)
    {
        $this->collBookingssRelatedByAuthorId[]= $bookingsRelatedByAuthorId;
        $bookingsRelatedByAuthorId->setContactRelatedByAuthorId($this);
    }

    /**
     * @param  ChildBookings $bookingsRelatedByAuthorId The ChildBookings object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingsRelatedByAuthorId(ChildBookings $bookingsRelatedByAuthorId)
    {
        if ($this->getBookingssRelatedByAuthorId()->contains($bookingsRelatedByAuthorId)) {
            $pos = $this->collBookingssRelatedByAuthorId->search($bookingsRelatedByAuthorId);
            $this->collBookingssRelatedByAuthorId->remove($pos);
            if (null === $this->bookingssRelatedByAuthorIdScheduledForDeletion) {
                $this->bookingssRelatedByAuthorIdScheduledForDeletion = clone $this->collBookingssRelatedByAuthorId;
                $this->bookingssRelatedByAuthorIdScheduledForDeletion->clear();
            }
            $this->bookingssRelatedByAuthorIdScheduledForDeletion[]= $bookingsRelatedByAuthorId;
            $bookingsRelatedByAuthorId->setContactRelatedByAuthorId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByAuthorIdJoinPackages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Packages', $joinBehavior);

        return $this->getBookingssRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByAuthorIdJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingssRelatedByAuthorId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByAuthorId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByAuthorIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingssRelatedByAuthorId($query, $con);
    }

    /**
     * Clears out the collBookingssRelatedByGuestId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingssRelatedByGuestId()
     */
    public function clearBookingssRelatedByGuestId()
    {
        $this->collBookingssRelatedByGuestId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingssRelatedByGuestId collection loaded partially.
     */
    public function resetPartialBookingssRelatedByGuestId($v = true)
    {
        $this->collBookingssRelatedByGuestIdPartial = $v;
    }

    /**
     * Initializes the collBookingssRelatedByGuestId collection.
     *
     * By default this just sets the collBookingssRelatedByGuestId collection to an empty array (like clearcollBookingssRelatedByGuestId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingssRelatedByGuestId($overrideExisting = true)
    {
        if (null !== $this->collBookingssRelatedByGuestId && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingssRelatedByGuestId = new $collectionClassName;
        $this->collBookingssRelatedByGuestId->setModel('\TheFarm\Models\Bookings');
    }

    /**
     * Gets an array of ChildBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     * @throws PropelException
     */
    public function getBookingssRelatedByGuestId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssRelatedByGuestIdPartial && !$this->isNew();
        if (null === $this->collBookingssRelatedByGuestId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingssRelatedByGuestId) {
                // return empty collection
                $this->initBookingssRelatedByGuestId();
            } else {
                $collBookingssRelatedByGuestId = ChildBookingsQuery::create(null, $criteria)
                    ->filterByContactRelatedByGuestId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingssRelatedByGuestIdPartial && count($collBookingssRelatedByGuestId)) {
                        $this->initBookingssRelatedByGuestId(false);

                        foreach ($collBookingssRelatedByGuestId as $obj) {
                            if (false == $this->collBookingssRelatedByGuestId->contains($obj)) {
                                $this->collBookingssRelatedByGuestId->append($obj);
                            }
                        }

                        $this->collBookingssRelatedByGuestIdPartial = true;
                    }

                    return $collBookingssRelatedByGuestId;
                }

                if ($partial && $this->collBookingssRelatedByGuestId) {
                    foreach ($this->collBookingssRelatedByGuestId as $obj) {
                        if ($obj->isNew()) {
                            $collBookingssRelatedByGuestId[] = $obj;
                        }
                    }
                }

                $this->collBookingssRelatedByGuestId = $collBookingssRelatedByGuestId;
                $this->collBookingssRelatedByGuestIdPartial = false;
            }
        }

        return $this->collBookingssRelatedByGuestId;
    }

    /**
     * Sets a collection of ChildBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingssRelatedByGuestId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setBookingssRelatedByGuestId(Collection $bookingssRelatedByGuestId, ConnectionInterface $con = null)
    {
        /** @var ChildBookings[] $bookingssRelatedByGuestIdToDelete */
        $bookingssRelatedByGuestIdToDelete = $this->getBookingssRelatedByGuestId(new Criteria(), $con)->diff($bookingssRelatedByGuestId);


        $this->bookingssRelatedByGuestIdScheduledForDeletion = $bookingssRelatedByGuestIdToDelete;

        foreach ($bookingssRelatedByGuestIdToDelete as $bookingsRelatedByGuestIdRemoved) {
            $bookingsRelatedByGuestIdRemoved->setContactRelatedByGuestId(null);
        }

        $this->collBookingssRelatedByGuestId = null;
        foreach ($bookingssRelatedByGuestId as $bookingsRelatedByGuestId) {
            $this->addBookingsRelatedByGuestId($bookingsRelatedByGuestId);
        }

        $this->collBookingssRelatedByGuestId = $bookingssRelatedByGuestId;
        $this->collBookingssRelatedByGuestIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Bookings objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Bookings objects.
     * @throws PropelException
     */
    public function countBookingssRelatedByGuestId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssRelatedByGuestIdPartial && !$this->isNew();
        if (null === $this->collBookingssRelatedByGuestId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingssRelatedByGuestId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingssRelatedByGuestId());
            }

            $query = ChildBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContactRelatedByGuestId($this)
                ->count($con);
        }

        return count($this->collBookingssRelatedByGuestId);
    }

    /**
     * Method called to associate a ChildBookings object to this object
     * through the ChildBookings foreign key attribute.
     *
     * @param  ChildBookings $l ChildBookings
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addBookingsRelatedByGuestId(ChildBookings $l)
    {
        if ($this->collBookingssRelatedByGuestId === null) {
            $this->initBookingssRelatedByGuestId();
            $this->collBookingssRelatedByGuestIdPartial = true;
        }

        if (!$this->collBookingssRelatedByGuestId->contains($l)) {
            $this->doAddBookingsRelatedByGuestId($l);

            if ($this->bookingssRelatedByGuestIdScheduledForDeletion and $this->bookingssRelatedByGuestIdScheduledForDeletion->contains($l)) {
                $this->bookingssRelatedByGuestIdScheduledForDeletion->remove($this->bookingssRelatedByGuestIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookings $bookingsRelatedByGuestId The ChildBookings object to add.
     */
    protected function doAddBookingsRelatedByGuestId(ChildBookings $bookingsRelatedByGuestId)
    {
        $this->collBookingssRelatedByGuestId[]= $bookingsRelatedByGuestId;
        $bookingsRelatedByGuestId->setContactRelatedByGuestId($this);
    }

    /**
     * @param  ChildBookings $bookingsRelatedByGuestId The ChildBookings object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeBookingsRelatedByGuestId(ChildBookings $bookingsRelatedByGuestId)
    {
        if ($this->getBookingssRelatedByGuestId()->contains($bookingsRelatedByGuestId)) {
            $pos = $this->collBookingssRelatedByGuestId->search($bookingsRelatedByGuestId);
            $this->collBookingssRelatedByGuestId->remove($pos);
            if (null === $this->bookingssRelatedByGuestIdScheduledForDeletion) {
                $this->bookingssRelatedByGuestIdScheduledForDeletion = clone $this->collBookingssRelatedByGuestId;
                $this->bookingssRelatedByGuestIdScheduledForDeletion->clear();
            }
            $this->bookingssRelatedByGuestIdScheduledForDeletion[]= $bookingsRelatedByGuestId;
            $bookingsRelatedByGuestId->setContactRelatedByGuestId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByGuestIdJoinPackages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Packages', $joinBehavior);

        return $this->getBookingssRelatedByGuestId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByGuestIdJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingssRelatedByGuestId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Contact is new, it will return
     * an empty collection; or if this Contact has previously
     * been saved, it will retrieve related BookingssRelatedByGuestId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Contact.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssRelatedByGuestIdJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingssRelatedByGuestId($query, $con);
    }

    /**
     * Clears out the collItemsRelatedUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemsRelatedUserss()
     */
    public function clearItemsRelatedUserss()
    {
        $this->collItemsRelatedUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemsRelatedUserss collection loaded partially.
     */
    public function resetPartialItemsRelatedUserss($v = true)
    {
        $this->collItemsRelatedUserssPartial = $v;
    }

    /**
     * Initializes the collItemsRelatedUserss collection.
     *
     * By default this just sets the collItemsRelatedUserss collection to an empty array (like clearcollItemsRelatedUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemsRelatedUserss($overrideExisting = true)
    {
        if (null !== $this->collItemsRelatedUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemsRelatedUsersTableMap::getTableMap()->getCollectionClassName();

        $this->collItemsRelatedUserss = new $collectionClassName;
        $this->collItemsRelatedUserss->setModel('\TheFarm\Models\ItemsRelatedUsers');
    }

    /**
     * Gets an array of ChildItemsRelatedUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildContact is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemsRelatedUsers[] List of ChildItemsRelatedUsers objects
     * @throws PropelException
     */
    public function getItemsRelatedUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedUserssPartial && !$this->isNew();
        if (null === $this->collItemsRelatedUserss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedUserss) {
                // return empty collection
                $this->initItemsRelatedUserss();
            } else {
                $collItemsRelatedUserss = ChildItemsRelatedUsersQuery::create(null, $criteria)
                    ->filterByContact($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemsRelatedUserssPartial && count($collItemsRelatedUserss)) {
                        $this->initItemsRelatedUserss(false);

                        foreach ($collItemsRelatedUserss as $obj) {
                            if (false == $this->collItemsRelatedUserss->contains($obj)) {
                                $this->collItemsRelatedUserss->append($obj);
                            }
                        }

                        $this->collItemsRelatedUserssPartial = true;
                    }

                    return $collItemsRelatedUserss;
                }

                if ($partial && $this->collItemsRelatedUserss) {
                    foreach ($this->collItemsRelatedUserss as $obj) {
                        if ($obj->isNew()) {
                            $collItemsRelatedUserss[] = $obj;
                        }
                    }
                }

                $this->collItemsRelatedUserss = $collItemsRelatedUserss;
                $this->collItemsRelatedUserssPartial = false;
            }
        }

        return $this->collItemsRelatedUserss;
    }

    /**
     * Sets a collection of ChildItemsRelatedUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemsRelatedUserss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function setItemsRelatedUserss(Collection $itemsRelatedUserss, ConnectionInterface $con = null)
    {
        /** @var ChildItemsRelatedUsers[] $itemsRelatedUserssToDelete */
        $itemsRelatedUserssToDelete = $this->getItemsRelatedUserss(new Criteria(), $con)->diff($itemsRelatedUserss);


        $this->itemsRelatedUserssScheduledForDeletion = $itemsRelatedUserssToDelete;

        foreach ($itemsRelatedUserssToDelete as $itemsRelatedUsersRemoved) {
            $itemsRelatedUsersRemoved->setContact(null);
        }

        $this->collItemsRelatedUserss = null;
        foreach ($itemsRelatedUserss as $itemsRelatedUsers) {
            $this->addItemsRelatedUsers($itemsRelatedUsers);
        }

        $this->collItemsRelatedUserss = $itemsRelatedUserss;
        $this->collItemsRelatedUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemsRelatedUsers objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemsRelatedUsers objects.
     * @throws PropelException
     */
    public function countItemsRelatedUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedUserssPartial && !$this->isNew();
        if (null === $this->collItemsRelatedUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemsRelatedUserss());
            }

            $query = ChildItemsRelatedUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByContact($this)
                ->count($con);
        }

        return count($this->collItemsRelatedUserss);
    }

    /**
     * Method called to associate a ChildItemsRelatedUsers object to this object
     * through the ChildItemsRelatedUsers foreign key attribute.
     *
     * @param  ChildItemsRelatedUsers $l ChildItemsRelatedUsers
     * @return $this|\TheFarm\Models\Contact The current object (for fluent API support)
     */
    public function addItemsRelatedUsers(ChildItemsRelatedUsers $l)
    {
        if ($this->collItemsRelatedUserss === null) {
            $this->initItemsRelatedUserss();
            $this->collItemsRelatedUserssPartial = true;
        }

        if (!$this->collItemsRelatedUserss->contains($l)) {
            $this->doAddItemsRelatedUsers($l);

            if ($this->itemsRelatedUserssScheduledForDeletion and $this->itemsRelatedUserssScheduledForDeletion->contains($l)) {
                $this->itemsRelatedUserssScheduledForDeletion->remove($this->itemsRelatedUserssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemsRelatedUsers $itemsRelatedUsers The ChildItemsRelatedUsers object to add.
     */
    protected function doAddItemsRelatedUsers(ChildItemsRelatedUsers $itemsRelatedUsers)
    {
        $this->collItemsRelatedUserss[]= $itemsRelatedUsers;
        $itemsRelatedUsers->setContact($this);
    }

    /**
     * @param  ChildItemsRelatedUsers $itemsRelatedUsers The ChildItemsRelatedUsers object to remove.
     * @return $this|ChildContact The current object (for fluent API support)
     */
    public function removeItemsRelatedUsers(ChildItemsRelatedUsers $itemsRelatedUsers)
    {
        if ($this->getItemsRelatedUserss()->contains($itemsRelatedUsers)) {
            $pos = $this->collItemsRelatedUserss->search($itemsRelatedUsers);
            $this->collItemsRelatedUserss->remove($pos);
            if (null === $this->itemsRelatedUserssScheduledForDeletion) {
                $this->itemsRelatedUserssScheduledForDeletion = clone $this->collItemsRelatedUserss;
                $this->itemsRelatedUserssScheduledForDeletion->clear();
            }
            $this->itemsRelatedUserssScheduledForDeletion[]= clone $itemsRelatedUsers;
            $itemsRelatedUsers->setContact(null);
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
            if ($this->collBookingEventUserss) {
                foreach ($this->collBookingEventUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventssRelatedByAuthorId) {
                foreach ($this->collBookingEventssRelatedByAuthorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventssRelatedByCalledBy) {
                foreach ($this->collBookingEventssRelatedByCalledBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventssRelatedByCancelledBy) {
                foreach ($this->collBookingEventssRelatedByCancelledBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingEventssRelatedByDeletedBy) {
                foreach ($this->collBookingEventssRelatedByDeletedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingssRelatedByAuthorId) {
                foreach ($this->collBookingssRelatedByAuthorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingssRelatedByGuestId) {
                foreach ($this->collBookingssRelatedByGuestId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemsRelatedUserss) {
                foreach ($this->collItemsRelatedUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleUser) {
                $this->singleUser->clearAllReferences($deep);
            }
        } // if ($deep)

        $this->collBookingEventUserss = null;
        $this->collBookingEventssRelatedByAuthorId = null;
        $this->collBookingEventssRelatedByCalledBy = null;
        $this->collBookingEventssRelatedByCancelledBy = null;
        $this->collBookingEventssRelatedByDeletedBy = null;
        $this->collBookingssRelatedByAuthorId = null;
        $this->collBookingssRelatedByGuestId = null;
        $this->collItemsRelatedUserss = null;
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
