<?php 
    class UserController extends DbController{
        public function listAction(){
            $erroDescription = '';
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $stringParamsArray = $this->getStringParams();
            
            if (strtoupper($requestMethod) == 'GET'){
                try {
                    $userModel = new UserModel();

                    $intLimit = 10;
                    if (isset($stringParamsArray['limit']) && $stringParamsArray['limit']){
                        $intLimit = $stringParamsArray['limit'];
                    }

                    $usersArray = $userModel->getUsers($intLimit);
                    $responseData = json_encode($usersArray);

                } catch (Error $e){
                    $erroDescription = $e->getMessage().'Something went wrong! Please contact support!';
                    $erroHeader = 'HTTP/1.1 500 Internal server Error';
                }
            } else {
                $erroDescription= 'Method not supported';
                $erroHeader = 'HTTP/1.1 422 Unprocessable Entity';
            }

            if (!$erroDescription){
                $this->sendOutput($responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                $this->sendOutput(json_encode(array('error' => $erroDescription)),
                array('Content-Type: application/json', $erroHeader)
                );
            }
        }
    }
?>

