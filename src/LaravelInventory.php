<?php

namespace Rajabit\LaravelInventory;

class LaravelInventory
{
    /**
     * The inventory model class name.
     *
     * @var string
     */
    public static $inventoryModel = 'Rajabit\\LaravelInventory\\Inventory';


    /**
     * Indicates if inventory'ies migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;


    /**
     * Set the personal access token model name.
     *
     * @param  string  $model
     * @return void
     */
    public static function useInventoryModel($model)
    {
        static::$inventoryModel = $model;
    }


    /**
     * Determine if inventory'ies migrations should be run.
     *
     * @return bool
     */
    public static function shouldRunMigrations()
    {
        return static::$runsMigrations;
    }

    /**
     * Configure inventory to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Get the token model class name.
     *
     * @return string
     */
    public static function inventoryModel()
    {
        return static::$inventoryModel;
    }
}
