<?php

namespace MyApp\Models;


class User extends AbstractModel
{

    public function getById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row && count($row)) {
            return $row;
        }
        return false;
    }



    public function create($data = [])
    {
        $query = "INSERT INTO users (id, oauth_token, oauth_token_secret,
                    profile_image_url, screen_name, followers_count, friends_count, 
                    statuses_count, created_at, favourites_count, name)
                        VALUES (:id, :oauth_token, :oauth_token_secret,
                        :profile_image_url, :screen_name, :followers_count, :friends_count, :statuses_count, :created_at,
                        :favourites_count, :name)
                ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $data['id']);
        $stmt->bindValue(':oauth_token', $data['oauth_token']);
        $stmt->bindValue(':oauth_token_secret', $data['oauth_token_secret']);
        $stmt->bindValue(':profile_image_url', $data['profile_image_url']);
        $stmt->bindValue(':screen_name', $data['screen_name']);
        $stmt->bindValue(':followers_count', $data['followers_count']);
        $stmt->bindValue(':friends_count', $data['friends_count']);
        $stmt->bindValue(':statuses_count', $data['statuses_count']);
        $stmt->bindValue(':created_at', $data['created_at']);
        $stmt->bindValue(':favourites_count', $data['favourites_count']);
        $stmt->bindValue(':name', $data['name']);
        return $stmt->execute();
    }


    public function update($data = [])
    {
        $query = "UPDATE users SET oauth_token = :oauth_token, oauth_token_secret = :oauth_token_secret,
                    profile_image_url = :profile_image_url, screen_name = :screen_name, 
                    followers_count = :followers_count, friends_count = :friends_count, 
                    statuses_count = :statuses_count, favourites_count = :favourites_count, name = :name
                    WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $data['id']);
        $stmt->bindValue(':oauth_token', $data['oauth_token']);
        $stmt->bindValue(':oauth_token_secret', $data['oauth_token_secret']);
        $stmt->bindValue(':profile_image_url', $data['profile_image_url']);
        $stmt->bindValue(':screen_name', $data['screen_name']);
        $stmt->bindValue(':followers_count', $data['followers_count']);
        $stmt->bindValue(':friends_count', $data['friends_count']);
        $stmt->bindValue(':statuses_count', $data['statuses_count']);
        $stmt->bindValue(':favourites_count', $data['favourites_count']);
        $stmt->bindValue(':name', $data['name']);
        return $stmt->execute();
    }

}