<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 13:20
 */

use Juslintek\NestedCategories\Composites\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testAddCategory() {
        $category = new Category;
        $this->assertTrue($category->addCategory('blabla', 0));
    }

    public function removeAddCategory() {
        $category = new Category;
        $this->assertTrue($category->removeCategory());
    }
}
