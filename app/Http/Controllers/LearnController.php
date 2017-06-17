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
        $this->query_builder();
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

    /**
     * query_builder
     */
    public function query_builder()
    {
        //Retrieving All Rows From A Table
        /*$articles = DB::table('articles')->where('art_id', '>', 20);
        //dd($articles);
        $articles = $articles->get();
        dd($articles);*/

        //Retrieving A Single Row / Column From A Table.This method will return a single StdClass object
        /*$article = DB::table('articles')->where('art_id', '>', 20)->first();
        dd($article);*/
        //This method will return the value of the column directly
        /*$column = DB::table('articles')->where('art_id', '>', 20)->value('art_content');
        dd($column);*/

        //Retrieving A List Of Column Values
        /*$columns = DB::table('articles')->where('art_id', '>', 20)->pluck('art_title');
        //dd($columns);
        foreach ($columns as $column) {
            echo $column,'<br>';
        }*/

        //This will return 'art_id => art_title'
        /*$columns = DB::table('articles')->where('art_id', '>', 20)->pluck('art_title', 'art_id');
        //dd($columns);
        foreach ($columns as $key => $column) {
            echo $key.'=>'.$column,'<br>';
        }*/

        //Chunking Results
        /*echo '<pre>';
        DB::table('categories')->orderBy('cate_id', 'asc')->chunk(2, function($categories){
            foreach ($categories as $category) {
                if($category->cate_id > 20) return false;
            }
            echo $categories.'<br>';
        });*/

        //Aggregates
        /*$sum = DB::table('categories')->sum('art_cnt');
        echo $sum.'<br>';
        $max = DB::table('categories')->max('art_cnt');
        echo $max.'<br>';
        $avg = DB::table('categories')->avg('art_cnt');
        echo $avg.'<br>';*/

        //Selects
        //Specifying A Select Clause
        /*$categories = DB::table('categories')->select('cate_id', 'cate_name as name')->get();
        dd($categories);*/
        //The distinct method allows you to force the query to return distinct results:
        /*$art_cnts = DB::table('categories')->select('art_cnt')->distinct()->get();
        dd($art_cnts);*/
        //If you already have a query builder instance and you wish to add a column to its existing select clause, you may use the addSelect method:
        /*$query = DB::table('categories')->select('cate_id');
        $categories = $query->addSelect('art_cnt')->get();
        dd($categories);*/

        //Raw Expressions
        //Sometimes you may need to use a raw expression in a query. These expressions will be injected into the query as strings, so be careful not to create any SQL injection points! To create a raw expression, you may use the DB::raw method:
        /*$categories = DB::table('categories')->select(DB::raw('count(*) as cnt, art_cnt'))
            ->where('art_cnt', '>', 0)
            ->groupBy('art_cnt')
            ->get();
        dd($categories);*/

        //Joins
        //Inner Join Clause
        /*$categories = DB::table('categories')
            ->join('articles', 'categories.cate_id', '=', 'articles.cate_id')
            ->select('categories.*', 'articles.art_title')
            ->get();
        dd($categories);*/

        //Left Join Clause
        /*$categories = DB::table('categories')
            ->leftJoin('articles', 'categories.cate_id', '=', 'articles.cate_id')
            ->select('categories.*', 'articles.art_title')
            ->get();
        dd($categories);*/

        //Right Join Clause
        /*$categories = DB::table('categories')
            ->rightJoin('articles', 'categories.cate_id', '=', 'articles.cate_id')
            ->select('categories.*', 'articles.art_title')
            ->get();
        dd($categories);*/

        //Cross Join Clause
        /*$categories = DB::table('categories')
            ->crossJoin('articles')
            ->select('categories.*', 'articles.art_title')
            ->get();
        dd($categories);*/

        //Advanced Join Clauses
        /*DB::connection()->enableQueryLog();
        $categories = DB::table('categories')
            ->join('articles', function($join){
                $join->on('categories.cate_id', '=', 'articles.cate_id')->where('categories.cate_id', '>', '10');
//                $join->on('categories.cate_id', '=', 'articles.cate_id') orOn(...);
            })
            ->get();
        //dd($categories);
        dd(DB::getQueryLog());*/

        //Unions
        /*$first = DB::table('articles')->where('art_id', '<', 18);
        $articles = DB::table('articles')->where('art_id', '>', 20)
            ->union($first)
            ->get();
        dd($articles);*/

        //Where Clauses
        /*$articles = DB::table('articles')->where([
            ['art_id', '>', 20],
            ['cate_id', '>', 10],
        ])->get();
        dd($articles);*/
        //Or Statements
        /*$articles = DB::table('articles')
            ->where('art_id', '>', 20)
            ->orWhere('cate_id', '<', 10)
            ->get();
        dd($articles);*/
        //whereBetween
        /*$articles = DB::table('articles')
            ->whereBetween('art_id', [10, 20])
            ->get();
        dd($articles);*/
        //whereNotBetween
        //whereIn / whereNotIn
        /*$articles = DB::table('articles')
            ->whereIn('art_id', [17, 18, 19])
            ->get();
        dd($articles);*/
        //whereNull / whereNotNull
        //whereDate / whereMonth / whereDay / whereYear
        /*$articles = DB::table('articles')
            ->whereDate('created_at', '2017-06-07')
            ->get();
        dd($articles);*/
        /*$articles = DB::table('articles')
            ->whereDay('created_at', '7')
            ->get();
        dd($articles);*/
        //whereColumn
        /*$articles = DB::table('articles')
            ->whereColumn('art_id', '=', 'cate_id')
            ->get();
        dd($articles);*/
        /*$articles = DB::table('articles')
            ->whereColumn([
                ['art_id', '=', 'cate_id'],
                ['...'],
            ])
            ->get();*/

        //Parameter Grouping
        //select * from users where name = 'John' or (votes > 100 and title <> 'Admin')
        /*DB::table('users')
            ->where('name', '=', 'John')
            ->orWhere(function ($query) {
                $query->where('votes', '>', 100)
                    ->where('title', '<>', 'Admin');
            })
            ->get();*/

        //Where Exists Clauses
        /*select * from users
        where exists (
            select 1 from orders where orders.user_id = users.id
        )*/
        /*DB::table('users')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereRaw('orders.user_id = users.id');
            })
            ->get();*/
        //JSON Where Clauses
        /*$users = DB::table('users')
            ->where('options->language', 'en')
            ->get();

        $users = DB::table('users')
            ->where('preferences->dining->meal', 'salad')
            ->get();*/

        //orderBy
        /*$articles = DB::table('articles')
            ->orderBy('created_at', 'desc')
            ->get();
        dd($articles);*/
        //latest/oldest
        /*$article = DB::table('articles')
            ->latest()
            ->first();
            //->get();
        dd($article);*/
        /*$articles = DB::table('articles')
            ->inRandomOrder()
            ->first();
        dd($articles);*/

        //groupBy/having/havingRaw
        /*$articles = DB::table('articles')
            ->selectRaw('cate_id, count(*)')
            ->groupBy('cate_id')
            ->havingRaw('count(*) > 1')
            //->having('cate_id', '>', 5)
            ->get();
        dd($articles);*/

        //skip/take
        /*$articles = DB::table('articles')
            ->orderBy('created_at', 'desc')
            ->skip(5)
            ->take(5)
            ->get();
        dd($articles);*/
        /*$articles = DB::table('articles')
            ->orderBy('created_at', 'desc')
            ->offset(5)
            ->limit(5)
            //->take(5)
            ->get();
        dd($articles);*/

        //Conditional Clauses
        /*$orderBy = 'art_title';
        $articles = DB::table('articles')
            ->when($orderBy, function($query) use ($orderBy){
                return $query->orderBy($orderBy);
            },function($query){
                return $query->orderBy('art_id');
            })
            ->get();
        dd($articles);*/

        //Inserts
        /*$affects = DB::table('categories')
            ->insert([
                ['cate_name' => 'Test67', 'art_cnt' => 0],
                ['cate_name' => 'Test68', 'art_cnt' => 0],
            ]);
        dd($affects);//true/false*/
        //Auto-Incrementing IDs
        /**
         * When using PostgreSQL the insertGetId method expects the auto-incrementing column to be named id.
         * If you would like to retrieve the ID from a different "sequence",
         * you may pass the sequence name as the second parameter to the insertGetId method.
         */
        /*$id = DB::table('categories')
            ->insertGetId(
                ['cate_name' => 'Test69', 'art_cnt' => 0]
            );
        dd($id);*/
        /*DB::table('categories')
            ->where('cate_id', 39)
            ->update(['cate_name' => 'Test70']);*/

        //Increment & Decrement
        /*DB::table('categories')
            ->where('cate_id', 39)
            ->increment('art_cnt', 5);*/
        /*DB::table('categories')
            ->where('cate_id', 39)
            ->decrement('art_cnt', 5);
        $cate = DB::table('categories')
            ->where('cate_id', 39)
            ->get();
        dd($cate);*/

        //delete
        /*$affects = DB::table('categories')
            ->where('cate_name', 'like', 'test%')
            ->delete();
        dd($affects);*/

        //If you wish to truncate the entire table,
        // which will remove all rows and reset the auto-incrementing ID to zero,
        // you may use the truncate method:
        /*DB::table('users')->truncate();*/


    }

}
