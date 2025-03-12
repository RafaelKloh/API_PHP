<?php

namespace App\services;

use Exception;
use PDOException;
use App\models\User_model;
use App\utils\Validator;
use App\http\JWT;

class User_service
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
    
            $user = User_model::save($fields);
    
            if (!$user) {
                return ['error' => 'Sorry, we could not create your account.'];
            }
    
            return "User created successfully!";
        } 
        catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
            if($e->getCode() === '23000') return ['error' => 'Sorry, user already exists.'];
            return ['error' => $e->getCode()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $user = User_model::authentication($fields);

            if(!$user) return ['error' => 'Sorry, we could not authenticate you.'];

            return JWT::generate($user);
        } catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
        }
        catch(Exception $e){
            return ['eeor' => $e->getMessage()];
        }
    }

    public static function fetch(mixed $authorization)
    {
        try {

            if(isset($authorization['error'])){
                return ['error' => $authorization['error']];
            }

            $user_from_JWT = JWT::verify($authorization);

            if(!$user_from_JWT) return ['error' => 'Please, login to access this resource.'];

            $user = User_model::find($user_from_JWT['id']);

            if(!$user) return ['error' => 'Sorry, we couldnot find your account.'];

            return $user;
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
                'name' => $data['name'] ?? ''
            ]);

            $user = User_model::update($user_from_JWT['id'], $fields);

            if(!$user) return ['error' => 'Sorry, we could not update your account.'];

            return "User update succesfully.";

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

           

            $user = User_model::delete($id);

            if(!$user) return ['error' => 'Sorry, we could not update your account.'];

            return "User deleted succesfully.";

        } catch (PDOException $e) {
            if($e->getCode() === 1049) return ['error' => 'Sorry, we could not connect to the database'];
        }

        catch(Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}
