<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Auth;
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;


    
    //DataTables\Database\Database;


class SavingsController extends Controller
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
Editor::inst($db,'savings','saving_id')
    ->fields(
        Field::inst( 'savings.saving_date' )->validator( 'Validate::notEmpty' )
            ->validator( 'Validate::dateFormat', array(
                "format"  => Format::DATE_ISO_8601,
                "message" => "Please enter a date in the format yyyy-mm-dd"
            ) )
            ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),    
        Field::inst( 'savings.amount' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'savings.saving_code' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'savings.member_id' )
           ->options( 'members', 'member_id', 'first_name' ),
                   
        Field::inst( 'members.first_name' ),
        Field::inst( 'members.last_name' )
        )
    ->leftJoin( 'members','members.member_id','=', 'savings.member_id' ) 
    ->process( $_GET )
    ->json();


        
      }



      public function membersavings()

      {


       $id=request()->segment(2);

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



         Editor::inst($db,'membersavings','id')
    ->fields(
        Field::inst( 'membersavings.saving_date' )->validator('Validate::notEmpty')
            ->validator( 'Validate::dateFormat', array(
                "format"  => Format::DATE_ISO_8601,
                "message" => "Please enter a date in the format yyyy-mm-dd"
            ) )
            ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),    
        Field::inst( 'membersavings.amount')->validator( 'Validate::notEmpty' ),
        Field::inst( 'membersavings.member_id' )->setValue( $id),  
          Field::inst( 'membersavings.saving_code' )->validator( 'Validate::notEmpty' )    
        )
    ->leftJoin('members','members.member_id','=','membersavings.member_id')
    ->where('members.member_id',$id)
    ->process( $_GET )
    ->json();


      }
}
