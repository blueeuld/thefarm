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
use TheFarm\Models\Event as ChildEvent;
use TheFarm\Models\EventQuery as ChildEventQuery;
use TheFarm\Models\Map\EventTableMap;

/**
 * Base class that represents a query for the 'tf_event' table.
 *
 *
 *
 * @method     ChildEventQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     ChildEventQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildEventQuery orderByEventTitle($order = Criteria::ASC) Order by the event_title column
 * @method     ChildEventQuery orderByStartDate($order = Criteria::ASC) Order by the start_dt column
 * @method     ChildEventQuery orderByEndDate($order = Criteria::ASC) Order by the end_dt column
 * @method     ChildEventQuery orderByFacilityId($order = Criteria::ASC) Order by the facility_id column
 * @method     ChildEventQuery orderByAllDay($order = Criteria::ASC) Order by the all_day column
 * @method     ChildEventQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildEventQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildEventQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildEventQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildEventQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildEventQuery orderByCalledBy($order = Criteria::ASC) Order by the called_by column
 * @method     ChildEventQuery orderByCancelledBy($order = Criteria::ASC) Order by the cancelled_by column
 * @method     ChildEventQuery orderByCancelledReason($order = Criteria::ASC) Order by the cancelled_reason column
 * @method     ChildEventQuery orderByDateCancelled($order = Criteria::ASC) Order by the date_cancelled column
 * @method     ChildEventQuery orderByPersonalized($order = Criteria::ASC) Order by the personalized column
 * @method     ChildEventQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildEventQuery orderByDeletedDate($order = Criteria::ASC) Order by the deleted_date column
 * @method     ChildEventQuery orderByDeletedBy($order = Criteria::ASC) Order by the deleted_by column
 * @method     ChildEventQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildEventQuery orderByIsKids($order = Criteria::ASC) Order by the is_kids column
 * @method     ChildEventQuery orderByInclOsDoneNumber($order = Criteria::ASC) Order by the incl_os_done_number column
 * @method     ChildEventQuery orderByInclOsDoneAmount($order = Criteria::ASC) Order by the incl_os_done_amount column
 * @method     ChildEventQuery orderByFocOsDoneNumber($order = Criteria::ASC) Order by the foc_os_done_number column
 * @method     ChildEventQuery orderByFocOsDoneAmount($order = Criteria::ASC) Order by the foc_os_done_amount column
 * @method     ChildEventQuery orderByNotInclOsDoneNumber($order = Criteria::ASC) Order by the not_incl_os_done_number column
 * @method     ChildEventQuery orderByNotInclOsDoneAmount($order = Criteria::ASC) Order by the not_incl_os_done_amount column
 * @method     ChildEventQuery orderByIncl($order = Criteria::ASC) Order by the incl column
 * @method     ChildEventQuery orderByNotIncl($order = Criteria::ASC) Order by the not_incl column
 * @method     ChildEventQuery orderByFoc($order = Criteria::ASC) Order by the foc column
 *
 * @method     ChildEventQuery groupByEventId() Group by the event_id column
 * @method     ChildEventQuery groupByBookingId() Group by the booking_id column
 * @method     ChildEventQuery groupByEventTitle() Group by the event_title column
 * @method     ChildEventQuery groupByStartDate() Group by the start_dt column
 * @method     ChildEventQuery groupByEndDate() Group by the end_dt column
 * @method     ChildEventQuery groupByFacilityId() Group by the facility_id column
 * @method     ChildEventQuery groupByAllDay() Group by the all_day column
 * @method     ChildEventQuery groupByStatus() Group by the status column
 * @method     ChildEventQuery groupByAuthorId() Group by the author_id column
 * @method     ChildEventQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildEventQuery groupByEditDate() Group by the edit_date column
 * @method     ChildEventQuery groupByNotes() Group by the notes column
 * @method     ChildEventQuery groupByCalledBy() Group by the called_by column
 * @method     ChildEventQuery groupByCancelledBy() Group by the cancelled_by column
 * @method     ChildEventQuery groupByCancelledReason() Group by the cancelled_reason column
 * @method     ChildEventQuery groupByDateCancelled() Group by the date_cancelled column
 * @method     ChildEventQuery groupByPersonalized() Group by the personalized column
 * @method     ChildEventQuery groupByIsActive() Group by the is_active column
 * @method     ChildEventQuery groupByDeletedDate() Group by the deleted_date column
 * @method     ChildEventQuery groupByDeletedBy() Group by the deleted_by column
 * @method     ChildEventQuery groupByItemId() Group by the item_id column
 * @method     ChildEventQuery groupByIsKids() Group by the is_kids column
 * @method     ChildEventQuery groupByInclOsDoneNumber() Group by the incl_os_done_number column
 * @method     ChildEventQuery groupByInclOsDoneAmount() Group by the incl_os_done_amount column
 * @method     ChildEventQuery groupByFocOsDoneNumber() Group by the foc_os_done_number column
 * @method     ChildEventQuery groupByFocOsDoneAmount() Group by the foc_os_done_amount column
 * @method     ChildEventQuery groupByNotInclOsDoneNumber() Group by the not_incl_os_done_number column
 * @method     ChildEventQuery groupByNotInclOsDoneAmount() Group by the not_incl_os_done_amount column
 * @method     ChildEventQuery groupByIncl() Group by the incl column
 * @method     ChildEventQuery groupByNotIncl() Group by the not_incl column
 * @method     ChildEventQuery groupByFoc() Group by the foc column
 *
 * @method     ChildEventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventQuery leftJoinUserRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByAuthorId relation
 * @method     ChildEventQuery rightJoinUserRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByAuthorId relation
 * @method     ChildEventQuery innerJoinUserRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildEventQuery joinWithUserRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildEventQuery leftJoinWithUserRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the UserRelatedByAuthorId relation
 * @method     ChildEventQuery rightJoinWithUserRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByAuthorId relation
 * @method     ChildEventQuery innerJoinWithUserRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildEventQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildEventQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildEventQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildEventQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildEventQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildEventQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildEventQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildEventQuery leftJoinUserRelatedByCalledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCalledBy relation
 * @method     ChildEventQuery rightJoinUserRelatedByCalledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCalledBy relation
 * @method     ChildEventQuery innerJoinUserRelatedByCalledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCalledBy relation
 *
 * @method     ChildEventQuery joinWithUserRelatedByCalledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByCalledBy relation
 *
 * @method     ChildEventQuery leftJoinWithUserRelatedByCalledBy() Adds a LEFT JOIN clause and with to the query using the UserRelatedByCalledBy relation
 * @method     ChildEventQuery rightJoinWithUserRelatedByCalledBy() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByCalledBy relation
 * @method     ChildEventQuery innerJoinWithUserRelatedByCalledBy() Adds a INNER JOIN clause and with to the query using the UserRelatedByCalledBy relation
 *
 * @method     ChildEventQuery leftJoinUserRelatedByCancelledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCancelledBy relation
 * @method     ChildEventQuery rightJoinUserRelatedByCancelledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCancelledBy relation
 * @method     ChildEventQuery innerJoinUserRelatedByCancelledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCancelledBy relation
 *
 * @method     ChildEventQuery joinWithUserRelatedByCancelledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByCancelledBy relation
 *
 * @method     ChildEventQuery leftJoinWithUserRelatedByCancelledBy() Adds a LEFT JOIN clause and with to the query using the UserRelatedByCancelledBy relation
 * @method     ChildEventQuery rightJoinWithUserRelatedByCancelledBy() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByCancelledBy relation
 * @method     ChildEventQuery innerJoinWithUserRelatedByCancelledBy() Adds a INNER JOIN clause and with to the query using the UserRelatedByCancelledBy relation
 *
 * @method     ChildEventQuery leftJoinUserRelatedByDeletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByDeletedBy relation
 * @method     ChildEventQuery rightJoinUserRelatedByDeletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByDeletedBy relation
 * @method     ChildEventQuery innerJoinUserRelatedByDeletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByDeletedBy relation
 *
 * @method     ChildEventQuery joinWithUserRelatedByDeletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByDeletedBy relation
 *
 * @method     ChildEventQuery leftJoinWithUserRelatedByDeletedBy() Adds a LEFT JOIN clause and with to the query using the UserRelatedByDeletedBy relation
 * @method     ChildEventQuery rightJoinWithUserRelatedByDeletedBy() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByDeletedBy relation
 * @method     ChildEventQuery innerJoinWithUserRelatedByDeletedBy() Adds a INNER JOIN clause and with to the query using the UserRelatedByDeletedBy relation
 *
 * @method     ChildEventQuery leftJoinFacility($relationAlias = null) Adds a LEFT JOIN clause to the query using the Facility relation
 * @method     ChildEventQuery rightJoinFacility($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Facility relation
 * @method     ChildEventQuery innerJoinFacility($relationAlias = null) Adds a INNER JOIN clause to the query using the Facility relation
 *
 * @method     ChildEventQuery joinWithFacility($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Facility relation
 *
 * @method     ChildEventQuery leftJoinWithFacility() Adds a LEFT JOIN clause and with to the query using the Facility relation
 * @method     ChildEventQuery rightJoinWithFacility() Adds a RIGHT JOIN clause and with to the query using the Facility relation
 * @method     ChildEventQuery innerJoinWithFacility() Adds a INNER JOIN clause and with to the query using the Facility relation
 *
 * @method     ChildEventQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildEventQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildEventQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildEventQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildEventQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildEventQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildEventQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     ChildEventQuery leftJoinEventStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventStatus relation
 * @method     ChildEventQuery rightJoinEventStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventStatus relation
 * @method     ChildEventQuery innerJoinEventStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the EventStatus relation
 *
 * @method     ChildEventQuery joinWithEventStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventStatus relation
 *
 * @method     ChildEventQuery leftJoinWithEventStatus() Adds a LEFT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildEventQuery rightJoinWithEventStatus() Adds a RIGHT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildEventQuery innerJoinWithEventStatus() Adds a INNER JOIN clause and with to the query using the EventStatus relation
 *
 * @method     ChildEventQuery leftJoinEventUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventUser relation
 * @method     ChildEventQuery rightJoinEventUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventUser relation
 * @method     ChildEventQuery innerJoinEventUser($relationAlias = null) Adds a INNER JOIN clause to the query using the EventUser relation
 *
 * @method     ChildEventQuery joinWithEventUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventUser relation
 *
 * @method     ChildEventQuery leftJoinWithEventUser() Adds a LEFT JOIN clause and with to the query using the EventUser relation
 * @method     ChildEventQuery rightJoinWithEventUser() Adds a RIGHT JOIN clause and with to the query using the EventUser relation
 * @method     ChildEventQuery innerJoinWithEventUser() Adds a INNER JOIN clause and with to the query using the EventUser relation
 *
 * @method     \TheFarm\Models\UserQuery|\TheFarm\Models\BookingQuery|\TheFarm\Models\FacilityQuery|\TheFarm\Models\ItemQuery|\TheFarm\Models\EventStatusQuery|\TheFarm\Models\EventUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEvent findOne(ConnectionInterface $con = null) Return the first ChildEvent matching the query
 * @method     ChildEvent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEvent matching the query, or a new ChildEvent object populated from the query conditions when no match is found
 *
 * @method     ChildEvent findOneByEventId(int $event_id) Return the first ChildEvent filtered by the event_id column
 * @method     ChildEvent findOneByBookingId(int $booking_id) Return the first ChildEvent filtered by the booking_id column
 * @method     ChildEvent findOneByEventTitle(string $event_title) Return the first ChildEvent filtered by the event_title column
 * @method     ChildEvent findOneByStartDate(string $start_dt) Return the first ChildEvent filtered by the start_dt column
 * @method     ChildEvent findOneByEndDate(string $end_dt) Return the first ChildEvent filtered by the end_dt column
 * @method     ChildEvent findOneByFacilityId(int $facility_id) Return the first ChildEvent filtered by the facility_id column
 * @method     ChildEvent findOneByAllDay(int $all_day) Return the first ChildEvent filtered by the all_day column
 * @method     ChildEvent findOneByStatus(string $status) Return the first ChildEvent filtered by the status column
 * @method     ChildEvent findOneByAuthorId(int $author_id) Return the first ChildEvent filtered by the author_id column
 * @method     ChildEvent findOneByEntryDate(int $entry_date) Return the first ChildEvent filtered by the entry_date column
 * @method     ChildEvent findOneByEditDate(int $edit_date) Return the first ChildEvent filtered by the edit_date column
 * @method     ChildEvent findOneByNotes(string $notes) Return the first ChildEvent filtered by the notes column
 * @method     ChildEvent findOneByCalledBy(int $called_by) Return the first ChildEvent filtered by the called_by column
 * @method     ChildEvent findOneByCancelledBy(int $cancelled_by) Return the first ChildEvent filtered by the cancelled_by column
 * @method     ChildEvent findOneByCancelledReason(string $cancelled_reason) Return the first ChildEvent filtered by the cancelled_reason column
 * @method     ChildEvent findOneByDateCancelled(int $date_cancelled) Return the first ChildEvent filtered by the date_cancelled column
 * @method     ChildEvent findOneByPersonalized(string $personalized) Return the first ChildEvent filtered by the personalized column
 * @method     ChildEvent findOneByIsActive(boolean $is_active) Return the first ChildEvent filtered by the is_active column
 * @method     ChildEvent findOneByDeletedDate(int $deleted_date) Return the first ChildEvent filtered by the deleted_date column
 * @method     ChildEvent findOneByDeletedBy(int $deleted_by) Return the first ChildEvent filtered by the deleted_by column
 * @method     ChildEvent findOneByItemId(int $item_id) Return the first ChildEvent filtered by the item_id column
 * @method     ChildEvent findOneByIsKids(boolean $is_kids) Return the first ChildEvent filtered by the is_kids column
 * @method     ChildEvent findOneByInclOsDoneNumber(string $incl_os_done_number) Return the first ChildEvent filtered by the incl_os_done_number column
 * @method     ChildEvent findOneByInclOsDoneAmount(string $incl_os_done_amount) Return the first ChildEvent filtered by the incl_os_done_amount column
 * @method     ChildEvent findOneByFocOsDoneNumber(string $foc_os_done_number) Return the first ChildEvent filtered by the foc_os_done_number column
 * @method     ChildEvent findOneByFocOsDoneAmount(string $foc_os_done_amount) Return the first ChildEvent filtered by the foc_os_done_amount column
 * @method     ChildEvent findOneByNotInclOsDoneNumber(string $not_incl_os_done_number) Return the first ChildEvent filtered by the not_incl_os_done_number column
 * @method     ChildEvent findOneByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return the first ChildEvent filtered by the not_incl_os_done_amount column
 * @method     ChildEvent findOneByIncl(int $incl) Return the first ChildEvent filtered by the incl column
 * @method     ChildEvent findOneByNotIncl(int $not_incl) Return the first ChildEvent filtered by the not_incl column
 * @method     ChildEvent findOneByFoc(int $foc) Return the first ChildEvent filtered by the foc column *

 * @method     ChildEvent requirePk($key, ConnectionInterface $con = null) Return the ChildEvent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOne(ConnectionInterface $con = null) Return the first ChildEvent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvent requireOneByEventId(int $event_id) Return the first ChildEvent filtered by the event_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByBookingId(int $booking_id) Return the first ChildEvent filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEventTitle(string $event_title) Return the first ChildEvent filtered by the event_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByStartDate(string $start_dt) Return the first ChildEvent filtered by the start_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEndDate(string $end_dt) Return the first ChildEvent filtered by the end_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByFacilityId(int $facility_id) Return the first ChildEvent filtered by the facility_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByAllDay(int $all_day) Return the first ChildEvent filtered by the all_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByStatus(string $status) Return the first ChildEvent filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByAuthorId(int $author_id) Return the first ChildEvent filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEntryDate(int $entry_date) Return the first ChildEvent filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByEditDate(int $edit_date) Return the first ChildEvent filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByNotes(string $notes) Return the first ChildEvent filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByCalledBy(int $called_by) Return the first ChildEvent filtered by the called_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByCancelledBy(int $cancelled_by) Return the first ChildEvent filtered by the cancelled_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByCancelledReason(string $cancelled_reason) Return the first ChildEvent filtered by the cancelled_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByDateCancelled(int $date_cancelled) Return the first ChildEvent filtered by the date_cancelled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByPersonalized(string $personalized) Return the first ChildEvent filtered by the personalized column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByIsActive(boolean $is_active) Return the first ChildEvent filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByDeletedDate(int $deleted_date) Return the first ChildEvent filtered by the deleted_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByDeletedBy(int $deleted_by) Return the first ChildEvent filtered by the deleted_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByItemId(int $item_id) Return the first ChildEvent filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByIsKids(boolean $is_kids) Return the first ChildEvent filtered by the is_kids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByInclOsDoneNumber(string $incl_os_done_number) Return the first ChildEvent filtered by the incl_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByInclOsDoneAmount(string $incl_os_done_amount) Return the first ChildEvent filtered by the incl_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByFocOsDoneNumber(string $foc_os_done_number) Return the first ChildEvent filtered by the foc_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByFocOsDoneAmount(string $foc_os_done_amount) Return the first ChildEvent filtered by the foc_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByNotInclOsDoneNumber(string $not_incl_os_done_number) Return the first ChildEvent filtered by the not_incl_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return the first ChildEvent filtered by the not_incl_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByIncl(int $incl) Return the first ChildEvent filtered by the incl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByNotIncl(int $not_incl) Return the first ChildEvent filtered by the not_incl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvent requireOneByFoc(int $foc) Return the first ChildEvent filtered by the foc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEvent objects based on current ModelCriteria
 * @method     ChildEvent[]|ObjectCollection findByEventId(int $event_id) Return ChildEvent objects filtered by the event_id column
 * @method     ChildEvent[]|ObjectCollection findByBookingId(int $booking_id) Return ChildEvent objects filtered by the booking_id column
 * @method     ChildEvent[]|ObjectCollection findByEventTitle(string $event_title) Return ChildEvent objects filtered by the event_title column
 * @method     ChildEvent[]|ObjectCollection findByStartDate(string $start_dt) Return ChildEvent objects filtered by the start_dt column
 * @method     ChildEvent[]|ObjectCollection findByEndDate(string $end_dt) Return ChildEvent objects filtered by the end_dt column
 * @method     ChildEvent[]|ObjectCollection findByFacilityId(int $facility_id) Return ChildEvent objects filtered by the facility_id column
 * @method     ChildEvent[]|ObjectCollection findByAllDay(int $all_day) Return ChildEvent objects filtered by the all_day column
 * @method     ChildEvent[]|ObjectCollection findByStatus(string $status) Return ChildEvent objects filtered by the status column
 * @method     ChildEvent[]|ObjectCollection findByAuthorId(int $author_id) Return ChildEvent objects filtered by the author_id column
 * @method     ChildEvent[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildEvent objects filtered by the entry_date column
 * @method     ChildEvent[]|ObjectCollection findByEditDate(int $edit_date) Return ChildEvent objects filtered by the edit_date column
 * @method     ChildEvent[]|ObjectCollection findByNotes(string $notes) Return ChildEvent objects filtered by the notes column
 * @method     ChildEvent[]|ObjectCollection findByCalledBy(int $called_by) Return ChildEvent objects filtered by the called_by column
 * @method     ChildEvent[]|ObjectCollection findByCancelledBy(int $cancelled_by) Return ChildEvent objects filtered by the cancelled_by column
 * @method     ChildEvent[]|ObjectCollection findByCancelledReason(string $cancelled_reason) Return ChildEvent objects filtered by the cancelled_reason column
 * @method     ChildEvent[]|ObjectCollection findByDateCancelled(int $date_cancelled) Return ChildEvent objects filtered by the date_cancelled column
 * @method     ChildEvent[]|ObjectCollection findByPersonalized(string $personalized) Return ChildEvent objects filtered by the personalized column
 * @method     ChildEvent[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildEvent objects filtered by the is_active column
 * @method     ChildEvent[]|ObjectCollection findByDeletedDate(int $deleted_date) Return ChildEvent objects filtered by the deleted_date column
 * @method     ChildEvent[]|ObjectCollection findByDeletedBy(int $deleted_by) Return ChildEvent objects filtered by the deleted_by column
 * @method     ChildEvent[]|ObjectCollection findByItemId(int $item_id) Return ChildEvent objects filtered by the item_id column
 * @method     ChildEvent[]|ObjectCollection findByIsKids(boolean $is_kids) Return ChildEvent objects filtered by the is_kids column
 * @method     ChildEvent[]|ObjectCollection findByInclOsDoneNumber(string $incl_os_done_number) Return ChildEvent objects filtered by the incl_os_done_number column
 * @method     ChildEvent[]|ObjectCollection findByInclOsDoneAmount(string $incl_os_done_amount) Return ChildEvent objects filtered by the incl_os_done_amount column
 * @method     ChildEvent[]|ObjectCollection findByFocOsDoneNumber(string $foc_os_done_number) Return ChildEvent objects filtered by the foc_os_done_number column
 * @method     ChildEvent[]|ObjectCollection findByFocOsDoneAmount(string $foc_os_done_amount) Return ChildEvent objects filtered by the foc_os_done_amount column
 * @method     ChildEvent[]|ObjectCollection findByNotInclOsDoneNumber(string $not_incl_os_done_number) Return ChildEvent objects filtered by the not_incl_os_done_number column
 * @method     ChildEvent[]|ObjectCollection findByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return ChildEvent objects filtered by the not_incl_os_done_amount column
 * @method     ChildEvent[]|ObjectCollection findByIncl(int $incl) Return ChildEvent objects filtered by the incl column
 * @method     ChildEvent[]|ObjectCollection findByNotIncl(int $not_incl) Return ChildEvent objects filtered by the not_incl column
 * @method     ChildEvent[]|ObjectCollection findByFoc(int $foc) Return ChildEvent objects filtered by the foc column
 * @method     ChildEvent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\EventQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Event', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventQuery) {
            return $criteria;
        }
        $query = new ChildEventQuery();
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
     * @return ChildEvent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEvent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_id, booking_id, event_title, start_dt, end_dt, facility_id, all_day, status, author_id, entry_date, edit_date, notes, called_by, cancelled_by, cancelled_reason, date_cancelled, personalized, is_active, deleted_date, deleted_by, item_id, is_kids, incl_os_done_number, incl_os_done_amount, foc_os_done_number, foc_os_done_amount, not_incl_os_done_number, not_incl_os_done_amount, incl, not_incl, foc FROM tf_event WHERE event_id = :p0';
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
            /** @var ChildEvent $obj */
            $obj = new ChildEvent();
            $obj->hydrate($row);
            EventTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEvent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE event_id = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
     * </code>
     *
     * @param     mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventId, $comparison);
    }

    /**
     * Filter the query on the booking_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingId(1234); // WHERE booking_id = 1234
     * $query->filterByBookingId(array(12, 34)); // WHERE booking_id IN (12, 34)
     * $query->filterByBookingId(array('min' => 12)); // WHERE booking_id > 12
     * </code>
     *
     * @see       filterByBooking()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the event_title column
     *
     * Example usage:
     * <code>
     * $query->filterByEventTitle('fooValue');   // WHERE event_title = 'fooValue'
     * $query->filterByEventTitle('%fooValue%', Criteria::LIKE); // WHERE event_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventTitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventTitle($eventTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventTitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EVENT_TITLE, $eventTitle, $comparison);
    }

    /**
     * Filter the query on the start_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_dt = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_dt = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(EventTableMap::COL_START_DT, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(EventTableMap::COL_START_DT, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_START_DT, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_dt = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_dt = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(EventTableMap::COL_END_DT, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(EventTableMap::COL_END_DT, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_END_DT, $endDate, $comparison);
    }

    /**
     * Filter the query on the facility_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFacilityId(1234); // WHERE facility_id = 1234
     * $query->filterByFacilityId(array(12, 34)); // WHERE facility_id IN (12, 34)
     * $query->filterByFacilityId(array('min' => 12)); // WHERE facility_id > 12
     * </code>
     *
     * @see       filterByFacility()
     *
     * @param     mixed $facilityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByFacilityId($facilityId = null, $comparison = null)
    {
        if (is_array($facilityId)) {
            $useMinMax = false;
            if (isset($facilityId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_FACILITY_ID, $facilityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($facilityId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_FACILITY_ID, $facilityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_FACILITY_ID, $facilityId, $comparison);
    }

    /**
     * Filter the query on the all_day column
     *
     * Example usage:
     * <code>
     * $query->filterByAllDay(1234); // WHERE all_day = 1234
     * $query->filterByAllDay(array(12, 34)); // WHERE all_day IN (12, 34)
     * $query->filterByAllDay(array('min' => 12)); // WHERE all_day > 12
     * </code>
     *
     * @param     mixed $allDay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByAllDay($allDay = null, $comparison = null)
    {
        if (is_array($allDay)) {
            $useMinMax = false;
            if (isset($allDay['min'])) {
                $this->addUsingAlias(EventTableMap::COL_ALL_DAY, $allDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allDay['max'])) {
                $this->addUsingAlias(EventTableMap::COL_ALL_DAY, $allDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_ALL_DAY, $allDay, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the author_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorId(1234); // WHERE author_id = 1234
     * $query->filterByAuthorId(array(12, 34)); // WHERE author_id IN (12, 34)
     * $query->filterByAuthorId(array('min' => 12)); // WHERE author_id > 12
     * </code>
     *
     * @see       filterByUserRelatedByAuthorId()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(EventTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(EventTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(EventTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(EventTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the called_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCalledBy(1234); // WHERE called_by = 1234
     * $query->filterByCalledBy(array(12, 34)); // WHERE called_by IN (12, 34)
     * $query->filterByCalledBy(array('min' => 12)); // WHERE called_by > 12
     * </code>
     *
     * @see       filterByUserRelatedByCalledBy()
     *
     * @param     mixed $calledBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByCalledBy($calledBy = null, $comparison = null)
    {
        if (is_array($calledBy)) {
            $useMinMax = false;
            if (isset($calledBy['min'])) {
                $this->addUsingAlias(EventTableMap::COL_CALLED_BY, $calledBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calledBy['max'])) {
                $this->addUsingAlias(EventTableMap::COL_CALLED_BY, $calledBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_CALLED_BY, $calledBy, $comparison);
    }

    /**
     * Filter the query on the cancelled_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCancelledBy(1234); // WHERE cancelled_by = 1234
     * $query->filterByCancelledBy(array(12, 34)); // WHERE cancelled_by IN (12, 34)
     * $query->filterByCancelledBy(array('min' => 12)); // WHERE cancelled_by > 12
     * </code>
     *
     * @see       filterByUserRelatedByCancelledBy()
     *
     * @param     mixed $cancelledBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByCancelledBy($cancelledBy = null, $comparison = null)
    {
        if (is_array($cancelledBy)) {
            $useMinMax = false;
            if (isset($cancelledBy['min'])) {
                $this->addUsingAlias(EventTableMap::COL_CANCELLED_BY, $cancelledBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cancelledBy['max'])) {
                $this->addUsingAlias(EventTableMap::COL_CANCELLED_BY, $cancelledBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_CANCELLED_BY, $cancelledBy, $comparison);
    }

    /**
     * Filter the query on the cancelled_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByCancelledReason('fooValue');   // WHERE cancelled_reason = 'fooValue'
     * $query->filterByCancelledReason('%fooValue%', Criteria::LIKE); // WHERE cancelled_reason LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cancelledReason The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByCancelledReason($cancelledReason = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cancelledReason)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_CANCELLED_REASON, $cancelledReason, $comparison);
    }

    /**
     * Filter the query on the date_cancelled column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCancelled(1234); // WHERE date_cancelled = 1234
     * $query->filterByDateCancelled(array(12, 34)); // WHERE date_cancelled IN (12, 34)
     * $query->filterByDateCancelled(array('min' => 12)); // WHERE date_cancelled > 12
     * </code>
     *
     * @param     mixed $dateCancelled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByDateCancelled($dateCancelled = null, $comparison = null)
    {
        if (is_array($dateCancelled)) {
            $useMinMax = false;
            if (isset($dateCancelled['min'])) {
                $this->addUsingAlias(EventTableMap::COL_DATE_CANCELLED, $dateCancelled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCancelled['max'])) {
                $this->addUsingAlias(EventTableMap::COL_DATE_CANCELLED, $dateCancelled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_DATE_CANCELLED, $dateCancelled, $comparison);
    }

    /**
     * Filter the query on the personalized column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalized('fooValue');   // WHERE personalized = 'fooValue'
     * $query->filterByPersonalized('%fooValue%', Criteria::LIKE); // WHERE personalized LIKE '%fooValue%'
     * </code>
     *
     * @param     string $personalized The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByPersonalized($personalized = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personalized)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_PERSONALIZED, $personalized, $comparison);
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
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query on the deleted_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedDate(1234); // WHERE deleted_date = 1234
     * $query->filterByDeletedDate(array(12, 34)); // WHERE deleted_date IN (12, 34)
     * $query->filterByDeletedDate(array('min' => 12)); // WHERE deleted_date > 12
     * </code>
     *
     * @param     mixed $deletedDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByDeletedDate($deletedDate = null, $comparison = null)
    {
        if (is_array($deletedDate)) {
            $useMinMax = false;
            if (isset($deletedDate['min'])) {
                $this->addUsingAlias(EventTableMap::COL_DELETED_DATE, $deletedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedDate['max'])) {
                $this->addUsingAlias(EventTableMap::COL_DELETED_DATE, $deletedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_DELETED_DATE, $deletedDate, $comparison);
    }

    /**
     * Filter the query on the deleted_by column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedBy(1234); // WHERE deleted_by = 1234
     * $query->filterByDeletedBy(array(12, 34)); // WHERE deleted_by IN (12, 34)
     * $query->filterByDeletedBy(array('min' => 12)); // WHERE deleted_by > 12
     * </code>
     *
     * @see       filterByUserRelatedByDeletedBy()
     *
     * @param     mixed $deletedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByDeletedBy($deletedBy = null, $comparison = null)
    {
        if (is_array($deletedBy)) {
            $useMinMax = false;
            if (isset($deletedBy['min'])) {
                $this->addUsingAlias(EventTableMap::COL_DELETED_BY, $deletedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedBy['max'])) {
                $this->addUsingAlias(EventTableMap::COL_DELETED_BY, $deletedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_DELETED_BY, $deletedBy, $comparison);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @see       filterByItem()
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(EventTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(EventTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the is_kids column
     *
     * Example usage:
     * <code>
     * $query->filterByIsKids(true); // WHERE is_kids = true
     * $query->filterByIsKids('yes'); // WHERE is_kids = true
     * </code>
     *
     * @param     boolean|string $isKids The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByIsKids($isKids = null, $comparison = null)
    {
        if (is_string($isKids)) {
            $isKids = in_array(strtolower($isKids), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventTableMap::COL_IS_KIDS, $isKids, $comparison);
    }

    /**
     * Filter the query on the incl_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByInclOsDoneNumber('fooValue');   // WHERE incl_os_done_number = 'fooValue'
     * $query->filterByInclOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE incl_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $inclOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByInclOsDoneNumber($inclOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($inclOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_INCL_OS_DONE_NUMBER, $inclOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the incl_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByInclOsDoneAmount(1234); // WHERE incl_os_done_amount = 1234
     * $query->filterByInclOsDoneAmount(array(12, 34)); // WHERE incl_os_done_amount IN (12, 34)
     * $query->filterByInclOsDoneAmount(array('min' => 12)); // WHERE incl_os_done_amount > 12
     * </code>
     *
     * @param     mixed $inclOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByInclOsDoneAmount($inclOsDoneAmount = null, $comparison = null)
    {
        if (is_array($inclOsDoneAmount)) {
            $useMinMax = false;
            if (isset($inclOsDoneAmount['min'])) {
                $this->addUsingAlias(EventTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inclOsDoneAmount['max'])) {
                $this->addUsingAlias(EventTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the foc_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByFocOsDoneNumber('fooValue');   // WHERE foc_os_done_number = 'fooValue'
     * $query->filterByFocOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE foc_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $focOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByFocOsDoneNumber($focOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($focOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_FOC_OS_DONE_NUMBER, $focOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the foc_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFocOsDoneAmount(1234); // WHERE foc_os_done_amount = 1234
     * $query->filterByFocOsDoneAmount(array(12, 34)); // WHERE foc_os_done_amount IN (12, 34)
     * $query->filterByFocOsDoneAmount(array('min' => 12)); // WHERE foc_os_done_amount > 12
     * </code>
     *
     * @param     mixed $focOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByFocOsDoneAmount($focOsDoneAmount = null, $comparison = null)
    {
        if (is_array($focOsDoneAmount)) {
            $useMinMax = false;
            if (isset($focOsDoneAmount['min'])) {
                $this->addUsingAlias(EventTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($focOsDoneAmount['max'])) {
                $this->addUsingAlias(EventTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the not_incl_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByNotInclOsDoneNumber('fooValue');   // WHERE not_incl_os_done_number = 'fooValue'
     * $query->filterByNotInclOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE not_incl_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notInclOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByNotInclOsDoneNumber($notInclOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notInclOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_NOT_INCL_OS_DONE_NUMBER, $notInclOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the not_incl_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByNotInclOsDoneAmount(1234); // WHERE not_incl_os_done_amount = 1234
     * $query->filterByNotInclOsDoneAmount(array(12, 34)); // WHERE not_incl_os_done_amount IN (12, 34)
     * $query->filterByNotInclOsDoneAmount(array('min' => 12)); // WHERE not_incl_os_done_amount > 12
     * </code>
     *
     * @param     mixed $notInclOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByNotInclOsDoneAmount($notInclOsDoneAmount = null, $comparison = null)
    {
        if (is_array($notInclOsDoneAmount)) {
            $useMinMax = false;
            if (isset($notInclOsDoneAmount['min'])) {
                $this->addUsingAlias(EventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notInclOsDoneAmount['max'])) {
                $this->addUsingAlias(EventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the incl column
     *
     * Example usage:
     * <code>
     * $query->filterByIncl(1234); // WHERE incl = 1234
     * $query->filterByIncl(array(12, 34)); // WHERE incl IN (12, 34)
     * $query->filterByIncl(array('min' => 12)); // WHERE incl > 12
     * </code>
     *
     * @param     mixed $incl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByIncl($incl = null, $comparison = null)
    {
        if (is_array($incl)) {
            $useMinMax = false;
            if (isset($incl['min'])) {
                $this->addUsingAlias(EventTableMap::COL_INCL, $incl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($incl['max'])) {
                $this->addUsingAlias(EventTableMap::COL_INCL, $incl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_INCL, $incl, $comparison);
    }

    /**
     * Filter the query on the not_incl column
     *
     * Example usage:
     * <code>
     * $query->filterByNotIncl(1234); // WHERE not_incl = 1234
     * $query->filterByNotIncl(array(12, 34)); // WHERE not_incl IN (12, 34)
     * $query->filterByNotIncl(array('min' => 12)); // WHERE not_incl > 12
     * </code>
     *
     * @param     mixed $notIncl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByNotIncl($notIncl = null, $comparison = null)
    {
        if (is_array($notIncl)) {
            $useMinMax = false;
            if (isset($notIncl['min'])) {
                $this->addUsingAlias(EventTableMap::COL_NOT_INCL, $notIncl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notIncl['max'])) {
                $this->addUsingAlias(EventTableMap::COL_NOT_INCL, $notIncl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_NOT_INCL, $notIncl, $comparison);
    }

    /**
     * Filter the query on the foc column
     *
     * Example usage:
     * <code>
     * $query->filterByFoc(1234); // WHERE foc = 1234
     * $query->filterByFoc(array(12, 34)); // WHERE foc IN (12, 34)
     * $query->filterByFoc(array('min' => 12)); // WHERE foc > 12
     * </code>
     *
     * @param     mixed $foc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function filterByFoc($foc = null, $comparison = null)
    {
        if (is_array($foc)) {
            $useMinMax = false;
            if (isset($foc['min'])) {
                $this->addUsingAlias(EventTableMap::COL_FOC, $foc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($foc['max'])) {
                $this->addUsingAlias(EventTableMap::COL_FOC, $foc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventTableMap::COL_FOC, $foc, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByAuthorId($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(EventTableMap::COL_AUTHOR_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_AUTHOR_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinUserRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByAuthorId');

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
            $this->addJoinObject($join, 'UserRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByAuthorId relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByAuthorId', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(EventTableMap::COL_BOOKING_ID, $booking->getBookingId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_BOOKING_ID, $booking->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
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
     * @return $this|ChildEventQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByCalledBy($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(EventTableMap::COL_CALLED_BY, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_CALLED_BY, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByCalledBy() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByCalledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinUserRelatedByCalledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByCalledBy');

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
            $this->addJoinObject($join, 'UserRelatedByCalledBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByCalledBy relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByCalledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByCalledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByCalledBy', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByCancelledBy($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(EventTableMap::COL_CANCELLED_BY, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_CANCELLED_BY, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByCancelledBy() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByCancelledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinUserRelatedByCancelledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByCancelledBy');

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
            $this->addJoinObject($join, 'UserRelatedByCancelledBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByCancelledBy relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByCancelledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByCancelledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByCancelledBy', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByDeletedBy($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(EventTableMap::COL_DELETED_BY, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_DELETED_BY, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByDeletedBy() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByDeletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinUserRelatedByDeletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByDeletedBy');

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
            $this->addJoinObject($join, 'UserRelatedByDeletedBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByDeletedBy relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByDeletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByDeletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByDeletedBy', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Facility object
     *
     * @param \TheFarm\Models\Facility|ObjectCollection $facility The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByFacility($facility, $comparison = null)
    {
        if ($facility instanceof \TheFarm\Models\Facility) {
            return $this
                ->addUsingAlias(EventTableMap::COL_FACILITY_ID, $facility->getFacilityId(), $comparison);
        } elseif ($facility instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_FACILITY_ID, $facility->toKeyValue('PrimaryKey', 'FacilityId'), $comparison);
        } else {
            throw new PropelException('filterByFacility() only accepts arguments of type \TheFarm\Models\Facility or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Facility relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinFacility($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Facility');

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
            $this->addJoinObject($join, 'Facility');
        }

        return $this;
    }

    /**
     * Use the Facility relation Facility object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FacilityQuery A secondary query class using the current class as primary query
     */
    public function useFacilityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFacility($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Facility', '\TheFarm\Models\FacilityQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Item object
     *
     * @param \TheFarm\Models\Item|ObjectCollection $item The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof \TheFarm\Models\Item) {
            return $this
                ->addUsingAlias(EventTableMap::COL_ITEM_ID, $item->getItemId(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_ITEM_ID, $item->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type \TheFarm\Models\Item or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

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
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation Item object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\TheFarm\Models\ItemQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\EventStatus object
     *
     * @param \TheFarm\Models\EventStatus|ObjectCollection $eventStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventStatus($eventStatus, $comparison = null)
    {
        if ($eventStatus instanceof \TheFarm\Models\EventStatus) {
            return $this
                ->addUsingAlias(EventTableMap::COL_STATUS, $eventStatus->getStatusCd(), $comparison);
        } elseif ($eventStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventTableMap::COL_STATUS, $eventStatus->toKeyValue('PrimaryKey', 'StatusCd'), $comparison);
        } else {
            throw new PropelException('filterByEventStatus() only accepts arguments of type \TheFarm\Models\EventStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinEventStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventStatus');

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
            $this->addJoinObject($join, 'EventStatus');
        }

        return $this;
    }

    /**
     * Use the EventStatus relation EventStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventStatusQuery A secondary query class using the current class as primary query
     */
    public function useEventStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventStatus', '\TheFarm\Models\EventStatusQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\EventUser object
     *
     * @param \TheFarm\Models\EventUser|ObjectCollection $eventUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventQuery The current query, for fluid interface
     */
    public function filterByEventUser($eventUser, $comparison = null)
    {
        if ($eventUser instanceof \TheFarm\Models\EventUser) {
            return $this
                ->addUsingAlias(EventTableMap::COL_EVENT_ID, $eventUser->getEventId(), $comparison);
        } elseif ($eventUser instanceof ObjectCollection) {
            return $this
                ->useEventUserQuery()
                ->filterByPrimaryKeys($eventUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventUser() only accepts arguments of type \TheFarm\Models\EventUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function joinEventUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventUser');

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
            $this->addJoinObject($join, 'EventUser');
        }

        return $this;
    }

    /**
     * Use the EventUser relation EventUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventUserQuery A secondary query class using the current class as primary query
     */
    public function useEventUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventUser', '\TheFarm\Models\EventUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEvent $event Object to remove from the list of results
     *
     * @return $this|ChildEventQuery The current query, for fluid interface
     */
    public function prune($event = null)
    {
        if ($event) {
            $this->addUsingAlias(EventTableMap::COL_EVENT_ID, $event->getEventId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_event table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventTableMap::clearInstancePool();
            EventTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EventTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventQuery
