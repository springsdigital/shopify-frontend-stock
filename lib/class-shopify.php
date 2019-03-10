<?php
namespace Shopify;

// the class
class Inventory {
  public function __construct() {
    $this->api_key = $_SERVER['S_API_KEY'];
    $this->api_pass = $_SERVER['S_API_PASS'];
    $this->store = $_SERVER['S_STORE_URL'];
    $this->$location_id = $_SERVER['S_LOCATION_ID'];
    $this->store_url = 'https://'.$this->api_key.':'.$this->api_pass.'@'.$this->store.'.myshopify.com/admin';
  }
  function inventoryItem($variant_id) {
    global $url;
    $request = Requests::get($this->store_url.'/variants/'.$variant_id.'.json', array());
    $response = json_decode($request->body, true);
    $inventory_item_response = array(
      'inventory_id' => $response['variant']['inventory_item_id'],
      'title' => $response['variant']['title']
    );
    return $inventory_item_response['inventory_id'];
  }
  function inventoryLevels($inventory_item_id) {
    global $url;
    $request = Requests::get($this->store_url.'/inventory_levels.json?inventory_item_ids='.$inventory_item_id.'&location_ids='.$location_ids, array());
    $response = json_decode($request->body, true);
    $stock_response_quantity = $response['inventory_levels'][0]['available'];
    return $stock_response_quantity;
  }
  function displayStock($stock_response) {
    global $inventory_item;
    $variant_name = $inventory_item['title'];
    if ($variant_name === 'Default Title') {
      $stock_variant_name = '';
    }
    else {
      $stock_variant_name = ' - '.$variant_name;
    }
    if ($stock_response >= 1) {
      echo 'Disponible'.$stock_variant_name;
    }
    else {
      echo 'No Disponible'.$stock_variant_name;
    }
  }
}
