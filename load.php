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
    $pdo->exec('TRUNCATE TABLE posts');
    $pdo->exec('TRUNCATE TABLE comments');

    $f_json = 'https://jsonplaceholder.typicode.com/posts';
    $json = file_get_contents("$f_json");

    $dataPosts = json_decode($json,true);


    $statement = $pdo->prepare('insert into posts (id, userId, title, body) values(:id, :userId, :title, :body)');

    foreach ($dataPosts as $postItem)
    {
        $statement->execute([
            ':id' => $postItem['id'],
            ':userId' => $postItem['userId'],
            ':title' => $postItem['title'],
            ':body' => $postItem['body'],
        ]);
    }



    $f_jsonCom = 'https://jsonplaceholder.typicode.com/comments';
    $jsonCom = file_get_contents("$f_jsonCom");
    $dataComments = json_decode($jsonCom,true);

    $statement2 = $pdo->prepare('insert into comments (id, postId, name, email, body) values(:id, :postId, :name, :email, :body)');

    foreach ($dataComments as $commentItem)
    {
        $statement2->execute([
            ':id' => $commentItem['id'],
            ':postId' => $commentItem['postId'],
            ':name' => $commentItem['name'],
            ':email' => $commentItem['email'],
            ':body' => $commentItem['body'],
        ]);
    }


    $postId = $pdo->query('select count(*) from posts')->fetchColumn();

    $commentId = $pdo->query('select count(*) from comments')->fetchColumn();

    $str = "Загружено " . $postId . " записей и ". $commentId ." комментариев";
    //echo("<script>console.log('".$str."');</script>");

    //$arr = array('postId' => $postId, 'commentId' => $commentId);
    //echo json_encode($arr);
    echo $str;

}
catch (Exception $err)
{
    echo "ОШИБКА: " . $err->getMessage();
}
?>