<?php
/**
 * @package     Users.Site
 * @subpackage  com_redshop
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Redshop\Component\Redshop\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Redshop\Component\Redshop\Site\Service\MywalksNomenuRules as NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;

/**
 * Routing class of com_redshop
 *
 * @since  3.3
 */
class Router extends RouterView
{
	protected $noIDs = false;

	/**
	 * The category factory
	 *
	 * @var CategoryFactoryInterface
	 *
	 * @since  4.0.0
	 */
	private $categoryFactory;

	/**
	 * The db
	 *
	 * @var DatabaseInterface
	 *
	 * @since  4.0.0
	 */
	private $db;

	/**
	 * Redshop Component router constructor
	 *
	 * @param   SiteApplication           $app              The application object
	 * @param   AbstractMenu              $menu             The menu object to work with
	 * @param   CategoryFactoryInterface  $categoryFactory  The category object
	 * @param   DatabaseInterface         $db               The database object
	 */
	public function __construct(SiteApplication $app, AbstractMenu $menu,
			CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{
		$this->categoryFactory = $categoryFactory;
		$this->db              = $db;

		$params = ComponentHelper::getParams('com_redshop');
		$this->noIDs = (bool) $params->get('sef_ids');

		$users = new RouterViewConfiguration('users');
		$users->setKey('id');
		$this->registerView($users);

		$user = new RouterViewConfiguration('user');
		$user->setKey('id');
		$this->registerView($user);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));
	}
}
