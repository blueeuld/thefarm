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
use TheFarm\Models\Category as ChildCategory;
use TheFarm\Models\CategoryQuery as ChildCategoryQuery;
use TheFarm\Models\File as ChildFile;
use TheFarm\Models\FileQuery as ChildFileQuery;
use TheFarm\Models\ItemCategory as ChildItemCategory;
use TheFarm\Models\ItemCategoryQuery as ChildItemCategoryQuery;
use TheFarm\Models\Location as ChildLocation;
use TheFarm\Models\LocationQuery as ChildLocationQuery;
use TheFarm\Models\Map\CategoryTableMap;
use TheFarm\Models\Map\ItemCategoryTableMap;

/**
 * Base class that represents a row from the 'tf_categories' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Category implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\CategoryTableMap';


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
     * @var        ChildFile
     */
    protected $aFile;

    /**
     * @var        ChildLocation
     */
    protected $aLocation;

    /**
     * @var        ChildCategory
     */
    protected $aCategoryRelatedByParentId;

    /**
     * @var        ObjectCollection|ChildCategory[] Collection to store aggregation of ChildCategory objects.
     */
    protected $collCategoriesRelatedByCatId;
    protected $collCategoriesRelatedByCatIdPartial;

    /**
     * @var        ObjectCollection|ChildItemCategory[] Collection to store aggregation of ChildItemCategory objects.
     */
    protected $collItemCategories;
    protected $collItemCategoriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCategory[]
     */
    protected $categoriesRelatedByCatIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemCategory[]
     */
    protected $itemCategoriesScheduledForDeletion = null;

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
     * Initializes internal state of TheFarm\Models\Base\Category object.
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
     * Compares this with another <code>Category</code> instance.  If
     * <code>obj</code> is an instance of <code>Category</code>, delegates to
     * <code>equals(Category)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Category The current object, for fluid interface
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
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setCatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cat_id !== $v) {
            $this->cat_id = $v;
            $this->modifiedColumns[CategoryTableMap::COL_CAT_ID] = true;
        }

        return $this;
    } // setCatId()

    /**
     * Set the value of [cat_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setCatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_name !== $v) {
            $this->cat_name = $v;
            $this->modifiedColumns[CategoryTableMap::COL_CAT_NAME] = true;
        }

        return $this;
    } // setCatName()

    /**
     * Set the value of [cat_image] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setCatImage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cat_image !== $v) {
            $this->cat_image = $v;
            $this->modifiedColumns[CategoryTableMap::COL_CAT_IMAGE] = true;
        }

        if ($this->aFile !== null && $this->aFile->getFileId() !== $v) {
            $this->aFile = null;
        }

        return $this;
    } // setCatImage()

    /**
     * Set the value of [cat_body] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setCatBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_body !== $v) {
            $this->cat_body = $v;
            $this->modifiedColumns[CategoryTableMap::COL_CAT_BODY] = true;
        }

        return $this;
    } // setCatBody()

    /**
     * Set the value of [parent_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[CategoryTableMap::COL_PARENT_ID] = true;
        }

        if ($this->aCategoryRelatedByParentId !== null && $this->aCategoryRelatedByParentId->getCatId() !== $v) {
            $this->aCategoryRelatedByParentId = null;
        }

        return $this;
    } // setParentId()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[CategoryTableMap::COL_LOCATION_ID] = true;
        }

        if ($this->aLocation !== null && $this->aLocation->getLocationId() !== $v) {
            $this->aLocation = null;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [cat_bg_color] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function setCatBgColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cat_bg_color !== $v) {
            $this->cat_bg_color = $v;
            $this->modifiedColumns[CategoryTableMap::COL_CAT_BG_COLOR] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CategoryTableMap::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CategoryTableMap::translateFieldName('CatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CategoryTableMap::translateFieldName('CatImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_image = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CategoryTableMap::translateFieldName('CatBody', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CategoryTableMap::translateFieldName('ParentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parent_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CategoryTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CategoryTableMap::translateFieldName('CatBgColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cat_bg_color = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = CategoryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Category'), 0, $e);
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
        if ($this->aFile !== null && $this->cat_image !== $this->aFile->getFileId()) {
            $this->aFile = null;
        }
        if ($this->aCategoryRelatedByParentId !== null && $this->parent_id !== $this->aCategoryRelatedByParentId->getCatId()) {
            $this->aCategoryRelatedByParentId = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(CategoryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCategoryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFile = null;
            $this->aLocation = null;
            $this->aCategoryRelatedByParentId = null;
            $this->collCategoriesRelatedByCatId = null;

            $this->collItemCategories = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Category::setDeleted()
     * @see Category::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCategoryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
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
                CategoryTableMap::addInstanceToPool($this);
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

            if ($this->aFile !== null) {
                if ($this->aFile->isModified() || $this->aFile->isNew()) {
                    $affectedRows += $this->aFile->save($con);
                }
                $this->setFile($this->aFile);
            }

            if ($this->aLocation !== null) {
                if ($this->aLocation->isModified() || $this->aLocation->isNew()) {
                    $affectedRows += $this->aLocation->save($con);
                }
                $this->setLocation($this->aLocation);
            }

            if ($this->aCategoryRelatedByParentId !== null) {
                if ($this->aCategoryRelatedByParentId->isModified() || $this->aCategoryRelatedByParentId->isNew()) {
                    $affectedRows += $this->aCategoryRelatedByParentId->save($con);
                }
                $this->setCategoryRelatedByParentId($this->aCategoryRelatedByParentId);
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

            if ($this->categoriesRelatedByCatIdScheduledForDeletion !== null) {
                if (!$this->categoriesRelatedByCatIdScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\CategoryQuery::create()
                        ->filterByPrimaryKeys($this->categoriesRelatedByCatIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoriesRelatedByCatIdScheduledForDeletion = null;
                }
            }

            if ($this->collCategoriesRelatedByCatId !== null) {
                foreach ($this->collCategoriesRelatedByCatId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemCategoriesScheduledForDeletion !== null) {
                if (!$this->itemCategoriesScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemCategoryQuery::create()
                        ->filterByPrimaryKeys($this->itemCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collItemCategories !== null) {
                foreach ($this->collItemCategories as $referrerFK) {
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

        $this->modifiedColumns[CategoryTableMap::COL_CAT_ID] = true;
        if (null !== $this->cat_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CategoryTableMap::COL_CAT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'cat_id';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'cat_name';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'cat_image';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'cat_body';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'parent_id';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_BG_COLOR)) {
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
        $pos = CategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

        if (isset($alreadyDumpedObjects['Category'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Category'][$this->hashCode()] = true;
        $keys = CategoryTableMap::getFieldNames($keyType);
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
            if (null !== $this->aFile) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'file';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_files';
                        break;
                    default:
                        $key = 'File';
                }

                $result[$key] = $this->aFile->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aCategoryRelatedByParentId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'category';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_categories';
                        break;
                    default:
                        $key = 'Category';
                }

                $result[$key] = $this->aCategoryRelatedByParentId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCategoriesRelatedByCatId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_categoriess';
                        break;
                    default:
                        $key = 'Categories';
                }

                $result[$key] = $this->collCategoriesRelatedByCatId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItemCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_item_categoriess';
                        break;
                    default:
                        $key = 'ItemCategories';
                }

                $result[$key] = $this->collItemCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Category
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Category
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
        $keys = CategoryTableMap::getFieldNames($keyType);

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
     * @return $this|\TheFarm\Models\Category The current object, for fluid interface
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
        $criteria = new Criteria(CategoryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CategoryTableMap::COL_CAT_ID)) {
            $criteria->add(CategoryTableMap::COL_CAT_ID, $this->cat_id);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_NAME)) {
            $criteria->add(CategoryTableMap::COL_CAT_NAME, $this->cat_name);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_IMAGE)) {
            $criteria->add(CategoryTableMap::COL_CAT_IMAGE, $this->cat_image);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_BODY)) {
            $criteria->add(CategoryTableMap::COL_CAT_BODY, $this->cat_body);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_PARENT_ID)) {
            $criteria->add(CategoryTableMap::COL_PARENT_ID, $this->parent_id);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_LOCATION_ID)) {
            $criteria->add(CategoryTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(CategoryTableMap::COL_CAT_BG_COLOR)) {
            $criteria->add(CategoryTableMap::COL_CAT_BG_COLOR, $this->cat_bg_color);
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
        $criteria = ChildCategoryQuery::create();
        $criteria->add(CategoryTableMap::COL_CAT_ID, $this->cat_id);

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
     * @param      object $copyObj An object of \TheFarm\Models\Category (or compatible) type.
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

            foreach ($this->getCategoriesRelatedByCatId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategoryRelatedByCatId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemCategory($relObj->copy($deepCopy));
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
     * @return \TheFarm\Models\Category Clone of current object.
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
     * Declares an association between this object and a ChildFile object.
     *
     * @param  ChildFile $v
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFile(ChildFile $v = null)
    {
        if ($v === null) {
            $this->setCatImage(NULL);
        } else {
            $this->setCatImage($v->getFileId());
        }

        $this->aFile = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFile object, it will not be re-added.
        if ($v !== null) {
            $v->addCategory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFile object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFile The associated ChildFile object.
     * @throws PropelException
     */
    public function getFile(ConnectionInterface $con = null)
    {
        if ($this->aFile === null && ($this->cat_image !== null)) {
            $this->aFile = ChildFileQuery::create()->findPk($this->cat_image, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFile->addCategories($this);
             */
        }

        return $this->aFile;
    }

    /**
     * Declares an association between this object and a ChildLocation object.
     *
     * @param  ChildLocation $v
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
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
            $v->addCategory($this);
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
                $this->aLocation->addCategories($this);
             */
        }

        return $this->aLocation;
    }

    /**
     * Declares an association between this object and a ChildCategory object.
     *
     * @param  ChildCategory $v
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategoryRelatedByParentId(ChildCategory $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getCatId());
        }

        $this->aCategoryRelatedByParentId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addCategoryRelatedByCatId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategory object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategory The associated ChildCategory object.
     * @throws PropelException
     */
    public function getCategoryRelatedByParentId(ConnectionInterface $con = null)
    {
        if ($this->aCategoryRelatedByParentId === null && ($this->parent_id !== null)) {
            $this->aCategoryRelatedByParentId = ChildCategoryQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoryRelatedByParentId->addCategoriesRelatedByCatId($this);
             */
        }

        return $this->aCategoryRelatedByParentId;
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
        if ('CategoryRelatedByCatId' == $relationName) {
            $this->initCategoriesRelatedByCatId();
            return;
        }
        if ('ItemCategory' == $relationName) {
            $this->initItemCategories();
            return;
        }
    }

    /**
     * Clears out the collCategoriesRelatedByCatId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategoriesRelatedByCatId()
     */
    public function clearCategoriesRelatedByCatId()
    {
        $this->collCategoriesRelatedByCatId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategoriesRelatedByCatId collection loaded partially.
     */
    public function resetPartialCategoriesRelatedByCatId($v = true)
    {
        $this->collCategoriesRelatedByCatIdPartial = $v;
    }

    /**
     * Initializes the collCategoriesRelatedByCatId collection.
     *
     * By default this just sets the collCategoriesRelatedByCatId collection to an empty array (like clearcollCategoriesRelatedByCatId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoriesRelatedByCatId($overrideExisting = true)
    {
        if (null !== $this->collCategoriesRelatedByCatId && !$overrideExisting) {
            return;
        }

        $collectionClassName = CategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collCategoriesRelatedByCatId = new $collectionClassName;
        $this->collCategoriesRelatedByCatId->setModel('\TheFarm\Models\Category');
    }

    /**
     * Gets an array of ChildCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     * @throws PropelException
     */
    public function getCategoriesRelatedByCatId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriesRelatedByCatIdPartial && !$this->isNew();
        if (null === $this->collCategoriesRelatedByCatId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoriesRelatedByCatId) {
                // return empty collection
                $this->initCategoriesRelatedByCatId();
            } else {
                $collCategoriesRelatedByCatId = ChildCategoryQuery::create(null, $criteria)
                    ->filterByCategoryRelatedByParentId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoriesRelatedByCatIdPartial && count($collCategoriesRelatedByCatId)) {
                        $this->initCategoriesRelatedByCatId(false);

                        foreach ($collCategoriesRelatedByCatId as $obj) {
                            if (false == $this->collCategoriesRelatedByCatId->contains($obj)) {
                                $this->collCategoriesRelatedByCatId->append($obj);
                            }
                        }

                        $this->collCategoriesRelatedByCatIdPartial = true;
                    }

                    return $collCategoriesRelatedByCatId;
                }

                if ($partial && $this->collCategoriesRelatedByCatId) {
                    foreach ($this->collCategoriesRelatedByCatId as $obj) {
                        if ($obj->isNew()) {
                            $collCategoriesRelatedByCatId[] = $obj;
                        }
                    }
                }

                $this->collCategoriesRelatedByCatId = $collCategoriesRelatedByCatId;
                $this->collCategoriesRelatedByCatIdPartial = false;
            }
        }

        return $this->collCategoriesRelatedByCatId;
    }

    /**
     * Sets a collection of ChildCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categoriesRelatedByCatId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategory The current object (for fluent API support)
     */
    public function setCategoriesRelatedByCatId(Collection $categoriesRelatedByCatId, ConnectionInterface $con = null)
    {
        /** @var ChildCategory[] $categoriesRelatedByCatIdToDelete */
        $categoriesRelatedByCatIdToDelete = $this->getCategoriesRelatedByCatId(new Criteria(), $con)->diff($categoriesRelatedByCatId);


        $this->categoriesRelatedByCatIdScheduledForDeletion = $categoriesRelatedByCatIdToDelete;

        foreach ($categoriesRelatedByCatIdToDelete as $categoryRelatedByCatIdRemoved) {
            $categoryRelatedByCatIdRemoved->setCategoryRelatedByParentId(null);
        }

        $this->collCategoriesRelatedByCatId = null;
        foreach ($categoriesRelatedByCatId as $categoryRelatedByCatId) {
            $this->addCategoryRelatedByCatId($categoryRelatedByCatId);
        }

        $this->collCategoriesRelatedByCatId = $categoriesRelatedByCatId;
        $this->collCategoriesRelatedByCatIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Category objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Category objects.
     * @throws PropelException
     */
    public function countCategoriesRelatedByCatId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriesRelatedByCatIdPartial && !$this->isNew();
        if (null === $this->collCategoriesRelatedByCatId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoriesRelatedByCatId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoriesRelatedByCatId());
            }

            $query = ChildCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategoryRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collCategoriesRelatedByCatId);
    }

    /**
     * Method called to associate a ChildCategory object to this object
     * through the ChildCategory foreign key attribute.
     *
     * @param  ChildCategory $l ChildCategory
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function addCategoryRelatedByCatId(ChildCategory $l)
    {
        if ($this->collCategoriesRelatedByCatId === null) {
            $this->initCategoriesRelatedByCatId();
            $this->collCategoriesRelatedByCatIdPartial = true;
        }

        if (!$this->collCategoriesRelatedByCatId->contains($l)) {
            $this->doAddCategoryRelatedByCatId($l);

            if ($this->categoriesRelatedByCatIdScheduledForDeletion and $this->categoriesRelatedByCatIdScheduledForDeletion->contains($l)) {
                $this->categoriesRelatedByCatIdScheduledForDeletion->remove($this->categoriesRelatedByCatIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCategory $categoryRelatedByCatId The ChildCategory object to add.
     */
    protected function doAddCategoryRelatedByCatId(ChildCategory $categoryRelatedByCatId)
    {
        $this->collCategoriesRelatedByCatId[]= $categoryRelatedByCatId;
        $categoryRelatedByCatId->setCategoryRelatedByParentId($this);
    }

    /**
     * @param  ChildCategory $categoryRelatedByCatId The ChildCategory object to remove.
     * @return $this|ChildCategory The current object (for fluent API support)
     */
    public function removeCategoryRelatedByCatId(ChildCategory $categoryRelatedByCatId)
    {
        if ($this->getCategoriesRelatedByCatId()->contains($categoryRelatedByCatId)) {
            $pos = $this->collCategoriesRelatedByCatId->search($categoryRelatedByCatId);
            $this->collCategoriesRelatedByCatId->remove($pos);
            if (null === $this->categoriesRelatedByCatIdScheduledForDeletion) {
                $this->categoriesRelatedByCatIdScheduledForDeletion = clone $this->collCategoriesRelatedByCatId;
                $this->categoriesRelatedByCatIdScheduledForDeletion->clear();
            }
            $this->categoriesRelatedByCatIdScheduledForDeletion[]= clone $categoryRelatedByCatId;
            $categoryRelatedByCatId->setCategoryRelatedByParentId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Category is new, it will return
     * an empty collection; or if this Category has previously
     * been saved, it will retrieve related CategoriesRelatedByCatId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Category.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     */
    public function getCategoriesRelatedByCatIdJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getCategoriesRelatedByCatId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Category is new, it will return
     * an empty collection; or if this Category has previously
     * been saved, it will retrieve related CategoriesRelatedByCatId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Category.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     */
    public function getCategoriesRelatedByCatIdJoinLocation(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryQuery::create(null, $criteria);
        $query->joinWith('Location', $joinBehavior);

        return $this->getCategoriesRelatedByCatId($query, $con);
    }

    /**
     * Clears out the collItemCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemCategories()
     */
    public function clearItemCategories()
    {
        $this->collItemCategories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemCategories collection loaded partially.
     */
    public function resetPartialItemCategories($v = true)
    {
        $this->collItemCategoriesPartial = $v;
    }

    /**
     * Initializes the collItemCategories collection.
     *
     * By default this just sets the collItemCategories collection to an empty array (like clearcollItemCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemCategories($overrideExisting = true)
    {
        if (null !== $this->collItemCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collItemCategories = new $collectionClassName;
        $this->collItemCategories->setModel('\TheFarm\Models\ItemCategory');
    }

    /**
     * Gets an array of ChildItemCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemCategory[] List of ChildItemCategory objects
     * @throws PropelException
     */
    public function getItemCategories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemCategoriesPartial && !$this->isNew();
        if (null === $this->collItemCategories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemCategories) {
                // return empty collection
                $this->initItemCategories();
            } else {
                $collItemCategories = ChildItemCategoryQuery::create(null, $criteria)
                    ->filterByCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemCategoriesPartial && count($collItemCategories)) {
                        $this->initItemCategories(false);

                        foreach ($collItemCategories as $obj) {
                            if (false == $this->collItemCategories->contains($obj)) {
                                $this->collItemCategories->append($obj);
                            }
                        }

                        $this->collItemCategoriesPartial = true;
                    }

                    return $collItemCategories;
                }

                if ($partial && $this->collItemCategories) {
                    foreach ($this->collItemCategories as $obj) {
                        if ($obj->isNew()) {
                            $collItemCategories[] = $obj;
                        }
                    }
                }

                $this->collItemCategories = $collItemCategories;
                $this->collItemCategoriesPartial = false;
            }
        }

        return $this->collItemCategories;
    }

    /**
     * Sets a collection of ChildItemCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemCategories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategory The current object (for fluent API support)
     */
    public function setItemCategories(Collection $itemCategories, ConnectionInterface $con = null)
    {
        /** @var ChildItemCategory[] $itemCategoriesToDelete */
        $itemCategoriesToDelete = $this->getItemCategories(new Criteria(), $con)->diff($itemCategories);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->itemCategoriesScheduledForDeletion = clone $itemCategoriesToDelete;

        foreach ($itemCategoriesToDelete as $itemCategoryRemoved) {
            $itemCategoryRemoved->setCategory(null);
        }

        $this->collItemCategories = null;
        foreach ($itemCategories as $itemCategory) {
            $this->addItemCategory($itemCategory);
        }

        $this->collItemCategories = $itemCategories;
        $this->collItemCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemCategory objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemCategory objects.
     * @throws PropelException
     */
    public function countItemCategories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemCategoriesPartial && !$this->isNew();
        if (null === $this->collItemCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemCategories());
            }

            $query = ChildItemCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategory($this)
                ->count($con);
        }

        return count($this->collItemCategories);
    }

    /**
     * Method called to associate a ChildItemCategory object to this object
     * through the ChildItemCategory foreign key attribute.
     *
     * @param  ChildItemCategory $l ChildItemCategory
     * @return $this|\TheFarm\Models\Category The current object (for fluent API support)
     */
    public function addItemCategory(ChildItemCategory $l)
    {
        if ($this->collItemCategories === null) {
            $this->initItemCategories();
            $this->collItemCategoriesPartial = true;
        }

        if (!$this->collItemCategories->contains($l)) {
            $this->doAddItemCategory($l);

            if ($this->itemCategoriesScheduledForDeletion and $this->itemCategoriesScheduledForDeletion->contains($l)) {
                $this->itemCategoriesScheduledForDeletion->remove($this->itemCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemCategory $itemCategory The ChildItemCategory object to add.
     */
    protected function doAddItemCategory(ChildItemCategory $itemCategory)
    {
        $this->collItemCategories[]= $itemCategory;
        $itemCategory->setCategory($this);
    }

    /**
     * @param  ChildItemCategory $itemCategory The ChildItemCategory object to remove.
     * @return $this|ChildCategory The current object (for fluent API support)
     */
    public function removeItemCategory(ChildItemCategory $itemCategory)
    {
        if ($this->getItemCategories()->contains($itemCategory)) {
            $pos = $this->collItemCategories->search($itemCategory);
            $this->collItemCategories->remove($pos);
            if (null === $this->itemCategoriesScheduledForDeletion) {
                $this->itemCategoriesScheduledForDeletion = clone $this->collItemCategories;
                $this->itemCategoriesScheduledForDeletion->clear();
            }
            $this->itemCategoriesScheduledForDeletion[]= clone $itemCategory;
            $itemCategory->setCategory(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Category is new, it will return
     * an empty collection; or if this Category has previously
     * been saved, it will retrieve related ItemCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Category.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemCategory[] List of ChildItemCategory objects
     */
    public function getItemCategoriesJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemCategoryQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getItemCategories($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFile) {
            $this->aFile->removeCategory($this);
        }
        if (null !== $this->aLocation) {
            $this->aLocation->removeCategory($this);
        }
        if (null !== $this->aCategoryRelatedByParentId) {
            $this->aCategoryRelatedByParentId->removeCategoryRelatedByCatId($this);
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
            if ($this->collCategoriesRelatedByCatId) {
                foreach ($this->collCategoriesRelatedByCatId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemCategories) {
                foreach ($this->collItemCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCategoriesRelatedByCatId = null;
        $this->collItemCategories = null;
        $this->aFile = null;
        $this->aLocation = null;
        $this->aCategoryRelatedByParentId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CategoryTableMap::DEFAULT_STRING_FORMAT);
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
