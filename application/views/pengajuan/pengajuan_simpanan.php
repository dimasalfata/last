<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Upsss..!</title>

        <style>
            body {
                width:1000px;
                margin:0 auto;
                text-align: center;
                color:black;
            }
        </style>
    </head>

    <body>

        <!-- <img src="images/home_page_logo.png"> -->
        <h1><p>maaf, dalam tahap pengembangan</p></h1>
        <img src="<?php echo base_url()?>assets/img/under-maintenance.gif" alt="" title="" />
        <div class="section-title">
        <h2>
            <p>Informasi Pembukaan Tabungan atau pelayanan lainnya bisa melalui telepon / WA masing-masing marketing atau datang ke kantor cabang terdekat</p>
        </h2>
        </div>
        <div></div>

       

    </body>
</html>
<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 3600');
?>