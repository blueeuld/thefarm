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
use Propel\Runtime\Collection\ObjectCombinationCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\ProviderSchedule as ChildProviderSchedule;
use TheFarm\Models\ProviderScheduleQuery as ChildProviderScheduleQuery;
use TheFarm\Models\UserWorkPlanCode as ChildUserWorkPlanCode;
use TheFarm\Models\UserWorkPlanCodeQuery as ChildUserWorkPlanCodeQuery;
use TheFarm\Models\UserWorkPlanDay as ChildUserWorkPlanDay;
use TheFarm\Models\UserWorkPlanDayQuery as ChildUserWorkPlanDayQuery;
use TheFarm\Models\Map\ProviderScheduleTableMap;
use TheFarm\Models\Map\UserWorkPlanCodeTableMap;
use TheFarm\Models\Map\UserWorkPlanDayTableMap;

/**
 * Base class that represents a row from the 'tf_user_work_plan_code' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class UserWorkPlanCode implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\UserWorkPlanCodeTableMap';


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
     * The value for the work_plan_cd field.
     *
     * @var        string
     */
    protected $work_plan_cd;

    /**
     * The value for the work_plan_name field.
     *
     * @var        string
     */
    protected $work_plan_name;

    /**
     * @var        ObjectCollection|ChildUserWorkPlanDay[] Collection to store aggregation of ChildUserWorkPlanDay objects.
     */
    protected $collUserWorkPlanDays;
    protected $collUserWorkPlanDaysPartial;

    /**
     * @var        ObjectCollection|ChildProviderSchedule[] Collection to store aggregation of ChildProviderSchedule objects.
     */
    protected $collProviderSchedules;
    protected $collProviderSchedulesPartial;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildContact combinations.
     */
    protected $combinationCollContactStartDateEndDates;

    /**
     * @var bool
     */
    protected $combinationCollContactStartDateEndDatesPartial;

    /**
     * @var        ObjectCollection|ChildContact[] Cross Collection to store aggregation of ChildContact objects.
     */
    protected $collContacts;

    /**
     * @var bool
     */
    protected $collContactsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildContact combinations.
     */
    protected $combinationCollContactStartDateEndDatesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserWorkPlanDay[]
     */
    protected $userWorkPlanDaysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProviderSchedule[]
     */
    protected $providerSchedulesScheduledForDeletion = null;

    /**
     * Initializes internal state of TheFarm\Models\Base\UserWorkPlanCode object.
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
     * Compares this with another <code>UserWorkPlanCode</code> instance.  If
     * <code>obj</code> is an instance of <code>UserWorkPlanCode</code>, delegates to
     * <code>equals(UserWorkPlanCode)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|UserWorkPlanCode The current object, for fluid interface
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
     * Get the [work_plan_cd] column value.
     *
     * @return string
     */
    public function getWorkPlanCd()
    {
        return $this->work_plan_cd;
    }

    /**
     * Get the [work_plan_name] column value.
     *
     * @return string
     */
    public function getWorkPlanName()
    {
        return $this->work_plan_name;
    }

    /**
     * Set the value of [work_plan_cd] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\UserWorkPlanCode The current object (for fluent API support)
     */
    public function setWorkPlanCd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->work_plan_cd !== $v) {
            $this->work_plan_cd = $v;
            $this->modifiedColumns[UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD] = true;
        }

        return $this;
    } // setWorkPlanCd()

    /**
     * Set the value of [work_plan_name] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\UserWorkPlanCode The current object (for fluent API support)
     */
    public function setWorkPlanName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->work_plan_name !== $v) {
            $this->work_plan_name = $v;
            $this->modifiedColumns[UserWorkPlanCodeTableMap::COL_WORK_PLAN_NAME] = true;
        }

        return $this;
    } // setWorkPlanName()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserWorkPlanCodeTableMap::translateFieldName('WorkPlanCd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->work_plan_cd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserWorkPlanCodeTableMap::translateFieldName('WorkPlanName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->work_plan_name = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = UserWorkPlanCodeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\UserWorkPlanCode'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserWorkPlanCodeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUserWorkPlanDays = null;

            $this->collProviderSchedules = null;

            $this->collContactStartDateEndDates = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see UserWorkPlanCode::setDeleted()
     * @see UserWorkPlanCode::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserWorkPlanCodeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
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
                UserWorkPlanCodeTableMap::addInstanceToPool($this);
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

            if ($this->combinationCollContactStartDateEndDatesScheduledForDeletion !== null) {
                if (!$this->combinationCollContactStartDateEndDatesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->combinationCollContactStartDateEndDatesScheduledForDeletion as $combination) {
                        $entryPk = [];

                        $entryPk[] = $this->getWorkPlanCd();
                        $entryPk[0] = $combination[0]->getContactId();
                        //$combination[1] = StartDate;
                        $entryPk[1] = $combination[1];
                        //$combination[2] = EndDate;
                        $entryPk[2] = $combination[2];

                        $pks[] = $entryPk;
                    }

                    \TheFarm\Models\ProviderScheduleQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->combinationCollContactStartDateEndDatesScheduledForDeletion = null;
                }

            }

            if (null !== $this->combinationCollContactStartDateEndDates) {
                foreach ($this->combinationCollContactStartDateEndDates as $combination) {

                    //$combination[0] = Contact (tf_user_work_plan_time_fk_6a6d09)
                    if (!$combination[0]->isDeleted() && ($combination[0]->isNew() || $combination[0]->isModified())) {
                        $combination[0]->save($con);
                    }

                    //$combination[1] = StartDate; Nothing to save.
                    //$combination[2] = EndDate; Nothing to save.
                }
            }


            if ($this->userWorkPlanDaysScheduledForDeletion !== null) {
                if (!$this->userWorkPlanDaysScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\UserWorkPlanDayQuery::create()
                        ->filterByPrimaryKeys($this->userWorkPlanDaysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userWorkPlanDaysScheduledForDeletion = null;
                }
            }

            if ($this->collUserWorkPlanDays !== null) {
                foreach ($this->collUserWorkPlanDays as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->providerSchedulesScheduledForDeletion !== null) {
                if (!$this->providerSchedulesScheduledForDeletion->isEmpty()) {
                    foreach ($this->providerSchedulesScheduledForDeletion as $providerSchedule) {
                        // need to save related object because we set the relation to null
                        $providerSchedule->save($con);
                    }
                    $this->providerSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collProviderSchedules !== null) {
                foreach ($this->collProviderSchedules as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD)) {
            $modifiedColumns[':p' . $index++]  = 'work_plan_cd';
        }
        if ($this->isColumnModified(UserWorkPlanCodeTableMap::COL_WORK_PLAN_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'work_plan_name';
        }

        $sql = sprintf(
            'INSERT INTO tf_user_work_plan_code (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'work_plan_cd':
                        $stmt->bindValue($identifier, $this->work_plan_cd, PDO::PARAM_STR);
                        break;
                    case 'work_plan_name':
                        $stmt->bindValue($identifier, $this->work_plan_name, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = UserWorkPlanCodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWorkPlanCd();
                break;
            case 1:
                return $this->getWorkPlanName();
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

        if (isset($alreadyDumpedObjects['UserWorkPlanCode'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['UserWorkPlanCode'][$this->hashCode()] = true;
        $keys = UserWorkPlanCodeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getWorkPlanCd(),
            $keys[1] => $this->getWorkPlanName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collUserWorkPlanDays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userWorkPlanDays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user_work_plan_days';
                        break;
                    default:
                        $key = 'UserWorkPlanDays';
                }

                $result[$key] = $this->collUserWorkPlanDays->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProviderSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'providerSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_user_work_plan_times';
                        break;
                    default:
                        $key = 'ProviderSchedules';
                }

                $result[$key] = $this->collProviderSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\UserWorkPlanCode
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserWorkPlanCodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\UserWorkPlanCode
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setWorkPlanCd($value);
                break;
            case 1:
                $this->setWorkPlanName($value);
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
        $keys = UserWorkPlanCodeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setWorkPlanCd($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWorkPlanName($arr[$keys[1]]);
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
     * @return $this|\TheFarm\Models\UserWorkPlanCode The current object, for fluid interface
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
        $criteria = new Criteria(UserWorkPlanCodeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD)) {
            $criteria->add(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $this->work_plan_cd);
        }
        if ($this->isColumnModified(UserWorkPlanCodeTableMap::COL_WORK_PLAN_NAME)) {
            $criteria->add(UserWorkPlanCodeTableMap::COL_WORK_PLAN_NAME, $this->work_plan_name);
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
        $criteria = ChildUserWorkPlanCodeQuery::create();
        $criteria->add(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $this->work_plan_cd);

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
        $validPk = null !== $this->getWorkPlanCd();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getWorkPlanCd();
    }

    /**
     * Generic method to set the primary key (work_plan_cd column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setWorkPlanCd($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getWorkPlanCd();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\UserWorkPlanCode (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setWorkPlanCd($this->getWorkPlanCd());
        $copyObj->setWorkPlanName($this->getWorkPlanName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUserWorkPlanDays() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserWorkPlanDay($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProviderSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProviderSchedule($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \TheFarm\Models\UserWorkPlanCode Clone of current object.
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
        if ('UserWorkPlanDay' == $relationName) {
            $this->initUserWorkPlanDays();
            return;
        }
        if ('ProviderSchedule' == $relationName) {
            $this->initProviderSchedules();
            return;
        }
    }

    /**
     * Clears out the collUserWorkPlanDays collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserWorkPlanDays()
     */
    public function clearUserWorkPlanDays()
    {
        $this->collUserWorkPlanDays = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserWorkPlanDays collection loaded partially.
     */
    public function resetPartialUserWorkPlanDays($v = true)
    {
        $this->collUserWorkPlanDaysPartial = $v;
    }

    /**
     * Initializes the collUserWorkPlanDays collection.
     *
     * By default this just sets the collUserWorkPlanDays collection to an empty array (like clearcollUserWorkPlanDays());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserWorkPlanDays($overrideExisting = true)
    {
        if (null !== $this->collUserWorkPlanDays && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserWorkPlanDayTableMap::getTableMap()->getCollectionClassName();

        $this->collUserWorkPlanDays = new $collectionClassName;
        $this->collUserWorkPlanDays->setModel('\TheFarm\Models\UserWorkPlanDay');
    }

    /**
     * Gets an array of ChildUserWorkPlanDay objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUserWorkPlanCode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserWorkPlanDay[] List of ChildUserWorkPlanDay objects
     * @throws PropelException
     */
    public function getUserWorkPlanDays(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWorkPlanDaysPartial && !$this->isNew();
        if (null === $this->collUserWorkPlanDays || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserWorkPlanDays) {
                // return empty collection
                $this->initUserWorkPlanDays();
            } else {
                $collUserWorkPlanDays = ChildUserWorkPlanDayQuery::create(null, $criteria)
                    ->filterByUserWorkPlanCode($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserWorkPlanDaysPartial && count($collUserWorkPlanDays)) {
                        $this->initUserWorkPlanDays(false);

                        foreach ($collUserWorkPlanDays as $obj) {
                            if (false == $this->collUserWorkPlanDays->contains($obj)) {
                                $this->collUserWorkPlanDays->append($obj);
                            }
                        }

                        $this->collUserWorkPlanDaysPartial = true;
                    }

                    return $collUserWorkPlanDays;
                }

                if ($partial && $this->collUserWorkPlanDays) {
                    foreach ($this->collUserWorkPlanDays as $obj) {
                        if ($obj->isNew()) {
                            $collUserWorkPlanDays[] = $obj;
                        }
                    }
                }

                $this->collUserWorkPlanDays = $collUserWorkPlanDays;
                $this->collUserWorkPlanDaysPartial = false;
            }
        }

        return $this->collUserWorkPlanDays;
    }

    /**
     * Sets a collection of ChildUserWorkPlanDay objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userWorkPlanDays A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function setUserWorkPlanDays(Collection $userWorkPlanDays, ConnectionInterface $con = null)
    {
        /** @var ChildUserWorkPlanDay[] $userWorkPlanDaysToDelete */
        $userWorkPlanDaysToDelete = $this->getUserWorkPlanDays(new Criteria(), $con)->diff($userWorkPlanDays);


        $this->userWorkPlanDaysScheduledForDeletion = $userWorkPlanDaysToDelete;

        foreach ($userWorkPlanDaysToDelete as $userWorkPlanDayRemoved) {
            $userWorkPlanDayRemoved->setUserWorkPlanCode(null);
        }

        $this->collUserWorkPlanDays = null;
        foreach ($userWorkPlanDays as $userWorkPlanDay) {
            $this->addUserWorkPlanDay($userWorkPlanDay);
        }

        $this->collUserWorkPlanDays = $userWorkPlanDays;
        $this->collUserWorkPlanDaysPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserWorkPlanDay objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserWorkPlanDay objects.
     * @throws PropelException
     */
    public function countUserWorkPlanDays(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWorkPlanDaysPartial && !$this->isNew();
        if (null === $this->collUserWorkPlanDays || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserWorkPlanDays) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserWorkPlanDays());
            }

            $query = ChildUserWorkPlanDayQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserWorkPlanCode($this)
                ->count($con);
        }

        return count($this->collUserWorkPlanDays);
    }

    /**
     * Method called to associate a ChildUserWorkPlanDay object to this object
     * through the ChildUserWorkPlanDay foreign key attribute.
     *
     * @param  ChildUserWorkPlanDay $l ChildUserWorkPlanDay
     * @return $this|\TheFarm\Models\UserWorkPlanCode The current object (for fluent API support)
     */
    public function addUserWorkPlanDay(ChildUserWorkPlanDay $l)
    {
        if ($this->collUserWorkPlanDays === null) {
            $this->initUserWorkPlanDays();
            $this->collUserWorkPlanDaysPartial = true;
        }

        if (!$this->collUserWorkPlanDays->contains($l)) {
            $this->doAddUserWorkPlanDay($l);

            if ($this->userWorkPlanDaysScheduledForDeletion and $this->userWorkPlanDaysScheduledForDeletion->contains($l)) {
                $this->userWorkPlanDaysScheduledForDeletion->remove($this->userWorkPlanDaysScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserWorkPlanDay $userWorkPlanDay The ChildUserWorkPlanDay object to add.
     */
    protected function doAddUserWorkPlanDay(ChildUserWorkPlanDay $userWorkPlanDay)
    {
        $this->collUserWorkPlanDays[]= $userWorkPlanDay;
        $userWorkPlanDay->setUserWorkPlanCode($this);
    }

    /**
     * @param  ChildUserWorkPlanDay $userWorkPlanDay The ChildUserWorkPlanDay object to remove.
     * @return $this|ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function removeUserWorkPlanDay(ChildUserWorkPlanDay $userWorkPlanDay)
    {
        if ($this->getUserWorkPlanDays()->contains($userWorkPlanDay)) {
            $pos = $this->collUserWorkPlanDays->search($userWorkPlanDay);
            $this->collUserWorkPlanDays->remove($pos);
            if (null === $this->userWorkPlanDaysScheduledForDeletion) {
                $this->userWorkPlanDaysScheduledForDeletion = clone $this->collUserWorkPlanDays;
                $this->userWorkPlanDaysScheduledForDeletion->clear();
            }
            $this->userWorkPlanDaysScheduledForDeletion[]= clone $userWorkPlanDay;
            $userWorkPlanDay->setUserWorkPlanCode(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UserWorkPlanCode is new, it will return
     * an empty collection; or if this UserWorkPlanCode has previously
     * been saved, it will retrieve related UserWorkPlanDays from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UserWorkPlanCode.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserWorkPlanDay[] List of ChildUserWorkPlanDay objects
     */
    public function getUserWorkPlanDaysJoinContact(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserWorkPlanDayQuery::create(null, $criteria);
        $query->joinWith('Contact', $joinBehavior);

        return $this->getUserWorkPlanDays($query, $con);
    }

    /**
     * Clears out the collProviderSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProviderSchedules()
     */
    public function clearProviderSchedules()
    {
        $this->collProviderSchedules = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProviderSchedules collection loaded partially.
     */
    public function resetPartialProviderSchedules($v = true)
    {
        $this->collProviderSchedulesPartial = $v;
    }

    /**
     * Initializes the collProviderSchedules collection.
     *
     * By default this just sets the collProviderSchedules collection to an empty array (like clearcollProviderSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProviderSchedules($overrideExisting = true)
    {
        if (null !== $this->collProviderSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProviderScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collProviderSchedules = new $collectionClassName;
        $this->collProviderSchedules->setModel('\TheFarm\Models\ProviderSchedule');
    }

    /**
     * Gets an array of ChildProviderSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUserWorkPlanCode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProviderSchedule[] List of ChildProviderSchedule objects
     * @throws PropelException
     */
    public function getProviderSchedules(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProviderSchedulesPartial && !$this->isNew();
        if (null === $this->collProviderSchedules || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProviderSchedules) {
                // return empty collection
                $this->initProviderSchedules();
            } else {
                $collProviderSchedules = ChildProviderScheduleQuery::create(null, $criteria)
                    ->filterByWorkPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProviderSchedulesPartial && count($collProviderSchedules)) {
                        $this->initProviderSchedules(false);

                        foreach ($collProviderSchedules as $obj) {
                            if (false == $this->collProviderSchedules->contains($obj)) {
                                $this->collProviderSchedules->append($obj);
                            }
                        }

                        $this->collProviderSchedulesPartial = true;
                    }

                    return $collProviderSchedules;
                }

                if ($partial && $this->collProviderSchedules) {
                    foreach ($this->collProviderSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collProviderSchedules[] = $obj;
                        }
                    }
                }

                $this->collProviderSchedules = $collProviderSchedules;
                $this->collProviderSchedulesPartial = false;
            }
        }

        return $this->collProviderSchedules;
    }

    /**
     * Sets a collection of ChildProviderSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $providerSchedules A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function setProviderSchedules(Collection $providerSchedules, ConnectionInterface $con = null)
    {
        /** @var ChildProviderSchedule[] $providerSchedulesToDelete */
        $providerSchedulesToDelete = $this->getProviderSchedules(new Criteria(), $con)->diff($providerSchedules);


        $this->providerSchedulesScheduledForDeletion = $providerSchedulesToDelete;

        foreach ($providerSchedulesToDelete as $providerScheduleRemoved) {
            $providerScheduleRemoved->setWorkPlan(null);
        }

        $this->collProviderSchedules = null;
        foreach ($providerSchedules as $providerSchedule) {
            $this->addProviderSchedule($providerSchedule);
        }

        $this->collProviderSchedules = $providerSchedules;
        $this->collProviderSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProviderSchedule objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProviderSchedule objects.
     * @throws PropelException
     */
    public function countProviderSchedules(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProviderSchedulesPartial && !$this->isNew();
        if (null === $this->collProviderSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProviderSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProviderSchedules());
            }

            $query = ChildProviderScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWorkPlan($this)
                ->count($con);
        }

        return count($this->collProviderSchedules);
    }

    /**
     * Method called to associate a ChildProviderSchedule object to this object
     * through the ChildProviderSchedule foreign key attribute.
     *
     * @param  ChildProviderSchedule $l ChildProviderSchedule
     * @return $this|\TheFarm\Models\UserWorkPlanCode The current object (for fluent API support)
     */
    public function addProviderSchedule(ChildProviderSchedule $l)
    {
        if ($this->collProviderSchedules === null) {
            $this->initProviderSchedules();
            $this->collProviderSchedulesPartial = true;
        }

        if (!$this->collProviderSchedules->contains($l)) {
            $this->doAddProviderSchedule($l);

            if ($this->providerSchedulesScheduledForDeletion and $this->providerSchedulesScheduledForDeletion->contains($l)) {
                $this->providerSchedulesScheduledForDeletion->remove($this->providerSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProviderSchedule $providerSchedule The ChildProviderSchedule object to add.
     */
    protected function doAddProviderSchedule(ChildProviderSchedule $providerSchedule)
    {
        $this->collProviderSchedules[]= $providerSchedule;
        $providerSchedule->setWorkPlan($this);
    }

    /**
     * @param  ChildProviderSchedule $providerSchedule The ChildProviderSchedule object to remove.
     * @return $this|ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function removeProviderSchedule(ChildProviderSchedule $providerSchedule)
    {
        if ($this->getProviderSchedules()->contains($providerSchedule)) {
            $pos = $this->collProviderSchedules->search($providerSchedule);
            $this->collProviderSchedules->remove($pos);
            if (null === $this->providerSchedulesScheduledForDeletion) {
                $this->providerSchedulesScheduledForDeletion = clone $this->collProviderSchedules;
                $this->providerSchedulesScheduledForDeletion->clear();
            }
            $this->providerSchedulesScheduledForDeletion[]= $providerSchedule;
            $providerSchedule->setWorkPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UserWorkPlanCode is new, it will return
     * an empty collection; or if this UserWorkPlanCode has previously
     * been saved, it will retrieve related ProviderSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UserWorkPlanCode.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProviderSchedule[] List of ChildProviderSchedule objects
     */
    public function getProviderSchedulesJoinContact(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProviderScheduleQuery::create(null, $criteria);
        $query->joinWith('Contact', $joinBehavior);

        return $this->getProviderSchedules($query, $con);
    }

    /**
     * Clears out the collContactStartDateEndDates collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addContactStartDateEndDates()
     */
    public function clearContactStartDateEndDates()
    {
        $this->collContactStartDateEndDates = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the combinationCollContactStartDateEndDates crossRef collection.
     *
     * By default this just sets the combinationCollContactStartDateEndDates collection to an empty collection (like clearContactStartDateEndDates());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initContactStartDateEndDates()
    {
        $this->combinationCollContactStartDateEndDates = new ObjectCombinationCollection;
        $this->combinationCollContactStartDateEndDatesPartial = true;
    }

    /**
     * Checks if the combinationCollContactStartDateEndDates collection is loaded.
     *
     * @return bool
     */
    public function isContactStartDateEndDatesLoaded()
    {
        return null !== $this->combinationCollContactStartDateEndDates;
    }

    /**
     * Returns a new query object pre configured with filters from current object and given arguments to query the database.
     *
     * @param string $startDate,
     * @param string $endDate
     * @param Criteria $criteria
     *
     * @return ChildContactQuery
     */
    public function createContactsQuery($startDate = null, $endDate = null, Criteria $criteria = null)
    {
        $criteria = ChildContactQuery::create($criteria)
            ->filterByWorkPlan($this);

        $providerScheduleQuery = $criteria->useProviderScheduleQuery();

        if (null !== $startDate) {
            $providerScheduleQuery->filterByStartDate($startDate);
        }

        if (null !== $endDate) {
            $providerScheduleQuery->filterByEndDate($endDate);
        }

        $providerScheduleQuery->endUse();

        return $criteria;
    }

    /**
     * Gets a combined collection of ChildContact objects related by a many-to-many relationship
     * to the current object by way of the tf_user_work_plan_time cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUserWorkPlanCode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCombinationCollection Combination list of ChildContact objects
     */
    public function getContactStartDateEndDates($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollContactStartDateEndDatesPartial && !$this->isNew();
        if (null === $this->combinationCollContactStartDateEndDates || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->combinationCollContactStartDateEndDates) {
                    $this->initContactStartDateEndDates();
                }
            } else {

                $query = ChildProviderScheduleQuery::create(null, $criteria)
                    ->filterByWorkPlan($this)
                    ->joinContact()
                ;

                $items = $query->find($con);
                $combinationCollContactStartDateEndDates = new ObjectCombinationCollection();
                foreach ($items as $item) {
                    $combination = [];

                    $combination[] = $item->getContact();
                    $combination[] = $item->getStartDate();
                    $combination[] = $item->getEndDate();
                    $combinationCollContactStartDateEndDates[] = $combination;
                }

                if (null !== $criteria) {
                    return $combinationCollContactStartDateEndDates;
                }

                if ($partial && $this->combinationCollContactStartDateEndDates) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->combinationCollContactStartDateEndDates as $obj) {
                        if (!call_user_func_array([$combinationCollContactStartDateEndDates, 'contains'], $obj)) {
                            $combinationCollContactStartDateEndDates[] = $obj;
                        }
                    }
                }

                $this->combinationCollContactStartDateEndDates = $combinationCollContactStartDateEndDates;
                $this->combinationCollContactStartDateEndDatesPartial = false;
            }
        }

        return $this->combinationCollContactStartDateEndDates;
    }

    /**
     * Returns a not cached ObjectCollection of ChildContact objects. This will hit always the databases.
     * If you have attached new ChildContact object to this object you need to call `save` first to get
     * the correct return value. Use getContactStartDateEndDates() to get the current internal state.
     *
     * @param string $startDate,
     * @param string $endDate
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return ChildContact[]|ObjectCollection
     */
    public function getContacts($startDate = null, $endDate = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createContactsQuery($startDate, $endDate, $criteria)->find($con);
    }

    /**
     * Sets a collection of ChildContact objects related by a many-to-many relationship
     * to the current object by way of the tf_user_work_plan_time cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $contactStartDateEndDates A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function setContactStartDateEndDates(Collection $contactStartDateEndDates, ConnectionInterface $con = null)
    {
        $this->clearContactStartDateEndDates();
        $currentContactStartDateEndDates = $this->getContactStartDateEndDates();

        $combinationCollContactStartDateEndDatesScheduledForDeletion = $currentContactStartDateEndDates->diff($contactStartDateEndDates);

        foreach ($combinationCollContactStartDateEndDatesScheduledForDeletion as $toDelete) {
            call_user_func_array([$this, 'removeContactStartDateEndDate'], $toDelete);
        }

        foreach ($contactStartDateEndDates as $contactStartDateEndDate) {
            if (!call_user_func_array([$currentContactStartDateEndDates, 'contains'], $contactStartDateEndDate)) {
                call_user_func_array([$this, 'doAddContactStartDateEndDate'], $contactStartDateEndDate);
            }
        }

        $this->combinationCollContactStartDateEndDatesPartial = false;
        $this->combinationCollContactStartDateEndDates = $contactStartDateEndDates;

        return $this;
    }

    /**
     * Gets the number of ChildContact objects related by a many-to-many relationship
     * to the current object by way of the tf_user_work_plan_time cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related ChildContact objects
     */
    public function countContactStartDateEndDates(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollContactStartDateEndDatesPartial && !$this->isNew();
        if (null === $this->combinationCollContactStartDateEndDates || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->combinationCollContactStartDateEndDates) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getContactStartDateEndDates());
                }

                $query = ChildProviderScheduleQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByWorkPlan($this)
                    ->count($con);
            }
        } else {
            return count($this->combinationCollContactStartDateEndDates);
        }
    }

    /**
     * Returns the not cached count of ChildContact objects. This will hit always the databases.
     * If you have attached new ChildContact object to this object you need to call `save` first to get
     * the correct return value. Use getContactStartDateEndDates() to get the current internal state.
     *
     * @param string $startDate,
     * @param string $endDate
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return integer
     */
    public function countContacts($startDate = null, $endDate = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createContactsQuery($startDate, $endDate, $criteria)->count($con);
    }

    /**
     * Associate a ChildContact to this object
     * through the tf_user_work_plan_time cross reference table.
     *
     * @param ChildContact $contact,
     * @param string $startDate,
     * @param string $endDate
     * @return ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function addContact(ChildContact $contact, $startDate, $endDate)
    {
        if ($this->combinationCollContactStartDateEndDates === null) {
            $this->initContactStartDateEndDates();
        }

        if (!$this->getContactStartDateEndDates()->contains($contact, $startDate, $endDate)) {
            // only add it if the **same** object is not already associated
            $this->combinationCollContactStartDateEndDates->push($contact, $startDate, $endDate);
            $this->doAddContactStartDateEndDate($contact, $startDate, $endDate);
        }

        return $this;
    }

    /**
     *
     * @param ChildContact $contact,
     * @param string $startDate,
     * @param string $endDate
     */
    protected function doAddContactStartDateEndDate(ChildContact $contact, $startDate, $endDate)
    {
        $providerSchedule = new ChildProviderSchedule();

        $providerSchedule->setContact($contact);
        $providerSchedule->setStartDate($startDate);

        $providerSchedule->setEndDate($endDate);


        $providerSchedule->setWorkPlan($this);

        $this->addProviderSchedule($providerSchedule);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if ($contact->isWorkPlanStartDateEndDatesLoaded()) {
            $contact->initWorkPlanStartDateEndDates();
            $contact->getWorkPlanStartDateEndDates()->push($this, $startDate, $endDate);
        } elseif (!$contact->getWorkPlanStartDateEndDates()->contains($this, $startDate, $endDate)) {
            $contact->getWorkPlanStartDateEndDates()->push($this, $startDate, $endDate);
        }

    }

    /**
     * Remove contact, startDate, endDate of this object
     * through the tf_user_work_plan_time cross reference table.
     *
     * @param ChildContact $contact,
     * @param string $startDate,
     * @param string $endDate
     * @return ChildUserWorkPlanCode The current object (for fluent API support)
     */
    public function removeContactStartDateEndDate(ChildContact $contact, $startDate, $endDate)
    {
        if ($this->getContactStartDateEndDates()->contains($contact, $startDate, $endDate)) {
            $providerSchedule = new ChildProviderSchedule();
            $providerSchedule->setContact($contact);
            if ($contact->isWorkPlanStartDateEndDatesLoaded()) {
                //remove the back reference if available
                $contact->getWorkPlanStartDateEndDates()->removeObject($this, $startDate, $endDate);
            }

            $providerSchedule->setStartDate($startDate);
            $providerSchedule->setEndDate($endDate);
            $providerSchedule->setWorkPlan($this);
            $this->removeProviderSchedule(clone $providerSchedule);
            $providerSchedule->clear();

            $this->combinationCollContactStartDateEndDates->remove($this->combinationCollContactStartDateEndDates->search($contact, $startDate, $endDate));

            if (null === $this->combinationCollContactStartDateEndDatesScheduledForDeletion) {
                $this->combinationCollContactStartDateEndDatesScheduledForDeletion = clone $this->combinationCollContactStartDateEndDates;
                $this->combinationCollContactStartDateEndDatesScheduledForDeletion->clear();
            }

            $this->combinationCollContactStartDateEndDatesScheduledForDeletion->push($contact, $startDate, $endDate);
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
        $this->work_plan_cd = null;
        $this->work_plan_name = null;
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
            if ($this->collUserWorkPlanDays) {
                foreach ($this->collUserWorkPlanDays as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProviderSchedules) {
                foreach ($this->collProviderSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->combinationCollContactStartDateEndDates) {
                foreach ($this->combinationCollContactStartDateEndDates as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUserWorkPlanDays = null;
        $this->collProviderSchedules = null;
        $this->combinationCollContactStartDateEndDates = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserWorkPlanCodeTableMap::DEFAULT_STRING_FORMAT);
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
