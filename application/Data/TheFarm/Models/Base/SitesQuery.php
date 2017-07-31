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
use TheFarm\Models\Sites as ChildSites;
use TheFarm\Models\SitesQuery as ChildSitesQuery;
use TheFarm\Models\Map\SitesTableMap;

/**
 * Base class that represents a query for the 'tf_sites' table.
 *
 *
 *
 * @method     ChildSitesQuery orderBySiteId($order = Criteria::ASC) Order by the site_id column
 * @method     ChildSitesQuery orderBySiteTitle($order = Criteria::ASC) Order by the site_title column
 * @method     ChildSitesQuery orderBySiteSystemPreferences($order = Criteria::ASC) Order by the site_system_preferences column
 *
 * @method     ChildSitesQuery groupBySiteId() Group by the site_id column
 * @method     ChildSitesQuery groupBySiteTitle() Group by the site_title column
 * @method     ChildSitesQuery groupBySiteSystemPreferences() Group by the site_system_preferences column
 *
 * @method     ChildSitesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSitesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSitesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSitesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSitesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSitesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSites findOne(ConnectionInterface $con = null) Return the first ChildSites matching the query
 * @method     ChildSites findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSites matching the query, or a new ChildSites object populated from the query conditions when no match is found
 *
 * @method     ChildSites findOneBySiteId(int $site_id) Return the first ChildSites filtered by the site_id column
 * @method     ChildSites findOneBySiteTitle(string $site_title) Return the first ChildSites filtered by the site_title column
 * @method     ChildSites findOneBySiteSystemPreferences(string $site_system_preferences) Return the first ChildSites filtered by the site_system_preferences column *

 * @method     ChildSites requirePk($key, ConnectionInterface $con = null) Return the ChildSites by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSites requireOne(ConnectionInterface $con = null) Return the first ChildSites matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSites requireOneBySiteId(int $site_id) Return the first ChildSites filtered by the site_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSites requireOneBySiteTitle(string $site_title) Return the first ChildSites filtered by the site_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSites requireOneBySiteSystemPreferences(string $site_system_preferences) Return the first ChildSites filtered by the site_system_preferences column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSites[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSites objects based on current ModelCriteria
 * @method     ChildSites[]|ObjectCollection findBySiteId(int $site_id) Return ChildSites objects filtered by the site_id column
 * @method     ChildSites[]|ObjectCollection findBySiteTitle(string $site_title) Return ChildSites objects filtered by the site_title column
 * @method     ChildSites[]|ObjectCollection findBySiteSystemPreferences(string $site_system_preferences) Return ChildSites objects filtered by the site_system_preferences column
 * @method     ChildSites[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SitesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\SitesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Sites', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSitesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSitesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSitesQuery) {
            return $criteria;
        }
        $query = new ChildSitesQuery();
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
     * @return ChildSites|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SitesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SitesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSites A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT site_id, site_title, site_system_preferences FROM tf_sites WHERE site_id = :p0';
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
            /** @var ChildSites $obj */
            $obj = new ChildSites();
            $obj->hydrate($row);
            SitesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSites|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the site_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySiteId(1234); // WHERE site_id = 1234
     * $query->filterBySiteId(array(12, 34)); // WHERE site_id IN (12, 34)
     * $query->filterBySiteId(array('min' => 12)); // WHERE site_id > 12
     * </code>
     *
     * @param     mixed $siteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function filterBySiteId($siteId = null, $comparison = null)
    {
        if (is_array($siteId)) {
            $useMinMax = false;
            if (isset($siteId['min'])) {
                $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $siteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteId['max'])) {
                $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $siteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $siteId, $comparison);
    }

    /**
     * Filter the query on the site_title column
     *
     * Example usage:
     * <code>
     * $query->filterBySiteTitle('fooValue');   // WHERE site_title = 'fooValue'
     * $query->filterBySiteTitle('%fooValue%', Criteria::LIKE); // WHERE site_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $siteTitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function filterBySiteTitle($siteTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($siteTitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitesTableMap::COL_SITE_TITLE, $siteTitle, $comparison);
    }

    /**
     * Filter the query on the site_system_preferences column
     *
     * Example usage:
     * <code>
     * $query->filterBySiteSystemPreferences('fooValue');   // WHERE site_system_preferences = 'fooValue'
     * $query->filterBySiteSystemPreferences('%fooValue%', Criteria::LIKE); // WHERE site_system_preferences LIKE '%fooValue%'
     * </code>
     *
     * @param     string $siteSystemPreferences The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function filterBySiteSystemPreferences($siteSystemPreferences = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($siteSystemPreferences)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SitesTableMap::COL_SITE_SYSTEM_PREFERENCES, $siteSystemPreferences, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSites $sites Object to remove from the list of results
     *
     * @return $this|ChildSitesQuery The current query, for fluid interface
     */
    public function prune($sites = null)
    {
        if ($sites) {
            $this->addUsingAlias(SitesTableMap::COL_SITE_ID, $sites->getSiteId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_sites table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SitesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SitesTableMap::clearInstancePool();
            SitesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SitesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SitesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SitesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SitesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SitesQuery
