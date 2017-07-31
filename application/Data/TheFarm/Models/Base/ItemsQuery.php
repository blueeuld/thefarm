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
use TheFarm\Models\Items as ChildItems;
use TheFarm\Models\ItemsQuery as ChildItemsQuery;
use TheFarm\Models\Map\ItemsTableMap;

/**
 * Base class that represents a query for the 'tf_items' table.
 *
 *
 *
 * @method     ChildItemsQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildItemsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildItemsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildItemsQuery orderByDuration($order = Criteria::ASC) Order by the duration column
 * @method     ChildItemsQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildItemsQuery orderByUom($order = Criteria::ASC) Order by the uom column
 * @method     ChildItemsQuery orderByAbbr($order = Criteria::ASC) Order by the abbr column
 * @method     ChildItemsQuery orderByMaxProvider($order = Criteria::ASC) Order by the max_provider column
 * @method     ChildItemsQuery orderByForSale($order = Criteria::ASC) Order by the for_sale column
 * @method     ChildItemsQuery orderByItemImage($order = Criteria::ASC) Order by the item_image column
 * @method     ChildItemsQuery orderByBookable($order = Criteria::ASC) Order by the bookable column
 * @method     ChildItemsQuery orderByTimeSettings($order = Criteria::ASC) Order by the time_settings column
 * @method     ChildItemsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildItemsQuery orderByItemIcon($order = Criteria::ASC) Order by the item_icon column
 *
 * @method     ChildItemsQuery groupByItemId() Group by the item_id column
 * @method     ChildItemsQuery groupByTitle() Group by the title column
 * @method     ChildItemsQuery groupByDescription() Group by the description column
 * @method     ChildItemsQuery groupByDuration() Group by the duration column
 * @method     ChildItemsQuery groupByAmount() Group by the amount column
 * @method     ChildItemsQuery groupByUom() Group by the uom column
 * @method     ChildItemsQuery groupByAbbr() Group by the abbr column
 * @method     ChildItemsQuery groupByMaxProvider() Group by the max_provider column
 * @method     ChildItemsQuery groupByForSale() Group by the for_sale column
 * @method     ChildItemsQuery groupByItemImage() Group by the item_image column
 * @method     ChildItemsQuery groupByBookable() Group by the bookable column
 * @method     ChildItemsQuery groupByTimeSettings() Group by the time_settings column
 * @method     ChildItemsQuery groupByIsActive() Group by the is_active column
 * @method     ChildItemsQuery groupByItemIcon() Group by the item_icon column
 *
 * @method     ChildItemsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildItemsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildItemsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildItemsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildItemsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildItemsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildItemsQuery leftJoinFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Files relation
 * @method     ChildItemsQuery rightJoinFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Files relation
 * @method     ChildItemsQuery innerJoinFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Files relation
 *
 * @method     ChildItemsQuery joinWithFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Files relation
 *
 * @method     ChildItemsQuery leftJoinWithFiles() Adds a LEFT JOIN clause and with to the query using the Files relation
 * @method     ChildItemsQuery rightJoinWithFiles() Adds a RIGHT JOIN clause and with to the query using the Files relation
 * @method     ChildItemsQuery innerJoinWithFiles() Adds a INNER JOIN clause and with to the query using the Files relation
 *
 * @method     ChildItemsQuery leftJoinBookingEvents($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEvents relation
 * @method     ChildItemsQuery rightJoinBookingEvents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEvents relation
 * @method     ChildItemsQuery innerJoinBookingEvents($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEvents relation
 *
 * @method     ChildItemsQuery joinWithBookingEvents($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEvents relation
 *
 * @method     ChildItemsQuery leftJoinWithBookingEvents() Adds a LEFT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildItemsQuery rightJoinWithBookingEvents() Adds a RIGHT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildItemsQuery innerJoinWithBookingEvents() Adds a INNER JOIN clause and with to the query using the BookingEvents relation
 *
 * @method     ChildItemsQuery leftJoinBookingItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingItems relation
 * @method     ChildItemsQuery rightJoinBookingItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingItems relation
 * @method     ChildItemsQuery innerJoinBookingItems($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingItems relation
 *
 * @method     ChildItemsQuery joinWithBookingItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingItems relation
 *
 * @method     ChildItemsQuery leftJoinWithBookingItems() Adds a LEFT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildItemsQuery rightJoinWithBookingItems() Adds a RIGHT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildItemsQuery innerJoinWithBookingItems() Adds a INNER JOIN clause and with to the query using the BookingItems relation
 *
 * @method     ChildItemsQuery leftJoinBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookings relation
 * @method     ChildItemsQuery rightJoinBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookings relation
 * @method     ChildItemsQuery innerJoinBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookings relation
 *
 * @method     ChildItemsQuery joinWithBookings($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookings relation
 *
 * @method     ChildItemsQuery leftJoinWithBookings() Adds a LEFT JOIN clause and with to the query using the Bookings relation
 * @method     ChildItemsQuery rightJoinWithBookings() Adds a RIGHT JOIN clause and with to the query using the Bookings relation
 * @method     ChildItemsQuery innerJoinWithBookings() Adds a INNER JOIN clause and with to the query using the Bookings relation
 *
 * @method     ChildItemsQuery leftJoinItemCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemCategories relation
 * @method     ChildItemsQuery rightJoinItemCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemCategories relation
 * @method     ChildItemsQuery innerJoinItemCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemCategories relation
 *
 * @method     ChildItemsQuery joinWithItemCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemCategories relation
 *
 * @method     ChildItemsQuery leftJoinWithItemCategories() Adds a LEFT JOIN clause and with to the query using the ItemCategories relation
 * @method     ChildItemsQuery rightJoinWithItemCategories() Adds a RIGHT JOIN clause and with to the query using the ItemCategories relation
 * @method     ChildItemsQuery innerJoinWithItemCategories() Adds a INNER JOIN clause and with to the query using the ItemCategories relation
 *
 * @method     ChildItemsQuery leftJoinPackageItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackageItems relation
 * @method     ChildItemsQuery rightJoinPackageItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackageItems relation
 * @method     ChildItemsQuery innerJoinPackageItems($relationAlias = null) Adds a INNER JOIN clause to the query using the PackageItems relation
 *
 * @method     ChildItemsQuery joinWithPackageItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackageItems relation
 *
 * @method     ChildItemsQuery leftJoinWithPackageItems() Adds a LEFT JOIN clause and with to the query using the PackageItems relation
 * @method     ChildItemsQuery rightJoinWithPackageItems() Adds a RIGHT JOIN clause and with to the query using the PackageItems relation
 * @method     ChildItemsQuery innerJoinWithPackageItems() Adds a INNER JOIN clause and with to the query using the PackageItems relation
 *
 * @method     \TheFarm\Models\FilesQuery|\TheFarm\Models\BookingEventsQuery|\TheFarm\Models\BookingItemsQuery|\TheFarm\Models\BookingsQuery|\TheFarm\Models\ItemCategoriesQuery|\TheFarm\Models\PackageItemsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildItems findOne(ConnectionInterface $con = null) Return the first ChildItems matching the query
 * @method     ChildItems findOneOrCreate(ConnectionInterface $con = null) Return the first ChildItems matching the query, or a new ChildItems object populated from the query conditions when no match is found
 *
 * @method     ChildItems findOneByItemId(int $item_id) Return the first ChildItems filtered by the item_id column
 * @method     ChildItems findOneByTitle(string $title) Return the first ChildItems filtered by the title column
 * @method     ChildItems findOneByDescription(string $description) Return the first ChildItems filtered by the description column
 * @method     ChildItems findOneByDuration(int $duration) Return the first ChildItems filtered by the duration column
 * @method     ChildItems findOneByAmount(int $amount) Return the first ChildItems filtered by the amount column
 * @method     ChildItems findOneByUom(string $uom) Return the first ChildItems filtered by the uom column
 * @method     ChildItems findOneByAbbr(string $abbr) Return the first ChildItems filtered by the abbr column
 * @method     ChildItems findOneByMaxProvider(int $max_provider) Return the first ChildItems filtered by the max_provider column
 * @method     ChildItems findOneByForSale(string $for_sale) Return the first ChildItems filtered by the for_sale column
 * @method     ChildItems findOneByItemImage(int $item_image) Return the first ChildItems filtered by the item_image column
 * @method     ChildItems findOneByBookable(string $bookable) Return the first ChildItems filtered by the bookable column
 * @method     ChildItems findOneByTimeSettings(string $time_settings) Return the first ChildItems filtered by the time_settings column
 * @method     ChildItems findOneByIsActive(int $is_active) Return the first ChildItems filtered by the is_active column
 * @method     ChildItems findOneByItemIcon(string $item_icon) Return the first ChildItems filtered by the item_icon column *

 * @method     ChildItems requirePk($key, ConnectionInterface $con = null) Return the ChildItems by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOne(ConnectionInterface $con = null) Return the first ChildItems matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItems requireOneByItemId(int $item_id) Return the first ChildItems filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByTitle(string $title) Return the first ChildItems filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByDescription(string $description) Return the first ChildItems filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByDuration(int $duration) Return the first ChildItems filtered by the duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByAmount(int $amount) Return the first ChildItems filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByUom(string $uom) Return the first ChildItems filtered by the uom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByAbbr(string $abbr) Return the first ChildItems filtered by the abbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByMaxProvider(int $max_provider) Return the first ChildItems filtered by the max_provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByForSale(string $for_sale) Return the first ChildItems filtered by the for_sale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByItemImage(int $item_image) Return the first ChildItems filtered by the item_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByBookable(string $bookable) Return the first ChildItems filtered by the bookable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByTimeSettings(string $time_settings) Return the first ChildItems filtered by the time_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByIsActive(int $is_active) Return the first ChildItems filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItems requireOneByItemIcon(string $item_icon) Return the first ChildItems filtered by the item_icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItems[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildItems objects based on current ModelCriteria
 * @method     ChildItems[]|ObjectCollection findByItemId(int $item_id) Return ChildItems objects filtered by the item_id column
 * @method     ChildItems[]|ObjectCollection findByTitle(string $title) Return ChildItems objects filtered by the title column
 * @method     ChildItems[]|ObjectCollection findByDescription(string $description) Return ChildItems objects filtered by the description column
 * @method     ChildItems[]|ObjectCollection findByDuration(int $duration) Return ChildItems objects filtered by the duration column
 * @method     ChildItems[]|ObjectCollection findByAmount(int $amount) Return ChildItems objects filtered by the amount column
 * @method     ChildItems[]|ObjectCollection findByUom(string $uom) Return ChildItems objects filtered by the uom column
 * @method     ChildItems[]|ObjectCollection findByAbbr(string $abbr) Return ChildItems objects filtered by the abbr column
 * @method     ChildItems[]|ObjectCollection findByMaxProvider(int $max_provider) Return ChildItems objects filtered by the max_provider column
 * @method     ChildItems[]|ObjectCollection findByForSale(string $for_sale) Return ChildItems objects filtered by the for_sale column
 * @method     ChildItems[]|ObjectCollection findByItemImage(int $item_image) Return ChildItems objects filtered by the item_image column
 * @method     ChildItems[]|ObjectCollection findByBookable(string $bookable) Return ChildItems objects filtered by the bookable column
 * @method     ChildItems[]|ObjectCollection findByTimeSettings(string $time_settings) Return ChildItems objects filtered by the time_settings column
 * @method     ChildItems[]|ObjectCollection findByIsActive(int $is_active) Return ChildItems objects filtered by the is_active column
 * @method     ChildItems[]|ObjectCollection findByItemIcon(string $item_icon) Return ChildItems objects filtered by the item_icon column
 * @method     ChildItems[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ItemsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ItemsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Items', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildItemsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildItemsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildItemsQuery) {
            return $criteria;
        }
        $query = new ChildItemsQuery();
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
     * @return ChildItems|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ItemsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ItemsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildItems A model object, or null if the key is not found
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
            /** @var ChildItems $obj */
            $obj = new ChildItems();
            $obj->hydrate($row);
            ItemsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildItems|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $keys, Criteria::IN);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $itemId, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByDuration($duration = null, $comparison = null)
    {
        if (is_array($duration)) {
            $useMinMax = false;
            if (isset($duration['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_DURATION, $duration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($duration['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_DURATION, $duration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_DURATION, $duration, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_AMOUNT, $amount, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByUom($uom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_UOM, $uom, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByAbbr($abbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_ABBR, $abbr, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByMaxProvider($maxProvider = null, $comparison = null)
    {
        if (is_array($maxProvider)) {
            $useMinMax = false;
            if (isset($maxProvider['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_MAX_PROVIDER, $maxProvider['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxProvider['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_MAX_PROVIDER, $maxProvider['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_MAX_PROVIDER, $maxProvider, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByForSale($forSale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($forSale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_FOR_SALE, $forSale, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByItemImage($itemImage = null, $comparison = null)
    {
        if (is_array($itemImage)) {
            $useMinMax = false;
            if (isset($itemImage['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_ITEM_IMAGE, $itemImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemImage['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_ITEM_IMAGE, $itemImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_ITEM_IMAGE, $itemImage, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByBookable($bookable = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bookable)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_BOOKABLE, $bookable, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByTimeSettings($timeSettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timeSettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_TIME_SETTINGS, $timeSettings, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_array($isActive)) {
            $useMinMax = false;
            if (isset($isActive['min'])) {
                $this->addUsingAlias(ItemsTableMap::COL_IS_ACTIVE, $isActive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isActive['max'])) {
                $this->addUsingAlias(ItemsTableMap::COL_IS_ACTIVE, $isActive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_IS_ACTIVE, $isActive, $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function filterByItemIcon($itemIcon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itemIcon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsTableMap::COL_ITEM_ICON, $itemIcon, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Files object
     *
     * @param \TheFarm\Models\Files|ObjectCollection $files The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByFiles($files, $comparison = null)
    {
        if ($files instanceof \TheFarm\Models\Files) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_IMAGE, $files->getFileId(), $comparison);
        } elseif ($files instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_IMAGE, $files->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildItemsQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByBookingEvents($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $bookingEvents->getItemId(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            return $this
                ->useBookingEventsQuery()
                ->filterByPrimaryKeys($bookingEvents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEvents() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEvents relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function joinBookingEvents($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEvents');

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
            $this->addJoinObject($join, 'BookingEvents');
        }

        return $this;
    }

    /**
     * Use the BookingEvents relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEvents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEvents', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingItems object
     *
     * @param \TheFarm\Models\BookingItems|ObjectCollection $bookingItems the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByBookingItems($bookingItems, $comparison = null)
    {
        if ($bookingItems instanceof \TheFarm\Models\BookingItems) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $bookingItems->getItemId(), $comparison);
        } elseif ($bookingItems instanceof ObjectCollection) {
            return $this
                ->useBookingItemsQuery()
                ->filterByPrimaryKeys($bookingItems->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingItems() only accepts arguments of type \TheFarm\Models\BookingItems or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingItems relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function joinBookingItems($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingItems');

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
            $this->addJoinObject($join, 'BookingItems');
        }

        return $this;
    }

    /**
     * Use the BookingItems relation BookingItems object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingItemsQuery A secondary query class using the current class as primary query
     */
    public function useBookingItemsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingItems', '\TheFarm\Models\BookingItemsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByBookings($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $bookings->getRoomId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            return $this
                ->useBookingsQuery()
                ->filterByPrimaryKeys($bookings->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookings() only accepts arguments of type \TheFarm\Models\Bookings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function joinBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bookings');

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
            $this->addJoinObject($join, 'Bookings');
        }

        return $this;
    }

    /**
     * Use the Bookings relation Bookings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingsQuery A secondary query class using the current class as primary query
     */
    public function useBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bookings', '\TheFarm\Models\BookingsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemCategories object
     *
     * @param \TheFarm\Models\ItemCategories|ObjectCollection $itemCategories the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByItemCategories($itemCategories, $comparison = null)
    {
        if ($itemCategories instanceof \TheFarm\Models\ItemCategories) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $itemCategories->getItemId(), $comparison);
        } elseif ($itemCategories instanceof ObjectCollection) {
            return $this
                ->useItemCategoriesQuery()
                ->filterByPrimaryKeys($itemCategories->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemCategories() only accepts arguments of type \TheFarm\Models\ItemCategories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemCategories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function joinItemCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemCategories');

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
            $this->addJoinObject($join, 'ItemCategories');
        }

        return $this;
    }

    /**
     * Use the ItemCategories relation ItemCategories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemCategoriesQuery A secondary query class using the current class as primary query
     */
    public function useItemCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemCategories', '\TheFarm\Models\ItemCategoriesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\PackageItems object
     *
     * @param \TheFarm\Models\PackageItems|ObjectCollection $packageItems the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildItemsQuery The current query, for fluid interface
     */
    public function filterByPackageItems($packageItems, $comparison = null)
    {
        if ($packageItems instanceof \TheFarm\Models\PackageItems) {
            return $this
                ->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $packageItems->getItemId(), $comparison);
        } elseif ($packageItems instanceof ObjectCollection) {
            return $this
                ->usePackageItemsQuery()
                ->filterByPrimaryKeys($packageItems->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackageItems() only accepts arguments of type \TheFarm\Models\PackageItems or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackageItems relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function joinPackageItems($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackageItems');

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
            $this->addJoinObject($join, 'PackageItems');
        }

        return $this;
    }

    /**
     * Use the PackageItems relation PackageItems object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PackageItemsQuery A secondary query class using the current class as primary query
     */
    public function usePackageItemsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackageItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackageItems', '\TheFarm\Models\PackageItemsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildItems $items Object to remove from the list of results
     *
     * @return $this|ChildItemsQuery The current query, for fluid interface
     */
    public function prune($items = null)
    {
        if ($items) {
            $this->addUsingAlias(ItemsTableMap::COL_ITEM_ID, $items->getItemId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ItemsTableMap::clearInstancePool();
            ItemsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ItemsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ItemsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ItemsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ItemsQuery
