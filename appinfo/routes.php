<?php
/**
 * Nextcloud - twofactor_yubikey
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Jack <site-nextcloud@jack.org.uk>
 * @copyright Jack 2016
 */

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\TwoFactorYubikey\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
     ['name' => 'settings#addkey', 'url' => '/settings/addkey', 'verb' => 'POST'],
     ['name' => 'settings#deletekey', 'url' => '/settings/deletekey', 'verb' => 'POST'],
     ['name' => 'settings#getkeys', 'url' => '/settings/getkeys', 'verb' => 'GET'],
     ['name' => 'settings#testotp', 'url' => '/settings/testotp', 'verb' => 'POST'],
   ]
];
