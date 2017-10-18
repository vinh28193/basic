<?php 

namespace app\common\web;

/**
 * MenuInterface is the interface that should be implemented by a class providing menu manager information.
 *
 * This interface can typically be implemented by a Menu model class or an array. For example, the following
 * code shows how to implement this interface by a User ActiveRecord class:
 *
 * ```php
 * class ExampleMenu extends Object implements MenuInterface
 * {
 *     public function collect()
 *     {
 *         return [
 *				['lable' => 'Home','url' => 'site/index'],
 *				['lable' => 'About us','url' => 'site/about']
 *				['lable' => 'Contact','url' => 'site/contact']
 *			];
 *     }
 * }
 * ```
 */
interface MenuInterface
{
	/**
     * @return array.
     */
	public function collect();
}
 ?>
