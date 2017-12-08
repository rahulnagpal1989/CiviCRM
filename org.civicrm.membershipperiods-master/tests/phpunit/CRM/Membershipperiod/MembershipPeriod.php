<?php

require_once 'CiviTest/CiviUnitTestCase.php';

/**
 * This is an example test-case which demonstrates 
 */
class CRM_Membershipperiods_ExampleTest extends CiviUnitTestCase {

  function setUp() {
    // If your test manipulates any SQL tables, then you should truncate
    // them to ensure a consisting starting point for all tests
    $this->quickCleanup(array('civicrm_membershipperiods'));
    parent::setUp();
  }

  function tearDown() {
    parent::tearDown();
  }

  function testInsertFoo() {
    // basic assertion
    $this->assertEquals(49, 7*7);

    // basic database assertion
    $this->assertDBQuery(0, 'SELECT count(*) FROM civicrm_membershipperiods');

    // run code with a side-effect on database
    CRM_Membershipperiods_Example::insertSomeData('1');

    // another database assertion
    $this->assertDBQuery(1, 'SELECT count(*) FROM civicrm_membershipperiods');
    $this->assertDBQuery(1, 'SELECT count(*) FROM civicrm_membershipperiods WHERE member_id = "1"');
  }

  function testInsertBar() {
    // basic database assertion
    $this->assertDBQuery(0, 'SELECT count(*) FROM civicrm_membershipperiods');

    // run code with a side-effect on database
    CRM_Membershipperiods_Example::insertSomeData('2');

    // another database assertion
    $this->assertDBQuery(1, 'SELECT count(*) FROM civicrm_membershipperiods');
    $this->assertDBQuery(1, 'SELECT count(*) FROM civicrm_membershipperiods WHERE member_id = "2"');
  }

}