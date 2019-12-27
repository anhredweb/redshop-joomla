<?php
/**
 * @package     users.Site
 * @subpackage  COM_REDSHOP
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use J4xdemos\Component\users\Site\Helper\RouteHelper as usersHelperRoute;

?>
<div class="table-responsive">
  <table class="table table-striped">
  <caption><?php echo Text::_('COM_REDSHOP_LIST_TABLE_CAPTION'); ?></caption>
  <thead>
    <tr>
 		<th scope="col"><?php echo Text::_('COM_REDSHOP_LIST_TITLE'); ?></th>
		<th scope="col"><?php echo Text::_('COM_REDSHOP_LIST_DESCRIPTION'); ?></th>
		<th scope="col"><?php echo Text::_('COM_REDSHOP_LIST_DISTANCE'); ?></th>
		<th scope="col"><?php echo Text::_('COM_REDSHOP_LIST_LAST_VISIT'); ?></th>
		<th scope="col"><?php echo Text::_('COM_REDSHOP_LIST_NVISITS'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($this->items as $id => $item) :
		$slug = preg_replace('/[^a-z\d]/i', '-', $item->title);
		$slug = strtolower(str_replace(' ', '-', $slug));
	?>
	<tr>
		<td><a href="<?php echo Route::_(usersHelperRoute::getWalkRoute($item->id, $slug)); ?>">
		<?php echo $item->title; ?></a></td>
		<td><?php echo $item->description; ?></td>
		<td><?php echo $item->distance; ?></td>
		<td><?php echo $item->last_visit //$item->lastvisit; ?></td>
		<td><?php echo $item->nvisits; ?></td>
	</tr>
	<?php endforeach; ?><?php //endif; ?>
	</tbody>
  </table>
</div>
