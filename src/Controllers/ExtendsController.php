<?php

namespace nolin\laratools\Controllers;

use nolin\laratools\Facades\Support;
use Illuminate\Http\Request;

class ExtendsController extends Controller
{
    protected $validation;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validation = Support::validation('Test')
            ->setNamespace('nolin\laratools\Validations');
    }

    public function create()
    {
        $this->validateRequest();
    }
}
