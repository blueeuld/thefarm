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
use TheFarm\Models\BookingForm as ChildBookingForm;
use TheFarm\Models\BookingFormEntry as ChildBookingFormEntry;
use TheFarm\Models\BookingFormEntryQuery as ChildBookingFormEntryQuery;
use TheFarm\Models\BookingFormQuery as ChildBookingFormQuery;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\Form as ChildForm;
use TheFarm\Models\FormQuery as ChildFormQuery;
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\BookingFormEntryTableMap;
use TheFarm\Models\Map\BookingFormTableMap;

/**
 * Base class that represents a row from the 'tf_booking_form' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class BookingForm implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\BookingFormTableMap';


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
     * The value for the booking_form_id field.
     *
     * @var        int
     */
    protected $booking_form_id;

    /**
     * The value for the booking_id field.
     *
     * @var        int
     */
    protected $booking_id;

    /**
     * The value for the form_id field.
     *
     * @var        int
     */
    protected $form_id;

    /**
     * The value for the author_id field.
     *
     * @var        int
     */
    protected $author_id;

    /**
     * The value for the entry_date field.
     *
     * @var        DateTime
     */
    protected $entry_date;

    /**
     * The value for the edit_date field.
     *
     * @var        DateTime
     */
    protected $edit_date;

    /**
     * The value for the completed_by field.
     *
     * @var        int
     */
    protected $completed_by;

    /**
     * The value for the completed_date field.
     *
     * @var        DateTime
     */
    protected $completed_date;

    /**
     * @var        ChildBooking
     */
    protected $aBooking;

    /**
     * @var        ChildForm
     */
    protected $aForm;

    /**
     * @var        ChildUser
     */
    protected $aUserRelatedByAuthorId;

    /**
     * @var        ChildUser
     */
    protected $aUserRelatedByCompletedBy;

    /**
     * @var        ObjectCollection|ChildBookingFormEntry[] Collection to store aggregation of ChildBookingFormEntry objects.
     */
    protected $collBookingFormEntries;
    protected $collBookingFormEntriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingFormEntry[]
     */
    protected $bookingFormEntriesScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\BookingForm object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>BookingForm</code> instance.  If
     * <code>obj</code> is an instance of <code>BookingForm</code>, delegates to
     * <code>equals(BookingForm)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|BookingForm The current object, for fluid interface
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
     * Get the [booking_form_id] column value.
     *
     * @return int
     */
    public function getBookingFormId()
    {
        return $this->booking_form_id;
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
     * Get the [form_id] column value.
     *
     * @return int
     */
    public function getFormId()
    {
        return $this->form_id;
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
     * Get the [optionally formatted] temporal [entry_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEntryDate($format = NULL)
    {
        if ($format === null) {
            return $this->entry_date;
        } else {
            return $this->entry_date instanceof \DateTimeInterface ? $this->entry_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [edit_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEditDate($format = NULL)
    {
        if ($format === null) {
            return $this->edit_date;
        } else {
            return $this->edit_date instanceof \DateTimeInterface ? $this->edit_date->format($format) : null;
        }
    }

    /**
     * Get the [completed_by] column value.
     *
     * @return int
     */
    public function getCompletedBy()
    {
        return $this->completed_by;
    }

    /**
     * Get the [optionally formatted] temporal [completed_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCompletedDate($format = NULL)
    {
        if ($format === null) {
            return $this->completed_date;
        } else {
            return $this->completed_date instanceof \DateTimeInterface ? $this->completed_date->format($format) : null;
        }
    }

    /**
     * Set the value of [booking_form_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setBookingFormId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_form_id !== $v) {
            $this->booking_form_id = $v;
            $this->modifiedColumns[BookingFormTableMap::COL_BOOKING_FORM_ID] = true;
        }

        return $this;
    } // setBookingFormId()

    /**
     * Set the value of [booking_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setBookingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_id !== $v) {
            $this->booking_id = $v;
            $this->modifiedColumns[BookingFormTableMap::COL_BOOKING_ID] = true;
        }

        if ($this->aBooking !== null && $this->aBooking->getBookingId() !== $v) {
            $this->aBooking = null;
        }

        return $this;
    } // setBookingId()

    /**
     * Set the value of [form_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setFormId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->form_id !== $v) {
            $this->form_id = $v;
            $this->modifiedColumns[BookingFormTableMap::COL_FORM_ID] = true;
        }

        if ($this->aForm !== null && $this->aForm->getFormId() !== $v) {
            $this->aForm = null;
        }

        return $this;
    } // setFormId()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[BookingFormTableMap::COL_AUTHOR_ID] = true;
        }

        if ($this->aUserRelatedByAuthorId !== null && $this->aUserRelatedByAuthorId->getUserId() !== $v) {
            $this->aUserRelatedByAuthorId = null;
        }

        return $this;
    } // setAuthorId()

    /**
     * Sets the value of [entry_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->entry_date !== null || $dt !== null) {
            if ($this->entry_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->entry_date->format("Y-m-d H:i:s.u")) {
                $this->entry_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookingFormTableMap::COL_ENTRY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setEntryDate()

    /**
     * Sets the value of [edit_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->edit_date !== null || $dt !== null) {
            if ($this->edit_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->edit_date->format("Y-m-d H:i:s.u")) {
                $this->edit_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookingFormTableMap::COL_EDIT_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setEditDate()

    /**
     * Set the value of [completed_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setCompletedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->completed_by !== $v) {
            $this->completed_by = $v;
            $this->modifiedColumns[BookingFormTableMap::COL_COMPLETED_BY] = true;
        }

        if ($this->aUserRelatedByCompletedBy !== null && $this->aUserRelatedByCompletedBy->getUserId() !== $v) {
            $this->aUserRelatedByCompletedBy = null;
        }

        return $this;
    } // setCompletedBy()

    /**
     * Sets the value of [completed_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function setCompletedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->completed_date !== null || $dt !== null) {
            if ($this->completed_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->completed_date->format("Y-m-d H:i:s.u")) {
                $this->completed_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookingFormTableMap::COL_COMPLETED_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCompletedDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookingFormTableMap::translateFieldName('BookingFormId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_form_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookingFormTableMap::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookingFormTableMap::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookingFormTableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookingFormTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->entry_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookingFormTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->edit_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookingFormTableMap::translateFieldName('CompletedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->completed_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BookingFormTableMap::translateFieldName('CompletedDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->completed_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = BookingFormTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\BookingForm'), 0, $e);
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
        if ($this->aBooking !== null && $this->booking_id !== $this->aBooking->getBookingId()) {
            $this->aBooking = null;
        }
        if ($this->aForm !== null && $this->form_id !== $this->aForm->getFormId()) {
            $this->aForm = null;
        }
        if ($this->aUserRelatedByAuthorId !== null && $this->author_id !== $this->aUserRelatedByAuthorId->getUserId()) {
            $this->aUserRelatedByAuthorId = null;
        }
        if ($this->aUserRelatedByCompletedBy !== null && $this->completed_by !== $this->aUserRelatedByCompletedBy->getUserId()) {
            $this->aUserRelatedByCompletedBy = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BookingFormTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookingFormQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBooking = null;
            $this->aForm = null;
            $this->aUserRelatedByAuthorId = null;
            $this->aUserRelatedByCompletedBy = null;
            $this->collBookingFormEntries = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see BookingForm::setDeleted()
     * @see BookingForm::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookingFormQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormTableMap::DATABASE_NAME);
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
                BookingFormTableMap::addInstanceToPool($this);
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

            if ($this->aBooking !== null) {
                if ($this->aBooking->isModified() || $this->aBooking->isNew()) {
                    $affectedRows += $this->aBooking->save($con);
                }
                $this->setBooking($this->aBooking);
            }

            if ($this->aForm !== null) {
                if ($this->aForm->isModified() || $this->aForm->isNew()) {
                    $affectedRows += $this->aForm->save($con);
                }
                $this->setForm($this->aForm);
            }

            if ($this->aUserRelatedByAuthorId !== null) {
                if ($this->aUserRelatedByAuthorId->isModified() || $this->aUserRelatedByAuthorId->isNew()) {
                    $affectedRows += $this->aUserRelatedByAuthorId->save($con);
                }
                $this->setUserRelatedByAuthorId($this->aUserRelatedByAuthorId);
            }

            if ($this->aUserRelatedByCompletedBy !== null) {
                if ($this->aUserRelatedByCompletedBy->isModified() || $this->aUserRelatedByCompletedBy->isNew()) {
                    $affectedRows += $this->aUserRelatedByCompletedBy->save($con);
                }
                $this->setUserRelatedByCompletedBy($this->aUserRelatedByCompletedBy);
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

            if ($this->bookingFormEntriesScheduledForDeletion !== null) {
                if (!$this->bookingFormEntriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingFormEntriesScheduledForDeletion as $bookingFormEntry) {
                        // need to save related object because we set the relation to null
                        $bookingFormEntry->save($con);
                    }
                    $this->bookingFormEntriesScheduledForDeletion = null;
                }
            }

            if ($this->collBookingFormEntries !== null) {
                foreach ($this->collBookingFormEntries as $referrerFK) {
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

        $this->modifiedColumns[BookingFormTableMap::COL_BOOKING_FORM_ID] = true;
        if (null !== $this->booking_form_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookingFormTableMap::COL_BOOKING_FORM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookingFormTableMap::COL_BOOKING_FORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_form_id';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_BOOKING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_id';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_FORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'form_id';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_COMPLETED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'completed_by';
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_COMPLETED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'completed_date';
        }

        $sql = sprintf(
            'INSERT INTO tf_booking_form (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'booking_form_id':
                        $stmt->bindValue($identifier, $this->booking_form_id, PDO::PARAM_INT);
                        break;
                    case 'booking_id':
                        $stmt->bindValue($identifier, $this->booking_id, PDO::PARAM_INT);
                        break;
                    case 'form_id':
                        $stmt->bindValue($identifier, $this->form_id, PDO::PARAM_INT);
                        break;
                    case 'author_id':
                        $stmt->bindValue($identifier, $this->author_id, PDO::PARAM_INT);
                        break;
                    case 'entry_date':
                        $stmt->bindValue($identifier, $this->entry_date ? $this->entry_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'edit_date':
                        $stmt->bindValue($identifier, $this->edit_date ? $this->edit_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'completed_by':
                        $stmt->bindValue($identifier, $this->completed_by, PDO::PARAM_INT);
                        break;
                    case 'completed_date':
                        $stmt->bindValue($identifier, $this->completed_date ? $this->completed_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $this->setBookingFormId($pk);

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
        $pos = BookingFormTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBookingFormId();
                break;
            case 1:
                return $this->getBookingId();
                break;
            case 2:
                return $this->getFormId();
                break;
            case 3:
                return $this->getAuthorId();
                break;
            case 4:
                return $this->getEntryDate();
                break;
            case 5:
                return $this->getEditDate();
                break;
            case 6:
                return $this->getCompletedBy();
                break;
            case 7:
                return $this->getCompletedDate();
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

        if (isset($alreadyDumpedObjects['BookingForm'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BookingForm'][$this->hashCode()] = true;
        $keys = BookingFormTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBookingFormId(),
            $keys[1] => $this->getBookingId(),
            $keys[2] => $this->getFormId(),
            $keys[3] => $this->getAuthorId(),
            $keys[4] => $this->getEntryDate(),
            $keys[5] => $this->getEditDate(),
            $keys[6] => $this->getCompletedBy(),
            $keys[7] => $this->getCompletedDate(),
        );
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBooking) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'booking';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookings';
                        break;
                    default:
                        $key = 'Booking';
                }

                $result[$key] = $this->aBooking->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aForm) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'form';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_forms';
                        break;
                    default:
                        $key = 'Form';
                }

                $result[$key] = $this->aForm->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByAuthorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUserRelatedByAuthorId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByCompletedBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUserRelatedByCompletedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBookingFormEntries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingFormEntries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_form_entries';
                        break;
                    default:
                        $key = 'BookingFormEntries';
                }

                $result[$key] = $this->collBookingFormEntries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\BookingForm
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookingFormTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\BookingForm
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBookingFormId($value);
                break;
            case 1:
                $this->setBookingId($value);
                break;
            case 2:
                $this->setFormId($value);
                break;
            case 3:
                $this->setAuthorId($value);
                break;
            case 4:
                $this->setEntryDate($value);
                break;
            case 5:
                $this->setEditDate($value);
                break;
            case 6:
                $this->setCompletedBy($value);
                break;
            case 7:
                $this->setCompletedDate($value);
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
        $keys = BookingFormTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBookingFormId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBookingId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFormId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAuthorId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEntryDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEditDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCompletedBy($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompletedDate($arr[$keys[7]]);
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
     * @return $this|\TheFarm\Models\BookingForm The current object, for fluid interface
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
        $criteria = new Criteria(BookingFormTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookingFormTableMap::COL_BOOKING_FORM_ID)) {
            $criteria->add(BookingFormTableMap::COL_BOOKING_FORM_ID, $this->booking_form_id);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_BOOKING_ID)) {
            $criteria->add(BookingFormTableMap::COL_BOOKING_ID, $this->booking_id);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_FORM_ID)) {
            $criteria->add(BookingFormTableMap::COL_FORM_ID, $this->form_id);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_AUTHOR_ID)) {
            $criteria->add(BookingFormTableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_ENTRY_DATE)) {
            $criteria->add(BookingFormTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_EDIT_DATE)) {
            $criteria->add(BookingFormTableMap::COL_EDIT_DATE, $this->edit_date);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_COMPLETED_BY)) {
            $criteria->add(BookingFormTableMap::COL_COMPLETED_BY, $this->completed_by);
        }
        if ($this->isColumnModified(BookingFormTableMap::COL_COMPLETED_DATE)) {
            $criteria->add(BookingFormTableMap::COL_COMPLETED_DATE, $this->completed_date);
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
        $criteria = ChildBookingFormQuery::create();
        $criteria->add(BookingFormTableMap::COL_BOOKING_FORM_ID, $this->booking_form_id);

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
        $validPk = null !== $this->getBookingFormId();

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
        return $this->getBookingFormId();
    }

    /**
     * Generic method to set the primary key (booking_form_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBookingFormId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getBookingFormId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\BookingForm (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBookingId($this->getBookingId());
        $copyObj->setFormId($this->getFormId());
        $copyObj->setAuthorId($this->getAuthorId());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());
        $copyObj->setCompletedBy($this->getCompletedBy());
        $copyObj->setCompletedDate($this->getCompletedDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingFormEntries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingFormEntry($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBookingFormId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\BookingForm Clone of current object.
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
     * Declares an association between this object and a ChildBooking object.
     *
     * @param  ChildBooking $v
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBooking(ChildBooking $v = null)
    {
        if ($v === null) {
            $this->setBookingId(NULL);
        } else {
            $this->setBookingId($v->getBookingId());
        }

        $this->aBooking = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBooking object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingForm($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBooking object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBooking The associated ChildBooking object.
     * @throws PropelException
     */
    public function getBooking(ConnectionInterface $con = null)
    {
        if ($this->aBooking === null && ($this->booking_id !== null)) {
            $this->aBooking = ChildBookingQuery::create()->findPk($this->booking_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBooking->addBookingForms($this);
             */
        }

        return $this->aBooking;
    }

    /**
     * Declares an association between this object and a ChildForm object.
     *
     * @param  ChildForm $v
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     * @throws PropelException
     */
    public function setForm(ChildForm $v = null)
    {
        if ($v === null) {
            $this->setFormId(NULL);
        } else {
            $this->setFormId($v->getFormId());
        }

        $this->aForm = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildForm object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingForm($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildForm object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildForm The associated ChildForm object.
     * @throws PropelException
     */
    public function getForm(ConnectionInterface $con = null)
    {
        if ($this->aForm === null && ($this->form_id !== null)) {
            $this->aForm = ChildFormQuery::create()->findPk($this->form_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aForm->addBookingForms($this);
             */
        }

        return $this->aForm;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByAuthorId(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setAuthorId(NULL);
        } else {
            $this->setAuthorId($v->getUserId());
        }

        $this->aUserRelatedByAuthorId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingFormRelatedByAuthorId($this);
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
    public function getUserRelatedByAuthorId(ConnectionInterface $con = null)
    {
        if ($this->aUserRelatedByAuthorId === null && ($this->author_id !== null)) {
            $this->aUserRelatedByAuthorId = ChildUserQuery::create()->findPk($this->author_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByAuthorId->addBookingFormsRelatedByAuthorId($this);
             */
        }

        return $this->aUserRelatedByAuthorId;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByCompletedBy(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setCompletedBy(NULL);
        } else {
            $this->setCompletedBy($v->getUserId());
        }

        $this->aUserRelatedByCompletedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingFormRelatedByCompletedBy($this);
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
    public function getUserRelatedByCompletedBy(ConnectionInterface $con = null)
    {
        if ($this->aUserRelatedByCompletedBy === null && ($this->completed_by !== null)) {
            $this->aUserRelatedByCompletedBy = ChildUserQuery::create()->findPk($this->completed_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByCompletedBy->addBookingFormsRelatedByCompletedBy($this);
             */
        }

        return $this->aUserRelatedByCompletedBy;
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
        if ('BookingFormEntry' == $relationName) {
            $this->initBookingFormEntries();
            return;
        }
    }

    /**
     * Clears out the collBookingFormEntries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingFormEntries()
     */
    public function clearBookingFormEntries()
    {
        $this->collBookingFormEntries = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingFormEntries collection loaded partially.
     */
    public function resetPartialBookingFormEntries($v = true)
    {
        $this->collBookingFormEntriesPartial = $v;
    }

    /**
     * Initializes the collBookingFormEntries collection.
     *
     * By default this just sets the collBookingFormEntries collection to an empty array (like clearcollBookingFormEntries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingFormEntries($overrideExisting = true)
    {
        if (null !== $this->collBookingFormEntries && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingFormEntryTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingFormEntries = new $collectionClassName;
        $this->collBookingFormEntries->setModel('\TheFarm\Models\BookingFormEntry');
    }

    /**
     * Gets an array of ChildBookingFormEntry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookingForm is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingFormEntry[] List of ChildBookingFormEntry objects
     * @throws PropelException
     */
    public function getBookingFormEntries(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingFormEntriesPartial && !$this->isNew();
        if (null === $this->collBookingFormEntries || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingFormEntries) {
                // return empty collection
                $this->initBookingFormEntries();
            } else {
                $collBookingFormEntries = ChildBookingFormEntryQuery::create(null, $criteria)
                    ->filterByBookingForm($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingFormEntriesPartial && count($collBookingFormEntries)) {
                        $this->initBookingFormEntries(false);

                        foreach ($collBookingFormEntries as $obj) {
                            if (false == $this->collBookingFormEntries->contains($obj)) {
                                $this->collBookingFormEntries->append($obj);
                            }
                        }

                        $this->collBookingFormEntriesPartial = true;
                    }

                    return $collBookingFormEntries;
                }

                if ($partial && $this->collBookingFormEntries) {
                    foreach ($this->collBookingFormEntries as $obj) {
                        if ($obj->isNew()) {
                            $collBookingFormEntries[] = $obj;
                        }
                    }
                }

                $this->collBookingFormEntries = $collBookingFormEntries;
                $this->collBookingFormEntriesPartial = false;
            }
        }

        return $this->collBookingFormEntries;
    }

    /**
     * Sets a collection of ChildBookingFormEntry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingFormEntries A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookingForm The current object (for fluent API support)
     */
    public function setBookingFormEntries(Collection $bookingFormEntries, ConnectionInterface $con = null)
    {
        /** @var ChildBookingFormEntry[] $bookingFormEntriesToDelete */
        $bookingFormEntriesToDelete = $this->getBookingFormEntries(new Criteria(), $con)->diff($bookingFormEntries);


        $this->bookingFormEntriesScheduledForDeletion = $bookingFormEntriesToDelete;

        foreach ($bookingFormEntriesToDelete as $bookingFormEntryRemoved) {
            $bookingFormEntryRemoved->setBookingForm(null);
        }

        $this->collBookingFormEntries = null;
        foreach ($bookingFormEntries as $bookingFormEntry) {
            $this->addBookingFormEntry($bookingFormEntry);
        }

        $this->collBookingFormEntries = $bookingFormEntries;
        $this->collBookingFormEntriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingFormEntry objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingFormEntry objects.
     * @throws PropelException
     */
    public function countBookingFormEntries(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingFormEntriesPartial && !$this->isNew();
        if (null === $this->collBookingFormEntries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingFormEntries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingFormEntries());
            }

            $query = ChildBookingFormEntryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookingForm($this)
                ->count($con);
        }

        return count($this->collBookingFormEntries);
    }

    /**
     * Method called to associate a ChildBookingFormEntry object to this object
     * through the ChildBookingFormEntry foreign key attribute.
     *
     * @param  ChildBookingFormEntry $l ChildBookingFormEntry
     * @return $this|\TheFarm\Models\BookingForm The current object (for fluent API support)
     */
    public function addBookingFormEntry(ChildBookingFormEntry $l)
    {
        if ($this->collBookingFormEntries === null) {
            $this->initBookingFormEntries();
            $this->collBookingFormEntriesPartial = true;
        }

        if (!$this->collBookingFormEntries->contains($l)) {
            $this->doAddBookingFormEntry($l);

            if ($this->bookingFormEntriesScheduledForDeletion and $this->bookingFormEntriesScheduledForDeletion->contains($l)) {
                $this->bookingFormEntriesScheduledForDeletion->remove($this->bookingFormEntriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingFormEntry $bookingFormEntry The ChildBookingFormEntry object to add.
     */
    protected function doAddBookingFormEntry(ChildBookingFormEntry $bookingFormEntry)
    {
        $this->collBookingFormEntries[]= $bookingFormEntry;
        $bookingFormEntry->setBookingForm($this);
    }

    /**
     * @param  ChildBookingFormEntry $bookingFormEntry The ChildBookingFormEntry object to remove.
     * @return $this|ChildBookingForm The current object (for fluent API support)
     */
    public function removeBookingFormEntry(ChildBookingFormEntry $bookingFormEntry)
    {
        if ($this->getBookingFormEntries()->contains($bookingFormEntry)) {
            $pos = $this->collBookingFormEntries->search($bookingFormEntry);
            $this->collBookingFormEntries->remove($pos);
            if (null === $this->bookingFormEntriesScheduledForDeletion) {
                $this->bookingFormEntriesScheduledForDeletion = clone $this->collBookingFormEntries;
                $this->bookingFormEntriesScheduledForDeletion->clear();
            }
            $this->bookingFormEntriesScheduledForDeletion[]= $bookingFormEntry;
            $bookingFormEntry->setBookingForm(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingForm is new, it will return
     * an empty collection; or if this BookingForm has previously
     * been saved, it will retrieve related BookingFormEntries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingForm.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingFormEntry[] List of ChildBookingFormEntry objects
     */
    public function getBookingFormEntriesJoinField(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingFormEntryQuery::create(null, $criteria);
        $query->joinWith('Field', $joinBehavior);

        return $this->getBookingFormEntries($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aBooking) {
            $this->aBooking->removeBookingForm($this);
        }
        if (null !== $this->aForm) {
            $this->aForm->removeBookingForm($this);
        }
        if (null !== $this->aUserRelatedByAuthorId) {
            $this->aUserRelatedByAuthorId->removeBookingFormRelatedByAuthorId($this);
        }
        if (null !== $this->aUserRelatedByCompletedBy) {
            $this->aUserRelatedByCompletedBy->removeBookingFormRelatedByCompletedBy($this);
        }
        $this->booking_form_id = null;
        $this->booking_id = null;
        $this->form_id = null;
        $this->author_id = null;
        $this->entry_date = null;
        $this->edit_date = null;
        $this->completed_by = null;
        $this->completed_date = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collBookingFormEntries) {
                foreach ($this->collBookingFormEntries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingFormEntries = null;
        $this->aBooking = null;
        $this->aForm = null;
        $this->aUserRelatedByAuthorId = null;
        $this->aUserRelatedByCompletedBy = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BookingFormTableMap::DEFAULT_STRING_FORMAT);
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
