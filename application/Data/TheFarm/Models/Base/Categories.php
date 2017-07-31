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
use TheFarm\Models\Files as ChildFiles;
use TheFarm\Models\FilesQuery as ChildFilesQuery;
use TheFarm\Models\ItemCategories as ChildItemCategories;
use TheFarm\Models\ItemCategoriesQuery as ChildItemCategoriesQuery;
use TheFarm\Models\Locations as ChildLocations;
use TheFarm\Models\LocationsQuery as ChildLocationsQuery;
use TheFarm\Models\Map\CategoriesTableMap;
use TheFarm\Models\Map\ItemCategoriesTableMap;

/**
 * Base class that represents a row from the 'tf_categories' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Categories implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\CategoriesTableMap';


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
     * The value for the cat_id field.
     *
     * @var        int
     */
    protected $cat_id;

    /**
     * The value for the cat_name field.
     *
     * @var        string
     */
    protected $cat_name;

    /**
     * The value for the cat_image field.
     *
     * @var        int
     */
    protected $cat_image;

    /**
     * The value for the cat_body field.
     *
     * @var        string
     */
    protected $cat_body;

    /**
     * The value for the parent_id field.
     *
     * @var        int
     */
    protected $parent_id;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the cat_bg_color field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $cat_bg_color;

    /**
     * @var        ChildFiles
     */
    protected $aFiles;

    /**
     * @var        ChildLocations
     */
    protected $aLocations;

    /**
     * @var        ChildCategories
     */
    protected $aCategoriesRelatedByParentId;

    /**
     * @var        ObjectCollection|ChildCategories[] Collection to store aggregation of ChildCategories objects.
     */
    protected $collCategoriessRelatedByCatId;
    protected $collCategoriessRelatedByCatIdPartial;

    /**
     * @var        ObjectCollection|ChildItemCategories[] Collection to store aggregation of ChildItemCategories objects.
     */
    protected $collItemCategoriess;
    protected $collItemCategoriessPartial;

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
    protected $categoriessRelatedByCatIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemCategories[]
     */
    protected $itemCategoriessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->cat_bg_color = '';
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Categories object.
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
     * Compares this with another <code>Categories</code> instance.  If
     * <code>obj</code> is an instance of <code>Categories</code>, delegates to
     * <code>equals(Categories)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Categories The current object, for fluid interface
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
     * Get the [cat_id] column value.
     *
     * @return int
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * Get the [cat_name] column value.
     *
     * @return string
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * Get the [cat_image] column value.
     *
     * @return int
     */
    public function getCatImage()
    {
        return $this->cat_image;
    }

    /**
     * Get the [cat_body] column value.
     *
     * @return string
     */
    public function getCatBody()
    {
        return $this->cat_body;
    }

    /**
     * Get the [parent_id] column value.
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
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
     * Get the [cat_bg_color] column value.
     *
     * @return string
     */
    public function getCatBgColor()
    {
        return $this->cat_bg_color;
    }

    /**
     * Set the value of [cat_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setCatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cat_id !== $v) {
            $this->cat_id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CAT_ID] = true;
        }

        return $this;
    } // setCatId()

    /**
     * Set the value of [cat_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setCatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_name !== $v) {
            $this->cat_name = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CAT_NAME] = true;
        }

        return $this;
    } // setCatName()

    /**
     * Set the value of [cat_image] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setCatImage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cat_image !== $v) {
            $this->cat_image = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CAT_IMAGE] = true;
        }

        if ($this->aFiles !== null && $this->aFiles->getFileId() !== $v) {
            $this->aFiles = null;
        }

        return $this;
    } // setCatImage()

    /**
     * Set the value of [cat_body] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setCatBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_body !== $v) {
            $this->cat_body = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CAT_BODY] = true;
        }

        return $this;
    } // setCatBody()

    /**
     * Set the value of [parent_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_PARENT_ID] = true;
        }

        if ($this->aCategoriesRelatedByParentId !== null && $this->aCategoriesRelatedByParentId->getCatId() !== $v) {
            $this->aCategoriesRelatedByParentId = null;
        }

        return $this;
    } // setParentId()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aLocations !== null && $this->aLocations->getLocationId() !== $v) {
            $this->aLocations = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [cat_bg_color] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function setCatBgColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_bg_color !== $v) {
            $this->cat_bg_color = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CAT_BG_COLOR] = true;
        }

        return $this;
    } // setCatBgColor()

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
            if ($this->cat_bg_color !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CategoriesTableMap::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CategoriesTableMap::translateFieldName('CatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CategoriesTableMap::translateFieldName('CatImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_image = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CategoriesTableMap::translateFieldName('CatBody', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CategoriesTableMap::translateFieldName('ParentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parent_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CategoriesTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CategoriesTableMap::translateFieldName('CatBgColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_bg_color = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = CategoriesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Categories'), 0, $e);
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
        if ($this->aFiles !== null && $this->cat_image !== $this->aFiles->getFileId()) {
            $this->aFiles = null;
        }
        if ($this->aCategoriesRelatedByParentId !== null && $this->parent_id !== $this->aCategoriesRelatedByParentId->getCatId()) {
            $this->aCategoriesRelatedByParentId = null;
        }
        if ($this->aLocations !== null && $this->location_id !== $this->aLocations->getLocationId()) {
            $this->aLocations = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CategoriesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCategoriesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFiles = null;
            $this->aLocations = null;
            $this->aCategoriesRelatedByParentId = null;
            $this->collCategoriessRelatedByCatId = null;

            $this->collItemCategoriess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Categories::setDeleted()
     * @see Categories::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCategoriesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
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
                CategoriesTableMap::addInstanceToPool($this);
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

            if ($this->aFiles !== null) {
                if ($this->aFiles->isModified() || $this->aFiles->isNew()) {
                    $affectedRows += $this->aFiles->save($con);
                }
                $this->setFiles($this->aFiles);
            }

            if ($this->aLocations !== null) {
                if ($this->aLocations->isModified() || $this->aLocations->isNew()) {
                    $affectedRows += $this->aLocations->save($con);
                }
                $this->setLocations($this->aLocations);
            }

            if ($this->aCategoriesRelatedByParentId !== null) {
                if ($this->aCategoriesRelatedByParentId->isModified() || $this->aCategoriesRelatedByParentId->isNew()) {
                    $affectedRows += $this->aCategoriesRelatedByParentId->save($con);
                }
                $this->setCategoriesRelatedByParentId($this->aCategoriesRelatedByParentId);
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

            if ($this->categoriessRelatedByCatIdScheduledForDeletion !== null) {
                if (!$this->categoriessRelatedByCatIdScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\CategoriesQuery::create()
                        ->filterByPrimaryKeys($this->categoriessRelatedByCatIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoriessRelatedByCatIdScheduledForDeletion = null;
                }
            }

            if ($this->collCategoriessRelatedByCatId !== null) {
                foreach ($this->collCategoriessRelatedByCatId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemCategoriessScheduledForDeletion !== null) {
                if (!$this->itemCategoriessScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemCategoriesQuery::create()
                        ->filterByPrimaryKeys($this->itemCategoriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemCategoriessScheduledForDeletion = null;
                }
            }

            if ($this->collItemCategoriess !== null) {
                foreach ($this->collItemCategoriess as $referrerFK) {
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

        $this->modifiedColumns[CategoriesTableMap::COL_CAT_ID] = true;
        if (null !== $this->cat_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CategoriesTableMap::COL_CAT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'cat_id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'cat_name';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'cat_image';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'cat_body';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'parent_id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_BG_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'cat_bg_color';
        }

        $sql = sprintf(
            'INSERT INTO tf_categories (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'cat_id':
                        $stmt->bindValue($identifier, $this->cat_id, PDO::PARAM_INT);
                        break;
                    case 'cat_name':
                        $stmt->bindValue($identifier, $this->cat_name, PDO::PARAM_STR);
                        break;
                    case 'cat_image':
                        $stmt->bindValue($identifier, $this->cat_image, PDO::PARAM_INT);
                        break;
                    case 'cat_body':
                        $stmt->bindValue($identifier, $this->cat_body, PDO::PARAM_STR);
                        break;
                    case 'parent_id':
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                    case 'location_id':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'cat_bg_color':
                        $stmt->bindValue($identifier, $this->cat_bg_color, PDO::PARAM_STR);
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
        $this->setCatId($pk);

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
        $pos = CategoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCatId();
                break;
            case 1:
                return $this->getCatName();
                break;
            case 2:
                return $this->getCatImage();
                break;
            case 3:
                return $this->getCatBody();
                break;
            case 4:
                return $this->getParentId();
                break;
            case 5:
                return $this->getLocationId();
                break;
            case 6:
                return $this->getCatBgColor();
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

        if (isset($alreadyDumpedObjects['Categories'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Categories'][$this->hashCode()] = true;
        $keys = CategoriesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCatId(),
            $keys[1] => $this->getCatName(),
            $keys[2] => $this->getCatImage(),
            $keys[3] => $this->getCatBody(),
            $keys[4] => $this->getParentId(),
            $keys[5] => $this->getLocationId(),
            $keys[6] => $this->getCatBgColor(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'files';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_files';
                        break;
                    default:
                        $key = 'Files';
                }

                $result[$key] = $this->aFiles->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLocations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'locations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_locations';
                        break;
                    default:
                        $key = 'Locations';
                }

                $result[$key] = $this->aLocations->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategoriesRelatedByParentId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_categories';
                        break;
                    default:
                        $key = 'Categories';
                }

                $result[$key] = $this->aCategoriesRelatedByParentId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCategoriessRelatedByCatId) {

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

                $result[$key] = $this->collCategoriessRelatedByCatId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItemCategoriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemCategoriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_item_categoriess';
                        break;
                    default:
                        $key = 'ItemCategoriess';
                }

                $result[$key] = $this->collItemCategoriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Categories
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CategoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Categories
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCatId($value);
                break;
            case 1:
                $this->setCatName($value);
                break;
            case 2:
                $this->setCatImage($value);
                break;
            case 3:
                $this->setCatBody($value);
                break;
            case 4:
                $this->setParentId($value);
                break;
            case 5:
                $this->setLocationId($value);
                break;
            case 6:
                $this->setCatBgColor($value);
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
        $keys = CategoriesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCatId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCatName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCatImage($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCatBody($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setParentId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLocationId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCatBgColor($arr[$keys[6]]);
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
     * @return $this|\TheFarm\Models\Categories The current object, for fluid interface
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
        $criteria = new Criteria(CategoriesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_ID)) {
            $criteria->add(CategoriesTableMap::COL_CAT_ID, $this->cat_id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_NAME)) {
            $criteria->add(CategoriesTableMap::COL_CAT_NAME, $this->cat_name);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_IMAGE)) {
            $criteria->add(CategoriesTableMap::COL_CAT_IMAGE, $this->cat_image);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_BODY)) {
            $criteria->add(CategoriesTableMap::COL_CAT_BODY, $this->cat_body);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_PARENT_ID)) {
            $criteria->add(CategoriesTableMap::COL_PARENT_ID, $this->parent_id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_LOCATION_ID)) {
            $criteria->add(CategoriesTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CAT_BG_COLOR)) {
            $criteria->add(CategoriesTableMap::COL_CAT_BG_COLOR, $this->cat_bg_color);
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
        $criteria = ChildCategoriesQuery::create();
        $criteria->add(CategoriesTableMap::COL_CAT_ID, $this->cat_id);

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
        $validPk = null !== $this->getCatId();

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
        return $this->getCatId();
    }

    /**
     * Generic method to set the primary key (cat_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCatId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCatId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Categories (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCatName($this->getCatName());
        $copyObj->setCatImage($this->getCatImage());
        $copyObj->setCatBody($this->getCatBody());
        $copyObj->setParentId($this->getParentId());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setCatBgColor($this->getCatBgColor());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCategoriessRelatedByCatId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategoriesRelatedByCatId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemCategories($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCatId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Categories Clone of current object.
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
     * Declares an association between this object and a ChildFiles object.
     *
     * @param  ChildFiles $v
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFiles(ChildFiles $v = null)
    {
        if ($v === null) {
            $this->setCatImage(NULL);
        } else {
            $this->setCatImage($v->getFileId());
        }

        $this->aFiles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFiles object, it will not be re-added.
        if ($v !== null) {
            $v->addCategories($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFiles object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFiles The associated ChildFiles object.
     * @throws PropelException
     */
    public function getFiles(ConnectionInterface $con = null)
    {
        if ($this->aFiles === null && ($this->cat_image !== null)) {
            $this->aFiles = ChildFilesQuery::create()->findPk($this->cat_image, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFiles->addCategoriess($this);
             */
        }

        return $this->aFiles;
    }

    /**
     * Declares an association between this object and a ChildLocations object.
     *
     * @param  ChildLocations $v
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLocations(ChildLocations $v = null)
    {
        if ($v === null) {
            $this->setLocationId(NULL);
        } else {
            $this->setLocationId($v->getLocationId());
        }

        $this->aLocations = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLocations object, it will not be re-added.
        if ($v !== null) {
            $v->addCategories($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLocations object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLocations The associated ChildLocations object.
     * @throws PropelException
     */
    public function getLocations(ConnectionInterface $con = null)
    {
        if ($this->aLocations === null && ($this->location_id !== null)) {
            $this->aLocations = ChildLocationsQuery::create()->findPk($this->location_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocations->addCategoriess($this);
             */
        }

        return $this->aLocations;
    }

    /**
     * Declares an association between this object and a ChildCategories object.
     *
     * @param  ChildCategories $v
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategoriesRelatedByParentId(ChildCategories $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getCatId());
        }

        $this->aCategoriesRelatedByParentId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategories object, it will not be re-added.
        if ($v !== null) {
            $v->addCategoriesRelatedByCatId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategories object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategories The associated ChildCategories object.
     * @throws PropelException
     */
    public function getCategoriesRelatedByParentId(ConnectionInterface $con = null)
    {
        if ($this->aCategoriesRelatedByParentId === null && ($this->parent_id !== null)) {
            $this->aCategoriesRelatedByParentId = ChildCategoriesQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoriesRelatedByParentId->addCategoriessRelatedByCatId($this);
             */
        }

        return $this->aCategoriesRelatedByParentId;
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
        if ('CategoriesRelatedByCatId' == $relationName) {
            $this->initCategoriessRelatedByCatId();
            return;
        }
        if ('ItemCategories' == $relationName) {
            $this->initItemCategoriess();
            return;
        }
    }

    /**
     * Clears out the collCategoriessRelatedByCatId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategoriessRelatedByCatId()
     */
    public function clearCategoriessRelatedByCatId()
    {
        $this->collCategoriessRelatedByCatId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategoriessRelatedByCatId collection loaded partially.
     */
    public function resetPartialCategoriessRelatedByCatId($v = true)
    {
        $this->collCategoriessRelatedByCatIdPartial = $v;
    }

    /**
     * Initializes the collCategoriessRelatedByCatId collection.
     *
     * By default this just sets the collCategoriessRelatedByCatId collection to an empty array (like clearcollCategoriessRelatedByCatId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoriessRelatedByCatId($overrideExisting = true)
    {
        if (null !== $this->collCategoriessRelatedByCatId && !$overrideExisting) {
            return;
        }

        $collectionClassName = CategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collCategoriessRelatedByCatId = new $collectionClassName;
        $this->collCategoriessRelatedByCatId->setModel('\TheFarm\Models\Categories');
    }

    /**
     * Gets an array of ChildCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     * @throws PropelException
     */
    public function getCategoriessRelatedByCatId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriessRelatedByCatIdPartial && !$this->isNew();
        if (null === $this->collCategoriessRelatedByCatId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoriessRelatedByCatId) {
                // return empty collection
                $this->initCategoriessRelatedByCatId();
            } else {
                $collCategoriessRelatedByCatId = ChildCategoriesQuery::create(null, $criteria)
                    ->filterByCategoriesRelatedByParentId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoriessRelatedByCatIdPartial && count($collCategoriessRelatedByCatId)) {
                        $this->initCategoriessRelatedByCatId(false);

                        foreach ($collCategoriessRelatedByCatId as $obj) {
                            if (false == $this->collCategoriessRelatedByCatId->contains($obj)) {
                                $this->collCategoriessRelatedByCatId->append($obj);
                            }
                        }

                        $this->collCategoriessRelatedByCatIdPartial = true;
                    }

                    return $collCategoriessRelatedByCatId;
                }

                if ($partial && $this->collCategoriessRelatedByCatId) {
                    foreach ($this->collCategoriessRelatedByCatId as $obj) {
                        if ($obj->isNew()) {
                            $collCategoriessRelatedByCatId[] = $obj;
                        }
                    }
                }

                $this->collCategoriessRelatedByCatId = $collCategoriessRelatedByCatId;
                $this->collCategoriessRelatedByCatIdPartial = false;
            }
        }

        return $this->collCategoriessRelatedByCatId;
    }

    /**
     * Sets a collection of ChildCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categoriessRelatedByCatId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategories The current object (for fluent API support)
     */
    public function setCategoriessRelatedByCatId(Collection $categoriessRelatedByCatId, ConnectionInterface $con = null)
    {
        /** @var ChildCategories[] $categoriessRelatedByCatIdToDelete */
        $categoriessRelatedByCatIdToDelete = $this->getCategoriessRelatedByCatId(new Criteria(), $con)->diff($categoriessRelatedByCatId);


        $this->categoriessRelatedByCatIdScheduledForDeletion = $categoriessRelatedByCatIdToDelete;

        foreach ($categoriessRelatedByCatIdToDelete as $categoriesRelatedByCatIdRemoved) {
            $categoriesRelatedByCatIdRemoved->setCategoriesRelatedByParentId(null);
        }

        $this->collCategoriessRelatedByCatId = null;
        foreach ($categoriessRelatedByCatId as $categoriesRelatedByCatId) {
            $this->addCategoriesRelatedByCatId($categoriesRelatedByCatId);
        }

        $this->collCategoriessRelatedByCatId = $categoriessRelatedByCatId;
        $this->collCategoriessRelatedByCatIdPartial = false;

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
    public function countCategoriessRelatedByCatId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriessRelatedByCatIdPartial && !$this->isNew();
        if (null === $this->collCategoriessRelatedByCatId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoriessRelatedByCatId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoriessRelatedByCatId());
            }

            $query = ChildCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategoriesRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collCategoriessRelatedByCatId);
    }

    /**
     * Method called to associate a ChildCategories object to this object
     * through the ChildCategories foreign key attribute.
     *
     * @param  ChildCategories $l ChildCategories
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function addCategoriesRelatedByCatId(ChildCategories $l)
    {
        if ($this->collCategoriessRelatedByCatId === null) {
            $this->initCategoriessRelatedByCatId();
            $this->collCategoriessRelatedByCatIdPartial = true;
        }

        if (!$this->collCategoriessRelatedByCatId->contains($l)) {
            $this->doAddCategoriesRelatedByCatId($l);

            if ($this->categoriessRelatedByCatIdScheduledForDeletion and $this->categoriessRelatedByCatIdScheduledForDeletion->contains($l)) {
                $this->categoriessRelatedByCatIdScheduledForDeletion->remove($this->categoriessRelatedByCatIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCategories $categoriesRelatedByCatId The ChildCategories object to add.
     */
    protected function doAddCategoriesRelatedByCatId(ChildCategories $categoriesRelatedByCatId)
    {
        $this->collCategoriessRelatedByCatId[]= $categoriesRelatedByCatId;
        $categoriesRelatedByCatId->setCategoriesRelatedByParentId($this);
    }

    /**
     * @param  ChildCategories $categoriesRelatedByCatId The ChildCategories object to remove.
     * @return $this|ChildCategories The current object (for fluent API support)
     */
    public function removeCategoriesRelatedByCatId(ChildCategories $categoriesRelatedByCatId)
    {
        if ($this->getCategoriessRelatedByCatId()->contains($categoriesRelatedByCatId)) {
            $pos = $this->collCategoriessRelatedByCatId->search($categoriesRelatedByCatId);
            $this->collCategoriessRelatedByCatId->remove($pos);
            if (null === $this->categoriessRelatedByCatIdScheduledForDeletion) {
                $this->categoriessRelatedByCatIdScheduledForDeletion = clone $this->collCategoriessRelatedByCatId;
                $this->categoriessRelatedByCatIdScheduledForDeletion->clear();
            }
            $this->categoriessRelatedByCatIdScheduledForDeletion[]= clone $categoriesRelatedByCatId;
            $categoriesRelatedByCatId->setCategoriesRelatedByParentId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related CategoriessRelatedByCatId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     */
    public function getCategoriessRelatedByCatIdJoinFiles(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('Files', $joinBehavior);

        return $this->getCategoriessRelatedByCatId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related CategoriessRelatedByCatId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     */
    public function getCategoriessRelatedByCatIdJoinLocations(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('Locations', $joinBehavior);

        return $this->getCategoriessRelatedByCatId($query, $con);
    }

    /**
     * Clears out the collItemCategoriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemCategoriess()
     */
    public function clearItemCategoriess()
    {
        $this->collItemCategoriess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemCategoriess collection loaded partially.
     */
    public function resetPartialItemCategoriess($v = true)
    {
        $this->collItemCategoriessPartial = $v;
    }

    /**
     * Initializes the collItemCategoriess collection.
     *
     * By default this just sets the collItemCategoriess collection to an empty array (like clearcollItemCategoriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemCategoriess($overrideExisting = true)
    {
        if (null !== $this->collItemCategoriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemCategoriesTableMap::getTableMap()->getCollectionClassName();

        $this->collItemCategoriess = new $collectionClassName;
        $this->collItemCategoriess->setModel('\TheFarm\Models\ItemCategories');
    }

    /**
     * Gets an array of ChildItemCategories objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemCategories[] List of ChildItemCategories objects
     * @throws PropelException
     */
    public function getItemCategoriess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemCategoriessPartial && !$this->isNew();
        if (null === $this->collItemCategoriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemCategoriess) {
                // return empty collection
                $this->initItemCategoriess();
            } else {
                $collItemCategoriess = ChildItemCategoriesQuery::create(null, $criteria)
                    ->filterByCategories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemCategoriessPartial && count($collItemCategoriess)) {
                        $this->initItemCategoriess(false);

                        foreach ($collItemCategoriess as $obj) {
                            if (false == $this->collItemCategoriess->contains($obj)) {
                                $this->collItemCategoriess->append($obj);
                            }
                        }

                        $this->collItemCategoriessPartial = true;
                    }

                    return $collItemCategoriess;
                }

                if ($partial && $this->collItemCategoriess) {
                    foreach ($this->collItemCategoriess as $obj) {
                        if ($obj->isNew()) {
                            $collItemCategoriess[] = $obj;
                        }
                    }
                }

                $this->collItemCategoriess = $collItemCategoriess;
                $this->collItemCategoriessPartial = false;
            }
        }

        return $this->collItemCategoriess;
    }

    /**
     * Sets a collection of ChildItemCategories objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemCategoriess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategories The current object (for fluent API support)
     */
    public function setItemCategoriess(Collection $itemCategoriess, ConnectionInterface $con = null)
    {
        /** @var ChildItemCategories[] $itemCategoriessToDelete */
        $itemCategoriessToDelete = $this->getItemCategoriess(new Criteria(), $con)->diff($itemCategoriess);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->itemCategoriessScheduledForDeletion = clone $itemCategoriessToDelete;

        foreach ($itemCategoriessToDelete as $itemCategoriesRemoved) {
            $itemCategoriesRemoved->setCategories(null);
        }

        $this->collItemCategoriess = null;
        foreach ($itemCategoriess as $itemCategories) {
            $this->addItemCategories($itemCategories);
        }

        $this->collItemCategoriess = $itemCategoriess;
        $this->collItemCategoriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemCategories objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemCategories objects.
     * @throws PropelException
     */
    public function countItemCategoriess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemCategoriessPartial && !$this->isNew();
        if (null === $this->collItemCategoriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemCategoriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemCategoriess());
            }

            $query = ChildItemCategoriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategories($this)
                ->count($con);
        }

        return count($this->collItemCategoriess);
    }

    /**
     * Method called to associate a ChildItemCategories object to this object
     * through the ChildItemCategories foreign key attribute.
     *
     * @param  ChildItemCategories $l ChildItemCategories
     * @return $this|\TheFarm\Models\Categories The current object (for fluent API support)
     */
    public function addItemCategories(ChildItemCategories $l)
    {
        if ($this->collItemCategoriess === null) {
            $this->initItemCategoriess();
            $this->collItemCategoriessPartial = true;
        }

        if (!$this->collItemCategoriess->contains($l)) {
            $this->doAddItemCategories($l);

            if ($this->itemCategoriessScheduledForDeletion and $this->itemCategoriessScheduledForDeletion->contains($l)) {
                $this->itemCategoriessScheduledForDeletion->remove($this->itemCategoriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemCategories $itemCategories The ChildItemCategories object to add.
     */
    protected function doAddItemCategories(ChildItemCategories $itemCategories)
    {
        $this->collItemCategoriess[]= $itemCategories;
        $itemCategories->setCategories($this);
    }

    /**
     * @param  ChildItemCategories $itemCategories The ChildItemCategories object to remove.
     * @return $this|ChildCategories The current object (for fluent API support)
     */
    public function removeItemCategories(ChildItemCategories $itemCategories)
    {
        if ($this->getItemCategoriess()->contains($itemCategories)) {
            $pos = $this->collItemCategoriess->search($itemCategories);
            $this->collItemCategoriess->remove($pos);
            if (null === $this->itemCategoriessScheduledForDeletion) {
                $this->itemCategoriessScheduledForDeletion = clone $this->collItemCategoriess;
                $this->itemCategoriessScheduledForDeletion->clear();
            }
            $this->itemCategoriessScheduledForDeletion[]= clone $itemCategories;
            $itemCategories->setCategories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related ItemCategoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemCategories[] List of ChildItemCategories objects
     */
    public function getItemCategoriessJoinItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemCategoriesQuery::create(null, $criteria);
        $query->joinWith('Items', $joinBehavior);

        return $this->getItemCategoriess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFiles) {
            $this->aFiles->removeCategories($this);
        }
        if (null !== $this->aLocations) {
            $this->aLocations->removeCategories($this);
        }
        if (null !== $this->aCategoriesRelatedByParentId) {
            $this->aCategoriesRelatedByParentId->removeCategoriesRelatedByCatId($this);
        }
        $this->cat_id = null;
        $this->cat_name = null;
        $this->cat_image = null;
        $this->cat_body = null;
        $this->parent_id = null;
        $this->location_id = null;
        $this->cat_bg_color = null;
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
            if ($this->collCategoriessRelatedByCatId) {
                foreach ($this->collCategoriessRelatedByCatId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemCategoriess) {
                foreach ($this->collItemCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCategoriessRelatedByCatId = null;
        $this->collItemCategoriess = null;
        $this->aFiles = null;
        $this->aLocations = null;
        $this->aCategoriesRelatedByParentId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CategoriesTableMap::DEFAULT_STRING_FORMAT);
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
