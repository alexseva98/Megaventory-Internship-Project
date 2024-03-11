<?php

class InventoryLocation {

    //Properties
    private $InventoryLocationName;
    private $InventoryLocationAbbreviation;
    private $InventoryLocationAddress;

    //Constructor 
    public function __construct($InventoryLocationName, $InventoryLocationAbbreviation, $InventoryLocationAddress) {
        $this->InventoryLocationName = $InventoryLocationName;
        $this->InventoryLocationAbbreviation = $InventoryLocationAbbreviation;
        $this->InventoryLocationAddress = $InventoryLocationAddress; 
    }

    //Method to create inventory location in megaventory app
    public function createInventoryLocation(){
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "mvInventoryLocation"=>array(
                "InventoryLocationName" => $this->InventoryLocationName,
                "InventoryLocationAbbreviation" =>  $this->InventoryLocationAbbreviation,
                "InventoryLocationAddress" => $this->InventoryLocationAddress
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
        
        $data = json_decode($response, true);
        if(isset($data['mvInventoryLocation'])) {

            $data_encoded = json_encode($data['mvInventoryLocation']);
            //make array so we can get location id
            $locationID = json_decode($data_encoded, true);
            $invLocationID = $locationID['InventoryLocationID'];

            curl_close($curl);
            echo "Inventory Location $this->InventoryLocationName was created with ID: $invLocationID" . PHP_EOL;
            return $invLocationID;
        }
        else{
            curl_close($curl);
            echo "Inventory Location $this->InventoryLocationName allready exists " . PHP_EOL;
        }
    }

    public function getInventoryLocationID() {
        // Use curl to get the product ID
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "Filters"=>
            array(
                "FieldName" => "InventoryLocationName",
                "SearchOperator" => "Equals",
                "SearchValue" => $this->InventoryLocationName
            ),
            "ReturnTopNRecords" => 1
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.megaventory.com/v2017a/InventoryLocation/InventoryLocationGet',
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
        $inventoryID = $data['mvInventoryLocations'][0]['InventoryLocationID'];

        curl_close($curl);
        echo "Inventory Location ID is: $inventoryID" . PHP_EOL;
        return $inventoryID;
    }
}
