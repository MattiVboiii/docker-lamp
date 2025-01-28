<?php

function connectToDB()
{
    $db_host = 'db';
    $db_user = 'username';
    $db_password = 'password';
    $db_db = 'dockerlamp';
    $db_port = 3306;

    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}


function getDbImages(): array
{
    $sql = "SELECT * FROM dbimages";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertDbImage(String $path): bool|int
{
    $db = connectToDB();
    $sql = "INSERT INTO dbimages(path) VALUES (:path)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'path' => $path,
    ]);

    return $db->lastInsertId();
}

function deleteDbImg(int $id): int
{
    $db = connectToDB();
    $sql = "DELETE FROM dbimages WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'id' => $id,
    ]);

    return $stmt->rowCount();
}
