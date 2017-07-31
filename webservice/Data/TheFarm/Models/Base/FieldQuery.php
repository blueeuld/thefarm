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
use TheFarm\Models\Field as ChildField;
use TheFarm\Models\FieldQuery as ChildFieldQuery;
use TheFarm\Models\Map\FieldTableMap;

/**
 * Base class that represents a query for the 'tf_fields' table.
 *
 *
 *
 * @method     ChildFieldQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFieldQuery orderByFieldName($order = Criteria::ASC) Order by the field_name column
 * @method     ChildFieldQuery orderByFieldLabel($order = Criteria::ASC) Order by the field_label column
 * @method     ChildFieldQuery orderByFieldType($order = Criteria::ASC) Order by the field_type column
 * @method     ChildFieldQuery orderBySettings($order = Criteria::ASC) Order by the settings column
 * @method     ChildFieldQuery orderByRequired($order = Criteria::ASC) Order by the required column
 * @method     ChildFieldQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFieldQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 *
 * @method     ChildFieldQuery groupByFieldId() Group by the field_id column
 * @method     ChildFieldQuery groupByFieldName() Group by the field_name column
 * @method     ChildFieldQuery groupByFieldLabel() Group by the field_label column
 * @method     ChildFieldQuery groupByFieldType() Group by the field_type column
 * @method     ChildFieldQuery groupBySettings() Group by the settings column
 * @method     ChildFieldQuery groupByRequired() Group by the required column
 * @method     ChildFieldQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildFieldQuery groupByEditDate() Group by the edit_date column
 *
 * @method     ChildFieldQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFieldQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFieldQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFieldQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFieldQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFieldQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFieldQuery leftJoinFormEntry($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormEntry relation
 * @method     ChildFieldQuery rightJoinFormEntry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormEntry relation
 * @method     ChildFieldQuery innerJoinFormEntry($relationAlias = null) Adds a INNER JOIN clause to the query using the FormEntry relation
 *
 * @method     ChildFieldQuery joinWithFormEntry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormEntry relation
 *
 * @method     ChildFieldQuery leftJoinWithFormEntry() Adds a LEFT JOIN clause and with to the query using the FormEntry relation
 * @method     ChildFieldQuery rightJoinWithFormEntry() Adds a RIGHT JOIN clause and with to the query using the FormEntry relation
 * @method     ChildFieldQuery innerJoinWithFormEntry() Adds a INNER JOIN clause and with to the query using the FormEntry relation
 *
 * @method     \TheFarm\Models\FormEntryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildField findOne(ConnectionInterface $con = null) Return the first ChildField matching the query
 * @method     ChildField findOneOrCreate(ConnectionInterface $con = null) Return the first ChildField matching the query, or a new ChildField object populated from the query conditions when no match is found
 *
 * @method     ChildField findOneByFieldId(int $field_id) Return the first ChildField filtered by the field_id column
 * @method     ChildField findOneByFieldName(string $field_name) Return the first ChildField filtered by the field_name column
 * @method     ChildField findOneByFieldLabel(string $field_label) Return the first ChildField filtered by the field_label column
 * @method     ChildField findOneByFieldType(string $field_type) Return the first ChildField filtered by the field_type column
 * @method     ChildField findOneBySettings(string $settings) Return the first ChildField filtered by the settings column
 * @method     ChildField findOneByRequired(string $required) Return the first ChildField filtered by the required column
 * @method     ChildField findOneByEntryDate(int $entry_date) Return the first ChildField filtered by the entry_date column
 * @method     ChildField findOneByEditDate(int $edit_date) Return the first ChildField filtered by the edit_date column *

 * @method     ChildField requirePk($key, ConnectionInterface $con = null) Return the ChildField by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOne(ConnectionInterface $con = null) Return the first ChildField matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildField requireOneByFieldId(int $field_id) Return the first ChildField filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByFieldName(string $field_name) Return the first ChildField filtered by the field_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByFieldLabel(string $field_label) Return the first ChildField filtered by the field_label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByFieldType(string $field_type) Return the first ChildField filtered by the field_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneBySettings(string $settings) Return the first ChildField filtered by the settings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByRequired(string $required) Return the first ChildField filtered by the required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByEntryDate(int $entry_date) Return the first ChildField filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildField requireOneByEditDate(int $edit_date) Return the first ChildField filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildField[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildField objects based on current ModelCriteria
 * @method     ChildField[]|ObjectCollection findByFieldId(int $field_id) Return ChildField objects filtered by the field_id column
 * @method     ChildField[]|ObjectCollection findByFieldName(string $field_name) Return ChildField objects filtered by the field_name column
 * @method     ChildField[]|ObjectCollection findByFieldLabel(string $field_label) Return ChildField objects filtered by the field_label column
 * @method     ChildField[]|ObjectCollection findByFieldType(string $field_type) Return ChildField objects filtered by the field_type column
 * @method     ChildField[]|ObjectCollection findBySettings(string $settings) Return ChildField objects filtered by the settings column
 * @method     ChildField[]|ObjectCollection findByRequired(string $required) Return ChildField objects filtered by the required column
 * @method     ChildField[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildField objects filtered by the entry_date column
 * @method     ChildField[]|ObjectCollection findByEditDate(int $edit_date) Return ChildField objects filtered by the edit_date column
 * @method     ChildField[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FieldQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FieldQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Field', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFieldQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFieldQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFieldQuery) {
            return $criteria;
        }
        $query = new ChildFieldQuery();
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
     * @return ChildField|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FieldTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FieldTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildField A model object, or null if the key is not found
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
            /** @var ChildField $obj */
            $obj = new ChildField();
            $obj->hydrate($row);
            FieldTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildField|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $fieldId, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByFieldName($fieldName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_NAME, $fieldName, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByFieldLabel($fieldLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldLabel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_LABEL, $fieldLabel, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByFieldType($fieldType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_FIELD_TYPE, $fieldType, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterBySettings($settings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_SETTINGS, $settings, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByRequired($required = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($required)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_REQUIRED, $required, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FieldTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FieldTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FieldTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FieldTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FieldTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\FormEntry object
     *
     * @param \TheFarm\Models\FormEntry|ObjectCollection $formEntry the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFieldQuery The current query, for fluid interface
     */
    public function filterByFormEntry($formEntry, $comparison = null)
    {
        if ($formEntry instanceof \TheFarm\Models\FormEntry) {
            return $this
                ->addUsingAlias(FieldTableMap::COL_FIELD_ID, $formEntry->getFieldId(), $comparison);
        } elseif ($formEntry instanceof ObjectCollection) {
            return $this
                ->useFormEntryQuery()
                ->filterByPrimaryKeys($formEntry->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFormEntry() only accepts arguments of type \TheFarm\Models\FormEntry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FormEntry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function joinFormEntry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FormEntry');

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
            $this->addJoinObject($join, 'FormEntry');
        }

        return $this;
    }

    /**
     * Use the FormEntry relation FormEntry object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormEntryQuery A secondary query class using the current class as primary query
     */
    public function useFormEntryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFormEntry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FormEntry', '\TheFarm\Models\FormEntryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildField $field Object to remove from the list of results
     *
     * @return $this|ChildFieldQuery The current query, for fluid interface
     */
    public function prune($field = null)
    {
        if ($field) {
            $this->addUsingAlias(FieldTableMap::COL_FIELD_ID, $field->getFieldId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(FieldTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FieldTableMap::clearInstancePool();
            FieldTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FieldTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FieldTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FieldTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FieldTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FieldQuery
