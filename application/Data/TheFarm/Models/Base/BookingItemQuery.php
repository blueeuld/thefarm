<?php

namespace TheFarm\Models\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\BookingItem as ChildBookingItem;
use TheFarm\Models\BookingItemQuery as ChildBookingItemQuery;
use TheFarm\Models\Map\BookingItemTableMap;

/**
 * Base class that represents a query for the 'tf_booking_items' table.
 *
 *
 *
 * @method     ChildBookingItemQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingItemQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildBookingItemQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildBookingItemQuery orderByIncluded($order = Criteria::ASC) Order by the included column
 * @method     ChildBookingItemQuery orderByFoc($order = Criteria::ASC) Order by the foc column
 * @method     ChildBookingItemQuery orderByUpsell($order = Criteria::ASC) Order by the upsell column
 * @method     ChildBookingItemQuery orderByUpgrade($order = Criteria::ASC) Order by the upgrade column
 * @method     ChildBookingItemQuery orderByInventory($order = Criteria::ASC) Order by the inventory column
 *
 * @method     ChildBookingItemQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingItemQuery groupByItemId() Group by the item_id column
 * @method     ChildBookingItemQuery groupByQuantity() Group by the quantity column
 * @method     ChildBookingItemQuery groupByIncluded() Group by the included column
 * @method     ChildBookingItemQuery groupByFoc() Group by the foc column
 * @method     ChildBookingItemQuery groupByUpsell() Group by the upsell column
 * @method     ChildBookingItemQuery groupByUpgrade() Group by the upgrade column
 * @method     ChildBookingItemQuery groupByInventory() Group by the inventory column
 *
 * @method     ChildBookingItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingItemQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildBookingItemQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildBookingItemQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildBookingItemQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildBookingItemQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingItemQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingItemQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildBookingItemQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildBookingItemQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildBookingItemQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildBookingItemQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildBookingItemQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildBookingItemQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildBookingItemQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     \TheFarm\Models\BookingQuery|\TheFarm\Models\ItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingItem findOne(ConnectionInterface $con = null) Return the first ChildBookingItem matching the query
 * @method     ChildBookingItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingItem matching the query, or a new ChildBookingItem object populated from the query conditions when no match is found
 *
 * @method     ChildBookingItem findOneByBookingId(int $booking_id) Return the first ChildBookingItem filtered by the booking_id column
 * @method     ChildBookingItem findOneByItemId(int $item_id) Return the first ChildBookingItem filtered by the item_id column
 * @method     ChildBookingItem findOneByQuantity(int $quantity) Return the first ChildBookingItem filtered by the quantity column
 * @method     ChildBookingItem findOneByIncluded(boolean $included) Return the first ChildBookingItem filtered by the included column
 * @method     ChildBookingItem findOneByFoc(boolean $foc) Return the first ChildBookingItem filtered by the foc column
 * @method     ChildBookingItem findOneByUpsell(boolean $upsell) Return the first ChildBookingItem filtered by the upsell column
 * @method     ChildBookingItem findOneByUpgrade(boolean $upgrade) Return the first ChildBookingItem filtered by the upgrade column
 * @method     ChildBookingItem findOneByInventory(int $inventory) Return the first ChildBookingItem filtered by the inventory column *

 * @method     ChildBookingItem requirePk($key, ConnectionInterface $con = null) Return the ChildBookingItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOne(ConnectionInterface $con = null) Return the first ChildBookingItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingItem requireOneByBookingId(int $booking_id) Return the first ChildBookingItem filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByItemId(int $item_id) Return the first ChildBookingItem filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByQuantity(int $quantity) Return the first ChildBookingItem filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByIncluded(boolean $included) Return the first ChildBookingItem filtered by the included column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByFoc(boolean $foc) Return the first ChildBookingItem filtered by the foc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByUpsell(boolean $upsell) Return the first ChildBookingItem filtered by the upsell column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByUpgrade(boolean $upgrade) Return the first ChildBookingItem filtered by the upgrade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingItem requireOneByInventory(int $inventory) Return the first ChildBookingItem filtered by the inventory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingItem objects based on current ModelCriteria
 * @method     ChildBookingItem[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookingItem objects filtered by the booking_id column
 * @method     ChildBookingItem[]|ObjectCollection findByItemId(int $item_id) Return ChildBookingItem objects filtered by the item_id column
 * @method     ChildBookingItem[]|ObjectCollection findByQuantity(int $quantity) Return ChildBookingItem objects filtered by the quantity column
 * @method     ChildBookingItem[]|ObjectCollection findByIncluded(boolean $included) Return ChildBookingItem objects filtered by the included column
 * @method     ChildBookingItem[]|ObjectCollection findByFoc(boolean $foc) Return ChildBookingItem objects filtered by the foc column
 * @method     ChildBookingItem[]|ObjectCollection findByUpsell(boolean $upsell) Return ChildBookingItem objects filtered by the upsell column
 * @method     ChildBookingItem[]|ObjectCollection findByUpgrade(boolean $upgrade) Return ChildBookingItem objects filtered by the upgrade column
 * @method     ChildBookingItem[]|ObjectCollection findByInventory(int $inventory) Return ChildBookingItem objects filtered by the inventory column
 * @method     ChildBookingItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingItemQuery) {
            return $criteria;
        }
        $query = new ChildBookingItemQuery();
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
     * @return ChildBookingItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The BookingItem object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The BookingItem object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The BookingItem object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The BookingItem object has no primary key');
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
     * @see       filterByBooking()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @see       filterByItem()
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_ITEM_ID, $itemId, $comparison);
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
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the included column
     *
     * Example usage:
     * <code>
     * $query->filterByIncluded(true); // WHERE included = true
     * $query->filterByIncluded('yes'); // WHERE included = true
     * </code>
     *
     * @param     boolean|string $included The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByIncluded($included = null, $comparison = null)
    {
        if (is_string($included)) {
            $included = in_array(strtolower($included), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_INCLUDED, $included, $comparison);
    }

    /**
     * Filter the query on the foc column
     *
     * Example usage:
     * <code>
     * $query->filterByFoc(true); // WHERE foc = true
     * $query->filterByFoc('yes'); // WHERE foc = true
     * </code>
     *
     * @param     boolean|string $foc The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByFoc($foc = null, $comparison = null)
    {
        if (is_string($foc)) {
            $foc = in_array(strtolower($foc), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_FOC, $foc, $comparison);
    }

    /**
     * Filter the query on the upsell column
     *
     * Example usage:
     * <code>
     * $query->filterByUpsell(true); // WHERE upsell = true
     * $query->filterByUpsell('yes'); // WHERE upsell = true
     * </code>
     *
     * @param     boolean|string $upsell The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByUpsell($upsell = null, $comparison = null)
    {
        if (is_string($upsell)) {
            $upsell = in_array(strtolower($upsell), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_UPSELL, $upsell, $comparison);
    }

    /**
     * Filter the query on the upgrade column
     *
     * Example usage:
     * <code>
     * $query->filterByUpgrade(true); // WHERE upgrade = true
     * $query->filterByUpgrade('yes'); // WHERE upgrade = true
     * </code>
     *
     * @param     boolean|string $upgrade The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByUpgrade($upgrade = null, $comparison = null)
    {
        if (is_string($upgrade)) {
            $upgrade = in_array(strtolower($upgrade), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_UPGRADE, $upgrade, $comparison);
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
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByInventory($inventory = null, $comparison = null)
    {
        if (is_array($inventory)) {
            $useMinMax = false;
            if (isset($inventory['min'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_INVENTORY, $inventory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inventory['max'])) {
                $this->addUsingAlias(BookingItemTableMap::COL_INVENTORY, $inventory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingItemTableMap::COL_INVENTORY, $inventory, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(BookingItemTableMap::COL_BOOKING_ID, $booking->getBookingId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingItemTableMap::COL_BOOKING_ID, $booking->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
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
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Item object
     *
     * @param \TheFarm\Models\Item|ObjectCollection $item The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingItemQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof \TheFarm\Models\Item) {
            return $this
                ->addUsingAlias(BookingItemTableMap::COL_ITEM_ID, $item->getItemId(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingItemTableMap::COL_ITEM_ID, $item->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type \TheFarm\Models\Item or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

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
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation Item object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\TheFarm\Models\ItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingItem $bookingItem Object to remove from the list of results
     *
     * @return $this|ChildBookingItemQuery The current query, for fluid interface
     */
    public function prune($bookingItem = null)
    {
        if ($bookingItem) {
            throw new LogicException('BookingItem object has no primary key');

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingItemTableMap::clearInstancePool();
            BookingItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingItemTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingItemQuery
