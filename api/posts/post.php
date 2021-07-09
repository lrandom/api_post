<?php
require_once './../header.php';
$baseName = __DIR__; //Library/WebServer/Documents/post_api/
$baseName = str_replace('api/posts', '', $baseName);
require_once $baseName.'/dal/PostDAL.php';//Library/WebServer/Documents/post_api/dal/PostDAL.php
$httpMethod = $_SERVER['REQUEST_METHOD'];
$postDAL = new PostDAL();
switch ($httpMethod) {
    case 'GET':
        //echo 'test';
        //lấy ra thông tin từ DB và trả về
        echo json_encode($postDAL->getAll());
        break;

    case 'POST':
        //thêm 1 bản ghi vào CSDL
        $data = json_decode(file_get_contents("php://input"), true);

        if ($postDAL->add($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'failed']);
        }
        break;

    case 'PUT':
        //sửa bản ghỉ trong CSDL
        break;

    case 'DELETE':
        //Xoá bản ghi trong CSDL
        $data = json_decode(file_get_contents("php://input"), true);

        if ($postDAL->delete($data['id'])) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'failed']);
        }
        break;
}
?>