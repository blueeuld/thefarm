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
use TheFarm\Models\Contact as ChildContact;
use TheFarm\Models\ContactQuery as ChildContactQuery;
use TheFarm\Models\Map\ContactTableMap;

/**
 * Base class that represents a query for the 'tf_contacts' table.
 *
 *
 *
 * @method     ChildContactQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildContactQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildContactQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildContactQuery orderByMiddleName($order = Criteria::ASC) Order by the middle_name column
 * @method     ChildContactQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildContactQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildContactQuery orderByDateJoined($order = Criteria::ASC) Order by the date_joined column
 * @method     ChildContactQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildContactQuery orderByCivilStatus($order = Criteria::ASC) Order by the civil_status column
 * @method     ChildContactQuery orderByNationality($order = Criteria::ASC) Order by the nationality column
 * @method     ChildContactQuery orderByCountryDominicile($order = Criteria::ASC) Order by the country_dominicile column
 * @method     ChildContactQuery orderByEtnicOrigin($order = Criteria::ASC) Order by the etnic_origin column
 * @method     ChildContactQuery orderByDob($order = Criteria::ASC) Order by the dob column
 * @method     ChildContactQuery orderByPlaceOfBirth($order = Criteria::ASC) Order by the place_of_birth column
 * @method     ChildContactQuery orderByAge($order = Criteria::ASC) Order by the age column
 * @method     ChildContactQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildContactQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method     ChildContactQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildContactQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildContactQuery orderByPositionCd($order = Criteria::ASC) Order by the position_cd column
 * @method     ChildContactQuery orderByNickname($order = Criteria::ASC) Order by the nickname column
 * @method     ChildContactQuery orderByBio($order = Criteria::ASC) Order by the bio column
 *
 * @method     ChildContactQuery groupByContactId() Group by the contact_id column
 * @method     ChildContactQuery groupByFirstName() Group by the first_name column
 * @method     ChildContactQuery groupByLastName() Group by the last_name column
 * @method     ChildContactQuery groupByMiddleName() Group by the middle_name column
 * @method     ChildContactQuery groupByEmail() Group by the email column
 * @method     ChildContactQuery groupByTitle() Group by the title column
 * @method     ChildContactQuery groupByDateJoined() Group by the date_joined column
 * @method     ChildContactQuery groupByAvatar() Group by the avatar column
 * @method     ChildContactQuery groupByCivilStatus() Group by the civil_status column
 * @method     ChildContactQuery groupByNationality() Group by the nationality column
 * @method     ChildContactQuery groupByCountryDominicile() Group by the country_dominicile column
 * @method     ChildContactQuery groupByEtnicOrigin() Group by the etnic_origin column
 * @method     ChildContactQuery groupByDob() Group by the dob column
 * @method     ChildContactQuery groupByPlaceOfBirth() Group by the place_of_birth column
 * @method     ChildContactQuery groupByAge() Group by the age column
 * @method     ChildContactQuery groupByGender() Group by the gender column
 * @method     ChildContactQuery groupByHeight() Group by the height column
 * @method     ChildContactQuery groupByWeight() Group by the weight column
 * @method     ChildContactQuery groupByPhone() Group by the phone column
 * @method     ChildContactQuery groupByPositionCd() Group by the position_cd column
 * @method     ChildContactQuery groupByNickname() Group by the nickname column
 * @method     ChildContactQuery groupByBio() Group by the bio column
 *
 * @method     ChildContactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildContactQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildContactQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildContactQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildContactQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildContactQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildContactQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildContactQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildContactQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildContactQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     ChildContactQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildContactQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildContactQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildContactQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildContactQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildContactQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildContactQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     \TheFarm\Models\PositionQuery|\TheFarm\Models\BookingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildContact findOne(ConnectionInterface $con = null) Return the first ChildContact matching the query
 * @method     ChildContact findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContact matching the query, or a new ChildContact object populated from the query conditions when no match is found
 *
 * @method     ChildContact findOneByContactId(int $contact_id) Return the first ChildContact filtered by the contact_id column
 * @method     ChildContact findOneByFirstName(string $first_name) Return the first ChildContact filtered by the first_name column
 * @method     ChildContact findOneByLastName(string $last_name) Return the first ChildContact filtered by the last_name column
 * @method     ChildContact findOneByMiddleName(string $middle_name) Return the first ChildContact filtered by the middle_name column
 * @method     ChildContact findOneByEmail(string $email) Return the first ChildContact filtered by the email column
 * @method     ChildContact findOneByTitle(string $title) Return the first ChildContact filtered by the title column
 * @method     ChildContact findOneByDateJoined(string $date_joined) Return the first ChildContact filtered by the date_joined column
 * @method     ChildContact findOneByAvatar(string $avatar) Return the first ChildContact filtered by the avatar column
 * @method     ChildContact findOneByCivilStatus(string $civil_status) Return the first ChildContact filtered by the civil_status column
 * @method     ChildContact findOneByNationality(string $nationality) Return the first ChildContact filtered by the nationality column
 * @method     ChildContact findOneByCountryDominicile(string $country_dominicile) Return the first ChildContact filtered by the country_dominicile column
 * @method     ChildContact findOneByEtnicOrigin(string $etnic_origin) Return the first ChildContact filtered by the etnic_origin column
 * @method     ChildContact findOneByDob(string $dob) Return the first ChildContact filtered by the dob column
 * @method     ChildContact findOneByPlaceOfBirth(string $place_of_birth) Return the first ChildContact filtered by the place_of_birth column
 * @method     ChildContact findOneByAge(int $age) Return the first ChildContact filtered by the age column
 * @method     ChildContact findOneByGender(string $gender) Return the first ChildContact filtered by the gender column
 * @method     ChildContact findOneByHeight(string $height) Return the first ChildContact filtered by the height column
 * @method     ChildContact findOneByWeight(string $weight) Return the first ChildContact filtered by the weight column
 * @method     ChildContact findOneByPhone(string $phone) Return the first ChildContact filtered by the phone column
 * @method     ChildContact findOneByPositionCd(string $position_cd) Return the first ChildContact filtered by the position_cd column
 * @method     ChildContact findOneByNickname(string $nickname) Return the first ChildContact filtered by the nickname column
 * @method     ChildContact findOneByBio(string $bio) Return the first ChildContact filtered by the bio column *

 * @method     ChildContact requirePk($key, ConnectionInterface $con = null) Return the ChildContact by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOne(ConnectionInterface $con = null) Return the first ChildContact matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContact requireOneByContactId(int $contact_id) Return the first ChildContact filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByFirstName(string $first_name) Return the first ChildContact filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByLastName(string $last_name) Return the first ChildContact filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByMiddleName(string $middle_name) Return the first ChildContact filtered by the middle_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByEmail(string $email) Return the first ChildContact filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByTitle(string $title) Return the first ChildContact filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByDateJoined(string $date_joined) Return the first ChildContact filtered by the date_joined column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByAvatar(string $avatar) Return the first ChildContact filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByCivilStatus(string $civil_status) Return the first ChildContact filtered by the civil_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByNationality(string $nationality) Return the first ChildContact filtered by the nationality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByCountryDominicile(string $country_dominicile) Return the first ChildContact filtered by the country_dominicile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByEtnicOrigin(string $etnic_origin) Return the first ChildContact filtered by the etnic_origin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByDob(string $dob) Return the first ChildContact filtered by the dob column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByPlaceOfBirth(string $place_of_birth) Return the first ChildContact filtered by the place_of_birth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByAge(int $age) Return the first ChildContact filtered by the age column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByGender(string $gender) Return the first ChildContact filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByHeight(string $height) Return the first ChildContact filtered by the height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByWeight(string $weight) Return the first ChildContact filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByPhone(string $phone) Return the first ChildContact filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByPositionCd(string $position_cd) Return the first ChildContact filtered by the position_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByNickname(string $nickname) Return the first ChildContact filtered by the nickname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContact requireOneByBio(string $bio) Return the first ChildContact filtered by the bio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContact[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContact objects based on current ModelCriteria
 * @method     ChildContact[]|ObjectCollection findByContactId(int $contact_id) Return ChildContact objects filtered by the contact_id column
 * @method     ChildContact[]|ObjectCollection findByFirstName(string $first_name) Return ChildContact objects filtered by the first_name column
 * @method     ChildContact[]|ObjectCollection findByLastName(string $last_name) Return ChildContact objects filtered by the last_name column
 * @method     ChildContact[]|ObjectCollection findByMiddleName(string $middle_name) Return ChildContact objects filtered by the middle_name column
 * @method     ChildContact[]|ObjectCollection findByEmail(string $email) Return ChildContact objects filtered by the email column
 * @method     ChildContact[]|ObjectCollection findByTitle(string $title) Return ChildContact objects filtered by the title column
 * @method     ChildContact[]|ObjectCollection findByDateJoined(string $date_joined) Return ChildContact objects filtered by the date_joined column
 * @method     ChildContact[]|ObjectCollection findByAvatar(string $avatar) Return ChildContact objects filtered by the avatar column
 * @method     ChildContact[]|ObjectCollection findByCivilStatus(string $civil_status) Return ChildContact objects filtered by the civil_status column
 * @method     ChildContact[]|ObjectCollection findByNationality(string $nationality) Return ChildContact objects filtered by the nationality column
 * @method     ChildContact[]|ObjectCollection findByCountryDominicile(string $country_dominicile) Return ChildContact objects filtered by the country_dominicile column
 * @method     ChildContact[]|ObjectCollection findByEtnicOrigin(string $etnic_origin) Return ChildContact objects filtered by the etnic_origin column
 * @method     ChildContact[]|ObjectCollection findByDob(string $dob) Return ChildContact objects filtered by the dob column
 * @method     ChildContact[]|ObjectCollection findByPlaceOfBirth(string $place_of_birth) Return ChildContact objects filtered by the place_of_birth column
 * @method     ChildContact[]|ObjectCollection findByAge(int $age) Return ChildContact objects filtered by the age column
 * @method     ChildContact[]|ObjectCollection findByGender(string $gender) Return ChildContact objects filtered by the gender column
 * @method     ChildContact[]|ObjectCollection findByHeight(string $height) Return ChildContact objects filtered by the height column
 * @method     ChildContact[]|ObjectCollection findByWeight(string $weight) Return ChildContact objects filtered by the weight column
 * @method     ChildContact[]|ObjectCollection findByPhone(string $phone) Return ChildContact objects filtered by the phone column
 * @method     ChildContact[]|ObjectCollection findByPositionCd(string $position_cd) Return ChildContact objects filtered by the position_cd column
 * @method     ChildContact[]|ObjectCollection findByNickname(string $nickname) Return ChildContact objects filtered by the nickname column
 * @method     ChildContact[]|ObjectCollection findByBio(string $bio) Return ChildContact objects filtered by the bio column
 * @method     ChildContact[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContactQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ContactQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Contact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContactQuery) {
            return $criteria;
        }
        $query = new ChildContactQuery();
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
     * @return ChildContact|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ContactTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildContact A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT contact_id, first_name, last_name, middle_name, email, title, date_joined, avatar, civil_status, nationality, country_dominicile, etnic_origin, dob, place_of_birth, age, gender, height, weight, phone, position_cd, nickname, bio FROM tf_contacts WHERE contact_id = :p0';
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
            /** @var ChildContact $obj */
            $obj = new ChildContact();
            $obj->hydrate($row);
            ContactTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildContact|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the contact_id column
     *
     * Example usage:
     * <code>
     * $query->filterByContactId(1234); // WHERE contact_id = 1234
     * $query->filterByContactId(array(12, 34)); // WHERE contact_id IN (12, 34)
     * $query->filterByContactId(array('min' => 12)); // WHERE contact_id > 12
     * </code>
     *
     * @param     mixed $contactId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $contactId, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the middle_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleName('fooValue');   // WHERE middle_name = 'fooValue'
     * $query->filterByMiddleName('%fooValue%', Criteria::LIKE); // WHERE middle_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $middleName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByMiddleName($middleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_MIDDLE_NAME, $middleName, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the date_joined column
     *
     * Example usage:
     * <code>
     * $query->filterByDateJoined('2011-03-14'); // WHERE date_joined = '2011-03-14'
     * $query->filterByDateJoined('now'); // WHERE date_joined = '2011-03-14'
     * $query->filterByDateJoined(array('max' => 'yesterday')); // WHERE date_joined > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateJoined The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByDateJoined($dateJoined = null, $comparison = null)
    {
        if (is_array($dateJoined)) {
            $useMinMax = false;
            if (isset($dateJoined['min'])) {
                $this->addUsingAlias(ContactTableMap::COL_DATE_JOINED, $dateJoined['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateJoined['max'])) {
                $this->addUsingAlias(ContactTableMap::COL_DATE_JOINED, $dateJoined['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_DATE_JOINED, $dateJoined, $comparison);
    }

    /**
     * Filter the query on the avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%', Criteria::LIKE); // WHERE avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the civil_status column
     *
     * Example usage:
     * <code>
     * $query->filterByCivilStatus('fooValue');   // WHERE civil_status = 'fooValue'
     * $query->filterByCivilStatus('%fooValue%', Criteria::LIKE); // WHERE civil_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civilStatus The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByCivilStatus($civilStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civilStatus)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_CIVIL_STATUS, $civilStatus, $comparison);
    }

    /**
     * Filter the query on the nationality column
     *
     * Example usage:
     * <code>
     * $query->filterByNationality('fooValue');   // WHERE nationality = 'fooValue'
     * $query->filterByNationality('%fooValue%', Criteria::LIKE); // WHERE nationality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nationality The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByNationality($nationality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nationality)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_NATIONALITY, $nationality, $comparison);
    }

    /**
     * Filter the query on the country_dominicile column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryDominicile('fooValue');   // WHERE country_dominicile = 'fooValue'
     * $query->filterByCountryDominicile('%fooValue%', Criteria::LIKE); // WHERE country_dominicile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $countryDominicile The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByCountryDominicile($countryDominicile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryDominicile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_COUNTRY_DOMINICILE, $countryDominicile, $comparison);
    }

    /**
     * Filter the query on the etnic_origin column
     *
     * Example usage:
     * <code>
     * $query->filterByEtnicOrigin('fooValue');   // WHERE etnic_origin = 'fooValue'
     * $query->filterByEtnicOrigin('%fooValue%', Criteria::LIKE); // WHERE etnic_origin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etnicOrigin The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByEtnicOrigin($etnicOrigin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etnicOrigin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_ETNIC_ORIGIN, $etnicOrigin, $comparison);
    }

    /**
     * Filter the query on the dob column
     *
     * Example usage:
     * <code>
     * $query->filterByDob('2011-03-14'); // WHERE dob = '2011-03-14'
     * $query->filterByDob('now'); // WHERE dob = '2011-03-14'
     * $query->filterByDob(array('max' => 'yesterday')); // WHERE dob > '2011-03-13'
     * </code>
     *
     * @param     mixed $dob The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByDob($dob = null, $comparison = null)
    {
        if (is_array($dob)) {
            $useMinMax = false;
            if (isset($dob['min'])) {
                $this->addUsingAlias(ContactTableMap::COL_DOB, $dob['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dob['max'])) {
                $this->addUsingAlias(ContactTableMap::COL_DOB, $dob['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_DOB, $dob, $comparison);
    }

    /**
     * Filter the query on the place_of_birth column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceOfBirth('fooValue');   // WHERE place_of_birth = 'fooValue'
     * $query->filterByPlaceOfBirth('%fooValue%', Criteria::LIKE); // WHERE place_of_birth LIKE '%fooValue%'
     * </code>
     *
     * @param     string $placeOfBirth The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByPlaceOfBirth($placeOfBirth = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placeOfBirth)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_PLACE_OF_BIRTH, $placeOfBirth, $comparison);
    }

    /**
     * Filter the query on the age column
     *
     * Example usage:
     * <code>
     * $query->filterByAge(1234); // WHERE age = 1234
     * $query->filterByAge(array(12, 34)); // WHERE age IN (12, 34)
     * $query->filterByAge(array('min' => 12)); // WHERE age > 12
     * </code>
     *
     * @param     mixed $age The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByAge($age = null, $comparison = null)
    {
        if (is_array($age)) {
            $useMinMax = false;
            if (isset($age['min'])) {
                $this->addUsingAlias(ContactTableMap::COL_AGE, $age['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($age['max'])) {
                $this->addUsingAlias(ContactTableMap::COL_AGE, $age['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_AGE, $age, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight('fooValue');   // WHERE height = 'fooValue'
     * $query->filterByHeight('%fooValue%', Criteria::LIKE); // WHERE height LIKE '%fooValue%'
     * </code>
     *
     * @param     string $height The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($height)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight('fooValue');   // WHERE weight = 'fooValue'
     * $query->filterByWeight('%fooValue%', Criteria::LIKE); // WHERE weight LIKE '%fooValue%'
     * </code>
     *
     * @param     string $weight The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($weight)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_WEIGHT, $weight, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the position_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionCd('fooValue');   // WHERE position_cd = 'fooValue'
     * $query->filterByPositionCd('%fooValue%', Criteria::LIKE); // WHERE position_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $positionCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByPositionCd($positionCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_POSITION_CD, $positionCd, $comparison);
    }

    /**
     * Filter the query on the nickname column
     *
     * Example usage:
     * <code>
     * $query->filterByNickname('fooValue');   // WHERE nickname = 'fooValue'
     * $query->filterByNickname('%fooValue%', Criteria::LIKE); // WHERE nickname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nickname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByNickname($nickname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nickname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_NICKNAME, $nickname, $comparison);
    }

    /**
     * Filter the query on the bio column
     *
     * Example usage:
     * <code>
     * $query->filterByBio('fooValue');   // WHERE bio = 'fooValue'
     * $query->filterByBio('%fooValue%', Criteria::LIKE); // WHERE bio LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bio The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function filterByBio($bio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bio)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactTableMap::COL_BIO, $bio, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Position object
     *
     * @param \TheFarm\Models\Position|ObjectCollection $position The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContactQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \TheFarm\Models\Position) {
            return $this
                ->addUsingAlias(ContactTableMap::COL_POSITION_CD, $position->getPositionCd(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContactTableMap::COL_POSITION_CD, $position->toKeyValue('PrimaryKey', 'PositionCd'), $comparison);
        } else {
            throw new PropelException('filterByPosition() only accepts arguments of type \TheFarm\Models\Position or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Position relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function joinPosition($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Position');

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
            $this->addJoinObject($join, 'Position');
        }

        return $this;
    }

    /**
     * Use the Position relation Position object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PositionQuery A secondary query class using the current class as primary query
     */
    public function usePositionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Position', '\TheFarm\Models\PositionQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $booking->getGuestId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            return $this
                ->useBookingQuery()
                ->filterByPrimaryKeys($booking->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooking() only accepts arguments of type \TheFarm\Models\Booking or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Booking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Booking');

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
            $this->addJoinObject($join, 'Booking');
        }

        return $this;
    }

    /**
     * Use the Booking relation Booking object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingQuery A secondary query class using the current class as primary query
     */
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContact $contact Object to remove from the list of results
     *
     * @return $this|ChildContactQuery The current query, for fluid interface
     */
    public function prune($contact = null)
    {
        if ($contact) {
            $this->addUsingAlias(ContactTableMap::COL_CONTACT_ID, $contact->getContactId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_contacts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContactTableMap::clearInstancePool();
            ContactTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ContactTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContactQuery
