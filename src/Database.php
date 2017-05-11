<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 12:56
 */

namespace Juslintek\NestedCategories;

use \SQLiteException;
use \SQLite3;


final class Database
{
    /**
     * @var SQLite3 $db
     */
    private $db;
    /**
     * @var SQLiteException $error
     */
    static $error;

    /**
     * @var Database $_instance
     */
    public static $_instance;

    public static function initialize()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
            self::$_instance->prepare(self::$_instance);
            return self::$_instance;
        }

        return self::$_instance;
    }

    /**
     * @param Database $instance
     */
    private function prepare($instance)
    {
        if (!isset($instance->db)) {
            if (!file_exists(dirname(__DIR__) . '/database')) {
                mkdir(dirname(__DIR__) . '/database', 0755, true);
            }
            $instance->db = new SQLite3(dirname(__DIR__) . '/database/nested_categories.sqlite');

            try {
                $instance->db->query('CREATE TABLE IF NOT EXISTS tree (id INTEGER PRIMARY KEY AUTOINCREMENT, parent INTEGER, title TEXT NOT NULL)');
                if (!$instance->db->query('SELECT title FROM tree WHERE title = \'Root\'')->fetchArray(SQLITE3_ASSOC)) {
                    $instance->db->query("INSERT INTO tree (parent, title) VALUES (0, 'Root')");
                }
            } catch (SQLiteException $exception) {
                $instance->error = $exception->getMessage();
            }
        }
    }

    public static function db()
    {
        try {
            self::initialize();
            return self::$_instance->db;
        } catch (SQLiteException $exception) {
            self::$error = $exception->getMessage();
            return false;
        }
    }
}