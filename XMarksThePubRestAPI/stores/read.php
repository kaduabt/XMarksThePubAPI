<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/stores.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$store = new Store($db);

// query products
$stmt = $store->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $stores_arr=array();
    $stores_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $store_item=array(
            "id" => $s_id,
            "name" => $s_name,
            "type" => $s_type,
            "latitude" => $s_latitude,
            "longitude" => $s_longitude,
            "address" => $s_address
        );

        array_push($stores_arr["records"], $store_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($stores_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>