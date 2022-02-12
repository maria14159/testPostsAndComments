<?php

$servername = "localhost";
$database = "testphp";
$username = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $database :" . $pe->getMessage());
}
try
{
    $comment = $_POST['text'];
    $str = "%" . $comment . "%";
    $statement = $pdo->prepare(
        'select p.title, c.body
            from 
                 comments as c 
                    left join posts as p on c.postID = p.id
            where c.body like ?');

    $statement->execute([$str]);

    $resStr = "";
    while ($r=$statement->fetch(PDO::FETCH_ASSOC)) {
        $dat = str_replace(array("\r\n", "\r", "\n"), '<br>', $r['body']);
        $resStr = $resStr . "<tr> <td>".$r['title']."</td> <td>". $dat ."</td></tr>";
    }

    //echo $dat;
    echo $resStr;

}
catch (Exception $err)
{
    echo "ОШИБКА: " . $err->getMessage();
}