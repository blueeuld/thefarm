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
use TheFarm\Models\Categories as ChildCategories;
use TheFarm\Models\CategoriesQuery as ChildCategoriesQuery;
use TheFarm\Models\Map\CategoriesTableMap;

/**
 * Base class that represents a query for the 'tf_categories' table.
 *
 *
 *
 * @method     ChildCategoriesQuery orderByCatId($order = Criteria::ASC) Order by the cat_id column
 * @method     ChildCategoriesQuery orderByCatName($order = Criteria::ASC) Order by the cat_name column
 * @method     ChildCategoriesQuery orderByCatImage($order = Criteria::ASC) Order by the cat_image column
 * @method     ChildCategoriesQuery orderByCatBody($order = Criteria::ASC) Order by the cat_body column
 * @method     ChildCategoriesQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method     ChildCategoriesQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildCategoriesQuery orderByCatBgColor($order = Criteria::ASC) Order by the cat_bg_color column
 *
 * @method     ChildCategoriesQuery groupByCatId() Group by the cat_id column
 * @method     ChildCategoriesQuery groupByCatName() Group by the cat_name column
 * @method     ChildCategoriesQuery groupByCatImage() Group by the cat_image column
 * @method     ChildCategoriesQuery groupByCatBody() Group by the cat_body column
 * @method     ChildCategoriesQuery groupByParentId() Group by the parent_id column
 * @method     ChildCategoriesQuery groupByLocationId() Group by the location_id column
 * @method     ChildCategoriesQuery groupByCatBgColor() Group by the cat_bg_color column
 *
 * @method     ChildCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategoriesQuery leftJoinFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Files relation
 * @method     ChildCategoriesQuery rightJoinFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Files relation
 * @method     ChildCategoriesQuery innerJoinFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Files relation
 *
 * @method     ChildCategoriesQuery joinWithFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Files relation
 *
 * @method     ChildCategoriesQuery leftJoinWithFiles() Adds a LEFT JOIN clause and with to the query using the Files relation
 * @method     ChildCategoriesQuery rightJoinWithFiles() Adds a RIGHT JOIN clause and with to the query using the Files relation
 * @method     ChildCategoriesQuery innerJoinWithFiles() Adds a INNER JOIN clause and with to the query using the Files relation
 *
 * @method     ChildCategoriesQuery leftJoinLocations($relationAlias = null) Adds a LEFT JOIN clause to the query using the Locations relation
 * @method     ChildCategoriesQuery rightJoinLocations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Locations relation
 * @method     ChildCategoriesQuery innerJoinLocations($relationAlias = null) Adds a INNER JOIN clause to the query using the Locations relation
 *
 * @method     ChildCategoriesQuery joinWithLocations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Locations relation
 *
 * @method     ChildCategoriesQuery leftJoinWithLocations() Adds a LEFT JOIN clause and with to the query using the Locations relation
 * @method     ChildCategoriesQuery rightJoinWithLocations() Adds a RIGHT JOIN clause and with to the query using the Locations relation
 * @method     ChildCategoriesQuery innerJoinWithLocations() Adds a INNER JOIN clause and with to the query using the Locations relation
 *
 * @method     ChildCategoriesQuery leftJoinCategoriesRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoriesRelatedByParentId relation
 * @method     ChildCategoriesQuery rightJoinCategoriesRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoriesRelatedByParentId relation
 * @method     ChildCategoriesQuery innerJoinCategoriesRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoriesRelatedByParentId relation
 *
 * @method     ChildCategoriesQuery joinWithCategoriesRelatedByParentId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoriesRelatedByParentId relation
 *
 * @method     ChildCategoriesQuery leftJoinWithCategoriesRelatedByParentId() Adds a LEFT JOIN clause and with to the query using the CategoriesRelatedByParentId relation
 * @method     ChildCategoriesQuery rightJoinWithCategoriesRelatedByParentId() Adds a RIGHT JOIN clause and with to the query using the CategoriesRelatedByParentId relation
 * @method     ChildCategoriesQuery innerJoinWithCategoriesRelatedByParentId() Adds a INNER JOIN clause and with to the query using the CategoriesRelatedByParentId relation
 *
 * @method     ChildCategoriesQuery leftJoinCategoriesRelatedByCatId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoriesRelatedByCatId relation
 * @method     ChildCategoriesQuery rightJoinCategoriesRelatedByCatId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoriesRelatedByCatId relation
 * @method     ChildCategoriesQuery innerJoinCategoriesRelatedByCatId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoriesRelatedByCatId relation
 *
 * @method     ChildCategoriesQuery joinWithCategoriesRelatedByCatId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoriesRelatedByCatId relation
 *
 * @method     ChildCategoriesQuery leftJoinWithCategoriesRelatedByCatId() Adds a LEFT JOIN clause and with to the query using the CategoriesRelatedByCatId relation
 * @method     ChildCategoriesQuery rightJoinWithCategoriesRelatedByCatId() Adds a RIGHT JOIN clause and with to the query using the CategoriesRelatedByCatId relation
 * @method     ChildCategoriesQuery innerJoinWithCategoriesRelatedByCatId() Adds a INNER JOIN clause and with to the query using the CategoriesRelatedByCatId relation
 *
 * @method     ChildCategoriesQuery leftJoinItemCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemCategories relation
 * @method     ChildCategoriesQuery rightJoinItemCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemCategories relation
 * @method     ChildCategoriesQuery innerJoinItemCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemCategories relation
 *
 * @method     ChildCategoriesQuery joinWithItemCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemCategories relation
 *
 * @method     ChildCategoriesQuery leftJoinWithItemCategories() Adds a LEFT JOIN clause and with to the query using the ItemCategories relation
 * @method     ChildCategoriesQuery rightJoinWithItemCategories() Adds a RIGHT JOIN clause and with to the query using the ItemCategories relation
 * @method     ChildCategoriesQuery innerJoinWithItemCategories() Adds a INNER JOIN clause and with to the query using the ItemCategories relation
 *
 * @method     \TheFarm\Models\FilesQuery|\TheFarm\Models\LocationsQuery|\TheFarm\Models\CategoriesQuery|\TheFarm\Models\ItemCategoriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategories findOne(ConnectionInterface $con = null) Return the first ChildCategories matching the query
 * @method     ChildCategories findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategories matching the query, or a new ChildCategories object populated from the query conditions when no match is found
 *
 * @method     ChildCategories findOneByCatId(int $cat_id) Return the first ChildCategories filtered by the cat_id column
 * @method     ChildCategories findOneByCatName(string $cat_name) Return the first ChildCategories filtered by the cat_name column
 * @method     ChildCategories findOneByCatImage(int $cat_image) Return the first ChildCategories filtered by the cat_image column
 * @method     ChildCategories findOneByCatBody(string $cat_body) Return the first ChildCategories filtered by the cat_body column
 * @method     ChildCategories findOneByParentId(int $parent_id) Return the first ChildCategories filtered by the parent_id column
 * @method     ChildCategories findOneByLocationId(int $location_id) Return the first ChildCategories filtered by the location_id column
 * @method     ChildCategories findOneByCatBgColor(string $cat_bg_color) Return the first ChildCategories filtered by the cat_bg_color column *

 * @method     ChildCategories requirePk($key, ConnectionInterface $con = null) Return the ChildCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOne(ConnectionInterface $con = null) Return the first ChildCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories requireOneByCatId(int $cat_id) Return the first ChildCategories filtered by the cat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCatName(string $cat_name) Return the first ChildCategories filtered by the cat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCatImage(int $cat_image) Return the first ChildCategories filtered by the cat_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCatBody(string $cat_body) Return the first ChildCategories filtered by the cat_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByParentId(int $parent_id) Return the first ChildCategories filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByLocationId(int $location_id) Return the first ChildCategories filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCatBgColor(string $cat_bg_color) Return the first ChildCategories filtered by the cat_bg_color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategories objects based on current ModelCriteria
 * @method     ChildCategories[]|ObjectCollection findByCatId(int $cat_id) Return ChildCategories objects filtered by the cat_id column
 * @method     ChildCategories[]|ObjectCollection findByCatName(string $cat_name) Return ChildCategories objects filtered by the cat_name column
 * @method     ChildCategories[]|ObjectCollection findByCatImage(int $cat_image) Return ChildCategories objects filtered by the cat_image column
 * @method     ChildCategories[]|ObjectCollection findByCatBody(string $cat_body) Return ChildCategories objects filtered by the cat_body column
 * @method     ChildCategories[]|ObjectCollection findByParentId(int $parent_id) Return ChildCategories objects filtered by the parent_id column
 * @method     ChildCategories[]|ObjectCollection findByLocationId(int $location_id) Return ChildCategories objects filtered by the location_id column
 * @method     ChildCategories[]|ObjectCollection findByCatBgColor(string $cat_bg_color) Return ChildCategories objects filtered by the cat_bg_color column
 * @method     ChildCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\CategoriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Categories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildCategoriesQuery();
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT cat_id, cat_name, cat_image, cat_body, parent_id, location_id, cat_bg_color FROM tf_categories WHERE cat_id = :p0';
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
            /** @var ChildCategories $obj */
            $obj = new ChildCategories();
            $obj->hydrate($row);
            CategoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCatId(1234); // WHERE cat_id = 1234
     * $query->filterByCatId(array(12, 34)); // WHERE cat_id IN (12, 34)
     * $query->filterByCatId(array('min' => 12)); // WHERE cat_id > 12
     * </code>
     *
     * @param     mixed $catId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCatId($catId = null, $comparison = null)
    {
        if (is_array($catId)) {
            $useMinMax = false;
            if (isset($catId['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $catId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($catId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $catId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $catId, $comparison);
    }

    /**
     * Filter the query on the cat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCatName('fooValue');   // WHERE cat_name = 'fooValue'
     * $query->filterByCatName('%fooValue%', Criteria::LIKE); // WHERE cat_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $catName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCatName($catName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_NAME, $catName, $comparison);
    }

    /**
     * Filter the query on the cat_image column
     *
     * Example usage:
     * <code>
     * $query->filterByCatImage(1234); // WHERE cat_image = 1234
     * $query->filterByCatImage(array(12, 34)); // WHERE cat_image IN (12, 34)
     * $query->filterByCatImage(array('min' => 12)); // WHERE cat_image > 12
     * </code>
     *
     * @see       filterByFiles()
     *
     * @param     mixed $catImage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCatImage($catImage = null, $comparison = null)
    {
        if (is_array($catImage)) {
            $useMinMax = false;
            if (isset($catImage['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CAT_IMAGE, $catImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($catImage['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CAT_IMAGE, $catImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_IMAGE, $catImage, $comparison);
    }

    /**
     * Filter the query on the cat_body column
     *
     * Example usage:
     * <code>
     * $query->filterByCatBody('fooValue');   // WHERE cat_body = 'fooValue'
     * $query->filterByCatBody('%fooValue%', Criteria::LIKE); // WHERE cat_body LIKE '%fooValue%'
     * </code>
     *
     * @param     string $catBody The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCatBody($catBody = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catBody)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_BODY, $catBody, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @see       filterByCategoriesRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the location_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE location_id = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE location_id IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE location_id > 12
     * </code>
     *
     * @see       filterByLocations()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the cat_bg_color column
     *
     * Example usage:
     * <code>
     * $query->filterByCatBgColor('fooValue');   // WHERE cat_bg_color = 'fooValue'
     * $query->filterByCatBgColor('%fooValue%', Criteria::LIKE); // WHERE cat_bg_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $catBgColor The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCatBgColor($catBgColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catBgColor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriesTableMap::COL_CAT_BG_COLOR, $catBgColor, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Files object
     *
     * @param \TheFarm\Models\Files|ObjectCollection $files The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByFiles($files, $comparison = null)
    {
        if ($files instanceof \TheFarm\Models\Files) {
            return $this
                ->addUsingAlias(CategoriesTableMap::COL_CAT_IMAGE, $files->getFileId(), $comparison);
        } elseif ($files instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoriesTableMap::COL_CAT_IMAGE, $files->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\Locations object
     *
     * @param \TheFarm\Models\Locations|ObjectCollection $locations The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByLocations($locations, $comparison = null)
    {
        if ($locations instanceof \TheFarm\Models\Locations) {
            return $this
                ->addUsingAlias(CategoriesTableMap::COL_LOCATION_ID, $locations->getLocationId(), $comparison);
        } elseif ($locations instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoriesTableMap::COL_LOCATION_ID, $locations->toKeyValue('PrimaryKey', 'LocationId'), $comparison);
        } else {
            throw new PropelException('filterByLocations() only accepts arguments of type \TheFarm\Models\Locations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Locations relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function joinLocations($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Locations');

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
            $this->addJoinObject($join, 'Locations');
        }

        return $this;
    }

    /**
     * Use the Locations relation Locations object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\LocationsQuery A secondary query class using the current class as primary query
     */
    public function useLocationsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Locations', '\TheFarm\Models\LocationsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Categories object
     *
     * @param \TheFarm\Models\Categories|ObjectCollection $categories The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCategoriesRelatedByParentId($categories, $comparison = null)
    {
        if ($categories instanceof \TheFarm\Models\Categories) {
            return $this
                ->addUsingAlias(CategoriesTableMap::COL_PARENT_ID, $categories->getCatId(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoriesTableMap::COL_PARENT_ID, $categories->toKeyValue('PrimaryKey', 'CatId'), $comparison);
        } else {
            throw new PropelException('filterByCategoriesRelatedByParentId() only accepts arguments of type \TheFarm\Models\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoriesRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function joinCategoriesRelatedByParentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoriesRelatedByParentId');

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
            $this->addJoinObject($join, 'CategoriesRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the CategoriesRelatedByParentId relation Categories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoriesRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoriesRelatedByParentId', '\TheFarm\Models\CategoriesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Categories object
     *
     * @param \TheFarm\Models\Categories|ObjectCollection $categories the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByCategoriesRelatedByCatId($categories, $comparison = null)
    {
        if ($categories instanceof \TheFarm\Models\Categories) {
            return $this
                ->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $categories->getParentId(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            return $this
                ->useCategoriesRelatedByCatIdQuery()
                ->filterByPrimaryKeys($categories->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoriesRelatedByCatId() only accepts arguments of type \TheFarm\Models\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoriesRelatedByCatId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function joinCategoriesRelatedByCatId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoriesRelatedByCatId');

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
            $this->addJoinObject($join, 'CategoriesRelatedByCatId');
        }

        return $this;
    }

    /**
     * Use the CategoriesRelatedByCatId relation Categories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesRelatedByCatIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoriesRelatedByCatId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoriesRelatedByCatId', '\TheFarm\Models\CategoriesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemCategories object
     *
     * @param \TheFarm\Models\ItemCategories|ObjectCollection $itemCategories the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoriesQuery The current query, for fluid interface
     */
    public function filterByItemCategories($itemCategories, $comparison = null)
    {
        if ($itemCategories instanceof \TheFarm\Models\ItemCategories) {
            return $this
                ->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $itemCategories->getCategoryId(), $comparison);
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
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCategories $categories Object to remove from the list of results
     *
     * @return $this|ChildCategoriesQuery The current query, for fluid interface
     */
    public function prune($categories = null)
    {
        if ($categories) {
            $this->addUsingAlias(CategoriesTableMap::COL_CAT_ID, $categories->getCatId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoriesTableMap::clearInstancePool();
            CategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoriesQuery
