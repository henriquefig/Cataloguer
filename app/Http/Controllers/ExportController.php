<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\Catalog_Fields;
use App\Catalog_entries;
use App\Products;
use App\Categories;
use App\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ExportController extends Controller
{
    //
    public function index(Request $request)
    {
        $catalog=Catalog::where('user_id',$request->input('u_id'))->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('categories.cat_field_id','ASC')->get();
        $entries=array();
        foreach ($headers as $h) {
            $entries[$h->name]=Catalog_entries::where('cat_field_id','=',$h->cat_field_id)->orderBy('id','ASC')->limit(15)->get();
        }
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray()[0];
        return view('catalog.exported',['entries' => $entries, 'headers' => $headers,'layout' => $layout,'cat_title' => $catalog->name]);
    }

    public function searchEntryGuest(Request $request)
    {
        $catalog=Catalog::where('user_id',$request->input('u_id'))->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('catalog_fields.id')->get();
  
        $search=DB::select('SELECT DISTINCT c2.* FROM catalog_entries c1 JOIN catalog_entries c2 ON c1.product_id=c2.product_id  JOIN products p ON p.id=c2.product_id WHERE p.catalog_id='.$catalog->id.' AND c1.value LIKE "%'.$request->input('search').'%" ORDER BY c2.id ASC LIMIT '.(15*count($headers)));
        
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray();
        return array('data' => view('catalog.search',['entries' => $search, 'headers' => $headers,'layout' => $layout])->render(),'marker' => end($search)->product_id);
    }
    public function loadMoreDataGuest(Request $request)
    {
       
        $catalog=Catalog::where('user_id',$request->input('u_id'))->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('catalog_fields.id')->get();
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray();
        if($request->input('infinite_scroll')!='')
        {

         $entries=DB::select('SELECT DISTINCT c2.* FROM catalog_entries c1 JOIN catalog_entries c2 ON c1.product_id=c2.product_id WHERE c2.product_id>'.$request->input('last_id').' AND  c1.value LIKE "%'.$request->input('infinite_scroll').'%" ORDER BY c2.id ASC LIMIT '.(15*count($headers)));
            return view('catalog.search',['entries' => $entries, 'headers' => $headers,'layout' => $layout]);
        }
        else
        {
            $entries=array();
            foreach ($headers as $h) {
                $entries[$h->name]=Catalog_entries::where('catalog_entries.cat_field_id','=',$h->cat_field_id)->where('product_id','>',$request->input('last_id'))->orderBy('id','ASC')->limit(15)->get();
                
            }
            return view('catalog.more',['entries' => $entries, 'headers' => $headers,'layout' => $layout]);

        }
        
    }
}
