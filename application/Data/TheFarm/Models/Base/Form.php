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
use TheFarm\Models\BookingForm as ChildBookingForm;
use TheFarm\Models\BookingFormQuery as ChildBookingFormQuery;
use TheFarm\Models\Form as ChildForm;
use TheFarm\Models\FormField as ChildFormField;
use TheFarm\Models\FormFieldQuery as ChildFormFieldQuery;
use TheFarm\Models\FormQuery as ChildFormQuery;
use TheFarm\Models\ItemForm as ChildItemForm;
use TheFarm\Models\ItemFormQuery as ChildItemFormQuery;
use TheFarm\Models\Map\BookingFormTableMap;
use TheFarm\Models\Map\FormFieldTableMap;
use TheFarm\Models\Map\FormTableMap;
use TheFarm\Models\Map\ItemFormTableMap;

/**
 * Base class that represents a row from the 'tf_forms' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Form implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\FormTableMap';


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
     * The value for the form_id field.
     *
     * @var        int
     */
    protected $form_id;

    /**
     * The value for the form_name field.
     *
     * @var        string
     */
    protected $form_name;

    /**
     * The value for the form_html field.
     *
     * @var        string
     */
    protected $form_html;

    /**
     * The value for the field_ids field.
     *
     * @var        string
     */
    protected $field_ids;

    /**
     * The value for the author_id field.
     *
     * @var        int
     */
    protected $author_id;

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
     * @var        ObjectCollection|ChildBookingForm[] Collection to store aggregation of ChildBookingForm objects.
     */
    protected $collBookingForms;
    protected $collBookingFormsPartial;

    /**
     * @var        ObjectCollection|ChildFormField[] Collection to store aggregation of ChildFormField objects.
     */
    protected $collFormFields;
    protected $collFormFieldsPartial;

    /**
     * @var        ObjectCollection|ChildItemForm[] Collection to store aggregation of ChildItemForm objects.
     */
    protected $collItemForms;
    protected $collItemFormsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingForm[]
     */
    protected $bookingFormsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFormField[]
     */
    protected $formFieldsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemForm[]
     */
    protected $itemFormsScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\Form object.
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
     * Compares this with another <code>Form</code> instance.  If
     * <code>obj</code> is an instance of <code>Form</code>, delegates to
     * <code>equals(Form)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Form The current object, for fluid interface
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
     * Get the [form_id] column value.
     *
     * @return int
     */
    public function getFormId()
    {
        return $this->form_id;
    }

    /**
     * Get the [form_name] column value.
     *
     * @return string
     */
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * Get the [form_html] column value.
     *
     * @return string
     */
    public function getFormHtml()
    {
        return $this->form_html;
    }

    /**
     * Get the [field_ids] column value.
     *
     * @return string
     */
    public function getFieldIds()
    {
        return $this->field_ids;
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
     * Set the value of [form_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setFormId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->form_id !== $v) {
            $this->form_id = $v;
            $this->modifiedColumns[FormTableMap::COL_FORM_ID] = true;
        }

        return $this;
    } // setFormId()

    /**
     * Set the value of [form_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setFormName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->form_name !== $v) {
            $this->form_name = $v;
            $this->modifiedColumns[FormTableMap::COL_FORM_NAME] = true;
        }

        return $this;
    } // setFormName()

    /**
     * Set the value of [form_html] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setFormHtml($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->form_html !== $v) {
            $this->form_html = $v;
            $this->modifiedColumns[FormTableMap::COL_FORM_HTML] = true;
        }

        return $this;
    } // setFormHtml()

    /**
     * Set the value of [field_ids] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setFieldIds($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_ids !== $v) {
            $this->field_ids = $v;
            $this->modifiedColumns[FormTableMap::COL_FIELD_IDS] = true;
        }

        return $this;
    } // setFieldIds()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[FormTableMap::COL_AUTHOR_ID] = true;
        }

        return $this;
    } // setAuthorId()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[FormTableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[FormTableMap::COL_EDIT_DATE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FormTableMap::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FormTableMap::translateFieldName('FormName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FormTableMap::translateFieldName('FormHtml', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_html = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FormTableMap::translateFieldName('FieldIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_ids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FormTableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FormTableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FormTableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = FormTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Form'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FormTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFormQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBookingForms = null;

            $this->collFormFields = null;

            $this->collItemForms = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Form::setDeleted()
     * @see Form::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFormQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
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
                FormTableMap::addInstanceToPool($this);
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

            if ($this->bookingFormsScheduledForDeletion !== null) {
                if (!$this->bookingFormsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingFormQuery::create()
                        ->filterByPrimaryKeys($this->bookingFormsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingFormsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingForms !== null) {
                foreach ($this->collBookingForms as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->formFieldsScheduledForDeletion !== null) {
                if (!$this->formFieldsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\FormFieldQuery::create()
                        ->filterByPrimaryKeys($this->formFieldsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->formFieldsScheduledForDeletion = null;
                }
            }

            if ($this->collFormFields !== null) {
                foreach ($this->collFormFields as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemFormsScheduledForDeletion !== null) {
                if (!$this->itemFormsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\ItemFormQuery::create()
                        ->filterByPrimaryKeys($this->itemFormsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemFormsScheduledForDeletion = null;
                }
            }

            if ($this->collItemForms !== null) {
                foreach ($this->collItemForms as $referrerFK) {
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

        $this->modifiedColumns[FormTableMap::COL_FORM_ID] = true;
        if (null !== $this->form_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FormTableMap::COL_FORM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FormTableMap::COL_FORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'form_id';
        }
        if ($this->isColumnModified(FormTableMap::COL_FORM_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'form_name';
        }
        if ($this->isColumnModified(FormTableMap::COL_FORM_HTML)) {
            $modifiedColumns[':p' . $index++]  = 'form_html';
        }
        if ($this->isColumnModified(FormTableMap::COL_FIELD_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'field_ids';
        }
        if ($this->isColumnModified(FormTableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(FormTableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(FormTableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }

        $sql = sprintf(
            'INSERT INTO tf_forms (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'form_id':
                        $stmt->bindValue($identifier, $this->form_id, PDO::PARAM_INT);
                        break;
                    case 'form_name':
                        $stmt->bindValue($identifier, $this->form_name, PDO::PARAM_STR);
                        break;
                    case 'form_html':
                        $stmt->bindValue($identifier, $this->form_html, PDO::PARAM_STR);
                        break;
                    case 'field_ids':
                        $stmt->bindValue($identifier, $this->field_ids, PDO::PARAM_STR);
                        break;
                    case 'author_id':
                        $stmt->bindValue($identifier, $this->author_id, PDO::PARAM_INT);
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
        $this->setFormId($pk);

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
        $pos = FormTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFormId();
                break;
            case 1:
                return $this->getFormName();
                break;
            case 2:
                return $this->getFormHtml();
                break;
            case 3:
                return $this->getFieldIds();
                break;
            case 4:
                return $this->getAuthorId();
                break;
            case 5:
                return $this->getEntryDate();
                break;
            case 6:
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

        if (isset($alreadyDumpedObjects['Form'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Form'][$this->hashCode()] = true;
        $keys = FormTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFormId(),
            $keys[1] => $this->getFormName(),
            $keys[2] => $this->getFormHtml(),
            $keys[3] => $this->getFieldIds(),
            $keys[4] => $this->getAuthorId(),
            $keys[5] => $this->getEntryDate(),
            $keys[6] => $this->getEditDate(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBookingForms) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingForms';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_forms';
                        break;
                    default:
                        $key = 'BookingForms';
                }

                $result[$key] = $this->collBookingForms->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFormFields) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formFields';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_form_fields';
                        break;
                    default:
                        $key = 'FormFields';
                }

                $result[$key] = $this->collFormFields->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItemForms) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'itemForms';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_items_related_formss';
                        break;
                    default:
                        $key = 'ItemForms';
                }

                $result[$key] = $this->collItemForms->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Form
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FormTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Form
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFormId($value);
                break;
            case 1:
                $this->setFormName($value);
                break;
            case 2:
                $this->setFormHtml($value);
                break;
            case 3:
                $this->setFieldIds($value);
                break;
            case 4:
                $this->setAuthorId($value);
                break;
            case 5:
                $this->setEntryDate($value);
                break;
            case 6:
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
        $keys = FormTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFormId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFormName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFormHtml($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFieldIds($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAuthorId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEntryDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEditDate($arr[$keys[6]]);
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
     * @return $this|\TheFarm\Models\Form The current object, for fluid interface
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
        $criteria = new Criteria(FormTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FormTableMap::COL_FORM_ID)) {
            $criteria->add(FormTableMap::COL_FORM_ID, $this->form_id);
        }
        if ($this->isColumnModified(FormTableMap::COL_FORM_NAME)) {
            $criteria->add(FormTableMap::COL_FORM_NAME, $this->form_name);
        }
        if ($this->isColumnModified(FormTableMap::COL_FORM_HTML)) {
            $criteria->add(FormTableMap::COL_FORM_HTML, $this->form_html);
        }
        if ($this->isColumnModified(FormTableMap::COL_FIELD_IDS)) {
            $criteria->add(FormTableMap::COL_FIELD_IDS, $this->field_ids);
        }
        if ($this->isColumnModified(FormTableMap::COL_AUTHOR_ID)) {
            $criteria->add(FormTableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(FormTableMap::COL_ENTRY_DATE)) {
            $criteria->add(FormTableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(FormTableMap::COL_EDIT_DATE)) {
            $criteria->add(FormTableMap::COL_EDIT_DATE, $this->edit_date);
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
        $criteria = ChildFormQuery::create();
        $criteria->add(FormTableMap::COL_FORM_ID, $this->form_id);

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
        $validPk = null !== $this->getFormId();

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
        return $this->getFormId();
    }

    /**
     * Generic method to set the primary key (form_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFormId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFormId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Form (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFormName($this->getFormName());
        $copyObj->setFormHtml($this->getFormHtml());
        $copyObj->setFieldIds($this->getFieldIds());
        $copyObj->setAuthorId($this->getAuthorId());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingForms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingForm($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFormFields() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFormField($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemForms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemForm($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFormId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Form Clone of current object.
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
        if ('BookingForm' == $relationName) {
            $this->initBookingForms();
            return;
        }
        if ('FormField' == $relationName) {
            $this->initFormFields();
            return;
        }
        if ('ItemForm' == $relationName) {
            $this->initItemForms();
            return;
        }
    }

    /**
     * Clears out the collBookingForms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingForms()
     */
    public function clearBookingForms()
    {
        $this->collBookingForms = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingForms collection loaded partially.
     */
    public function resetPartialBookingForms($v = true)
    {
        $this->collBookingFormsPartial = $v;
    }

    /**
     * Initializes the collBookingForms collection.
     *
     * By default this just sets the collBookingForms collection to an empty array (like clearcollBookingForms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingForms($overrideExisting = true)
    {
        if (null !== $this->collBookingForms && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingFormTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingForms = new $collectionClassName;
        $this->collBookingForms->setModel('\TheFarm\Models\BookingForm');
    }

    /**
     * Gets an array of ChildBookingForm objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildForm is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingForm[] List of ChildBookingForm objects
     * @throws PropelException
     */
    public function getBookingForms(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingFormsPartial && !$this->isNew();
        if (null === $this->collBookingForms || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingForms) {
                // return empty collection
                $this->initBookingForms();
            } else {
                $collBookingForms = ChildBookingFormQuery::create(null, $criteria)
                    ->filterByForm($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingFormsPartial && count($collBookingForms)) {
                        $this->initBookingForms(false);

                        foreach ($collBookingForms as $obj) {
                            if (false == $this->collBookingForms->contains($obj)) {
                                $this->collBookingForms->append($obj);
                            }
                        }

                        $this->collBookingFormsPartial = true;
                    }

                    return $collBookingForms;
                }

                if ($partial && $this->collBookingForms) {
                    foreach ($this->collBookingForms as $obj) {
                        if ($obj->isNew()) {
                            $collBookingForms[] = $obj;
                        }
                    }
                }

                $this->collBookingForms = $collBookingForms;
                $this->collBookingFormsPartial = false;
            }
        }

        return $this->collBookingForms;
    }

    /**
     * Sets a collection of ChildBookingForm objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingForms A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function setBookingForms(Collection $bookingForms, ConnectionInterface $con = null)
    {
        /** @var ChildBookingForm[] $bookingFormsToDelete */
        $bookingFormsToDelete = $this->getBookingForms(new Criteria(), $con)->diff($bookingForms);


        $this->bookingFormsScheduledForDeletion = $bookingFormsToDelete;

        foreach ($bookingFormsToDelete as $bookingFormRemoved) {
            $bookingFormRemoved->setForm(null);
        }

        $this->collBookingForms = null;
        foreach ($bookingForms as $bookingForm) {
            $this->addBookingForm($bookingForm);
        }

        $this->collBookingForms = $bookingForms;
        $this->collBookingFormsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingForm objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingForm objects.
     * @throws PropelException
     */
    public function countBookingForms(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingFormsPartial && !$this->isNew();
        if (null === $this->collBookingForms || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingForms) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingForms());
            }

            $query = ChildBookingFormQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByForm($this)
                ->count($con);
        }

        return count($this->collBookingForms);
    }

    /**
     * Method called to associate a ChildBookingForm object to this object
     * through the ChildBookingForm foreign key attribute.
     *
     * @param  ChildBookingForm $l ChildBookingForm
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function addBookingForm(ChildBookingForm $l)
    {
        if ($this->collBookingForms === null) {
            $this->initBookingForms();
            $this->collBookingFormsPartial = true;
        }

        if (!$this->collBookingForms->contains($l)) {
            $this->doAddBookingForm($l);

            if ($this->bookingFormsScheduledForDeletion and $this->bookingFormsScheduledForDeletion->contains($l)) {
                $this->bookingFormsScheduledForDeletion->remove($this->bookingFormsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingForm $bookingForm The ChildBookingForm object to add.
     */
    protected function doAddBookingForm(ChildBookingForm $bookingForm)
    {
        $this->collBookingForms[]= $bookingForm;
        $bookingForm->setForm($this);
    }

    /**
     * @param  ChildBookingForm $bookingForm The ChildBookingForm object to remove.
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function removeBookingForm(ChildBookingForm $bookingForm)
    {
        if ($this->getBookingForms()->contains($bookingForm)) {
            $pos = $this->collBookingForms->search($bookingForm);
            $this->collBookingForms->remove($pos);
            if (null === $this->bookingFormsScheduledForDeletion) {
                $this->bookingFormsScheduledForDeletion = clone $this->collBookingForms;
                $this->bookingFormsScheduledForDeletion->clear();
            }
            $this->bookingFormsScheduledForDeletion[]= clone $bookingForm;
            $bookingForm->setForm(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Form is new, it will return
     * an empty collection; or if this Form has previously
     * been saved, it will retrieve related BookingForms from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Form.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingForm[] List of ChildBookingForm objects
     */
    public function getBookingFormsJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingFormQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingForms($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Form is new, it will return
     * an empty collection; or if this Form has previously
     * been saved, it will retrieve related BookingForms from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Form.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingForm[] List of ChildBookingForm objects
     */
    public function getBookingFormsJoinUserRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingFormQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByAuthorId', $joinBehavior);

        return $this->getBookingForms($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Form is new, it will return
     * an empty collection; or if this Form has previously
     * been saved, it will retrieve related BookingForms from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Form.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingForm[] List of ChildBookingForm objects
     */
    public function getBookingFormsJoinUserRelatedByCompletedBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingFormQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCompletedBy', $joinBehavior);

        return $this->getBookingForms($query, $con);
    }

    /**
     * Clears out the collFormFields collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFormFields()
     */
    public function clearFormFields()
    {
        $this->collFormFields = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFormFields collection loaded partially.
     */
    public function resetPartialFormFields($v = true)
    {
        $this->collFormFieldsPartial = $v;
    }

    /**
     * Initializes the collFormFields collection.
     *
     * By default this just sets the collFormFields collection to an empty array (like clearcollFormFields());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFormFields($overrideExisting = true)
    {
        if (null !== $this->collFormFields && !$overrideExisting) {
            return;
        }

        $collectionClassName = FormFieldTableMap::getTableMap()->getCollectionClassName();

        $this->collFormFields = new $collectionClassName;
        $this->collFormFields->setModel('\TheFarm\Models\FormField');
    }

    /**
     * Gets an array of ChildFormField objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildForm is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFormField[] List of ChildFormField objects
     * @throws PropelException
     */
    public function getFormFields(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFormFieldsPartial && !$this->isNew();
        if (null === $this->collFormFields || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFormFields) {
                // return empty collection
                $this->initFormFields();
            } else {
                $collFormFields = ChildFormFieldQuery::create(null, $criteria)
                    ->filterByForm($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFormFieldsPartial && count($collFormFields)) {
                        $this->initFormFields(false);

                        foreach ($collFormFields as $obj) {
                            if (false == $this->collFormFields->contains($obj)) {
                                $this->collFormFields->append($obj);
                            }
                        }

                        $this->collFormFieldsPartial = true;
                    }

                    return $collFormFields;
                }

                if ($partial && $this->collFormFields) {
                    foreach ($this->collFormFields as $obj) {
                        if ($obj->isNew()) {
                            $collFormFields[] = $obj;
                        }
                    }
                }

                $this->collFormFields = $collFormFields;
                $this->collFormFieldsPartial = false;
            }
        }

        return $this->collFormFields;
    }

    /**
     * Sets a collection of ChildFormField objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $formFields A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function setFormFields(Collection $formFields, ConnectionInterface $con = null)
    {
        /** @var ChildFormField[] $formFieldsToDelete */
        $formFieldsToDelete = $this->getFormFields(new Criteria(), $con)->diff($formFields);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->formFieldsScheduledForDeletion = clone $formFieldsToDelete;

        foreach ($formFieldsToDelete as $formFieldRemoved) {
            $formFieldRemoved->setForm(null);
        }

        $this->collFormFields = null;
        foreach ($formFields as $formField) {
            $this->addFormField($formField);
        }

        $this->collFormFields = $formFields;
        $this->collFormFieldsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FormField objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FormField objects.
     * @throws PropelException
     */
    public function countFormFields(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFormFieldsPartial && !$this->isNew();
        if (null === $this->collFormFields || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFormFields) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFormFields());
            }

            $query = ChildFormFieldQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByForm($this)
                ->count($con);
        }

        return count($this->collFormFields);
    }

    /**
     * Method called to associate a ChildFormField object to this object
     * through the ChildFormField foreign key attribute.
     *
     * @param  ChildFormField $l ChildFormField
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function addFormField(ChildFormField $l)
    {
        if ($this->collFormFields === null) {
            $this->initFormFields();
            $this->collFormFieldsPartial = true;
        }

        if (!$this->collFormFields->contains($l)) {
            $this->doAddFormField($l);

            if ($this->formFieldsScheduledForDeletion and $this->formFieldsScheduledForDeletion->contains($l)) {
                $this->formFieldsScheduledForDeletion->remove($this->formFieldsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFormField $formField The ChildFormField object to add.
     */
    protected function doAddFormField(ChildFormField $formField)
    {
        $this->collFormFields[]= $formField;
        $formField->setForm($this);
    }

    /**
     * @param  ChildFormField $formField The ChildFormField object to remove.
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function removeFormField(ChildFormField $formField)
    {
        if ($this->getFormFields()->contains($formField)) {
            $pos = $this->collFormFields->search($formField);
            $this->collFormFields->remove($pos);
            if (null === $this->formFieldsScheduledForDeletion) {
                $this->formFieldsScheduledForDeletion = clone $this->collFormFields;
                $this->formFieldsScheduledForDeletion->clear();
            }
            $this->formFieldsScheduledForDeletion[]= clone $formField;
            $formField->setForm(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Form is new, it will return
     * an empty collection; or if this Form has previously
     * been saved, it will retrieve related FormFields from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Form.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormField[] List of ChildFormField objects
     */
    public function getFormFieldsJoinField(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormFieldQuery::create(null, $criteria);
        $query->joinWith('Field', $joinBehavior);

        return $this->getFormFields($query, $con);
    }

    /**
     * Clears out the collItemForms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItemForms()
     */
    public function clearItemForms()
    {
        $this->collItemForms = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collItemForms collection loaded partially.
     */
    public function resetPartialItemForms($v = true)
    {
        $this->collItemFormsPartial = $v;
    }

    /**
     * Initializes the collItemForms collection.
     *
     * By default this just sets the collItemForms collection to an empty array (like clearcollItemForms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItemForms($overrideExisting = true)
    {
        if (null !== $this->collItemForms && !$overrideExisting) {
            return;
        }

        $collectionClassName = ItemFormTableMap::getTableMap()->getCollectionClassName();

        $this->collItemForms = new $collectionClassName;
        $this->collItemForms->setModel('\TheFarm\Models\ItemForm');
    }

    /**
     * Gets an array of ChildItemForm objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildForm is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildItemForm[] List of ChildItemForm objects
     * @throws PropelException
     */
    public function getItemForms(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collItemFormsPartial && !$this->isNew();
        if (null === $this->collItemForms || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItemForms) {
                // return empty collection
                $this->initItemForms();
            } else {
                $collItemForms = ChildItemFormQuery::create(null, $criteria)
                    ->filterByForm($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collItemFormsPartial && count($collItemForms)) {
                        $this->initItemForms(false);

                        foreach ($collItemForms as $obj) {
                            if (false == $this->collItemForms->contains($obj)) {
                                $this->collItemForms->append($obj);
                            }
                        }

                        $this->collItemFormsPartial = true;
                    }

                    return $collItemForms;
                }

                if ($partial && $this->collItemForms) {
                    foreach ($this->collItemForms as $obj) {
                        if ($obj->isNew()) {
                            $collItemForms[] = $obj;
                        }
                    }
                }

                $this->collItemForms = $collItemForms;
                $this->collItemFormsPartial = false;
            }
        }

        return $this->collItemForms;
    }

    /**
     * Sets a collection of ChildItemForm objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $itemForms A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function setItemForms(Collection $itemForms, ConnectionInterface $con = null)
    {
        /** @var ChildItemForm[] $itemFormsToDelete */
        $itemFormsToDelete = $this->getItemForms(new Criteria(), $con)->diff($itemForms);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->itemFormsScheduledForDeletion = clone $itemFormsToDelete;

        foreach ($itemFormsToDelete as $itemFormRemoved) {
            $itemFormRemoved->setForm(null);
        }

        $this->collItemForms = null;
        foreach ($itemForms as $itemForm) {
            $this->addItemForm($itemForm);
        }

        $this->collItemForms = $itemForms;
        $this->collItemFormsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ItemForm objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ItemForm objects.
     * @throws PropelException
     */
    public function countItemForms(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collItemFormsPartial && !$this->isNew();
        if (null === $this->collItemForms || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItemForms) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getItemForms());
            }

            $query = ChildItemFormQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByForm($this)
                ->count($con);
        }

        return count($this->collItemForms);
    }

    /**
     * Method called to associate a ChildItemForm object to this object
     * through the ChildItemForm foreign key attribute.
     *
     * @param  ChildItemForm $l ChildItemForm
     * @return $this|\TheFarm\Models\Form The current object (for fluent API support)
     */
    public function addItemForm(ChildItemForm $l)
    {
        if ($this->collItemForms === null) {
            $this->initItemForms();
            $this->collItemFormsPartial = true;
        }

        if (!$this->collItemForms->contains($l)) {
            $this->doAddItemForm($l);

            if ($this->itemFormsScheduledForDeletion and $this->itemFormsScheduledForDeletion->contains($l)) {
                $this->itemFormsScheduledForDeletion->remove($this->itemFormsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildItemForm $itemForm The ChildItemForm object to add.
     */
    protected function doAddItemForm(ChildItemForm $itemForm)
    {
        $this->collItemForms[]= $itemForm;
        $itemForm->setForm($this);
    }

    /**
     * @param  ChildItemForm $itemForm The ChildItemForm object to remove.
     * @return $this|ChildForm The current object (for fluent API support)
     */
    public function removeItemForm(ChildItemForm $itemForm)
    {
        if ($this->getItemForms()->contains($itemForm)) {
            $pos = $this->collItemForms->search($itemForm);
            $this->collItemForms->remove($pos);
            if (null === $this->itemFormsScheduledForDeletion) {
                $this->itemFormsScheduledForDeletion = clone $this->collItemForms;
                $this->itemFormsScheduledForDeletion->clear();
            }
            $this->itemFormsScheduledForDeletion[]= clone $itemForm;
            $itemForm->setForm(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Form is new, it will return
     * an empty collection; or if this Form has previously
     * been saved, it will retrieve related ItemForms from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Form.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemForm[] List of ChildItemForm objects
     */
    public function getItemFormsJoinItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemFormQuery::create(null, $criteria);
        $query->joinWith('Item', $joinBehavior);

        return $this->getItemForms($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->form_id = null;
        $this->form_name = null;
        $this->form_html = null;
        $this->field_ids = null;
        $this->author_id = null;
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
            if ($this->collBookingForms) {
                foreach ($this->collBookingForms as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFormFields) {
                foreach ($this->collFormFields as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemForms) {
                foreach ($this->collItemForms as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingForms = null;
        $this->collFormFields = null;
        $this->collItemForms = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FormTableMap::DEFAULT_STRING_FORMAT);
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
