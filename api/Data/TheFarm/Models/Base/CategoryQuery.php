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
use TheFarm\Models\Category as ChildCategory;
use TheFarm\Models\CategoryQuery as ChildCategoryQuery;
use TheFarm\Models\Map\CategoryTableMap;

/**
 * Base class that represents a query for the 'tf_categories' table.
 *
 *
 *
 * @method     ChildCategoryQuery orderByCatId($order = Criteria::ASC) Order by the cat_id column
 * @method     ChildCategoryQuery orderByCatName($order = Criteria::ASC) Order by the cat_name column
 * @method     ChildCategoryQuery orderByCatImage($order = Criteria::ASC) Order by the cat_image column
 * @method     ChildCategoryQuery orderByCatBody($order = Criteria::ASC) Order by the cat_body column
 * @method     ChildCategoryQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method     ChildCategoryQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildCategoryQuery orderByCatBgColor($order = Criteria::ASC) Order by the cat_bg_color column
 *
 * @method     ChildCategoryQuery groupByCatId() Group by the cat_id column
 * @method     ChildCategoryQuery groupByCatName() Group by the cat_name column
 * @method     ChildCategoryQuery groupByCatImage() Group by the cat_image column
 * @method     ChildCategoryQuery groupByCatBody() Group by the cat_body column
 * @method     ChildCategoryQuery groupByParentId() Group by the parent_id column
 * @method     ChildCategoryQuery groupByLocationId() Group by the location_id column
 * @method     ChildCategoryQuery groupByCatBgColor() Group by the cat_bg_color column
 *
 * @method     ChildCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategoryQuery leftJoinFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Files relation
 * @method     ChildCategoryQuery rightJoinFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Files relation
 * @method     ChildCategoryQuery innerJoinFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Files relation
 *
 * @method     ChildCategoryQuery joinWithFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Files relation
 *
 * @method     ChildCategoryQuery leftJoinWithFiles() Adds a LEFT JOIN clause and with to the query using the Files relation
 * @method     ChildCategoryQuery rightJoinWithFiles() Adds a RIGHT JOIN clause and with to the query using the Files relation
 * @method     ChildCategoryQuery innerJoinWithFiles() Adds a INNER JOIN clause and with to the query using the Files relation
 *
 * @method     ChildCategoryQuery leftJoinLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Location relation
 * @method     ChildCategoryQuery rightJoinLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Location relation
 * @method     ChildCategoryQuery innerJoinLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Location relation
 *
 * @method     ChildCategoryQuery joinWithLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Location relation
 *
 * @method     ChildCategoryQuery leftJoinWithLocation() Adds a LEFT JOIN clause and with to the query using the Location relation
 * @method     ChildCategoryQuery rightJoinWithLocation() Adds a RIGHT JOIN clause and with to the query using the Location relation
 * @method     ChildCategoryQuery innerJoinWithLocation() Adds a INNER JOIN clause and with to the query using the Location relation
 *
 * @method     ChildCategoryQuery leftJoinCategoryRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryRelatedByParentId relation
 * @method     ChildCategoryQuery rightJoinCategoryRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryRelatedByParentId relation
 * @method     ChildCategoryQuery innerJoinCategoryRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryRelatedByParentId relation
 *
 * @method     ChildCategoryQuery joinWithCategoryRelatedByParentId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoryRelatedByParentId relation
 *
 * @method     ChildCategoryQuery leftJoinWithCategoryRelatedByParentId() Adds a LEFT JOIN clause and with to the query using the CategoryRelatedByParentId relation
 * @method     ChildCategoryQuery rightJoinWithCategoryRelatedByParentId() Adds a RIGHT JOIN clause and with to the query using the CategoryRelatedByParentId relation
 * @method     ChildCategoryQuery innerJoinWithCategoryRelatedByParentId() Adds a INNER JOIN clause and with to the query using the CategoryRelatedByParentId relation
 *
 * @method     ChildCategoryQuery leftJoinCategoryRelatedByCatId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryRelatedByCatId relation
 * @method     ChildCategoryQuery rightJoinCategoryRelatedByCatId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryRelatedByCatId relation
 * @method     ChildCategoryQuery innerJoinCategoryRelatedByCatId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryRelatedByCatId relation
 *
 * @method     ChildCategoryQuery joinWithCategoryRelatedByCatId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoryRelatedByCatId relation
 *
 * @method     ChildCategoryQuery leftJoinWithCategoryRelatedByCatId() Adds a LEFT JOIN clause and with to the query using the CategoryRelatedByCatId relation
 * @method     ChildCategoryQuery rightJoinWithCategoryRelatedByCatId() Adds a RIGHT JOIN clause and with to the query using the CategoryRelatedByCatId relation
 * @method     ChildCategoryQuery innerJoinWithCategoryRelatedByCatId() Adds a INNER JOIN clause and with to the query using the CategoryRelatedByCatId relation
 *
 * @method     ChildCategoryQuery leftJoinItemCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemCategory relation
 * @method     ChildCategoryQuery rightJoinItemCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemCategory relation
 * @method     ChildCategoryQuery innerJoinItemCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemCategory relation
 *
 * @method     ChildCategoryQuery joinWithItemCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemCategory relation
 *
 * @method     ChildCategoryQuery leftJoinWithItemCategory() Adds a LEFT JOIN clause and with to the query using the ItemCategory relation
 * @method     ChildCategoryQuery rightJoinWithItemCategory() Adds a RIGHT JOIN clause and with to the query using the ItemCategory relation
 * @method     ChildCategoryQuery innerJoinWithItemCategory() Adds a INNER JOIN clause and with to the query using the ItemCategory relation
 *
 * @method     \TheFarm\Models\FilesQuery|\TheFarm\Models\LocationQuery|\TheFarm\Models\CategoryQuery|\TheFarm\Models\ItemCategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategory findOne(ConnectionInterface $con = null) Return the first ChildCategory matching the query
 * @method     ChildCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategory matching the query, or a new ChildCategory object populated from the query conditions when no match is found
 *
 * @method     ChildCategory findOneByCatId(int $cat_id) Return the first ChildCategory filtered by the cat_id column
 * @method     ChildCategory findOneByCatName(string $cat_name) Return the first ChildCategory filtered by the cat_name column
 * @method     ChildCategory findOneByCatImage(int $cat_image) Return the first ChildCategory filtered by the cat_image column
 * @method     ChildCategory findOneByCatBody(string $cat_body) Return the first ChildCategory filtered by the cat_body column
 * @method     ChildCategory findOneByParentId(int $parent_id) Return the first ChildCategory filtered by the parent_id column
 * @method     ChildCategory findOneByLocationId(int $location_id) Return the first ChildCategory filtered by the location_id column
 * @method     ChildCategory findOneByCatBgColor(string $cat_bg_color) Return the first ChildCategory filtered by the cat_bg_color column *

 * @method     ChildCategory requirePk($key, ConnectionInterface $con = null) Return the ChildCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOne(ConnectionInterface $con = null) Return the first ChildCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategory requireOneByCatId(int $cat_id) Return the first ChildCategory filtered by the cat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByCatName(string $cat_name) Return the first ChildCategory filtered by the cat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByCatImage(int $cat_image) Return the first ChildCategory filtered by the cat_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByCatBody(string $cat_body) Return the first ChildCategory filtered by the cat_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByParentId(int $parent_id) Return the first ChildCategory filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByLocationId(int $location_id) Return the first ChildCategory filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByCatBgColor(string $cat_bg_color) Return the first ChildCategory filtered by the cat_bg_color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategory objects based on current ModelCriteria
 * @method     ChildCategory[]|ObjectCollection findByCatId(int $cat_id) Return ChildCategory objects filtered by the cat_id column
 * @method     ChildCategory[]|ObjectCollection findByCatName(string $cat_name) Return ChildCategory objects filtered by the cat_name column
 * @method     ChildCategory[]|ObjectCollection findByCatImage(int $cat_image) Return ChildCategory objects filtered by the cat_image column
 * @method     ChildCategory[]|ObjectCollection findByCatBody(string $cat_body) Return ChildCategory objects filtered by the cat_body column
 * @method     ChildCategory[]|ObjectCollection findByParentId(int $parent_id) Return ChildCategory objects filtered by the parent_id column
 * @method     ChildCategory[]|ObjectCollection findByLocationId(int $location_id) Return ChildCategory objects filtered by the location_id column
 * @method     ChildCategory[]|ObjectCollection findByCatBgColor(string $cat_bg_color) Return ChildCategory objects filtered by the cat_bg_color column
 * @method     ChildCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\CategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Category', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoryQuery) {
            return $criteria;
        }
        $query = new ChildCategoryQuery();
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
     * @return ChildCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCategory A model object, or null if the key is not found
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
            /** @var ChildCategory $obj */
            $obj = new ChildCategory();
            $obj->hydrate($row);
            CategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCategory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCatId($catId = null, $comparison = null)
    {
        if (is_array($catId)) {
            $useMinMax = false;
            if (isset($catId['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $catId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($catId['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $catId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $catId, $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCatName($catName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_NAME, $catName, $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCatImage($catImage = null, $comparison = null)
    {
        if (is_array($catImage)) {
            $useMinMax = false;
            if (isset($catImage['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_CAT_IMAGE, $catImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($catImage['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_CAT_IMAGE, $catImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_IMAGE, $catImage, $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCatBody($catBody = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catBody)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_BODY, $catBody, $comparison);
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
     * @see       filterByCategoryRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_PARENT_ID, $parentId, $comparison);
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
     * @see       filterByLocation()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_LOCATION_ID, $locationId, $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCatBgColor($catBgColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($catBgColor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_CAT_BG_COLOR, $catBgColor, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Files object
     *
     * @param \TheFarm\Models\Files|ObjectCollection $files The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByFiles($files, $comparison = null)
    {
        if ($files instanceof \TheFarm\Models\Files) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_CAT_IMAGE, $files->getFileId(), $comparison);
        } elseif ($files instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryTableMap::COL_CAT_IMAGE, $files->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\Location object
     *
     * @param \TheFarm\Models\Location|ObjectCollection $location The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = null)
    {
        if ($location instanceof \TheFarm\Models\Location) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_LOCATION_ID, $location->getLocationId(), $comparison);
        } elseif ($location instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryTableMap::COL_LOCATION_ID, $location->toKeyValue('PrimaryKey', 'LocationId'), $comparison);
        } else {
            throw new PropelException('filterByLocation() only accepts arguments of type \TheFarm\Models\Location or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Location relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function joinLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Location');

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
            $this->addJoinObject($join, 'Location');
        }

        return $this;
    }

    /**
     * Use the Location relation Location object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\LocationQuery A secondary query class using the current class as primary query
     */
    public function useLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Location', '\TheFarm\Models\LocationQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Category object
     *
     * @param \TheFarm\Models\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryRelatedByParentId($category, $comparison = null)
    {
        if ($category instanceof \TheFarm\Models\Category) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_PARENT_ID, $category->getCatId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryTableMap::COL_PARENT_ID, $category->toKeyValue('PrimaryKey', 'CatId'), $comparison);
        } else {
            throw new PropelException('filterByCategoryRelatedByParentId() only accepts arguments of type \TheFarm\Models\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function joinCategoryRelatedByParentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryRelatedByParentId');

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
            $this->addJoinObject($join, 'CategoryRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the CategoryRelatedByParentId relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryRelatedByParentId', '\TheFarm\Models\CategoryQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Category object
     *
     * @param \TheFarm\Models\Category|ObjectCollection $category the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryRelatedByCatId($category, $comparison = null)
    {
        if ($category instanceof \TheFarm\Models\Category) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_CAT_ID, $category->getParentId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            return $this
                ->useCategoryRelatedByCatIdQuery()
                ->filterByPrimaryKeys($category->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryRelatedByCatId() only accepts arguments of type \TheFarm\Models\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryRelatedByCatId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function joinCategoryRelatedByCatId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryRelatedByCatId');

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
            $this->addJoinObject($join, 'CategoryRelatedByCatId');
        }

        return $this;
    }

    /**
     * Use the CategoryRelatedByCatId relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryRelatedByCatIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryRelatedByCatId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryRelatedByCatId', '\TheFarm\Models\CategoryQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemCategory object
     *
     * @param \TheFarm\Models\ItemCategory|ObjectCollection $itemCategory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByItemCategory($itemCategory, $comparison = null)
    {
        if ($itemCategory instanceof \TheFarm\Models\ItemCategory) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_CAT_ID, $itemCategory->getCategoryId(), $comparison);
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
     * @return $this|ChildCategoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCategory $category Object to remove from the list of results
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function prune($category = null)
    {
        if ($category) {
            $this->addUsingAlias(CategoryTableMap::COL_CAT_ID, $category->getCatId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoryTableMap::clearInstancePool();
            CategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoryQuery
