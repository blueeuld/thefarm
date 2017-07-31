<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\ItemsRelatedForms as ChildItemsRelatedForms;
use TheFarm\Models\ItemsRelatedFormsQuery as ChildItemsRelatedFormsQuery;
use TheFarm\Models\Map\ItemsRelatedFormsTableMap;

/**
 * Base class that represents a query for the 'tf_items_related_forms' table.
 *
 *
 *
 * @method     ChildItemsRelatedFormsQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildItemsRelatedFormsQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 *
 * @method     ChildItemsRelatedFormsQuery groupByFormId() Group by the form_id column
 * @method     ChildItemsRelatedFormsQuery groupByItemId() Group by the item_id column
 *
 * @method     ChildItemsRelatedFormsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildItemsRelatedFormsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildItemsRelatedFormsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildItemsRelatedFormsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildItemsRelatedFormsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildItemsRelatedFormsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildItemsRelatedForms findOne(ConnectionInterface $con = null) Return the first ChildItemsRelatedForms matching the query
 * @method     ChildItemsRelatedForms findOneOrCreate(ConnectionInterface $con = null) Return the first ChildItemsRelatedForms matching the query, or a new ChildItemsRelatedForms object populated from the query conditions when no match is found
 *
 * @method     ChildItemsRelatedForms findOneByFormId(int $form_id) Return the first ChildItemsRelatedForms filtered by the form_id column
 * @method     ChildItemsRelatedForms findOneByItemId(string $item_id) Return the first ChildItemsRelatedForms filtered by the item_id column *

 * @method     ChildItemsRelatedForms requirePk($key, ConnectionInterface $con = null) Return the ChildItemsRelatedForms by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemsRelatedForms requireOne(ConnectionInterface $con = null) Return the first ChildItemsRelatedForms matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemsRelatedForms requireOneByFormId(int $form_id) Return the first ChildItemsRelatedForms filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildItemsRelatedForms requireOneByItemId(string $item_id) Return the first ChildItemsRelatedForms filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildItemsRelatedForms[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildItemsRelatedForms objects based on current ModelCriteria
 * @method     ChildItemsRelatedForms[]|ObjectCollection findByFormId(int $form_id) Return ChildItemsRelatedForms objects filtered by the form_id column
 * @method     ChildItemsRelatedForms[]|ObjectCollection findByItemId(string $item_id) Return ChildItemsRelatedForms objects filtered by the item_id column
 * @method     ChildItemsRelatedForms[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ItemsRelatedFormsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ItemsRelatedFormsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\ItemsRelatedForms', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildItemsRelatedFormsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildItemsRelatedFormsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildItemsRelatedFormsQuery) {
            return $criteria;
        }
        $query = new ChildItemsRelatedFormsQuery();
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
     * @param array[$form_id, $item_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildItemsRelatedForms|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ItemsRelatedFormsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ItemsRelatedFormsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildItemsRelatedForms A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT form_id, item_id FROM tf_items_related_forms WHERE form_id = :p0 AND item_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildItemsRelatedForms $obj */
            $obj = new ChildItemsRelatedForms();
            $obj->hydrate($row);
            ItemsRelatedFormsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildItemsRelatedForms|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildItemsRelatedFormsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_FORM_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_ITEM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildItemsRelatedFormsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ItemsRelatedFormsTableMap::COL_FORM_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ItemsRelatedFormsTableMap::COL_ITEM_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormId(1234); // WHERE form_id = 1234
     * $query->filterByFormId(array(12, 34)); // WHERE form_id IN (12, 34)
     * $query->filterByFormId(array('min' => 12)); // WHERE form_id > 12
     * </code>
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemsRelatedFormsQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId('fooValue');   // WHERE item_id = 'fooValue'
     * $query->filterByItemId('%fooValue%', Criteria::LIKE); // WHERE item_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $itemId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildItemsRelatedFormsQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itemId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemsRelatedFormsTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildItemsRelatedForms $itemsRelatedForms Object to remove from the list of results
     *
     * @return $this|ChildItemsRelatedFormsQuery The current query, for fluid interface
     */
    public function prune($itemsRelatedForms = null)
    {
        if ($itemsRelatedForms) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ItemsRelatedFormsTableMap::COL_FORM_ID), $itemsRelatedForms->getFormId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ItemsRelatedFormsTableMap::COL_ITEM_ID), $itemsRelatedForms->getItemId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_items_related_forms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsRelatedFormsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ItemsRelatedFormsTableMap::clearInstancePool();
            ItemsRelatedFormsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemsRelatedFormsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ItemsRelatedFormsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ItemsRelatedFormsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ItemsRelatedFormsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ItemsRelatedFormsQuery