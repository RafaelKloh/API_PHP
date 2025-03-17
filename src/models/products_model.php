<?php

namespace App\models;

use App\models\Database;
use PDO;
Class Products_model extends Database
{
    public static function save(array $data){
        $pdo = self::get_connection();

        $stmt = $pdo->prepare("
            INSERT INTO products (name,price,quantity)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $data['name'],
            $data['price'],
            $data['quantity']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }

    public static function find(int|string $name)
    {
        $pdo = self::get_connection();

        $stmt = $pdo->prepare('
            SELECT id, name, price, quantity FROM products WHERE name = ?
        ');

        $stmt->execute([$name]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(array $data)
    {
        $pdo = self::get_connection();

        $stmt = $pdo->prepare('
            UPDATE products SET name = ? WHERE name = ?
        ');

        $stmt->execute([$data['name'],$data['current_name']]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete(int|string $id)
    {
        $pdo = self::get_connection();

        $stmt = $pdo->prepare('
            DELETE FROM products WHERE id = ?
        ');

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0 ? true : false;

    }
}