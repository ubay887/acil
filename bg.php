<?php
error_reporting(0);
function getStr($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}
function randHpr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function reg($e,$r){
$ch = curl_init();
$data = 'email='.str_replace("gmail.com","peler-report-03.info","".$e."").'&password=SusuKNTL12#&monetize=1&referral_id='.$r;

curl_setopt($ch, CURLOPT_URL, 'https://api.bigtoken.com/signup');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$headers = array();
$headers[] = 'X-Client-ID: WW1GelpUWTBPbnBFY1hBMFVrTnNWbUZ4VTNsbFVHSnVlV3BTWm1rd1JrWkhlbHBxWm5OaFVsWjJhM3BhUkhocloyczk=';
$headers[] = 'Accept: application/json';
$headers[] = 'User-Agent: BIGtoken/1.0.6.2 Dalvik/2.1.0 Linux; U; Android '.rand(5,8).'.1.0; '.randHpr(16).' Build/25';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Host: api.bigtoken.com';
$headers[] = 'Connection: Keep-Alive';
$headers[] = 'Accept-Encoding: gzip';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

return curl_exec($ch);
curl_close ($ch);
}
echo "==========================================";
echo "\r\n";
echo "Bigtoken X HanungPangestu X SGBTeam - 2019";
echo "\r\n";
echo "==========================================";
echo "\r\n";
echo "Kode Referral ? : ";
$reff = trim(fgets(STDIN));
echo "Berapa ? : ";
$jumlah = trim(fgets(STDIN));
echo "==========================================";
echo "\r\n";
$i=1;
while($i <= $jumlah){
    $getmail = json_decode(file_get_contents('https://hanungofficial.club/api/sgb/sgbkrw-generate.php'));
    $status = $getmail->result;
    if ($status == "1"){
        echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Failed generate email';
        echo "\r\n";
    } else if ($status =="0") {
        $email = $getmail->message;
        $regist = reg($email,$reff);
        $hpr = getStr($regist,'"bigid":"','"');
        if (stripos($regist, 'Too Many Attempts.')) {
            $lim = getStr($regist,'Retry-After: ','
X-RateLimit-Reset');
            $limit = explode("\r\n", $lim);
            $hprz = $limit[0]+1;
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Too Many Attempts. ( Tunggu '.$hprz.' detik )';
            echo "\r\n";
            sleep($hprz);
        } else if (stripos($regist, 'The email has already been taken.')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => The email has already been taken.';
            echo "\r\n";
        } else if ($hpr) {
            $mailhpr = explode('@', $email);
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Sukses Buat Akun | Email : '.$mailhpr[0].'@gmail.com';
            echo "\r\n";
            echo 'Proses Verif, Tunggu 4 detik...';
            echo "\r\n";
            sleep(4);
            $gagal=1;
            reverif:
            if ($gagal == "6"){
                $fp = fopen("btmissVerif.txt", "a");
                fputs($fp, "".$get->message."\r\n");
                fclose($fp);
                echo '  [ '.$reff.' ] => Gagal Verif';
                echo "\r\n";
                echo "\r\n";
            } else {
                $verif = json_decode(file_get_contents('https://hanungofficial.club/api/sgb/sgbkrw-konfirm.php?email='.$email));
                $status2 = $verif->result;
                if ($status2 == "0"){
                    echo '  [ '.$reff.' ] => '.$verif->message;
                    echo "\r\n";
                    echo "\r\n";
                    $i++;
                } else if ($status2 == "1"){
                    echo '  [ '.$reff.' ] => '.$verif->message.' ( Tunggu 3 detik ) ( Gagal '.$gagal.'x )';
                    echo "\r\n";
                    sleep(3);
                    $gagal++;
                    goto reverif;
                } else {
                    echo '  [ '.$reff.' ] => '.$verif->message;
                    echo "\r\n";
                    echo "\r\n";
                }
            }
        } else if (stripos($regist, 'The referral id format is invalid.')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => INVALID REFFERAL';
            echo "\r\n";
            exit;
        } else if (stripos($regist, 'INVALID_REFERRAL')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => INVALID REFFERAL';
            echo "\r\n";
            exit;
        } else if (stripos($regist, 'The email must be a valid email address.')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Domain ga support';
            echo "\r\n";
            sleep(2);
        } else if (stripos($regist, 'The email must have a valid domain.')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Domain ga support';
            echo "\r\n";
            sleep(2);
        } else if (stripos($regist, 'validation.app_rules_email_domain')) {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Maybe Domain Blocked!';
            echo "\r\n";
            sleep(2);
        } else {
            echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Unknown => ( Contact Admin )';
            echo "\r\n";
        }
    } else {
        echo '['.$i.'/'.$jumlah.'] [ '.$reff.' ] => Unknown2 => ( Contact Admin )';
        echo "\r\n";
    }
?>
