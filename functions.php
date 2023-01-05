<?php
    function initiateAPI(){
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
          'start' => '1',
          'limit' => '20',
          'convert' => 'USD'
        ];
        
        $headers = [
          'Accepts: application/json',
          'X-CMC_PRO_API_KEY: 1569c86d-808e-4ef3-8aa1-53e4e2c1244c'
        ];
        $qs = http_build_query($parameters);
        $request = "{$url}?{$qs}";
        
        $curl = curl_init();
       
        curl_setopt_array($curl, array(
          CURLOPT_URL => $request,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_RETURNTRANSFER => 1
        ));
        
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    function convertIntoArray(){

        $result = initiateAPI();

        $responseArray = (json_decode($result, true));

        return $responseArray;
    }

    function imgSymbol(){

      $result = convertIntoArray();

      $symbol=[];

      $lenght = count($result['data']);

      for($i=0; $i<$lenght; $i++){
        $symbol[$i]=$result['data'][$i]['symbol'];
      }

      $arrayString = implode(",", $symbol);

      return $arrayString;
    }



    function initiateAPIImg(){
      $imgSymbol = imgSymbol();

      $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/info';
      $parameters = [
        'symbol' => $imgSymbol
      ];

      $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: 1569c86d-808e-4ef3-8aa1-53e4e2c1244c'
      ];
      $qs = http_build_query($parameters); // query string encode the parameters
      $request = "{$url}?{$qs}"; // create the request URL


      $curl = curl_init(); // Get cURL resource
      // Set cURL options
      curl_setopt_array($curl, array(
        CURLOPT_URL => $request,            // set the request URL
        CURLOPT_HTTPHEADER => $headers,     // set the headers 
        CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
      ));

      $response = curl_exec($curl); // Send the request, save the response
      $result = json_decode($response, true); // print json decoded response
      curl_close($curl); // Close request

      return $result;
    }

    function imgUrlx(){
      $dataImg = initiateAPIImg();

      $imgSymbolX = imgSymbol();
      
      $dataImgArray = explode( ',', $imgSymbolX);

      
      $resultX = convertIntoArray();

      $lenght = count($resultX['data']); 

      $tabUrl = [];

      for($i = 0; $i < $lenght ; $i++){
        $tabUrl[$i] = $dataImg['data']["$dataImgArray[$i]"]['logo'];
      }

      return $tabUrl;
    }

    $image = imgUrlx();
    echo "<img src=".$image[0].">"

?>




