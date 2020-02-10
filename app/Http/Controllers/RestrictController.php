<?php

namespace App\Http\Controllers;

use App\Helpers\Identifier;
use App\Restrict;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\DB;

class RestrictController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
        $this->identify = new Identifier($request);
    }

    public function store()
    {
        $restriction = new Restrict;
        $restriction->addRestriction($this->request);
    }

    public function checkRestrictions()
    {
        $id_user = $this->identify->idUserGetter();

        $data = [
            'id_user' => $id_user,
        ];

        $restriction = DB::select( DB::raw("Select applications.name
        FROM restricts
        join usages on restricts.id_app = usages.id_app AND restricts.`id_user`=usages.id_user
        join applications on restricts.id_app = applications.id
        WHERE time < restricts.max_time"));
        
        /*
        DB::table('restricts')
        ->JOIN('usages','restricts.id_app','=','usages.id_app')
        ->JOIN('usages','restricts.id_user','=','usages.id_user')
        ->JOIN('applications','restricts.id_app','=','applications.id')
        ->SELECT('applications.name')
        ->WHERE('time','>','restricts.max_time')
        ->GET();
        */

        return $restriction;
    }
}
