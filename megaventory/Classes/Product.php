<?php

class Product {

    //Properties
    private $ProductSKU;
    private $ProductDescription;
    private $ProductSellingPrice;
    private $ProductPurchasePrice;

    //Constructor 
    public function __construct($ProductSKU, $ProductDescription, $ProductSellingPrice, $ProductPurchasePrice) {
        $this->ProductSKU = $ProductSKU;
        $this->ProductDescription = $ProductDescription;
        $this->ProductSellingPrice = $ProductSellingPrice;
        $this->ProductPurchasePrice = $ProductPurchasePrice;    
    }

    //Method to create product in megaventory app
    public function create() {
        // Use curl to create the product
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "mvProduct"=>
            array(
                "ProductSKU" => $this->ProductSKU,
                "ProductDescription" => $this->ProductDescription,
                "ProductSellingPrice" => $this->ProductSellingPrice,
                "ProductPurchasePrice" => $this->ProductPurchasePrice
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
        if(isset($data['mvProduct'])) {

            $data_encoded = json_encode($data['mvProduct']);
            //make array so we can get product id
            $productID = json_decode($data_encoded, true);
            $product_en = $productID['ProductID'];

            curl_close($curl);
            echo "Product $this->ProductDescription was created with ID: $product_en" . PHP_EOL;
            return $product_en;
        }
        else{
            echo "Product $this->ProductDescription allready exists" . PHP_EOL;
            return null;
        }
        
        }
        

    //Method to get productID from megaventory app
    public function getID() {
        // Use curl to get the product ID
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "Filters"=>
            array(
                "FieldName" => "ProductDescription",
                "SearchOperator" => "Equals",
                "SearchValue" => $this->ProductDescription
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

}

