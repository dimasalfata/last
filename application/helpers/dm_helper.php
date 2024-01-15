<?php

function get_ip()
{
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
$ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
$ip_address = $_SERVER['REMOTE_ADDR'];
}
return $ip_address;
}


function compress_gambar($config)
{
    $ci =& get_instance();
    $ci->load->library('image_lib', $config);
    $hasil = $ci->image_lib->resize();
    return $hasil;
}

function get_quality($ukuran_gambar)
{
    switch ($ukuran_gambar) {
        case $ukuran_gambar < 1000000 :
        $qlty = 100;
        break;
        case $ukuran_gambar < 1500000 :
        $qlty = 80;
        break;
        case $ukuran_gambar < 2000000 :
        $qlty = 60;
        break;
        case $ukuran_gambar < 2500000 :
        $qlty = 40;
        break;
        case $ukuran_gambar < 3000000 :
        $qlty = 30;
        break;
        case $ukuran_gambar > 3000000 :
        $qlty = 20;
        break;
        default:
        $qlty = 30;
        break;
    }

    return $qlty;
}

function get_kualitas($size)
{
    switch ($size) {
        case $size < 500000 :
        $quality = "100%";
        break;
        case $size < 1000000 :
        $quality = "80%";
        break;
        case $size < 1500000 :
        $quality = "60%";
        break;
        case $size < 2000000 :
        $quality = "50%";
        break;
        case $size < 2500000 :
        $quality = "40%";
        break;
        case $size < 3000000 :
        $quality = "30%";
        break;
        case $size > 3000000 :
        $quality = "20%";
        break;
        default:
        $quality = "30%";
        break;
    }
    return $quality;
}

function mulai_kompress($lampiran,$location)
{
    $ukuran_gambar = intval(filesize($lampiran));
    $qlty = get_quality($ukuran_gambar);
    $info = getimagesize($lampiran);
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($lampiran);
    }
    elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($lampiran);
    }
    elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($lampiran);
    }

    imagejpeg($image, $location, $qlty);
    imagedestroy($image);

            // // DIRESIZE DISINI
    list($width, $height) = getimagesize($location);
    $size = intval(filesize($location));
    $quality = get_kualitas($size);
    $config['image_library']='gd2';
    $config['source_image']=$location;
    $config['create_thumb']= FALSE;
    $config['maintain_ratio']= FALSE;
    $config['quality']= strval($quality);
    $config['width']= $width;
    $config['height']= $height;
    $config['new_image']= $location;
    $hasil = compress_gambar($config);
    return $hasil;
}



?>