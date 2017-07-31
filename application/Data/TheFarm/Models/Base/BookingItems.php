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
use TheFarm\Models\BookingEvents as ChildBookingEvents;
use TheFarm\Models\BookingEventsQuery as ChildBookingEventsQuery;
use TheFarm\Models\BookingItems as ChildBookingItems;
use TheFarm\Models\BookingItemsQuery as ChildBookingItemsQuery;
use TheFarm\Models\Bookings as ChildBookings;
use TheFarm\Models\BookingsQuery as ChildBookingsQuery;
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\Map\BookingEventsTableMap;
use TheFarm\Models\Map\BookingItemsTableMap;

/**
 * Base class that represents a row from the 'tf_booking_items' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class BookingItems implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\BookingItemsTableMap';


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
     * The value for the booking_item_id field.
     *
     * @var        int
     */
    protected $booking_item_id;

    /**
     * The value for the booking_id field.
     *
     * @var        int
     */
    protected $booking_id;

    /**
     * The value for the item_id field.
     *
     * @var        int
     */
    protected $item_id;

    /**
     * The value for the quantity field.
     *
     * @var        int
     */
    protected $quantity;

    /**
     * The value for the included field.
     *
     * @var        int
     */
    protected $included;

    /**
     * The value for the foc field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $foc;

    /**
     * The value for the upsell field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $upsell;

    /**
     * The value for the inventory field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $inventory;

    /**
     * The value for the upgrade field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $upgrade;

    /**
     * @var        ChildBookings
     */
    protected $aBookings;

    /**
     * @var        ChildItems
     */
    protected $aItems;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventss;
    protected $collBookingEventssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->foc = 0;
        $this->upsell = 0;
        $this->inventory = 0;
        $this->upgrade = 0;
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\BookingItems object.
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
     * Compares this with another <code>BookingItems</code> instance.  If
     * <code>obj</code> is an instance of <code>BookingItems</code>, delegates to
     * <code>equals(BookingItems)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|BookingItems The current object, for fluid interface
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
     * Get the [booking_item_id] column value.
     *
     * @return int
     */
    public function getBookingItemId()
    {
        return $this->booking_item_id;
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
     * Get the [item_id] column value.
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Get the [quantity] column value.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the [included] column value.
     *
     * @return int
     */
    public function getIncluded()
    {
        return $this->included;
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
     * Get the [upsell] column value.
     *
     * @return int
     */
    public function getUpsell()
    {
        return $this->upsell;
    }

    /**
     * Get the [inventory] column value.
     *
     * @return int
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Get the [upgrade] column value.
     *
     * @return int
     */
    public function getUpgrade()
    {
        return $this->upgrade;
    }

    /**
     * Set the value of [booking_item_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setBookingItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_item_id !== $v) {
            $this->booking_item_id = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_BOOKING_ITEM_ID] = true;
        }

        return $this;
    } // setBookingItemId()

    /**
     * Set the value of [booking_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setBookingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_id !== $v) {
            $this->booking_id = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_BOOKING_ID] = true;
        }

        if ($this->aBookings !== null && $this->aBookings->getBookingId() !== $v) {
            $this->aBookings = null;
        }

        return $this;
    } // setBookingId()

    /**
     * Set the value of [item_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_id !== $v) {
            $this->item_id = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_ITEM_ID] = true;
        }

        if ($this->aItems !== null && $this->aItems->getItemId() !== $v) {
            $this->aItems = null;
        }

        return $this;
    } // setItemId()

    /**
     * Set the value of [quantity] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_QUANTITY] = true;
        }

        return $this;
    } // setQuantity()

    /**
     * Set the value of [included] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setIncluded($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->included !== $v) {
            $this->included = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_INCLUDED] = true;
        }

        return $this;
    } // setIncluded()

    /**
     * Set the value of [foc] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setFoc($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->foc !== $v) {
            $this->foc = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_FOC] = true;
        }

        return $this;
    } // setFoc()

    /**
     * Set the value of [upsell] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setUpsell($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->upsell !== $v) {
            $this->upsell = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_UPSELL] = true;
        }

        return $this;
    } // setUpsell()

    /**
     * Set the value of [inventory] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setInventory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->inventory !== $v) {
            $this->inventory = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_INVENTORY] = true;
        }

        return $this;
    } // setInventory()

    /**
     * Set the value of [upgrade] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function setUpgrade($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->upgrade !== $v) {
            $this->upgrade = $v;
            $this->modifiedColumns[BookingItemsTableMap::COL_UPGRADE] = true;
        }

        return $this;
    } // setUpgrade()

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
            if ($this->foc !== 0) {
                return false;
            }

            if ($this->upsell !== 0) {
                return false;
            }

            if ($this->inventory !== 0) {
                return false;
            }

            if ($this->upgrade !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookingItemsTableMap::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookingItemsTableMap::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookingItemsTableMap::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookingItemsTableMap::translateFieldName('Quantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookingItemsTableMap::translateFieldName('Included', TableMap::TYPE_PHPNAME, $indexType)];
            $this->included = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookingItemsTableMap::translateFieldName('Foc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->foc = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookingItemsTableMap::translateFieldName('Upsell', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upsell = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BookingItemsTableMap::translateFieldName('Inventory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->inventory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BookingItemsTableMap::translateFieldName('Upgrade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upgrade = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = BookingItemsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\BookingItems'), 0, $e);
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
        if ($this->aBookings !== null && $this->booking_id !== $this->aBookings->getBookingId()) {
            $this->aBookings = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(BookingItemsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookingItemsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBookings = null;
            $this->aItems = null;
            $this->collBookingEventss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see BookingItems::setDeleted()
     * @see BookingItems::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookingItemsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemsTableMap::DATABASE_NAME);
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
                BookingItemsTableMap::addInstanceToPool($this);
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

            if ($this->aBookings !== null) {
                if ($this->aBookings->isModified() || $this->aBookings->isNew()) {
                    $affectedRows += $this->aBookings->save($con);
                }
                $this->setBookings($this->aBookings);
            }

            if ($this->aItems !== null) {
                if ($this->aItems->isModified() || $this->aItems->isNew()) {
                    $affectedRows += $this->aItems->save($con);
                }
                $this->setItems($this->aItems);
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

            if ($this->bookingEventssScheduledForDeletion !== null) {
                if (!$this->bookingEventssScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventssScheduledForDeletion as $bookingEvents) {
                        // need to save related object because we set the relation to null
                        $bookingEvents->save($con);
                    }
                    $this->bookingEventssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEventss !== null) {
                foreach ($this->collBookingEventss as $referrerFK) {
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

        $this->modifiedColumns[BookingItemsTableMap::COL_BOOKING_ITEM_ID] = true;
        if (null !== $this->booking_item_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookingItemsTableMap::COL_BOOKING_ITEM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookingItemsTableMap::COL_BOOKING_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_item_id';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_BOOKING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_id';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'item_id';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = 'quantity';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_INCLUDED)) {
            $modifiedColumns[':p' . $index++]  = 'included';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_FOC)) {
            $modifiedColumns[':p' . $index++]  = 'foc';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_UPSELL)) {
            $modifiedColumns[':p' . $index++]  = 'upsell';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_INVENTORY)) {
            $modifiedColumns[':p' . $index++]  = 'inventory';
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_UPGRADE)) {
            $modifiedColumns[':p' . $index++]  = 'upgrade';
        }

        $sql = sprintf(
            'INSERT INTO tf_booking_items (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'booking_item_id':
                        $stmt->bindValue($identifier, $this->booking_item_id, PDO::PARAM_INT);
                        break;
                    case 'booking_id':
                        $stmt->bindValue($identifier, $this->booking_id, PDO::PARAM_INT);
                        break;
                    case 'item_id':
                        $stmt->bindValue($identifier, $this->item_id, PDO::PARAM_INT);
                        break;
                    case 'quantity':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_INT);
                        break;
                    case 'included':
                        $stmt->bindValue($identifier, $this->included, PDO::PARAM_INT);
                        break;
                    case 'foc':
                        $stmt->bindValue($identifier, $this->foc, PDO::PARAM_INT);
                        break;
                    case 'upsell':
                        $stmt->bindValue($identifier, $this->upsell, PDO::PARAM_INT);
                        break;
                    case 'inventory':
                        $stmt->bindValue($identifier, $this->inventory, PDO::PARAM_INT);
                        break;
                    case 'upgrade':
                        $stmt->bindValue($identifier, $this->upgrade, PDO::PARAM_INT);
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
        $this->setBookingItemId($pk);

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
        $pos = BookingItemsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBookingItemId();
                break;
            case 1:
                return $this->getBookingId();
                break;
            case 2:
                return $this->getItemId();
                break;
            case 3:
                return $this->getQuantity();
                break;
            case 4:
                return $this->getIncluded();
                break;
            case 5:
                return $this->getFoc();
                break;
            case 6:
                return $this->getUpsell();
                break;
            case 7:
                return $this->getInventory();
                break;
            case 8:
                return $this->getUpgrade();
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

        if (isset($alreadyDumpedObjects['BookingItems'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BookingItems'][$this->hashCode()] = true;
        $keys = BookingItemsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBookingItemId(),
            $keys[1] => $this->getBookingId(),
            $keys[2] => $this->getItemId(),
            $keys[3] => $this->getQuantity(),
            $keys[4] => $this->getIncluded(),
            $keys[5] => $this->getFoc(),
            $keys[6] => $this->getUpsell(),
            $keys[7] => $this->getInventory(),
            $keys[8] => $this->getUpgrade(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBookings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookings';
                        break;
                    default:
                        $key = 'Bookings';
                }

                $result[$key] = $this->aBookings->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBookingEventss) {

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

                $result[$key] = $this->collBookingEventss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\BookingItems
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookingItemsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\BookingItems
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBookingItemId($value);
                break;
            case 1:
                $this->setBookingId($value);
                break;
            case 2:
                $this->setItemId($value);
                break;
            case 3:
                $this->setQuantity($value);
                break;
            case 4:
                $this->setIncluded($value);
                break;
            case 5:
                $this->setFoc($value);
                break;
            case 6:
                $this->setUpsell($value);
                break;
            case 7:
                $this->setInventory($value);
                break;
            case 8:
                $this->setUpgrade($value);
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
        $keys = BookingItemsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBookingItemId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBookingId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setItemId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setQuantity($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIncluded($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFoc($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpsell($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setInventory($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpgrade($arr[$keys[8]]);
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
     * @return $this|\TheFarm\Models\BookingItems The current object, for fluid interface
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
        $criteria = new Criteria(BookingItemsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookingItemsTableMap::COL_BOOKING_ITEM_ID)) {
            $criteria->add(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $this->booking_item_id);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_BOOKING_ID)) {
            $criteria->add(BookingItemsTableMap::COL_BOOKING_ID, $this->booking_id);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_ITEM_ID)) {
            $criteria->add(BookingItemsTableMap::COL_ITEM_ID, $this->item_id);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_QUANTITY)) {
            $criteria->add(BookingItemsTableMap::COL_QUANTITY, $this->quantity);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_INCLUDED)) {
            $criteria->add(BookingItemsTableMap::COL_INCLUDED, $this->included);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_FOC)) {
            $criteria->add(BookingItemsTableMap::COL_FOC, $this->foc);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_UPSELL)) {
            $criteria->add(BookingItemsTableMap::COL_UPSELL, $this->upsell);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_INVENTORY)) {
            $criteria->add(BookingItemsTableMap::COL_INVENTORY, $this->inventory);
        }
        if ($this->isColumnModified(BookingItemsTableMap::COL_UPGRADE)) {
            $criteria->add(BookingItemsTableMap::COL_UPGRADE, $this->upgrade);
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
        $criteria = ChildBookingItemsQuery::create();
        $criteria->add(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $this->booking_item_id);

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
        $validPk = null !== $this->getBookingItemId();

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
        return $this->getBookingItemId();
    }

    /**
     * Generic method to set the primary key (booking_item_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBookingItemId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getBookingItemId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\BookingItems (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBookingId($this->getBookingId());
        $copyObj->setItemId($this->getItemId());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setIncluded($this->getIncluded());
        $copyObj->setFoc($this->getFoc());
        $copyObj->setUpsell($this->getUpsell());
        $copyObj->setInventory($this->getInventory());
        $copyObj->setUpgrade($this->getUpgrade());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingEventss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEvents($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBookingItemId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\BookingItems Clone of current object.
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
     * Declares an association between this object and a ChildBookings object.
     *
     * @param  ChildBookings $v
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBookings(ChildBookings $v = null)
    {
        if ($v === null) {
            $this->setBookingId(NULL);
        } else {
            $this->setBookingId($v->getBookingId());
        }

        $this->aBookings = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBookings object, it will not be re-added.
        if ($v !== null) {
            $v->addBookingItems($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBookings object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBookings The associated ChildBookings object.
     * @throws PropelException
     */
    public function getBookings(ConnectionInterface $con = null)
    {
        if ($this->aBookings === null && ($this->booking_id !== null)) {
            $this->aBookings = ChildBookingsQuery::create()->findPk($this->booking_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBookings->addBookingItemss($this);
             */
        }

        return $this->aBookings;
    }

    /**
     * Declares an association between this object and a ChildItems object.
     *
     * @param  ChildItems $v
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
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
            $v->addBookingItems($this);
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
                $this->aItems->addBookingItemss($this);
             */
        }

        return $this->aItems;
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
        if ('BookingEvents' == $relationName) {
            $this->initBookingEventss();
            return;
        }
    }

    /**
     * Clears out the collBookingEventss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEventss()
     */
    public function clearBookingEventss()
    {
        $this->collBookingEventss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEventss collection loaded partially.
     */
    public function resetPartialBookingEventss($v = true)
    {
        $this->collBookingEventssPartial = $v;
    }

    /**
     * Initializes the collBookingEventss collection.
     *
     * By default this just sets the collBookingEventss collection to an empty array (like clearcollBookingEventss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEventss($overrideExisting = true)
    {
        if (null !== $this->collBookingEventss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEventss = new $collectionClassName;
        $this->collBookingEventss->setModel('\TheFarm\Models\BookingEvents');
    }

    /**
     * Gets an array of ChildBookingEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBookingItems is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     * @throws PropelException
     */
    public function getBookingEventss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssPartial && !$this->isNew();
        if (null === $this->collBookingEventss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEventss) {
                // return empty collection
                $this->initBookingEventss();
            } else {
                $collBookingEventss = ChildBookingEventsQuery::create(null, $criteria)
                    ->filterByBookingItems($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventssPartial && count($collBookingEventss)) {
                        $this->initBookingEventss(false);

                        foreach ($collBookingEventss as $obj) {
                            if (false == $this->collBookingEventss->contains($obj)) {
                                $this->collBookingEventss->append($obj);
                            }
                        }

                        $this->collBookingEventssPartial = true;
                    }

                    return $collBookingEventss;
                }

                if ($partial && $this->collBookingEventss) {
                    foreach ($this->collBookingEventss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEventss[] = $obj;
                        }
                    }
                }

                $this->collBookingEventss = $collBookingEventss;
                $this->collBookingEventssPartial = false;
            }
        }

        return $this->collBookingEventss;
    }

    /**
     * Sets a collection of ChildBookingEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEventss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBookingItems The current object (for fluent API support)
     */
    public function setBookingEventss(Collection $bookingEventss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssToDelete */
        $bookingEventssToDelete = $this->getBookingEventss(new Criteria(), $con)->diff($bookingEventss);


        $this->bookingEventssScheduledForDeletion = $bookingEventssToDelete;

        foreach ($bookingEventssToDelete as $bookingEventsRemoved) {
            $bookingEventsRemoved->setBookingItems(null);
        }

        $this->collBookingEventss = null;
        foreach ($bookingEventss as $bookingEvents) {
            $this->addBookingEvents($bookingEvents);
        }

        $this->collBookingEventss = $bookingEventss;
        $this->collBookingEventssPartial = false;

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
    public function countBookingEventss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventssPartial && !$this->isNew();
        if (null === $this->collBookingEventss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEventss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEventss());
            }

            $query = ChildBookingEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBookingItems($this)
                ->count($con);
        }

        return count($this->collBookingEventss);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\BookingItems The current object (for fluent API support)
     */
    public function addBookingEvents(ChildBookingEvents $l)
    {
        if ($this->collBookingEventss === null) {
            $this->initBookingEventss();
            $this->collBookingEventssPartial = true;
        }

        if (!$this->collBookingEventss->contains($l)) {
            $this->doAddBookingEvents($l);

            if ($this->bookingEventssScheduledForDeletion and $this->bookingEventssScheduledForDeletion->contains($l)) {
                $this->bookingEventssScheduledForDeletion->remove($this->bookingEventssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvents $bookingEvents The ChildBookingEvents object to add.
     */
    protected function doAddBookingEvents(ChildBookingEvents $bookingEvents)
    {
        $this->collBookingEventss[]= $bookingEvents;
        $bookingEvents->setBookingItems($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEvents The ChildBookingEvents object to remove.
     * @return $this|ChildBookingItems The current object (for fluent API support)
     */
    public function removeBookingEvents(ChildBookingEvents $bookingEvents)
    {
        if ($this->getBookingEventss()->contains($bookingEvents)) {
            $pos = $this->collBookingEventss->search($bookingEvents);
            $this->collBookingEventss->remove($pos);
            if (null === $this->bookingEventssScheduledForDeletion) {
                $this->bookingEventssScheduledForDeletion = clone $this->collBookingEventss;
                $this->bookingEventssScheduledForDeletion->clear();
            }
            $this->bookingEventssScheduledForDeletion[]= $bookingEvents;
            $bookingEvents->setBookingItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactsRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByAuthorId', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactsRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByCalledBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactsRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByCancelledBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactsRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByDeletedBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinFacilities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Facilities', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BookingItems is new, it will return
     * an empty collection; or if this BookingItems has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BookingItems.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aBookings) {
            $this->aBookings->removeBookingItems($this);
        }
        if (null !== $this->aItems) {
            $this->aItems->removeBookingItems($this);
        }
        $this->booking_item_id = null;
        $this->booking_id = null;
        $this->item_id = null;
        $this->quantity = null;
        $this->included = null;
        $this->foc = null;
        $this->upsell = null;
        $this->inventory = null;
        $this->upgrade = null;
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
            if ($this->collBookingEventss) {
                foreach ($this->collBookingEventss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingEventss = null;
        $this->aBookings = null;
        $this->aItems = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BookingItemsTableMap::DEFAULT_STRING_FORMAT);
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
