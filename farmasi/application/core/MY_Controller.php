<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author jafar
 */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('app', 'url'));
        $this->load->config('app');
        
        session_name("simrs");
        session_start();
        // FIXME comment to bypass ACL farmasi
        if ($_SESSION['group_nama'] !== 'FARMASI') {
            redirect(simrs_url());
        }
    }

}

?>
