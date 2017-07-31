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
use TheFarm\Models\Categories as ChildCategories;
use TheFarm\Models\CategoriesQuery as ChildCategoriesQuery;
use TheFarm\Models\Facilities as ChildFacilities;
use TheFarm\Models\FacilitiesQuery as ChildFacilitiesQuery;
use TheFarm\Models\Locations as ChildLocations;
use TheFarm\Models\LocationsQuery as ChildLocationsQuery;
use TheFarm\Models\Users as ChildUsers;
use TheFarm\Models\UsersQuery as ChildUsersQuery;
use TheFarm\Models\Map\CategoriesTableMap;
use TheFarm\Models\Map\FacilitiesTableMap;
use TheFarm\Models\Map\LocationsTableMap;
use TheFarm\Models\Map\UsersTableMap;

/**
 * Base class that represents a row from the 'tf_locations' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Locations implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\LocationsTableMap';


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
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the location field.
     *
     * @var        string
     */
    protected $location;

    /**
     * @var        ObjectCollection|ChildCategories[] Collection to store aggregation of ChildCategories objects.
     */
    protected $collCategoriess;
    protected $collCategoriessPartial;

    /**
     * @var        ObjectCollection|ChildFacilities[] Collection to store aggregation of ChildFacilities objects.
     */
    protected $collFacilitiess;
    protected $collFacilitiessPartial;

    /**
     * @var        ObjectCollection|ChildUsers[] Collection to store aggregation of ChildUsers objects.
     */
    protected $collUserss;
    protected $collUserssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCategories[]
     */
    protected $categoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFacilities[]
     */
    protected $facilitiessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsers[]
     */
    protected $userssScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\Locations object.
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
     * Compares this with another <code>Locations</code> instance.  If
     * <code>obj</code> is an instance of <code>Locations</code>, delegates to
     * <code>equals(Locations)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Locations The current object, for fluid interface
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
     * Get the [location_id] column value.
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Locations The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[LocationsTableMap::COL_LOCATION_ID] = true;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [location] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Locations The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[LocationsTableMap::COL_LOCATION] = true;
        }

        return $this;
    } // setLocation()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LocationsTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LocationsTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = LocationsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Locations'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(LocationsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLocationsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCategoriess = null;

            $this->collFacilitiess = null;

            $this->collUserss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Locations::setDeleted()
     * @see Locations::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LocationsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLocationsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LocationsTableMap::DATABASE_NAME);
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
                LocationsTableMap::addInstanceToPool($this);
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

            if ($this->categoriessScheduledForDeletion !== null) {
                if (!$this->categoriessScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\CategoriesQuery::create()
                        ->filterByPrimaryKeys($this->categoriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoriessScheduledForDeletion = null;
                }
            }

            if ($this->collCategoriess !== null) {
                foreach ($this->collCategoriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->facilitiessScheduledForDeletion !== null) {
                if (!$this->facilitiessScheduledForDeletion->isEmpty()) {
                    foreach ($this->facilitiessScheduledForDeletion as $facilities) {
                        // need to save related object because we set the relation to null
                        $facilities->save($con);
                    }
                    $this->facilitiessScheduledForDeletion = null;
                }
            }

            if ($this->collFacilitiess !== null) {
                foreach ($this->collFacilitiess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userssScheduledForDeletion !== null) {
                if (!$this->userssScheduledForDeletion->isEmpty()) {
                    foreach ($this->userssScheduledForDeletion as $users) {
                        // need to save related object because we set the relation to null
                        $users->save($con);
                    }
                    $this->userssScheduledForDeletion = null;
                }
            }

            if ($this->collUserss !== null) {
                foreach ($this->collUserss as $referrerFK) {
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

        $this->modifiedColumns[LocationsTableMap::COL_LOCATION_ID] = true;
        if (null !== $this->location_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LocationsTableMap::COL_LOCATION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LocationsTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(LocationsTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }

        $sql = sprintf(
            'INSERT INTO tf_locations (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'location_id':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
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
        $this->setLocationId($pk);

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
        $pos = LocationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getLocationId();
                break;
            case 1:
                return $this->getLocation();
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

        if (isset($alreadyDumpedObjects['Locations'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Locations'][$this->hashCode()] = true;
        $keys = LocationsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getLocationId(),
            $keys[1] => $this->getLocation(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCategoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_categoriess';
                        break;
                    default:
                        $key = 'Categoriess';
                }

                $result[$key] = $this->collCategoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFacilitiess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'facilitiess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_facilitiess';
                        break;
                    default:
                        $key = 'Facilitiess';
                }

                $result[$key] = $this->collFacilitiess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_userss';
                        break;
                    default:
                        $key = 'Userss';
                }

                $result[$key] = $this->collUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Locations
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LocationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Locations
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setLocationId($value);
                break;
            case 1:
                $this->setLocation($value);
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
        $keys = LocationsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setLocationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLocation($arr[$keys[1]]);
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
     * @return $this|\TheFarm\Models\Locations The current object, for fluid interface
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
        $criteria = new Criteria(LocationsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LocationsTableMap::COL_LOCATION_ID)) {
            $criteria->add(LocationsTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(LocationsTableMap::COL_LOCATION)) {
            $criteria->add(LocationsTableMap::COL_LOCATION, $this->location);
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
        $criteria = ChildLocationsQuery::create();
        $criteria->add(LocationsTableMap::COL_LOCATION_ID, $this->location_id);

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
        $validPk = null !== $this->getLocationId();

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
        return $this->getLocationId();
    }

    /**
     * Generic method to set the primary key (location_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setLocationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getLocationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Locations (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLocation($this->getLocation());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFacilitiess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFacilities($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsers($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setLocationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Locations Clone of current object.
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
        if ('Categories' == $relationName) {
            $this->initCategoriess();
            return;
        }
        if ('Facilities' == $relationName) {
            $this->initFacilitiess();
            return;
        }
        if ('Users' == $relationName) {
            $this->initUserss();
            return;
        }
    }

    /**
     * Clears out the collCategoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategoriess()
     */
    public function clearCategoriess()
    {
        $this->collCategoriess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategoriess collection loaded partially.
     */
    public function resetPartialCategoriess($v = true)
    {
        $this->collCategoriessPartial = $v;
    }

    /**
     * Initializes the collCategoriess collection.
     *
     * By default this just sets the collCategoriess collection to an empty array (like clearcollCategoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoriess($overrideExisting = true)
    {
        if (null !== $this->collCategoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = CategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collCategoriess = new $collectionClassName;
        $this->collCategoriess->setModel('\TheFarm\Models\Categories');
    }

    /**
     * Gets an array of ChildCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLocations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     * @throws PropelException
     */
    public function getCategoriess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriessPartial && !$this->isNew();
        if (null === $this->collCategoriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoriess) {
                // return empty collection
                $this->initCategoriess();
            } else {
                $collCategoriess = ChildCategoriesQuery::create(null, $criteria)
                    ->filterByLocations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoriessPartial && count($collCategoriess)) {
                        $this->initCategoriess(false);

                        foreach ($collCategoriess as $obj) {
                            if (false == $this->collCategoriess->contains($obj)) {
                                $this->collCategoriess->append($obj);
                            }
                        }

                        $this->collCategoriessPartial = true;
                    }

                    return $collCategoriess;
                }

                if ($partial && $this->collCategoriess) {
                    foreach ($this->collCategoriess as $obj) {
                        if ($obj->isNew()) {
                            $collCategoriess[] = $obj;
                        }
                    }
                }

                $this->collCategoriess = $collCategoriess;
                $this->collCategoriessPartial = false;
            }
        }

        return $this->collCategoriess;
    }

    /**
     * Sets a collection of ChildCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categoriess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function setCategoriess(Collection $categoriess, ConnectionInterface $con = null)
    {
        /** @var ChildCategories[] $categoriessToDelete */
        $categoriessToDelete = $this->getCategoriess(new Criteria(), $con)->diff($categoriess);


        $this->categoriessScheduledForDeletion = $categoriessToDelete;

        foreach ($categoriessToDelete as $categoriesRemoved) {
            $categoriesRemoved->setLocations(null);
        }

        $this->collCategoriess = null;
        foreach ($categoriess as $categories) {
            $this->addCategories($categories);
        }

        $this->collCategoriess = $categoriess;
        $this->collCategoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Categories objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Categories objects.
     * @throws PropelException
     */
    public function countCategoriess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriessPartial && !$this->isNew();
        if (null === $this->collCategoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoriess());
            }

            $query = ChildCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocations($this)
                ->count($con);
        }

        return count($this->collCategoriess);
    }

    /**
     * Method called to associate a ChildCategories object to this object
     * through the ChildCategories foreign key attribute.
     *
     * @param  ChildCategories $l ChildCategories
     * @return $this|\TheFarm\Models\Locations The current object (for fluent API support)
     */
    public function addCategories(ChildCategories $l)
    {
        if ($this->collCategoriess === null) {
            $this->initCategoriess();
            $this->collCategoriessPartial = true;
        }

        if (!$this->collCategoriess->contains($l)) {
            $this->doAddCategories($l);

            if ($this->categoriessScheduledForDeletion and $this->categoriessScheduledForDeletion->contains($l)) {
                $this->categoriessScheduledForDeletion->remove($this->categoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCategories $categories The ChildCategories object to add.
     */
    protected function doAddCategories(ChildCategories $categories)
    {
        $this->collCategoriess[]= $categories;
        $categories->setLocations($this);
    }

    /**
     * @param  ChildCategories $categories The ChildCategories object to remove.
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function removeCategories(ChildCategories $categories)
    {
        if ($this->getCategoriess()->contains($categories)) {
            $pos = $this->collCategoriess->search($categories);
            $this->collCategoriess->remove($pos);
            if (null === $this->categoriessScheduledForDeletion) {
                $this->categoriessScheduledForDeletion = clone $this->collCategoriess;
                $this->categoriessScheduledForDeletion->clear();
            }
            $this->categoriessScheduledForDeletion[]= clone $categories;
            $categories->setLocations(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Locations is new, it will return
     * an empty collection; or if this Locations has previously
     * been saved, it will retrieve related Categoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Locations.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     */
    public function getCategoriessJoinFiles(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('Files', $joinBehavior);

        return $this->getCategoriess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Locations is new, it will return
     * an empty collection; or if this Locations has previously
     * been saved, it will retrieve related Categoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Locations.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     */
    public function getCategoriessJoinCategoriesRelatedByParentId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('CategoriesRelatedByParentId', $joinBehavior);

        return $this->getCategoriess($query, $con);
    }

    /**
     * Clears out the collFacilitiess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFacilitiess()
     */
    public function clearFacilitiess()
    {
        $this->collFacilitiess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFacilitiess collection loaded partially.
     */
    public function resetPartialFacilitiess($v = true)
    {
        $this->collFacilitiessPartial = $v;
    }

    /**
     * Initializes the collFacilitiess collection.
     *
     * By default this just sets the collFacilitiess collection to an empty array (like clearcollFacilitiess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFacilitiess($overrideExisting = true)
    {
        if (null !== $this->collFacilitiess && !$overrideExisting) {
            return;
        }

        $collectionClassName = FacilitiesTableMap::getTableMap()->getCollectionClassName();

        $this->collFacilitiess = new $collectionClassName;
        $this->collFacilitiess->setModel('\TheFarm\Models\Facilities');
    }

    /**
     * Gets an array of ChildFacilities objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLocations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFacilities[] List of ChildFacilities objects
     * @throws PropelException
     */
    public function getFacilitiess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFacilitiessPartial && !$this->isNew();
        if (null === $this->collFacilitiess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFacilitiess) {
                // return empty collection
                $this->initFacilitiess();
            } else {
                $collFacilitiess = ChildFacilitiesQuery::create(null, $criteria)
                    ->filterByLocations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFacilitiessPartial && count($collFacilitiess)) {
                        $this->initFacilitiess(false);

                        foreach ($collFacilitiess as $obj) {
                            if (false == $this->collFacilitiess->contains($obj)) {
                                $this->collFacilitiess->append($obj);
                            }
                        }

                        $this->collFacilitiessPartial = true;
                    }

                    return $collFacilitiess;
                }

                if ($partial && $this->collFacilitiess) {
                    foreach ($this->collFacilitiess as $obj) {
                        if ($obj->isNew()) {
                            $collFacilitiess[] = $obj;
                        }
                    }
                }

                $this->collFacilitiess = $collFacilitiess;
                $this->collFacilitiessPartial = false;
            }
        }

        return $this->collFacilitiess;
    }

    /**
     * Sets a collection of ChildFacilities objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $facilitiess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function setFacilitiess(Collection $facilitiess, ConnectionInterface $con = null)
    {
        /** @var ChildFacilities[] $facilitiessToDelete */
        $facilitiessToDelete = $this->getFacilitiess(new Criteria(), $con)->diff($facilitiess);


        $this->facilitiessScheduledForDeletion = $facilitiessToDelete;

        foreach ($facilitiessToDelete as $facilitiesRemoved) {
            $facilitiesRemoved->setLocations(null);
        }

        $this->collFacilitiess = null;
        foreach ($facilitiess as $facilities) {
            $this->addFacilities($facilities);
        }

        $this->collFacilitiess = $facilitiess;
        $this->collFacilitiessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Facilities objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Facilities objects.
     * @throws PropelException
     */
    public function countFacilitiess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFacilitiessPartial && !$this->isNew();
        if (null === $this->collFacilitiess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFacilitiess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFacilitiess());
            }

            $query = ChildFacilitiesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocations($this)
                ->count($con);
        }

        return count($this->collFacilitiess);
    }

    /**
     * Method called to associate a ChildFacilities object to this object
     * through the ChildFacilities foreign key attribute.
     *
     * @param  ChildFacilities $l ChildFacilities
     * @return $this|\TheFarm\Models\Locations The current object (for fluent API support)
     */
    public function addFacilities(ChildFacilities $l)
    {
        if ($this->collFacilitiess === null) {
            $this->initFacilitiess();
            $this->collFacilitiessPartial = true;
        }

        if (!$this->collFacilitiess->contains($l)) {
            $this->doAddFacilities($l);

            if ($this->facilitiessScheduledForDeletion and $this->facilitiessScheduledForDeletion->contains($l)) {
                $this->facilitiessScheduledForDeletion->remove($this->facilitiessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFacilities $facilities The ChildFacilities object to add.
     */
    protected function doAddFacilities(ChildFacilities $facilities)
    {
        $this->collFacilitiess[]= $facilities;
        $facilities->setLocations($this);
    }

    /**
     * @param  ChildFacilities $facilities The ChildFacilities object to remove.
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function removeFacilities(ChildFacilities $facilities)
    {
        if ($this->getFacilitiess()->contains($facilities)) {
            $pos = $this->collFacilitiess->search($facilities);
            $this->collFacilitiess->remove($pos);
            if (null === $this->facilitiessScheduledForDeletion) {
                $this->facilitiessScheduledForDeletion = clone $this->collFacilitiess;
                $this->facilitiessScheduledForDeletion->clear();
            }
            $this->facilitiessScheduledForDeletion[]= $facilities;
            $facilities->setLocations(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserss()
     */
    public function clearUserss()
    {
        $this->collUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserss collection loaded partially.
     */
    public function resetPartialUserss($v = true)
    {
        $this->collUserssPartial = $v;
    }

    /**
     * Initializes the collUserss collection.
     *
     * By default this just sets the collUserss collection to an empty array (like clearcollUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserss($overrideExisting = true)
    {
        if (null !== $this->collUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

        $this->collUserss = new $collectionClassName;
        $this->collUserss->setModel('\TheFarm\Models\Users');
    }

    /**
     * Gets an array of ChildUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLocations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @throws PropelException
     */
    public function getUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserss) {
                // return empty collection
                $this->initUserss();
            } else {
                $collUserss = ChildUsersQuery::create(null, $criteria)
                    ->filterByLocations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserssPartial && count($collUserss)) {
                        $this->initUserss(false);

                        foreach ($collUserss as $obj) {
                            if (false == $this->collUserss->contains($obj)) {
                                $this->collUserss->append($obj);
                            }
                        }

                        $this->collUserssPartial = true;
                    }

                    return $collUserss;
                }

                if ($partial && $this->collUserss) {
                    foreach ($this->collUserss as $obj) {
                        if ($obj->isNew()) {
                            $collUserss[] = $obj;
                        }
                    }
                }

                $this->collUserss = $collUserss;
                $this->collUserssPartial = false;
            }
        }

        return $this->collUserss;
    }

    /**
     * Sets a collection of ChildUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function setUserss(Collection $userss, ConnectionInterface $con = null)
    {
        /** @var ChildUsers[] $userssToDelete */
        $userssToDelete = $this->getUserss(new Criteria(), $con)->diff($userss);


        $this->userssScheduledForDeletion = $userssToDelete;

        foreach ($userssToDelete as $usersRemoved) {
            $usersRemoved->setLocations(null);
        }

        $this->collUserss = null;
        foreach ($userss as $users) {
            $this->addUsers($users);
        }

        $this->collUserss = $userss;
        $this->collUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Users objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Users objects.
     * @throws PropelException
     */
    public function countUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserss());
            }

            $query = ChildUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocations($this)
                ->count($con);
        }

        return count($this->collUserss);
    }

    /**
     * Method called to associate a ChildUsers object to this object
     * through the ChildUsers foreign key attribute.
     *
     * @param  ChildUsers $l ChildUsers
     * @return $this|\TheFarm\Models\Locations The current object (for fluent API support)
     */
    public function addUsers(ChildUsers $l)
    {
        if ($this->collUserss === null) {
            $this->initUserss();
            $this->collUserssPartial = true;
        }

        if (!$this->collUserss->contains($l)) {
            $this->doAddUsers($l);

            if ($this->userssScheduledForDeletion and $this->userssScheduledForDeletion->contains($l)) {
                $this->userssScheduledForDeletion->remove($this->userssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsers $users The ChildUsers object to add.
     */
    protected function doAddUsers(ChildUsers $users)
    {
        $this->collUserss[]= $users;
        $users->setLocations($this);
    }

    /**
     * @param  ChildUsers $users The ChildUsers object to remove.
     * @return $this|ChildLocations The current object (for fluent API support)
     */
    public function removeUsers(ChildUsers $users)
    {
        if ($this->getUserss()->contains($users)) {
            $pos = $this->collUserss->search($users);
            $this->collUserss->remove($pos);
            if (null === $this->userssScheduledForDeletion) {
                $this->userssScheduledForDeletion = clone $this->collUserss;
                $this->userssScheduledForDeletion->clear();
            }
            $this->userssScheduledForDeletion[]= $users;
            $users->setLocations(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Locations is new, it will return
     * an empty collection; or if this Locations has previously
     * been saved, it will retrieve related Userss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Locations.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     */
    public function getUserssJoinContacts(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsersQuery::create(null, $criteria);
        $query->joinWith('Contacts', $joinBehavior);

        return $this->getUserss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Locations is new, it will return
     * an empty collection; or if this Locations has previously
     * been saved, it will retrieve related Userss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Locations.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     */
    public function getUserssJoinGroups(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsersQuery::create(null, $criteria);
        $query->joinWith('Groups', $joinBehavior);

        return $this->getUserss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->location_id = null;
        $this->location = null;
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
            if ($this->collCategoriess) {
                foreach ($this->collCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFacilitiess) {
                foreach ($this->collFacilitiess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserss) {
                foreach ($this->collUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCategoriess = null;
        $this->collFacilitiess = null;
        $this->collUserss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LocationsTableMap::DEFAULT_STRING_FORMAT);
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
