<?php

use App\Game;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/checkGameAuth', function() {

    $result = false;

    $_POST = json_decode(file_get_contents('php://input'), true);

    $id = $_POST['gameID'];
    $password = $_POST['password'];

    $game = Game::Where('place_id', $id)->get();

    if( $game ){
        $game = Game::where('password', $password)->get();
        if( $game ){
            //return response("Game authorized.")->header('Content-Type', 'text-plain');
            $contents = "Game authorized.";
        }else{
            //return response("Invalid password.")->header('Content-Type', 'text-plain');
            $contents = "Invalid password.";
        }
    }else{
        //return respone("No game found.")->header('Content-Type', 'text-plain');
        $contents = "Game not whitelisted.";
    }

    $response = Response::make($contents, 200);
    $response->header('Content-Type', 'text-plain');
    return $response;

    if($result){
        return true;
    }else{
        return false;
    }

});
