<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWDD_admin_settings')) {

  class OCWDD_admin_settings {

    protected static $OCWDD_instance;
    /**
     * Registers ADL Post Slider post type.
     */

    function OCWDD_submenu_page() {
        add_submenu_page( 'woocommerce', 'Delivery Date', 'Delivery Date', 'manage_options', 'oc-delivery-date',array($this, 'OCWDD_callback'));
    }

    function OCWDD_callback() {
    ?>    
        <div class="ocwdd-container">
            <div class="wrap">
                <h2><?php echo __( 'WooCommerce Delivery Date', OCWDD_DOMAIN );?></h2>
                <?php if(isset($_REQUEST['message']) && $_REQUEST['message'] == 'success'){ ?>
                    <div class="notice notice-success is-dismissible"> 
                        <p><strong>Record updated successfully.</strong></p>
                    </div>
                <?php } ?>
                <div class="ocwdd-inner-block">
                    <form method="post" >
                        <?php wp_nonce_field( 'ocwdd_nonce_action', 'ocwdd_nonce_field' ); ?>
                        <ul class="tabs">
                            <li class="tab-link current" data-tab="ocwdd-tab-general"><?php echo __( 'General Settings', OCWDD_DOMAIN );?></li>
                            <li class="tab-link" data-tab="ocwdd-tab-delivery"><?php echo __( 'Delivery Options', OCWDD_DOMAIN );?></li>
                        </ul>
                        <div id="ocwdd-tab-general" class="tab-content current">
                            <fieldset>
                                <p>
                                    <label>
                                        <?php
                                            $ocwdd_enabled = empty(get_option( 'ocwdd_enabled' )) ? 'no' : get_option( 'ocwdd_enabled' );
                                        ?>
                                        <input type="checkbox" name="ocwdd-enabled" value="yes" <?php if ($ocwdd_enabled == "yes") {echo 'checked="checked"';} ?>><strong><?php echo __( 'Enable/Disable This Plugin', OCWDD_DOMAIN ); ?></strong>
                                    </label>
                                </p>
                                <div class="ocwdd-top">
                                    <p class="ocwdd-heading"><?php echo __( 'All Basic Settings', OCWDD_DOMAIN );?></h2>
                                    <p class="ocwdd-tips"><?php echo __( 'Here is Settings For Date Format and custom Message.', OCWDD_DOMAIN );?></p>
                                </div>
                                <table class="form-table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Date format', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php $ocwdd_dateformat = empty(get_option( 'ocwdd_dateformat' )) ? 'Y/m/d' : get_option( 'ocwdd_dateformat' ); ?>
                                                <select name="ocwdd-dateformat" id="ocwdd_dateformat">
                                                    <option value="Y/m/d" <?php if($ocwdd_dateformat == 'Y/m/d'){echo "selected";}?>><?php echo date('Y/m/d');?></option>
                                                    <option value="d/m/Y" <?php if($ocwdd_dateformat == 'd/m/Y'){echo "selected";}?>><?php echo date('d/m/Y');?></option>
                                                    <option value="m/d/y" <?php if($ocwdd_dateformat == 'm/d/y'){echo "selected";}?>><?php echo date('m/d/y');?></option>
                                                    <option value="Y-m-d" <?php if($ocwdd_dateformat == 'Y-m-d'){echo "selected";}?>><?php echo date('Y-m-d');?></option>
                                                    <option value="d-m-Y" <?php if($ocwdd_dateformat == 'd-m-Y'){echo "selected";}?>><?php echo date('d-m-Y');?></option>
                                                    <option value="m-d-y" <?php if($ocwdd_dateformat == 'm-d-y'){echo "selected";}?>><?php echo date('m-d-y');?></option>
                                                    <option value="Y.m.d" <?php if($ocwdd_dateformat == 'Y.m.d'){echo "selected";}?>><?php echo date('Y.m.d');?></option>
                                                    <option value="d.m.Y" <?php if($ocwdd_dateformat == 'd.m.Y'){echo "selected";}?>><?php echo date('d.m.Y');?></option>
                                                    <option value="m.d.y" <?php if($ocwdd_dateformat == 'm.d.y'){echo "selected";}?>><?php echo date('m.d.y');?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Custom Message', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php $ocwdd_custommessage = empty(get_option( 'ocwdd_custommessage' )) ? 'Delivery Date' : get_option( 'ocwdd_custommessage' ); ?>
                                                <input type="text" name="ocwdd-custommessage" value="<?php echo $ocwdd_custommessage; ?>" class="regular-text">
                                                <p class="ocwdd-tips"><?php echo __( "Note: This will be shown besides the estimated date", OCWDD_DOMAIN );?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div id="ocwdd-tab-delivery" class="tab-content">
                            <fieldset>
                                <table class="form-table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Delivery Date Field (Checkout page)', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwdd_deliverydate_required = empty(get_option( 'ocwdd_deliverydate_required' )) ? false : get_option( 'ocwdd_deliverydate_required' );
                                                ?>
                                                <p><label><input type="checkbox" name="ocwdd-deliverydate-required" value="true" <?php if ($ocwdd_deliverydate_required == true) {echo 'checked="checked"';} ?>><?php echo __( 'Required / Not Required Delivery Date Field On Checkout Page', OCWDD_DOMAIN ); ?></label></p>
                                                <div class="ocwdd-space"></div>
                                                <p class="ocwdd-tips"><?php echo __( "Note: By Default This Field is Not Required", OCWDD_DOMAIN );?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Starting Delivery Date', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <input type="text" name="ocwdd-starting_date" value="<?php echo get_option( 'ocwdd_starting_date' ); ?>" id="ocwdd_starting_date" autocomplete="off">
                                                <p class="ocwdd-tips"><?php echo __( "Note: Set Starting Delivery Date", OCWDD_DOMAIN );?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Ending Delivery Date', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <input type="text" name="ocwdd-ending_date" value="<?php echo get_option( 'ocwdd_ending_date' ); ?>" id="ocwdd_ending_date" autocomplete="off">
                                                <p class="ocwdd-tips"><?php echo __( "Note: Set Ending Delivery Date", OCWDD_DOMAIN );?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <label><?php echo __( 'Delivery Workday', OCWDD_DOMAIN );?></label>
                                            </th>
                                            <?php 
                                                $ocwdd_workday = get_option( 'ocwdd_workday', array(0, 1, 2, 3, 4, 5, 6) );
                                            ?>
                                            <td>
                                                <select name="ocwdd-workday[]" multiple>
                                                    <option value="">---</option>
                                                    <option value="0" <?php if(in_array('0', $ocwdd_workday)){ echo "selected";}?>>Sunday</option>
                                                    <option value="1" <?php if(in_array('1', $ocwdd_workday)){ echo "selected";}?>>Monday</option>
                                                    <option value="2" <?php if(in_array('2', $ocwdd_workday)){ echo "selected";}?>>Tuesday</option>
                                                    <option value="3" <?php if(in_array('3', $ocwdd_workday)){ echo "selected";}?>>Wednesday</option>
                                                    <option value="4" <?php if(in_array('4', $ocwdd_workday)){ echo "selected";}?>>Thursday</option>
                                                    <option value="5" <?php if(in_array('5', $ocwdd_workday)){ echo "selected";}?>>Friday</option>
                                                    <option value="6" <?php if(in_array('6', $ocwdd_workday)){ echo "selected";}?>>Saturday</option>
                                                </select>
                                                <p class="ocwdd-tips"><?php echo __( "Choose delivery workday. Note: Default all day workday.", OCWDD_DOMAIN );?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <input type="hidden" name="ocwdd_action" value="ocwdd_save_option_data"/>
                        <input type="submit" value="Save changes" name="submit" class="button-primary" id="ocwdd-btn-space">
                    </form> 
                </div>
            </div>
        </div>
    <?php
    }

    function recursive_sanitize_text_field($array) {
        $new_arr = array();
        foreach ( $array as $key => $value ) {
            if ( is_array( $value ) ) {
                    $value = recursive_sanitize_text_field($value);
                } else {
                    $value = sanitize_text_field( $value );
                    $new_arr[] = $value;
                }
        }
        return $new_arr;
    }    
    // Save Setting Option
    function OCWDD_save_options() {
        if( current_user_can('administrator') ) { 
            if(isset($_REQUEST['ocwdd_action']) && $_REQUEST['ocwdd_action'] == 'ocwdd_save_option_data'){
                if(!isset( $_POST['ocwdd_nonce_field'] ) || !wp_verify_nonce( $_POST['ocwdd_nonce_field'], 'ocwdd_nonce_action' ) ){
                    print 'Sorry, your nonce did not verify.';
                    exit;
                }else{

                    $ocwdd_enabled = (!empty(sanitize_text_field( $_REQUEST['ocwdd-enabled'] )))? sanitize_text_field( $_REQUEST['ocwdd-enabled'] ) : 'no';
                    $ocwdd_deliverydate_required = (!empty(sanitize_text_field( $_REQUEST['ocwdd-deliverydate-required'] )))? sanitize_text_field( $_REQUEST['ocwdd-deliverydate-required'] ) : false;
                    $ocwdd_custommessage = (!empty(sanitize_text_field( $_REQUEST['ocwdd-custommessage'] )))? sanitize_text_field( $_REQUEST['ocwdd-custommessage'] ) : 'Delivery Date';
                    $ocwdd_starting_date = sanitize_text_field($_REQUEST['ocwdd-starting_date']);
                    $ocwdd_ending_date = sanitize_text_field($_REQUEST['ocwdd-ending_date']);
                    $ocwdd_dateformat = (!empty(sanitize_text_field( $_REQUEST['ocwdd-dateformat'] )))? sanitize_text_field( $_REQUEST['ocwdd-dateformat'] ) : 'Y/m/d';

                    update_option('ocwdd_enabled',$ocwdd_enabled, 'yes');
                    update_option('ocwdd_deliverydate_required',$ocwdd_deliverydate_required, 'yes');
                    update_option('ocwdd_workday',$this->recursive_sanitize_text_field($_REQUEST['ocwdd-workday']), 'yes');
                    update_option('ocwdd_custommessage',$ocwdd_custommessage, 'yes');
                    update_option('ocwdd_dateformat',$ocwdd_dateformat, 'yes');
                    update_option('ocwdd_starting_date',$ocwdd_starting_date, 'yes');
                    update_option('ocwdd_ending_date',$ocwdd_ending_date, 'yes');
                    wp_redirect( admin_url( 'admin.php?page=oc-delivery-date&message=success') ); exit;

                }
            }
        }
    }

    function init() {
        add_action( 'admin_menu',  array($this, 'OCWDD_submenu_page'));
        add_action( 'admin_init',  array($this, 'OCWDD_save_options'));
    }

    public static function OCWDD_instance() {
      if (!isset(self::$OCWDD_instance)) {
        self::$OCWDD_instance = new self();
        self::$OCWDD_instance->init();
      }
      return self::$OCWDD_instance;
    }

  }

  OCWDD_admin_settings::OCWDD_instance();
}

