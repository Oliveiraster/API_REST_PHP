<?php 
    class DbController{
        public function __call($name, $arguments){
            $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
        }
        protected function getStringParams(): array {
            $query = [];
            print_r($_SERVER['QUERY_STRING']);
            if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) {
                parse_str($_SERVER['QUERY_STRING'], $query);
            }
            return $query;
        }
        protected function sendOutput($data, $httpHeaders=array()){
            header_remove('Set-Cookie');
            if (is_array($httpHeaders) && count($httpHeaders)){
                foreach($httpHeaders as $httpHeader){
                    header($httpHeader);
                }

                echo $data;
                exit;
            }
        }
    }

?>