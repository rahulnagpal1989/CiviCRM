<?php
//error_reporting(E_ALL);
//ini_set("error_reporting",E_ALL);
//ini_set('display_errors','On');
require_once 'membershipperiods.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function membershipperiods_civicrm_config(&$config) {
    _membershipperiods_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function membershipperiods_civicrm_xmlMenu(&$files) {
    _membershipperiods_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function membershipperiods_civicrm_install() {
    return _membershipperiods_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function membershipperiods_civicrm_uninstall() {
    return _membershipperiods_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function membershipperiods_civicrm_enable() {
    return _membershipperiods_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function membershipperiods_civicrm_disable() {
    return _membershipperiods_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function membershipperiods_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
    return _membershipperiods_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function membershipperiods_civicrm_managed(&$entities) {
    return _membershipperiods_civix_civicrm_managed($entities);
}

/**
 * This hook is invoked when a CiviCRM form is submitted. If the module has
 * injected any form elements, this hook should save the values in the database.
 *
 * @param string $formName
 *   The name of the form.
 * @param object $form
 *   A reference to the form object.
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC33/CiviCRM+hook+specification#CiviCRMhookspecification-hookcivicrmpostProcess
 */
function membershipperiods_civicrm_postProcess($formName, &$form) {
    return _membershipperiods_civix_civicrm_postProcess($formName, $form);
}

function membershipperiods_civicrm_post($op, $objectName, $objectId, &$objectRef) {
    return _membershipperiods_civix_civicrm_post($op, $objectName, $objectId, $objectRef);
}

function membershipperiods_civicrm_buildForm($formName, &$form) {
    return _membershipperiods_civix_civicrm_buildForm($formName, $form);
}
