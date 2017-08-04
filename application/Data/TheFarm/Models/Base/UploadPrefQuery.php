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
use TheFarm\Models\UploadPref as ChildUploadPref;
use TheFarm\Models\UploadPrefQuery as ChildUploadPrefQuery;
use TheFarm\Models\Map\UploadPrefTableMap;

/**
 * Base class that represents a query for the 'tf_upload_prefs' table.
 *
 *
 *
 * @method     ChildUploadPrefQuery orderByUploadId($order = Criteria::ASC) Order by the upload_id column
 * @method     ChildUploadPrefQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUploadPrefQuery orderByMaxSize($order = Criteria::ASC) Order by the max_size column
 * @method     ChildUploadPrefQuery orderByMaxHeight($order = Criteria::ASC) Order by the max_height column
 * @method     ChildUploadPrefQuery orderByMaxWidth($order = Criteria::ASC) Order by the max_width column
 * @method     ChildUploadPrefQuery orderByUploadPath($order = Criteria::ASC) Order by the upload_path column
 * @method     ChildUploadPrefQuery orderByAllowedTypes($order = Criteria::ASC) Order by the allowed_types column
 * @method     ChildUploadPrefQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildUploadPrefQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 *
 * @method     ChildUploadPrefQuery groupByUploadId() Group by the upload_id column
 * @method     ChildUploadPrefQuery groupByName() Group by the name column
 * @method     ChildUploadPrefQuery groupByMaxSize() Group by the max_size column
 * @method     ChildUploadPrefQuery groupByMaxHeight() Group by the max_height column
 * @method     ChildUploadPrefQuery groupByMaxWidth() Group by the max_width column
 * @method     ChildUploadPrefQuery groupByUploadPath() Group by the upload_path column
 * @method     ChildUploadPrefQuery groupByAllowedTypes() Group by the allowed_types column
 * @method     ChildUploadPrefQuery groupByUrl() Group by the url column
 * @method     ChildUploadPrefQuery groupByLocationId() Group by the location_id column
 *
 * @method     ChildUploadPrefQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUploadPrefQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUploadPrefQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUploadPrefQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUploadPrefQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUploadPrefQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUploadPref findOne(ConnectionInterface $con = null) Return the first ChildUploadPref matching the query
 * @method     ChildUploadPref findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUploadPref matching the query, or a new ChildUploadPref object populated from the query conditions when no match is found
 *
 * @method     ChildUploadPref findOneByUploadId(int $upload_id) Return the first ChildUploadPref filtered by the upload_id column
 * @method     ChildUploadPref findOneByName(string $name) Return the first ChildUploadPref filtered by the name column
 * @method     ChildUploadPref findOneByMaxSize(int $max_size) Return the first ChildUploadPref filtered by the max_size column
 * @method     ChildUploadPref findOneByMaxHeight(int $max_height) Return the first ChildUploadPref filtered by the max_height column
 * @method     ChildUploadPref findOneByMaxWidth(int $max_width) Return the first ChildUploadPref filtered by the max_width column
 * @method     ChildUploadPref findOneByUploadPath(string $upload_path) Return the first ChildUploadPref filtered by the upload_path column
 * @method     ChildUploadPref findOneByAllowedTypes(string $allowed_types) Return the first ChildUploadPref filtered by the allowed_types column
 * @method     ChildUploadPref findOneByUrl(string $url) Return the first ChildUploadPref filtered by the url column
 * @method     ChildUploadPref findOneByLocationId(int $location_id) Return the first ChildUploadPref filtered by the location_id column *

 * @method     ChildUploadPref requirePk($key, ConnectionInterface $con = null) Return the ChildUploadPref by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOne(ConnectionInterface $con = null) Return the first ChildUploadPref matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUploadPref requireOneByUploadId(int $upload_id) Return the first ChildUploadPref filtered by the upload_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByName(string $name) Return the first ChildUploadPref filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByMaxSize(int $max_size) Return the first ChildUploadPref filtered by the max_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByMaxHeight(int $max_height) Return the first ChildUploadPref filtered by the max_height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByMaxWidth(int $max_width) Return the first ChildUploadPref filtered by the max_width column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByUploadPath(string $upload_path) Return the first ChildUploadPref filtered by the upload_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByAllowedTypes(string $allowed_types) Return the first ChildUploadPref filtered by the allowed_types column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByUrl(string $url) Return the first ChildUploadPref filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUploadPref requireOneByLocationId(int $location_id) Return the first ChildUploadPref filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUploadPref[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUploadPref objects based on current ModelCriteria
 * @method     ChildUploadPref[]|ObjectCollection findByUploadId(int $upload_id) Return ChildUploadPref objects filtered by the upload_id column
 * @method     ChildUploadPref[]|ObjectCollection findByName(string $name) Return ChildUploadPref objects filtered by the name column
 * @method     ChildUploadPref[]|ObjectCollection findByMaxSize(int $max_size) Return ChildUploadPref objects filtered by the max_size column
 * @method     ChildUploadPref[]|ObjectCollection findByMaxHeight(int $max_height) Return ChildUploadPref objects filtered by the max_height column
 * @method     ChildUploadPref[]|ObjectCollection findByMaxWidth(int $max_width) Return ChildUploadPref objects filtered by the max_width column
 * @method     ChildUploadPref[]|ObjectCollection findByUploadPath(string $upload_path) Return ChildUploadPref objects filtered by the upload_path column
 * @method     ChildUploadPref[]|ObjectCollection findByAllowedTypes(string $allowed_types) Return ChildUploadPref objects filtered by the allowed_types column
 * @method     ChildUploadPref[]|ObjectCollection findByUrl(string $url) Return ChildUploadPref objects filtered by the url column
 * @method     ChildUploadPref[]|ObjectCollection findByLocationId(int $location_id) Return ChildUploadPref objects filtered by the location_id column
 * @method     ChildUploadPref[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UploadPrefQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\UploadPrefQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\UploadPref', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUploadPrefQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUploadPrefQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUploadPrefQuery) {
            return $criteria;
        }
        $query = new ChildUploadPrefQuery();
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
     * @return ChildUploadPref|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UploadPrefTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UploadPrefTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUploadPref A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT upload_id, name, max_size, max_height, max_width, upload_path, allowed_types, url, location_id FROM tf_upload_prefs WHERE upload_id = :p0';
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
            /** @var ChildUploadPref $obj */
            $obj = new ChildUploadPref();
            $obj->hydrate($row);
            UploadPrefTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUploadPref|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the upload_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUploadId(1234); // WHERE upload_id = 1234
     * $query->filterByUploadId(array(12, 34)); // WHERE upload_id IN (12, 34)
     * $query->filterByUploadId(array('min' => 12)); // WHERE upload_id > 12
     * </code>
     *
     * @param     mixed $uploadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByUploadId($uploadId = null, $comparison = null)
    {
        if (is_array($uploadId)) {
            $useMinMax = false;
            if (isset($uploadId['min'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $uploadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploadId['max'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $uploadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $uploadId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the max_size column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxSize(1234); // WHERE max_size = 1234
     * $query->filterByMaxSize(array(12, 34)); // WHERE max_size IN (12, 34)
     * $query->filterByMaxSize(array('min' => 12)); // WHERE max_size > 12
     * </code>
     *
     * @param     mixed $maxSize The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByMaxSize($maxSize = null, $comparison = null)
    {
        if (is_array($maxSize)) {
            $useMinMax = false;
            if (isset($maxSize['min'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_SIZE, $maxSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxSize['max'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_SIZE, $maxSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_MAX_SIZE, $maxSize, $comparison);
    }

    /**
     * Filter the query on the max_height column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxHeight(1234); // WHERE max_height = 1234
     * $query->filterByMaxHeight(array(12, 34)); // WHERE max_height IN (12, 34)
     * $query->filterByMaxHeight(array('min' => 12)); // WHERE max_height > 12
     * </code>
     *
     * @param     mixed $maxHeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByMaxHeight($maxHeight = null, $comparison = null)
    {
        if (is_array($maxHeight)) {
            $useMinMax = false;
            if (isset($maxHeight['min'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_HEIGHT, $maxHeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxHeight['max'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_HEIGHT, $maxHeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_MAX_HEIGHT, $maxHeight, $comparison);
    }

    /**
     * Filter the query on the max_width column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxWidth(1234); // WHERE max_width = 1234
     * $query->filterByMaxWidth(array(12, 34)); // WHERE max_width IN (12, 34)
     * $query->filterByMaxWidth(array('min' => 12)); // WHERE max_width > 12
     * </code>
     *
     * @param     mixed $maxWidth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByMaxWidth($maxWidth = null, $comparison = null)
    {
        if (is_array($maxWidth)) {
            $useMinMax = false;
            if (isset($maxWidth['min'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_WIDTH, $maxWidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxWidth['max'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_MAX_WIDTH, $maxWidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_MAX_WIDTH, $maxWidth, $comparison);
    }

    /**
     * Filter the query on the upload_path column
     *
     * Example usage:
     * <code>
     * $query->filterByUploadPath('fooValue');   // WHERE upload_path = 'fooValue'
     * $query->filterByUploadPath('%fooValue%', Criteria::LIKE); // WHERE upload_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uploadPath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByUploadPath($uploadPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uploadPath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_PATH, $uploadPath, $comparison);
    }

    /**
     * Filter the query on the allowed_types column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowedTypes('fooValue');   // WHERE allowed_types = 'fooValue'
     * $query->filterByAllowedTypes('%fooValue%', Criteria::LIKE); // WHERE allowed_types LIKE '%fooValue%'
     * </code>
     *
     * @param     string $allowedTypes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByAllowedTypes($allowedTypes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($allowedTypes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_ALLOWED_TYPES, $allowedTypes, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_URL, $url, $comparison);
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
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(UploadPrefTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UploadPrefTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUploadPref $uploadPref Object to remove from the list of results
     *
     * @return $this|ChildUploadPrefQuery The current query, for fluid interface
     */
    public function prune($uploadPref = null)
    {
        if ($uploadPref) {
            $this->addUsingAlias(UploadPrefTableMap::COL_UPLOAD_ID, $uploadPref->getUploadId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_upload_prefs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UploadPrefTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UploadPrefTableMap::clearInstancePool();
            UploadPrefTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UploadPrefTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UploadPrefTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UploadPrefTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UploadPrefTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UploadPrefQuery
