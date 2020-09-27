<?php

namespace Nolin\Laratools\Controllers;

use Nolin\Laratools\Facades\Laratools;
use Illuminate\Http\Request;

class ExtendsController extends Controller
{
    protected $validation;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validation = Laratools::validation('Test')
            ->setNamespace('nolin\laratools\Validations');
    }

    public function create()
    {
        $this->validateRequest();
    }
}
