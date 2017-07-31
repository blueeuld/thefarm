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
use TheFarm\Models\Contacts as ChildContacts;
use TheFarm\Models\ContactsQuery as ChildContactsQuery;
use TheFarm\Models\Map\ContactsTableMap;

/**
 * Base class that represents a query for the 'tf_contacts' table.
 *
 *
 *
 * @method     ChildContactsQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildContactsQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildContactsQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildContactsQuery orderByMiddleName($order = Criteria::ASC) Order by the middle_name column
 * @method     ChildContactsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildContactsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildContactsQuery orderByDateJoined($order = Criteria::ASC) Order by the date_joined column
 * @method     ChildContactsQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildContactsQuery orderByCivilStatus($order = Criteria::ASC) Order by the civil_status column
 * @method     ChildContactsQuery orderByNationality($order = Criteria::ASC) Order by the nationality column
 * @method     ChildContactsQuery orderByCountryDominicile($order = Criteria::ASC) Order by the country_dominicile column
 * @method     ChildContactsQuery orderByEtnicOrigin($order = Criteria::ASC) Order by the etnic_origin column
 * @method     ChildContactsQuery orderByDob($order = Criteria::ASC) Order by the dob column
 * @method     ChildContactsQuery orderByPlaceOfBirth($order = Criteria::ASC) Order by the place_of_birth column
 * @method     ChildContactsQuery orderByAge($order = Criteria::ASC) Order by the age column
 * @method     ChildContactsQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildContactsQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method     ChildContactsQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildContactsQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildContactsQuery orderByPositionCd($order = Criteria::ASC) Order by the position_cd column
 * @method     ChildContactsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildContactsQuery orderByVerificationKey($order = Criteria::ASC) Order by the verification_key column
 * @method     ChildContactsQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildContactsQuery orderByNickname($order = Criteria::ASC) Order by the nickname column
 * @method     ChildContactsQuery orderByBio($order = Criteria::ASC) Order by the bio column
 * @method     ChildContactsQuery orderByApproved($order = Criteria::ASC) Order by the approved column
 * @method     ChildContactsQuery orderByActivationCode($order = Criteria::ASC) Order by the activation_code column
 * @method     ChildContactsQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method     ChildContactsQuery groupByContactId() Group by the contact_id column
 * @method     ChildContactsQuery groupByFirstName() Group by the first_name column
 * @method     ChildContactsQuery groupByLastName() Group by the last_name column
 * @method     ChildContactsQuery groupByMiddleName() Group by the middle_name column
 * @method     ChildContactsQuery groupByEmail() Group by the email column
 * @method     ChildContactsQuery groupByTitle() Group by the title column
 * @method     ChildContactsQuery groupByDateJoined() Group by the date_joined column
 * @method     ChildContactsQuery groupByAvatar() Group by the avatar column
 * @method     ChildContactsQuery groupByCivilStatus() Group by the civil_status column
 * @method     ChildContactsQuery groupByNationality() Group by the nationality column
 * @method     ChildContactsQuery groupByCountryDominicile() Group by the country_dominicile column
 * @method     ChildContactsQuery groupByEtnicOrigin() Group by the etnic_origin column
 * @method     ChildContactsQuery groupByDob() Group by the dob column
 * @method     ChildContactsQuery groupByPlaceOfBirth() Group by the place_of_birth column
 * @method     ChildContactsQuery groupByAge() Group by the age column
 * @method     ChildContactsQuery groupByGender() Group by the gender column
 * @method     ChildContactsQuery groupByHeight() Group by the height column
 * @method     ChildContactsQuery groupByWeight() Group by the weight column
 * @method     ChildContactsQuery groupByPhone() Group by the phone column
 * @method     ChildContactsQuery groupByPositionCd() Group by the position_cd column
 * @method     ChildContactsQuery groupByIsActive() Group by the is_active column
 * @method     ChildContactsQuery groupByVerificationKey() Group by the verification_key column
 * @method     ChildContactsQuery groupByVerified() Group by the verified column
 * @method     ChildContactsQuery groupByNickname() Group by the nickname column
 * @method     ChildContactsQuery groupByBio() Group by the bio column
 * @method     ChildContactsQuery groupByApproved() Group by the approved column
 * @method     ChildContactsQuery groupByActivationCode() Group by the activation_code column
 * @method     ChildContactsQuery groupByActive() Group by the active column
 *
 * @method     ChildContactsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildContactsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildContactsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildContactsQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildContactsQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildContactsQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildContactsQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildContactsQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildContactsQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildContactsQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     ChildContactsQuery leftJoinBookingEventUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventUsers relation
 * @method     ChildContactsQuery rightJoinBookingEventUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventUsers relation
 * @method     ChildContactsQuery innerJoinBookingEventUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventUsers relation
 *
 * @method     ChildContactsQuery joinWithBookingEventUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventUsers relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingEventUsers() Adds a LEFT JOIN clause and with to the query using the BookingEventUsers relation
 * @method     ChildContactsQuery rightJoinWithBookingEventUsers() Adds a RIGHT JOIN clause and with to the query using the BookingEventUsers relation
 * @method     ChildContactsQuery innerJoinWithBookingEventUsers() Adds a INNER JOIN clause and with to the query using the BookingEventUsers relation
 *
 * @method     ChildContactsQuery leftJoinBookingEventsRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventsRelatedByAuthorId relation
 * @method     ChildContactsQuery rightJoinBookingEventsRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventsRelatedByAuthorId relation
 * @method     ChildContactsQuery innerJoinBookingEventsRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery joinWithBookingEventsRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingEventsRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the BookingEventsRelatedByAuthorId relation
 * @method     ChildContactsQuery rightJoinWithBookingEventsRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the BookingEventsRelatedByAuthorId relation
 * @method     ChildContactsQuery innerJoinWithBookingEventsRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the BookingEventsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery leftJoinBookingEventsRelatedByCalledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventsRelatedByCalledBy relation
 * @method     ChildContactsQuery rightJoinBookingEventsRelatedByCalledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventsRelatedByCalledBy relation
 * @method     ChildContactsQuery innerJoinBookingEventsRelatedByCalledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventsRelatedByCalledBy relation
 *
 * @method     ChildContactsQuery joinWithBookingEventsRelatedByCalledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventsRelatedByCalledBy relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingEventsRelatedByCalledBy() Adds a LEFT JOIN clause and with to the query using the BookingEventsRelatedByCalledBy relation
 * @method     ChildContactsQuery rightJoinWithBookingEventsRelatedByCalledBy() Adds a RIGHT JOIN clause and with to the query using the BookingEventsRelatedByCalledBy relation
 * @method     ChildContactsQuery innerJoinWithBookingEventsRelatedByCalledBy() Adds a INNER JOIN clause and with to the query using the BookingEventsRelatedByCalledBy relation
 *
 * @method     ChildContactsQuery leftJoinBookingEventsRelatedByCancelledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventsRelatedByCancelledBy relation
 * @method     ChildContactsQuery rightJoinBookingEventsRelatedByCancelledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventsRelatedByCancelledBy relation
 * @method     ChildContactsQuery innerJoinBookingEventsRelatedByCancelledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventsRelatedByCancelledBy relation
 *
 * @method     ChildContactsQuery joinWithBookingEventsRelatedByCancelledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventsRelatedByCancelledBy relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingEventsRelatedByCancelledBy() Adds a LEFT JOIN clause and with to the query using the BookingEventsRelatedByCancelledBy relation
 * @method     ChildContactsQuery rightJoinWithBookingEventsRelatedByCancelledBy() Adds a RIGHT JOIN clause and with to the query using the BookingEventsRelatedByCancelledBy relation
 * @method     ChildContactsQuery innerJoinWithBookingEventsRelatedByCancelledBy() Adds a INNER JOIN clause and with to the query using the BookingEventsRelatedByCancelledBy relation
 *
 * @method     ChildContactsQuery leftJoinBookingEventsRelatedByDeletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventsRelatedByDeletedBy relation
 * @method     ChildContactsQuery rightJoinBookingEventsRelatedByDeletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventsRelatedByDeletedBy relation
 * @method     ChildContactsQuery innerJoinBookingEventsRelatedByDeletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventsRelatedByDeletedBy relation
 *
 * @method     ChildContactsQuery joinWithBookingEventsRelatedByDeletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventsRelatedByDeletedBy relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingEventsRelatedByDeletedBy() Adds a LEFT JOIN clause and with to the query using the BookingEventsRelatedByDeletedBy relation
 * @method     ChildContactsQuery rightJoinWithBookingEventsRelatedByDeletedBy() Adds a RIGHT JOIN clause and with to the query using the BookingEventsRelatedByDeletedBy relation
 * @method     ChildContactsQuery innerJoinWithBookingEventsRelatedByDeletedBy() Adds a INNER JOIN clause and with to the query using the BookingEventsRelatedByDeletedBy relation
 *
 * @method     ChildContactsQuery leftJoinBookingsRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingsRelatedByAuthorId relation
 * @method     ChildContactsQuery rightJoinBookingsRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingsRelatedByAuthorId relation
 * @method     ChildContactsQuery innerJoinBookingsRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery joinWithBookingsRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingsRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the BookingsRelatedByAuthorId relation
 * @method     ChildContactsQuery rightJoinWithBookingsRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the BookingsRelatedByAuthorId relation
 * @method     ChildContactsQuery innerJoinWithBookingsRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the BookingsRelatedByAuthorId relation
 *
 * @method     ChildContactsQuery leftJoinBookingsRelatedByGuestId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingsRelatedByGuestId relation
 * @method     ChildContactsQuery rightJoinBookingsRelatedByGuestId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingsRelatedByGuestId relation
 * @method     ChildContactsQuery innerJoinBookingsRelatedByGuestId($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingsRelatedByGuestId relation
 *
 * @method     ChildContactsQuery joinWithBookingsRelatedByGuestId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingsRelatedByGuestId relation
 *
 * @method     ChildContactsQuery leftJoinWithBookingsRelatedByGuestId() Adds a LEFT JOIN clause and with to the query using the BookingsRelatedByGuestId relation
 * @method     ChildContactsQuery rightJoinWithBookingsRelatedByGuestId() Adds a RIGHT JOIN clause and with to the query using the BookingsRelatedByGuestId relation
 * @method     ChildContactsQuery innerJoinWithBookingsRelatedByGuestId() Adds a INNER JOIN clause and with to the query using the BookingsRelatedByGuestId relation
 *
 * @method     ChildContactsQuery leftJoinItemsRelatedUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemsRelatedUsers relation
 * @method     ChildContactsQuery rightJoinItemsRelatedUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemsRelatedUsers relation
 * @method     ChildContactsQuery innerJoinItemsRelatedUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemsRelatedUsers relation
 *
 * @method     ChildContactsQuery joinWithItemsRelatedUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemsRelatedUsers relation
 *
 * @method     ChildContactsQuery leftJoinWithItemsRelatedUsers() Adds a LEFT JOIN clause and with to the query using the ItemsRelatedUsers relation
 * @method     ChildContactsQuery rightJoinWithItemsRelatedUsers() Adds a RIGHT JOIN clause and with to the query using the ItemsRelatedUsers relation
 * @method     ChildContactsQuery innerJoinWithItemsRelatedUsers() Adds a INNER JOIN clause and with to the query using the ItemsRelatedUsers relation
 *
 * @method     ChildContactsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildContactsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildContactsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildContactsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildContactsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildContactsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildContactsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \TheFarm\Models\PositionQuery|\TheFarm\Models\BookingEventUsersQuery|\TheFarm\Models\BookingEventsQuery|\TheFarm\Models\BookingsQuery|\TheFarm\Models\ItemsRelatedUsersQuery|\TheFarm\Models\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildContacts findOne(ConnectionInterface $con = null) Return the first ChildContacts matching the query
 * @method     ChildContacts findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContacts matching the query, or a new ChildContacts object populated from the query conditions when no match is found
 *
 * @method     ChildContacts findOneByContactId(int $contact_id) Return the first ChildContacts filtered by the contact_id column
 * @method     ChildContacts findOneByFirstName(string $first_name) Return the first ChildContacts filtered by the first_name column
 * @method     ChildContacts findOneByLastName(string $last_name) Return the first ChildContacts filtered by the last_name column
 * @method     ChildContacts findOneByMiddleName(string $middle_name) Return the first ChildContacts filtered by the middle_name column
 * @method     ChildContacts findOneByEmail(string $email) Return the first ChildContacts filtered by the email column
 * @method     ChildContacts findOneByTitle(string $title) Return the first ChildContacts filtered by the title column
 * @method     ChildContacts findOneByDateJoined(string $date_joined) Return the first ChildContacts filtered by the date_joined column
 * @method     ChildContacts findOneByAvatar(string $avatar) Return the first ChildContacts filtered by the avatar column
 * @method     ChildContacts findOneByCivilStatus(string $civil_status) Return the first ChildContacts filtered by the civil_status column
 * @method     ChildContacts findOneByNationality(string $nationality) Return the first ChildContacts filtered by the nationality column
 * @method     ChildContacts findOneByCountryDominicile(string $country_dominicile) Return the first ChildContacts filtered by the country_dominicile column
 * @method     ChildContacts findOneByEtnicOrigin(string $etnic_origin) Return the first ChildContacts filtered by the etnic_origin column
 * @method     ChildContacts findOneByDob(string $dob) Return the first ChildContacts filtered by the dob column
 * @method     ChildContacts findOneByPlaceOfBirth(string $place_of_birth) Return the first ChildContacts filtered by the place_of_birth column
 * @method     ChildContacts findOneByAge(int $age) Return the first ChildContacts filtered by the age column
 * @method     ChildContacts findOneByGender(string $gender) Return the first ChildContacts filtered by the gender column
 * @method     ChildContacts findOneByHeight(string $height) Return the first ChildContacts filtered by the height column
 * @method     ChildContacts findOneByWeight(string $weight) Return the first ChildContacts filtered by the weight column
 * @method     ChildContacts findOneByPhone(string $phone) Return the first ChildContacts filtered by the phone column
 * @method     ChildContacts findOneByPositionCd(string $position_cd) Return the first ChildContacts filtered by the position_cd column
 * @method     ChildContacts findOneByIsActive(boolean $is_active) Return the first ChildContacts filtered by the is_active column
 * @method     ChildContacts findOneByVerificationKey(string $verification_key) Return the first ChildContacts filtered by the verification_key column
 * @method     ChildContacts findOneByVerified(string $verified) Return the first ChildContacts filtered by the verified column
 * @method     ChildContacts findOneByNickname(string $nickname) Return the first ChildContacts filtered by the nickname column
 * @method     ChildContacts findOneByBio(string $bio) Return the first ChildContacts filtered by the bio column
 * @method     ChildContacts findOneByApproved(string $approved) Return the first ChildContacts filtered by the approved column
 * @method     ChildContacts findOneByActivationCode(int $activation_code) Return the first ChildContacts filtered by the activation_code column
 * @method     ChildContacts findOneByActive(string $active) Return the first ChildContacts filtered by the active column *

 * @method     ChildContacts requirePk($key, ConnectionInterface $con = null) Return the ChildContacts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOne(ConnectionInterface $con = null) Return the first ChildContacts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContacts requireOneByContactId(int $contact_id) Return the first ChildContacts filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByFirstName(string $first_name) Return the first ChildContacts filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByLastName(string $last_name) Return the first ChildContacts filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByMiddleName(string $middle_name) Return the first ChildContacts filtered by the middle_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByEmail(string $email) Return the first ChildContacts filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByTitle(string $title) Return the first ChildContacts filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByDateJoined(string $date_joined) Return the first ChildContacts filtered by the date_joined column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByAvatar(string $avatar) Return the first ChildContacts filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByCivilStatus(string $civil_status) Return the first ChildContacts filtered by the civil_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByNationality(string $nationality) Return the first ChildContacts filtered by the nationality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByCountryDominicile(string $country_dominicile) Return the first ChildContacts filtered by the country_dominicile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByEtnicOrigin(string $etnic_origin) Return the first ChildContacts filtered by the etnic_origin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByDob(string $dob) Return the first ChildContacts filtered by the dob column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByPlaceOfBirth(string $place_of_birth) Return the first ChildContacts filtered by the place_of_birth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByAge(int $age) Return the first ChildContacts filtered by the age column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByGender(string $gender) Return the first ChildContacts filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByHeight(string $height) Return the first ChildContacts filtered by the height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByWeight(string $weight) Return the first ChildContacts filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByPhone(string $phone) Return the first ChildContacts filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByPositionCd(string $position_cd) Return the first ChildContacts filtered by the position_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByIsActive(boolean $is_active) Return the first ChildContacts filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByVerificationKey(string $verification_key) Return the first ChildContacts filtered by the verification_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByVerified(string $verified) Return the first ChildContacts filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByNickname(string $nickname) Return the first ChildContacts filtered by the nickname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByBio(string $bio) Return the first ChildContacts filtered by the bio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByApproved(string $approved) Return the first ChildContacts filtered by the approved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByActivationCode(int $activation_code) Return the first ChildContacts filtered by the activation_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContacts requireOneByActive(string $active) Return the first ChildContacts filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContacts[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContacts objects based on current ModelCriteria
 * @method     ChildContacts[]|ObjectCollection findByContactId(int $contact_id) Return ChildContacts objects filtered by the contact_id column
 * @method     ChildContacts[]|ObjectCollection findByFirstName(string $first_name) Return ChildContacts objects filtered by the first_name column
 * @method     ChildContacts[]|ObjectCollection findByLastName(string $last_name) Return ChildContacts objects filtered by the last_name column
 * @method     ChildContacts[]|ObjectCollection findByMiddleName(string $middle_name) Return ChildContacts objects filtered by the middle_name column
 * @method     ChildContacts[]|ObjectCollection findByEmail(string $email) Return ChildContacts objects filtered by the email column
 * @method     ChildContacts[]|ObjectCollection findByTitle(string $title) Return ChildContacts objects filtered by the title column
 * @method     ChildContacts[]|ObjectCollection findByDateJoined(string $date_joined) Return ChildContacts objects filtered by the date_joined column
 * @method     ChildContacts[]|ObjectCollection findByAvatar(string $avatar) Return ChildContacts objects filtered by the avatar column
 * @method     ChildContacts[]|ObjectCollection findByCivilStatus(string $civil_status) Return ChildContacts objects filtered by the civil_status column
 * @method     ChildContacts[]|ObjectCollection findByNationality(string $nationality) Return ChildContacts objects filtered by the nationality column
 * @method     ChildContacts[]|ObjectCollection findByCountryDominicile(string $country_dominicile) Return ChildContacts objects filtered by the country_dominicile column
 * @method     ChildContacts[]|ObjectCollection findByEtnicOrigin(string $etnic_origin) Return ChildContacts objects filtered by the etnic_origin column
 * @method     ChildContacts[]|ObjectCollection findByDob(string $dob) Return ChildContacts objects filtered by the dob column
 * @method     ChildContacts[]|ObjectCollection findByPlaceOfBirth(string $place_of_birth) Return ChildContacts objects filtered by the place_of_birth column
 * @method     ChildContacts[]|ObjectCollection findByAge(int $age) Return ChildContacts objects filtered by the age column
 * @method     ChildContacts[]|ObjectCollection findByGender(string $gender) Return ChildContacts objects filtered by the gender column
 * @method     ChildContacts[]|ObjectCollection findByHeight(string $height) Return ChildContacts objects filtered by the height column
 * @method     ChildContacts[]|ObjectCollection findByWeight(string $weight) Return ChildContacts objects filtered by the weight column
 * @method     ChildContacts[]|ObjectCollection findByPhone(string $phone) Return ChildContacts objects filtered by the phone column
 * @method     ChildContacts[]|ObjectCollection findByPositionCd(string $position_cd) Return ChildContacts objects filtered by the position_cd column
 * @method     ChildContacts[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildContacts objects filtered by the is_active column
 * @method     ChildContacts[]|ObjectCollection findByVerificationKey(string $verification_key) Return ChildContacts objects filtered by the verification_key column
 * @method     ChildContacts[]|ObjectCollection findByVerified(string $verified) Return ChildContacts objects filtered by the verified column
 * @method     ChildContacts[]|ObjectCollection findByNickname(string $nickname) Return ChildContacts objects filtered by the nickname column
 * @method     ChildContacts[]|ObjectCollection findByBio(string $bio) Return ChildContacts objects filtered by the bio column
 * @method     ChildContacts[]|ObjectCollection findByApproved(string $approved) Return ChildContacts objects filtered by the approved column
 * @method     ChildContacts[]|ObjectCollection findByActivationCode(int $activation_code) Return ChildContacts objects filtered by the activation_code column
 * @method     ChildContacts[]|ObjectCollection findByActive(string $active) Return ChildContacts objects filtered by the active column
 * @method     ChildContacts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContactsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ContactsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Contacts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContactsQuery) {
            return $criteria;
        }
        $query = new ChildContactsQuery();
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
     * @return ChildContacts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ContactsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildContacts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT contact_id, first_name, last_name, middle_name, email, title, date_joined, avatar, civil_status, nationality, country_dominicile, etnic_origin, dob, place_of_birth, age, gender, height, weight, phone, position_cd, is_active, verification_key, verified, nickname, bio, approved, activation_code, active FROM tf_contacts WHERE contact_id = :p0';
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
            /** @var ChildContacts $obj */
            $obj = new ChildContacts();
            $obj->hydrate($row);
            ContactsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildContacts|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $contactId, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_FIRST_NAME, $firstName, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_LAST_NAME, $lastName, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByMiddleName($middleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_MIDDLE_NAME, $middleName, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByDateJoined($dateJoined = null, $comparison = null)
    {
        if (is_array($dateJoined)) {
            $useMinMax = false;
            if (isset($dateJoined['min'])) {
                $this->addUsingAlias(ContactsTableMap::COL_DATE_JOINED, $dateJoined['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateJoined['max'])) {
                $this->addUsingAlias(ContactsTableMap::COL_DATE_JOINED, $dateJoined['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_DATE_JOINED, $dateJoined, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_AVATAR, $avatar, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByCivilStatus($civilStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civilStatus)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_CIVIL_STATUS, $civilStatus, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByNationality($nationality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nationality)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_NATIONALITY, $nationality, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByCountryDominicile($countryDominicile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryDominicile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_COUNTRY_DOMINICILE, $countryDominicile, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByEtnicOrigin($etnicOrigin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etnicOrigin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_ETNIC_ORIGIN, $etnicOrigin, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByDob($dob = null, $comparison = null)
    {
        if (is_array($dob)) {
            $useMinMax = false;
            if (isset($dob['min'])) {
                $this->addUsingAlias(ContactsTableMap::COL_DOB, $dob['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dob['max'])) {
                $this->addUsingAlias(ContactsTableMap::COL_DOB, $dob['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_DOB, $dob, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPlaceOfBirth($placeOfBirth = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placeOfBirth)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_PLACE_OF_BIRTH, $placeOfBirth, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByAge($age = null, $comparison = null)
    {
        if (is_array($age)) {
            $useMinMax = false;
            if (isset($age['min'])) {
                $this->addUsingAlias(ContactsTableMap::COL_AGE, $age['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($age['max'])) {
                $this->addUsingAlias(ContactsTableMap::COL_AGE, $age['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_AGE, $age, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_GENDER, $gender, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($height)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_HEIGHT, $height, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($weight)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_WEIGHT, $weight, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPositionCd($positionCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_POSITION_CD, $positionCd, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     boolean|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContactsTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query on the verification_key column
     *
     * Example usage:
     * <code>
     * $query->filterByVerificationKey('fooValue');   // WHERE verification_key = 'fooValue'
     * $query->filterByVerificationKey('%fooValue%', Criteria::LIKE); // WHERE verification_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $verificationKey The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByVerificationKey($verificationKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($verificationKey)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_VERIFICATION_KEY, $verificationKey, $comparison);
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified('fooValue');   // WHERE verified = 'fooValue'
     * $query->filterByVerified('%fooValue%', Criteria::LIKE); // WHERE verified LIKE '%fooValue%'
     * </code>
     *
     * @param     string $verified The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByVerified($verified = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($verified)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_VERIFIED, $verified, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByNickname($nickname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nickname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_NICKNAME, $nickname, $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBio($bio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bio)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_BIO, $bio, $comparison);
    }

    /**
     * Filter the query on the approved column
     *
     * Example usage:
     * <code>
     * $query->filterByApproved('fooValue');   // WHERE approved = 'fooValue'
     * $query->filterByApproved('%fooValue%', Criteria::LIKE); // WHERE approved LIKE '%fooValue%'
     * </code>
     *
     * @param     string $approved The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByApproved($approved = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($approved)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_APPROVED, $approved, $comparison);
    }

    /**
     * Filter the query on the activation_code column
     *
     * Example usage:
     * <code>
     * $query->filterByActivationCode(1234); // WHERE activation_code = 1234
     * $query->filterByActivationCode(array(12, 34)); // WHERE activation_code IN (12, 34)
     * $query->filterByActivationCode(array('min' => 12)); // WHERE activation_code > 12
     * </code>
     *
     * @param     mixed $activationCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByActivationCode($activationCode = null, $comparison = null)
    {
        if (is_array($activationCode)) {
            $useMinMax = false;
            if (isset($activationCode['min'])) {
                $this->addUsingAlias(ContactsTableMap::COL_ACTIVATION_CODE, $activationCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activationCode['max'])) {
                $this->addUsingAlias(ContactsTableMap::COL_ACTIVATION_CODE, $activationCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_ACTIVATION_CODE, $activationCode, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive('fooValue');   // WHERE active = 'fooValue'
     * $query->filterByActive('%fooValue%', Criteria::LIKE); // WHERE active LIKE '%fooValue%'
     * </code>
     *
     * @param     string $active The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($active)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactsTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Position object
     *
     * @param \TheFarm\Models\Position|ObjectCollection $position The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \TheFarm\Models\Position) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_POSITION_CD, $position->getPositionCd(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContactsTableMap::COL_POSITION_CD, $position->toKeyValue('PrimaryKey', 'PositionCd'), $comparison);
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
     * @return $this|ChildContactsQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\BookingEventUsers object
     *
     * @param \TheFarm\Models\BookingEventUsers|ObjectCollection $bookingEventUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingEventUsers($bookingEventUsers, $comparison = null)
    {
        if ($bookingEventUsers instanceof \TheFarm\Models\BookingEventUsers) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookingEventUsers->getStaffId(), $comparison);
        } elseif ($bookingEventUsers instanceof ObjectCollection) {
            return $this
                ->useBookingEventUsersQuery()
                ->filterByPrimaryKeys($bookingEventUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventUsers() only accepts arguments of type \TheFarm\Models\BookingEventUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingEventUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventUsers');

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
            $this->addJoinObject($join, 'BookingEventUsers');
        }

        return $this;
    }

    /**
     * Use the BookingEventUsers relation BookingEventUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventUsersQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingEventUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventUsers', '\TheFarm\Models\BookingEventUsersQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingEventsRelatedByAuthorId($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookingEvents->getAuthorId(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            return $this
                ->useBookingEventsRelatedByAuthorIdQuery()
                ->filterByPrimaryKeys($bookingEvents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventsRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventsRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingEventsRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventsRelatedByAuthorId');

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
            $this->addJoinObject($join, 'BookingEventsRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the BookingEventsRelatedByAuthorId relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEventsRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventsRelatedByAuthorId', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingEventsRelatedByCalledBy($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookingEvents->getCalledBy(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            return $this
                ->useBookingEventsRelatedByCalledByQuery()
                ->filterByPrimaryKeys($bookingEvents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventsRelatedByCalledBy() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventsRelatedByCalledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingEventsRelatedByCalledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventsRelatedByCalledBy');

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
            $this->addJoinObject($join, 'BookingEventsRelatedByCalledBy');
        }

        return $this;
    }

    /**
     * Use the BookingEventsRelatedByCalledBy relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsRelatedByCalledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEventsRelatedByCalledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventsRelatedByCalledBy', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingEventsRelatedByCancelledBy($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookingEvents->getCancelledBy(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            return $this
                ->useBookingEventsRelatedByCancelledByQuery()
                ->filterByPrimaryKeys($bookingEvents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventsRelatedByCancelledBy() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventsRelatedByCancelledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingEventsRelatedByCancelledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventsRelatedByCancelledBy');

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
            $this->addJoinObject($join, 'BookingEventsRelatedByCancelledBy');
        }

        return $this;
    }

    /**
     * Use the BookingEventsRelatedByCancelledBy relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsRelatedByCancelledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEventsRelatedByCancelledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventsRelatedByCancelledBy', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingEventsRelatedByDeletedBy($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookingEvents->getDeletedBy(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            return $this
                ->useBookingEventsRelatedByDeletedByQuery()
                ->filterByPrimaryKeys($bookingEvents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventsRelatedByDeletedBy() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventsRelatedByDeletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingEventsRelatedByDeletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventsRelatedByDeletedBy');

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
            $this->addJoinObject($join, 'BookingEventsRelatedByDeletedBy');
        }

        return $this;
    }

    /**
     * Use the BookingEventsRelatedByDeletedBy relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsRelatedByDeletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEventsRelatedByDeletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventsRelatedByDeletedBy', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingsRelatedByAuthorId($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookings->getAuthorId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            return $this
                ->useBookingsRelatedByAuthorIdQuery()
                ->filterByPrimaryKeys($bookings->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingsRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\Bookings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingsRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingsRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingsRelatedByAuthorId');

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
            $this->addJoinObject($join, 'BookingsRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the BookingsRelatedByAuthorId relation Bookings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingsQuery A secondary query class using the current class as primary query
     */
    public function useBookingsRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingsRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingsRelatedByAuthorId', '\TheFarm\Models\BookingsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByBookingsRelatedByGuestId($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $bookings->getGuestId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            return $this
                ->useBookingsRelatedByGuestIdQuery()
                ->filterByPrimaryKeys($bookings->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingsRelatedByGuestId() only accepts arguments of type \TheFarm\Models\Bookings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingsRelatedByGuestId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinBookingsRelatedByGuestId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingsRelatedByGuestId');

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
            $this->addJoinObject($join, 'BookingsRelatedByGuestId');
        }

        return $this;
    }

    /**
     * Use the BookingsRelatedByGuestId relation Bookings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingsQuery A secondary query class using the current class as primary query
     */
    public function useBookingsRelatedByGuestIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingsRelatedByGuestId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingsRelatedByGuestId', '\TheFarm\Models\BookingsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemsRelatedUsers object
     *
     * @param \TheFarm\Models\ItemsRelatedUsers|ObjectCollection $itemsRelatedUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByItemsRelatedUsers($itemsRelatedUsers, $comparison = null)
    {
        if ($itemsRelatedUsers instanceof \TheFarm\Models\ItemsRelatedUsers) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $itemsRelatedUsers->getContactId(), $comparison);
        } elseif ($itemsRelatedUsers instanceof ObjectCollection) {
            return $this
                ->useItemsRelatedUsersQuery()
                ->filterByPrimaryKeys($itemsRelatedUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemsRelatedUsers() only accepts arguments of type \TheFarm\Models\ItemsRelatedUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemsRelatedUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinItemsRelatedUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemsRelatedUsers');

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
            $this->addJoinObject($join, 'ItemsRelatedUsers');
        }

        return $this;
    }

    /**
     * Use the ItemsRelatedUsers relation ItemsRelatedUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsRelatedUsersQuery A secondary query class using the current class as primary query
     */
    public function useItemsRelatedUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemsRelatedUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemsRelatedUsers', '\TheFarm\Models\ItemsRelatedUsersQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Users object
     *
     * @param \TheFarm\Models\Users|ObjectCollection $users the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContactsQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \TheFarm\Models\Users) {
            return $this
                ->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $users->getContactId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            return $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \TheFarm\Models\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\TheFarm\Models\UsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContacts $contacts Object to remove from the list of results
     *
     * @return $this|ChildContactsQuery The current query, for fluid interface
     */
    public function prune($contacts = null)
    {
        if ($contacts) {
            $this->addUsingAlias(ContactsTableMap::COL_CONTACT_ID, $contacts->getContactId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContactsTableMap::clearInstancePool();
            ContactsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ContactsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContactsQuery
