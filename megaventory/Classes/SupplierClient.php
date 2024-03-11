<?php

class SupplierClient {

    //Properties
    private $SupplierClientType;
    private $SupplierClientName;
    private $SupplierClientEmail;
    private $SupplierClientShippingAddress1;
    private $SupplierClientPhone1;

    //Constructor 
    public function __construct($SupplierClientType,$SupplierClientName, $SupplierClientEmail, $SupplierClientShippingAddress1,$SupplierClientPhone1) {
        $this->SupplierClientType = $SupplierClientType;
        $this->SupplierClientName = $SupplierClientName;
        $this->SupplierClientEmail = $SupplierClientEmail;
        $this->SupplierClientShippingAddress1 = $SupplierClientShippingAddress1; 
        $this->SupplierClientPhone1 = $SupplierClientPhone1; 
    }

    //Method to create supplier in megaventory app
    public function createSupplierClient(){
        $curl = curl_init();
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "mvSupplierClient"=>
            array(
                "SupplierClientType" => $this->SupplierClientType,
                "SupplierClientName" => $this->SupplierClientName,
                "SupplierClientEmail" => $this->SupplierClientEmail,
                "SupplierClientShippingAddress1" => $this->SupplierClientShippingAddress1,
                "SupplierClientPhone1" => $this->SupplierClientPhone1
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
        
        $data = json_decode($response, true);
        if(isset($data['mvSupplierClient'])) {

          $data_encoded = json_encode($data['mvSupplierClient']);
          //make array so we can get supplier client id
          $sc_ID = json_decode($data_encoded, true);
          $supplierClientID = $sc_ID['SupplierClientID'];

          curl_close($curl);
          echo "$this->SupplierClientType named $this->SupplierClientName was created with id $supplierClientID" . PHP_EOL;
          return $supplierClientID;
        }
        else{
          curl_close($curl);
          echo "$this->SupplierClientType named $this->SupplierClientName allready exists" . PHP_EOL;
          return null;
        }
        
    }

    //Method to get supplierClientID from megaventory app
    public function getSupplierClientID(){
        $curl = curl_init();
      
        $postData = array(
            "APIKEY" => "bc2ea81fdaba78e0@m145512",
            "Filters"=>
            array(
                "FieldName" => "SupplierClientName",
                "SearchOperator" => "Equals",
                "SearchValue" => $this->SupplierClientName
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

}

