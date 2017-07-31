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
use TheFarm\Models\Files as ChildFiles;
use TheFarm\Models\FilesQuery as ChildFilesQuery;
use TheFarm\Models\ItemCategories as ChildItemCategories;
use TheFarm\Models\ItemCategoriesQuery as ChildItemCategoriesQuery;
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\PackageItems as ChildPackageItems;
use TheFarm\Models\PackageItemsQuery as ChildPackageItemsQuery;
use TheFarm\Models\Map\BookingEventsTableMap;
use TheFarm\Models\Map\BookingItemsTableMap;
use TheFarm\Models\Map\BookingsTableMap;
use TheFarm\Models\Map\ItemCategoriesTableMap;
use TheFarm\Models\Map\ItemsTableMap;
use TheFarm\Models\Map\PackageItemsTableMap;

/**
 * Base class that represents a row from the 'tf_items' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Items implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\ItemsTableMap';


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
     * The value for the item_id field.
     *
     * @var        int
     */
    protected $item_id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the duration field.
     *
     * @var        int
     */
    protected $duration;

    /**
     * The value for the amount field.
     *
     * @var        int
     */
    protected $amount;

    /**
     * The value for the uom field.
     *
     * @var        string
     */
    protected $uom;

    /**
     * The value for the abbr field.
     *
     * @var        string
     */
    protected $abbr;

    /**
     * The value for the max_provider field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $max_provider;

    /**
     * The value for the for_sale field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $for_sale;

    /**
     * The value for the item_image field.
     *
     * @var        int
     */
    protected $item_image;

    /**
     * The value for the bookable field.
     *
     * Note: this column has a database default value of: 'y'
     * @var        string
     */
    protected $bookable;

    /**
     * The value for the time_settings field.
     *
     * @var        string
     */
    protected $time_settings;

    /**
     * The value for the is_active field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $is_active;

    /**
     * The value for the item_icon field.
     *
     * @var        string
     */
    protected $item_icon;

    /**
     * @var        ChildFiles
     */
    protected $aFiles;

    /**
     * @var        ObjectCollection|ChildBookingEvents[] Collection to store aggregation of ChildBookingEvents objects.
     */
    protected $collBookingEventss;
    protected $collBookingEventssPartial;

    /**
     * @var        ObjectCollection|ChildBookingItems[] Collection to store aggregation of ChildBookingItems objects.
     */
    protected $collBookingItemss;
    protected $collBookingItemssPartial;

    /**
     * @var        ObjectCollection|ChildBookings[] Collection to store aggregation of ChildBookings objects.
     */
    protected $collBookingss;
    protected $collBookingssPartial;

    /**
     * @var        ObjectCollection|ChildItemCategories[] Collection to store aggregation of ChildItemCategories objects.
     */
    protected $collItemCategoriess;
    protected $collItemCategoriessPartial;

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
     * @var ObjectCollection|ChildBookingEvents[]
     */
    protected $bookingEventssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingItems[]
     */
    protected $bookingItemssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookings[]
     */
    protected $bookingssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemCategories[]
     */
    protected $itemCategoriessScheduledForDeletion = null;

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
        $this->max_provider = 1;
        $this->for_sale = 'y';
        $this->bookable = 'y';
        $this->is_active = 1;
    }

    /**
     * Initializes internal state of TheFarm\Models\Base\Items object.
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
     * Compares this with another <code>Items</code> instance.  If
     * <code>obj</code> is an instance of <code>Items</code>, delegates to
     * <code>equals(Items)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Items The current object, for fluid interface
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
     * Get the [item_id] column value.
     *
     * @return int
     */
    public function getItemId()
    {
        return $this->item_id;
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
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Get the [amount] column value.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the [uom] column value.
     *
     * @return string
     */
    public function getUom()
    {
        return $this->uom;
    }

    /**
     * Get the [abbr] column value.
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Get the [max_provider] column value.
     *
     * @return int
     */
    public function getMaxProvider()
    {
        return $this->max_provider;
    }

    /**
     * Get the [for_sale] column value.
     *
     * @return string
     */
    public function getForSale()
    {
        return $this->for_sale;
    }

    /**
     * Get the [item_image] column value.
     *
     * @return int
     */
    public function getItemImage()
    {
        return $this->item_image;
    }

    /**
     * Get the [bookable] column value.
     *
     * @return string
     */
    public function getBookable()
    {
        return $this->bookable;
    }

    /**
     * Get the [time_settings] column value.
     *
     * @return string
     */
    public function getTimeSettings()
    {
        return $this->time_settings;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [item_icon] column value.
     *
     * @return string
     */
    public function getItemIcon()
    {
        return $this->item_icon;
    }

    /**
     * Set the value of [item_id] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_id !== $v) {
            $this->item_id = $v;
            $this->modifiedColumns[ItemsTableMap::COL_ITEM_ID] = true;
        }

        return $this;
    } // setItemId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[ItemsTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ItemsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [duration] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->duration !== $v) {
            $this->duration = $v;
            $this->modifiedColumns[ItemsTableMap::COL_DURATION] = true;
        }

        return $this;
    } // setDuration()

    /**
     * Set the value of [amount] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[ItemsTableMap::COL_AMOUNT] = true;
        }

        return $this;
    } // setAmount()

    /**
     * Set the value of [uom] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setUom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uom !== $v) {
            $this->uom = $v;
            $this->modifiedColumns[ItemsTableMap::COL_UOM] = true;
        }

        return $this;
    } // setUom()

    /**
     * Set the value of [abbr] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setAbbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->abbr !== $v) {
            $this->abbr = $v;
            $this->modifiedColumns[ItemsTableMap::COL_ABBR] = true;
        }

        return $this;
    } // setAbbr()

    /**
     * Set the value of [max_provider] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setMaxProvider($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_provider !== $v) {
            $this->max_provider = $v;
            $this->modifiedColumns[ItemsTableMap::COL_MAX_PROVIDER] = true;
        }

        return $this;
    } // setMaxProvider()

    /**
     * Set the value of [for_sale] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setForSale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->for_sale !== $v) {
            $this->for_sale = $v;
            $this->modifiedColumns[ItemsTableMap::COL_FOR_SALE] = true;
        }

        return $this;
    } // setForSale()

    /**
     * Set the value of [item_image] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setItemImage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_image !== $v) {
            $this->item_image = $v;
            $this->modifiedColumns[ItemsTableMap::COL_ITEM_IMAGE] = true;
        }

        if ($this->aFiles !== null && $this->aFiles->getFileId() !== $v) {
            $this->aFiles = null;
        }

        return $this;
    } // setItemImage()

    /**
     * Set the value of [bookable] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setBookable($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bookable !== $v) {
            $this->bookable = $v;
            $this->modifiedColumns[ItemsTableMap::COL_BOOKABLE] = true;
        }

        return $this;
    } // setBookable()

    /**
     * Set the value of [time_settings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setTimeSettings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->time_settings !== $v) {
            $this->time_settings = $v;
            $this->modifiedColumns[ItemsTableMap::COL_TIME_SETTINGS] = true;
        }

        return $this;
    } // setTimeSettings()

    /**
     * Set the value of [is_active] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[ItemsTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    } // setIsActive()

    /**
     * Set the value of [item_icon] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function setItemIcon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->item_icon !== $v) {
            $this->item_icon = $v;
            $this->modifiedColumns[ItemsTableMap::COL_ITEM_ICON] = true;
        }

        return $this;
    } // setItemIcon()

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
            if ($this->max_provider !== 1) {
                return false;
            }

            if ($this->for_sale !== 'y') {
                return false;
            }

            if ($this->bookable !== 'y') {
                return false;
            }

            if ($this->is_active !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ItemsTableMap::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ItemsTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ItemsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ItemsTableMap::translateFieldName('Duration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ItemsTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ItemsTableMap::translateFieldName('Uom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ItemsTableMap::translateFieldName('Abbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->abbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ItemsTableMap::translateFieldName('MaxProvider', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_provider = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ItemsTableMap::translateFieldName('ForSale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->for_sale = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ItemsTableMap::translateFieldName('ItemImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_image = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ItemsTableMap::translateFieldName('Bookable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookable = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ItemsTableMap::translateFieldName('TimeSettings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->time_settings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ItemsTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ItemsTableMap::translateFieldName('ItemIcon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_icon = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = ItemsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Items'), 0, $e);
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
        if ($this->aFiles !== null && $this->item_image !== $this->aFiles->getFileId()) {
            $this->aFiles = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ItemsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildItemsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFiles = null;
            $this->collBookingEventss = null;

            $this->collBookingItemss = null;

            $this->collBookingss = null;

            $this->collItemCategoriess = null;

            $this->collPackageItemss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Items::setDeleted()
     * @see Items::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildItemsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsTableMap::DATABASE_NAME);
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
                ItemsTableMap::addInstanceToPool($this);
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

            if ($this->bookingItemssScheduledForDeletion !== null) {
                if (!$this->bookingItemssScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingItemsQuery::create()
                        ->filterByPrimaryKeys($this->bookingItemssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingItemssScheduledForDeletion = null;
                }
            }

            if ($this->collBookingItemss !== null) {
                foreach ($this->collBookingItemss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[ItemsTableMap::COL_ITEM_ID] = true;
        if (null !== $this->item_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ItemsTableMap::COL_ITEM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'item_id';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_DURATION)) {
            $modifiedColumns[':p' . $index++]  = 'duration';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_UOM)) {
            $modifiedColumns[':p' . $index++]  = 'uom';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ABBR)) {
            $modifiedColumns[':p' . $index++]  = 'abbr';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_MAX_PROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'max_provider';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_FOR_SALE)) {
            $modifiedColumns[':p' . $index++]  = 'for_sale';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'item_image';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_BOOKABLE)) {
            $modifiedColumns[':p' . $index++]  = 'bookable';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_TIME_SETTINGS)) {
            $modifiedColumns[':p' . $index++]  = 'time_settings';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_ICON)) {
            $modifiedColumns[':p' . $index++]  = 'item_icon';
        }

        $sql = sprintf(
            'INSERT INTO tf_items (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'item_id':
                        $stmt->bindValue($identifier, $this->item_id, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'duration':
                        $stmt->bindValue($identifier, $this->duration, PDO::PARAM_INT);
                        break;
                    case 'amount':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_INT);
                        break;
                    case 'uom':
                        $stmt->bindValue($identifier, $this->uom, PDO::PARAM_STR);
                        break;
                    case 'abbr':
                        $stmt->bindValue($identifier, $this->abbr, PDO::PARAM_STR);
                        break;
                    case 'max_provider':
                        $stmt->bindValue($identifier, $this->max_provider, PDO::PARAM_INT);
                        break;
                    case 'for_sale':
                        $stmt->bindValue($identifier, $this->for_sale, PDO::PARAM_STR);
                        break;
                    case 'item_image':
                        $stmt->bindValue($identifier, $this->item_image, PDO::PARAM_INT);
                        break;
                    case 'bookable':
                        $stmt->bindValue($identifier, $this->bookable, PDO::PARAM_STR);
                        break;
                    case 'time_settings':
                        $stmt->bindValue($identifier, $this->time_settings, PDO::PARAM_STR);
                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, $this->is_active, PDO::PARAM_INT);
                        break;
                    case 'item_icon':
                        $stmt->bindValue($identifier, $this->item_icon, PDO::PARAM_STR);
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
        $this->setItemId($pk);

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
        $pos = ItemsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getItemId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getDescription();
                break;
            case 3:
                return $this->getDuration();
                break;
            case 4:
                return $this->getAmount();
                break;
            case 5:
                return $this->getUom();
                break;
            case 6:
                return $this->getAbbr();
                break;
            case 7:
                return $this->getMaxProvider();
                break;
            case 8:
                return $this->getForSale();
                break;
            case 9:
                return $this->getItemImage();
                break;
            case 10:
                return $this->getBookable();
                break;
            case 11:
                return $this->getTimeSettings();
                break;
            case 12:
                return $this->getIsActive();
                break;
            case 13:
                return $this->getItemIcon();
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

        if (isset($alreadyDumpedObjects['Items'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Items'][$this->hashCode()] = true;
        $keys = ItemsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getItemId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getDuration(),
            $keys[4] => $this->getAmount(),
            $keys[5] => $this->getUom(),
            $keys[6] => $this->getAbbr(),
            $keys[7] => $this->getMaxProvider(),
            $keys[8] => $this->getForSale(),
            $keys[9] => $this->getItemImage(),
            $keys[10] => $this->getBookable(),
            $keys[11] => $this->getTimeSettings(),
            $keys[12] => $this->getIsActive(),
            $keys[13] => $this->getItemIcon(),
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
            if (null !== $this->collBookingItemss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingItemss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_itemss';
                        break;
                    default:
                        $key = 'BookingItemss';
                }

                $result[$key] = $this->collBookingItemss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
     * @return $this|\TheFarm\Models\Items
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ItemsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Items
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setItemId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
                $this->setDuration($value);
                break;
            case 4:
                $this->setAmount($value);
                break;
            case 5:
                $this->setUom($value);
                break;
            case 6:
                $this->setAbbr($value);
                break;
            case 7:
                $this->setMaxProvider($value);
                break;
            case 8:
                $this->setForSale($value);
                break;
            case 9:
                $this->setItemImage($value);
                break;
            case 10:
                $this->setBookable($value);
                break;
            case 11:
                $this->setTimeSettings($value);
                break;
            case 12:
                $this->setIsActive($value);
                break;
            case 13:
                $this->setItemIcon($value);
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
        $keys = ItemsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setItemId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDuration($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAmount($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUom($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAbbr($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMaxProvider($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setForSale($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setItemImage($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBookable($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTimeSettings($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsActive($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setItemIcon($arr[$keys[13]]);
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
     * @return $this|\TheFarm\Models\Items The current object, for fluid interface
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
        $criteria = new Criteria(ItemsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_ID)) {
            $criteria->add(ItemsTableMap::COL_ITEM_ID, $this->item_id);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_TITLE)) {
            $criteria->add(ItemsTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_DESCRIPTION)) {
            $criteria->add(ItemsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_DURATION)) {
            $criteria->add(ItemsTableMap::COL_DURATION, $this->duration);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_AMOUNT)) {
            $criteria->add(ItemsTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_UOM)) {
            $criteria->add(ItemsTableMap::COL_UOM, $this->uom);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ABBR)) {
            $criteria->add(ItemsTableMap::COL_ABBR, $this->abbr);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_MAX_PROVIDER)) {
            $criteria->add(ItemsTableMap::COL_MAX_PROVIDER, $this->max_provider);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_FOR_SALE)) {
            $criteria->add(ItemsTableMap::COL_FOR_SALE, $this->for_sale);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_IMAGE)) {
            $criteria->add(ItemsTableMap::COL_ITEM_IMAGE, $this->item_image);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_BOOKABLE)) {
            $criteria->add(ItemsTableMap::COL_BOOKABLE, $this->bookable);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_TIME_SETTINGS)) {
            $criteria->add(ItemsTableMap::COL_TIME_SETTINGS, $this->time_settings);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_IS_ACTIVE)) {
            $criteria->add(ItemsTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(ItemsTableMap::COL_ITEM_ICON)) {
            $criteria->add(ItemsTableMap::COL_ITEM_ICON, $this->item_icon);
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
        $criteria = ChildItemsQuery::create();
        $criteria->add(ItemsTableMap::COL_ITEM_ID, $this->item_id);

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
        $validPk = null !== $this->getItemId();

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
        return $this->getItemId();
    }

    /**
     * Generic method to set the primary key (item_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setItemId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getItemId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \TheFarm\Models\Items (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setDuration($this->getDuration());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setUom($this->getUom());
        $copyObj->setAbbr($this->getAbbr());
        $copyObj->setMaxProvider($this->getMaxProvider());
        $copyObj->setForSale($this->getForSale());
        $copyObj->setItemImage($this->getItemImage());
        $copyObj->setBookable($this->getBookable());
        $copyObj->setTimeSettings($this->getTimeSettings());
        $copyObj->setIsActive($this->getIsActive());
        $copyObj->setItemIcon($this->getItemIcon());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookingEventss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEvents($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingItemss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingItems($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookings($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemCategoriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemCategories($relObj->copy($deepCopy));
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
            $copyObj->setItemId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \TheFarm\Models\Items Clone of current object.
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
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFiles(ChildFiles $v = null)
    {
        if ($v === null) {
            $this->setItemImage(NULL);
        } else {
            $this->setItemImage($v->getFileId());
        }

        $this->aFiles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFiles object, it will not be re-added.
        if ($v !== null) {
            $v->addItems($this);
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
        if ($this->aFiles === null && ($this->item_image !== null)) {
            $this->aFiles = ChildFilesQuery::create()->findPk($this->item_image, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFiles->addItemss($this);
             */
        }

        return $this->aFiles;
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
        if ('BookingItems' == $relationName) {
            $this->initBookingItemss();
            return;
        }
        if ('Bookings' == $relationName) {
            $this->initBookingss();
            return;
        }
        if ('ItemCategories' == $relationName) {
            $this->initItemCategoriess();
            return;
        }
        if ('PackageItems' == $relationName) {
            $this->initPackageItemss();
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
     * If this ChildItems is new, it will return
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
                    ->filterByItems($this)
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
     * @return $this|ChildItems The current object (for fluent API support)
     */
    public function setBookingEventss(Collection $bookingEventss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvents[] $bookingEventssToDelete */
        $bookingEventssToDelete = $this->getBookingEventss(new Criteria(), $con)->diff($bookingEventss);


        $this->bookingEventssScheduledForDeletion = $bookingEventssToDelete;

        foreach ($bookingEventssToDelete as $bookingEventsRemoved) {
            $bookingEventsRemoved->setItems(null);
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
                ->filterByItems($this)
                ->count($con);
        }

        return count($this->collBookingEventss);
    }

    /**
     * Method called to associate a ChildBookingEvents object to this object
     * through the ChildBookingEvents foreign key attribute.
     *
     * @param  ChildBookingEvents $l ChildBookingEvents
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
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
        $bookingEvents->setItems($this);
    }

    /**
     * @param  ChildBookingEvents $bookingEvents The ChildBookingEvents object to remove.
     * @return $this|ChildItems The current object (for fluent API support)
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
            $bookingEvents->setItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByAuthorId', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinBookingItems(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('BookingItems', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByCalledBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByCancelledBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvents[] List of ChildBookingEvents objects
     */
    public function getBookingEventssJoinContactRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByDeletedBy', $joinBehavior);

        return $this->getBookingEventss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
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
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingEventss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
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
     * Clears out the collBookingItemss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingItemss()
     */
    public function clearBookingItemss()
    {
        $this->collBookingItemss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingItemss collection loaded partially.
     */
    public function resetPartialBookingItemss($v = true)
    {
        $this->collBookingItemssPartial = $v;
    }

    /**
     * Initializes the collBookingItemss collection.
     *
     * By default this just sets the collBookingItemss collection to an empty array (like clearcollBookingItemss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingItemss($overrideExisting = true)
    {
        if (null !== $this->collBookingItemss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingItemsTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingItemss = new $collectionClassName;
        $this->collBookingItemss->setModel('\TheFarm\Models\BookingItems');
    }

    /**
     * Gets an array of ChildBookingItems objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildItems is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingItems[] List of ChildBookingItems objects
     * @throws PropelException
     */
    public function getBookingItemss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemssPartial && !$this->isNew();
        if (null === $this->collBookingItemss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingItemss) {
                // return empty collection
                $this->initBookingItemss();
            } else {
                $collBookingItemss = ChildBookingItemsQuery::create(null, $criteria)
                    ->filterByItems($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingItemssPartial && count($collBookingItemss)) {
                        $this->initBookingItemss(false);

                        foreach ($collBookingItemss as $obj) {
                            if (false == $this->collBookingItemss->contains($obj)) {
                                $this->collBookingItemss->append($obj);
                            }
                        }

                        $this->collBookingItemssPartial = true;
                    }

                    return $collBookingItemss;
                }

                if ($partial && $this->collBookingItemss) {
                    foreach ($this->collBookingItemss as $obj) {
                        if ($obj->isNew()) {
                            $collBookingItemss[] = $obj;
                        }
                    }
                }

                $this->collBookingItemss = $collBookingItemss;
                $this->collBookingItemssPartial = false;
            }
        }

        return $this->collBookingItemss;
    }

    /**
     * Sets a collection of ChildBookingItems objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingItemss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildItems The current object (for fluent API support)
     */
    public function setBookingItemss(Collection $bookingItemss, ConnectionInterface $con = null)
    {
        /** @var ChildBookingItems[] $bookingItemssToDelete */
        $bookingItemssToDelete = $this->getBookingItemss(new Criteria(), $con)->diff($bookingItemss);


        $this->bookingItemssScheduledForDeletion = $bookingItemssToDelete;

        foreach ($bookingItemssToDelete as $bookingItemsRemoved) {
            $bookingItemsRemoved->setItems(null);
        }

        $this->collBookingItemss = null;
        foreach ($bookingItemss as $bookingItems) {
            $this->addBookingItems($bookingItems);
        }

        $this->collBookingItemss = $bookingItemss;
        $this->collBookingItemssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingItems objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingItems objects.
     * @throws PropelException
     */
    public function countBookingItemss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemssPartial && !$this->isNew();
        if (null === $this->collBookingItemss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingItemss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingItemss());
            }

            $query = ChildBookingItemsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByItems($this)
                ->count($con);
        }

        return count($this->collBookingItemss);
    }

    /**
     * Method called to associate a ChildBookingItems object to this object
     * through the ChildBookingItems foreign key attribute.
     *
     * @param  ChildBookingItems $l ChildBookingItems
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
     */
    public function addBookingItems(ChildBookingItems $l)
    {
        if ($this->collBookingItemss === null) {
            $this->initBookingItemss();
            $this->collBookingItemssPartial = true;
        }

        if (!$this->collBookingItemss->contains($l)) {
            $this->doAddBookingItems($l);

            if ($this->bookingItemssScheduledForDeletion and $this->bookingItemssScheduledForDeletion->contains($l)) {
                $this->bookingItemssScheduledForDeletion->remove($this->bookingItemssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingItems $bookingItems The ChildBookingItems object to add.
     */
    protected function doAddBookingItems(ChildBookingItems $bookingItems)
    {
        $this->collBookingItemss[]= $bookingItems;
        $bookingItems->setItems($this);
    }

    /**
     * @param  ChildBookingItems $bookingItems The ChildBookingItems object to remove.
     * @return $this|ChildItems The current object (for fluent API support)
     */
    public function removeBookingItems(ChildBookingItems $bookingItems)
    {
        if ($this->getBookingItemss()->contains($bookingItems)) {
            $pos = $this->collBookingItemss->search($bookingItems);
            $this->collBookingItemss->remove($pos);
            if (null === $this->bookingItemssScheduledForDeletion) {
                $this->bookingItemssScheduledForDeletion = clone $this->collBookingItemss;
                $this->bookingItemssScheduledForDeletion->clear();
            }
            $this->bookingItemssScheduledForDeletion[]= clone $bookingItems;
            $bookingItems->setItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related BookingItemss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingItems[] List of ChildBookingItems objects
     */
    public function getBookingItemssJoinBookings(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingItemsQuery::create(null, $criteria);
        $query->joinWith('Bookings', $joinBehavior);

        return $this->getBookingItemss($query, $con);
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
     * If this ChildItems is new, it will return
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
                    ->filterByItems($this)
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
     * @return $this|ChildItems The current object (for fluent API support)
     */
    public function setBookingss(Collection $bookingss, ConnectionInterface $con = null)
    {
        /** @var ChildBookings[] $bookingssToDelete */
        $bookingssToDelete = $this->getBookingss(new Criteria(), $con)->diff($bookingss);


        $this->bookingssScheduledForDeletion = $bookingssToDelete;

        foreach ($bookingssToDelete as $bookingsRemoved) {
            $bookingsRemoved->setItems(null);
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
                ->filterByItems($this)
                ->count($con);
        }

        return count($this->collBookingss);
    }

    /**
     * Method called to associate a ChildBookings object to this object
     * through the ChildBookings foreign key attribute.
     *
     * @param  ChildBookings $l ChildBookings
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
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
        $bookings->setItems($this);
    }

    /**
     * @param  ChildBookings $bookings The ChildBookings object to remove.
     * @return $this|ChildItems The current object (for fluent API support)
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
            $bookings->setItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinContactRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByAuthorId', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinContactRelatedByGuestId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByGuestId', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookings[] List of ChildBookings objects
     */
    public function getBookingssJoinPackages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingsQuery::create(null, $criteria);
        $query->joinWith('Packages', $joinBehavior);

        return $this->getBookingss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related Bookingss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
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
     * If this ChildItems is new, it will return
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
                    ->filterByItems($this)
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
     * @return $this|ChildItems The current object (for fluent API support)
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
            $itemCategoriesRemoved->setItems(null);
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
                ->filterByItems($this)
                ->count($con);
        }

        return count($this->collItemCategoriess);
    }

    /**
     * Method called to associate a ChildItemCategories object to this object
     * through the ChildItemCategories foreign key attribute.
     *
     * @param  ChildItemCategories $l ChildItemCategories
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
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
        $itemCategories->setItems($this);
    }

    /**
     * @param  ChildItemCategories $itemCategories The ChildItemCategories object to remove.
     * @return $this|ChildItems The current object (for fluent API support)
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
            $itemCategories->setItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related ItemCategoriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemCategories[] List of ChildItemCategories objects
     */
    public function getItemCategoriessJoinCategories(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemCategoriesQuery::create(null, $criteria);
        $query->joinWith('Categories', $joinBehavior);

        return $this->getItemCategoriess($query, $con);
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
     * If this ChildItems is new, it will return
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
                    ->filterByItems($this)
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
     * @return $this|ChildItems The current object (for fluent API support)
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
            $packageItemsRemoved->setItems(null);
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
                ->filterByItems($this)
                ->count($con);
        }

        return count($this->collPackageItemss);
    }

    /**
     * Method called to associate a ChildPackageItems object to this object
     * through the ChildPackageItems foreign key attribute.
     *
     * @param  ChildPackageItems $l ChildPackageItems
     * @return $this|\TheFarm\Models\Items The current object (for fluent API support)
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
        $packageItems->setItems($this);
    }

    /**
     * @param  ChildPackageItems $packageItems The ChildPackageItems object to remove.
     * @return $this|ChildItems The current object (for fluent API support)
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
            $packageItems->setItems(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Items is new, it will return
     * an empty collection; or if this Items has previously
     * been saved, it will retrieve related PackageItemss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Items.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPackageItems[] List of ChildPackageItems objects
     */
    public function getPackageItemssJoinPackages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPackageItemsQuery::create(null, $criteria);
        $query->joinWith('Packages', $joinBehavior);

        return $this->getPackageItemss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFiles) {
            $this->aFiles->removeItems($this);
        }
        $this->item_id = null;
        $this->title = null;
        $this->description = null;
        $this->duration = null;
        $this->amount = null;
        $this->uom = null;
        $this->abbr = null;
        $this->max_provider = null;
        $this->for_sale = null;
        $this->item_image = null;
        $this->bookable = null;
        $this->time_settings = null;
        $this->is_active = null;
        $this->item_icon = null;
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
            if ($this->collBookingItemss) {
                foreach ($this->collBookingItemss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingss) {
                foreach ($this->collBookingss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemCategoriess) {
                foreach ($this->collItemCategoriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPackageItemss) {
                foreach ($this->collPackageItemss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingEventss = null;
        $this->collBookingItemss = null;
        $this->collBookingss = null;
        $this->collItemCategoriess = null;
        $this->collPackageItemss = null;
        $this->aFiles = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ItemsTableMap::DEFAULT_STRING_FORMAT);
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
