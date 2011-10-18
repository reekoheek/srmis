<?php

function simrs_url($path = '') {
    $CI = &get_instance();
    return $CI->config->item('base_path_simrs').$path;
}