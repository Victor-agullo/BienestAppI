<?php

namespace App;

use App\Helpers\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Restrict extends Model
{
    protected $table = 'restricts';
    
    public function addRestriction(Request $request)
    {
        $restriction = new Restrict;
        $identify = new Identifier($request);
        $appName = $request->appName;
        $restriction->id_user = $identify->idUserGetter();
        $restriction->id_app = $identify->idAppGetter($appName);

        $restriction->max_time = Date('H:i:s', $request->max_time);
        $restriction->start_at = Date('H:i:s', $request->start_at);
        $restriction->finish_at = Date('H:i:s', $request->finish_at);
        $restriction->save();
    }
}
