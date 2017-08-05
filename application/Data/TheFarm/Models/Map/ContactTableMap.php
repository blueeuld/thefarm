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
use TheFarm\Models\Contact;
use TheFarm\Models\ContactQuery;


/**
 * This class defines the structure of the 'tf_contacts' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ContactTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.ContactTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_contacts';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Contact';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Contact';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 27;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 27;

    /**
     * the column name for the contact_id field
     */
    const COL_CONTACT_ID = 'tf_contacts.contact_id';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'tf_contacts.first_name';

    /**
     * the column name for the last_name field
     */
    const COL_LAST_NAME = 'tf_contacts.last_name';

    /**
     * the column name for the middle_name field
     */
    const COL_MIDDLE_NAME = 'tf_contacts.middle_name';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'tf_contacts.email';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'tf_contacts.title';

    /**
     * the column name for the date_joined field
     */
    const COL_DATE_JOINED = 'tf_contacts.date_joined';

    /**
     * the column name for the avatar field
     */
    const COL_AVATAR = 'tf_contacts.avatar';

    /**
     * the column name for the civil_status field
     */
    const COL_CIVIL_STATUS = 'tf_contacts.civil_status';

    /**
     * the column name for the nationality field
     */
    const COL_NATIONALITY = 'tf_contacts.nationality';

    /**
     * the column name for the country_dominicile field
     */
    const COL_COUNTRY_DOMINICILE = 'tf_contacts.country_dominicile';

    /**
     * the column name for the etnic_origin field
     */
    const COL_ETNIC_ORIGIN = 'tf_contacts.etnic_origin';

    /**
     * the column name for the dob field
     */
    const COL_DOB = 'tf_contacts.dob';

    /**
     * the column name for the place_of_birth field
     */
    const COL_PLACE_OF_BIRTH = 'tf_contacts.place_of_birth';

    /**
     * the column name for the age field
     */
    const COL_AGE = 'tf_contacts.age';

    /**
     * the column name for the gender field
     */
    const COL_GENDER = 'tf_contacts.gender';

    /**
     * the column name for the height field
     */
    const COL_HEIGHT = 'tf_contacts.height';

    /**
     * the column name for the weight field
     */
    const COL_WEIGHT = 'tf_contacts.weight';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'tf_contacts.phone';

    /**
     * the column name for the position_cd field
     */
    const COL_POSITION_CD = 'tf_contacts.position_cd';

    /**
     * the column name for the is_active field
     */
    const COL_IS_ACTIVE = 'tf_contacts.is_active';

    /**
     * the column name for the verification_key field
     */
    const COL_VERIFICATION_KEY = 'tf_contacts.verification_key';

    /**
     * the column name for the verified field
     */
    const COL_VERIFIED = 'tf_contacts.verified';

    /**
     * the column name for the nickname field
     */
    const COL_NICKNAME = 'tf_contacts.nickname';

    /**
     * the column name for the bio field
     */
    const COL_BIO = 'tf_contacts.bio';

    /**
     * the column name for the approved field
     */
    const COL_APPROVED = 'tf_contacts.approved';

    /**
     * the column name for the activation_code field
     */
    const COL_ACTIVATION_CODE = 'tf_contacts.activation_code';

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
        self::TYPE_PHPNAME       => array('ContactId', 'FirstName', 'LastName', 'MiddleName', 'Email', 'Title', 'DateJoined', 'Avatar', 'CivilStatus', 'Nationality', 'CountryDominicile', 'EtnicOrigin', 'Dob', 'PlaceOfBirth', 'Age', 'Gender', 'Height', 'Weight', 'Phone', 'PositionCd', 'IsActive', 'VerificationKey', 'Verified', 'Nickname', 'Bio', 'Approved', 'ActivationCode', ),
        self::TYPE_CAMELNAME     => array('contactId', 'firstName', 'lastName', 'middleName', 'email', 'title', 'dateJoined', 'avatar', 'civilStatus', 'nationality', 'countryDominicile', 'etnicOrigin', 'dob', 'placeOfBirth', 'age', 'gender', 'height', 'weight', 'phone', 'positionCd', 'isActive', 'verificationKey', 'verified', 'nickname', 'bio', 'approved', 'activationCode', ),
        self::TYPE_COLNAME       => array(ContactTableMap::COL_CONTACT_ID, ContactTableMap::COL_FIRST_NAME, ContactTableMap::COL_LAST_NAME, ContactTableMap::COL_MIDDLE_NAME, ContactTableMap::COL_EMAIL, ContactTableMap::COL_TITLE, ContactTableMap::COL_DATE_JOINED, ContactTableMap::COL_AVATAR, ContactTableMap::COL_CIVIL_STATUS, ContactTableMap::COL_NATIONALITY, ContactTableMap::COL_COUNTRY_DOMINICILE, ContactTableMap::COL_ETNIC_ORIGIN, ContactTableMap::COL_DOB, ContactTableMap::COL_PLACE_OF_BIRTH, ContactTableMap::COL_AGE, ContactTableMap::COL_GENDER, ContactTableMap::COL_HEIGHT, ContactTableMap::COL_WEIGHT, ContactTableMap::COL_PHONE, ContactTableMap::COL_POSITION_CD, ContactTableMap::COL_IS_ACTIVE, ContactTableMap::COL_VERIFICATION_KEY, ContactTableMap::COL_VERIFIED, ContactTableMap::COL_NICKNAME, ContactTableMap::COL_BIO, ContactTableMap::COL_APPROVED, ContactTableMap::COL_ACTIVATION_CODE, ),
        self::TYPE_FIELDNAME     => array('contact_id', 'first_name', 'last_name', 'middle_name', 'email', 'title', 'date_joined', 'avatar', 'civil_status', 'nationality', 'country_dominicile', 'etnic_origin', 'dob', 'place_of_birth', 'age', 'gender', 'height', 'weight', 'phone', 'position_cd', 'is_active', 'verification_key', 'verified', 'nickname', 'bio', 'approved', 'activation_code', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ContactId' => 0, 'FirstName' => 1, 'LastName' => 2, 'MiddleName' => 3, 'Email' => 4, 'Title' => 5, 'DateJoined' => 6, 'Avatar' => 7, 'CivilStatus' => 8, 'Nationality' => 9, 'CountryDominicile' => 10, 'EtnicOrigin' => 11, 'Dob' => 12, 'PlaceOfBirth' => 13, 'Age' => 14, 'Gender' => 15, 'Height' => 16, 'Weight' => 17, 'Phone' => 18, 'PositionCd' => 19, 'IsActive' => 20, 'VerificationKey' => 21, 'Verified' => 22, 'Nickname' => 23, 'Bio' => 24, 'Approved' => 25, 'ActivationCode' => 26, ),
        self::TYPE_CAMELNAME     => array('contactId' => 0, 'firstName' => 1, 'lastName' => 2, 'middleName' => 3, 'email' => 4, 'title' => 5, 'dateJoined' => 6, 'avatar' => 7, 'civilStatus' => 8, 'nationality' => 9, 'countryDominicile' => 10, 'etnicOrigin' => 11, 'dob' => 12, 'placeOfBirth' => 13, 'age' => 14, 'gender' => 15, 'height' => 16, 'weight' => 17, 'phone' => 18, 'positionCd' => 19, 'isActive' => 20, 'verificationKey' => 21, 'verified' => 22, 'nickname' => 23, 'bio' => 24, 'approved' => 25, 'activationCode' => 26, ),
        self::TYPE_COLNAME       => array(ContactTableMap::COL_CONTACT_ID => 0, ContactTableMap::COL_FIRST_NAME => 1, ContactTableMap::COL_LAST_NAME => 2, ContactTableMap::COL_MIDDLE_NAME => 3, ContactTableMap::COL_EMAIL => 4, ContactTableMap::COL_TITLE => 5, ContactTableMap::COL_DATE_JOINED => 6, ContactTableMap::COL_AVATAR => 7, ContactTableMap::COL_CIVIL_STATUS => 8, ContactTableMap::COL_NATIONALITY => 9, ContactTableMap::COL_COUNTRY_DOMINICILE => 10, ContactTableMap::COL_ETNIC_ORIGIN => 11, ContactTableMap::COL_DOB => 12, ContactTableMap::COL_PLACE_OF_BIRTH => 13, ContactTableMap::COL_AGE => 14, ContactTableMap::COL_GENDER => 15, ContactTableMap::COL_HEIGHT => 16, ContactTableMap::COL_WEIGHT => 17, ContactTableMap::COL_PHONE => 18, ContactTableMap::COL_POSITION_CD => 19, ContactTableMap::COL_IS_ACTIVE => 20, ContactTableMap::COL_VERIFICATION_KEY => 21, ContactTableMap::COL_VERIFIED => 22, ContactTableMap::COL_NICKNAME => 23, ContactTableMap::COL_BIO => 24, ContactTableMap::COL_APPROVED => 25, ContactTableMap::COL_ACTIVATION_CODE => 26, ),
        self::TYPE_FIELDNAME     => array('contact_id' => 0, 'first_name' => 1, 'last_name' => 2, 'middle_name' => 3, 'email' => 4, 'title' => 5, 'date_joined' => 6, 'avatar' => 7, 'civil_status' => 8, 'nationality' => 9, 'country_dominicile' => 10, 'etnic_origin' => 11, 'dob' => 12, 'place_of_birth' => 13, 'age' => 14, 'gender' => 15, 'height' => 16, 'weight' => 17, 'phone' => 18, 'position_cd' => 19, 'is_active' => 20, 'verification_key' => 21, 'verified' => 22, 'nickname' => 23, 'bio' => 24, 'approved' => 25, 'activation_code' => 26, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
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
        $this->setName('tf_contacts');
        $this->setPhpName('Contact');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Contact');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('contact_id', 'ContactId', 'INTEGER', true, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 100, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 100, null);
        $this->addColumn('middle_name', 'MiddleName', 'VARCHAR', true, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 100, '');
        $this->addColumn('title', 'Title', 'VARCHAR', false, 10, null);
        $this->addColumn('date_joined', 'DateJoined', 'DATE', false, null, null);
        $this->addColumn('avatar', 'Avatar', 'VARCHAR', true, 255, '');
        $this->addColumn('civil_status', 'CivilStatus', 'VARCHAR', true, 20, '');
        $this->addColumn('nationality', 'Nationality', 'VARCHAR', true, 100, '');
        $this->addColumn('country_dominicile', 'CountryDominicile', 'VARCHAR', true, 3, 'PH');
        $this->addColumn('etnic_origin', 'EtnicOrigin', 'VARCHAR', true, 255, '');
        $this->addColumn('dob', 'Dob', 'DATE', false, null, null);
        $this->addColumn('place_of_birth', 'PlaceOfBirth', 'VARCHAR', true, 255, null);
        $this->addColumn('age', 'Age', 'INTEGER', false, 3, 0);
        $this->addColumn('gender', 'Gender', 'VARCHAR', true, 10, '');
        $this->addColumn('height', 'Height', 'VARCHAR', true, 10, '');
        $this->addColumn('weight', 'Weight', 'VARCHAR', true, 10, '');
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 50, '');
        $this->addForeignKey('position_cd', 'PositionCd', 'VARCHAR', 'tf_position', 'position_cd', false, 50, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, null);
        $this->addColumn('verification_key', 'VerificationKey', 'VARCHAR', false, 255, '');
        $this->addColumn('verified', 'Verified', 'VARCHAR', true, 1, 'n');
        $this->addColumn('nickname', 'Nickname', 'VARCHAR', false, 50, '');
        $this->addColumn('bio', 'Bio', 'LONGVARCHAR', true, null, null);
        $this->addColumn('approved', 'Approved', 'VARCHAR', true, 1, 'y');
        $this->addColumn('activation_code', 'ActivationCode', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Position', '\\TheFarm\\Models\\Position', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_cd',
    1 => ':position_cd',
  ),
), null, null, null, false);
        $this->addRelation('BookingEventUser', '\\TheFarm\\Models\\BookingEventUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':staff_id',
    1 => ':contact_id',
  ),
), null, null, 'BookingEventUsers', false);
        $this->addRelation('BookingEventRelatedByAuthorId', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':contact_id',
  ),
), null, null, 'BookingEventsRelatedByAuthorId', false);
        $this->addRelation('BookingEventRelatedByCalledBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':called_by',
    1 => ':contact_id',
  ),
), null, null, 'BookingEventsRelatedByCalledBy', false);
        $this->addRelation('BookingEventRelatedByCancelledBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cancelled_by',
    1 => ':contact_id',
  ),
), null, null, 'BookingEventsRelatedByCancelledBy', false);
        $this->addRelation('BookingEventRelatedByDeletedBy', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':deleted_by',
    1 => ':contact_id',
  ),
), null, null, 'BookingEventsRelatedByDeletedBy', false);
        $this->addRelation('BookingRelatedByAuthorId', '\\TheFarm\\Models\\Booking', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':contact_id',
  ),
), null, null, 'BookingsRelatedByAuthorId', false);
        $this->addRelation('BookingRelatedByGuestId', '\\TheFarm\\Models\\Booking', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':guest_id',
    1 => ':contact_id',
  ),
), null, null, 'BookingsRelatedByGuestId', false);
        $this->addRelation('ItemsRelatedUser', '\\TheFarm\\Models\\ItemsRelatedUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':contact_id',
  ),
), null, null, 'ItemsRelatedUsers', false);
        $this->addRelation('User', '\\TheFarm\\Models\\User', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':contact_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ContactTableMap::CLASS_DEFAULT : ContactTableMap::OM_CLASS;
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
     * @return array           (Contact object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ContactTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ContactTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ContactTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ContactTableMap::OM_CLASS;
            /** @var Contact $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ContactTableMap::addInstanceToPool($obj, $key);
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
            $key = ContactTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ContactTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Contact $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ContactTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ContactTableMap::COL_CONTACT_ID);
            $criteria->addSelectColumn(ContactTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(ContactTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(ContactTableMap::COL_MIDDLE_NAME);
            $criteria->addSelectColumn(ContactTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ContactTableMap::COL_TITLE);
            $criteria->addSelectColumn(ContactTableMap::COL_DATE_JOINED);
            $criteria->addSelectColumn(ContactTableMap::COL_AVATAR);
            $criteria->addSelectColumn(ContactTableMap::COL_CIVIL_STATUS);
            $criteria->addSelectColumn(ContactTableMap::COL_NATIONALITY);
            $criteria->addSelectColumn(ContactTableMap::COL_COUNTRY_DOMINICILE);
            $criteria->addSelectColumn(ContactTableMap::COL_ETNIC_ORIGIN);
            $criteria->addSelectColumn(ContactTableMap::COL_DOB);
            $criteria->addSelectColumn(ContactTableMap::COL_PLACE_OF_BIRTH);
            $criteria->addSelectColumn(ContactTableMap::COL_AGE);
            $criteria->addSelectColumn(ContactTableMap::COL_GENDER);
            $criteria->addSelectColumn(ContactTableMap::COL_HEIGHT);
            $criteria->addSelectColumn(ContactTableMap::COL_WEIGHT);
            $criteria->addSelectColumn(ContactTableMap::COL_PHONE);
            $criteria->addSelectColumn(ContactTableMap::COL_POSITION_CD);
            $criteria->addSelectColumn(ContactTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(ContactTableMap::COL_VERIFICATION_KEY);
            $criteria->addSelectColumn(ContactTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(ContactTableMap::COL_NICKNAME);
            $criteria->addSelectColumn(ContactTableMap::COL_BIO);
            $criteria->addSelectColumn(ContactTableMap::COL_APPROVED);
            $criteria->addSelectColumn(ContactTableMap::COL_ACTIVATION_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.contact_id');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.middle_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.date_joined');
            $criteria->addSelectColumn($alias . '.avatar');
            $criteria->addSelectColumn($alias . '.civil_status');
            $criteria->addSelectColumn($alias . '.nationality');
            $criteria->addSelectColumn($alias . '.country_dominicile');
            $criteria->addSelectColumn($alias . '.etnic_origin');
            $criteria->addSelectColumn($alias . '.dob');
            $criteria->addSelectColumn($alias . '.place_of_birth');
            $criteria->addSelectColumn($alias . '.age');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.height');
            $criteria->addSelectColumn($alias . '.weight');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.position_cd');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.verification_key');
            $criteria->addSelectColumn($alias . '.verified');
            $criteria->addSelectColumn($alias . '.nickname');
            $criteria->addSelectColumn($alias . '.bio');
            $criteria->addSelectColumn($alias . '.approved');
            $criteria->addSelectColumn($alias . '.activation_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(ContactTableMap::DATABASE_NAME)->getTable(ContactTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ContactTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ContactTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ContactTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Contact or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Contact object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Contact) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ContactTableMap::DATABASE_NAME);
            $criteria->add(ContactTableMap::COL_CONTACT_ID, (array) $values, Criteria::IN);
        }

        $query = ContactQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ContactTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ContactTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_contacts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ContactQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Contact or Criteria object.
     *
     * @param mixed               $criteria Criteria or Contact object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Contact object
        }

        if ($criteria->containsKey(ContactTableMap::COL_CONTACT_ID) && $criteria->keyContainsValue(ContactTableMap::COL_CONTACT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ContactTableMap::COL_CONTACT_ID.')');
        }


        // Set the correct dbName
        $query = ContactQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ContactTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ContactTableMap::buildTableMap();
