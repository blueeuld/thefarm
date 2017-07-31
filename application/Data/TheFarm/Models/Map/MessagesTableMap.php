<?php

namespace TheFarm\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use TheFarm\Models\Messages;
use TheFarm\Models\MessagesQuery;


/**
 * This class defines the structure of the 'tf_messages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MessagesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.MessagesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_messages';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Messages';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Messages';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the message_id field
     */
    const COL_MESSAGE_ID = 'tf_messages.message_id';

    /**
     * the column name for the message field
     */
    const COL_MESSAGE = 'tf_messages.message';

    /**
     * the column name for the sender field
     */
    const COL_SENDER = 'tf_messages.sender';

    /**
     * the column name for the receiver field
     */
    const COL_RECEIVER = 'tf_messages.receiver';

    /**
     * the column name for the date_sent field
     */
    const COL_DATE_SENT = 'tf_messages.date_sent';

    /**
     * the column name for the date_read field
     */
    const COL_DATE_READ = 'tf_messages.date_read';

    /**
     * the column name for the message_type field
     */
    const COL_MESSAGE_TYPE = 'tf_messages.message_type';

    /**
     * the column name for the received field
     */
    const COL_RECEIVED = 'tf_messages.received';

    /**
     * the column name for the receiver_email field
     */
    const COL_RECEIVER_EMAIL = 'tf_messages.receiver_email';

    /**
     * the column name for the subject field
     */
    const COL_SUBJECT = 'tf_messages.subject';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('MessageId', 'Message', 'Sender', 'Receiver', 'DateSent', 'DateRead', 'MessageType', 'Received', 'ReceiverEmail', 'Subject', ),
        self::TYPE_CAMELNAME     => array('messageId', 'message', 'sender', 'receiver', 'dateSent', 'dateRead', 'messageType', 'received', 'receiverEmail', 'subject', ),
        self::TYPE_COLNAME       => array(MessagesTableMap::COL_MESSAGE_ID, MessagesTableMap::COL_MESSAGE, MessagesTableMap::COL_SENDER, MessagesTableMap::COL_RECEIVER, MessagesTableMap::COL_DATE_SENT, MessagesTableMap::COL_DATE_READ, MessagesTableMap::COL_MESSAGE_TYPE, MessagesTableMap::COL_RECEIVED, MessagesTableMap::COL_RECEIVER_EMAIL, MessagesTableMap::COL_SUBJECT, ),
        self::TYPE_FIELDNAME     => array('message_id', 'message', 'sender', 'receiver', 'date_sent', 'date_read', 'message_type', 'received', 'receiver_email', 'subject', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('MessageId' => 0, 'Message' => 1, 'Sender' => 2, 'Receiver' => 3, 'DateSent' => 4, 'DateRead' => 5, 'MessageType' => 6, 'Received' => 7, 'ReceiverEmail' => 8, 'Subject' => 9, ),
        self::TYPE_CAMELNAME     => array('messageId' => 0, 'message' => 1, 'sender' => 2, 'receiver' => 3, 'dateSent' => 4, 'dateRead' => 5, 'messageType' => 6, 'received' => 7, 'receiverEmail' => 8, 'subject' => 9, ),
        self::TYPE_COLNAME       => array(MessagesTableMap::COL_MESSAGE_ID => 0, MessagesTableMap::COL_MESSAGE => 1, MessagesTableMap::COL_SENDER => 2, MessagesTableMap::COL_RECEIVER => 3, MessagesTableMap::COL_DATE_SENT => 4, MessagesTableMap::COL_DATE_READ => 5, MessagesTableMap::COL_MESSAGE_TYPE => 6, MessagesTableMap::COL_RECEIVED => 7, MessagesTableMap::COL_RECEIVER_EMAIL => 8, MessagesTableMap::COL_SUBJECT => 9, ),
        self::TYPE_FIELDNAME     => array('message_id' => 0, 'message' => 1, 'sender' => 2, 'receiver' => 3, 'date_sent' => 4, 'date_read' => 5, 'message_type' => 6, 'received' => 7, 'receiver_email' => 8, 'subject' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tf_messages');
        $this->setPhpName('Messages');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Messages');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('message_id', 'MessageId', 'INTEGER', true, 5, null);
        $this->addColumn('message', 'Message', 'VARCHAR', true, 255, null);
        $this->addColumn('sender', 'Sender', 'INTEGER', true, 5, null);
        $this->addColumn('receiver', 'Receiver', 'INTEGER', true, 5, null);
        $this->addColumn('date_sent', 'DateSent', 'TIMESTAMP', true, null, null);
        $this->addColumn('date_read', 'DateRead', 'TIMESTAMP', true, null, null);
        $this->addColumn('message_type', 'MessageType', 'VARCHAR', true, 16, null);
        $this->addColumn('received', 'Received', 'SMALLINT', true, 1, 0);
        $this->addColumn('receiver_email', 'ReceiverEmail', 'VARCHAR', false, 255, null);
        $this->addColumn('subject', 'Subject', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('MessageId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MessagesTableMap::CLASS_DEFAULT : MessagesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Messages object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MessagesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MessagesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MessagesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MessagesTableMap::OM_CLASS;
            /** @var Messages $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MessagesTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MessagesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MessagesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Messages $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MessagesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MessagesTableMap::COL_MESSAGE_ID);
            $criteria->addSelectColumn(MessagesTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(MessagesTableMap::COL_SENDER);
            $criteria->addSelectColumn(MessagesTableMap::COL_RECEIVER);
            $criteria->addSelectColumn(MessagesTableMap::COL_DATE_SENT);
            $criteria->addSelectColumn(MessagesTableMap::COL_DATE_READ);
            $criteria->addSelectColumn(MessagesTableMap::COL_MESSAGE_TYPE);
            $criteria->addSelectColumn(MessagesTableMap::COL_RECEIVED);
            $criteria->addSelectColumn(MessagesTableMap::COL_RECEIVER_EMAIL);
            $criteria->addSelectColumn(MessagesTableMap::COL_SUBJECT);
        } else {
            $criteria->addSelectColumn($alias . '.message_id');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.sender');
            $criteria->addSelectColumn($alias . '.receiver');
            $criteria->addSelectColumn($alias . '.date_sent');
            $criteria->addSelectColumn($alias . '.date_read');
            $criteria->addSelectColumn($alias . '.message_type');
            $criteria->addSelectColumn($alias . '.received');
            $criteria->addSelectColumn($alias . '.receiver_email');
            $criteria->addSelectColumn($alias . '.subject');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MessagesTableMap::DATABASE_NAME)->getTable(MessagesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MessagesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MessagesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MessagesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Messages or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Messages object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Messages) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MessagesTableMap::DATABASE_NAME);
            $criteria->add(MessagesTableMap::COL_MESSAGE_ID, (array) $values, Criteria::IN);
        }

        $query = MessagesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MessagesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MessagesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_messages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MessagesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Messages or Criteria object.
     *
     * @param mixed               $criteria Criteria or Messages object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessagesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Messages object
        }

        if ($criteria->containsKey(MessagesTableMap::COL_MESSAGE_ID) && $criteria->keyContainsValue(MessagesTableMap::COL_MESSAGE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MessagesTableMap::COL_MESSAGE_ID.')');
        }


        // Set the correct dbName
        $query = MessagesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MessagesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MessagesTableMap::buildTableMap();
