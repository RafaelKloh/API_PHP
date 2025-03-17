<?php

namespace App\services;

use Exception;
use PDOException;
use App\models\Products_model;
use App\utils\Validator;
use App\http\JWT;

class Products_service
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'price' => $data['price'] ?? '',
                'quantity' => $data['quantity'] ?? ''
            ]);
    
            $products = Products_model::save($fields);
    
            if (!$products) {
                return ['error' => 'Sorry, we could not register your product.'];
            }
    
            return "Product register successfully!";
        } 
        catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
            if($e->getCode() === '23000') return ['error' => 'Sorry, product already exists.'];
            return ['error' => $e->getCode()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetch(mixed $authorization, string $name)
    {
        try {

            if(isset($authorization['error'])){
                return ['error' => $authorization['error']];
            }

            $user_from_JWT = JWT::verify($authorization);

            if(!$user_from_JWT) return ['error' => 'Please, login to access this resource.'];


            $products = Products_model::find($name);

            if(!$products) return ['error' => 'Sorry, we couldnot find your product.'];

            return $products;
        } catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
        }

        catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    public static function update(mixed $authorization, array $data)
    {
        try {
            if(isset($authorization['error'])) return ['error' => $authorization['error']];

            $user_from_JWT = JWT::verify($authorization);

            if (!$user_from_JWT) return ['error' => 'Please login to access this resource.'];

            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'current_name' => $data['current_name']
            ]);

            $products = Products_model::update($data);

            if(!$products) return ['error' => 'Sorry, we could not update your account.'];

            return "Product update succesfully.";

        } catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
        }

        catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(mixed $authorization, int|string $id)
    {
        try {
            if(isset($authorization['error'])) return ['error' => $authorization['error']];

            $user_from_JWT = JWT::verify($authorization);

            if (!$user_from_JWT) return ['error' => 'Please login to access this resource.'];

           

            $products = Products_model::delete($id);

            if(!$products) return ['error' => 'Sorry, we could not delete your product.'];

            return "Product deleted succesfully.";

        } catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
        }

        catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}