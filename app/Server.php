<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['server_id', 'game_id', 'ip'];

    public function verifyAuth($place_id, $ip_adr){

        $server = Server::where('server_id', $place_id)->where('ip', $ip_adr)->first();

        if($server){

            $server->updated_at = now();
            $server->save();

            return true;
        }else{
            return false;
        }

    }

}
