<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use TheFarm\Models\FormEntries1Query as ChildFormEntries1Query;
use TheFarm\Models\Map\FormEntries1TableMap;

/**
 * Base class that represents a row from the 'tf_form_entries_1' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class FormEntries1 implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\FormEntries1TableMap';


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
     * The value for the entry_id field.
     *
     * @var        int
     */
    protected $entry_id;

    /**
     * The value for the booking_id field.
     *
     * @var        int
     */
    protected $booking_id;

    /**
     * The value for the field_id_29 field.
     *
     * @var        string
     */
    protected $field_id_29;

    /**
     * The value for the field_id_52 field.
     *
     * @var        string
     */
    protected $field_id_52;

    /**
     * The value for the field_id_54 field.
     *
     * @var        string
     */
    protected $field_id_54;

    /**
     * The value for the field_id_53 field.
     *
     * @var        string
     */
    protected $field_id_53;

    /**
     * The value for the field_id_55 field.
     *
     * @var        string
     */
    protected $field_id_55;

    /**
     * The value for the field_id_58 field.
     *
     * @var        string
     */
    protected $field_id_58;

    /**
     * The value for the field_id_57 field.
     *
     * @var        string
     */
    protected $field_id_57;

    /**
     * The value for the field_id_56 field.
     *
     * @var        string
     */
    protected $field_id_56;

    /**
     * The value for the field_id_51 field.
     *
     * @var        string
     */
    protected $field_id_51;

    /**
     * The value for the field_id_50 field.
     *
     * @var        string
     */
    protected $field_id_50;

    /**
     * The value for the field_id_49 field.
     *
     * @var        string
     */
    protected $field_id_49;

    /**
     * The value for the field_id_48 field.
     *
     * @var        string
     */
    protected $field_id_48;

    /**
     * The value for the field_id_47 field.
     *
     * @var        string
     */
    protected $field_id_47;

    /**
     * The value for the field_id_46 field.
     *
     * @var        string
     */
    protected $field_id_46;

    /**
     * The value for the field_id_45 field.
     *
     * @var        string
     */
    protected $field_id_45;

    /**
     * The value for the field_id_44 field.
     *
     * @var        string
     */
    protected $field_id_44;

    /**
     * The value for the field_id_43 field.
     *
     * @var        string
     */
    protected $field_id_43;

    /**
     * The value for the field_id_42 field.
     *
     * @var        string
     */
    protected $field_id_42;

    /**
     * The value for the field_id_41 field.
     *
     * @var        string
     */
    protected $field_id_41;

    /**
     * The value for the field_id_40 field.
     *
     * @var        string
     */
    protected $field_id_40;

    /**
     * The value for the field_id_37 field.
     *
     * @var        string
     */
    protected $field_id_37;

    /**
     * The value for the field_id_35 field.
     *
     * @var        string
     */
    protected $field_id_35;

    /**
     * The value for the field_id_33 field.
     *
     * @var        string
     */
    protected $field_id_33;

    /**
     * The value for the field_id_32 field.
     *
     * @var        string
     */
    protected $field_id_32;

    /**
     * The value for the field_id_31 field.
     *
     * @var        string
     */
    protected $field_id_31;

    /**
     * The value for the field_id_30 field.
     *
     * @var        string
     */
    protected $field_id_30;

    /**
     * The value for the field_id_28 field.
     *
     * @var        string
     */
    protected $field_id_28;

    /**
     * The value for the field_id_26 field.
     *
     * @var        string
     */
    protected $field_id_26;

    /**
     * The value for the field_id_25 field.
     *
     * @var        string
     */
    protected $field_id_25;

    /**
     * The value for the field_id_19 field.
     *
     * @var        string
     */
    protected $field_id_19;

    /**
     * The value for the field_id_18 field.
     *
     * @var        string
     */
    protected $field_id_18;

    /**
     * The value for the field_id_17 field.
     *
     * @var        string
     */
    protected $field_id_17;

    /**
     * The value for the field_id_6 field.
     *
     * @var        string
     */
    protected $field_id_6;

    /**
     * The value for the field_id_5 field.
     *
     * @var        string
     */
    protected $field_id_5;

    /**
     * The value for the field_id_4 field.
     *
     * @var        string
     */
    protected $field_id_4;

    /**
     * The value for the field_id_2 field.
     *
     * @var        string
     */
    protected $field_id_2;

    /**
     * The value for the field_id_1 field.
     *
     * @var        string
     */
    protected $field_id_1;

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
     * The value for the completed_by field.
     *
     * @var        int
     */
    protected $completed_by;

    /**
     * The value for the completed_date field.
     *
     * @var        int
     */
    protected $completed_date;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of TheFarm\Models\Base\FormEntries1 object.
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
     * Compares this with another <code>FormEntries1</code> instance.  If
     * <code>obj</code> is an instance of <code>FormEntries1</code>, delegates to
     * <code>equals(FormEntries1)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|FormEntries1 The current object, for fluid interface
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
     * Get the [entry_id] column value.
     *
     * @return int
     */
    public function getEntryId()
    {
        return $this->entry_id;
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
     * Get the [field_id_29] column value.
     *
     * @return string
     */
    public function getFieldId29()
    {
        return $this->field_id_29;
    }

    /**
     * Get the [field_id_52] column value.
     *
     * @return string
     */
    public function getFieldId52()
    {
        return $this->field_id_52;
    }

    /**
     * Get the [field_id_54] column value.
     *
     * @return string
     */
    public function getFieldId54()
    {
        return $this->field_id_54;
    }

    /**
     * Get the [field_id_53] column value.
     *
     * @return string
     */
    public function getFieldId53()
    {
        return $this->field_id_53;
    }

    /**
     * Get the [field_id_55] column value.
     *
     * @return string
     */
    public function getFieldId55()
    {
        return $this->field_id_55;
    }

    /**
     * Get the [field_id_58] column value.
     *
     * @return string
     */
    public function getFieldId58()
    {
        return $this->field_id_58;
    }

    /**
     * Get the [field_id_57] column value.
     *
     * @return string
     */
    public function getFieldId57()
    {
        return $this->field_id_57;
    }

    /**
     * Get the [field_id_56] column value.
     *
     * @return string
     */
    public function getFieldId56()
    {
        return $this->field_id_56;
    }

    /**
     * Get the [field_id_51] column value.
     *
     * @return string
     */
    public function getFieldId51()
    {
        return $this->field_id_51;
    }

    /**
     * Get the [field_id_50] column value.
     *
     * @return string
     */
    public function getFieldId50()
    {
        return $this->field_id_50;
    }

    /**
     * Get the [field_id_49] column value.
     *
     * @return string
     */
    public function getFieldId49()
    {
        return $this->field_id_49;
    }

    /**
     * Get the [field_id_48] column value.
     *
     * @return string
     */
    public function getFieldId48()
    {
        return $this->field_id_48;
    }

    /**
     * Get the [field_id_47] column value.
     *
     * @return string
     */
    public function getFieldId47()
    {
        return $this->field_id_47;
    }

    /**
     * Get the [field_id_46] column value.
     *
     * @return string
     */
    public function getFieldId46()
    {
        return $this->field_id_46;
    }

    /**
     * Get the [field_id_45] column value.
     *
     * @return string
     */
    public function getFieldId45()
    {
        return $this->field_id_45;
    }

    /**
     * Get the [field_id_44] column value.
     *
     * @return string
     */
    public function getFieldId44()
    {
        return $this->field_id_44;
    }

    /**
     * Get the [field_id_43] column value.
     *
     * @return string
     */
    public function getFieldId43()
    {
        return $this->field_id_43;
    }

    /**
     * Get the [field_id_42] column value.
     *
     * @return string
     */
    public function getFieldId42()
    {
        return $this->field_id_42;
    }

    /**
     * Get the [field_id_41] column value.
     *
     * @return string
     */
    public function getFieldId41()
    {
        return $this->field_id_41;
    }

    /**
     * Get the [field_id_40] column value.
     *
     * @return string
     */
    public function getFieldId40()
    {
        return $this->field_id_40;
    }

    /**
     * Get the [field_id_37] column value.
     *
     * @return string
     */
    public function getFieldId37()
    {
        return $this->field_id_37;
    }

    /**
     * Get the [field_id_35] column value.
     *
     * @return string
     */
    public function getFieldId35()
    {
        return $this->field_id_35;
    }

    /**
     * Get the [field_id_33] column value.
     *
     * @return string
     */
    public function getFieldId33()
    {
        return $this->field_id_33;
    }

    /**
     * Get the [field_id_32] column value.
     *
     * @return string
     */
    public function getFieldId32()
    {
        return $this->field_id_32;
    }

    /**
     * Get the [field_id_31] column value.
     *
     * @return string
     */
    public function getFieldId31()
    {
        return $this->field_id_31;
    }

    /**
     * Get the [field_id_30] column value.
     *
     * @return string
     */
    public function getFieldId30()
    {
        return $this->field_id_30;
    }

    /**
     * Get the [field_id_28] column value.
     *
     * @return string
     */
    public function getFieldId28()
    {
        return $this->field_id_28;
    }

    /**
     * Get the [field_id_26] column value.
     *
     * @return string
     */
    public function getFieldId26()
    {
        return $this->field_id_26;
    }

    /**
     * Get the [field_id_25] column value.
     *
     * @return string
     */
    public function getFieldId25()
    {
        return $this->field_id_25;
    }

    /**
     * Get the [field_id_19] column value.
     *
     * @return string
     */
    public function getFieldId19()
    {
        return $this->field_id_19;
    }

    /**
     * Get the [field_id_18] column value.
     *
     * @return string
     */
    public function getFieldId18()
    {
        return $this->field_id_18;
    }

    /**
     * Get the [field_id_17] column value.
     *
     * @return string
     */
    public function getFieldId17()
    {
        return $this->field_id_17;
    }

    /**
     * Get the [field_id_6] column value.
     *
     * @return string
     */
    public function getFieldId6()
    {
        return $this->field_id_6;
    }

    /**
     * Get the [field_id_5] column value.
     *
     * @return string
     */
    public function getFieldId5()
    {
        return $this->field_id_5;
    }

    /**
     * Get the [field_id_4] column value.
     *
     * @return string
     */
    public function getFieldId4()
    {
        return $this->field_id_4;
    }

    /**
     * Get the [field_id_2] column value.
     *
     * @return string
     */
    public function getFieldId2()
    {
        return $this->field_id_2;
    }

    /**
     * Get the [field_id_1] column value.
     *
     * @return string
     */
    public function getFieldId1()
    {
        return $this->field_id_1;
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
     * Get the [completed_by] column value.
     *
     * @return int
     */
    public function getCompletedBy()
    {
        return $this->completed_by;
    }

    /**
     * Get the [completed_date] column value.
     *
     * @return int
     */
    public function getCompletedDate()
    {
        return $this->completed_date;
    }

    /**
     * Set the value of [entry_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setEntryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_id !== $v) {
            $this->entry_id = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_ENTRY_ID] = true;
        }

        return $this;
    } // setEntryId()

    /**
     * Set the value of [booking_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setBookingId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->booking_id !== $v) {
            $this->booking_id = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_BOOKING_ID] = true;
        }

        return $this;
    } // setBookingId()

    /**
     * Set the value of [field_id_29] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId29($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_29 !== $v) {
            $this->field_id_29 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_29] = true;
        }

        return $this;
    } // setFieldId29()

    /**
     * Set the value of [field_id_52] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId52($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_52 !== $v) {
            $this->field_id_52 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_52] = true;
        }

        return $this;
    } // setFieldId52()

    /**
     * Set the value of [field_id_54] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId54($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_54 !== $v) {
            $this->field_id_54 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_54] = true;
        }

        return $this;
    } // setFieldId54()

    /**
     * Set the value of [field_id_53] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId53($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_53 !== $v) {
            $this->field_id_53 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_53] = true;
        }

        return $this;
    } // setFieldId53()

    /**
     * Set the value of [field_id_55] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId55($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_55 !== $v) {
            $this->field_id_55 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_55] = true;
        }

        return $this;
    } // setFieldId55()

    /**
     * Set the value of [field_id_58] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId58($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_58 !== $v) {
            $this->field_id_58 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_58] = true;
        }

        return $this;
    } // setFieldId58()

    /**
     * Set the value of [field_id_57] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId57($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_57 !== $v) {
            $this->field_id_57 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_57] = true;
        }

        return $this;
    } // setFieldId57()

    /**
     * Set the value of [field_id_56] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId56($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_56 !== $v) {
            $this->field_id_56 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_56] = true;
        }

        return $this;
    } // setFieldId56()

    /**
     * Set the value of [field_id_51] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId51($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_51 !== $v) {
            $this->field_id_51 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_51] = true;
        }

        return $this;
    } // setFieldId51()

    /**
     * Set the value of [field_id_50] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId50($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_50 !== $v) {
            $this->field_id_50 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_50] = true;
        }

        return $this;
    } // setFieldId50()

    /**
     * Set the value of [field_id_49] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId49($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_49 !== $v) {
            $this->field_id_49 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_49] = true;
        }

        return $this;
    } // setFieldId49()

    /**
     * Set the value of [field_id_48] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId48($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_48 !== $v) {
            $this->field_id_48 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_48] = true;
        }

        return $this;
    } // setFieldId48()

    /**
     * Set the value of [field_id_47] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId47($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_47 !== $v) {
            $this->field_id_47 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_47] = true;
        }

        return $this;
    } // setFieldId47()

    /**
     * Set the value of [field_id_46] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId46($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_46 !== $v) {
            $this->field_id_46 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_46] = true;
        }

        return $this;
    } // setFieldId46()

    /**
     * Set the value of [field_id_45] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId45($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_45 !== $v) {
            $this->field_id_45 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_45] = true;
        }

        return $this;
    } // setFieldId45()

    /**
     * Set the value of [field_id_44] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId44($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_44 !== $v) {
            $this->field_id_44 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_44] = true;
        }

        return $this;
    } // setFieldId44()

    /**
     * Set the value of [field_id_43] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId43($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_43 !== $v) {
            $this->field_id_43 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_43] = true;
        }

        return $this;
    } // setFieldId43()

    /**
     * Set the value of [field_id_42] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId42($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_42 !== $v) {
            $this->field_id_42 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_42] = true;
        }

        return $this;
    } // setFieldId42()

    /**
     * Set the value of [field_id_41] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId41($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_41 !== $v) {
            $this->field_id_41 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_41] = true;
        }

        return $this;
    } // setFieldId41()

    /**
     * Set the value of [field_id_40] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId40($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_40 !== $v) {
            $this->field_id_40 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_40] = true;
        }

        return $this;
    } // setFieldId40()

    /**
     * Set the value of [field_id_37] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId37($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_37 !== $v) {
            $this->field_id_37 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_37] = true;
        }

        return $this;
    } // setFieldId37()

    /**
     * Set the value of [field_id_35] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId35($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_35 !== $v) {
            $this->field_id_35 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_35] = true;
        }

        return $this;
    } // setFieldId35()

    /**
     * Set the value of [field_id_33] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId33($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_33 !== $v) {
            $this->field_id_33 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_33] = true;
        }

        return $this;
    } // setFieldId33()

    /**
     * Set the value of [field_id_32] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId32($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_32 !== $v) {
            $this->field_id_32 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_32] = true;
        }

        return $this;
    } // setFieldId32()

    /**
     * Set the value of [field_id_31] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId31($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_31 !== $v) {
            $this->field_id_31 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_31] = true;
        }

        return $this;
    } // setFieldId31()

    /**
     * Set the value of [field_id_30] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId30($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_30 !== $v) {
            $this->field_id_30 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_30] = true;
        }

        return $this;
    } // setFieldId30()

    /**
     * Set the value of [field_id_28] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId28($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_28 !== $v) {
            $this->field_id_28 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_28] = true;
        }

        return $this;
    } // setFieldId28()

    /**
     * Set the value of [field_id_26] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId26($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_26 !== $v) {
            $this->field_id_26 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_26] = true;
        }

        return $this;
    } // setFieldId26()

    /**
     * Set the value of [field_id_25] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId25($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_25 !== $v) {
            $this->field_id_25 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_25] = true;
        }

        return $this;
    } // setFieldId25()

    /**
     * Set the value of [field_id_19] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId19($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_19 !== $v) {
            $this->field_id_19 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_19] = true;
        }

        return $this;
    } // setFieldId19()

    /**
     * Set the value of [field_id_18] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId18($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_18 !== $v) {
            $this->field_id_18 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_18] = true;
        }

        return $this;
    } // setFieldId18()

    /**
     * Set the value of [field_id_17] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId17($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_17 !== $v) {
            $this->field_id_17 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_17] = true;
        }

        return $this;
    } // setFieldId17()

    /**
     * Set the value of [field_id_6] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId6($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_6 !== $v) {
            $this->field_id_6 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_6] = true;
        }

        return $this;
    } // setFieldId6()

    /**
     * Set the value of [field_id_5] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_5 !== $v) {
            $this->field_id_5 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_5] = true;
        }

        return $this;
    } // setFieldId5()

    /**
     * Set the value of [field_id_4] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId4($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_4 !== $v) {
            $this->field_id_4 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_4] = true;
        }

        return $this;
    } // setFieldId4()

    /**
     * Set the value of [field_id_2] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_2 !== $v) {
            $this->field_id_2 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_2] = true;
        }

        return $this;
    } // setFieldId2()

    /**
     * Set the value of [field_id_1] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setFieldId1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->field_id_1 !== $v) {
            $this->field_id_1 = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_FIELD_ID_1] = true;
        }

        return $this;
    } // setFieldId1()

    /**
     * Set the value of [author_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setAuthorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_id !== $v) {
            $this->author_id = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_AUTHOR_ID] = true;
        }

        return $this;
    } // setAuthorId()

    /**
     * Set the value of [entry_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setEntryDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entry_date !== $v) {
            $this->entry_date = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_ENTRY_DATE] = true;
        }

        return $this;
    } // setEntryDate()

    /**
     * Set the value of [edit_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setEditDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edit_date !== $v) {
            $this->edit_date = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_EDIT_DATE] = true;
        }

        return $this;
    } // setEditDate()

    /**
     * Set the value of [completed_by] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setCompletedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->completed_by !== $v) {
            $this->completed_by = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_COMPLETED_BY] = true;
        }

        return $this;
    } // setCompletedBy()

    /**
     * Set the value of [completed_date] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\FormEntries1 The current object (for fluent API support)
     */
    public function setCompletedDate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->completed_date !== $v) {
            $this->completed_date = $v;
            $this->modifiedColumns[FormEntries1TableMap::COL_COMPLETED_DATE] = true;
        }

        return $this;
    } // setCompletedDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FormEntries1TableMap::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FormEntries1TableMap::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FormEntries1TableMap::translateFieldName('FieldId29', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_29 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FormEntries1TableMap::translateFieldName('FieldId52', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_52 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FormEntries1TableMap::translateFieldName('FieldId54', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_54 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FormEntries1TableMap::translateFieldName('FieldId53', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_53 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FormEntries1TableMap::translateFieldName('FieldId55', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_55 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FormEntries1TableMap::translateFieldName('FieldId58', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_58 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FormEntries1TableMap::translateFieldName('FieldId57', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_57 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : FormEntries1TableMap::translateFieldName('FieldId56', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_56 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : FormEntries1TableMap::translateFieldName('FieldId51', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_51 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : FormEntries1TableMap::translateFieldName('FieldId50', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_50 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : FormEntries1TableMap::translateFieldName('FieldId49', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_49 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : FormEntries1TableMap::translateFieldName('FieldId48', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_48 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : FormEntries1TableMap::translateFieldName('FieldId47', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_47 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : FormEntries1TableMap::translateFieldName('FieldId46', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_46 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : FormEntries1TableMap::translateFieldName('FieldId45', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_45 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : FormEntries1TableMap::translateFieldName('FieldId44', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_44 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : FormEntries1TableMap::translateFieldName('FieldId43', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_43 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : FormEntries1TableMap::translateFieldName('FieldId42', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_42 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : FormEntries1TableMap::translateFieldName('FieldId41', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_41 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : FormEntries1TableMap::translateFieldName('FieldId40', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_40 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : FormEntries1TableMap::translateFieldName('FieldId37', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_37 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : FormEntries1TableMap::translateFieldName('FieldId35', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_35 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : FormEntries1TableMap::translateFieldName('FieldId33', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_33 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : FormEntries1TableMap::translateFieldName('FieldId32', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_32 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : FormEntries1TableMap::translateFieldName('FieldId31', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_31 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : FormEntries1TableMap::translateFieldName('FieldId30', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_30 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : FormEntries1TableMap::translateFieldName('FieldId28', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_28 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : FormEntries1TableMap::translateFieldName('FieldId26', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_26 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : FormEntries1TableMap::translateFieldName('FieldId25', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_25 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : FormEntries1TableMap::translateFieldName('FieldId19', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_19 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : FormEntries1TableMap::translateFieldName('FieldId18', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_18 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : FormEntries1TableMap::translateFieldName('FieldId17', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_17 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : FormEntries1TableMap::translateFieldName('FieldId6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_6 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : FormEntries1TableMap::translateFieldName('FieldId5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : FormEntries1TableMap::translateFieldName('FieldId4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_4 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : FormEntries1TableMap::translateFieldName('FieldId2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : FormEntries1TableMap::translateFieldName('FieldId1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->field_id_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : FormEntries1TableMap::translateFieldName('AuthorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : FormEntries1TableMap::translateFieldName('EntryDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entry_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : FormEntries1TableMap::translateFieldName('EditDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edit_date = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : FormEntries1TableMap::translateFieldName('CompletedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->completed_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : FormEntries1TableMap::translateFieldName('CompletedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->completed_date = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 44; // 44 = FormEntries1TableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\FormEntries1'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFormEntries1Query::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see FormEntries1::setDeleted()
     * @see FormEntries1::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFormEntries1Query::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
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
                FormEntries1TableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[FormEntries1TableMap::COL_ENTRY_ID] = true;
        if (null !== $this->entry_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FormEntries1TableMap::COL_ENTRY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FormEntries1TableMap::COL_ENTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'entry_id';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_BOOKING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'booking_id';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_29)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_29';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_52)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_52';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_54)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_54';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_53)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_53';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_55)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_55';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_58)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_58';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_57)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_57';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_56)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_56';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_51)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_51';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_50)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_50';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_49)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_49';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_48)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_48';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_47)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_47';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_46)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_46';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_45)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_45';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_44)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_44';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_43)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_43';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_42)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_42';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_41)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_41';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_40)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_40';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_37)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_37';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_35)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_35';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_33)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_33';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_32)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_32';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_31)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_31';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_30)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_30';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_28)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_28';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_26)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_26';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_25)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_25';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_19)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_19';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_18)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_18';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_17)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_17';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_6)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_6';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_5)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_5';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_4)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_4';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_2)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_2';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_1)) {
            $modifiedColumns[':p' . $index++]  = 'field_id_1';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_AUTHOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'author_id';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_ENTRY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'entry_date';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_EDIT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'edit_date';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_COMPLETED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'completed_by';
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_COMPLETED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'completed_date';
        }

        $sql = sprintf(
            'INSERT INTO tf_form_entries_1 (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'entry_id':
                        $stmt->bindValue($identifier, $this->entry_id, PDO::PARAM_INT);
                        break;
                    case 'booking_id':
                        $stmt->bindValue($identifier, $this->booking_id, PDO::PARAM_INT);
                        break;
                    case 'field_id_29':
                        $stmt->bindValue($identifier, $this->field_id_29, PDO::PARAM_STR);
                        break;
                    case 'field_id_52':
                        $stmt->bindValue($identifier, $this->field_id_52, PDO::PARAM_STR);
                        break;
                    case 'field_id_54':
                        $stmt->bindValue($identifier, $this->field_id_54, PDO::PARAM_STR);
                        break;
                    case 'field_id_53':
                        $stmt->bindValue($identifier, $this->field_id_53, PDO::PARAM_STR);
                        break;
                    case 'field_id_55':
                        $stmt->bindValue($identifier, $this->field_id_55, PDO::PARAM_STR);
                        break;
                    case 'field_id_58':
                        $stmt->bindValue($identifier, $this->field_id_58, PDO::PARAM_STR);
                        break;
                    case 'field_id_57':
                        $stmt->bindValue($identifier, $this->field_id_57, PDO::PARAM_STR);
                        break;
                    case 'field_id_56':
                        $stmt->bindValue($identifier, $this->field_id_56, PDO::PARAM_STR);
                        break;
                    case 'field_id_51':
                        $stmt->bindValue($identifier, $this->field_id_51, PDO::PARAM_STR);
                        break;
                    case 'field_id_50':
                        $stmt->bindValue($identifier, $this->field_id_50, PDO::PARAM_STR);
                        break;
                    case 'field_id_49':
                        $stmt->bindValue($identifier, $this->field_id_49, PDO::PARAM_STR);
                        break;
                    case 'field_id_48':
                        $stmt->bindValue($identifier, $this->field_id_48, PDO::PARAM_STR);
                        break;
                    case 'field_id_47':
                        $stmt->bindValue($identifier, $this->field_id_47, PDO::PARAM_STR);
                        break;
                    case 'field_id_46':
                        $stmt->bindValue($identifier, $this->field_id_46, PDO::PARAM_STR);
                        break;
                    case 'field_id_45':
                        $stmt->bindValue($identifier, $this->field_id_45, PDO::PARAM_STR);
                        break;
                    case 'field_id_44':
                        $stmt->bindValue($identifier, $this->field_id_44, PDO::PARAM_STR);
                        break;
                    case 'field_id_43':
                        $stmt->bindValue($identifier, $this->field_id_43, PDO::PARAM_STR);
                        break;
                    case 'field_id_42':
                        $stmt->bindValue($identifier, $this->field_id_42, PDO::PARAM_STR);
                        break;
                    case 'field_id_41':
                        $stmt->bindValue($identifier, $this->field_id_41, PDO::PARAM_STR);
                        break;
                    case 'field_id_40':
                        $stmt->bindValue($identifier, $this->field_id_40, PDO::PARAM_STR);
                        break;
                    case 'field_id_37':
                        $stmt->bindValue($identifier, $this->field_id_37, PDO::PARAM_STR);
                        break;
                    case 'field_id_35':
                        $stmt->bindValue($identifier, $this->field_id_35, PDO::PARAM_STR);
                        break;
                    case 'field_id_33':
                        $stmt->bindValue($identifier, $this->field_id_33, PDO::PARAM_STR);
                        break;
                    case 'field_id_32':
                        $stmt->bindValue($identifier, $this->field_id_32, PDO::PARAM_STR);
                        break;
                    case 'field_id_31':
                        $stmt->bindValue($identifier, $this->field_id_31, PDO::PARAM_STR);
                        break;
                    case 'field_id_30':
                        $stmt->bindValue($identifier, $this->field_id_30, PDO::PARAM_STR);
                        break;
                    case 'field_id_28':
                        $stmt->bindValue($identifier, $this->field_id_28, PDO::PARAM_STR);
                        break;
                    case 'field_id_26':
                        $stmt->bindValue($identifier, $this->field_id_26, PDO::PARAM_STR);
                        break;
                    case 'field_id_25':
                        $stmt->bindValue($identifier, $this->field_id_25, PDO::PARAM_STR);
                        break;
                    case 'field_id_19':
                        $stmt->bindValue($identifier, $this->field_id_19, PDO::PARAM_STR);
                        break;
                    case 'field_id_18':
                        $stmt->bindValue($identifier, $this->field_id_18, PDO::PARAM_STR);
                        break;
                    case 'field_id_17':
                        $stmt->bindValue($identifier, $this->field_id_17, PDO::PARAM_STR);
                        break;
                    case 'field_id_6':
                        $stmt->bindValue($identifier, $this->field_id_6, PDO::PARAM_STR);
                        break;
                    case 'field_id_5':
                        $stmt->bindValue($identifier, $this->field_id_5, PDO::PARAM_STR);
                        break;
                    case 'field_id_4':
                        $stmt->bindValue($identifier, $this->field_id_4, PDO::PARAM_STR);
                        break;
                    case 'field_id_2':
                        $stmt->bindValue($identifier, $this->field_id_2, PDO::PARAM_STR);
                        break;
                    case 'field_id_1':
                        $stmt->bindValue($identifier, $this->field_id_1, PDO::PARAM_STR);
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
                    case 'completed_by':
                        $stmt->bindValue($identifier, $this->completed_by, PDO::PARAM_INT);
                        break;
                    case 'completed_date':
                        $stmt->bindValue($identifier, $this->completed_date, PDO::PARAM_INT);
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
        $this->setEntryId($pk);

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
        $pos = FormEntries1TableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEntryId();
                break;
            case 1:
                return $this->getBookingId();
                break;
            case 2:
                return $this->getFieldId29();
                break;
            case 3:
                return $this->getFieldId52();
                break;
            case 4:
                return $this->getFieldId54();
                break;
            case 5:
                return $this->getFieldId53();
                break;
            case 6:
                return $this->getFieldId55();
                break;
            case 7:
                return $this->getFieldId58();
                break;
            case 8:
                return $this->getFieldId57();
                break;
            case 9:
                return $this->getFieldId56();
                break;
            case 10:
                return $this->getFieldId51();
                break;
            case 11:
                return $this->getFieldId50();
                break;
            case 12:
                return $this->getFieldId49();
                break;
            case 13:
                return $this->getFieldId48();
                break;
            case 14:
                return $this->getFieldId47();
                break;
            case 15:
                return $this->getFieldId46();
                break;
            case 16:
                return $this->getFieldId45();
                break;
            case 17:
                return $this->getFieldId44();
                break;
            case 18:
                return $this->getFieldId43();
                break;
            case 19:
                return $this->getFieldId42();
                break;
            case 20:
                return $this->getFieldId41();
                break;
            case 21:
                return $this->getFieldId40();
                break;
            case 22:
                return $this->getFieldId37();
                break;
            case 23:
                return $this->getFieldId35();
                break;
            case 24:
                return $this->getFieldId33();
                break;
            case 25:
                return $this->getFieldId32();
                break;
            case 26:
                return $this->getFieldId31();
                break;
            case 27:
                return $this->getFieldId30();
                break;
            case 28:
                return $this->getFieldId28();
                break;
            case 29:
                return $this->getFieldId26();
                break;
            case 30:
                return $this->getFieldId25();
                break;
            case 31:
                return $this->getFieldId19();
                break;
            case 32:
                return $this->getFieldId18();
                break;
            case 33:
                return $this->getFieldId17();
                break;
            case 34:
                return $this->getFieldId6();
                break;
            case 35:
                return $this->getFieldId5();
                break;
            case 36:
                return $this->getFieldId4();
                break;
            case 37:
                return $this->getFieldId2();
                break;
            case 38:
                return $this->getFieldId1();
                break;
            case 39:
                return $this->getAuthorId();
                break;
            case 40:
                return $this->getEntryDate();
                break;
            case 41:
                return $this->getEditDate();
                break;
            case 42:
                return $this->getCompletedBy();
                break;
            case 43:
                return $this->getCompletedDate();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['FormEntries1'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['FormEntries1'][$this->hashCode()] = true;
        $keys = FormEntries1TableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEntryId(),
            $keys[1] => $this->getBookingId(),
            $keys[2] => $this->getFieldId29(),
            $keys[3] => $this->getFieldId52(),
            $keys[4] => $this->getFieldId54(),
            $keys[5] => $this->getFieldId53(),
            $keys[6] => $this->getFieldId55(),
            $keys[7] => $this->getFieldId58(),
            $keys[8] => $this->getFieldId57(),
            $keys[9] => $this->getFieldId56(),
            $keys[10] => $this->getFieldId51(),
            $keys[11] => $this->getFieldId50(),
            $keys[12] => $this->getFieldId49(),
            $keys[13] => $this->getFieldId48(),
            $keys[14] => $this->getFieldId47(),
            $keys[15] => $this->getFieldId46(),
            $keys[16] => $this->getFieldId45(),
            $keys[17] => $this->getFieldId44(),
            $keys[18] => $this->getFieldId43(),
            $keys[19] => $this->getFieldId42(),
            $keys[20] => $this->getFieldId41(),
            $keys[21] => $this->getFieldId40(),
            $keys[22] => $this->getFieldId37(),
            $keys[23] => $this->getFieldId35(),
            $keys[24] => $this->getFieldId33(),
            $keys[25] => $this->getFieldId32(),
            $keys[26] => $this->getFieldId31(),
            $keys[27] => $this->getFieldId30(),
            $keys[28] => $this->getFieldId28(),
            $keys[29] => $this->getFieldId26(),
            $keys[30] => $this->getFieldId25(),
            $keys[31] => $this->getFieldId19(),
            $keys[32] => $this->getFieldId18(),
            $keys[33] => $this->getFieldId17(),
            $keys[34] => $this->getFieldId6(),
            $keys[35] => $this->getFieldId5(),
            $keys[36] => $this->getFieldId4(),
            $keys[37] => $this->getFieldId2(),
            $keys[38] => $this->getFieldId1(),
            $keys[39] => $this->getAuthorId(),
            $keys[40] => $this->getEntryDate(),
            $keys[41] => $this->getEditDate(),
            $keys[42] => $this->getCompletedBy(),
            $keys[43] => $this->getCompletedDate(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\TheFarm\Models\FormEntries1
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FormEntries1TableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\FormEntries1
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEntryId($value);
                break;
            case 1:
                $this->setBookingId($value);
                break;
            case 2:
                $this->setFieldId29($value);
                break;
            case 3:
                $this->setFieldId52($value);
                break;
            case 4:
                $this->setFieldId54($value);
                break;
            case 5:
                $this->setFieldId53($value);
                break;
            case 6:
                $this->setFieldId55($value);
                break;
            case 7:
                $this->setFieldId58($value);
                break;
            case 8:
                $this->setFieldId57($value);
                break;
            case 9:
                $this->setFieldId56($value);
                break;
            case 10:
                $this->setFieldId51($value);
                break;
            case 11:
                $this->setFieldId50($value);
                break;
            case 12:
                $this->setFieldId49($value);
                break;
            case 13:
                $this->setFieldId48($value);
                break;
            case 14:
                $this->setFieldId47($value);
                break;
            case 15:
                $this->setFieldId46($value);
                break;
            case 16:
                $this->setFieldId45($value);
                break;
            case 17:
                $this->setFieldId44($value);
                break;
            case 18:
                $this->setFieldId43($value);
                break;
            case 19:
                $this->setFieldId42($value);
                break;
            case 20:
                $this->setFieldId41($value);
                break;
            case 21:
                $this->setFieldId40($value);
                break;
            case 22:
                $this->setFieldId37($value);
                break;
            case 23:
                $this->setFieldId35($value);
                break;
            case 24:
                $this->setFieldId33($value);
                break;
            case 25:
                $this->setFieldId32($value);
                break;
            case 26:
                $this->setFieldId31($value);
                break;
            case 27:
                $this->setFieldId30($value);
                break;
            case 28:
                $this->setFieldId28($value);
                break;
            case 29:
                $this->setFieldId26($value);
                break;
            case 30:
                $this->setFieldId25($value);
                break;
            case 31:
                $this->setFieldId19($value);
                break;
            case 32:
                $this->setFieldId18($value);
                break;
            case 33:
                $this->setFieldId17($value);
                break;
            case 34:
                $this->setFieldId6($value);
                break;
            case 35:
                $this->setFieldId5($value);
                break;
            case 36:
                $this->setFieldId4($value);
                break;
            case 37:
                $this->setFieldId2($value);
                break;
            case 38:
                $this->setFieldId1($value);
                break;
            case 39:
                $this->setAuthorId($value);
                break;
            case 40:
                $this->setEntryDate($value);
                break;
            case 41:
                $this->setEditDate($value);
                break;
            case 42:
                $this->setCompletedBy($value);
                break;
            case 43:
                $this->setCompletedDate($value);
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
        $keys = FormEntries1TableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEntryId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBookingId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFieldId29($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFieldId52($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFieldId54($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFieldId53($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFieldId55($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFieldId58($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFieldId57($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFieldId56($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFieldId51($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFieldId50($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setFieldId49($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFieldId48($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setFieldId47($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setFieldId46($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setFieldId45($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setFieldId44($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setFieldId43($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setFieldId42($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setFieldId41($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setFieldId40($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setFieldId37($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setFieldId35($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setFieldId33($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setFieldId32($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setFieldId31($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setFieldId30($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setFieldId28($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setFieldId26($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setFieldId25($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setFieldId19($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setFieldId18($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setFieldId17($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setFieldId6($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setFieldId5($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setFieldId4($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setFieldId2($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setFieldId1($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setAuthorId($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setEntryDate($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setEditDate($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setCompletedBy($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setCompletedDate($arr[$keys[43]]);
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
     * @return $this|\TheFarm\Models\FormEntries1 The current object, for fluid interface
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
        $criteria = new Criteria(FormEntries1TableMap::DATABASE_NAME);

        if ($this->isColumnModified(FormEntries1TableMap::COL_ENTRY_ID)) {
            $criteria->add(FormEntries1TableMap::COL_ENTRY_ID, $this->entry_id);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_BOOKING_ID)) {
            $criteria->add(FormEntries1TableMap::COL_BOOKING_ID, $this->booking_id);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_29)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_29, $this->field_id_29);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_52)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_52, $this->field_id_52);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_54)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_54, $this->field_id_54);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_53)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_53, $this->field_id_53);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_55)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_55, $this->field_id_55);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_58)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_58, $this->field_id_58);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_57)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_57, $this->field_id_57);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_56)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_56, $this->field_id_56);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_51)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_51, $this->field_id_51);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_50)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_50, $this->field_id_50);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_49)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_49, $this->field_id_49);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_48)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_48, $this->field_id_48);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_47)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_47, $this->field_id_47);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_46)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_46, $this->field_id_46);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_45)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_45, $this->field_id_45);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_44)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_44, $this->field_id_44);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_43)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_43, $this->field_id_43);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_42)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_42, $this->field_id_42);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_41)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_41, $this->field_id_41);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_40)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_40, $this->field_id_40);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_37)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_37, $this->field_id_37);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_35)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_35, $this->field_id_35);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_33)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_33, $this->field_id_33);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_32)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_32, $this->field_id_32);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_31)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_31, $this->field_id_31);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_30)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_30, $this->field_id_30);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_28)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_28, $this->field_id_28);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_26)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_26, $this->field_id_26);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_25)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_25, $this->field_id_25);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_19)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_19, $this->field_id_19);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_18)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_18, $this->field_id_18);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_17)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_17, $this->field_id_17);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_6)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_6, $this->field_id_6);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_5)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_5, $this->field_id_5);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_4)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_4, $this->field_id_4);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_2)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_2, $this->field_id_2);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_FIELD_ID_1)) {
            $criteria->add(FormEntries1TableMap::COL_FIELD_ID_1, $this->field_id_1);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_AUTHOR_ID)) {
            $criteria->add(FormEntries1TableMap::COL_AUTHOR_ID, $this->author_id);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_ENTRY_DATE)) {
            $criteria->add(FormEntries1TableMap::COL_ENTRY_DATE, $this->entry_date);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_EDIT_DATE)) {
            $criteria->add(FormEntries1TableMap::COL_EDIT_DATE, $this->edit_date);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_COMPLETED_BY)) {
            $criteria->add(FormEntries1TableMap::COL_COMPLETED_BY, $this->completed_by);
        }
        if ($this->isColumnModified(FormEntries1TableMap::COL_COMPLETED_DATE)) {
            $criteria->add(FormEntries1TableMap::COL_COMPLETED_DATE, $this->completed_date);
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
        $criteria = ChildFormEntries1Query::create();
        $criteria->add(FormEntries1TableMap::COL_ENTRY_ID, $this->entry_id);

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
        $validPk = null !== $this->getEntryId();

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
        return $this->getEntryId();
    }

    /**
     * Generic method to set the primary key (entry_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setEntryId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getEntryId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\FormEntries1 (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBookingId($this->getBookingId());
        $copyObj->setFieldId29($this->getFieldId29());
        $copyObj->setFieldId52($this->getFieldId52());
        $copyObj->setFieldId54($this->getFieldId54());
        $copyObj->setFieldId53($this->getFieldId53());
        $copyObj->setFieldId55($this->getFieldId55());
        $copyObj->setFieldId58($this->getFieldId58());
        $copyObj->setFieldId57($this->getFieldId57());
        $copyObj->setFieldId56($this->getFieldId56());
        $copyObj->setFieldId51($this->getFieldId51());
        $copyObj->setFieldId50($this->getFieldId50());
        $copyObj->setFieldId49($this->getFieldId49());
        $copyObj->setFieldId48($this->getFieldId48());
        $copyObj->setFieldId47($this->getFieldId47());
        $copyObj->setFieldId46($this->getFieldId46());
        $copyObj->setFieldId45($this->getFieldId45());
        $copyObj->setFieldId44($this->getFieldId44());
        $copyObj->setFieldId43($this->getFieldId43());
        $copyObj->setFieldId42($this->getFieldId42());
        $copyObj->setFieldId41($this->getFieldId41());
        $copyObj->setFieldId40($this->getFieldId40());
        $copyObj->setFieldId37($this->getFieldId37());
        $copyObj->setFieldId35($this->getFieldId35());
        $copyObj->setFieldId33($this->getFieldId33());
        $copyObj->setFieldId32($this->getFieldId32());
        $copyObj->setFieldId31($this->getFieldId31());
        $copyObj->setFieldId30($this->getFieldId30());
        $copyObj->setFieldId28($this->getFieldId28());
        $copyObj->setFieldId26($this->getFieldId26());
        $copyObj->setFieldId25($this->getFieldId25());
        $copyObj->setFieldId19($this->getFieldId19());
        $copyObj->setFieldId18($this->getFieldId18());
        $copyObj->setFieldId17($this->getFieldId17());
        $copyObj->setFieldId6($this->getFieldId6());
        $copyObj->setFieldId5($this->getFieldId5());
        $copyObj->setFieldId4($this->getFieldId4());
        $copyObj->setFieldId2($this->getFieldId2());
        $copyObj->setFieldId1($this->getFieldId1());
        $copyObj->setAuthorId($this->getAuthorId());
        $copyObj->setEntryDate($this->getEntryDate());
        $copyObj->setEditDate($this->getEditDate());
        $copyObj->setCompletedBy($this->getCompletedBy());
        $copyObj->setCompletedDate($this->getCompletedDate());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEntryId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\FormEntries1 Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->entry_id = null;
        $this->booking_id = null;
        $this->field_id_29 = null;
        $this->field_id_52 = null;
        $this->field_id_54 = null;
        $this->field_id_53 = null;
        $this->field_id_55 = null;
        $this->field_id_58 = null;
        $this->field_id_57 = null;
        $this->field_id_56 = null;
        $this->field_id_51 = null;
        $this->field_id_50 = null;
        $this->field_id_49 = null;
        $this->field_id_48 = null;
        $this->field_id_47 = null;
        $this->field_id_46 = null;
        $this->field_id_45 = null;
        $this->field_id_44 = null;
        $this->field_id_43 = null;
        $this->field_id_42 = null;
        $this->field_id_41 = null;
        $this->field_id_40 = null;
        $this->field_id_37 = null;
        $this->field_id_35 = null;
        $this->field_id_33 = null;
        $this->field_id_32 = null;
        $this->field_id_31 = null;
        $this->field_id_30 = null;
        $this->field_id_28 = null;
        $this->field_id_26 = null;
        $this->field_id_25 = null;
        $this->field_id_19 = null;
        $this->field_id_18 = null;
        $this->field_id_17 = null;
        $this->field_id_6 = null;
        $this->field_id_5 = null;
        $this->field_id_4 = null;
        $this->field_id_2 = null;
        $this->field_id_1 = null;
        $this->author_id = null;
        $this->entry_date = null;
        $this->edit_date = null;
        $this->completed_by = null;
        $this->completed_date = null;
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
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FormEntries1TableMap::DEFAULT_STRING_FORMAT);
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
