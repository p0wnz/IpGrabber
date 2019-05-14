<?php
$file_log = "fiu439ujh28033uj9rjh329uj289ur0u32r0u0ur3928.log";
$key = "AfjdQV8Nu7L5tTDX9Wqggbu44C366DDjZPLrtTbH3kQ7PA5tv2CNScxNgfqBcbXsYpVXfBhTvCLpQZ9HPSJjgcHsHLUtmVn4NYuUQbUHRGwws";
function write_log()
{

    $file_name = $GLOBALS['file_log'];
    $log_exists = file_exists($file_name);
    $mode ='w';
    $log_exists && ($mode ='a');
    $file = fopen($file_name,$mode);
    if (!$file) return;
    $address = getUserIpAddr();
    fwrite($file, $address . ', ' . date("Y-m-d   h:i:sa"). "," . $_GET["pic"]."\n");
    fclose($file);
    return true;
}
function print_picture($name)
{
    
    $fp = fopen($name, 'rb');

    header("Content-Type: image/png");
    header("Content-Length: " . filesize($name));

    fpassthru($fp);
}
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$_GET == Array() && print("Error file not found");
if (isset($_GET['pic']))
{
    write_log() ;
    print_picture($_GET['pic']);
}

if (isset($_GET['config'] ) &&  $_GET['config'] == $key)
{
    print("<head>");
    print('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >');
    print("<script src=main.js></script>");
    print("</head>");

    print("<body onload=\"main()\" >");

    


    
    $files = scandir(".");
    print("<div id=app>");
    foreach ($files as $dfile)
    {
        if ($dfile != "." || $dfile != "..") 
        {
            $extension = explode(".", $dfile)[1];
            if ($extension == "log" || $extension == "js" || $extension == "php" || $extension == "css" || $extension == "") continue;
            if ($extension == "jpg" || $extension == "jpeg" ||$extension == "gif" ||$extension == "bmp" ||$extension == "png" ||$extension == "svg")print($dfile . ",");
        }
    }
    !file_exists($file_log) && die("Empty");
    $file = file_get_contents ($file_log);

    !$file && die("Empty");

    $array_of_lines = explode("\n", $file);
    print("</div>");
    print(" <table class=\"table table-striped\"> <tr> <th>Ip address</th> <th>Date & Time</th> <th>Picture</th> </tr>");
    foreach ( $array_of_lines as $line)
    {
        if($line =="" || $line=="empty")  continue;
        $var_data = explode(",",$line);
        
        print("<tr><td>". $var_data[0] ."</td><td>". $var_data[1] ."</td><td>". $var_data[2] ."</td></tr>");
    }
    print("</table>");
    
    print("</body>");
}
if (isset($_GET['clear'] ) &&  $_GET['clear'] == $key)
{
    unlink($file_log);
    header("Location: index.php?config=". $key);
}

if (isset($_GET['delete'] ))
{
    print($_GET['delete']);
    unlink($_GET['delete']);
    header("Location: index.php?config=". $key);
}