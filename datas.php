<?php 

try
{
    $db = new PDO('mysql:host=localhost;dbname=upload_photos;charset=utf8', 'root', '');
}

catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sql = "SELECT * FROM markers WHERE 1";
$result = $db->query($sql);

$datas = array();

while($row = $result->fetch())
{
    $datas[] = array(
        'id' => $row['id'],
        'name' =>$row['name'],
        'address' => $row['address'],
        'lat' =>$row['lat'],
        'lng' =>$row['lng'],
        'type' => $row['type']
    );
}

$json = json_encode($datas);
// Name and saves the file.
$filename = "markers.json";
file_put_contents($filename, $json);