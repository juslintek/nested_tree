<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 12:30
 */

namespace Juslintek\NestedCategories\Composites;

use Juslintek\NestedCategories\AbstractClasses\InCategoryLevel;
use Juslintek\NestedCategories\Database;

class Category extends InCategoryLevel
{
    public $id;
    public $parent;
    public $title;

    /**
     * OneCategory constructor.
     * @param int $id
     */
    public function __construct($id = null) {
        if(!is_null($id)) {
            $this->id = $id;
        }
    }

    /**
     * @param string $title
     * @param int $parent
     * @return bool
     */
    public function addCategory($title, $parent) {
        return Database::db()->exec("INSERT INTO tree (parent, title) VALUES ($parent, '$title')");
    }

    /**
     * @return boolean
     */
    public function removeCategory() {
        return Database::db()->exec("DELETE FROM tree WHERE id = $this->id");
    }


    /**
     * @return string
     */
    public function getError() {
        return Database::$error;
    }
}