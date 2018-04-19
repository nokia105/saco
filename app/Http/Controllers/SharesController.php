<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
/*
include(app_path()."\datatable\Editor\php\Editor\Editor.php" );
include(app_path()."\datatable\Editor\php\Editor\Field.php" );
include(app_path()."\datatable\Editor\php\Editor\Format.php" );
include(app_path()."\datatable\Editor\php\Editor\Join.php" );
include(app_path()."\datatable\Editor\php\Editor\Mjoin.php" );
include(app_path()."\datatable\Editor\php\Editor\Upload.php" );
include(app_path()."\datatable\Editor\php\Editor\Validate.php" );*/


// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
    use Auth;
    //DataTables\Database\Database;


class SharesController extends Controller
{
    //


      public function index(){

     $user_id=Auth::user()->id;

    
     
        



// Build our Editor instance and process the data coming from _POST

/*
 * Example PHP implementation used for the index.html example
 */

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
$db = new \DataTables\Database( $sql_details );

// Build our Editor instance and process the data coming from _POST
$nn=Editor::inst($db,'shares','share_id')
    ->fields(
        Field::inst( 'share_value' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'min_shares' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'max_shares' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'status' )->setValue('Active'),
        Field::inst( 'user_id' )->setValue($user_id)
        )  
    ->process( $_GET )
    ->json();

      }



      public function membershare(){
    
           $id=request()->segment(2);

            $share_id=Share::select('share_id')->first();

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

// Build our Editor instance and process the data coming from _POST
$nn=Editor::inst($db,'member_share','id')
    ->fields(
        Field::inst( 'No_shares' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'share_date' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'member_id' )->setValue($id),
        Field::inst( 'share_id' )->setValue($share_id)
        
        )  
    ->process( $_GET )
    ->json();

       

      }
}
