<?php
/**
 * PHP API usage example
 *
 * contributed by: Art of WiFi
 * description: example PHP script to perform a basic auth of a guest device
 */

require_once __DIR__ . '/../config.php';

/**
 * the MAC address of the device to authorize
 */
$mac = 'c4:b3:01:c6:28:f5';

/**
 * the MAC address of the Access Point the guest is currently connected to, enter null (without quotes)
 * if not known or unavailable
 *
 * NOTE:
 * although the AP MAC address is not a required parameter for the authorize_guest() function,
 * adding this parameter will speed up the initial authorization process
 */
$ap_mac = '18:e8:29:fa:a4:fa';

/**
 * the duration to authorize the device for in minutes
 */
$duration = 5;

/**
 * initialize the UniFi API connection class and log in to the controller
 */
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

/**
 * then we authorize the device for the requested duration
 */
$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $ap_mac);

/**
 * provide feedback in json format
 */
echo json_encode($auth_result, JSON_PRETTY_PRINT);
