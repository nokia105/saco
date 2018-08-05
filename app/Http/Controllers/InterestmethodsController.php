<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use Auth;
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

class InterestmethodsController extends Controller
{
    //


     
     function __construct(){

       return $this->middleware('auth:member');
     }


       public function db(){

// DataTables PHP library
$sql_details = array(
    "type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlite" or "Sqlserver"
    "user" => "root",       // Database user name
    "pass" => "",       // Database password
    "host" => "localhost",       // Database host
    "port" => "",       // Database connection port (can be left empty for default)
    "db"   => "saccoss"     // Database name
    //"dsn"  => "charset=utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);
return $db = new \DataTables\Database( $sql_details );
  }



       public function index(){
  


// Build our Editor instance and process the data coming from _POST
Editor::inst($this->db(),'interestmethods','id')
    ->fields(
     Field::inst( 'method' )->validator( 'Validate::notEmpty')
            
 )
    ->process( $_GET )
    ->json();



}

}
