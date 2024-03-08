<?php


// function that creates a product
function createProduct($ProductSKU, $ProductDescription, $ProductSellingPrice, $ProductPurchasePrice){
    $curl = curl_init();

    $postData = array(
        "APIKEY" => "bc2ea81fdaba78e0@m145512",
        "mvProduct"=>
        array(
            "ProductSKU" => $ProductSKU,
            "ProductDescription" => $ProductDescription,
            "ProductSellingPrice" => $ProductSellingPrice,
            "ProductPurchasePrice" => $ProductPurchasePrice
        ),
        "mvRecordAction" => "Insert"
    );
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.megaventory.com/v2017a/Product/ProductUpdate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($postData),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    //capture response
    $response = curl_exec($curl);
    //decode from json to array
    $data = json_decode($response, true);
    $data_encoded = json_encode($data['mvProduct']);
    //make array so we can get product id
    $productID = json_decode($data_encoded, true);
    $product_en = $productID['ProductID'];

    curl_close($curl);
    return $product_en;
    
}



function getProductID($ProductDescription){
  $curl = curl_init();

  $postData = array(
      "APIKEY" => "bc2ea81fdaba78e0@m145512",
      "Filters"=>
      array(
          "FieldName" => "ProductDescription",
          "SearchOperator" => "Equals",
          "SearchValue" => $ProductDescription
      ),
      "ReturnTopNRecords" => 1
  );
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/Product/ProductGet',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  //capture response
  $response = curl_exec($curl);
  //decode from json to array
  $data = json_decode($response, true);
  $productID = $data['mvProducts'][0]['ProductID'];

  curl_close($curl);
  return $productID;
}

//function that creates  a Client
function createClient($SupplierClientName, $SupplierClientEmail, $SupplierClientShippingAddress1, $SupplierClientPhone1){
  $curl = curl_init();
  $postData = array(
    "APIKEY" => "bc2ea81fdaba78e0@m145512",
    "mvSupplierClient"=>array(
        "SupplierClientType" => "Client",
        "SupplierClientName" => $SupplierClientName,
        "SupplierClientEmail" => $SupplierClientEmail,
        "SupplierClientShippingAddress1" => $SupplierClientShippingAddress1,
        "SupplierClientPhone1" => $SupplierClientPhone1
        ),
    "mvRecordAction" => "Insert"
    );

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/SupplierClient/SupplierClientUpdate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  echo $response;

}

function getSupplierClientID($SupplierClientName){
  $curl = curl_init();

  $postData = array(
      "APIKEY" => "bc2ea81fdaba78e0@m145512",
      "Filters"=>
      array(
          "FieldName" => "SupplierClientName",
          "SearchOperator" => "Equals",
          "SearchValue" => $SupplierClientName
      ),
      "ReturnTopNRecords" => 1
  );
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/SupplierClient/SupplierClientGet',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  //capture response
  $response = curl_exec($curl);
  //decode from json to array
  $data = json_decode($response, true);
  $clientID = $data['mvSupplierClients'][0]['SupplierClientID'];

  curl_close($curl);
  return $clientID;
}

//function that creates  a Supplier
function createSupplier($SupplierClientName, $SupplierClientEmail, $SupplierClientShippingAddress1, $SupplierClientPhone1){
    $curl = curl_init();
    $postData = array(
        "APIKEY" => "bc2ea81fdaba78e0@m145512",
        "mvSupplierClient"=>array(
            "SupplierClientType" => "Supplier",
            "SupplierClientName" => $SupplierClientName,
            "SupplierClientEmail" => $SupplierClientEmail,
            "SupplierClientShippingAddress1" => $SupplierClientShippingAddress1,
            "SupplierClientPhone1" => $SupplierClientPhone1
        ),
        "mvRecordAction" => "Insert"
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.megaventory.com/v2017a/SupplierClient/SupplierClientUpdate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($postData),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
  
}


//function that creates  an Inventory
function createInventory($InventoryLocationName, $InventoryLocationAbbreviation, $InventoryLocationAddress){
    $curl = curl_init();
    $postData = array(
        "APIKEY" => "bc2ea81fdaba78e0@m145512",
        "mvInventoryLocation"=>array(
            "InventoryLocationName" => $InventoryLocationName,
            "InventoryLocationAbbreviation" =>  $InventoryLocationAbbreviation,
            "InventoryLocationAddress" => $InventoryLocationAddress
        ),
        "mvRecordAction" => "Insert"
    );

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/InventoryLocation/InventoryLocationUpdate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

//function that creates  a relationship between product/client
function createRelProductClient($ProductID, $ProductClientID){
    $curl = curl_init();
    $postData = array(
        "APIKEY" => "bc2ea81fdaba78e0@m145512",
        "mvProductClientUpdate"=>array(
            "ProductID" => $ProductID,
            "ProductClientID" => $ProductClientID
        ),
        "mvRecordAction" => "Insert"
    );

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/ProductClient/ProductClientUpdate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

//function that creates  a relationship between product/supplier
function createRelProductSupplier($ProductID, $ProductSupplierID){
    $curl = curl_init();
    $postData = array(
        "APIKEY" => "bc2ea81fdaba78e0@m145512",
        "mvProductSupplierUpdate"=>array(
            "ProductID" => $ProductID,
            "ProductSupplierID" => $ProductSupplierID
        ),
        "mvRecordAction" => "Insert"
    );

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.megaventory.com/v2017a/ProductSupplier/ProductSupplierUpdate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postData),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

//5. Update the availability of products in 5 units in the warehouse you added at a cost of 44.99 each.
//Pending

$product_id = createProduct("1112265", "test2 shoes", 99.99, 44.99);
echo "Product was created, product ID is $product_id" . PHP_EOL;

$product_id2 = createProduct("1112248", "Adidas shoes", 99.99, 44.99);
echo "Product was created, product ID is $product_id2" . PHP_EOL;

createClient("babis", "babis@exampletest.com", "Example 8, Athens", "1235698967");

createSupplier("odysseus", "odysseus@exampletest.com", "Example 10, Athens", "1235698988");

createInventory("Test Project Location","Test","Example 20, Athens");

createRelProductClient(getProductID("Nike shoes"),  getSupplierClientID("babis"));

createRelProductSupplier(getProductID("Adidas shoes"), getSupplierClientID("odysseus"));