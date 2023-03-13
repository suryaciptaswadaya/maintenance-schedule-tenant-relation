<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class MasterController extends Controller
{
    public $data;
    public $messages;
    public $error;
    public $code;

    public function __construct()
    {
        $this->data = null;
        $this->messages = [];
        $this->error = false;
        $this->code = 200;
    }

    public function callFunction($func, $view = null)
    {
        if ($func) {
            DB::beginTransaction();
            try {
                $func($this);
                if (!count($this->messages)) {
                    array_push($this->messages, "Success");
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                report($e);
                $this->error = true;
                $this->code = 500;
                if ($e instanceof ValidationException) {
                    $errors = $e->validator->errors()->getMessages();
                    foreach ($errors as $error) {
                        array_push($this->messages, $error[0]);
                    }
                    $this->code = $e->status;
                } elseif ($e instanceof QueryException) {
                    array_push($this->messages, $e->errorInfo[2]);
                } elseif ($e instanceof ModelNotFoundException) {
                    array_push($this->messages, $e->getMessage());
                    $this->code = 404;
                } elseif ($e instanceof customex) {
                    array_push($this->messages, $e->getMessage());
                    $this->code = $e->getCode();
                } else {
                    array_push($this->messages, $e->getMessage());
                }
            }
        }

        if ($view) {
            return view($view, [
                "data" => $this->data,
                "messages" => $this->messages,
                "error" => $this->error,
                "code" => $this->code
            ]);
        } else {
            return response([
                "data" => $this->data,
                "messages" => $this->messages,
                "error" => $this->error,
            ], $this->code);
        }
    }
}
