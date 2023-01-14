<?php
/**
 * @brief New Navigation Links, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Moe, Pierre Van Glabeke and contributors
 *
 * @copyright GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Icon (icon.png) and images are from Silk Icons :
 * <http://www.famfamfam.com/lab/icons/silk/>
 */
if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    'New Navigation Links',
    'New Navigation links widget',
    'Moe, Pierre Van Glabeke and contributors',
    '1.4',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_ADMIN,
        ]),
        'type'       => 'plugin',
        'support'    => 'http://forum.dotclear.org/viewforum.php?id=16',
        'details'    => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
    ]
);
