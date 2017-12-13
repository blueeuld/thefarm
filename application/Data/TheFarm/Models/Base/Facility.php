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
use TheFarm\Models\BookingEvent as ChildBookingEvent;
use TheFarm\Models\BookingEventQuery as ChildBookingEventQuery;
use TheFarm\Models\Facility as ChildFacility;
use TheFarm\Models\FacilityQuery as ChildFacilityQuery;
use TheFarm\Models\ItemsRelatedFacility as ChildItemsRelatedFacility;
use TheFarm\Models\ItemsRelatedFacilityQuery as ChildItemsRelatedFacilityQuery;
use TheFarm\Models\Location as ChildLocation;
use TheFarm\Models\LocationQuery as ChildLocationQuery;
use TheFarm\Models\Map\BookingEventTableMap;
use TheFarm\Models\Map\FacilityTableMap;
use TheFarm\Models\Map\ItemsRelatedFacilityTableMap;

/**
 * Base class that represents a row from the 'tf_facilities' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Facility implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\FacilityTableMap';


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
     * The value for the facility_id field.
     *
     * @var        int
     */
    protected $facility_id;

    /**
     * The value for the facility_name field.
     *
     * @var        string
     */
    protected $facility_name;

    /**
     * The value for the bg_color field.
     *
     * @var        string
     */
    protected $bg_color;

    /**
     * The value for the max_accomodation field.
     *
     * @var        int
     */
    protected $max_accomodation;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the abbr field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $abbr;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $status;

    /**
     * @var        ChildLocation
     */
    protected $aLocation;

    /**
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEvents;
    protected $collBookingEventsPartial;

    /**
     * @var        ObjectCollection|ChildItemsRelatedFacility[] Collection to store aggregation of ChildItemsRelatedFacility objects.
     */
    protected $collItemsRelatedFacilities;
    protected $collItemsRelatedFacilitiesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemsRelatedFacility[]
     */
    protected $itemsRelatedFacilitiesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->abbr = '';
        $this->status = 1;
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Facility object.
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
     * Compares this with another <code>Facility</code> instance.  If
     * <code>obj</code> is an instance of <code>Facility</code>, delegates to
     * <code>equals(Facility)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Facility The current object, for fluid interface
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
     * Get the [facility_id] column value.
     *
     * @return int
     */
    public function getFacilityId()
    {
        return $this->facility_id;
    }

    /**
     * Get the [facility_name] column value.
     *
     * @return string
     */
    public function getFacilityName()
    {
        return $this->facility_name;
    }

    /**
     * Get the [bg_color] column value.
     *
     * @return string
     */
    public function getBgColor()
    {
        return $this->bg_color;
    }

    /**
     * Get the [max_accomodation] column value.
     *
     * @return int
     */
    public function getMaxAccomodation()
    {
        return $this->max_accomodation;
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
     * Get the [abbr] column value.
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of [facility_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setFacilityId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->facility_id !== $v) {
            $this->facility_id = $v;
            $this->modifiedColumns[FacilityTableMap::COL_FACILITY_ID] = true;
        }

        return $this;
    } // setFacilityId()

    /**
     * Set the value of [facility_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setFacilityName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->facility_name !== $v) {
            $this->facility_name = $v;
            $this->modifiedColumns[FacilityTableMap::COL_FACILITY_NAME] = true;
        }

        return $this;
    } // setFacilityName()

    /**
     * Set the value of [bg_color] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setBgColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bg_color !== $v) {
            $this->bg_color = $v;
            $this->modifiedColumns[FacilityTableMap::COL_BG_COLOR] = true;
        }

        return $this;
    } // setBgColor()

    /**
     * Set the value of [max_accomodation] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setMaxAccomodation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_accomodation !== $v) {
            $this->max_accomodation = $v;
            $this->modifiedColumns[FacilityTableMap::COL_MAX_ACCOMODATION] = true;
        }

        return $this;
    } // setMaxAccomodation()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[FacilityTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aLocation !== null && $this->aLocation->getLocationId() !== $v) {
            $this->aLocation = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [abbr] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setAbbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->abbr !== $v) {
            $this->abbr = $v;
            $this->modifiedColumns[FacilityTableMap::COL_ABBR] = true;
        }

        return $this;
    } // setAbbr()

    /**
     * Set the value of [status] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[FacilityTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

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
            if ($this->abbr !== '') {
                return false;
            }

            if ($this->status !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FacilityTableMap::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->facility_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FacilityTableMap::translateFieldName('FacilityName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->facility_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FacilityTableMap::translateFieldName('BgColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bg_color = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FacilityTableMap::translateFieldName('MaxAccomodation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_accomodation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FacilityTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FacilityTableMap::translateFieldName('Abbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->abbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FacilityTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = FacilityTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Facility'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FacilityTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFacilityQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLocation = null;
            $this->collBookingEvents = null;

            $this->collItemsRelatedFacilities = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Facility::setDeleted()
     * @see Facility::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFacilityQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
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
                FacilityTableMap::addInstanceToPool($this);
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

            if ($this->itemsRelatedFacilitiesScheduledForDeletion !== null) {
                if (!$this->itemsRelatedFacilitiesScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemsRelatedFacilityQuery::create()
                        ->filterByPrimaryKeys($this->itemsRelatedFacilitiesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemsRelatedFacilitiesScheduledForDeletion = null;
                }
            }

            if ($this->collItemsRelatedFacilities !== null) {
                foreach ($this->collItemsRelatedFacilities as $referrerFK) {
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

        $this->modifiedColumns[FacilityTableMap::COL_FACILITY_ID] = true;
        if (null !== $this->facility_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FacilityTableMap::COL_FACILITY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FacilityTableMap::COL_FACILITY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'facility_id';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_FACILITY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'facility_name';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_BG_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'bg_color';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_MAX_ACCOMODATION)) {
            $modifiedColumns[':p' . $index++]  = 'max_accomodation';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_ABBR)) {
            $modifiedColumns[':p' . $index++]  = 'abbr';
        }
        if ($this->isColumnModified(FacilityTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }

        $sql = sprintf(
            'INSERT INTO tf_facilities (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'facility_id':
                        $stmt->bindValue($identifier, $this->facility_id, PDO::PARAM_INT);
                        break;
                    case 'facility_name':
                        $stmt->bindValue($identifier, $this->facility_name, PDO::PARAM_STR);
                        break;
                    case 'bg_color':
                        $stmt->bindValue($identifier, $this->bg_color, PDO::PARAM_STR);
                        break;
                    case 'max_accomodation':
                        $stmt->bindValue($identifier, $this->max_accomodation, PDO::PARAM_INT);
                        break;
                    case 'location_id':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'abbr':
                        $stmt->bindValue($identifier, $this->abbr, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
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
        $this->setFacilityId($pk);

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
        $pos = FacilityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFacilityId();
                break;
            case 1:
                return $this->getFacilityName();
                break;
            case 2:
                return $this->getBgColor();
                break;
            case 3:
                return $this->getMaxAccomodation();
                break;
            case 4:
                return $this->getLocationId();
                break;
            case 5:
                return $this->getAbbr();
                break;
            case 6:
                return $this->getStatus();
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

        if (isset($alreadyDumpedObjects['Facility'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Facility'][$this->hashCode()] = true;
        $keys = FacilityTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFacilityId(),
            $keys[1] => $this->getFacilityName(),
            $keys[2] => $this->getBgColor(),
            $keys[3] => $this->getMaxAccomodation(),
            $keys[4] => $this->getLocationId(),
            $keys[5] => $this->getAbbr(),
            $keys[6] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collItemsRelatedFacilities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemsRelatedFacilities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items_related_facilitiess';
                        break;
                    default:
                        $key = 'ItemsRelatedFacilities';
                }

                $result[$key] = $this->collItemsRelatedFacilities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Facility
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FacilityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Facility
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFacilityId($value);
                break;
            case 1:
                $this->setFacilityName($value);
                break;
            case 2:
                $this->setBgColor($value);
                break;
            case 3:
                $this->setMaxAccomodation($value);
                break;
            case 4:
                $this->setLocationId($value);
                break;
            case 5:
                $this->setAbbr($value);
                break;
            case 6:
                $this->setStatus($value);
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
        $keys = FacilityTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFacilityId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFacilityName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBgColor($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMaxAccomodation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLocationId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAbbr($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
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
     * @return $this|\TheFarm\Models\Facility The current object, for fluid interface
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
        $criteria = new Criteria(FacilityTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FacilityTableMap::COL_FACILITY_ID)) {
            $criteria->add(FacilityTableMap::COL_FACILITY_ID, $this->facility_id);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_FACILITY_NAME)) {
            $criteria->add(FacilityTableMap::COL_FACILITY_NAME, $this->facility_name);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_BG_COLOR)) {
            $criteria->add(FacilityTableMap::COL_BG_COLOR, $this->bg_color);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_MAX_ACCOMODATION)) {
            $criteria->add(FacilityTableMap::COL_MAX_ACCOMODATION, $this->max_accomodation);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_LOCATION_ID)) {
            $criteria->add(FacilityTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_ABBR)) {
            $criteria->add(FacilityTableMap::COL_ABBR, $this->abbr);
        }
        if ($this->isColumnModified(FacilityTableMap::COL_STATUS)) {
            $criteria->add(FacilityTableMap::COL_STATUS, $this->status);
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
        $criteria = ChildFacilityQuery::create();
        $criteria->add(FacilityTableMap::COL_FACILITY_ID, $this->facility_id);

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
        $validPk = null !== $this->getFacilityId();

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
        return $this->getFacilityId();
    }

    /**
     * Generic method to set the primary key (facility_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFacilityId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFacilityId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Facility (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFacilityName($this->getFacilityName());
        $copyObj->setBgColor($this->getBgColor());
        $copyObj->setMaxAccomodation($this->getMaxAccomodation());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setAbbr($this->getAbbr());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEvent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemsRelatedFacilities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemsRelatedFacility($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFacilityId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Facility Clone of current object.
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
     * Declares an association between this object and a ChildLocation object.
     *
     * @param  ChildLocation $v
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
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
            $v->addFacility($this);
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
                $this->aLocation->addFacilities($this);
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
        if ('BookingEvent' == $relationName) {
            $this->initBookingEvents();
            return;
        }
        if ('ItemsRelatedFacility' == $relationName) {
            $this->initItemsRelatedFacilities();
            return;
        }
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
     * If this ChildFacility is new, it will return
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
                    ->filterByFacility($this)
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
     * @return $this|ChildFacility The current object (for fluent API support)
     */
    public function setBookingEvents(Collection $bookingEvents, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsToDelete */
        $bookingEventsToDelete = $this->getBookingEvents(new Criteria(), $con)->diff($bookingEvents);


        $this->bookingEventsScheduledForDeletion = $bookingEventsToDelete;

        foreach ($bookingEventsToDelete as $bookingEventRemoved) {
            $bookingEventRemoved->setFacility(null);
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
                ->filterByFacility($this)
                ->count($con);
        }

        return count($this->collBookingEvents);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
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
        $bookingEvent->setFacility($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEvent The ChildBookingEvent object to remove.
     * @return $this|ChildFacility The current object (for fluent API support)
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
            $bookingEvent->setFacility(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
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
     * Clears out the collItemsRelatedFacilities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemsRelatedFacilities()
     */
    public function clearItemsRelatedFacilities()
    {
        $this->collItemsRelatedFacilities = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemsRelatedFacilities collection loaded partially.
     */
    public function resetPartialItemsRelatedFacilities($v = true)
    {
        $this->collItemsRelatedFacilitiesPartial = $v;
    }

    /**
     * Initializes the collItemsRelatedFacilities collection.
     *
     * By default this just sets the collItemsRelatedFacilities collection to an empty array (like clearcollItemsRelatedFacilities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemsRelatedFacilities($overrideExisting = true)
    {
        if (null !== $this->collItemsRelatedFacilities && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemsRelatedFacilityTableMap::getTableMap()->getCollectionClassName();

        $this->collItemsRelatedFacilities = new $collectionClassName;
        $this->collItemsRelatedFacilities->setModel('\TheFarm\Models\ItemsRelatedFacility');
    }

    /**
     * Gets an array of ChildItemsRelatedFacility objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFacility is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemsRelatedFacility[] List of ChildItemsRelatedFacility objects
     * @throws PropelException
     */
    public function getItemsRelatedFacilities(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedFacilitiesPartial && !$this->isNew();
        if (null === $this->collItemsRelatedFacilities || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedFacilities) {
                // return empty collection
                $this->initItemsRelatedFacilities();
            } else {
                $collItemsRelatedFacilities = ChildItemsRelatedFacilityQuery::create(null, $criteria)
                    ->filterByFacility($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemsRelatedFacilitiesPartial && count($collItemsRelatedFacilities)) {
                        $this->initItemsRelatedFacilities(false);

                        foreach ($collItemsRelatedFacilities as $obj) {
                            if (false == $this->collItemsRelatedFacilities->contains($obj)) {
                                $this->collItemsRelatedFacilities->append($obj);
                            }
                        }

                        $this->collItemsRelatedFacilitiesPartial = true;
                    }

                    return $collItemsRelatedFacilities;
                }

                if ($partial && $this->collItemsRelatedFacilities) {
                    foreach ($this->collItemsRelatedFacilities as $obj) {
                        if ($obj->isNew()) {
                            $collItemsRelatedFacilities[] = $obj;
                        }
                    }
                }

                $this->collItemsRelatedFacilities = $collItemsRelatedFacilities;
                $this->collItemsRelatedFacilitiesPartial = false;
            }
        }

        return $this->collItemsRelatedFacilities;
    }

    /**
     * Sets a collection of ChildItemsRelatedFacility objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemsRelatedFacilities A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFacility The current object (for fluent API support)
     */
    public function setItemsRelatedFacilities(Collection $itemsRelatedFacilities, ConnectionInterface $con = null)
    {
        /** @var ChildItemsRelatedFacility[] $itemsRelatedFacilitiesToDelete */
        $itemsRelatedFacilitiesToDelete = $this->getItemsRelatedFacilities(new Criteria(), $con)->diff($itemsRelatedFacilities);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->itemsRelatedFacilitiesScheduledForDeletion = clone $itemsRelatedFacilitiesToDelete;

        foreach ($itemsRelatedFacilitiesToDelete as $itemsRelatedFacilityRemoved) {
            $itemsRelatedFacilityRemoved->setFacility(null);
        }

        $this->collItemsRelatedFacilities = null;
        foreach ($itemsRelatedFacilities as $itemsRelatedFacility) {
            $this->addItemsRelatedFacility($itemsRelatedFacility);
        }

        $this->collItemsRelatedFacilities = $itemsRelatedFacilities;
        $this->collItemsRelatedFacilitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemsRelatedFacility objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemsRelatedFacility objects.
     * @throws PropelException
     */
    public function countItemsRelatedFacilities(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemsRelatedFacilitiesPartial && !$this->isNew();
        if (null === $this->collItemsRelatedFacilities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemsRelatedFacilities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemsRelatedFacilities());
            }

            $query = ChildItemsRelatedFacilityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFacility($this)
                ->count($con);
        }

        return count($this->collItemsRelatedFacilities);
    }

    /**
     * Method called to associate a ChildItemsRelatedFacility object to this object
     * through the ChildItemsRelatedFacility foreign key attribute.
     *
     * @param  ChildItemsRelatedFacility $l ChildItemsRelatedFacility
     * @return $this|\TheFarm\Models\Facility The current object (for fluent API support)
     */
    public function addItemsRelatedFacility(ChildItemsRelatedFacility $l)
    {
        if ($this->collItemsRelatedFacilities === null) {
            $this->initItemsRelatedFacilities();
            $this->collItemsRelatedFacilitiesPartial = true;
        }

        if (!$this->collItemsRelatedFacilities->contains($l)) {
            $this->doAddItemsRelatedFacility($l);

            if ($this->itemsRelatedFacilitiesScheduledForDeletion and $this->itemsRelatedFacilitiesScheduledForDeletion->contains($l)) {
                $this->itemsRelatedFacilitiesScheduledForDeletion->remove($this->itemsRelatedFacilitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemsRelatedFacility $itemsRelatedFacility The ChildItemsRelatedFacility object to add.
     */
    protected function doAddItemsRelatedFacility(ChildItemsRelatedFacility $itemsRelatedFacility)
    {
        $this->collItemsRelatedFacilities[]= $itemsRelatedFacility;
        $itemsRelatedFacility->setFacility($this);
    }

    /**
     * @param  ChildItemsRelatedFacility $itemsRelatedFacility The ChildItemsRelatedFacility object to remove.
     * @return $this|ChildFacility The current object (for fluent API support)
     */
    public function removeItemsRelatedFacility(ChildItemsRelatedFacility $itemsRelatedFacility)
    {
        if ($this->getItemsRelatedFacilities()->contains($itemsRelatedFacility)) {
            $pos = $this->collItemsRelatedFacilities->search($itemsRelatedFacility);
            $this->collItemsRelatedFacilities->remove($pos);
            if (null === $this->itemsRelatedFacilitiesScheduledForDeletion) {
                $this->itemsRelatedFacilitiesScheduledForDeletion = clone $this->collItemsRelatedFacilities;
                $this->itemsRelatedFacilitiesScheduledForDeletion->clear();
            }
            $this->itemsRelatedFacilitiesScheduledForDeletion[]= clone $itemsRelatedFacility;
            $itemsRelatedFacility->setFacility(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Facility is new, it will return
     * an empty collection; or if this Facility has previously
     * been saved, it will retrieve related ItemsRelatedFacilities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Facility.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemsRelatedFacility[] List of ChildItemsRelatedFacility objects
     */
    public function getItemsRelatedFacilitiesJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemsRelatedFacilityQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getItemsRelatedFacilities($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLocation) {
            $this->aLocation->removeFacility($this);
        }
        $this->facility_id = null;
        $this->facility_name = null;
        $this->bg_color = null;
        $this->max_accomodation = null;
        $this->location_id = null;
        $this->abbr = null;
        $this->status = null;
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
            if ($this->collBookingEvents) {
                foreach ($this->collBookingEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemsRelatedFacilities) {
                foreach ($this->collItemsRelatedFacilities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingEvents = null;
        $this->collItemsRelatedFacilities = null;
        $this->aLocation = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FacilityTableMap::DEFAULT_STRING_FORMAT);
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
