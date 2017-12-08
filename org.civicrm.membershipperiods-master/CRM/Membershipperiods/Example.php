<?php

/**
 * This is a basic class which provides some logic that we want to test.
 */
class CRM_Membershipperiods_Member {

  /**
   * Add a new row to database
   *
   * @param integer $membershipId
   * @return void
   */
  public static function insertSomeData($membershipId) {
    $params = array(
      1 => array($membershipId, 'Integer')
    );
    CRM_Core_DAO::executeQuery('INSERT INTO civicrm_membershipperiods (membership_id) VALUES (%1)', $params);
  }
}