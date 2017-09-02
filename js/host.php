 <?php   
    $url = "http://www.php-.com/js/origin.php"; 
    $headers = array( 
        "Content-type: text/xml;charset=\"utf-8\"", 
        "Cache-Control: no-cache", 
        "Pragma: no-cache",
        "HOST: www.php-11.com"
    ); 
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    
    $data = curl_exec($ch); 

    if (curl_errno($ch)) { 
        print "Error: " . curl_error($ch); 
    } else {
        curl_close($ch); 
    }