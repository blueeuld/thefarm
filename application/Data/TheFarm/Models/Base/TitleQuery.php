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
use TheFarm\Models\Title as ChildTitle;
use TheFarm\Models\TitleQuery as ChildTitleQuery;
use TheFarm\Models\Map\TitleTableMap;

/**
 * Base class that represents a query for the 'tf_title' table.
 *
 *
 *
 * @method     ChildTitleQuery orderByTitleCd($order = Criteria::ASC) Order by the title_cd column
 * @method     ChildTitleQuery orderByTitleValue($order = Criteria::ASC) Order by the title_value column
 *
 * @method     ChildTitleQuery groupByTitleCd() Group by the title_cd column
 * @method     ChildTitleQuery groupByTitleValue() Group by the title_value column
 *
 * @method     ChildTitleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTitleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTitleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTitleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTitleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTitleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTitle findOne(ConnectionInterface $con = null) Return the first ChildTitle matching the query
 * @method     ChildTitle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTitle matching the query, or a new ChildTitle object populated from the query conditions when no match is found
 *
 * @method     ChildTitle findOneByTitleCd(string $title_cd) Return the first ChildTitle filtered by the title_cd column
 * @method     ChildTitle findOneByTitleValue(string $title_value) Return the first ChildTitle filtered by the title_value column *

 * @method     ChildTitle requirePk($key, ConnectionInterface $con = null) Return the ChildTitle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTitle requireOne(ConnectionInterface $con = null) Return the first ChildTitle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTitle requireOneByTitleCd(string $title_cd) Return the first ChildTitle filtered by the title_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTitle requireOneByTitleValue(string $title_value) Return the first ChildTitle filtered by the title_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTitle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTitle objects based on current ModelCriteria
 * @method     ChildTitle[]|ObjectCollection findByTitleCd(string $title_cd) Return ChildTitle objects filtered by the title_cd column
 * @method     ChildTitle[]|ObjectCollection findByTitleValue(string $title_value) Return ChildTitle objects filtered by the title_value column
 * @method     ChildTitle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TitleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\TitleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Title', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTitleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTitleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTitleQuery) {
            return $criteria;
        }
        $query = new ChildTitleQuery();
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
     * @return ChildTitle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TitleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TitleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTitle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT title_cd, title_value FROM tf_title WHERE title_cd = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTitle $obj */
            $obj = new ChildTitle();
            $obj->hydrate($row);
            TitleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTitle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTitleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TitleTableMap::COL_TITLE_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTitleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TitleTableMap::COL_TITLE_CD, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the title_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByTitleCd('fooValue');   // WHERE title_cd = 'fooValue'
     * $query->filterByTitleCd('%fooValue%', Criteria::LIKE); // WHERE title_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titleCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTitleQuery The current query, for fluid interface
     */
    public function filterByTitleCd($titleCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titleCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TitleTableMap::COL_TITLE_CD, $titleCd, $comparison);
    }

    /**
     * Filter the query on the title_value column
     *
     * Example usage:
     * <code>
     * $query->filterByTitleValue('fooValue');   // WHERE title_value = 'fooValue'
     * $query->filterByTitleValue('%fooValue%', Criteria::LIKE); // WHERE title_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titleValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTitleQuery The current query, for fluid interface
     */
    public function filterByTitleValue($titleValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titleValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TitleTableMap::COL_TITLE_VALUE, $titleValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTitle $title Object to remove from the list of results
     *
     * @return $this|ChildTitleQuery The current query, for fluid interface
     */
    public function prune($title = null)
    {
        if ($title) {
            $this->addUsingAlias(TitleTableMap::COL_TITLE_CD, $title->getTitleCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_title table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TitleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TitleTableMap::clearInstancePool();
            TitleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TitleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TitleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TitleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TitleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TitleQuery
