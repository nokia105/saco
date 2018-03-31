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
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;
	use Auth;
	//DataTables\Database\Database;


class MembersController extends Controller
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
$mm=Editor::inst($db,'members','member_id')
	->fields(
		Field::inst('member_id')->set(false),
		Field::inst( 'first_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'middle_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'last_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'status' )->setValue('1'),
		Field::inst( 'user_id' )->setValue($user_id),
		Field::inst( 'phone' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'password' )->setValue('password'),
		Field::inst( 'email' )->validator( 'Validate::notEmpty' ),
	    Field::inst( 'bank_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'account_number' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'nextkin_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'nextkin_relationship' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'joining_date' )->validator( 'Validate::notEmpty' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
	)
	->process( $_GET )
	->json();


      	
      }
}
