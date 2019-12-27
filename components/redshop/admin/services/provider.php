<?php
/**
 * @package     users.Administrator
 * @subpackage  COM_REDSHOP
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
//use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Redshop\Component\Redshop\Administrator\Extension\RedshopComponent;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The users service provider.
 *
 * @since  4.0.0
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function register(Container $container)
	{
		$container->registerServiceProvider(new CategoryFactory('\\Redshop\\Component\\Redshop'));
		$container->registerServiceProvider(new MVCFactory('\\Redshop\\Component\\Redshop'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\Redshop\\Component\\Redshop'));
		$container->registerServiceProvider(new RouterFactory('\\Redshop\\Component\\Redshop'));
		$container->set(
				ComponentInterface::class,
				function (Container $container)
				{
					$component = new RedshopComponent($container->get(ComponentDispatcherFactoryInterface::class));

					$component->setRegistry($container->get(Registry::class));
					$component->setMVCFactory($container->get(MVCFactoryInterface::class));
//					$component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
					$component->setRouterFactory($container->get(RouterFactoryInterface::class));

					return $component;
		}
		);
	}
};
