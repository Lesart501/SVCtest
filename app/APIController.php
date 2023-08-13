<?php

namespace App;


class APIController{
    // создаются поля-массивы, в которых будут храниться данные о пользователях, постах и заданиях
    private array $users;
    private array $posts;
    private array $todos;

    // метод получения пользователя
    public function userGetData(int $id){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$id");
        $this->users[$id] = json_decode($data);
    }
    // метод получения постов пользователя
    public function postsGetData(int $userID){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$userID/posts");
        $postsArr = json_decode($data, true);
        for ($i=0; $i < count($postsArr); $i++) { 
            $postsArr[$i] = (object) $postsArr[$i];
        }
        $this->posts[$userID] = $postsArr;
    }
    // метод получения заданий пользователя
    public function todosGetData(int $userID){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$userID/todos");
        $todosArr = json_decode($data, true);
        for ($i=0; $i < count($todosArr); $i++) { 
            $todosArr[$i] = (object) $todosArr[$i];
        }
        $this->todos[$userID] = $todosArr;
    }

    // геттеры для получения пользователей, их постов и заданий
    public function getUser(int $id){
        return $this->users[$id];
    }
    public function getUserPosts(int $userID): array{
        return $this->posts[$userID];
    }
    public function getUserTodos(int $userID): array{
        return $this->todos[$userID];
    }

    // метод добавления нового поста в json и отправка обновлённых данных
    public function addPost(int $userId, string $title, string $body){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$userId/posts");
        $tempArray = json_decode($data, true);
        $tempArray[] = [
            "userId" => $userId,
            "id" => count($tempArray) + 1,
            "title" => $title,
            "body" => $body
        ];
        $data = json_encode($tempArray);
        $url = "https://jsonplaceholder.typicode.com/users/$userId/posts";
        $crl = curl_init($url);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($crl);
        return $result;
    }
    // метод изменения поста в json и отправка обновлённых данных
    public function editPost(int $userId, int $postId, string $title, string $body){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$userId/posts");
        $tempArray = json_decode($data, true);
        $tempArray[$postId] = [
            "title" => $title,
            "body" => $body
        ];
        $data = json_encode($tempArray);
        $url = "https://jsonplaceholder.typicode.com/users/$userId/posts";
        $crl = curl_init($url);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($crl);
        return $result;
    }
    // метод удаления поста в json и отправка обновлённых данных
    public function deletePost(int $userId, int $postId){
        $data = file_get_contents("https://jsonplaceholder.typicode.com/users/$userId/posts");
        $tempArray = json_decode($data, true);
        unset($tempArray[$postId]);
        $data = json_encode($tempArray);
        $url = "https://jsonplaceholder.typicode.com/users/$userId/posts";
        $crl = curl_init($url);
        curl_setopt($crl, CURLOPT_POST, true);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($crl);
        return $result;
    }
}