<?php

namespace TheFarm\Models\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\ItemDayTimeSettings as ChildItemDayTimeSettings;
use TheFarm\Models\ItemDayTimeSettingsQuery as ChildItemDayTimeSettingsQuery;
use TheFarm\Models\Map\ItemDayTimeSettingsTableMap;

/**
 * Base class that represents a query for the 'tf_item_day_time_settings' table.
 *
 *
 *
 * @method     ChildItemDayTimeSettingsQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildItemDayTimeSettingsQuery orderByDaySettings($order = Criteria::ASC) Order by the day_settings column
 * @method     ChildItemDayTimeSettingsQuery orderByTimeSettings($order = Criteria::ASC) Order by the time_settings column
 *
 * @method     ChildItemDayTimeSettingsQuery groupByItemId() Group by the item_id column
 * @method     ChildItemDayTimeSettingsQuery groupByDaySettings() Group by the day_settings column
 * @method     ChildItemDayTimeSettingsQuery groupByTimeSettings() Group by the time_settings column
 *
 * @method     ChildItemDayTimeSettingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildItemDayTimeSettingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildItemDayTimeSettingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildItemDayTimeSettingsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildItemDayTimeSettingsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildItemDayTimeSettingsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildItemDayTimeSettings findOne(ConnectionInterface $con = null) Return the first ChildItemDayTimeSettings matching the query
 * @method     ChildItemDayTimeSettings findOneOrCreate(ConnectionInterface $con = null) Return the first ChildItemDayTimeSettings matching the query, or a new ChildItemDayTimeSettings object populated from the query conditions when no match is found
 *
 * @method     ChildItemDayTimeSettings findOneByItemId(int $item_id) Return the first ChildItemDayTimeSettings filtered by the item_id column
 * @method     ChildItemDayTimeSettings findOneByDaySettings(string $day_settings) Return the first ChildItemDayTimeSettings filtered by the day_settings column
 * @method     ChildItemDayTimeSettings findOneByTimeSettings(string $time_settings) Return the first ChildItemDayTimeSettings filtered by the time_settings column *

 * @method     ChildItemDayTimeSettings requirePk($key, ConnectionInterface $con = null) Return the ChildItemDayTimeSettings by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemDayTimeSettings requireOne(ConnectionInterface $con = null) Return the first ChildItemDayTimeSettings matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemDayTimeSettings requireOneByItemId(int $item_id) Return the first ChildItemDayTimeSettings filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemDayTimeSettings requireOneByDaySettings(string $day_settings) Return the first ChildItemDayTimeSettings filtered by the day_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemDayTimeSettings requireOneByTimeSettings(string $time_settings) Return the first ChildItemDayTimeSettings filtered by the time_settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemDayTimeSettings[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildItemDayTimeSettings objects based on current ModelCriteria
 * @method     ChildItemDayTimeSettings[]|ObjectCollection findByItemId(int $item_id) Return ChildItemDayTimeSettings objects filtered by the item_id column
 * @method     ChildItemDayTimeSettings[]|ObjectCollection findByDaySettings(string $day_settings) Return ChildItemDayTimeSettings objects filtered by the day_settings column
 * @method     ChildItemDayTimeSettings[]|ObjectCollection findByTimeSettings(string $time_settings) Return ChildItemDayTimeSettings objects filtered by the time_settings column
 * @method     ChildItemDayTimeSettings[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ItemDayTimeSettingsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ItemDayTimeSettingsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\ItemDayTimeSettings', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildItemDayTimeSettingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildItemDayTimeSettingsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildItemDayTimeSettingsQuery) {
            return $criteria;
        }
        $query = new ChildItemDayTimeSettingsQuery();
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
     * @return ChildItemDayTimeSettings|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The ItemDayTimeSettings object has no primary key');
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
        throw new LogicException('The ItemDayTimeSettings object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The ItemDayTimeSettings object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The ItemDayTimeSettings object has no primary key');
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
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(ItemDayTimeSettingsTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(ItemDayTimeSettingsTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemDayTimeSettingsTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the day_settings column
     *
     * Example usage:
     * <code>
     * $query->filterByDaySettings('fooValue');   // WHERE day_settings = 'fooValue'
     * $query->filterByDaySettings('%fooValue%', Criteria::LIKE); // WHERE day_settings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $daySettings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function filterByDaySettings($daySettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($daySettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemDayTimeSettingsTableMap::COL_DAY_SETTINGS, $daySettings, $comparison);
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
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function filterByTimeSettings($timeSettings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timeSettings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemDayTimeSettingsTableMap::COL_TIME_SETTINGS, $timeSettings, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildItemDayTimeSettings $itemDayTimeSettings Object to remove from the list of results
     *
     * @return $this|ChildItemDayTimeSettingsQuery The current query, for fluid interface
     */
    public function prune($itemDayTimeSettings = null)
    {
        if ($itemDayTimeSettings) {
            throw new LogicException('ItemDayTimeSettings object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_item_day_time_settings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemDayTimeSettingsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ItemDayTimeSettingsTableMap::clearInstancePool();
            ItemDayTimeSettingsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemDayTimeSettingsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ItemDayTimeSettingsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ItemDayTimeSettingsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ItemDayTimeSettingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ItemDayTimeSettingsQuery
