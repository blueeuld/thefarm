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
use TheFarm\Models\Categories as ChildCategories;
use TheFarm\Models\CategoriesQuery as ChildCategoriesQuery;
use TheFarm\Models\Files as ChildFiles;
use TheFarm\Models\FilesQuery as ChildFilesQuery;
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\Map\BookingAttachmentsTableMap;
use TheFarm\Models\Map\CategoriesTableMap;
use TheFarm\Models\Map\FilesTableMap;
use TheFarm\Models\Map\ItemsTableMap;

/**
 * Base class that represents a row from the 'tf_files' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Files implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\FilesTableMap';


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
     * The value for the file_id field.
     *
     * @var        int
     */
    protected $file_id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the file_name field.
     *
     * @var        string
     */
    protected $file_name;

    /**
     * The value for the file_size field.
     *
     * @var        int
     */
    protected $file_size;

    /**
     * The value for the upload_id field.
     *
     * @var        int
     */
    protected $upload_id;

    /**
     * The value for the upload_date field.
     *
     * @var        int
     */
    protected $upload_date;

    /**
     * The value for the location_id field.
     *
     * @var        int
     */
    protected $location_id;

    /**
     * The value for the last_viewed field.
     *
     * @var        int
     */
    protected $last_viewed;

    /**
     * The value for the viewed_by field.
     *
     * @var        int
     */
    protected $viewed_by;

    /**
     * @var        ObjectCollection|ChildBookingAttachments[] Collection to store aggregation of ChildBookingAttachments objects.
     */
    protected $collBookingAttachmentss;
    protected $collBookingAttachmentssPartial;

    /**
     * @var        ObjectCollection|ChildCategories[] Collection to store aggregation of ChildCategories objects.
     */
    protected $collCategoriess;
    protected $collCategoriessPartial;

    /**
     * @var        ObjectCollection|ChildItems[] Collection to store aggregation of ChildItems objects.
     */
    protected $collItemss;
    protected $collItemssPartial;

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
     * @var ObjectCollection|ChildCategories[]
     */
    protected $categoriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItems[]
     */
    protected $itemssScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\Files object.
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
     * Compares this with another <code>Files</code> instance.  If
     * <code>obj</code> is an instance of <code>Files</code>, delegates to
     * <code>equals(Files)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Files The current object, for fluid interface
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
     * Get the [file_id] column value.
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->file_id;
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
     * Get the [file_name] column value.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Get the [file_size] column value.
     *
     * @return int
     */
    public function getFileSize()
    {
        return $this->file_size;
    }

    /**
     * Get the [upload_id] column value.
     *
     * @return int
     */
    public function getUploadId()
    {
        return $this->upload_id;
    }

    /**
     * Get the [upload_date] column value.
     *
     * @return int
     */
    public function getUploadDate()
    {
        return $this->upload_date;
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
     * Get the [last_viewed] column value.
     *
     * @return int
     */
    public function getLastViewed()
    {
        return $this->last_viewed;
    }

    /**
     * Get the [viewed_by] column value.
     *
     * @return int
     */
    public function getViewedBy()
    {
        return $this->viewed_by;
    }

    /**
     * Set the value of [file_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setFileId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->file_id !== $v) {
            $this->file_id = $v;
            $this->modifiedColumns[FilesTableMap::COL_FILE_ID] = true;
        }

        return $this;
    } // setFileId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[FilesTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [file_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setFileName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_name !== $v) {
            $this->file_name = $v;
            $this->modifiedColumns[FilesTableMap::COL_FILE_NAME] = true;
        }

        return $this;
    } // setFileName()

    /**
     * Set the value of [file_size] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setFileSize($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->file_size !== $v) {
            $this->file_size = $v;
            $this->modifiedColumns[FilesTableMap::COL_FILE_SIZE] = true;
        }

        return $this;
    } // setFileSize()

    /**
     * Set the value of [upload_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setUploadId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->upload_id !== $v) {
            $this->upload_id = $v;
            $this->modifiedColumns[FilesTableMap::COL_UPLOAD_ID] = true;
        }

        return $this;
    } // setUploadId()

    /**
     * Set the value of [upload_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setUploadDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->upload_date !== $v) {
            $this->upload_date = $v;
            $this->modifiedColumns[FilesTableMap::COL_UPLOAD_DATE] = true;
        }

        return $this;
    } // setUploadDate()

    /**
     * Set the value of [location_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setLocationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_id !== $v) {
            $this->location_id = $v;
            $this->modifiedColumns[FilesTableMap::COL_LOCATION_ID] = true;
        }

        return $this;
    } // setLocationId()

    /**
     * Set the value of [last_viewed] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setLastViewed($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_viewed !== $v) {
            $this->last_viewed = $v;
            $this->modifiedColumns[FilesTableMap::COL_LAST_VIEWED] = true;
        }

        return $this;
    } // setLastViewed()

    /**
     * Set the value of [viewed_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function setViewedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->viewed_by !== $v) {
            $this->viewed_by = $v;
            $this->modifiedColumns[FilesTableMap::COL_VIEWED_BY] = true;
        }

        return $this;
    } // setViewedBy()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FilesTableMap::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FilesTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FilesTableMap::translateFieldName('FileName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FilesTableMap::translateFieldName('FileSize', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_size = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FilesTableMap::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upload_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FilesTableMap::translateFieldName('UploadDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upload_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FilesTableMap::translateFieldName('LocationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FilesTableMap::translateFieldName('LastViewed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_viewed = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FilesTableMap::translateFieldName('ViewedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->viewed_by = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = FilesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Files'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FilesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFilesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBookingAttachmentss = null;

            $this->collCategoriess = null;

            $this->collItemss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Files::setDeleted()
     * @see Files::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFilesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
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
                FilesTableMap::addInstanceToPool($this);
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

            if ($this->categoriessScheduledForDeletion !== null) {
                if (!$this->categoriessScheduledForDeletion->isEmpty()) {
                    foreach ($this->categoriessScheduledForDeletion as $categories) {
                        // need to save related object because we set the relation to null
                        $categories->save($con);
                    }
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

            if ($this->itemssScheduledForDeletion !== null) {
                if (!$this->itemssScheduledForDeletion->isEmpty()) {
                    foreach ($this->itemssScheduledForDeletion as $items) {
                        // need to save related object because we set the relation to null
                        $items->save($con);
                    }
                    $this->itemssScheduledForDeletion = null;
                }
            }

            if ($this->collItemss !== null) {
                foreach ($this->collItemss as $referrerFK) {
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

        $this->modifiedColumns[FilesTableMap::COL_FILE_ID] = true;
        if (null !== $this->file_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FilesTableMap::COL_FILE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FilesTableMap::COL_FILE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'file_id';
        }
        if ($this->isColumnModified(FilesTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(FilesTableMap::COL_FILE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'file_name';
        }
        if ($this->isColumnModified(FilesTableMap::COL_FILE_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'file_size';
        }
        if ($this->isColumnModified(FilesTableMap::COL_UPLOAD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'upload_id';
        }
        if ($this->isColumnModified(FilesTableMap::COL_UPLOAD_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'upload_date';
        }
        if ($this->isColumnModified(FilesTableMap::COL_LOCATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'location_id';
        }
        if ($this->isColumnModified(FilesTableMap::COL_LAST_VIEWED)) {
            $modifiedColumns[':p' . $index++]  = 'last_viewed';
        }
        if ($this->isColumnModified(FilesTableMap::COL_VIEWED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'viewed_by';
        }

        $sql = sprintf(
            'INSERT INTO tf_files (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'file_id':
                        $stmt->bindValue($identifier, $this->file_id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'file_name':
                        $stmt->bindValue($identifier, $this->file_name, PDO::PARAM_STR);
                        break;
                    case 'file_size':
                        $stmt->bindValue($identifier, $this->file_size, PDO::PARAM_INT);
                        break;
                    case 'upload_id':
                        $stmt->bindValue($identifier, $this->upload_id, PDO::PARAM_INT);
                        break;
                    case 'upload_date':
                        $stmt->bindValue($identifier, $this->upload_date, PDO::PARAM_INT);
                        break;
                    case 'location_id':
                        $stmt->bindValue($identifier, $this->location_id, PDO::PARAM_INT);
                        break;
                    case 'last_viewed':
                        $stmt->bindValue($identifier, $this->last_viewed, PDO::PARAM_INT);
                        break;
                    case 'viewed_by':
                        $stmt->bindValue($identifier, $this->viewed_by, PDO::PARAM_INT);
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
        $this->setFileId($pk);

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
        $pos = FilesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFileId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getFileName();
                break;
            case 3:
                return $this->getFileSize();
                break;
            case 4:
                return $this->getUploadId();
                break;
            case 5:
                return $this->getUploadDate();
                break;
            case 6:
                return $this->getLocationId();
                break;
            case 7:
                return $this->getLastViewed();
                break;
            case 8:
                return $this->getViewedBy();
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

        if (isset($alreadyDumpedObjects['Files'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Files'][$this->hashCode()] = true;
        $keys = FilesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFileId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getFileName(),
            $keys[3] => $this->getFileSize(),
            $keys[4] => $this->getUploadId(),
            $keys[5] => $this->getUploadDate(),
            $keys[6] => $this->getLocationId(),
            $keys[7] => $this->getLastViewed(),
            $keys[8] => $this->getViewedBy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collItemss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_itemss';
                        break;
                    default:
                        $key = 'Itemss';
                }

                $result[$key] = $this->collItemss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Files
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FilesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Files
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFileId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setFileName($value);
                break;
            case 3:
                $this->setFileSize($value);
                break;
            case 4:
                $this->setUploadId($value);
                break;
            case 5:
                $this->setUploadDate($value);
                break;
            case 6:
                $this->setLocationId($value);
                break;
            case 7:
                $this->setLastViewed($value);
                break;
            case 8:
                $this->setViewedBy($value);
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
        $keys = FilesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFileId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFileName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFileSize($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUploadId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUploadDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLocationId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLastViewed($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setViewedBy($arr[$keys[8]]);
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
     * @return $this|\TheFarm\Models\Files The current object, for fluid interface
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
        $criteria = new Criteria(FilesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FilesTableMap::COL_FILE_ID)) {
            $criteria->add(FilesTableMap::COL_FILE_ID, $this->file_id);
        }
        if ($this->isColumnModified(FilesTableMap::COL_TITLE)) {
            $criteria->add(FilesTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(FilesTableMap::COL_FILE_NAME)) {
            $criteria->add(FilesTableMap::COL_FILE_NAME, $this->file_name);
        }
        if ($this->isColumnModified(FilesTableMap::COL_FILE_SIZE)) {
            $criteria->add(FilesTableMap::COL_FILE_SIZE, $this->file_size);
        }
        if ($this->isColumnModified(FilesTableMap::COL_UPLOAD_ID)) {
            $criteria->add(FilesTableMap::COL_UPLOAD_ID, $this->upload_id);
        }
        if ($this->isColumnModified(FilesTableMap::COL_UPLOAD_DATE)) {
            $criteria->add(FilesTableMap::COL_UPLOAD_DATE, $this->upload_date);
        }
        if ($this->isColumnModified(FilesTableMap::COL_LOCATION_ID)) {
            $criteria->add(FilesTableMap::COL_LOCATION_ID, $this->location_id);
        }
        if ($this->isColumnModified(FilesTableMap::COL_LAST_VIEWED)) {
            $criteria->add(FilesTableMap::COL_LAST_VIEWED, $this->last_viewed);
        }
        if ($this->isColumnModified(FilesTableMap::COL_VIEWED_BY)) {
            $criteria->add(FilesTableMap::COL_VIEWED_BY, $this->viewed_by);
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
        $criteria = ChildFilesQuery::create();
        $criteria->add(FilesTableMap::COL_FILE_ID, $this->file_id);

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
        $validPk = null !== $this->getFileId();

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
        return $this->getFileId();
    }

    /**
     * Generic method to set the primary key (file_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFileId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFileId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Files (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setFileName($this->getFileName());
        $copyObj->setFileSize($this->getFileSize());
        $copyObj->setUploadId($this->getUploadId());
        $copyObj->setUploadDate($this->getUploadDate());
        $copyObj->setLocationId($this->getLocationId());
        $copyObj->setLastViewed($this->getLastViewed());
        $copyObj->setViewedBy($this->getViewedBy());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingAttachmentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingAttachments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategories($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItems($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFileId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Files Clone of current object.
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
        if ('BookingAttachments' == $relationName) {
            $this->initBookingAttachmentss();
            return;
        }
        if ('Categories' == $relationName) {
            $this->initCategoriess();
            return;
        }
        if ('Items' == $relationName) {
            $this->initItemss();
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
     * If this ChildFiles is new, it will return
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
                    ->filterByFiles($this)
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
     * @return $this|ChildFiles The current object (for fluent API support)
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
            $bookingAttachmentsRemoved->setFiles(null);
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
                ->filterByFiles($this)
                ->count($con);
        }

        return count($this->collBookingAttachmentss);
    }

    /**
     * Method called to associate a ChildBookingAttachments object to this object
     * through the ChildBookingAttachments foreign key attribute.
     *
     * @param  ChildBookingAttachments $l ChildBookingAttachments
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
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
        $bookingAttachments->setFiles($this);
    }

    /**
     * @param  ChildBookingAttachments $bookingAttachments The ChildBookingAttachments object to remove.
     * @return $this|ChildFiles The current object (for fluent API support)
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
            $bookingAttachments->setFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Files is new, it will return
     * an empty collection; or if this Files has previously
     * been saved, it will retrieve related BookingAttachmentss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Files.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingAttachments[] List of ChildBookingAttachments objects
     */
    public function getBookingAttachmentssJoinBookings(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingAttachmentsQuery::create(null, $criteria);
        $query->joinWith('Bookings', $joinBehavior);

        return $this->getBookingAttachmentss($query, $con);
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
     * If this ChildFiles is new, it will return
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
                    ->filterByFiles($this)
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
     * @return $this|ChildFiles The current object (for fluent API support)
     */
    public function setCategoriess(Collection $categoriess, ConnectionInterface $con = null)
    {
        /** @var ChildCategories[] $categoriessToDelete */
        $categoriessToDelete = $this->getCategoriess(new Criteria(), $con)->diff($categoriess);


        $this->categoriessScheduledForDeletion = $categoriessToDelete;

        foreach ($categoriessToDelete as $categoriesRemoved) {
            $categoriesRemoved->setFiles(null);
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
                ->filterByFiles($this)
                ->count($con);
        }

        return count($this->collCategoriess);
    }

    /**
     * Method called to associate a ChildCategories object to this object
     * through the ChildCategories foreign key attribute.
     *
     * @param  ChildCategories $l ChildCategories
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
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
        $categories->setFiles($this);
    }

    /**
     * @param  ChildCategories $categories The ChildCategories object to remove.
     * @return $this|ChildFiles The current object (for fluent API support)
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
            $this->categoriessScheduledForDeletion[]= $categories;
            $categories->setFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Files is new, it will return
     * an empty collection; or if this Files has previously
     * been saved, it will retrieve related Categoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Files.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategories[] List of ChildCategories objects
     */
    public function getCategoriessJoinLocations(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoriesQuery::create(null, $criteria);
        $query->joinWith('Locations', $joinBehavior);

        return $this->getCategoriess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Files is new, it will return
     * an empty collection; or if this Files has previously
     * been saved, it will retrieve related Categoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Files.
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
     * Clears out the collItemss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemss()
     */
    public function clearItemss()
    {
        $this->collItemss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemss collection loaded partially.
     */
    public function resetPartialItemss($v = true)
    {
        $this->collItemssPartial = $v;
    }

    /**
     * Initializes the collItemss collection.
     *
     * By default this just sets the collItemss collection to an empty array (like clearcollItemss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemss($overrideExisting = true)
    {
        if (null !== $this->collItemss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemsTableMap::getTableMap()->getCollectionClassName();

        $this->collItemss = new $collectionClassName;
        $this->collItemss->setModel('\TheFarm\Models\Items');
    }

    /**
     * Gets an array of ChildItems objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItems[] List of ChildItems objects
     * @throws PropelException
     */
    public function getItemss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemssPartial && !$this->isNew();
        if (null === $this->collItemss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemss) {
                // return empty collection
                $this->initItemss();
            } else {
                $collItemss = ChildItemsQuery::create(null, $criteria)
                    ->filterByFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemssPartial && count($collItemss)) {
                        $this->initItemss(false);

                        foreach ($collItemss as $obj) {
                            if (false == $this->collItemss->contains($obj)) {
                                $this->collItemss->append($obj);
                            }
                        }

                        $this->collItemssPartial = true;
                    }

                    return $collItemss;
                }

                if ($partial && $this->collItemss) {
                    foreach ($this->collItemss as $obj) {
                        if ($obj->isNew()) {
                            $collItemss[] = $obj;
                        }
                    }
                }

                $this->collItemss = $collItemss;
                $this->collItemssPartial = false;
            }
        }

        return $this->collItemss;
    }

    /**
     * Sets a collection of ChildItems objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFiles The current object (for fluent API support)
     */
    public function setItemss(Collection $itemss, ConnectionInterface $con = null)
    {
        /** @var ChildItems[] $itemssToDelete */
        $itemssToDelete = $this->getItemss(new Criteria(), $con)->diff($itemss);


        $this->itemssScheduledForDeletion = $itemssToDelete;

        foreach ($itemssToDelete as $itemsRemoved) {
            $itemsRemoved->setFiles(null);
        }

        $this->collItemss = null;
        foreach ($itemss as $items) {
            $this->addItems($items);
        }

        $this->collItemss = $itemss;
        $this->collItemssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Items objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Items objects.
     * @throws PropelException
     */
    public function countItemss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemssPartial && !$this->isNew();
        if (null === $this->collItemss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemss());
            }

            $query = ChildItemsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFiles($this)
                ->count($con);
        }

        return count($this->collItemss);
    }

    /**
     * Method called to associate a ChildItems object to this object
     * through the ChildItems foreign key attribute.
     *
     * @param  ChildItems $l ChildItems
     * @return $this|\TheFarm\Models\Files The current object (for fluent API support)
     */
    public function addItems(ChildItems $l)
    {
        if ($this->collItemss === null) {
            $this->initItemss();
            $this->collItemssPartial = true;
        }

        if (!$this->collItemss->contains($l)) {
            $this->doAddItems($l);

            if ($this->itemssScheduledForDeletion and $this->itemssScheduledForDeletion->contains($l)) {
                $this->itemssScheduledForDeletion->remove($this->itemssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItems $items The ChildItems object to add.
     */
    protected function doAddItems(ChildItems $items)
    {
        $this->collItemss[]= $items;
        $items->setFiles($this);
    }

    /**
     * @param  ChildItems $items The ChildItems object to remove.
     * @return $this|ChildFiles The current object (for fluent API support)
     */
    public function removeItems(ChildItems $items)
    {
        if ($this->getItemss()->contains($items)) {
            $pos = $this->collItemss->search($items);
            $this->collItemss->remove($pos);
            if (null === $this->itemssScheduledForDeletion) {
                $this->itemssScheduledForDeletion = clone $this->collItemss;
                $this->itemssScheduledForDeletion->clear();
            }
            $this->itemssScheduledForDeletion[]= $items;
            $items->setFiles(null);
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
        $this->file_id = null;
        $this->title = null;
        $this->file_name = null;
        $this->file_size = null;
        $this->upload_id = null;
        $this->upload_date = null;
        $this->location_id = null;
        $this->last_viewed = null;
        $this->viewed_by = null;
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
            if ($this->collBookingAttachmentss) {
                foreach ($this->collBookingAttachmentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCategoriess) {
                foreach ($this->collCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemss) {
                foreach ($this->collItemss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingAttachmentss = null;
        $this->collCategoriess = null;
        $this->collItemss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FilesTableMap::DEFAULT_STRING_FORMAT);
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
