<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class BaseApiController extends Controller
{
    private $_code = 200;
    private $_statusCode = null;
    private $_message = null;
    private $_data = null;
    private $_error = null;


    const STATUS_SUCCESS = true;
    const STATUS_FAILED = false;

    /**
     * Function return protected _statuscode 
     * @param $statuscode Type int
     * @return $this
     */

    public function setCode(int $code)
    {
        if (!empty($code) && $code >= 499) {
            $code = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $this->_code = $code;
        return $this;
    }

    public function setStatusCode($statusCode)
    {
        $this->_statuscode = $statusCode;
        return $this;
    }

    /**
     * Function Hanlde message response Client
     * @param $message Type string
     * @return $this
     */

    public function setMessage(string $message = null)
    {
        $this->_message = $message;
        return $this;
    }

    public function setData($data = null)
    {
        $this->_data = $data;
        return $this;
    }

    public function setError($error = null)
    {
        $this->_error = $error;
        return $this;
    }

    public function reponse()
    {
        $datas = [
            "success"       => $this->_statusCode,
            "status_code"   => $this->_code,
            "message"       => $this->_message,
            "data"          => $this->_data,
            "error"         => $this->_error
        ];

        return Response::json($datas, $this->_code);
    }


    public function sendDataSuccess($data = null, $message = null)
    {
       
        return $this->setCode(SymfonyResponse::HTTP_OK)
            ->setStatusCode(self::STATUS_SUCCESS)
            ->setMessage($message)
            ->setData($data)
            ->setError()
            ->reponse();
    }


    public function sendDataError($message, $code)
    {
        return $this->setCode($code)
            ->setStatusCode(self::STATUS_FAILED)
            ->reponse();
    }
}
