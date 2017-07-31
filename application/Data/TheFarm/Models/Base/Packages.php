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
use TheFarm\Models\Bookings as ChildBookings;
use TheFarm\Models\BookingsQuery as ChildBookingsQuery;
use TheFarm\Models\PackageItems as ChildPackageItems;
use TheFarm\Models\PackageItemsQuery as ChildPackageItemsQuery;
use TheFarm\Models\Packages as ChildPackages;
use TheFarm\Models\PackagesQuery as ChildPackagesQuery;
use TheFarm\Models\Map\BookingsTableMap;
use TheFarm\Models\Map\PackageItemsTableMap;
use TheFarm\Models\Map\PackagesTableMap;

/**
 * Base class that represents a row from the 'tf_packages' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Packages implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\PackagesTableMap';


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
     * The value for the package_id field.
     *
     * @var        int
     */
    protected $package_id;

    /**
     * The value for the package_name field.
     *
     * @var        string
     */
    protected $package_name;

    /**
     * The value for the package_type field.
     *
     * @var        string
     */
    protected $package_type;

    /**
     * The value for the duration field.
     *
     * @var        int
     */
    protected $duration;

    /**
     * The value for the package_type_id field.
     *
     * @var        int
     */
    protected $package_type_id;

    /**
     * The value for the personalized field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $personalized;

    /**
     * @var        ObjectCollection|ChildBookings[] Collection to store aggregation of ChildBookings objects.
     */
    protected $collBookingss;
    protected $collBookingssPartial;

    /**
     * @var        ObjectCollection|ChildPackageItems[] Collection to store aggregation of ChildPackageItems objects.
     */
    protected $collPackageItemss;
    protected $collPackageItemssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookings[]
     */
    protected $bookingssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPackageItems[]
     */
    protected $packageItemssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->personalized = 0;
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Packages object.
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
     * Compares this with another <code>Packages</code> instance.  If
     * <code>obj</code> is an instance of <code>Packages</code>, delegates to
     * <code>equals(Packages)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Packages The current object, for fluid interface
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
     * Get the [package_id] column value.
     *
     * @return int
     */
    public function getPackageId()
    {
        return $this->package_id;
    }

    /**
     * Get the [package_name] column value.
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->package_name;
    }

    /**
     * Get the [package_type] column value.
     *
     * @return string
     */
    public function getPackageType()
    {
        return $this->package_type;
    }

    /**
     * Get the [duration] column value.
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
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
     * Get the [personalized] column value.
     *
     * @return int
     */
    public function getPersonalized()
    {
        return $this->personalized;
    }

    /**
     * Set the value of [package_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setPackageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_id !== $v) {
            $this->package_id = $v;
            $this->modifiedColumns[PackagesTableMap::COL_PACKAGE_ID] = true;
        }

        return $this;
    } // setPackageId()

    /**
     * Set the value of [package_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setPackageName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->package_name !== $v) {
            $this->package_name = $v;
            $this->modifiedColumns[PackagesTableMap::COL_PACKAGE_NAME] = true;
        }

        return $this;
    } // setPackageName()

    /**
     * Set the value of [package_type] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setPackageType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->package_type !== $v) {
            $this->package_type = $v;
            $this->modifiedColumns[PackagesTableMap::COL_PACKAGE_TYPE] = true;
        }

        return $this;
    } // setPackageType()

    /**
     * Set the value of [duration] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->duration !== $v) {
            $this->duration = $v;
            $this->modifiedColumns[PackagesTableMap::COL_DURATION] = true;
        }

        return $this;
    } // setDuration()

    /**
     * Set the value of [package_type_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setPackageTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->package_type_id !== $v) {
            $this->package_type_id = $v;
            $this->modifiedColumns[PackagesTableMap::COL_PACKAGE_TYPE_ID] = true;
        }

        return $this;
    } // setPackageTypeId()

    /**
     * Set the value of [personalized] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function setPersonalized($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->personalized !== $v) {
            $this->personalized = $v;
            $this->modifiedColumns[PackagesTableMap::COL_PERSONALIZED] = true;
        }

        return $this;
    } // setPersonalized()

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
            if ($this->personalized !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PackagesTableMap::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PackagesTableMap::translateFieldName('PackageName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PackagesTableMap::translateFieldName('PackageType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PackagesTableMap::translateFieldName('Duration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PackagesTableMap::translateFieldName('PackageTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PackagesTableMap::translateFieldName('Personalized', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personalized = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = PackagesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Packages'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PackagesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPackagesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBookingss = null;

            $this->collPackageItemss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Packages::setDeleted()
     * @see Packages::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPackagesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
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
                PackagesTableMap::addInstanceToPool($this);
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

            if ($this->bookingssScheduledForDeletion !== null) {
                if (!$this->bookingssScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingssScheduledForDeletion as $bookings) {
                        // need to save related object because we set the relation to null
                        $bookings->save($con);
                    }
                    $this->bookingssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingss !== null) {
                foreach ($this->collBookingss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->packageItemssScheduledForDeletion !== null) {
                if (!$this->packageItemssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\PackageItemsQuery::create()
                        ->filterByPrimaryKeys($this->packageItemssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->packageItemssScheduledForDeletion = null;
                }
            }

            if ($this->collPackageItemss !== null) {
                foreach ($this->collPackageItemss as $referrerFK) {
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

        $this->modifiedColumns[PackagesTableMap::COL_PACKAGE_ID] = true;
        if (null !== $this->package_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PackagesTableMap::COL_PACKAGE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_id';
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'package_name';
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'package_type';
        }
        if ($this->isColumnModified(PackagesTableMap::COL_DURATION)) {
            $modifiedColumns[':p' . $index++]  = 'duration';
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'package_type_id';
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PERSONALIZED)) {
            $modifiedColumns[':p' . $index++]  = 'personalized';
        }

        $sql = sprintf(
            'INSERT INTO tf_packages (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'package_id':
                        $stmt->bindValue($identifier, $this->package_id, PDO::PARAM_INT);
                        break;
                    case 'package_name':
                        $stmt->bindValue($identifier, $this->package_name, PDO::PARAM_STR);
                        break;
                    case 'package_type':
                        $stmt->bindValue($identifier, $this->package_type, PDO::PARAM_STR);
                        break;
                    case 'duration':
                        $stmt->bindValue($identifier, $this->duration, PDO::PARAM_INT);
                        break;
                    case 'package_type_id':
                        $stmt->bindValue($identifier, $this->package_type_id, PDO::PARAM_INT);
                        break;
                    case 'personalized':
                        $stmt->bindValue($identifier, $this->personalized, PDO::PARAM_INT);
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
        $this->setPackageId($pk);

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
        $pos = PackagesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPackageId();
                break;
            case 1:
                return $this->getPackageName();
                break;
            case 2:
                return $this->getPackageType();
                break;
            case 3:
                return $this->getDuration();
                break;
            case 4:
                return $this->getPackageTypeId();
                break;
            case 5:
                return $this->getPersonalized();
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

        if (isset($alreadyDumpedObjects['Packages'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Packages'][$this->hashCode()] = true;
        $keys = PackagesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPackageId(),
            $keys[1] => $this->getPackageName(),
            $keys[2] => $this->getPackageType(),
            $keys[3] => $this->getDuration(),
            $keys[4] => $this->getPackageTypeId(),
            $keys[5] => $this->getPersonalized(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBookingss) {

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

                $result[$key] = $this->collBookingss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPackageItemss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packageItemss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_package_itemss';
                        break;
                    default:
                        $key = 'PackageItemss';
                }

                $result[$key] = $this->collPackageItemss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Packages
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PackagesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Packages
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPackageId($value);
                break;
            case 1:
                $this->setPackageName($value);
                break;
            case 2:
                $this->setPackageType($value);
                break;
            case 3:
                $this->setDuration($value);
                break;
            case 4:
                $this->setPackageTypeId($value);
                break;
            case 5:
                $this->setPersonalized($value);
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
        $keys = PackagesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPackageId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPackageName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPackageType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDuration($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPackageTypeId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPersonalized($arr[$keys[5]]);
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
     * @return $this|\TheFarm\Models\Packages The current object, for fluid interface
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
        $criteria = new Criteria(PackagesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_ID)) {
            $criteria->add(PackagesTableMap::COL_PACKAGE_ID, $this->package_id);
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_NAME)) {
            $criteria->add(PackagesTableMap::COL_PACKAGE_NAME, $this->package_name);
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_TYPE)) {
            $criteria->add(PackagesTableMap::COL_PACKAGE_TYPE, $this->package_type);
        }
        if ($this->isColumnModified(PackagesTableMap::COL_DURATION)) {
            $criteria->add(PackagesTableMap::COL_DURATION, $this->duration);
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PACKAGE_TYPE_ID)) {
            $criteria->add(PackagesTableMap::COL_PACKAGE_TYPE_ID, $this->package_type_id);
        }
        if ($this->isColumnModified(PackagesTableMap::COL_PERSONALIZED)) {
            $criteria->add(PackagesTableMap::COL_PERSONALIZED, $this->personalized);
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
        $criteria = ChildPackagesQuery::create();
        $criteria->add(PackagesTableMap::COL_PACKAGE_ID, $this->package_id);

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
        $validPk = null !== $this->getPackageId();

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
        return $this->getPackageId();
    }

    /**
     * Generic method to set the primary key (package_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPackageId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPackageId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Packages (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPackageName($this->getPackageName());
        $copyObj->setPackageType($this->getPackageType());
        $copyObj->setDuration($this->getDuration());
        $copyObj->setPackageTypeId($this->getPackageTypeId());
        $copyObj->setPersonalized($this->getPersonalized());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookings($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPackageItemss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPackageItems($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPackageId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Packages Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Bookings' == $relationName) {
            $this->initBookingss();
            return;
        }
        if ('PackageItems' == $relationName) {
            $this->initPackageItemss();
            return;
        }
    }

    /**
     * Clears out the collBookingss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingss()
     */
    public function clearBookingss()
    {
        $this->collBookingss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingss collection loaded partially.
     */
    public function resetPartialBookingss($v = true)
    {
        $this->collBookingssPartial = $v;
    }

    /**
     * Initializes the collBookingss collection.
     *
     * By default this just sets the collBookingss collection to an empty array (like clearcollBookingss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingss($overrideExisting = true)
    {
        if (null !== $this->collBookingss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingss = new $collectionClassName;
        $this->collBookingss->setModel('\TheFarm\Models\Bookings');
    }

    /**
     * Gets an array of ChildBookings objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPackages is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     * @throws PropelException
     */
    public function getBookingss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssPartial && !$this->isNew();
        if (null === $this->collBookingss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingss) {
                // return empty collection
                $this->initBookingss();
            } else {
                $collBookingss = ChildBookingsQuery::create(null, $criteria)
                    ->filterByPackages($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingssPartial && count($collBookingss)) {
                        $this->initBookingss(false);

                        foreach ($collBookingss as $obj) {
                            if (false == $this->collBookingss->contains($obj)) {
                                $this->collBookingss->append($obj);
                            }
                        }

                        $this->collBookingssPartial = true;
                    }

                    return $collBookingss;
                }

                if ($partial && $this->collBookingss) {
                    foreach ($this->collBookingss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingss[] = $obj;
                        }
                    }
                }

                $this->collBookingss = $collBookingss;
                $this->collBookingssPartial = false;
            }
        }

        return $this->collBookingss;
    }

    /**
     * Sets a collection of ChildBookings objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPackages The current object (for fluent API support)
     */
    public function setBookingss(Collection $bookingss, ConnectionInterface $con = null)
    {
        /** @var ChildBookings[] $bookingssToDelete */
        $bookingssToDelete = $this->getBookingss(new Criteria(), $con)->diff($bookingss);


        $this->bookingssScheduledForDeletion = $bookingssToDelete;

        foreach ($bookingssToDelete as $bookingsRemoved) {
            $bookingsRemoved->setPackages(null);
        }

        $this->collBookingss = null;
        foreach ($bookingss as $bookings) {
            $this->addBookings($bookings);
        }

        $this->collBookingss = $bookingss;
        $this->collBookingssPartial = false;

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
    public function countBookingss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingssPartial && !$this->isNew();
        if (null === $this->collBookingss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingss());
            }

            $query = ChildBookingsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPackages($this)
                ->count($con);
        }

        return count($this->collBookingss);
    }

    /**
     * Method called to associate a ChildBookings object to this object
     * through the ChildBookings foreign key attribute.
     *
     * @param  ChildBookings $l ChildBookings
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function addBookings(ChildBookings $l)
    {
        if ($this->collBookingss === null) {
            $this->initBookingss();
            $this->collBookingssPartial = true;
        }

        if (!$this->collBookingss->contains($l)) {
            $this->doAddBookings($l);

            if ($this->bookingssScheduledForDeletion and $this->bookingssScheduledForDeletion->contains($l)) {
                $this->bookingssScheduledForDeletion->remove($this->bookingssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookings $bookings The ChildBookings object to add.
     */
    protected function doAddBookings(ChildBookings $bookings)
    {
        $this->collBookingss[]= $bookings;
        $bookings->setPackages($this);
    }

    /**
     * @param  ChildBookings $bookings The ChildBookings object to remove.
     * @return $this|ChildPackages The current object (for fluent API support)
     */
    public function removeBookings(ChildBookings $bookings)
    {
        if ($this->getBookingss()->contains($bookings)) {
            $pos = $this->collBookingss->search($bookings);
            $this->collBookingss->remove($pos);
            if (null === $this->bookingssScheduledForDeletion) {
                $this->bookingssScheduledForDeletion = clone $this->collBookingss;
                $this->bookingssScheduledForDeletion->clear();
            }
            $this->bookingssScheduledForDeletion[]= $bookings;
            $bookings->setPackages(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Packages is new, it will return
     * an empty collection; or if this Packages has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Packages.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinContactsRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByAuthorId', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Packages is new, it will return
     * an empty collection; or if this Packages has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Packages.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinContactsRelatedByGuestId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('ContactsRelatedByGuestId', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Packages is new, it will return
     * an empty collection; or if this Packages has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Packages.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Packages is new, it will return
     * an empty collection; or if this Packages has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Packages.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingss($query, $con);
    }

    /**
     * Clears out the collPackageItemss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPackageItemss()
     */
    public function clearPackageItemss()
    {
        $this->collPackageItemss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPackageItemss collection loaded partially.
     */
    public function resetPartialPackageItemss($v = true)
    {
        $this->collPackageItemssPartial = $v;
    }

    /**
     * Initializes the collPackageItemss collection.
     *
     * By default this just sets the collPackageItemss collection to an empty array (like clearcollPackageItemss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPackageItemss($overrideExisting = true)
    {
        if (null !== $this->collPackageItemss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PackageItemsTableMap::getTableMap()->getCollectionClassName();

        $this->collPackageItemss = new $collectionClassName;
        $this->collPackageItemss->setModel('\TheFarm\Models\PackageItems');
    }

    /**
     * Gets an array of ChildPackageItems objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPackages is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPackageItems[] List of ChildPackageItems objects
     * @throws PropelException
     */
    public function getPackageItemss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageItemssPartial && !$this->isNew();
        if (null === $this->collPackageItemss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPackageItemss) {
                // return empty collection
                $this->initPackageItemss();
            } else {
                $collPackageItemss = ChildPackageItemsQuery::create(null, $criteria)
                    ->filterByPackages($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPackageItemssPartial && count($collPackageItemss)) {
                        $this->initPackageItemss(false);

                        foreach ($collPackageItemss as $obj) {
                            if (false == $this->collPackageItemss->contains($obj)) {
                                $this->collPackageItemss->append($obj);
                            }
                        }

                        $this->collPackageItemssPartial = true;
                    }

                    return $collPackageItemss;
                }

                if ($partial && $this->collPackageItemss) {
                    foreach ($this->collPackageItemss as $obj) {
                        if ($obj->isNew()) {
                            $collPackageItemss[] = $obj;
                        }
                    }
                }

                $this->collPackageItemss = $collPackageItemss;
                $this->collPackageItemssPartial = false;
            }
        }

        return $this->collPackageItemss;
    }

    /**
     * Sets a collection of ChildPackageItems objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $packageItemss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPackages The current object (for fluent API support)
     */
    public function setPackageItemss(Collection $packageItemss, ConnectionInterface $con = null)
    {
        /** @var ChildPackageItems[] $packageItemssToDelete */
        $packageItemssToDelete = $this->getPackageItemss(new Criteria(), $con)->diff($packageItemss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->packageItemssScheduledForDeletion = clone $packageItemssToDelete;

        foreach ($packageItemssToDelete as $packageItemsRemoved) {
            $packageItemsRemoved->setPackages(null);
        }

        $this->collPackageItemss = null;
        foreach ($packageItemss as $packageItems) {
            $this->addPackageItems($packageItems);
        }

        $this->collPackageItemss = $packageItemss;
        $this->collPackageItemssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PackageItems objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PackageItems objects.
     * @throws PropelException
     */
    public function countPackageItemss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageItemssPartial && !$this->isNew();
        if (null === $this->collPackageItemss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPackageItemss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPackageItemss());
            }

            $query = ChildPackageItemsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPackages($this)
                ->count($con);
        }

        return count($this->collPackageItemss);
    }

    /**
     * Method called to associate a ChildPackageItems object to this object
     * through the ChildPackageItems foreign key attribute.
     *
     * @param  ChildPackageItems $l ChildPackageItems
     * @return $this|\TheFarm\Models\Packages The current object (for fluent API support)
     */
    public function addPackageItems(ChildPackageItems $l)
    {
        if ($this->collPackageItemss === null) {
            $this->initPackageItemss();
            $this->collPackageItemssPartial = true;
        }

        if (!$this->collPackageItemss->contains($l)) {
            $this->doAddPackageItems($l);

            if ($this->packageItemssScheduledForDeletion and $this->packageItemssScheduledForDeletion->contains($l)) {
                $this->packageItemssScheduledForDeletion->remove($this->packageItemssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPackageItems $packageItems The ChildPackageItems object to add.
     */
    protected function doAddPackageItems(ChildPackageItems $packageItems)
    {
        $this->collPackageItemss[]= $packageItems;
        $packageItems->setPackages($this);
    }

    /**
     * @param  ChildPackageItems $packageItems The ChildPackageItems object to remove.
     * @return $this|ChildPackages The current object (for fluent API support)
     */
    public function removePackageItems(ChildPackageItems $packageItems)
    {
        if ($this->getPackageItemss()->contains($packageItems)) {
            $pos = $this->collPackageItemss->search($packageItems);
            $this->collPackageItemss->remove($pos);
            if (null === $this->packageItemssScheduledForDeletion) {
                $this->packageItemssScheduledForDeletion = clone $this->collPackageItemss;
                $this->packageItemssScheduledForDeletion->clear();
            }
            $this->packageItemssScheduledForDeletion[]= clone $packageItems;
            $packageItems->setPackages(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Packages is new, it will return
     * an empty collection; or if this Packages has previously
     * been saved, it will retrieve related PackageItemss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Packages.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPackageItems[] List of ChildPackageItems objects
     */
    public function getPackageItemssJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPackageItemsQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getPackageItemss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->package_id = null;
        $this->package_name = null;
        $this->package_type = null;
        $this->duration = null;
        $this->package_type_id = null;
        $this->personalized = null;
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
            if ($this->collBookingss) {
                foreach ($this->collBookingss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPackageItemss) {
                foreach ($this->collPackageItemss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingss = null;
        $this->collPackageItemss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PackagesTableMap::DEFAULT_STRING_FORMAT);
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
