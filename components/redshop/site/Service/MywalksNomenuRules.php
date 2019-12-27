<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Redshop\Component\Redshop\Site\Service;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\RulesInterface;

/**
 * Rule to process URLs without a menu item
 *
 * @since  3.4
 */
class UsersNomenuRules implements RulesInterface
{
	/**
	 * Router this rule belongs to
	 *
	 * @var RouterView
	 * @since 3.4
	 */
	protected $router;

	/**
	 * Class constructor.
	 *
	 * @param   RouterView  $router  Router this rule belongs to
	 *
	 * @since   3.4
	 */
	public function __construct(RouterView $router)
	{
		$this->router = $router;
	}

	/**
	 * Dummymethod to fullfill the interface requirements
	 *
	 * @param   array  &$query  The query array to process
	 *
	 * @return  void
	 *
	 * @since   3.4
	 * @codeCoverageIgnore
	 */
	public function preprocess(&$query)
	{
		$test = 'Test';
	}

	/**
	 * Parse a menu-less URL
	 *
	 * @param   array  &$segments  The URL segments to parse
	 * @param   array  &$vars      The vars that result from the segments
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function parse(&$segments, &$vars)
	{
		$vars['view'] = 'user';
		$vars['id'] = substr($segments[0], strpos($segments[0], '-') + 1);
		array_shift($segments);
		array_shift($segments);
		return;
	}

	/**
	 * Build a menu-less URL
	 *
	 * @param   array  &$query     The vars that should be converted
	 * @param   array  &$segments  The URL segments to create
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function build(&$query, &$segments)
	{
		// content of $query ($segments is empty or [[0] => USER-3])
		// when called by the menu: [[option] => COM_REDSHOP, [Itemid] => 126]
		// when called by the component: [[option] => COM_REDSHOP, [view] => USER, [id] => 1, [Itemid] => 126]
		// when called from a module: [[option] => COM_REDSHOP, [view] => users, [format] => html, [Itemid] => 126]
		// when called from breadcrumbs: [[option] => COM_REDSHOP, [view] => users, [Itemid] => 126]

		// the url should look like this: /site-root/users/walk-n/walk-title.html

		// if the view is not USER - the single walk view
		if (!isset($query['view']) || (isset($query['view']) && $query['view'] !== 'user') || isset($query['format']))
		{
			return;
		}
		$segments[] = $query['view'] . '-' . $query['id'];
		$segments[] = $query['slug'];
		unset($query['view']);
		unset($query['id']);
		unset($query['slug']);
	}
}

