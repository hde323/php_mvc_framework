<?php

namespace src;

use InvalidArgumentException;

class Response
{
    public static function view(string $view, array $data = null)
    {
        $path = __DIR__ . '/../app/views/' . $view . '.view.php';
        if (file_exists($path)) {
            include $path;
        } else {
            throw new InvalidArgumentException("View not found");
        }
    }

    public function Json(array $data)
    {
        header('Content-Type: application/json',true,200);
        echo json_encode($data);
        exit;
    }

    public function Redirect($url)
    {
       header("Location: $url");
       exit;
    }

    public function StatusCode(int $code)
    {
        http_response_code($code);
        exit;
    }

}
