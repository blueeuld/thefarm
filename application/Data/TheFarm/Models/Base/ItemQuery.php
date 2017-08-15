<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\Item as ChildItem;
use TheFarm\Models\ItemQuery as ChildItemQuery;
use TheFarm\Models\Map\ItemTableMap;

/**
 * Base class that represents a query for the 'tf_items' table.
 *
 *
 *
 * @method     ChildItemQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildItemQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildItemQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildItemQuery orderByDuration($order = Criteria::ASC) Order by the duration column
 * @method     ChildItemQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildItemQuery orderByUom($order = Criteria::ASC) Order by the uom column
 * @method     ChildItemQuery orderByAbbr($order = Criteria::ASC) Order by the abbr column
 * @method     ChildItemQuery orderByMaxProvider($order = Criteria::ASC) Order by the max_provider column
 * @method     ChildItemQuery orderByForSale($order = Criteria::ASC) Order by the for_sale column
 * @method     ChildItemQuery orderByItemImage($order = Criteria::ASC) Order by the item_image column
 * @method     ChildItemQuery orderByBookable($order = Criteria::ASC) Order by the bookable column
 * @method     ChildItemQuery orderByTimeSettings($order = Criteria::ASC) Order by the time_settings column
 * @method     ChildItemQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildItemQuery orderByItemIcon($order = Criteria::ASC) Order by the item_icon column
 *
 * @method     ChildItemQuery groupByItemId() Group by the item_id column
 * @method     ChildItemQuery groupByTitle() Group by the title column
 * @method     ChildItemQuery groupByDescription() Group by the description column
 * @method     ChildItemQuery groupByDuration() Group by the duration column
 * @method     ChildItemQuery groupByAmount() Group by the amount column
 * @method     ChildItemQuery groupByUom() Group by the uom column
 * @method     ChildItemQuery groupByAbbr() Group by the abbr column
 * @method     ChildItemQuery groupByMaxProvider() Group by the max_provider column
 * @method     ChildItemQuery groupByForSale() Group by the for_sale column
 * @method     ChildItemQuery groupByItemImage() Group by the item_image column
 * @method     ChildItemQuery groupByBookable() Group by the bookable column
 * @method     ChildItemQuery groupByTimeSettings() Group by the time_settings column
 * @method     ChildItemQuery groupByIsActive() Group by the is_active column
 * @method     ChildItemQuery groupByItemIcon() Group by the item_icon column
 *
 * @method     ChildItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildItemQuery leftJoinFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Files relation
 * @method     ChildItemQuery rightJoinFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Files relation
 * @method     ChildItemQuery innerJoinFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Files relation
 *
 * @method     ChildItemQuery joinWithFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Files relation
 *
 * @method     ChildItemQuery leftJoinWithFiles() Adds a LEFT JOIN clause and with to the query using the Files relation
 * @method     ChildItemQuery rightJoinWithFiles() Adds a RIGHT JOIN clause and with to the query using the Files relation
 * @method     ChildItemQuery innerJoinWithFiles() Adds a INNER JOIN clause and with to the query using the Files relation
 *
 * @method     ChildItemQuery leftJoinBookingEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEvent relation
 * @method     ChildItemQuery rightJoinBookingEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEvent relation
 * @method     ChildItemQuery innerJoinBookingEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEvent relation
 *
 * @method     ChildItemQuery joinWithBookingEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEvent relation
 *
 * @method     ChildItemQuery leftJoinWithBookingEvent() Adds a LEFT JOIN clause and with to the query using the BookingEvent relation
 * @method     ChildItemQuery rightJoinWithBookingEvent() Adds a RIGHT JOIN clause and with to the query using the BookingEvent relation
 * @method     ChildItemQuery innerJoinWithBookingEvent() Adds a INNER JOIN clause and with to the query using the BookingEvent relation
 *
 * @method     ChildItemQuery leftJoinBookingItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingItem relation
 * @method     ChildItemQuery rightJoinBookingItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingItem relation
 * @method     ChildItemQuery innerJoinBookingItem($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingItem relation
 *
 * @method     ChildItemQuery joinWithBookingItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingItem relation
 *
 * @method     ChildItemQuery leftJoinWithBookingItem() Adds a LEFT JOIN clause and with to the query using the BookingItem relation
 * @method     ChildItemQuery rightJoinWithBookingItem() Adds a RIGHT JOIN clause and with to the query using the BookingItem relation
 * @method     ChildItemQuery innerJoinWithBookingItem() Adds a INNER JOIN clause and with to the query using the BookingItem relation
 *
 * @method     ChildItemQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildItemQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildItemQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildItemQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildItemQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildItemQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildItemQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildItemQuery leftJoinItemCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemCategory relation
 * @method     ChildItemQuery rightJoinItemCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemCategory relation
 * @method     ChildItemQuery innerJoinItemCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemCategory relation
 *
 * @method     ChildItemQuery joinWithItemCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemCategory relation
 *
 * @method     ChildItemQuery leftJoinWithItemCategory() Adds a LEFT JOIN clause and with to the query using the ItemCategory relation
 * @method     ChildItemQuery rightJoinWithItemCategory() Adds a RIGHT JOIN clause and with to the query using the ItemCategory relation
 * @method     ChildItemQuery innerJoinWithItemCategory() Adds a INNER JOIN clause and with to the query using the ItemCategory relation
 *
 * @method     ChildItemQuery leftJoinItemsRelatedFacility($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemsRelatedFacility relation
 * @method     ChildItemQuery rightJoinItemsRelatedFacility($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemsRelatedFacility relation
 * @method     ChildItemQuery innerJoinItemsRelatedFacility($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemsRelatedFacility relation
 *
 * @method     ChildItemQuery joinWithItemsRelatedFacility($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemsRelatedFacility relation
 *
 * @method     ChildItemQuery leftJoinWithItemsRelatedFacility() Adds a LEFT JOIN clause and with to the query using the ItemsRelatedFacility relation
 * @method     ChildItemQuery rightJoinWithItemsRelatedFacility() Adds a RIGHT JOIN clause and with to the query using the ItemsRelatedFacility relation
 * @method     ChildItemQuery innerJoinWithItemsRelatedFacility() Adds a INNER JOIN clause and with to the query using the ItemsRelatedFacility relation
 *
 * @method     ChildItemQuery leftJoinItemForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemForm relation
 * @method     ChildItemQuery rightJoinItemForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemForm relation
 * @method     ChildItemQuery innerJoinItemForm($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemForm relation
 *
 * @method     ChildItemQuery joinWithItemForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemForm relation
 *
 * @method     ChildItemQuery leftJoinWithItemForm() Adds a LEFT JOIN clause and with to the query using the ItemForm relation
 * @method     ChildItemQuery rightJoinWithItemForm() Adds a RIGHT JOIN clause and with to the query using the ItemForm relation
 * @method     ChildItemQuery innerJoinWithItemForm() Adds a INNER JOIN clause and with to the query using the ItemForm relation
 *
 * @method     ChildItemQuery leftJoinItemsRelatedUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemsRelatedUser relation
 * @method     ChildItemQuery rightJoinItemsRelatedUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemsRelatedUser relation
 * @method     ChildItemQuery innerJoinItemsRelatedUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemsRelatedUser relation
 *
 * @method     ChildItemQuery joinWithItemsRelatedUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemsRelatedUser relation
 *
 * @method     ChildItemQuery leftJoinWithItemsRelatedUser() Adds a LEFT JOIN clause and with to the query using the ItemsRelatedUser relation
 * @method     ChildItemQuery rightJoinWithItemsRelatedUser() Adds a RIGHT JOIN clause and with to the query using the ItemsRelatedUser relation
 * @method     ChildItemQuery innerJoinWithItemsRelatedUser() Adds a INNER JOIN clause and with to the query using the ItemsRelatedUser relation
 *
 * @method     ChildItemQuery leftJoinPackageItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackageItem relation
 * @method     ChildItemQuery rightJoinPackageItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackageItem relation
 * @method     ChildItemQuery innerJoinPackageItem($relationAlias = null) Adds a INNER JOIN clause to the query using the PackageItem relation
 *
 * @method     ChildItemQuery joinWithPackageItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackageItem relation
 *
 * @method     ChildItemQuery leftJoinWithPackageItem() Adds a LEFT JOIN clause and with to the query using the PackageItem relation
 * @method     ChildItemQuery rightJoinWithPackageItem() Adds a RIGHT JOIN clause and with to the query using the PackageItem relation
 * @method     ChildItemQuery innerJoinWithPackageItem() Adds a INNER JOIN clause and with to the query using the PackageItem relation
 *
 * @method     \TheFarm\Models\FilesQuery|\TheFarm\Models\BookingEventQuery|\TheFarm\Models\BookingItemQuery|\TheFarm\Models\BookingQuery|\TheFarm\Models\ItemCategoryQuery|\TheFarm\Models\ItemsRelatedFacilityQuery|\TheFarm\Models\ItemFormQuery|\TheFarm\Models\ItemsRelatedUserQuery|\TheFarm\Models\PackageItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildItem findOne(ConnectionInterface $con = null) Return the first ChildItem matching the query
 * @method     ChildItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildItem matching the query, or a new ChildItem object populated from the query conditions when no match is found
 *
 * @method     ChildItem findOneByItemId(int $item_id) Return the first ChildItem filtered by the item_id column
 * @method     ChildItem findOneByTitle(string $title) Return the first ChildItem filtered by the title column
 * @method     ChildItem findOneByDescription(string $description) Return the first ChildItem filtered by the description column
 * @method     ChildItem findOneByDuration(int $duration) Return the first ChildItem filtered by the duration column
 * @method     ChildItem findOneByAmount(int $amount) Return the first ChildItem filtered by the amount column
 * @method     ChildItem findOneByUom(string $uom) Return the first ChildItem filtered by the uom column
 * @method     ChildItem findOneByAbbr(string $abbr) Return the first ChildItem filtered by the abbr column
 * @method     ChildItem findOneByMaxProvider(int $max_provider) Return the first ChildItem filtered by the max_provider column
 * @method     ChildItem findOneByForSale(string $for_sale) Return the first ChildItem filtered by the for_sale column
 * @method     ChildItem findOneByItemImage(int $item_image) Return the first ChildItem filtered by the item_image column
 * @method     ChildItem findOneByBookable(string $bookable) Return the first ChildItem filtered by the bookable column
 * @method     ChildItem findOneByTimeSettings(string $time_settings) Return the first ChildItem filtered by the time_settings column
 * @method     ChildItem findOneByIsActive(int $is_active) Return the first ChildItem filtered by the is_active column
 * @method     ChildItem findOneByItemIcon(string $item_icon) Return the first ChildItem filtered by the item_icon column *

 * @method     ChildItem requirePk($key, ConnectionInterface $con = null) Return the ChildItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOne(ConnectionInterface $con = null) Return the first ChildItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItem requireOneByItemId(int $item_id) Return the first ChildItem filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByTitle(string $title) Return the first ChildItem filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByDescription(string $description) Return the first ChildItem filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByDuration(int $duration) Return the first ChildItem filtered by the duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByAmount(int $amount) Return the first ChildItem filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByUom(string $uom) Return the first ChildItem filtered by the uom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByAbbr(string $abbr) Return the first ChildItem filtered by the abbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByMaxProvider(int $max_provider) Return the first ChildItem filtered by the max_provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByForSale(string $for_sale) Return the first ChildItem filtered by the for_sale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByItemImage(int $item_image) Return the first ChildItem filtered by the item_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByBookable(string $bookable) Return the first ChildItem filtered by the bookable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByTimeSettings(string $time_settings) Return the first ChildItem filtered by the time_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByIsActive(int $is_active) Return the first ChildItem filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItem requireOneByItemIcon(string $item_icon) Return the first ChildItem filtered by the item_icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildItem objects based on current ModelCriteria
 * @method     ChildItem[]|ObjectCollection findByItemId(int $item_id) Return ChildItem objects filtered by the item_id column
 * @method     ChildItem[]|ObjectCollection findByTitle(string $title) Return ChildItem objects filtered by the title column
 * @method     ChildItem[]|ObjectCollection findByDescription(string $description) Return ChildItem objects filtered by the description column
 * @method     ChildItem[]|ObjectCollection findByDuration(int $duration) Return ChildItem objects filtered by the duration column
 * @method     ChildItem[]|ObjectCollection findByAmount(int $amount) Return ChildItem objects filtered by the amount column
 * @method     ChildItem[]|ObjectCollection findByUom(string $uom) Return ChildItem objects filtered by the uom column
 * @method     ChildItem[]|ObjectCollection findByAbbr(string $abbr) Return ChildItem objects filtered by the abbr column
 * @method     ChildItem[]|ObjectCollection findByMaxProvider(int $max_provider) Return ChildItem objects filtered by the max_provider column
 * @method     ChildItem[]|ObjectCollection findByForSale(string $for_sale) Return ChildItem objects filtered by the for_sale column
 * @method     ChildItem[]|ObjectCollection findByItemImage(int $item_image) Return ChildItem objects filtered by the item_image column
 * @method     ChildItem[]|ObjectCollection findByBookable(string $bookable) Return ChildItem objects filtered by the bookable column
 * @method     ChildItem[]|ObjectCollection findByTimeSettings(string $time_settings) Return ChildItem objects filtered by the time_settings column
 * @method     ChildItem[]|ObjectCollection findByIsActive(int $is_active) Return ChildItem objects filtered by the is_active column
 * @method     ChildItem[]|ObjectCollection findByItemIcon(string $item_icon) Return ChildItem objects filtered by the item_icon column
 * @method     ChildItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Item', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildItemQuery) {
            return $criteria;
        }
        $query = new ChildItemQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ItemTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT item_id, title, description, duration, amount, uom, abbr, max_provider, for_sale, item_image, bookable, time_settings, is_active, item_icon FROM tf_items WHERE item_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildItem $obj */
            $obj = new ChildItem();
            $obj->hydrate($row);
            ItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildItem|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the duration column
     *
     * Example usage:
     * <code>
     * $query->filterByDuration(1234); // WHERE duration = 1234
     * $query->filterByDuration(array(12, 34)); // WHERE duration IN (12, 34)
     * $query->filterByDuration(array('min' => 12)); // WHERE duration > 12
     * </code>
     *
     * @param     mixed $duration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByDuration($duration = null, $comparison = null)
    {
        if (is_array($duration)) {
            $useMinMax = false;
            if (isset($duration['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_DURATION, $duration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($duration['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_DURATION, $duration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_DURATION, $duration, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the uom column
     *
     * Example usage:
     * <code>
     * $query->filterByUom('fooValue');   // WHERE uom = 'fooValue'
     * $query->filterByUom('%fooValue%', Criteria::LIKE); // WHERE uom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByUom($uom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_UOM, $uom, $comparison);
    }

    /**
     * Filter the query on the abbr column
     *
     * Example usage:
     * <code>
     * $query->filterByAbbr('fooValue');   // WHERE abbr = 'fooValue'
     * $query->filterByAbbr('%fooValue%', Criteria::LIKE); // WHERE abbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $abbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByAbbr($abbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_ABBR, $abbr, $comparison);
    }

    /**
     * Filter the query on the max_provider column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxProvider(1234); // WHERE max_provider = 1234
     * $query->filterByMaxProvider(array(12, 34)); // WHERE max_provider IN (12, 34)
     * $query->filterByMaxProvider(array('min' => 12)); // WHERE max_provider > 12
     * </code>
     *
     * @param     mixed $maxProvider The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByMaxProvider($maxProvider = null, $comparison = null)
    {
        if (is_array($maxProvider)) {
            $useMinMax = false;
            if (isset($maxProvider['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_MAX_PROVIDER, $maxProvider['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxProvider['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_MAX_PROVIDER, $maxProvider['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_MAX_PROVIDER, $maxProvider, $comparison);
    }

    /**
     * Filter the query on the for_sale column
     *
     * Example usage:
     * <code>
     * $query->filterByForSale('fooValue');   // WHERE for_sale = 'fooValue'
     * $query->filterByForSale('%fooValue%', Criteria::LIKE); // WHERE for_sale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $forSale The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByForSale($forSale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($forSale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_FOR_SALE, $forSale, $comparison);
    }

    /**
     * Filter the query on the item_image column
     *
     * Example usage:
     * <code>
     * $query->filterByItemImage(1234); // WHERE item_image = 1234
     * $query->filterByItemImage(array(12, 34)); // WHERE item_image IN (12, 34)
     * $query->filterByItemImage(array('min' => 12)); // WHERE item_image > 12
     * </code>
     *
     * @see       filterByFiles()
     *
     * @param     mixed $itemImage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemImage($itemImage = null, $comparison = null)
    {
        if (is_array($itemImage)) {
            $useMinMax = false;
            if (isset($itemImage['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_ITEM_IMAGE, $itemImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemImage['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_ITEM_IMAGE, $itemImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_ITEM_IMAGE, $itemImage, $comparison);
    }

    /**
     * Filter the query on the bookable column
     *
     * Example usage:
     * <code>
     * $query->filterByBookable('fooValue');   // WHERE bookable = 'fooValue'
     * $query->filterByBookable('%fooValue%', Criteria::LIKE); // WHERE bookable LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bookable The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByBookable($bookable = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bookable)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_BOOKABLE, $bookable, $comparison);
    }

    /**
     * Filter the query on the time_settings column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeSettings('fooValue');   // WHERE time_settings = 'fooValue'
     * $query->filterByTimeSettings('%fooValue%', Criteria::LIKE); // WHERE time_settings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timeSettings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByTimeSettings($timeSettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timeSettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_TIME_SETTINGS, $timeSettings, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(1234); // WHERE is_active = 1234
     * $query->filterByIsActive(array(12, 34)); // WHERE is_active IN (12, 34)
     * $query->filterByIsActive(array('min' => 12)); // WHERE is_active > 12
     * </code>
     *
     * @param     mixed $isActive The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_array($isActive)) {
            $useMinMax = false;
            if (isset($isActive['min'])) {
                $this->addUsingAlias(ItemTableMap::COL_IS_ACTIVE, $isActive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isActive['max'])) {
                $this->addUsingAlias(ItemTableMap::COL_IS_ACTIVE, $isActive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query on the item_icon column
     *
     * Example usage:
     * <code>
     * $query->filterByItemIcon('fooValue');   // WHERE item_icon = 'fooValue'
     * $query->filterByItemIcon('%fooValue%', Criteria::LIKE); // WHERE item_icon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $itemIcon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemIcon($itemIcon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itemIcon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemTableMap::COL_ITEM_ICON, $itemIcon, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Files object
     *
     * @param \TheFarm\Models\Files|ObjectCollection $files The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByFiles($files, $comparison = null)
    {
        if ($files instanceof \TheFarm\Models\Files) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_IMAGE, $files->getFileId(), $comparison);
        } elseif ($files instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_IMAGE, $files->toKeyValue('PrimaryKey', 'FileId'), $comparison);
        } else {
            throw new PropelException('filterByFiles() only accepts arguments of type \TheFarm\Models\Files or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Files relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinFiles($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Files');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Files');
        }

        return $this;
    }

    /**
     * Use the Files relation Files object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FilesQuery A secondary query class using the current class as primary query
     */
    public function useFilesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Files', '\TheFarm\Models\FilesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvent object
     *
     * @param \TheFarm\Models\BookingEvent|ObjectCollection $bookingEvent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByBookingEvent($bookingEvent, $comparison = null)
    {
        if ($bookingEvent instanceof \TheFarm\Models\BookingEvent) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $bookingEvent->getItemId(), $comparison);
        } elseif ($bookingEvent instanceof ObjectCollection) {
            return $this
                ->useBookingEventQuery()
                ->filterByPrimaryKeys($bookingEvent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEvent() only accepts arguments of type \TheFarm\Models\BookingEvent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEvent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinBookingEvent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEvent');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BookingEvent');
        }

        return $this;
    }

    /**
     * Use the BookingEvent relation BookingEvent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEvent', '\TheFarm\Models\BookingEventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingItem object
     *
     * @param \TheFarm\Models\BookingItem|ObjectCollection $bookingItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByBookingItem($bookingItem, $comparison = null)
    {
        if ($bookingItem instanceof \TheFarm\Models\BookingItem) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $bookingItem->getItemId(), $comparison);
        } elseif ($bookingItem instanceof ObjectCollection) {
            return $this
                ->useBookingItemQuery()
                ->filterByPrimaryKeys($bookingItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingItem() only accepts arguments of type \TheFarm\Models\BookingItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinBookingItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BookingItem');
        }

        return $this;
    }

    /**
     * Use the BookingItem relation BookingItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingItemQuery A secondary query class using the current class as primary query
     */
    public function useBookingItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingItem', '\TheFarm\Models\BookingItemQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $booking->getRoomId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            return $this
                ->useBookingQuery()
                ->filterByPrimaryKeys($booking->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooking() only accepts arguments of type \TheFarm\Models\Booking or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Booking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Booking');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Booking');
        }

        return $this;
    }

    /**
     * Use the Booking relation Booking object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingQuery A secondary query class using the current class as primary query
     */
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemCategory object
     *
     * @param \TheFarm\Models\ItemCategory|ObjectCollection $itemCategory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemCategory($itemCategory, $comparison = null)
    {
        if ($itemCategory instanceof \TheFarm\Models\ItemCategory) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemCategory->getItemId(), $comparison);
        } elseif ($itemCategory instanceof ObjectCollection) {
            return $this
                ->useItemCategoryQuery()
                ->filterByPrimaryKeys($itemCategory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemCategory() only accepts arguments of type \TheFarm\Models\ItemCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinItemCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemCategory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ItemCategory');
        }

        return $this;
    }

    /**
     * Use the ItemCategory relation ItemCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemCategoryQuery A secondary query class using the current class as primary query
     */
    public function useItemCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemCategory', '\TheFarm\Models\ItemCategoryQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemsRelatedFacility object
     *
     * @param \TheFarm\Models\ItemsRelatedFacility|ObjectCollection $itemsRelatedFacility the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemsRelatedFacility($itemsRelatedFacility, $comparison = null)
    {
        if ($itemsRelatedFacility instanceof \TheFarm\Models\ItemsRelatedFacility) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemsRelatedFacility->getItemId(), $comparison);
        } elseif ($itemsRelatedFacility instanceof ObjectCollection) {
            return $this
                ->useItemsRelatedFacilityQuery()
                ->filterByPrimaryKeys($itemsRelatedFacility->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemsRelatedFacility() only accepts arguments of type \TheFarm\Models\ItemsRelatedFacility or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemsRelatedFacility relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinItemsRelatedFacility($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemsRelatedFacility');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ItemsRelatedFacility');
        }

        return $this;
    }

    /**
     * Use the ItemsRelatedFacility relation ItemsRelatedFacility object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsRelatedFacilityQuery A secondary query class using the current class as primary query
     */
    public function useItemsRelatedFacilityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemsRelatedFacility($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemsRelatedFacility', '\TheFarm\Models\ItemsRelatedFacilityQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemForm object
     *
     * @param \TheFarm\Models\ItemForm|ObjectCollection $itemForm the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemForm($itemForm, $comparison = null)
    {
        if ($itemForm instanceof \TheFarm\Models\ItemForm) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemForm->getItemId(), $comparison);
        } elseif ($itemForm instanceof ObjectCollection) {
            return $this
                ->useItemFormQuery()
                ->filterByPrimaryKeys($itemForm->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemForm() only accepts arguments of type \TheFarm\Models\ItemForm or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemForm relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinItemForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemForm');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ItemForm');
        }

        return $this;
    }

    /**
     * Use the ItemForm relation ItemForm object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemFormQuery A secondary query class using the current class as primary query
     */
    public function useItemFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemForm', '\TheFarm\Models\ItemFormQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemsRelatedUser object
     *
     * @param \TheFarm\Models\ItemsRelatedUser|ObjectCollection $itemsRelatedUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByItemsRelatedUser($itemsRelatedUser, $comparison = null)
    {
        if ($itemsRelatedUser instanceof \TheFarm\Models\ItemsRelatedUser) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $itemsRelatedUser->getItemId(), $comparison);
        } elseif ($itemsRelatedUser instanceof ObjectCollection) {
            return $this
                ->useItemsRelatedUserQuery()
                ->filterByPrimaryKeys($itemsRelatedUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemsRelatedUser() only accepts arguments of type \TheFarm\Models\ItemsRelatedUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemsRelatedUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinItemsRelatedUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemsRelatedUser');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ItemsRelatedUser');
        }

        return $this;
    }

    /**
     * Use the ItemsRelatedUser relation ItemsRelatedUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsRelatedUserQuery A secondary query class using the current class as primary query
     */
    public function useItemsRelatedUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemsRelatedUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemsRelatedUser', '\TheFarm\Models\ItemsRelatedUserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\PackageItem object
     *
     * @param \TheFarm\Models\PackageItem|ObjectCollection $packageItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByPackageItem($packageItem, $comparison = null)
    {
        if ($packageItem instanceof \TheFarm\Models\PackageItem) {
            return $this
                ->addUsingAlias(ItemTableMap::COL_ITEM_ID, $packageItem->getItemId(), $comparison);
        } elseif ($packageItem instanceof ObjectCollection) {
            return $this
                ->usePackageItemQuery()
                ->filterByPrimaryKeys($packageItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackageItem() only accepts arguments of type \TheFarm\Models\PackageItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackageItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function joinPackageItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackageItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PackageItem');
        }

        return $this;
    }

    /**
     * Use the PackageItem relation PackageItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PackageItemQuery A secondary query class using the current class as primary query
     */
    public function usePackageItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackageItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackageItem', '\TheFarm\Models\PackageItemQuery');
    }

    /**
     * Filter the query by a related Contact object
     * using the tf_items_related_users table as cross reference
     *
     * @param Contact $contact the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useItemsRelatedUserQuery()
            ->filterByContact($contact, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildItem $item Object to remove from the list of results
     *
     * @return $this|ChildItemQuery The current query, for fluid interface
     */
    public function prune($item = null)
    {
        if ($item) {
            $this->addUsingAlias(ItemTableMap::COL_ITEM_ID, $item->getItemId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_items table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ItemTableMap::clearInstancePool();
            ItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ItemTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ItemQuery
