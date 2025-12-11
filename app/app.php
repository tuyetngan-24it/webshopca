<?php
class App
{ // nhóm thuộc tính của lớp App
    private $controller;  // controller
    private $action;      // action
    private $paramteters; // param
    private $router;      //routing
    // hàm khởi tạo 
    function __construct()
    {
        global $routes;
        $this->router = new Route();
        $this->controller = $routes['defaultController'];
        $this->action = "index";
        $this->handleUrl();
    }
    // hàm lấy đường dẫn. 
    public function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }
    // hàm xử lý đường dẫn
    public function handleUrl()
    {
        $url = $this->getUrl();
        $url = $this->router->handleRoutes($url);
        $urlArray = array_filter(explode('/', $url)); // cắt chuỗi ra thành mảng
        $urlArray  = array_values($urlArray);  // thiết lập lại thứ tự mảng
        // kiểm tra url so khớp với file tồn tại
        $urlCheck = '';
        if (!empty($urlArray)) {
            foreach ($urlArray as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/'); // cắt dấu / ở bên phải
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                //Foldder/routes/controller/method
                //foldder/Routes/controller/method
                $fileCheck = implode('/', $fileArr);
                // kiểm tra mảng tồn tại
                if (!empty($urlArray[$key - 1])) {
                    unset($urlArray[$key - 1]);
                }
                if (file_exists('./app/controllers/' . ($fileCheck) . '.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            // reset key của mảng url
            $urlArray = array_values($urlArray);
        }
        // xử lý controller
        if (!empty($urlArray[0])) {
            $this->controller = ucfirst($urlArray[0]);
        } else {
            $this->controller = ucfirst($this->controller);
        }
        // xử lý url
        if (empty($urlCheck)) {
            $urlCheck = $this->controller;
        }
        if (file_exists('./app/controllers/' . ($urlCheck) . '.php')) {
            require_once  './app/controllers/' . ($urlCheck) . '.php';
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller();
            }
        } else {
            $this->loadError(404);
            return 0; 
        }
        // 
        unset($urlArray[0]);

        // xử lý action
        if (!empty($urlArray[1])) {
            $this->action = $urlArray[1];
            unset($urlArray[1]);
        }
        $this->paramteters = array_values($urlArray);
        // kiểm tra method action 
        if (method_exists($this->controller, $this->action)) {
            call_user_func_array([$this->controller, $this->action], $this->paramteters);
        } else {
            $this->loadError(404);
        }
    }

    public function loadError($errorCode = 404)
    {
        require_once('./app/errors/' . ($errorCode) . '.php');
    }
}
