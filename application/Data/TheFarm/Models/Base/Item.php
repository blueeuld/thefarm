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
use TheFarm\Models\Booking as ChildBooking;
use TheFarm\Models\BookingEvent as ChildBookingEvent;
use TheFarm\Models\BookingEventQuery as ChildBookingEventQuery;
use TheFarm\Models\BookingItem as ChildBookingItem;
use TheFarm\Models\BookingItemQuery as ChildBookingItemQuery;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\Files as ChildFiles;
use TheFarm\Models\FilesQuery as ChildFilesQuery;
use TheFarm\Models\Item as ChildItem;
use TheFarm\Models\ItemCategory as ChildItemCategory;
use TheFarm\Models\ItemCategoryQuery as ChildItemCategoryQuery;
use TheFarm\Models\ItemQuery as ChildItemQuery;
use TheFarm\Models\PackageItem as ChildPackageItem;
use TheFarm\Models\PackageItemQuery as ChildPackageItemQuery;
use TheFarm\Models\Map\BookingEventTableMap;
use TheFarm\Models\Map\BookingItemTableMap;
use TheFarm\Models\Map\BookingTableMap;
use TheFarm\Models\Map\ItemCategoryTableMap;
use TheFarm\Models\Map\ItemTableMap;
use TheFarm\Models\Map\PackageItemTableMap;

/**
 * Base class that represents a row from the 'tf_items' table.
 *
 *
 *
 * @package    propel.generator.TheFarm.Models.Base
 */
abstract class Item implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\TheFarm\\Models\\Map\\ItemTableMap';


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
     * @var        ObjectCollection|ChildBookingEvent[] Collection to store aggregation of ChildBookingEvent objects.
     */
    protected $collBookingEvents;
    protected $collBookingEventsPartial;

    /**
     * @var        ObjectCollection|ChildBookingItem[] Collection to store aggregation of ChildBookingItem objects.
     */
    protected $collBookingItems;
    protected $collBookingItemsPartial;

    /**
     * @var        ObjectCollection|ChildBooking[] Collection to store aggregation of ChildBooking objects.
     */
    protected $collBookings;
    protected $collBookingsPartial;

    /**
     * @var        ObjectCollection|ChildItemCategory[] Collection to store aggregation of ChildItemCategory objects.
     */
    protected $collItemCategories;
    protected $collItemCategoriesPartial;

    /**
     * @var        ObjectCollection|ChildPackageItem[] Collection to store aggregation of ChildPackageItem objects.
     */
    protected $collPackageItems;
    protected $collPackageItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingEvent[]
     */
    protected $bookingEventsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookingItem[]
     */
    protected $bookingItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooking[]
     */
    protected $bookingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildItemCategory[]
     */
    protected $itemCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPackageItem[]
     */
    protected $packageItemsScheduledForDeletion = null;

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
     * Initializes internal state of TheFarm\Models\Base\Item object.
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
     * Compares this with another <code>Item</code> instance.  If
     * <code>obj</code> is an instance of <code>Item</code>, delegates to
     * <code>equals(Item)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Item The current object, for fluid interface
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
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_id !== $v) {
            $this->item_id = $v;
            $this->modifiedColumns[ItemTableMap::COL_ITEM_ID] = true;
        }

        return $this;
    } // setItemId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[ItemTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ItemTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [duration] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->duration !== $v) {
            $this->duration = $v;
            $this->modifiedColumns[ItemTableMap::COL_DURATION] = true;
        }

        return $this;
    } // setDuration()

    /**
     * Set the value of [amount] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[ItemTableMap::COL_AMOUNT] = true;
        }

        return $this;
    } // setAmount()

    /**
     * Set the value of [uom] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setUom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uom !== $v) {
            $this->uom = $v;
            $this->modifiedColumns[ItemTableMap::COL_UOM] = true;
        }

        return $this;
    } // setUom()

    /**
     * Set the value of [abbr] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setAbbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->abbr !== $v) {
            $this->abbr = $v;
            $this->modifiedColumns[ItemTableMap::COL_ABBR] = true;
        }

        return $this;
    } // setAbbr()

    /**
     * Set the value of [max_provider] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setMaxProvider($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_provider !== $v) {
            $this->max_provider = $v;
            $this->modifiedColumns[ItemTableMap::COL_MAX_PROVIDER] = true;
        }

        return $this;
    } // setMaxProvider()

    /**
     * Set the value of [for_sale] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setForSale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->for_sale !== $v) {
            $this->for_sale = $v;
            $this->modifiedColumns[ItemTableMap::COL_FOR_SALE] = true;
        }

        return $this;
    } // setForSale()

    /**
     * Set the value of [item_image] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setItemImage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->item_image !== $v) {
            $this->item_image = $v;
            $this->modifiedColumns[ItemTableMap::COL_ITEM_IMAGE] = true;
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
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setBookable($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bookable !== $v) {
            $this->bookable = $v;
            $this->modifiedColumns[ItemTableMap::COL_BOOKABLE] = true;
        }

        return $this;
    } // setBookable()

    /**
     * Set the value of [time_settings] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setTimeSettings($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->time_settings !== $v) {
            $this->time_settings = $v;
            $this->modifiedColumns[ItemTableMap::COL_TIME_SETTINGS] = true;
        }

        return $this;
    } // setTimeSettings()

    /**
     * Set the value of [is_active] column.
     *
     * @param int $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[ItemTableMap::COL_IS_ACTIVE] = true;
        }

        return $this;
    } // setIsActive()

    /**
     * Set the value of [item_icon] column.
     *
     * @param string $v new value
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function setItemIcon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->item_icon !== $v) {
            $this->item_icon = $v;
            $this->modifiedColumns[ItemTableMap::COL_ITEM_ICON] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ItemTableMap::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ItemTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ItemTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ItemTableMap::translateFieldName('Duration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ItemTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ItemTableMap::translateFieldName('Uom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ItemTableMap::translateFieldName('Abbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->abbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ItemTableMap::translateFieldName('MaxProvider', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_provider = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ItemTableMap::translateFieldName('ForSale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->for_sale = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ItemTableMap::translateFieldName('ItemImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_image = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ItemTableMap::translateFieldName('Bookable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookable = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ItemTableMap::translateFieldName('TimeSettings', TableMap::TYPE_PHPNAME, $indexType)];
            $this->time_settings = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ItemTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ItemTableMap::translateFieldName('ItemIcon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->item_icon = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = ItemTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\TheFarm\\Models\\Item'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ItemTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildItemQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFiles = null;
            $this->collBookingEvents = null;

            $this->collBookingItems = null;

            $this->collBookings = null;

            $this->collItemCategories = null;

            $this->collPackageItems = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Item::setDeleted()
     * @see Item::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildItemQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
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
                ItemTableMap::addInstanceToPool($this);
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

            if ($this->bookingEventsScheduledForDeletion !== null) {
                if (!$this->bookingEventsScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingEventsScheduledForDeletion as $bookingEvent) {
                        // need to save related object because we set the relation to null
                        $bookingEvent->save($con);
                    }
                    $this->bookingEventsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingEvents !== null) {
                foreach ($this->collBookingEvents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingItemsScheduledForDeletion !== null) {
                if (!$this->bookingItemsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\BookingItemQuery::create()
                        ->filterByPrimaryKeys($this->bookingItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookingItemsScheduledForDeletion = null;
                }
            }

            if ($this->collBookingItems !== null) {
                foreach ($this->collBookingItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bookingsScheduledForDeletion !== null) {
                if (!$this->bookingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->bookingsScheduledForDeletion as $booking) {
                        // need to save related object because we set the relation to null
                        $booking->save($con);
                    }
                    $this->bookingsScheduledForDeletion = null;
                }
            }

            if ($this->collBookings !== null) {
                foreach ($this->collBookings as $referrerFK) {
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

            if ($this->packageItemsScheduledForDeletion !== null) {
                if (!$this->packageItemsScheduledForDeletion->isEmpty()) {
                    \TheFarm\Models\PackageItemQuery::create()
                        ->filterByPrimaryKeys($this->packageItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->packageItemsScheduledForDeletion = null;
                }
            }

            if ($this->collPackageItems !== null) {
                foreach ($this->collPackageItems as $referrerFK) {
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

        $this->modifiedColumns[ItemTableMap::COL_ITEM_ID] = true;
        if (null !== $this->item_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ItemTableMap::COL_ITEM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ItemTableMap::COL_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'item_id';
        }
        if ($this->isColumnModified(ItemTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(ItemTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ItemTableMap::COL_DURATION)) {
            $modifiedColumns[':p' . $index++]  = 'duration';
        }
        if ($this->isColumnModified(ItemTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(ItemTableMap::COL_UOM)) {
            $modifiedColumns[':p' . $index++]  = 'uom';
        }
        if ($this->isColumnModified(ItemTableMap::COL_ABBR)) {
            $modifiedColumns[':p' . $index++]  = 'abbr';
        }
        if ($this->isColumnModified(ItemTableMap::COL_MAX_PROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'max_provider';
        }
        if ($this->isColumnModified(ItemTableMap::COL_FOR_SALE)) {
            $modifiedColumns[':p' . $index++]  = 'for_sale';
        }
        if ($this->isColumnModified(ItemTableMap::COL_ITEM_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'item_image';
        }
        if ($this->isColumnModified(ItemTableMap::COL_BOOKABLE)) {
            $modifiedColumns[':p' . $index++]  = 'bookable';
        }
        if ($this->isColumnModified(ItemTableMap::COL_TIME_SETTINGS)) {
            $modifiedColumns[':p' . $index++]  = 'time_settings';
        }
        if ($this->isColumnModified(ItemTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }
        if ($this->isColumnModified(ItemTableMap::COL_ITEM_ICON)) {
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
        $pos = ItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

        if (isset($alreadyDumpedObjects['Item'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Item'][$this->hashCode()] = true;
        $keys = ItemTableMap::getFieldNames($keyType);
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
            if (null !== $this->collBookingEvents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingEvents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_eventss';
                        break;
                    default:
                        $key = 'BookingEvents';
                }

                $result[$key] = $this->collBookingEvents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookingItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookingItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_booking_itemss';
                        break;
                    default:
                        $key = 'BookingItems';
                }

                $result[$key] = $this->collBookingItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBookings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_bookingss';
                        break;
                    default:
                        $key = 'Bookings';
                }

                $result[$key] = $this->collBookings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPackageItems) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packageItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tf_package_itemss';
                        break;
                    default:
                        $key = 'PackageItems';
                }

                $result[$key] = $this->collPackageItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\TheFarm\Models\Item
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ItemTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\TheFarm\Models\Item
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
        $keys = ItemTableMap::getFieldNames($keyType);

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
     * @return $this|\TheFarm\Models\Item The current object, for fluid interface
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
        $criteria = new Criteria(ItemTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ItemTableMap::COL_ITEM_ID)) {
            $criteria->add(ItemTableMap::COL_ITEM_ID, $this->item_id);
        }
        if ($this->isColumnModified(ItemTableMap::COL_TITLE)) {
            $criteria->add(ItemTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(ItemTableMap::COL_DESCRIPTION)) {
            $criteria->add(ItemTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ItemTableMap::COL_DURATION)) {
            $criteria->add(ItemTableMap::COL_DURATION, $this->duration);
        }
        if ($this->isColumnModified(ItemTableMap::COL_AMOUNT)) {
            $criteria->add(ItemTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(ItemTableMap::COL_UOM)) {
            $criteria->add(ItemTableMap::COL_UOM, $this->uom);
        }
        if ($this->isColumnModified(ItemTableMap::COL_ABBR)) {
            $criteria->add(ItemTableMap::COL_ABBR, $this->abbr);
        }
        if ($this->isColumnModified(ItemTableMap::COL_MAX_PROVIDER)) {
            $criteria->add(ItemTableMap::COL_MAX_PROVIDER, $this->max_provider);
        }
        if ($this->isColumnModified(ItemTableMap::COL_FOR_SALE)) {
            $criteria->add(ItemTableMap::COL_FOR_SALE, $this->for_sale);
        }
        if ($this->isColumnModified(ItemTableMap::COL_ITEM_IMAGE)) {
            $criteria->add(ItemTableMap::COL_ITEM_IMAGE, $this->item_image);
        }
        if ($this->isColumnModified(ItemTableMap::COL_BOOKABLE)) {
            $criteria->add(ItemTableMap::COL_BOOKABLE, $this->bookable);
        }
        if ($this->isColumnModified(ItemTableMap::COL_TIME_SETTINGS)) {
            $criteria->add(ItemTableMap::COL_TIME_SETTINGS, $this->time_settings);
        }
        if ($this->isColumnModified(ItemTableMap::COL_IS_ACTIVE)) {
            $criteria->add(ItemTableMap::COL_IS_ACTIVE, $this->is_active);
        }
        if ($this->isColumnModified(ItemTableMap::COL_ITEM_ICON)) {
            $criteria->add(ItemTableMap::COL_ITEM_ICON, $this->item_icon);
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
        $criteria = ChildItemQuery::create();
        $criteria->add(ItemTableMap::COL_ITEM_ID, $this->item_id);

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
     * @param      object $copyObj An object of \TheFarm\Models\Item (or compatible) type.
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

            foreach ($this->getBookingEvents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingEvent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookingItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookingItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBookings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooking($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItemCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItemCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPackageItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPackageItem($relObj->copy($deepCopy));
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
     * @return \TheFarm\Models\Item Clone of current object.
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
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
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
            $v->addItem($this);
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
                $this->aFiles->addItems($this);
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
        if ('BookingEvent' == $relationName) {
            $this->initBookingEvents();
            return;
        }
        if ('BookingItem' == $relationName) {
            $this->initBookingItems();
            return;
        }
        if ('Booking' == $relationName) {
            $this->initBookings();
            return;
        }
        if ('ItemCategory' == $relationName) {
            $this->initItemCategories();
            return;
        }
        if ('PackageItem' == $relationName) {
            $this->initPackageItems();
            return;
        }
    }

    /**
     * Clears out the collBookingEvents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingEvents()
     */
    public function clearBookingEvents()
    {
        $this->collBookingEvents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingEvents collection loaded partially.
     */
    public function resetPartialBookingEvents($v = true)
    {
        $this->collBookingEventsPartial = $v;
    }

    /**
     * Initializes the collBookingEvents collection.
     *
     * By default this just sets the collBookingEvents collection to an empty array (like clearcollBookingEvents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingEvents($overrideExisting = true)
    {
        if (null !== $this->collBookingEvents && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingEventTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingEvents = new $collectionClassName;
        $this->collBookingEvents->setModel('\TheFarm\Models\BookingEvent');
    }

    /**
     * Gets an array of ChildBookingEvent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     * @throws PropelException
     */
    public function getBookingEvents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsPartial && !$this->isNew();
        if (null === $this->collBookingEvents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingEvents) {
                // return empty collection
                $this->initBookingEvents();
            } else {
                $collBookingEvents = ChildBookingEventQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingEventsPartial && count($collBookingEvents)) {
                        $this->initBookingEvents(false);

                        foreach ($collBookingEvents as $obj) {
                            if (false == $this->collBookingEvents->contains($obj)) {
                                $this->collBookingEvents->append($obj);
                            }
                        }

                        $this->collBookingEventsPartial = true;
                    }

                    return $collBookingEvents;
                }

                if ($partial && $this->collBookingEvents) {
                    foreach ($this->collBookingEvents as $obj) {
                        if ($obj->isNew()) {
                            $collBookingEvents[] = $obj;
                        }
                    }
                }

                $this->collBookingEvents = $collBookingEvents;
                $this->collBookingEventsPartial = false;
            }
        }

        return $this->collBookingEvents;
    }

    /**
     * Sets a collection of ChildBookingEvent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingEvents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function setBookingEvents(Collection $bookingEvents, ConnectionInterface $con = null)
    {
        /** @var ChildBookingEvent[] $bookingEventsToDelete */
        $bookingEventsToDelete = $this->getBookingEvents(new Criteria(), $con)->diff($bookingEvents);


        $this->bookingEventsScheduledForDeletion = $bookingEventsToDelete;

        foreach ($bookingEventsToDelete as $bookingEventRemoved) {
            $bookingEventRemoved->setItem(null);
        }

        $this->collBookingEvents = null;
        foreach ($bookingEvents as $bookingEvent) {
            $this->addBookingEvent($bookingEvent);
        }

        $this->collBookingEvents = $bookingEvents;
        $this->collBookingEventsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingEvent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingEvent objects.
     * @throws PropelException
     */
    public function countBookingEvents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingEventsPartial && !$this->isNew();
        if (null === $this->collBookingEvents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingEvents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingEvents());
            }

            $query = ChildBookingEventQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByItem($this)
                ->count($con);
        }

        return count($this->collBookingEvents);
    }

    /**
     * Method called to associate a ChildBookingEvent object to this object
     * through the ChildBookingEvent foreign key attribute.
     *
     * @param  ChildBookingEvent $l ChildBookingEvent
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function addBookingEvent(ChildBookingEvent $l)
    {
        if ($this->collBookingEvents === null) {
            $this->initBookingEvents();
            $this->collBookingEventsPartial = true;
        }

        if (!$this->collBookingEvents->contains($l)) {
            $this->doAddBookingEvent($l);

            if ($this->bookingEventsScheduledForDeletion and $this->bookingEventsScheduledForDeletion->contains($l)) {
                $this->bookingEventsScheduledForDeletion->remove($this->bookingEventsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingEvent $bookingEvent The ChildBookingEvent object to add.
     */
    protected function doAddBookingEvent(ChildBookingEvent $bookingEvent)
    {
        $this->collBookingEvents[]= $bookingEvent;
        $bookingEvent->setItem($this);
    }

    /**
     * @param  ChildBookingEvent $bookingEvent The ChildBookingEvent object to remove.
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function removeBookingEvent(ChildBookingEvent $bookingEvent)
    {
        if ($this->getBookingEvents()->contains($bookingEvent)) {
            $pos = $this->collBookingEvents->search($bookingEvent);
            $this->collBookingEvents->remove($pos);
            if (null === $this->bookingEventsScheduledForDeletion) {
                $this->bookingEventsScheduledForDeletion = clone $this->collBookingEvents;
                $this->bookingEventsScheduledForDeletion->clear();
            }
            $this->bookingEventsScheduledForDeletion[]= $bookingEvent;
            $bookingEvent->setItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinContactRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByAuthorId', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinBookingItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('BookingItem', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinContactRelatedByCalledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByCalledBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinContactRelatedByCancelledBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByCancelledBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinContactRelatedByDeletedBy(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByDeletedBy', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinFacility(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('Facility', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingEvents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingEvent[] List of ChildBookingEvent objects
     */
    public function getBookingEventsJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingEventQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookingEvents($query, $con);
    }

    /**
     * Clears out the collBookingItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookingItems()
     */
    public function clearBookingItems()
    {
        $this->collBookingItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookingItems collection loaded partially.
     */
    public function resetPartialBookingItems($v = true)
    {
        $this->collBookingItemsPartial = $v;
    }

    /**
     * Initializes the collBookingItems collection.
     *
     * By default this just sets the collBookingItems collection to an empty array (like clearcollBookingItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookingItems($overrideExisting = true)
    {
        if (null !== $this->collBookingItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingItemTableMap::getTableMap()->getCollectionClassName();

        $this->collBookingItems = new $collectionClassName;
        $this->collBookingItems->setModel('\TheFarm\Models\BookingItem');
    }

    /**
     * Gets an array of ChildBookingItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookingItem[] List of ChildBookingItem objects
     * @throws PropelException
     */
    public function getBookingItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemsPartial && !$this->isNew();
        if (null === $this->collBookingItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookingItems) {
                // return empty collection
                $this->initBookingItems();
            } else {
                $collBookingItems = ChildBookingItemQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingItemsPartial && count($collBookingItems)) {
                        $this->initBookingItems(false);

                        foreach ($collBookingItems as $obj) {
                            if (false == $this->collBookingItems->contains($obj)) {
                                $this->collBookingItems->append($obj);
                            }
                        }

                        $this->collBookingItemsPartial = true;
                    }

                    return $collBookingItems;
                }

                if ($partial && $this->collBookingItems) {
                    foreach ($this->collBookingItems as $obj) {
                        if ($obj->isNew()) {
                            $collBookingItems[] = $obj;
                        }
                    }
                }

                $this->collBookingItems = $collBookingItems;
                $this->collBookingItemsPartial = false;
            }
        }

        return $this->collBookingItems;
    }

    /**
     * Sets a collection of ChildBookingItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookingItems A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function setBookingItems(Collection $bookingItems, ConnectionInterface $con = null)
    {
        /** @var ChildBookingItem[] $bookingItemsToDelete */
        $bookingItemsToDelete = $this->getBookingItems(new Criteria(), $con)->diff($bookingItems);


        $this->bookingItemsScheduledForDeletion = $bookingItemsToDelete;

        foreach ($bookingItemsToDelete as $bookingItemRemoved) {
            $bookingItemRemoved->setItem(null);
        }

        $this->collBookingItems = null;
        foreach ($bookingItems as $bookingItem) {
            $this->addBookingItem($bookingItem);
        }

        $this->collBookingItems = $bookingItems;
        $this->collBookingItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BookingItem objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BookingItem objects.
     * @throws PropelException
     */
    public function countBookingItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingItemsPartial && !$this->isNew();
        if (null === $this->collBookingItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookingItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookingItems());
            }

            $query = ChildBookingItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByItem($this)
                ->count($con);
        }

        return count($this->collBookingItems);
    }

    /**
     * Method called to associate a ChildBookingItem object to this object
     * through the ChildBookingItem foreign key attribute.
     *
     * @param  ChildBookingItem $l ChildBookingItem
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function addBookingItem(ChildBookingItem $l)
    {
        if ($this->collBookingItems === null) {
            $this->initBookingItems();
            $this->collBookingItemsPartial = true;
        }

        if (!$this->collBookingItems->contains($l)) {
            $this->doAddBookingItem($l);

            if ($this->bookingItemsScheduledForDeletion and $this->bookingItemsScheduledForDeletion->contains($l)) {
                $this->bookingItemsScheduledForDeletion->remove($this->bookingItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookingItem $bookingItem The ChildBookingItem object to add.
     */
    protected function doAddBookingItem(ChildBookingItem $bookingItem)
    {
        $this->collBookingItems[]= $bookingItem;
        $bookingItem->setItem($this);
    }

    /**
     * @param  ChildBookingItem $bookingItem The ChildBookingItem object to remove.
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function removeBookingItem(ChildBookingItem $bookingItem)
    {
        if ($this->getBookingItems()->contains($bookingItem)) {
            $pos = $this->collBookingItems->search($bookingItem);
            $this->collBookingItems->remove($pos);
            if (null === $this->bookingItemsScheduledForDeletion) {
                $this->bookingItemsScheduledForDeletion = clone $this->collBookingItems;
                $this->bookingItemsScheduledForDeletion->clear();
            }
            $this->bookingItemsScheduledForDeletion[]= clone $bookingItem;
            $bookingItem->setItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related BookingItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookingItem[] List of ChildBookingItem objects
     */
    public function getBookingItemsJoinBooking(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingItemQuery::create(null, $criteria);
        $query->joinWith('Booking', $joinBehavior);

        return $this->getBookingItems($query, $con);
    }

    /**
     * Clears out the collBookings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookings()
     */
    public function clearBookings()
    {
        $this->collBookings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookings collection loaded partially.
     */
    public function resetPartialBookings($v = true)
    {
        $this->collBookingsPartial = $v;
    }

    /**
     * Initializes the collBookings collection.
     *
     * By default this just sets the collBookings collection to an empty array (like clearcollBookings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookings($overrideExisting = true)
    {
        if (null !== $this->collBookings && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookingTableMap::getTableMap()->getCollectionClassName();

        $this->collBookings = new $collectionClassName;
        $this->collBookings->setModel('\TheFarm\Models\Booking');
    }

    /**
     * Gets an array of ChildBooking objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     * @throws PropelException
     */
    public function getBookings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsPartial && !$this->isNew();
        if (null === $this->collBookings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookings) {
                // return empty collection
                $this->initBookings();
            } else {
                $collBookings = ChildBookingQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookingsPartial && count($collBookings)) {
                        $this->initBookings(false);

                        foreach ($collBookings as $obj) {
                            if (false == $this->collBookings->contains($obj)) {
                                $this->collBookings->append($obj);
                            }
                        }

                        $this->collBookingsPartial = true;
                    }

                    return $collBookings;
                }

                if ($partial && $this->collBookings) {
                    foreach ($this->collBookings as $obj) {
                        if ($obj->isNew()) {
                            $collBookings[] = $obj;
                        }
                    }
                }

                $this->collBookings = $collBookings;
                $this->collBookingsPartial = false;
            }
        }

        return $this->collBookings;
    }

    /**
     * Sets a collection of ChildBooking objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function setBookings(Collection $bookings, ConnectionInterface $con = null)
    {
        /** @var ChildBooking[] $bookingsToDelete */
        $bookingsToDelete = $this->getBookings(new Criteria(), $con)->diff($bookings);


        $this->bookingsScheduledForDeletion = $bookingsToDelete;

        foreach ($bookingsToDelete as $bookingRemoved) {
            $bookingRemoved->setItem(null);
        }

        $this->collBookings = null;
        foreach ($bookings as $booking) {
            $this->addBooking($booking);
        }

        $this->collBookings = $bookings;
        $this->collBookingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Booking objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Booking objects.
     * @throws PropelException
     */
    public function countBookings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookingsPartial && !$this->isNew();
        if (null === $this->collBookings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookings());
            }

            $query = ChildBookingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByItem($this)
                ->count($con);
        }

        return count($this->collBookings);
    }

    /**
     * Method called to associate a ChildBooking object to this object
     * through the ChildBooking foreign key attribute.
     *
     * @param  ChildBooking $l ChildBooking
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function addBooking(ChildBooking $l)
    {
        if ($this->collBookings === null) {
            $this->initBookings();
            $this->collBookingsPartial = true;
        }

        if (!$this->collBookings->contains($l)) {
            $this->doAddBooking($l);

            if ($this->bookingsScheduledForDeletion and $this->bookingsScheduledForDeletion->contains($l)) {
                $this->bookingsScheduledForDeletion->remove($this->bookingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooking $booking The ChildBooking object to add.
     */
    protected function doAddBooking(ChildBooking $booking)
    {
        $this->collBookings[]= $booking;
        $booking->setItem($this);
    }

    /**
     * @param  ChildBooking $booking The ChildBooking object to remove.
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function removeBooking(ChildBooking $booking)
    {
        if ($this->getBookings()->contains($booking)) {
            $pos = $this->collBookings->search($booking);
            $this->collBookings->remove($pos);
            if (null === $this->bookingsScheduledForDeletion) {
                $this->bookingsScheduledForDeletion = clone $this->collBookings;
                $this->bookingsScheduledForDeletion->clear();
            }
            $this->bookingsScheduledForDeletion[]= $booking;
            $booking->setItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinContactRelatedByAuthorId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByAuthorId', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinContactRelatedByGuestId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('ContactRelatedByGuestId', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getBookings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Bookings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooking[] List of ChildBooking objects
     */
    public function getBookingsJoinEventStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookingQuery::create(null, $criteria);
        $query->joinWith('EventStatus', $joinBehavior);

        return $this->getBookings($query, $con);
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
     * If this ChildItem is new, it will return
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
                    ->filterByItem($this)
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
     * @return $this|ChildItem The current object (for fluent API support)
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
            $itemCategoryRemoved->setItem(null);
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
                ->filterByItem($this)
                ->count($con);
        }

        return count($this->collItemCategories);
    }

    /**
     * Method called to associate a ChildItemCategory object to this object
     * through the ChildItemCategory foreign key attribute.
     *
     * @param  ChildItemCategory $l ChildItemCategory
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
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
        $itemCategory->setItem($this);
    }

    /**
     * @param  ChildItemCategory $itemCategory The ChildItemCategory object to remove.
     * @return $this|ChildItem The current object (for fluent API support)
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
            $itemCategory->setItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related ItemCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildItemCategory[] List of ChildItemCategory objects
     */
    public function getItemCategoriesJoinCategory(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildItemCategoryQuery::create(null, $criteria);
        $query->joinWith('Category', $joinBehavior);

        return $this->getItemCategories($query, $con);
    }

    /**
     * Clears out the collPackageItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPackageItems()
     */
    public function clearPackageItems()
    {
        $this->collPackageItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPackageItems collection loaded partially.
     */
    public function resetPartialPackageItems($v = true)
    {
        $this->collPackageItemsPartial = $v;
    }

    /**
     * Initializes the collPackageItems collection.
     *
     * By default this just sets the collPackageItems collection to an empty array (like clearcollPackageItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPackageItems($overrideExisting = true)
    {
        if (null !== $this->collPackageItems && !$overrideExisting) {
            return;
        }

        $collectionClassName = PackageItemTableMap::getTableMap()->getCollectionClassName();

        $this->collPackageItems = new $collectionClassName;
        $this->collPackageItems->setModel('\TheFarm\Models\PackageItem');
    }

    /**
     * Gets an array of ChildPackageItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPackageItem[] List of ChildPackageItem objects
     * @throws PropelException
     */
    public function getPackageItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageItemsPartial && !$this->isNew();
        if (null === $this->collPackageItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPackageItems) {
                // return empty collection
                $this->initPackageItems();
            } else {
                $collPackageItems = ChildPackageItemQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPackageItemsPartial && count($collPackageItems)) {
                        $this->initPackageItems(false);

                        foreach ($collPackageItems as $obj) {
                            if (false == $this->collPackageItems->contains($obj)) {
                                $this->collPackageItems->append($obj);
                            }
                        }

                        $this->collPackageItemsPartial = true;
                    }

                    return $collPackageItems;
                }

                if ($partial && $this->collPackageItems) {
                    foreach ($this->collPackageItems as $obj) {
                        if ($obj->isNew()) {
                            $collPackageItems[] = $obj;
                        }
                    }
                }

                $this->collPackageItems = $collPackageItems;
                $this->collPackageItemsPartial = false;
            }
        }

        return $this->collPackageItems;
    }

    /**
     * Sets a collection of ChildPackageItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $packageItems A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function setPackageItems(Collection $packageItems, ConnectionInterface $con = null)
    {
        /** @var ChildPackageItem[] $packageItemsToDelete */
        $packageItemsToDelete = $this->getPackageItems(new Criteria(), $con)->diff($packageItems);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->packageItemsScheduledForDeletion = clone $packageItemsToDelete;

        foreach ($packageItemsToDelete as $packageItemRemoved) {
            $packageItemRemoved->setItem(null);
        }

        $this->collPackageItems = null;
        foreach ($packageItems as $packageItem) {
            $this->addPackageItem($packageItem);
        }

        $this->collPackageItems = $packageItems;
        $this->collPackageItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PackageItem objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PackageItem objects.
     * @throws PropelException
     */
    public function countPackageItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPackageItemsPartial && !$this->isNew();
        if (null === $this->collPackageItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPackageItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPackageItems());
            }

            $query = ChildPackageItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByItem($this)
                ->count($con);
        }

        return count($this->collPackageItems);
    }

    /**
     * Method called to associate a ChildPackageItem object to this object
     * through the ChildPackageItem foreign key attribute.
     *
     * @param  ChildPackageItem $l ChildPackageItem
     * @return $this|\TheFarm\Models\Item The current object (for fluent API support)
     */
    public function addPackageItem(ChildPackageItem $l)
    {
        if ($this->collPackageItems === null) {
            $this->initPackageItems();
            $this->collPackageItemsPartial = true;
        }

        if (!$this->collPackageItems->contains($l)) {
            $this->doAddPackageItem($l);

            if ($this->packageItemsScheduledForDeletion and $this->packageItemsScheduledForDeletion->contains($l)) {
                $this->packageItemsScheduledForDeletion->remove($this->packageItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPackageItem $packageItem The ChildPackageItem object to add.
     */
    protected function doAddPackageItem(ChildPackageItem $packageItem)
    {
        $this->collPackageItems[]= $packageItem;
        $packageItem->setItem($this);
    }

    /**
     * @param  ChildPackageItem $packageItem The ChildPackageItem object to remove.
     * @return $this|ChildItem The current object (for fluent API support)
     */
    public function removePackageItem(ChildPackageItem $packageItem)
    {
        if ($this->getPackageItems()->contains($packageItem)) {
            $pos = $this->collPackageItems->search($packageItem);
            $this->collPackageItems->remove($pos);
            if (null === $this->packageItemsScheduledForDeletion) {
                $this->packageItemsScheduledForDeletion = clone $this->collPackageItems;
                $this->packageItemsScheduledForDeletion->clear();
            }
            $this->packageItemsScheduledForDeletion[]= clone $packageItem;
            $packageItem->setItem(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related PackageItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPackageItem[] List of ChildPackageItem objects
     */
    public function getPackageItemsJoinPackage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPackageItemQuery::create(null, $criteria);
        $query->joinWith('Package', $joinBehavior);

        return $this->getPackageItems($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFiles) {
            $this->aFiles->removeItem($this);
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
            if ($this->collBookingEvents) {
                foreach ($this->collBookingEvents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookingItems) {
                foreach ($this->collBookingItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBookings) {
                foreach ($this->collBookings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItemCategories) {
                foreach ($this->collItemCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPackageItems) {
                foreach ($this->collPackageItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookingEvents = null;
        $this->collBookingItems = null;
        $this->collBookings = null;
        $this->collItemCategories = null;
        $this->collPackageItems = null;
        $this->aFiles = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ItemTableMap::DEFAULT_STRING_FORMAT);
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
