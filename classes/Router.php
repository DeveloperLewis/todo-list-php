<?php

namespace classes;

    class Router {

        //Handlers holds all the functions that you provide when routing.
        private $handlers = [];
        private $notFound;
        private const get = 'GET';
        private const post = 'POST';
        
        public function get($path, $handler): void {
            $this->createHandler(self::get, $path, $handler);
        }

        public function post($path, $handler): void {
            $this->createHandler(self::post, $path, $handler);
        }

        public function notFound($handler): void {
            $this->notFound = $handler;
        }

        private function createHandler($method, $path, $handler) {
            $this->handlers[$method . $path] = [
                'path' => $path,
                'method' => $method,
                'handler' => $handler
            ];
        }


        public function run() {
            //Get url that the request is coming from
            $requestUri = parse_url($_SERVER['REQUEST_URI']);
            $requestPath = $requestUri['path'];

            //Get the method of the request
            $method = $_SERVER['REQUEST_METHOD'];
            $callback = null;

            //Verify that the url is matching one the above paths and methods and then send them the handler
            foreach ($this->handlers as $handler) {
                if ($handler['path'] === $requestPath && $method === $handler['method']) {
                    $callback = $handler['handler'];
                }
            }

            //If there is no callback then the page is not found, and thus return a page for not found.
            if (!$callback) {
                header("HTTP/1.0 404 Not Found");
                if (!empty($this->notFound)) {
                    $callback = $this->notFound;
                }
            }

            //Turn into req, res objects another time when I learn more.
            call_user_func_array($callback, [
                array_merge($_GET, $_POST)
            ]);
        
        }

    }