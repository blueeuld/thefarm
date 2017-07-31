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
use TheFarm\Models\Field as ChildField;
use TheFarm\Models\FieldQuery as ChildFieldQuery;
use TheFarm\Models\FormEntry as ChildFormEntry;
use TheFarm\Models\FormEntryQuery as ChildFormEntryQuery;
use TheFarm\Models\Map\FieldTableMap;
use TheFarm\Models\Map\FormEntryTableMap;

/**
 * Base class that represents a row from the 'tf_fields' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Field implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\FieldTableMap';


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
     * The value for the field_id field.
     *
     * @var        int
     */
    protected $field_id;

    /**
     * The value for the field_name field.
     *
     * @var        string
     */
    protected $field_name;

    /**
     * The value for the field_label field.
     *
     * @var        string
     */
    protected $field_label;

    /**
     * The value for the field_type field.
     *
     * @var        string
     */
    protected $field_type;

    /**
     * The value for the settings field.
     *
     * @var        string
     */
    protected $settings;

    /**
     * The value for the required field.
     *
     * @var        string
     */
    protected $required;

    /**
     * The value for the entry_date field.
     *
     * @var        int
     */
    protected $entry_date;

    /**
     * The value for the edit_date field.
     *
     * @var        int
     */
    protected $edit_date;

    /**
     * @var        ObjectCollection|ChildFormEntry[] Collection to store aggregation of ChildFormEntry objects.
     */
    protected $collFormEntries;
    protected $collFormEntriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFormEntry[]
     */
    protected $formEntriesScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\Field object.
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
     * Compares this with another <code>Field</code> instance.  If
     * <code>obj</code> is an instance of <code>Field</code>, delegates to
     * <code>equals(Field)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Field The current object, for fluid interface
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
     * Get the [field_id] column value.
     *
     * @return int
     */
    public function getFieldId()
    {
        return $this->field_id;
    }

    /**
     * Get the [field_name] column value.
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->field_name;
    }

    /**
     * Get the [field_label] column value.
     *
     * @return string
     */
    public function getFieldLabel()
    {
        return $this->field_label;
    }

    /**
     * Get the [field_type] column value.
     *
     * @return string
     */
    public function getFieldType()
    {
        return $this->field_type;
    }

    /**
     * Get the [settings] column value.
     *
     * @return string
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Get the [required] column value.
     *
     * @return string
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Get the [entry_date] column value.
     *
     * @return int
     */
    public function getEntryDate()
    {
        return $this->entry_date;
    }

    /**
     * Get the [edit_date] column value.
     *
     * @return int
     */
    public function getEditDate()
    {
        return $this->edit_date;
    }

    /**
     * Set the value of [field_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setFieldId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->field_id !== $v) {
            $this->field_id = $v;
            $this->modifiedColumns[FieldTableMap::COL_FIELD_ID] = true;
        }

        return $this;
    } // setFieldId()

    /**
     * Set the value of [field_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setFieldName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_name !== $v) {
            $this->field_name = $v;
            $this->modifiedColumns[FieldTableMap::COL_FIELD_NAME] = true;
        }

        return $this;
    } // setFieldName()

    /**
     * Set the value of [field_label] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setFieldLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_label !== $v) {
            $this->field_label = $v;
            $this->modifiedColumns[FieldTableMap::COL_FIELD_LABEL] = true;
        }

        return $this;
    } // setFieldLabel()

    /**
     * Set the value of [field_type] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setFieldType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_type !== $v) {
            $this->field_type = $v;
            $this->modifiedColumns[FieldTableMap::COL_FIELD_TYPE] = true;
        }

        return $this;
    } // setFieldType()

    /**
     * Set the value of [settings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setSettings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->settings !== $v) {
            $this->settings = $v;
            $this->modifiedColumns[FieldTableMap::COL_SETTINGS] = true;
        }

        return $this;
    } // setSettings()

    /**
     * Set the value of [required] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setRequired($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->required !== $v) {
            $this->required = $v;
            $this->modifiedColumns[FieldTableMap::COL_REQUIRED] = true;
        }

        return $this;
    } // setRequired()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[FieldTableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[FieldTableMap::COL_EDIT_DATE] = true;
        }

        return $this;
    } // setEditDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FieldTableMap::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FieldTableMap::translateFieldName('FieldName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FieldTableMap::translateFieldName('FieldLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FieldTableMap::translateFieldName('FieldType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FieldTableMap::translateFieldName('Settings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->settings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FieldTableMap::translateFieldName('Required', TableMap::TYPE_PHPNAME, $indexType)];
            $this->required = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FieldTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FieldTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = FieldTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Field'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FieldTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFieldQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collFormEntries = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Field::setDeleted()
     * @see Field::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FieldTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFieldQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FieldTableMap::DATABASE_NAME);
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
                FieldTableMap::addInstanceToPool($this);
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

            if ($this->formEntriesScheduledForDeletion !== null) {
                if (!$this->formEntriesScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\FormEntryQuery::create()
                        ->filterByPrimaryKeys($this->formEntriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->formEntriesScheduledForDeletion = null;
                }
            }

            if ($this->collFormEntries !== null) {
                foreach ($this->collFormEntries as $referrerFK) {
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

        $this->modifiedColumns[FieldTableMap::COL_FIELD_ID] = true;
        if (null !== $this->field_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FieldTableMap::COL_FIELD_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'field_id';
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'field_name';
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_LABEL)) {
            $modifiedColumns[':p' . $index++]  = 'field_label';
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'field_type';
        }
        if ($this->isColumnModified(FieldTableMap::COL_SETTINGS)) {
            $modifiedColumns[':p' . $index++]  = 'settings';
        }
        if ($this->isColumnModified(FieldTableMap::COL_REQUIRED)) {
            $modifiedColumns[':p' . $index++]  = 'required';
        }
        if ($this->isColumnModified(FieldTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(FieldTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }

        $sql = sprintf(
            'INSERT INTO tf_fields (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'field_id':
                        $stmt->bindValue($identifier, $this->field_id, PDO::PARAM_INT);
                        break;
                    case 'field_name':
                        $stmt->bindValue($identifier, $this->field_name, PDO::PARAM_STR);
                        break;
                    case 'field_label':
                        $stmt->bindValue($identifier, $this->field_label, PDO::PARAM_STR);
                        break;
                    case 'field_type':
                        $stmt->bindValue($identifier, $this->field_type, PDO::PARAM_STR);
                        break;
                    case 'settings':
                        $stmt->bindValue($identifier, $this->settings, PDO::PARAM_STR);
                        break;
                    case 'required':
                        $stmt->bindValue($identifier, $this->required, PDO::PARAM_STR);
                        break;
                    case 'entry_date':
                        $stmt->bindValue($identifier, $this->entry_date, PDO::PARAM_INT);
                        break;
                    case 'edit_date':
                        $stmt->bindValue($identifier, $this->edit_date, PDO::PARAM_INT);
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
        $this->setFieldId($pk);

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
        $pos = FieldTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFieldId();
                break;
            case 1:
                return $this->getFieldName();
                break;
            case 2:
                return $this->getFieldLabel();
                break;
            case 3:
                return $this->getFieldType();
                break;
            case 4:
                return $this->getSettings();
                break;
            case 5:
                return $this->getRequired();
                break;
            case 6:
                return $this->getEntryDate();
                break;
            case 7:
                return $this->getEditDate();
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

        if (isset($alreadyDumpedObjects['Field'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Field'][$this->hashCode()] = true;
        $keys = FieldTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFieldId(),
            $keys[1] => $this->getFieldName(),
            $keys[2] => $this->getFieldLabel(),
            $keys[3] => $this->getFieldType(),
            $keys[4] => $this->getSettings(),
            $keys[5] => $this->getRequired(),
            $keys[6] => $this->getEntryDate(),
            $keys[7] => $this->getEditDate(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collFormEntries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formEntries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_form_entriess';
                        break;
                    default:
                        $key = 'FormEntries';
                }

                $result[$key] = $this->collFormEntries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Field
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FieldTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Field
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFieldId($value);
                break;
            case 1:
                $this->setFieldName($value);
                break;
            case 2:
                $this->setFieldLabel($value);
                break;
            case 3:
                $this->setFieldType($value);
                break;
            case 4:
                $this->setSettings($value);
                break;
            case 5:
                $this->setRequired($value);
                break;
            case 6:
                $this->setEntryDate($value);
                break;
            case 7:
                $this->setEditDate($value);
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
        $keys = FieldTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFieldId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFieldName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFieldLabel($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFieldType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSettings($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRequired($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEntryDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEditDate($arr[$keys[7]]);
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
     * @return $this|\TheFarm\Models\Field The current object, for fluid interface
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
        $criteria = new Criteria(FieldTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FieldTableMap::COL_FIELD_ID)) {
            $criteria->add(FieldTableMap::COL_FIELD_ID, $this->field_id);
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_NAME)) {
            $criteria->add(FieldTableMap::COL_FIELD_NAME, $this->field_name);
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_LABEL)) {
            $criteria->add(FieldTableMap::COL_FIELD_LABEL, $this->field_label);
        }
        if ($this->isColumnModified(FieldTableMap::COL_FIELD_TYPE)) {
            $criteria->add(FieldTableMap::COL_FIELD_TYPE, $this->field_type);
        }
        if ($this->isColumnModified(FieldTableMap::COL_SETTINGS)) {
            $criteria->add(FieldTableMap::COL_SETTINGS, $this->settings);
        }
        if ($this->isColumnModified(FieldTableMap::COL_REQUIRED)) {
            $criteria->add(FieldTableMap::COL_REQUIRED, $this->required);
        }
        if ($this->isColumnModified(FieldTableMap::COL_ENTRY_DATE)) {
            $criteria->add(FieldTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(FieldTableMap::COL_EDIT_DATE)) {
            $criteria->add(FieldTableMap::COL_EDIT_DATE, $this->edit_date);
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
        $criteria = ChildFieldQuery::create();
        $criteria->add(FieldTableMap::COL_FIELD_ID, $this->field_id);

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
        $validPk = null !== $this->getFieldId();

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
        return $this->getFieldId();
    }

    /**
     * Generic method to set the primary key (field_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFieldId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFieldId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Field (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFieldName($this->getFieldName());
        $copyObj->setFieldLabel($this->getFieldLabel());
        $copyObj->setFieldType($this->getFieldType());
        $copyObj->setSettings($this->getSettings());
        $copyObj->setRequired($this->getRequired());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getFormEntries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFormEntry($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFieldId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Field Clone of current object.
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
        if ('FormEntry' == $relationName) {
            $this->initFormEntries();
            return;
        }
    }

    /**
     * Clears out the collFormEntries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFormEntries()
     */
    public function clearFormEntries()
    {
        $this->collFormEntries = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFormEntries collection loaded partially.
     */
    public function resetPartialFormEntries($v = true)
    {
        $this->collFormEntriesPartial = $v;
    }

    /**
     * Initializes the collFormEntries collection.
     *
     * By default this just sets the collFormEntries collection to an empty array (like clearcollFormEntries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFormEntries($overrideExisting = true)
    {
        if (null !== $this->collFormEntries && !$overrideExisting) {
            return;
        }

        $collectionClassName = FormEntryTableMap::getTableMap()->getCollectionClassName();

        $this->collFormEntries = new $collectionClassName;
        $this->collFormEntries->setModel('\TheFarm\Models\FormEntry');
    }

    /**
     * Gets an array of ChildFormEntry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildField is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     * @throws PropelException
     */
    public function getFormEntries(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriesPartial && !$this->isNew();
        if (null === $this->collFormEntries || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFormEntries) {
                // return empty collection
                $this->initFormEntries();
            } else {
                $collFormEntries = ChildFormEntryQuery::create(null, $criteria)
                    ->filterByField($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFormEntriesPartial && count($collFormEntries)) {
                        $this->initFormEntries(false);

                        foreach ($collFormEntries as $obj) {
                            if (false == $this->collFormEntries->contains($obj)) {
                                $this->collFormEntries->append($obj);
                            }
                        }

                        $this->collFormEntriesPartial = true;
                    }

                    return $collFormEntries;
                }

                if ($partial && $this->collFormEntries) {
                    foreach ($this->collFormEntries as $obj) {
                        if ($obj->isNew()) {
                            $collFormEntries[] = $obj;
                        }
                    }
                }

                $this->collFormEntries = $collFormEntries;
                $this->collFormEntriesPartial = false;
            }
        }

        return $this->collFormEntries;
    }

    /**
     * Sets a collection of ChildFormEntry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $formEntries A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildField The current object (for fluent API support)
     */
    public function setFormEntries(Collection $formEntries, ConnectionInterface $con = null)
    {
        /** @var ChildFormEntry[] $formEntriesToDelete */
        $formEntriesToDelete = $this->getFormEntries(new Criteria(), $con)->diff($formEntries);


        $this->formEntriesScheduledForDeletion = $formEntriesToDelete;

        foreach ($formEntriesToDelete as $formEntryRemoved) {
            $formEntryRemoved->setField(null);
        }

        $this->collFormEntries = null;
        foreach ($formEntries as $formEntry) {
            $this->addFormEntry($formEntry);
        }

        $this->collFormEntries = $formEntries;
        $this->collFormEntriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FormEntry objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FormEntry objects.
     * @throws PropelException
     */
    public function countFormEntries(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFormEntriesPartial && !$this->isNew();
        if (null === $this->collFormEntries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFormEntries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFormEntries());
            }

            $query = ChildFormEntryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByField($this)
                ->count($con);
        }

        return count($this->collFormEntries);
    }

    /**
     * Method called to associate a ChildFormEntry object to this object
     * through the ChildFormEntry foreign key attribute.
     *
     * @param  ChildFormEntry $l ChildFormEntry
     * @return $this|\TheFarm\Models\Field The current object (for fluent API support)
     */
    public function addFormEntry(ChildFormEntry $l)
    {
        if ($this->collFormEntries === null) {
            $this->initFormEntries();
            $this->collFormEntriesPartial = true;
        }

        if (!$this->collFormEntries->contains($l)) {
            $this->doAddFormEntry($l);

            if ($this->formEntriesScheduledForDeletion and $this->formEntriesScheduledForDeletion->contains($l)) {
                $this->formEntriesScheduledForDeletion->remove($this->formEntriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFormEntry $formEntry The ChildFormEntry object to add.
     */
    protected function doAddFormEntry(ChildFormEntry $formEntry)
    {
        $this->collFormEntries[]= $formEntry;
        $formEntry->setField($this);
    }

    /**
     * @param  ChildFormEntry $formEntry The ChildFormEntry object to remove.
     * @return $this|ChildField The current object (for fluent API support)
     */
    public function removeFormEntry(ChildFormEntry $formEntry)
    {
        if ($this->getFormEntries()->contains($formEntry)) {
            $pos = $this->collFormEntries->search($formEntry);
            $this->collFormEntries->remove($pos);
            if (null === $this->formEntriesScheduledForDeletion) {
                $this->formEntriesScheduledForDeletion = clone $this->collFormEntries;
                $this->formEntriesScheduledForDeletion->clear();
            }
            $this->formEntriesScheduledForDeletion[]= clone $formEntry;
            $formEntry->setField(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Field is new, it will return
     * an empty collection; or if this Field has previously
     * been saved, it will retrieve related FormEntries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Field.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     */
    public function getFormEntriesJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntryQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getFormEntries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Field is new, it will return
     * an empty collection; or if this Field has previously
     * been saved, it will retrieve related FormEntries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Field.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormEntry[] List of ChildFormEntry objects
     */
    public function getFormEntriesJoinForm(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormEntryQuery::create(null, $criteria);
        $query->joinWith('Form', $joinBehavior);

        return $this->getFormEntries($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->field_id = null;
        $this->field_name = null;
        $this->field_label = null;
        $this->field_type = null;
        $this->settings = null;
        $this->required = null;
        $this->entry_date = null;
        $this->edit_date = null;
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
            if ($this->collFormEntries) {
                foreach ($this->collFormEntries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collFormEntries = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FieldTableMap::DEFAULT_STRING_FORMAT);
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
