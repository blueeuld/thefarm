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
use TheFarm\Models\User;
use TheFarm\Models\UserQuery;


/**
 * This class defines the structure of the 'tf_users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'tf_users.user_id';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'tf_users.username';

    /**
     * the column name for the group_id field
     */
    const COL_GROUP_ID = 'tf_users.group_id';

    /**
     * the column name for the last_login field
     */
    const COL_LAST_LOGIN = 'tf_users.last_login';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'tf_users.password';

    /**
     * the column name for the work_plan field
     */
    const COL_WORK_PLAN = 'tf_users.work_plan';

    /**
     * the column name for the work_plan_code field
     */
    const COL_WORK_PLAN_CODE = 'tf_users.work_plan_code';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_users.location_id';

    /**
     * the column name for the facebook_id field
     */
    const COL_FACEBOOK_ID = 'tf_users.facebook_id';

    /**
     * the column name for the user_order field
     */
    const COL_USER_ORDER = 'tf_users.user_order';

    /**
     * the column name for the calendar_view_positions field
     */
    const COL_CALENDAR_VIEW_POSITIONS = 'tf_users.calendar_view_positions';

    /**
     * the column name for the calendar_view_status field
     */
    const COL_CALENDAR_VIEW_STATUS = 'tf_users.calendar_view_status';

    /**
     * the column name for the calendar_show_my_schedule_only field
     */
    const COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY = 'tf_users.calendar_show_my_schedule_only';

    /**
     * the column name for the calendar_view_locations field
     */
    const COL_CALENDAR_VIEW_LOCATIONS = 'tf_users.calendar_view_locations';

    /**
     * the column name for the preferences field
     */
    const COL_PREFERENCES = 'tf_users.preferences';

    /**
     * the column name for the calendar_show_no_schedule field
     */
    const COL_CALENDAR_SHOW_NO_SCHEDULE = 'tf_users.calendar_show_no_schedule';

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
        self::TYPE_PHPNAME       => array('UserId', 'Username', 'GroupId', 'LastLogin', 'Password', 'WorkPlan', 'WorkPlanCode', 'LocationId', 'FacebookId', 'UserOrder', 'CalendarViewPositions', 'CalendarViewStatus', 'CalendarShowMyScheduleOnly', 'CalendarViewLocations', 'Preferences', 'CalendarShowNoSchedule', ),
        self::TYPE_CAMELNAME     => array('userId', 'username', 'groupId', 'lastLogin', 'password', 'workPlan', 'workPlanCode', 'locationId', 'facebookId', 'userOrder', 'calendarViewPositions', 'calendarViewStatus', 'calendarShowMyScheduleOnly', 'calendarViewLocations', 'preferences', 'calendarShowNoSchedule', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USER_ID, UserTableMap::COL_USERNAME, UserTableMap::COL_GROUP_ID, UserTableMap::COL_LAST_LOGIN, UserTableMap::COL_PASSWORD, UserTableMap::COL_WORK_PLAN, UserTableMap::COL_WORK_PLAN_CODE, UserTableMap::COL_LOCATION_ID, UserTableMap::COL_FACEBOOK_ID, UserTableMap::COL_USER_ORDER, UserTableMap::COL_CALENDAR_VIEW_POSITIONS, UserTableMap::COL_CALENDAR_VIEW_STATUS, UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY, UserTableMap::COL_CALENDAR_VIEW_LOCATIONS, UserTableMap::COL_PREFERENCES, UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE, ),
        self::TYPE_FIELDNAME     => array('user_id', 'username', 'group_id', 'last_login', 'password', 'work_plan', 'work_plan_code', 'location_id', 'facebook_id', 'user_order', 'calendar_view_positions', 'calendar_view_status', 'calendar_show_my_schedule_only', 'calendar_view_locations', 'preferences', 'calendar_show_no_schedule', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('UserId' => 0, 'Username' => 1, 'GroupId' => 2, 'LastLogin' => 3, 'Password' => 4, 'WorkPlan' => 5, 'WorkPlanCode' => 6, 'LocationId' => 7, 'FacebookId' => 8, 'UserOrder' => 9, 'CalendarViewPositions' => 10, 'CalendarViewStatus' => 11, 'CalendarShowMyScheduleOnly' => 12, 'CalendarViewLocations' => 13, 'Preferences' => 14, 'CalendarShowNoSchedule' => 15, ),
        self::TYPE_CAMELNAME     => array('userId' => 0, 'username' => 1, 'groupId' => 2, 'lastLogin' => 3, 'password' => 4, 'workPlan' => 5, 'workPlanCode' => 6, 'locationId' => 7, 'facebookId' => 8, 'userOrder' => 9, 'calendarViewPositions' => 10, 'calendarViewStatus' => 11, 'calendarShowMyScheduleOnly' => 12, 'calendarViewLocations' => 13, 'preferences' => 14, 'calendarShowNoSchedule' => 15, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USER_ID => 0, UserTableMap::COL_USERNAME => 1, UserTableMap::COL_GROUP_ID => 2, UserTableMap::COL_LAST_LOGIN => 3, UserTableMap::COL_PASSWORD => 4, UserTableMap::COL_WORK_PLAN => 5, UserTableMap::COL_WORK_PLAN_CODE => 6, UserTableMap::COL_LOCATION_ID => 7, UserTableMap::COL_FACEBOOK_ID => 8, UserTableMap::COL_USER_ORDER => 9, UserTableMap::COL_CALENDAR_VIEW_POSITIONS => 10, UserTableMap::COL_CALENDAR_VIEW_STATUS => 11, UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY => 12, UserTableMap::COL_CALENDAR_VIEW_LOCATIONS => 13, UserTableMap::COL_PREFERENCES => 14, UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE => 15, ),
        self::TYPE_FIELDNAME     => array('user_id' => 0, 'username' => 1, 'group_id' => 2, 'last_login' => 3, 'password' => 4, 'work_plan' => 5, 'work_plan_code' => 6, 'location_id' => 7, 'facebook_id' => 8, 'user_order' => 9, 'calendar_view_positions' => 10, 'calendar_view_status' => 11, 'calendar_show_my_schedule_only' => 12, 'calendar_view_locations' => 13, 'preferences' => 14, 'calendar_show_no_schedule' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('tf_users');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\User');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('user_id', 'UserId', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 100, null);
        $this->addForeignKey('group_id', 'GroupId', 'INTEGER', 'tf_groups', 'group_id', false, null, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', true, 10, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 100, null);
        $this->addColumn('work_plan', 'WorkPlan', 'LONGVARCHAR', true, null, null);
        $this->addColumn('work_plan_code', 'WorkPlanCode', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('location_id', 'LocationId', 'INTEGER', 'tf_locations', 'location_id', false, null, null);
        $this->addColumn('facebook_id', 'FacebookId', 'VARCHAR', true, 50, null);
        $this->addColumn('user_order', 'UserOrder', 'INTEGER', true, 5, 0);
        $this->addColumn('calendar_view_positions', 'CalendarViewPositions', 'VARCHAR', false, 100, '');
        $this->addColumn('calendar_view_status', 'CalendarViewStatus', 'VARCHAR', false, 255, null);
        $this->addColumn('calendar_show_my_schedule_only', 'CalendarShowMyScheduleOnly', 'VARCHAR', false, 1, 'y');
        $this->addColumn('calendar_view_locations', 'CalendarViewLocations', 'VARCHAR', false, 100, '');
        $this->addColumn('preferences', 'Preferences', 'LONGVARCHAR', false, null, null);
        $this->addColumn('calendar_show_no_schedule', 'CalendarShowNoSchedule', 'VARCHAR', false, 1, 'y');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', '\\TheFarm\\Models\\Group', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':group_id',
    1 => ':group_id',
  ),
), null, null, null, false);
        $this->addRelation('Location', '\\TheFarm\\Models\\Location', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':location_id',
    1 => ':location_id',
  ),
), null, null, null, false);
        $this->addRelation('EventUser', '\\TheFarm\\Models\\EventUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':staff_id',
    1 => ':user_id',
  ),
), null, null, 'EventUsers', false);
        $this->addRelation('BookingEventRelatedByAuthorId', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':user_id',
  ),
), null, null, 'BookingEventsRelatedByAuthorId', false);
        $this->addRelation('BookingEventRelatedByCalledBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':called_by',
    1 => ':user_id',
  ),
), null, null, 'BookingEventsRelatedByCalledBy', false);
        $this->addRelation('BookingEventRelatedByCancelledBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cancelled_by',
    1 => ':user_id',
  ),
), null, null, 'BookingEventsRelatedByCancelledBy', false);
        $this->addRelation('BookingEventRelatedByDeletedBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':deleted_by',
    1 => ':user_id',
  ),
), null, null, 'BookingEventsRelatedByDeletedBy', false);
        $this->addRelation('Booking', '\\TheFarm\\Models\\Booking', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':user_id',
  ),
), null, null, 'Bookings', false);
        $this->addRelation('ItemsRelatedUser', '\\TheFarm\\Models\\ItemsRelatedUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':user_id',
  ),
), null, null, 'ItemsRelatedUsers', false);
        $this->addRelation('UserWorkPlanDay', '\\TheFarm\\Models\\UserWorkPlanDay', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':user_id',
  ),
), null, null, 'UserWorkPlanDays', false);
        $this->addRelation('ProviderSchedule', '\\TheFarm\\Models\\ProviderSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':user_id',
  ),
), null, null, 'ProviderSchedules', false);
        $this->addRelation('Item', '\\TheFarm\\Models\\Item', RelationMap::MANY_TO_MANY, array(), null, null, 'Items');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
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
     * @return array           (User object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
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
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UserTableMap::COL_GROUP_ID);
            $criteria->addSelectColumn(UserTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UserTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UserTableMap::COL_WORK_PLAN);
            $criteria->addSelectColumn(UserTableMap::COL_WORK_PLAN_CODE);
            $criteria->addSelectColumn(UserTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(UserTableMap::COL_FACEBOOK_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USER_ORDER);
            $criteria->addSelectColumn(UserTableMap::COL_CALENDAR_VIEW_POSITIONS);
            $criteria->addSelectColumn(UserTableMap::COL_CALENDAR_VIEW_STATUS);
            $criteria->addSelectColumn(UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY);
            $criteria->addSelectColumn(UserTableMap::COL_CALENDAR_VIEW_LOCATIONS);
            $criteria->addSelectColumn(UserTableMap::COL_PREFERENCES);
            $criteria->addSelectColumn(UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE);
        } else {
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.group_id');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.work_plan');
            $criteria->addSelectColumn($alias . '.work_plan_code');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.facebook_id');
            $criteria->addSelectColumn($alias . '.user_order');
            $criteria->addSelectColumn($alias . '.calendar_view_positions');
            $criteria->addSelectColumn($alias . '.calendar_view_status');
            $criteria->addSelectColumn($alias . '.calendar_show_my_schedule_only');
            $criteria->addSelectColumn($alias . '.calendar_view_locations');
            $criteria->addSelectColumn($alias . '.preferences');
            $criteria->addSelectColumn($alias . '.calendar_show_no_schedule');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_USER_ID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_USER_ID) && $criteria->keyContainsValue(UserTableMap::COL_USER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_USER_ID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserTableMap::buildTableMap();
