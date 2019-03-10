<?php
require 'vendor/autoload.php';
require 'lib/class-shopify.php';
header("Access-Control-Allow-Origin: *");

$variant_id = $_GET['variant_id'];
$inventory = new Shopify\Inventory;

// get the inventory item id of the variant id
$inventory_item = $inventory->inventoryItem($variant_id);
// get the inventory levels of the inventory id
$stock_response = $inventory->inventoryLevels($inventory_item);
// display the inventory level
$inventory->displayStock($stock_response);
