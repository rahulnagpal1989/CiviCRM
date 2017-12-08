<?php

/**
 * Collection of upgrade steps
 */
class CRM_Membershipperiods_Upgrader extends CRM_Membershipperiods_Upgrader_Base {

  /**
   * On install, create a SQL table 
   */
  public function install() {
    CRM_Core_DAO::executeQuery('
      CREATE TABLE IF NOT EXISTS civicrm_membershipperiods (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        `membership_id` int(11) NOT NULL,
        `start_date` date NOT NULL,
        `end_date` date NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB
    ');
  }

  /**
   * On uninstall, drop the SQL table
   */
  public function uninstall() {
   CRM_Core_DAO::executeQuery('DROP TABLE IF EXISTS civicrm_membershipperiods');
  }

  /**
   * On postProcess, add start_date
   */
    public function postProcess($formName, &$form) {
        //$action = $form->getVar('_action');
        if($formName=='CRM_Member_Form_MembershipRenewal'){
            $renewal_date = CRM_Utils_Array::value('renewal_date', $_POST);
            //$membership_end_date = CRM_Utils_Array::value('membership_end_date', $_POST);
            $start_date = substr($renewal_date, 6, 4).'-'.substr($renewal_date, 0, 2).'-'.substr($renewal_date, 3, 2);
            //$end_date = substr($membership_end_date, 6, 4).'-'.substr($membership_end_date, 0, 2).'-'.substr($membership_end_date, 3, 2);
            CRM_Core_DAO::executeQuery("update civicrm_membershipperiods set start_date='".$start_date."' where membership_id='".$form->getVar('_id')."' and start_date='0000-00-00'");
        }
    }

  /**
   * On post, add membership_id & end_date
   */
    public function post($op, $objectName, $objectId, &$objectRef) {
        if($op=='create' && $objectName=='Membership'){
            $a=var_export($objectRef, true);
            $start_date = substr($objectRef->start_date, 0, 4).'-'.substr($objectRef->start_date, 4, 2).'-'.substr($objectRef->start_date, 6, 2);
            $end_date = substr($objectRef->end_date, 0, 4).'-'.substr($objectRef->end_date, 4, 2).'-'.substr($objectRef->end_date, 6, 2);
            CRM_Core_DAO::executeQuery("insert into civicrm_membershipperiods set membership_id='".$objectRef->id."', start_date='".$start_date."', end_date='".$end_date."'");//, foo='".mysql_real_escape_string($op.'-'.$objectName.'-'.$objectId.'-'.$a)."'
        }elseif($op=='edit' && $objectName=='Membership'){
            $a=var_export($objectRef, true);
            CRM_Core_DAO::executeQuery("insert into civicrm_membershipperiods set membership_id='".$objectRef->id."', start_date='".$objectRef->renewal_date."', end_date='".$objectRef->end_date."'");//, foo='".mysql_real_escape_string($op.'-'.$objectName.'-'.$objectId.'-'.$a)."'
        }elseif($op=='delete' && $objectName=='Membership'){
            $a=var_export($objectRef, true);
            CRM_Core_DAO::executeQuery("delete from civicrm_membershipperiods where membership_id='".$objectRef->id."'");
        }
    }

  /**
   * On buildForm, show data in template
   */
    public function buildForm($formName, &$form) {
        if ($formName == 'CRM_Member_Form_MembershipView') {
            // Assumes templates are in a templates folder relative to this file
            $templatePath = realpath(dirname(__FILE__)."/../../templates");
            // Add the field element in the form
            $id = CRM_Utils_Array::value('id', $_GET);
            $result = $tmp = array();
            $query = "select * from civicrm_membershipperiods where membership_id='".$id."'";
            $dao = CRM_Core_DAO::executeQuery($query);
            while ($dao->fetch()) {
                $tmp['start_date'] = $dao->start_date;
                $tmp['end_date'] = $dao->end_date;
                $result[] = $tmp;
            }
            $dao->free();
            $template = CRM_Core_Smarty::singleton();
            $template->assign_by_ref('result', $result);
            // dynamically insert a template block in the page
            CRM_Core_Region::instance('page-body')->add(array(
                'template' => "{$templatePath}/membership.tpl"
            ));
        }
    }

  /**
   * Example: Run a simple query when a module is enabled
   *
  public function enable() {
    CRM_Core_DAO::executeQuery("UPDATE civicrm_membershipperiods SET is_active = 1");
  }

  /**
   * Example: Run a simple query when a module is disabled
   *
  public function disable() {
    CRM_Core_DAO::executeQuery("UPDATE civicrm_membershipperiods SET is_active = 0");
  }
   * 
   */
}
