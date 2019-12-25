<?php
/**
 * @package     Users.Administrator
 * @subpackage  com_redshop
 *
 * @copyright   Copyright (C) 2019 redWEB, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Redshop\Component\Redshop\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * Users component helper.
 *
 * @since  4.0
 */
class UsersHelper
{
	public static function getUserTitle($id)
	{
		if (empty($id))
		{
			// throw an error or ...
			return false;
		}
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('title');
		$query->from('#__users');
		$query->where('id = ' . $id);
		$db->setQuery($query);
		return $db->loadObject();
	}
}