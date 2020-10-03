<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerSearchRequest;
use App\Customer;

class CustomerController extends ApiController
{
    public function index(CustomerSearchRequest $req)
    {   
        $input = $req->input();
        $customers = new Customer;
        if (!isset($input['search_str']) || $input['search_str'] == '') {
            return response()->json($customers->orderBy('id', 'desc')->paginate(25));
        }

        //Меняем все пробелы на палки чтобы получился регексп 
        $regexpStr = str_replace(' ', '|', $input['search_str']);

        $customers = 
            $customers->where('name', 'regexp', $regexpStr)
                ->orWhere('surname', 'regexp', $regexpStr)
                ->orWhere('country', 'regexp', $regexpStr)
                ->orWhere('company', 'regexp', $regexpStr)
                ->orWhere('phone', 'regexp', $regexpStr);
        //Телефон можно было бы искать более унифицированно переводя его в int при записи в базу, но поскольку его надо вывести пользователю решил оставить его типом string

        return response()->json($customers->orderBy('id', 'desc')->paginate(25));
    }
}
