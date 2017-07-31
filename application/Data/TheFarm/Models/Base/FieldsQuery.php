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
use TheFarm\Models\Fields as ChildFields;
use TheFarm\Models\FieldsQuery as ChildFieldsQuery;
use TheFarm\Models\Map\FieldsTableMap;

/**
 * Base class that represents a query for the 'tf_fields' table.
 *
 *
 *
 * @method     ChildFieldsQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFieldsQuery orderByFieldName($order = Criteria::ASC) Order by the field_name column
 * @method     ChildFieldsQuery orderByFieldLabel($order = Criteria::ASC) Order by the field_label column
 * @method     ChildFieldsQuery orderByFieldType($order = Criteria::ASC) Order by the field_type column
 * @method     ChildFieldsQuery orderBySettings($order = Criteria::ASC) Order by the settings column
 * @method     ChildFieldsQuery orderByRequired($order = Criteria::ASC) Order by the required column
 * @method     ChildFieldsQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFieldsQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 *
 * @method     ChildFieldsQuery groupByFieldId() Group by the field_id column
 * @method     ChildFieldsQuery groupByFieldName() Group by the field_name column
 * @method     ChildFieldsQuery groupByFieldLabel() Group by the field_label column
 * @method     ChildFieldsQuery groupByFieldType() Group by the field_type column
 * @method     ChildFieldsQuery groupBySettings() Group by the settings column
 * @method     ChildFieldsQuery groupByRequired() Group by the required column
 * @method     ChildFieldsQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildFieldsQuery groupByEditDate() Group by the edit_date column
 *
 * @method     ChildFieldsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFieldsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFieldsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFieldsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFieldsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFieldsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFieldsQuery leftJoinFormEntries($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormEntries relation
 * @method     ChildFieldsQuery rightJoinFormEntries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormEntries relation
 * @method     ChildFieldsQuery innerJoinFormEntries($relationAlias = null) Adds a INNER JOIN clause to the query using the FormEntries relation
 *
 * @method     ChildFieldsQuery joinWithFormEntries($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormEntries relation
 *
 * @method     ChildFieldsQuery leftJoinWithFormEntries() Adds a LEFT JOIN clause and with to the query using the FormEntries relation
 * @method     ChildFieldsQuery rightJoinWithFormEntries() Adds a RIGHT JOIN clause and with to the query using the FormEntries relation
 * @method     ChildFieldsQuery innerJoinWithFormEntries() Adds a INNER JOIN clause and with to the query using the FormEntries relation
 *
 * @method     \TheFarm\Models\FormEntriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFields findOne(ConnectionInterface $con = null) Return the first ChildFields matching the query
 * @method     ChildFields findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFields matching the query, or a new ChildFields object populated from the query conditions when no match is found
 *
 * @method     ChildFields findOneByFieldId(int $field_id) Return the first ChildFields filtered by the field_id column
 * @method     ChildFields findOneByFieldName(string $field_name) Return the first ChildFields filtered by the field_name column
 * @method     ChildFields findOneByFieldLabel(string $field_label) Return the first ChildFields filtered by the field_label column
 * @method     ChildFields findOneByFieldType(string $field_type) Return the first ChildFields filtered by the field_type column
 * @method     ChildFields findOneBySettings(string $settings) Return the first ChildFields filtered by the settings column
 * @method     ChildFields findOneByRequired(string $required) Return the first ChildFields filtered by the required column
 * @method     ChildFields findOneByEntryDate(int $entry_date) Return the first ChildFields filtered by the entry_date column
 * @method     ChildFields findOneByEditDate(int $edit_date) Return the first ChildFields filtered by the edit_date column *

 * @method     ChildFields requirePk($key, ConnectionInterface $con = null) Return the ChildFields by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOne(ConnectionInterface $con = null) Return the first ChildFields matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFields requireOneByFieldId(int $field_id) Return the first ChildFields filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByFieldName(string $field_name) Return the first ChildFields filtered by the field_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByFieldLabel(string $field_label) Return the first ChildFields filtered by the field_label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByFieldType(string $field_type) Return the first ChildFields filtered by the field_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneBySettings(string $settings) Return the first ChildFields filtered by the settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByRequired(string $required) Return the first ChildFields filtered by the required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByEntryDate(int $entry_date) Return the first ChildFields filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFields requireOneByEditDate(int $edit_date) Return the first ChildFields filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFields[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFields objects based on current ModelCriteria
 * @method     ChildFields[]|ObjectCollection findByFieldId(int $field_id) Return ChildFields objects filtered by the field_id column
 * @method     ChildFields[]|ObjectCollection findByFieldName(string $field_name) Return ChildFields objects filtered by the field_name column
 * @method     ChildFields[]|ObjectCollection findByFieldLabel(string $field_label) Return ChildFields objects filtered by the field_label column
 * @method     ChildFields[]|ObjectCollection findByFieldType(string $field_type) Return ChildFields objects filtered by the field_type column
 * @method     ChildFields[]|ObjectCollection findBySettings(string $settings) Return ChildFields objects filtered by the settings column
 * @method     ChildFields[]|ObjectCollection findByRequired(string $required) Return ChildFields objects filtered by the required column
 * @method     ChildFields[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildFields objects filtered by the entry_date column
 * @method     ChildFields[]|ObjectCollection findByEditDate(int $edit_date) Return ChildFields objects filtered by the edit_date column
 * @method     ChildFields[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FieldsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FieldsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Fields', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFieldsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFieldsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFieldsQuery) {
            return $criteria;
        }
        $query = new ChildFieldsQuery();
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
     * @return ChildFields|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FieldsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FieldsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFields A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT field_id, field_name, field_label, field_type, settings, required, entry_date, edit_date FROM tf_fields WHERE field_id = :p0';
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
            /** @var ChildFields $obj */
            $obj = new ChildFields();
            $obj->hydrate($row);
            FieldsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFields|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the field_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId(1234); // WHERE field_id = 1234
     * $query->filterByFieldId(array(12, 34)); // WHERE field_id IN (12, 34)
     * $query->filterByFieldId(array('min' => 12)); // WHERE field_id > 12
     * </code>
     *
     * @param     mixed $fieldId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $fieldId, $comparison);
    }

    /**
     * Filter the query on the field_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldName('fooValue');   // WHERE field_name = 'fooValue'
     * $query->filterByFieldName('%fooValue%', Criteria::LIKE); // WHERE field_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByFieldName($fieldName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_NAME, $fieldName, $comparison);
    }

    /**
     * Filter the query on the field_label column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldLabel('fooValue');   // WHERE field_label = 'fooValue'
     * $query->filterByFieldLabel('%fooValue%', Criteria::LIKE); // WHERE field_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldLabel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByFieldLabel($fieldLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldLabel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_LABEL, $fieldLabel, $comparison);
    }

    /**
     * Filter the query on the field_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldType('fooValue');   // WHERE field_type = 'fooValue'
     * $query->filterByFieldType('%fooValue%', Criteria::LIKE); // WHERE field_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByFieldType($fieldType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_FIELD_TYPE, $fieldType, $comparison);
    }

    /**
     * Filter the query on the settings column
     *
     * Example usage:
     * <code>
     * $query->filterBySettings('fooValue');   // WHERE settings = 'fooValue'
     * $query->filterBySettings('%fooValue%', Criteria::LIKE); // WHERE settings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $settings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterBySettings($settings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_SETTINGS, $settings, $comparison);
    }

    /**
     * Filter the query on the required column
     *
     * Example usage:
     * <code>
     * $query->filterByRequired('fooValue');   // WHERE required = 'fooValue'
     * $query->filterByRequired('%fooValue%', Criteria::LIKE); // WHERE required LIKE '%fooValue%'
     * </code>
     *
     * @param     string $required The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByRequired($required = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($required)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_REQUIRED, $required, $comparison);
    }

    /**
     * Filter the query on the entry_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryDate(1234); // WHERE entry_date = 1234
     * $query->filterByEntryDate(array(12, 34)); // WHERE entry_date IN (12, 34)
     * $query->filterByEntryDate(array('min' => 12)); // WHERE entry_date > 12
     * </code>
     *
     * @param     mixed $entryDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FieldsTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FieldsTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
    }

    /**
     * Filter the query on the edit_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEditDate(1234); // WHERE edit_date = 1234
     * $query->filterByEditDate(array(12, 34)); // WHERE edit_date IN (12, 34)
     * $query->filterByEditDate(array('min' => 12)); // WHERE edit_date > 12
     * </code>
     *
     * @param     mixed $editDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FieldsTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FieldsTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldsTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\FormEntries object
     *
     * @param \TheFarm\Models\FormEntries|ObjectCollection $formEntries the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFieldsQuery The current query, for fluid interface
     */
    public function filterByFormEntries($formEntries, $comparison = null)
    {
        if ($formEntries instanceof \TheFarm\Models\FormEntries) {
            return $this
                ->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $formEntries->getFieldId(), $comparison);
        } elseif ($formEntries instanceof ObjectCollection) {
            return $this
                ->useFormEntriesQuery()
                ->filterByPrimaryKeys($formEntries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFormEntries() only accepts arguments of type \TheFarm\Models\FormEntries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FormEntries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function joinFormEntries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FormEntries');

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
            $this->addJoinObject($join, 'FormEntries');
        }

        return $this;
    }

    /**
     * Use the FormEntries relation FormEntries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormEntriesQuery A secondary query class using the current class as primary query
     */
    public function useFormEntriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFormEntries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FormEntries', '\TheFarm\Models\FormEntriesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFields $fields Object to remove from the list of results
     *
     * @return $this|ChildFieldsQuery The current query, for fluid interface
     */
    public function prune($fields = null)
    {
        if ($fields) {
            $this->addUsingAlias(FieldsTableMap::COL_FIELD_ID, $fields->getFieldId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_fields table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FieldsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FieldsTableMap::clearInstancePool();
            FieldsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FieldsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FieldsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FieldsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FieldsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FieldsQuery
