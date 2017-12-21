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
use TheFarm\Models\ItemsRelatedFacility as ChildItemsRelatedFacility;
use TheFarm\Models\ItemsRelatedFacilityQuery as ChildItemsRelatedFacilityQuery;
use TheFarm\Models\Map\ItemsRelatedFacilityTableMap;

/**
 * Base class that represents a query for the 'tf_items_related_facilities' table.
 *
 *
 *
 * @method     ChildItemsRelatedFacilityQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildItemsRelatedFacilityQuery orderByFacilityId($order = Criteria::ASC) Order by the facility_id column
 *
 * @method     ChildItemsRelatedFacilityQuery groupByItemId() Group by the item_id column
 * @method     ChildItemsRelatedFacilityQuery groupByFacilityId() Group by the facility_id column
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildItemsRelatedFacilityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildItemsRelatedFacilityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildItemsRelatedFacilityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildItemsRelatedFacilityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoinFacility($relationAlias = null) Adds a LEFT JOIN clause to the query using the Facility relation
 * @method     ChildItemsRelatedFacilityQuery rightJoinFacility($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Facility relation
 * @method     ChildItemsRelatedFacilityQuery innerJoinFacility($relationAlias = null) Adds a INNER JOIN clause to the query using the Facility relation
 *
 * @method     ChildItemsRelatedFacilityQuery joinWithFacility($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Facility relation
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoinWithFacility() Adds a LEFT JOIN clause and with to the query using the Facility relation
 * @method     ChildItemsRelatedFacilityQuery rightJoinWithFacility() Adds a RIGHT JOIN clause and with to the query using the Facility relation
 * @method     ChildItemsRelatedFacilityQuery innerJoinWithFacility() Adds a INNER JOIN clause and with to the query using the Facility relation
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildItemsRelatedFacilityQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildItemsRelatedFacilityQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildItemsRelatedFacilityQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildItemsRelatedFacilityQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildItemsRelatedFacilityQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildItemsRelatedFacilityQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     \TheFarm\Models\FacilityQuery|\TheFarm\Models\ItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildItemsRelatedFacility findOne(ConnectionInterface $con = null) Return the first ChildItemsRelatedFacility matching the query
 * @method     ChildItemsRelatedFacility findOneOrCreate(ConnectionInterface $con = null) Return the first ChildItemsRelatedFacility matching the query, or a new ChildItemsRelatedFacility object populated from the query conditions when no match is found
 *
 * @method     ChildItemsRelatedFacility findOneByItemId(int $item_id) Return the first ChildItemsRelatedFacility filtered by the item_id column
 * @method     ChildItemsRelatedFacility findOneByFacilityId(int $facility_id) Return the first ChildItemsRelatedFacility filtered by the facility_id column *

 * @method     ChildItemsRelatedFacility requirePk($key, ConnectionInterface $con = null) Return the ChildItemsRelatedFacility by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemsRelatedFacility requireOne(ConnectionInterface $con = null) Return the first ChildItemsRelatedFacility matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemsRelatedFacility requireOneByItemId(int $item_id) Return the first ChildItemsRelatedFacility filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemsRelatedFacility requireOneByFacilityId(int $facility_id) Return the first ChildItemsRelatedFacility filtered by the facility_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemsRelatedFacility[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildItemsRelatedFacility objects based on current ModelCriteria
 * @method     ChildItemsRelatedFacility[]|ObjectCollection findByItemId(int $item_id) Return ChildItemsRelatedFacility objects filtered by the item_id column
 * @method     ChildItemsRelatedFacility[]|ObjectCollection findByFacilityId(int $facility_id) Return ChildItemsRelatedFacility objects filtered by the facility_id column
 * @method     ChildItemsRelatedFacility[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ItemsRelatedFacilityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ItemsRelatedFacilityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\ItemsRelatedFacility', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildItemsRelatedFacilityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildItemsRelatedFacilityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildItemsRelatedFacilityQuery) {
            return $criteria;
        }
        $query = new ChildItemsRelatedFacilityQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$item_id, $facility_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildItemsRelatedFacility|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ItemsRelatedFacilityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ItemsRelatedFacilityTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildItemsRelatedFacility A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT item_id, facility_id FROM tf_items_related_facilities WHERE item_id = :p0 AND facility_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildItemsRelatedFacility $obj */
            $obj = new ChildItemsRelatedFacility();
            $obj->hydrate($row);
            ItemsRelatedFacilityTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildItemsRelatedFacility|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the facility_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFacilityId(1234); // WHERE facility_id = 1234
     * $query->filterByFacilityId(array(12, 34)); // WHERE facility_id IN (12, 34)
     * $query->filterByFacilityId(array('min' => 12)); // WHERE facility_id > 12
     * </code>
     *
     * @see       filterByFacility()
     *
     * @param     mixed $facilityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByFacilityId($facilityId = null, $comparison = null)
    {
        if (is_array($facilityId)) {
            $useMinMax = false;
            if (isset($facilityId['min'])) {
                $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $facilityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($facilityId['max'])) {
                $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $facilityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $facilityId, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Facility object
     *
     * @param \TheFarm\Models\Facility|ObjectCollection $facility The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByFacility($facility, $comparison = null)
    {
        if ($facility instanceof \TheFarm\Models\Facility) {
            return $this
                ->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $facility->getFacilityId(), $comparison);
        } elseif ($facility instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemsRelatedFacilityTableMap::COL_FACILITY_ID, $facility->toKeyValue('PrimaryKey', 'FacilityId'), $comparison);
        } else {
            throw new PropelException('filterByFacility() only accepts arguments of type \TheFarm\Models\Facility or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Facility relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function joinFacility($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Facility');

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
            $this->addJoinObject($join, 'Facility');
        }

        return $this;
    }

    /**
     * Use the Facility relation Facility object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FacilityQuery A secondary query class using the current class as primary query
     */
    public function useFacilityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFacility($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Facility', '\TheFarm\Models\FacilityQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Item object
     *
     * @param \TheFarm\Models\Item|ObjectCollection $item The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof \TheFarm\Models\Item) {
            return $this
                ->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $item->getItemId(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemsRelatedFacilityTableMap::COL_ITEM_ID, $item->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
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
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
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
     * @param   ChildItemsRelatedFacility $itemsRelatedFacility Object to remove from the list of results
     *
     * @return $this|ChildItemsRelatedFacilityQuery The current query, for fluid interface
     */
    public function prune($itemsRelatedFacility = null)
    {
        if ($itemsRelatedFacility) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ItemsRelatedFacilityTableMap::COL_ITEM_ID), $itemsRelatedFacility->getItemId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ItemsRelatedFacilityTableMap::COL_FACILITY_ID), $itemsRelatedFacility->getFacilityId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_items_related_facilities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsRelatedFacilityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ItemsRelatedFacilityTableMap::clearInstancePool();
            ItemsRelatedFacilityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsRelatedFacilityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ItemsRelatedFacilityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ItemsRelatedFacilityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ItemsRelatedFacilityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ItemsRelatedFacilityQuery
