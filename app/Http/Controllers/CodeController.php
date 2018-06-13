<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

class CodeController extends Controller
{
    //


      public function index(){

       //$id=request()->segment(2);

      

    $sql_details = array(
    "type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlite" or "Sqlserver"
    "user" => "root",       // Database user name
    "pass" => "",       // Database password
    "host" => "localhost",       // Database host
    "port" => "",       // Database connection port (can be left empty for default)
    "db"   => "saccoss"     // Database name
    //"dsn"  => "charset=utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);

$db = new \DataTables\Database( $sql_details );

$mm=Editor::inst($db,'codes','id')
    ->fields(
        Field::inst('code_number')->validator( 'Validate::notEmpty' ),
        Field::inst('name')->validator( 'Validate::notEmpty' )
    )   
    ->process( $_GET )
    ->json();

    }
}
