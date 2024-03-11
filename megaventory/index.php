<html>
<body>
    <?php
    require_once 'Classes/Product.php';
    require_once 'Classes/SupplierClient.php';
    require_once 'Classes/InventoryLocation.php';

    //fun that creates relationship between a Product and a Client
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
        //edw 8a vaza to isset
        curl_close($curl);
        if ($ProductID == null || $ProductClientID == null){
            echo "Relationship between client and product was not created" .PHP_EOL;
        }
        else{
            echo "Relationship was created between client with ID $ProductClientID and product with ID $ProductID" .PHP_EOL;
        }
    }

    //fun that creates relationship between a Product and a Supplier
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
        if ($ProductID === null || $ProductSupplierID == null){
            echo "Relationship between supplier and product was not created" .PHP_EOL;
        }
        else{
            echo "Relationship was created between supplier with ID $ProductSupplierID and product with ID $ProductID" .PHP_EOL;
        }
        
    }

    //fun that updates the stock for an Inventory location
    function updateInventoryLocationStock($productid,$product_q,$locationid,$unitcost){
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "mvProductStockUpdateList"=>array(
                "ProductID" => $productid,
                "ProductQuantity" =>  $product_q,
                "InventoryLocationID" => $locationid,
                "ProductUnitCost" => $unitcost
            )
        );
    
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.megaventory.com/v2017a/InventoryLocationStock/ProductStockUpdate',
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
        if ($productid === null || $locationid === null){
            echo "There was not any update on Product Stock" .PHP_EOL;
        }
        else{
            echo "Product Stock was updated for product with ID $productid to $product_q units with $unitcost per unit in Inventory Location with ID $locationid" .PHP_EOL;
        }
    }


    //Creating a new product
    $product1 = new Product("pr11", "Nike shoespr11", 99.99, 44.99);
    $product1_id = $product1->create();
    echo"<br>";

    //Creating another new product
    $product2 = new Product("pr21", "Adidas shoespr21", 99.99, 44.99);
    $product2_id = $product2->create();
    echo"<br>";

    //Creating a new client
    $client = new SupplierClient("Client","babisFinal1", "babis@exampletest.com", "Example 8, Athens", "1235698967");
    $client_id = $client->createSupplierClient();
    echo"<br>";

    //Creating a new Supplier
    $supplier = new SupplierClient("Supplier","odysseusFinal1", "odysseus@exampletest.com", "Example 10, Athens", "1235698988");
    $supplier_id = $supplier->createSupplierClient();
    echo"<br>";

    //Creating a new Inventory Location
    $test_location = new InventoryLocation("sora dane","sora","Example 1,  Athens"); //name&abbreviation are unique
    $inventoryLocationID = $test_location->createInventoryLocation();
    echo"<br>";

    //get ids for relationship functions
    //$product1_id = $product1->getID();
    //$product2_id = $product2->getID();
    //$client1_id = $client1->getSupplierClientID();
    //$supplier1 = $supplier1->getSupplierClientID();

    //Create a relationship between Nike shoes and the client babis.
    createRelProductClient($product1_id, $client_id);
    echo"<br>";

    //Create a relationship between Adidas shoes and the supplier odysseus.
    createRelProductSupplier($product2_id, $supplier_id);
    echo"<br>";

    //update stock for product 1 to 5 and each unit cost 44.99
    updateInventoryLocationStock($product1_id,5,$inventoryLocationID,44.99);
    echo"<br>";

    //update stock for product 2 to 5 and each unit cost 44.99
    updateInventoryLocationStock($product2_id,5,$inventoryLocationID,44.99);
    echo"<br>";
    ?>
</body>
</html>