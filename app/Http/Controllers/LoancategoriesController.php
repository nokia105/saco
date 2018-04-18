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
     

 

class LoancategoriesController extends Controller
{
     public function __construct()
    {   
    }

 public function index(){
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

$mm=Editor::inst($db,'Loancategories','id')
    ->fields(
        Field::inst( 'category_name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'interest_rate' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'default_duration' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'status' )->setValue('1'),
        Field::inst( 'category_code' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'repayment_penalty' )->setValue('password'),
        Field::inst( 'grace_period' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'min_amount' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'max_amount' )->validator( 'Validate::notEmpty' ),
     
        Field::inst( 'created_at' )->validator( 'Validate::notEmpty' )
    
            ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
    )
    ->process( $_GET )
    ->json();
    }


    public function fee_category(){
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

$mm=Editor::inst($db,'feescategories','id')
    ->fields(
        Field::inst( 'fee_name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'fee_code' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'fee_value' )->validator( 'Validate::notEmpty' )
       
    )
    ->process( $_GET )
    ->json();
    }




}
