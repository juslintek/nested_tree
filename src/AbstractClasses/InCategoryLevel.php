<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 12:28
 */

namespace Juslintek\NestedCategories\AbstractClasses;

abstract class InCategoryLevel
{
    abstract function addCategory($title, $parent);
    abstract function removeCategory();
}