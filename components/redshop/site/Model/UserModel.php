<?php
/**
 * @package     Users.Site
 * @subpackage  com_redshop
 *
 * @copyright   Copyright (C) 2019 redWeb, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Redshop\Component\Redshop\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\ItemModel;

/**
 * Redshop Component User Model
 *
 * @since  1.5
 */
class UserModel extends ItemModel
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $_context = 'com_redshop.user';

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 *
	 * @return void
	 */
	protected function populateState()
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState('user.id', $pk);

		$offset = $app->input->getUInt('limitstart');
		$this->setState('list.offset', $offset);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Method to get walk data.
	 *
	 * @param   integer  $pk  The id of the walk.
	 *
	 * @return  object|boolean  Menu item data object on success, boolean false
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('user.id');

			try
			{
				$db = $this->getDbo();
				$query = $db->getQuery(true)
					->select(
						$this->getState(
							'item.select', 'a.*'
						)
					);
				$query->from('#__users AS a')
					->where('a.id = ' . (int) $pk);

				$db->setQuery($query);

				$data = $db->loadObject();

				if (empty($data))
				{
					throw new \Exception(Text::_('COM_REDSHOP_ERROR_WALK_NOT_FOUND'), 404);
				}
			}
			catch (\Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go through the error handler to allow Redirect to work.
					throw new \Exception($e->getMessage(), 404);
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}

		return $data;
	}
}
