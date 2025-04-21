<?php
class ApiResponse {
    public static function sendResponse($status_code, $data = null, $message = null) {
        http_response_code($status_code);
        header('Content-Type: application/json');
        
        $response = [];
        if ($message) $response['message'] = $message;
        if ($data) $response['data'] = $data;
        
        echo json_encode($response);
        exit;
    }
}
?>