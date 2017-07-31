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
use TheFarm\Models\Messages as ChildMessages;
use TheFarm\Models\MessagesQuery as ChildMessagesQuery;
use TheFarm\Models\Map\MessagesTableMap;

/**
 * Base class that represents a query for the 'tf_messages' table.
 *
 *
 *
 * @method     ChildMessagesQuery orderByMessageId($order = Criteria::ASC) Order by the message_id column
 * @method     ChildMessagesQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildMessagesQuery orderBySender($order = Criteria::ASC) Order by the sender column
 * @method     ChildMessagesQuery orderByReceiver($order = Criteria::ASC) Order by the receiver column
 * @method     ChildMessagesQuery orderByDateSent($order = Criteria::ASC) Order by the date_sent column
 * @method     ChildMessagesQuery orderByDateRead($order = Criteria::ASC) Order by the date_read column
 * @method     ChildMessagesQuery orderByMessageType($order = Criteria::ASC) Order by the message_type column
 * @method     ChildMessagesQuery orderByReceived($order = Criteria::ASC) Order by the received column
 * @method     ChildMessagesQuery orderByReceiverEmail($order = Criteria::ASC) Order by the receiver_email column
 * @method     ChildMessagesQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 *
 * @method     ChildMessagesQuery groupByMessageId() Group by the message_id column
 * @method     ChildMessagesQuery groupByMessage() Group by the message column
 * @method     ChildMessagesQuery groupBySender() Group by the sender column
 * @method     ChildMessagesQuery groupByReceiver() Group by the receiver column
 * @method     ChildMessagesQuery groupByDateSent() Group by the date_sent column
 * @method     ChildMessagesQuery groupByDateRead() Group by the date_read column
 * @method     ChildMessagesQuery groupByMessageType() Group by the message_type column
 * @method     ChildMessagesQuery groupByReceived() Group by the received column
 * @method     ChildMessagesQuery groupByReceiverEmail() Group by the receiver_email column
 * @method     ChildMessagesQuery groupBySubject() Group by the subject column
 *
 * @method     ChildMessagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMessagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMessagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMessagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMessagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMessagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMessages findOne(ConnectionInterface $con = null) Return the first ChildMessages matching the query
 * @method     ChildMessages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMessages matching the query, or a new ChildMessages object populated from the query conditions when no match is found
 *
 * @method     ChildMessages findOneByMessageId(int $message_id) Return the first ChildMessages filtered by the message_id column
 * @method     ChildMessages findOneByMessage(string $message) Return the first ChildMessages filtered by the message column
 * @method     ChildMessages findOneBySender(int $sender) Return the first ChildMessages filtered by the sender column
 * @method     ChildMessages findOneByReceiver(int $receiver) Return the first ChildMessages filtered by the receiver column
 * @method     ChildMessages findOneByDateSent(string $date_sent) Return the first ChildMessages filtered by the date_sent column
 * @method     ChildMessages findOneByDateRead(string $date_read) Return the first ChildMessages filtered by the date_read column
 * @method     ChildMessages findOneByMessageType(string $message_type) Return the first ChildMessages filtered by the message_type column
 * @method     ChildMessages findOneByReceived(int $received) Return the first ChildMessages filtered by the received column
 * @method     ChildMessages findOneByReceiverEmail(string $receiver_email) Return the first ChildMessages filtered by the receiver_email column
 * @method     ChildMessages findOneBySubject(string $subject) Return the first ChildMessages filtered by the subject column *

 * @method     ChildMessages requirePk($key, ConnectionInterface $con = null) Return the ChildMessages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOne(ConnectionInterface $con = null) Return the first ChildMessages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMessages requireOneByMessageId(int $message_id) Return the first ChildMessages filtered by the message_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByMessage(string $message) Return the first ChildMessages filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneBySender(int $sender) Return the first ChildMessages filtered by the sender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByReceiver(int $receiver) Return the first ChildMessages filtered by the receiver column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByDateSent(string $date_sent) Return the first ChildMessages filtered by the date_sent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByDateRead(string $date_read) Return the first ChildMessages filtered by the date_read column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByMessageType(string $message_type) Return the first ChildMessages filtered by the message_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByReceived(int $received) Return the first ChildMessages filtered by the received column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneByReceiverEmail(string $receiver_email) Return the first ChildMessages filtered by the receiver_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMessages requireOneBySubject(string $subject) Return the first ChildMessages filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMessages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMessages objects based on current ModelCriteria
 * @method     ChildMessages[]|ObjectCollection findByMessageId(int $message_id) Return ChildMessages objects filtered by the message_id column
 * @method     ChildMessages[]|ObjectCollection findByMessage(string $message) Return ChildMessages objects filtered by the message column
 * @method     ChildMessages[]|ObjectCollection findBySender(int $sender) Return ChildMessages objects filtered by the sender column
 * @method     ChildMessages[]|ObjectCollection findByReceiver(int $receiver) Return ChildMessages objects filtered by the receiver column
 * @method     ChildMessages[]|ObjectCollection findByDateSent(string $date_sent) Return ChildMessages objects filtered by the date_sent column
 * @method     ChildMessages[]|ObjectCollection findByDateRead(string $date_read) Return ChildMessages objects filtered by the date_read column
 * @method     ChildMessages[]|ObjectCollection findByMessageType(string $message_type) Return ChildMessages objects filtered by the message_type column
 * @method     ChildMessages[]|ObjectCollection findByReceived(int $received) Return ChildMessages objects filtered by the received column
 * @method     ChildMessages[]|ObjectCollection findByReceiverEmail(string $receiver_email) Return ChildMessages objects filtered by the receiver_email column
 * @method     ChildMessages[]|ObjectCollection findBySubject(string $subject) Return ChildMessages objects filtered by the subject column
 * @method     ChildMessages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MessagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\MessagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Messages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMessagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMessagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMessagesQuery) {
            return $criteria;
        }
        $query = new ChildMessagesQuery();
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
     * @return ChildMessages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MessagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MessagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMessages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT message_id, message, sender, receiver, date_sent, date_read, message_type, received, receiver_email, subject FROM tf_messages WHERE message_id = :p0';
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
            /** @var ChildMessages $obj */
            $obj = new ChildMessages();
            $obj->hydrate($row);
            MessagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMessages|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the message_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageId(1234); // WHERE message_id = 1234
     * $query->filterByMessageId(array(12, 34)); // WHERE message_id IN (12, 34)
     * $query->filterByMessageId(array('min' => 12)); // WHERE message_id > 12
     * </code>
     *
     * @param     mixed $messageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByMessageId($messageId = null, $comparison = null)
    {
        if (is_array($messageId)) {
            $useMinMax = false;
            if (isset($messageId['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $messageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageId['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $messageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $messageId, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%', Criteria::LIKE); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the sender column
     *
     * Example usage:
     * <code>
     * $query->filterBySender(1234); // WHERE sender = 1234
     * $query->filterBySender(array(12, 34)); // WHERE sender IN (12, 34)
     * $query->filterBySender(array('min' => 12)); // WHERE sender > 12
     * </code>
     *
     * @param     mixed $sender The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterBySender($sender = null, $comparison = null)
    {
        if (is_array($sender)) {
            $useMinMax = false;
            if (isset($sender['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_SENDER, $sender['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sender['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_SENDER, $sender['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_SENDER, $sender, $comparison);
    }

    /**
     * Filter the query on the receiver column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiver(1234); // WHERE receiver = 1234
     * $query->filterByReceiver(array(12, 34)); // WHERE receiver IN (12, 34)
     * $query->filterByReceiver(array('min' => 12)); // WHERE receiver > 12
     * </code>
     *
     * @param     mixed $receiver The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByReceiver($receiver = null, $comparison = null)
    {
        if (is_array($receiver)) {
            $useMinMax = false;
            if (isset($receiver['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_RECEIVER, $receiver['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receiver['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_RECEIVER, $receiver['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_RECEIVER, $receiver, $comparison);
    }

    /**
     * Filter the query on the date_sent column
     *
     * Example usage:
     * <code>
     * $query->filterByDateSent('2011-03-14'); // WHERE date_sent = '2011-03-14'
     * $query->filterByDateSent('now'); // WHERE date_sent = '2011-03-14'
     * $query->filterByDateSent(array('max' => 'yesterday')); // WHERE date_sent > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateSent The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByDateSent($dateSent = null, $comparison = null)
    {
        if (is_array($dateSent)) {
            $useMinMax = false;
            if (isset($dateSent['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_DATE_SENT, $dateSent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateSent['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_DATE_SENT, $dateSent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_DATE_SENT, $dateSent, $comparison);
    }

    /**
     * Filter the query on the date_read column
     *
     * Example usage:
     * <code>
     * $query->filterByDateRead('2011-03-14'); // WHERE date_read = '2011-03-14'
     * $query->filterByDateRead('now'); // WHERE date_read = '2011-03-14'
     * $query->filterByDateRead(array('max' => 'yesterday')); // WHERE date_read > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateRead The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByDateRead($dateRead = null, $comparison = null)
    {
        if (is_array($dateRead)) {
            $useMinMax = false;
            if (isset($dateRead['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_DATE_READ, $dateRead['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateRead['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_DATE_READ, $dateRead['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_DATE_READ, $dateRead, $comparison);
    }

    /**
     * Filter the query on the message_type column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageType('fooValue');   // WHERE message_type = 'fooValue'
     * $query->filterByMessageType('%fooValue%', Criteria::LIKE); // WHERE message_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $messageType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByMessageType($messageType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($messageType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_TYPE, $messageType, $comparison);
    }

    /**
     * Filter the query on the received column
     *
     * Example usage:
     * <code>
     * $query->filterByReceived(1234); // WHERE received = 1234
     * $query->filterByReceived(array(12, 34)); // WHERE received IN (12, 34)
     * $query->filterByReceived(array('min' => 12)); // WHERE received > 12
     * </code>
     *
     * @param     mixed $received The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByReceived($received = null, $comparison = null)
    {
        if (is_array($received)) {
            $useMinMax = false;
            if (isset($received['min'])) {
                $this->addUsingAlias(MessagesTableMap::COL_RECEIVED, $received['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($received['max'])) {
                $this->addUsingAlias(MessagesTableMap::COL_RECEIVED, $received['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_RECEIVED, $received, $comparison);
    }

    /**
     * Filter the query on the receiver_email column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverEmail('fooValue');   // WHERE receiver_email = 'fooValue'
     * $query->filterByReceiverEmail('%fooValue%', Criteria::LIKE); // WHERE receiver_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiverEmail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterByReceiverEmail($receiverEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiverEmail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_RECEIVER_EMAIL, $receiverEmail, $comparison);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessagesTableMap::COL_SUBJECT, $subject, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMessages $messages Object to remove from the list of results
     *
     * @return $this|ChildMessagesQuery The current query, for fluid interface
     */
    public function prune($messages = null)
    {
        if ($messages) {
            $this->addUsingAlias(MessagesTableMap::COL_MESSAGE_ID, $messages->getMessageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MessagesTableMap::clearInstancePool();
            MessagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MessagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MessagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MessagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MessagesQuery
