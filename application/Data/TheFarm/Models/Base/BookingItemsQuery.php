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
use TheFarm\Models\BookingItems as ChildBookingItems;
use TheFarm\Models\BookingItemsQuery as ChildBookingItemsQuery;
use TheFarm\Models\Map\BookingItemsTableMap;

/**
 * Base class that represents a query for the 'tf_booking_items' table.
 *
 *
 *
 * @method     ChildBookingItemsQuery orderByBookingItemId($order = Criteria::ASC) Order by the booking_item_id column
 * @method     ChildBookingItemsQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingItemsQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildBookingItemsQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildBookingItemsQuery orderByIncluded($order = Criteria::ASC) Order by the included column
 * @method     ChildBookingItemsQuery orderByFoc($order = Criteria::ASC) Order by the foc column
 * @method     ChildBookingItemsQuery orderByUpsell($order = Criteria::ASC) Order by the upsell column
 * @method     ChildBookingItemsQuery orderByInventory($order = Criteria::ASC) Order by the inventory column
 * @method     ChildBookingItemsQuery orderByUpgrade($order = Criteria::ASC) Order by the upgrade column
 *
 * @method     ChildBookingItemsQuery groupByBookingItemId() Group by the booking_item_id column
 * @method     ChildBookingItemsQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingItemsQuery groupByItemId() Group by the item_id column
 * @method     ChildBookingItemsQuery groupByQuantity() Group by the quantity column
 * @method     ChildBookingItemsQuery groupByIncluded() Group by the included column
 * @method     ChildBookingItemsQuery groupByFoc() Group by the foc column
 * @method     ChildBookingItemsQuery groupByUpsell() Group by the upsell column
 * @method     ChildBookingItemsQuery groupByInventory() Group by the inventory column
 * @method     ChildBookingItemsQuery groupByUpgrade() Group by the upgrade column
 *
 * @method     ChildBookingItemsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingItemsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingItemsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingItemsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingItemsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingItemsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingItemsQuery leftJoinBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookings relation
 * @method     ChildBookingItemsQuery rightJoinBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookings relation
 * @method     ChildBookingItemsQuery innerJoinBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookings relation
 *
 * @method     ChildBookingItemsQuery joinWithBookings($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookings relation
 *
 * @method     ChildBookingItemsQuery leftJoinWithBookings() Adds a LEFT JOIN clause and with to the query using the Bookings relation
 * @method     ChildBookingItemsQuery rightJoinWithBookings() Adds a RIGHT JOIN clause and with to the query using the Bookings relation
 * @method     ChildBookingItemsQuery innerJoinWithBookings() Adds a INNER JOIN clause and with to the query using the Bookings relation
 *
 * @method     ChildBookingItemsQuery leftJoinItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the Items relation
 * @method     ChildBookingItemsQuery rightJoinItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Items relation
 * @method     ChildBookingItemsQuery innerJoinItems($relationAlias = null) Adds a INNER JOIN clause to the query using the Items relation
 *
 * @method     ChildBookingItemsQuery joinWithItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Items relation
 *
 * @method     ChildBookingItemsQuery leftJoinWithItems() Adds a LEFT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingItemsQuery rightJoinWithItems() Adds a RIGHT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingItemsQuery innerJoinWithItems() Adds a INNER JOIN clause and with to the query using the Items relation
 *
 * @method     ChildBookingItemsQuery leftJoinBookingEvents($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEvents relation
 * @method     ChildBookingItemsQuery rightJoinBookingEvents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEvents relation
 * @method     ChildBookingItemsQuery innerJoinBookingEvents($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEvents relation
 *
 * @method     ChildBookingItemsQuery joinWithBookingEvents($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEvents relation
 *
 * @method     ChildBookingItemsQuery leftJoinWithBookingEvents() Adds a LEFT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildBookingItemsQuery rightJoinWithBookingEvents() Adds a RIGHT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildBookingItemsQuery innerJoinWithBookingEvents() Adds a INNER JOIN clause and with to the query using the BookingEvents relation
 *
 * @method     \TheFarm\Models\BookingsQuery|\TheFarm\Models\ItemsQuery|\TheFarm\Models\BookingEventsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingItems findOne(ConnectionInterface $con = null) Return the first ChildBookingItems matching the query
 * @method     ChildBookingItems findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingItems matching the query, or a new ChildBookingItems object populated from the query conditions when no match is found
 *
 * @method     ChildBookingItems findOneByBookingItemId(int $booking_item_id) Return the first ChildBookingItems filtered by the booking_item_id column
 * @method     ChildBookingItems findOneByBookingId(int $booking_id) Return the first ChildBookingItems filtered by the booking_id column
 * @method     ChildBookingItems findOneByItemId(int $item_id) Return the first ChildBookingItems filtered by the item_id column
 * @method     ChildBookingItems findOneByQuantity(int $quantity) Return the first ChildBookingItems filtered by the quantity column
 * @method     ChildBookingItems findOneByIncluded(int $included) Return the first ChildBookingItems filtered by the included column
 * @method     ChildBookingItems findOneByFoc(int $foc) Return the first ChildBookingItems filtered by the foc column
 * @method     ChildBookingItems findOneByUpsell(int $upsell) Return the first ChildBookingItems filtered by the upsell column
 * @method     ChildBookingItems findOneByInventory(int $inventory) Return the first ChildBookingItems filtered by the inventory column
 * @method     ChildBookingItems findOneByUpgrade(int $upgrade) Return the first ChildBookingItems filtered by the upgrade column *

 * @method     ChildBookingItems requirePk($key, ConnectionInterface $con = null) Return the ChildBookingItems by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOne(ConnectionInterface $con = null) Return the first ChildBookingItems matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingItems requireOneByBookingItemId(int $booking_item_id) Return the first ChildBookingItems filtered by the booking_item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByBookingId(int $booking_id) Return the first ChildBookingItems filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByItemId(int $item_id) Return the first ChildBookingItems filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByQuantity(int $quantity) Return the first ChildBookingItems filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByIncluded(int $included) Return the first ChildBookingItems filtered by the included column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByFoc(int $foc) Return the first ChildBookingItems filtered by the foc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByUpsell(int $upsell) Return the first ChildBookingItems filtered by the upsell column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByInventory(int $inventory) Return the first ChildBookingItems filtered by the inventory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItems requireOneByUpgrade(int $upgrade) Return the first ChildBookingItems filtered by the upgrade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingItems[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingItems objects based on current ModelCriteria
 * @method     ChildBookingItems[]|ObjectCollection findByBookingItemId(int $booking_item_id) Return ChildBookingItems objects filtered by the booking_item_id column
 * @method     ChildBookingItems[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookingItems objects filtered by the booking_id column
 * @method     ChildBookingItems[]|ObjectCollection findByItemId(int $item_id) Return ChildBookingItems objects filtered by the item_id column
 * @method     ChildBookingItems[]|ObjectCollection findByQuantity(int $quantity) Return ChildBookingItems objects filtered by the quantity column
 * @method     ChildBookingItems[]|ObjectCollection findByIncluded(int $included) Return ChildBookingItems objects filtered by the included column
 * @method     ChildBookingItems[]|ObjectCollection findByFoc(int $foc) Return ChildBookingItems objects filtered by the foc column
 * @method     ChildBookingItems[]|ObjectCollection findByUpsell(int $upsell) Return ChildBookingItems objects filtered by the upsell column
 * @method     ChildBookingItems[]|ObjectCollection findByInventory(int $inventory) Return ChildBookingItems objects filtered by the inventory column
 * @method     ChildBookingItems[]|ObjectCollection findByUpgrade(int $upgrade) Return ChildBookingItems objects filtered by the upgrade column
 * @method     ChildBookingItems[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingItemsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingItemsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingItems', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingItemsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingItemsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingItemsQuery) {
            return $criteria;
        }
        $query = new ChildBookingItemsQuery();
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
     * @return ChildBookingItems|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingItemsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingItemsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBookingItems A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT booking_item_id, booking_id, item_id, quantity, included, foc, upsell, inventory, upgrade FROM tf_booking_items WHERE booking_item_id = :p0';
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
            /** @var ChildBookingItems $obj */
            $obj = new ChildBookingItems();
            $obj->hydrate($row);
            BookingItemsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBookingItems|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the booking_item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingItemId(1234); // WHERE booking_item_id = 1234
     * $query->filterByBookingItemId(array(12, 34)); // WHERE booking_item_id IN (12, 34)
     * $query->filterByBookingItemId(array('min' => 12)); // WHERE booking_item_id > 12
     * </code>
     *
     * @param     mixed $bookingItemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByBookingItemId($bookingItemId = null, $comparison = null)
    {
        if (is_array($bookingItemId)) {
            $useMinMax = false;
            if (isset($bookingItemId['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingItemId['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId, $comparison);
    }

    /**
     * Filter the query on the booking_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingId(1234); // WHERE booking_id = 1234
     * $query->filterByBookingId(array(12, 34)); // WHERE booking_id IN (12, 34)
     * $query->filterByBookingId(array('min' => 12)); // WHERE booking_id > 12
     * </code>
     *
     * @see       filterByBookings()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @see       filterByItems()
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the included column
     *
     * Example usage:
     * <code>
     * $query->filterByIncluded(1234); // WHERE included = 1234
     * $query->filterByIncluded(array(12, 34)); // WHERE included IN (12, 34)
     * $query->filterByIncluded(array('min' => 12)); // WHERE included > 12
     * </code>
     *
     * @param     mixed $included The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByIncluded($included = null, $comparison = null)
    {
        if (is_array($included)) {
            $useMinMax = false;
            if (isset($included['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_INCLUDED, $included['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($included['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_INCLUDED, $included['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_INCLUDED, $included, $comparison);
    }

    /**
     * Filter the query on the foc column
     *
     * Example usage:
     * <code>
     * $query->filterByFoc(1234); // WHERE foc = 1234
     * $query->filterByFoc(array(12, 34)); // WHERE foc IN (12, 34)
     * $query->filterByFoc(array('min' => 12)); // WHERE foc > 12
     * </code>
     *
     * @param     mixed $foc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByFoc($foc = null, $comparison = null)
    {
        if (is_array($foc)) {
            $useMinMax = false;
            if (isset($foc['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_FOC, $foc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($foc['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_FOC, $foc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_FOC, $foc, $comparison);
    }

    /**
     * Filter the query on the upsell column
     *
     * Example usage:
     * <code>
     * $query->filterByUpsell(1234); // WHERE upsell = 1234
     * $query->filterByUpsell(array(12, 34)); // WHERE upsell IN (12, 34)
     * $query->filterByUpsell(array('min' => 12)); // WHERE upsell > 12
     * </code>
     *
     * @param     mixed $upsell The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByUpsell($upsell = null, $comparison = null)
    {
        if (is_array($upsell)) {
            $useMinMax = false;
            if (isset($upsell['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_UPSELL, $upsell['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upsell['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_UPSELL, $upsell['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_UPSELL, $upsell, $comparison);
    }

    /**
     * Filter the query on the inventory column
     *
     * Example usage:
     * <code>
     * $query->filterByInventory(1234); // WHERE inventory = 1234
     * $query->filterByInventory(array(12, 34)); // WHERE inventory IN (12, 34)
     * $query->filterByInventory(array('min' => 12)); // WHERE inventory > 12
     * </code>
     *
     * @param     mixed $inventory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByInventory($inventory = null, $comparison = null)
    {
        if (is_array($inventory)) {
            $useMinMax = false;
            if (isset($inventory['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_INVENTORY, $inventory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inventory['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_INVENTORY, $inventory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_INVENTORY, $inventory, $comparison);
    }

    /**
     * Filter the query on the upgrade column
     *
     * Example usage:
     * <code>
     * $query->filterByUpgrade(1234); // WHERE upgrade = 1234
     * $query->filterByUpgrade(array(12, 34)); // WHERE upgrade IN (12, 34)
     * $query->filterByUpgrade(array('min' => 12)); // WHERE upgrade > 12
     * </code>
     *
     * @param     mixed $upgrade The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByUpgrade($upgrade = null, $comparison = null)
    {
        if (is_array($upgrade)) {
            $useMinMax = false;
            if (isset($upgrade['min'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_UPGRADE, $upgrade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upgrade['max'])) {
                $this->addUsingAlias(BookingItemsTableMap::COL_UPGRADE, $upgrade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemsTableMap::COL_UPGRADE, $upgrade, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByBookings($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ID, $bookings->getBookingId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ID, $bookings->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
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
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function joinBookings($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useBookingsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bookings', '\TheFarm\Models\BookingsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Items object
     *
     * @param \TheFarm\Models\Items|ObjectCollection $items The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByItems($items, $comparison = null)
    {
        if ($items instanceof \TheFarm\Models\Items) {
            return $this
                ->addUsingAlias(BookingItemsTableMap::COL_ITEM_ID, $items->getItemId(), $comparison);
        } elseif ($items instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingItemsTableMap::COL_ITEM_ID, $items->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
        } else {
            throw new PropelException('filterByItems() only accepts arguments of type \TheFarm\Models\Items or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Items relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function joinItems($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Items');

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
            $this->addJoinObject($join, 'Items');
        }

        return $this;
    }

    /**
     * Use the Items relation Items object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsQuery A secondary query class using the current class as primary query
     */
    public function useItemsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Items', '\TheFarm\Models\ItemsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingItemsQuery The current query, for fluid interface
     */
    public function filterByBookingEvents($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $bookingEvents->getBookingItemId(), $comparison);
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
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildBookingItems $bookingItems Object to remove from the list of results
     *
     * @return $this|ChildBookingItemsQuery The current query, for fluid interface
     */
    public function prune($bookingItems = null)
    {
        if ($bookingItems) {
            $this->addUsingAlias(BookingItemsTableMap::COL_BOOKING_ITEM_ID, $bookingItems->getBookingItemId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_items table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingItemsTableMap::clearInstancePool();
            BookingItemsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingItemsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingItemsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingItemsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingItemsQuery
