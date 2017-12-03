<?php 
function request($url, $data, $debug = FALSE)
  {
    $cookie = 'datr=BZAiWkbb1b0AVfZYvtEddKV4; locale=en_US; sb=BZAiWkFErFYHuDi3JQkrbiQ-; c_user=100023197853577; xs=7%3AW29Jvafyu5Z4CA%3A2%3A1512214687%3A-1%3A-1; fr=06p18tUu9J5dw7Po0.AWV7a9nIACRzTN0aGvCOWbT-9EY.BaIEdS.-b.AAA.0.0.BaIpCe.AWV9gm3Y; pl=n; act=1512243867962%2F4; presence=EDvF3EtimeF1512243953EuserFA21B23197853577A2EstateFDutF1512243953020CEchFDp_5f1B23197853577F2CC; wd=1920x974';

    $options = array(
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER         => FALSE,
    // CURLOPT_FOLLOWLOCATION => TRUE,
    CURLOPT_ENCODING       => '',
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36',
    CURLOPT_AUTOREFERER    => TRUE,
    CURLOPT_CONNECTTIMEOUT => 15,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_MAXREDIRS      => 5,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_COOKIE => $cookie,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data)
  );

  $ch = curl_init();
  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  unset($options);
  return $http_code === 200 ? $response : FALSE;
}

function search($phone){

  $data = request('https://m.facebook.com/presma/user_search_typeahead/?search_mode=ANYONE_EXCEPT_VERIFIED_ACCOUNT&dpr=1', array(
    '__a' => '1',
    '_user' => '100023197853577',
    'fb_dtsg' => 'AQF57_fW_fjw:AQFzBh5sPXZk',
    'q' => $phone
  ));

  if($data !== false ){
    $json = json_decode(substr($data, 9));
    print_r($json);
    // $json->payload->payload[0]->uid;
    // print_r($json->payload->payload[0]->uid);
    if (isset($json->payload->payload[0]->uid)) {
      echo 'payload exist';
    } else{
      echo 'payload not exist';
    }
    return true;
  }
  return false;
}
  
  $data = '';

  $i = 0;
    
    // for ($i1=0; $i1<=9; $i1++) {
    //   for ($i2=0; $i2<=9; $i2++) {
    //     for ($i3=0; $i3<=9; $i3++) {
    //       for ($i4=0; $i4<=9; $i4++) {
    //         for ($i5=0; $i5<=9; $i5++) {
    //           $num = "09123{$i1}{$i2}{$i3}{$i4}{$i5}"; 
    //           $data = search($num);
    //           $i++;

    //           echo $i . PHP_EOL;

    //           if($data == false){
    //             exit;
    //           }
    //         }
    //       }
    //     }
    //   }      
    // }

    // echo $i . PHP_EOL;
    // print_r($data);
    search('01692063812');
