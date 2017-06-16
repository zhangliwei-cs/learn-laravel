<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnController extends Controller
{
    public function index()
    {
        $this->learn_query();
    }

    /**
     * running raw sql queries
     */
    public function learn_query(){
        //running a select query
        //The select method will always return an array of results. Each result within the array will be a PHP StdClass object.
        /*$articles = DB::select('select * from levy_articles where art_id > ? or art_id < ?', [20, 15]);
        dd($articles);*/

        //Using Named Bindings
        /*$articles = DB::select('select * from levy_articles where art_id > :id1 or art_id < :id2', ['id1'=>20, 'id2'=>15]);
        dd($articles);*/


        //Running An Insert Statement 捕获异常
        /*try{
            $res = DB::insert('insert into levy_categories(cate_name) values(?)', ['TEST5']);
            var_dump($res);
        }
        catch (QueryException $ex){
            dd($ex);
        }*/

        //Database Transactions
        /*try{
            DB::transaction(function(){
                DB::table('friendlinks')->insert(['link_name' => 'test', 'link_url' => 'test']);
                DB::table('categories')->insert(['cate_name' => 'TEST5']);
            });
        }
        catch (QueryException $ex){
            dd($ex);
        }*/
        //beginTransaction,rollback,commit
        /*DB::beginTransaction();
        DB::table('friendlinks')->insert(['link_name' => 'test', 'link_url' => 'test']);
        try{
            DB::table('categories')->insert(['cate_name' => 'TEST5']);
        }
        catch (QueryException $ex){
            DB::rollback();
        }
        DB::commit();*/


    }
}
