<?php
function get_account_by_id($db, $id) {
    $query = "SELECT * FROM users where id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}