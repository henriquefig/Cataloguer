<?php

namespace App\Http\Controllers;

use Input;
use App\Catalog;
use App\Catalog_Fields;
use App\Catalog_entries;
use App\Products;
use App\Categories;
use App\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AjaxController extends Controller
{
    function csvToArray($filename = '', $delimiter = ',',$noheader=false)
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if($noheader==true)
                {
                    $data[] =$row;
                }
                else
                {

                    if (!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new_catalog()
    {
        return view('catalog.create');
    }
    public function catalog_fields(Request $request)
    {
        return view('catalog.fields',['amount' => $request->input('amount')]);
    }
    public function create_catalog(Request $request)
    {
        $catalog = new Catalog();
        $catalog->name = $request->input('title');
        $catalog->user_id = Auth::id();
        $catalog->active = true;
        $catalog->save();
        foreach($request->input('fields') as $field)
        {
            if(is_numeric($field))
            {
                if($field>0)
                {
                    for($i=0;$i<$field;$i++)
                    {
                        $fields = new Catalog_Fields();
                        $fields->catalog_id = $catalog->id;
                        $fields->name = 'image'.($i+1);
                        $fields->active=true;
                        $fields->save();
                        $cat = new Categories();
                        $cat->cat_field_id = $fields->id;
                        $cat->type = 'image';
                        $cat->styles='';
                        $cat->save();
                    }
                }
            }
            else
            {
                $fields = new Catalog_Fields();
                $fields->catalog_id = $catalog->id;
                $fields->name = $field;
                $fields->active = true;
                $fields->save();
                $cat = new Categories();
                $cat->cat_field_id = $fields->id;
                $cat->styles='';
                $cat->save();
            }
        }
        return redirect()->action('AjaxController@map_catalog');
        //return view('catalog.fields',['amount' => Request::input('amount')]);
    }
    public function list_catalog()
    {
        if(empty(Catalog::where('user_id',Auth::id())->get()->toArray()))
            return view('catalog.create');
        $mycatalog = Catalog::where('user_id',Auth::id())->get()[0];
        $fields_headers = Catalog_Fields::where('catalog_id',$mycatalog->id)->get();
        if(count($fields_headers)==0)
            return redirect()->action('AjaxController@new_catalog');
        $entries=array();
        $rows=0;
        foreach($fields_headers as $field)
        {
            $entry = Catalog_entries::where('cat_field_id',$field->id)->get();
            $entries[$field->name]=$entry;
            if($rows==0)
                $rows=count($entry);
        }
        return view('catalog.show',['headers' => $fields_headers, 'title' => $mycatalog->name, 'entries' => $entries, 'rows' => $rows]);
    }
    public function new_entry()
    {
        $mycatalog = Catalog::where('user_id',Auth::id())->get()[0];
        $fields_headers = Catalog_Fields::where('catalog_id',$mycatalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('catalog_fields.id','ASC')->get(['catalog_fields.*']);
        return view('catalog.entry',['headers' => $fields_headers, 'title' => $mycatalog->name]);
    }
    public function add_entry(Request $request)
    {
        if(count($request->input('entries'))>0)
        {
            $p=new Products();
            $p->catalog_id=Auth::id();
            $p->save();
            foreach($request->input('entries') as $entry)
            {
                if(!empty($entry))
                {

                    $new = new Catalog_entries();
                    $new->cat_field_id = $entry['cat_field'];
                    $new->product_id=$p->id;
                    $new->value = $entry['val']!=NULL?$entry['val']:'';
                    $new->active = true;
                    $new->save();
                }

            }
        }
        return redirect()->action('AjaxController@list_catalog');
    }
    public function importCsv($path,$title,$delimiter,$extra=false)
    {
        $file = public_path($path);
        if($extra==true)
            $customerArr = $this->csvToArray($path,$delimiter,true);
        else
            $customerArr = $this->csvToArray($path,$delimiter);
        if($extra==false)
        {
            $catalog = new Catalog();
            $catalog->name = $title;
            $catalog->user_id = Auth::id();
            $catalog->active = true;
            $catalog->save();
        }
        else
        {
             $catalog=Catalog::where('id',Auth::id())->get()[0]; 
             $fields=Catalog_Fields::where('catalog_id',$catalog->id)->get();
        }
        $ids_obj=(object)[];
        $ids_obj->fields_id=(object)[];
        for ($i = 0; $i < count($customerArr); $i ++)
        {
            $product = new Products();
            $product->catalog_id = $catalog->id;
            $product->save();
            $ids_obj->product_id = $product->id;
            $j=0;
            foreach ($customerArr[$i] as $key => $value) {
                if($i == 0 && $extra==false)
                {
                    $fields = new Catalog_Fields();
                    $fields->catalog_id = $catalog->id;
                    $fields->name = $key;
                    $fields->active = true;
                    $fields->save();
                    $ids_obj->fields_id->$key=$fields->id;
                    $categ = new Categories();
                    $categ->cat_field_id = $fields->id;
                    $categ->styles = '';
                    $categ->type = 'text';
                    $categ->visibility = true;
                    $categ->sort = true;
                    $categ->save();
                }
                if($extra==true)
                    $ids_obj->fields_id->$key=$fields[$j]->id;
                $new = new Catalog_entries();
                $new->cat_field_id = $ids_obj->fields_id->$key;
                $new->product_id = $ids_obj->product_id;
                $new->value = $value;
                $new->active = true;
                $new->save();
                $j++;
            }
        }

        return 'Jobi done or what ever';    
    }
    public function upload(Request $request)
    {   
        $uploadedFile=request()->file('upload_catalog');
        $path=$uploadedFile->path();
        $filename = time().$uploadedFile->getClientOriginalName();

        $target_dir = './'.Auth::id();
        if(!file_exists($target_dir)) {
            if(!mkdir($target_dir, 0775, true))
            die('error creating the folder');
        }
        $target_file = $target_dir . '/'.$request->input('fileId').'_catalog.csv';
        //Save the file in the server
        if(move_uploaded_file($uploadedFile, $target_file)) {
            if($request->input('cat_title')!=NULL)
                $this->importCsv($target_file,$request->input('cat_title'),$request->input('delimiter'));
            else
                $this->importCsv($target_file,'',$request->input('delimiter'),true);

            return '{}';
        }
    }
    public function map_catalog(){
        $catalog_id=Catalog::where('user_id',Auth::id())->get()[0];
        $fields_headers = Catalog_Fields::where('catalog_id',$catalog_id->id)->orderBy('id','ASC')->get();
        $cat=Categories::where('cat_field_id','>=',$fields_headers[0]->id)->where('cat_field_id','<=',$fields_headers[count($fields_headers)-1]->id)->orderBy('cat_field_id','ASC')->get();
        return view('catalog.mapping',['titles' => $fields_headers, 'cat' => $cat]);
    }
    public function save_map(Request $request)
    {
        foreach($request->input('categories') as $cat_obj)
        {
            $cat_obj['vis']=($cat_obj['vis']=="true")?1:0;
            $cat_obj['sort']=($cat_obj['sort']=="true")?1:0;
            if(empty(Categories::where('cat_field_id',strtolower(explode("_",$cat_obj['id'])[2]))->get()->toArray()))
            {
                $cat=new Categories;
                $cat->cat_field_id=strtolower(explode("_",$cat_obj['id'])[2]);
                $cat->type=$cat_obj['val'];
                $cat->styles="";
                $cat->visibility=$cat_obj['vis'];
                $cat->sort=$cat_obj['sort'];
                $cat->save();
            }
            else
            {
                Categories::where('cat_field_id',strtolower(explode("_",$cat_obj['id'])[2]))->update(['type' => $cat_obj['val'],'visibility' => $cat_obj['vis'],'sort' => $cat_obj['sort']]);
            }
        }
        return redirect()->action('AjaxController@list_catalog');

    }
    public function layout()
    {

        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('catalog_fields.id','ASC')->get();
        $entry=Catalog_entries::where('cat_field_id','>=',$headers[0]->cat_field_id)->where('cat_field_id','<=',$headers[count($headers)-1]->cat_field_id)->orderBy('id','ASC')->limit(count($headers))->get();
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray();
        if(count($layout)==0)
        return view('catalog.layout',['headers' => $headers, 'examp' => $entry]);
        else
        return view('catalog.layout_filled',['headers' => $headers, 'examp' => $entry, 'layout' => $layout]);

    }

    public function save_styles(Request $request)
    {
        foreach ($request->input('styles') as $key => $value)
        {
            if($value['id']=='prod_card')
            {
                $catalog=Catalog::where('user_id',Auth::id())->get()[0];
                if(empty(Layout::where('catalog_id',$catalog->id)->get()->toArray()))
                {
                    $layout=new Layout;
                    $layout->catalog_id=$catalog->id;
                    $layout->comp_name='';
                    $layout->banner_color='';
                    $layout->card_layout=$value['style'];
                    $layout->save();
                }
                else
                {
                    Layout::where('catalog_id',$catalog->id)->update(['card_layout' => $value['style']]);
                }
            } 
            else
            Categories::where('cat_field_id',$value['id'])->update(['styles' => $value['style']]);
        }
        return redirect()->action('AjaxController@page_layout');
    }

    public function publish()
    {


        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('categories.cat_field_id','ASC')->get();
        $entries=array();
        foreach ($headers as $h) {
            $entries[$h->name]=Catalog_entries::where('cat_field_id','=',$h->cat_field_id)->orderBy('id','ASC')->limit(15)->get();
        }
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray();
        return view('catalog.published',['entries' => $entries, 'headers' => $headers,'layout' => $layout,'cat_title' => $catalog->name]);
    }
    public function loadMoreData(Request $request)
    {
       
        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
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
    public function searchEntry(Request $request)
    {

        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
        $headers = Catalog_Fields::where('catalog_id',$catalog->id)->join('categories', 'catalog_fields.id', '=', 'categories.cat_field_id')->orderBy('catalog_fields.id')->get();
  
        $search=DB::select('SELECT DISTINCT c2.* FROM catalog_entries c1 JOIN catalog_entries c2 ON c1.product_id=c2.product_id  JOIN products p ON p.id=c2.product_id WHERE p.catalog_id='. $catalog->id.' AND c1.value LIKE "%'.$request->input('search').'%" ORDER BY c2.id ASC LIMIT '.(15*count($headers)));
        
        $layout=Layout::where('catalog_id',$catalog->id)->get()->toArray();
        return array('data' => view('catalog.search',['entries' => $search, 'headers' => $headers,'layout' => $layout])->render(),'marker' => end($search)->product_id);
    }
    public function page_layout(Request $request)
    {
        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
        $layout=Layout::where('catalog_id',$catalog->id)->get();

        return view('catalog.page_layout',['page_settings' => $layout[0]]);
    }
    public function save_p_layout(Request $request)
    {

        $catalog=Catalog::where('user_id',Auth::id())->get()[0];
        $layout=Layout::where('catalog_id',$catalog->id)->update(["comp_name" => $request->input('comp_name'),"banner_color" => $request->input('banner')]);
    }
    public function upload_comp()
    {
        $fi=request()->file('comp_logo');
        $path=$fi->path();
        $filename = time().$fi->getClientOriginalName();

        $target_dir = './'.Auth::id();
        if(!file_exists($target_dir)) {
            if(!mkdir($target_dir, 0775, true))
            die('error creating the folder');
        }
        $target_file = $target_dir . '/mylogo.png';
        //Save the file in the server
        if(move_uploaded_file($fi, $target_file)) {
                return '{}';
        }
    }
    public function save_entry(Request $request)
    {

       $entry_group=Catalog_entries::where('product_id',$request->input('hidden_id'))->join('catalog_fields', 'catalog_entries.cat_field_id','=','catalog_fields.id')->select('catalog_entries.*','catalog_fields.name')->get();
       foreach ($entry_group as $i => $entry) {
           if($request->input($entry->name)!=NULL)
           {
                Catalog_entries::where('id',$entry->id)->update(["value" => $request->input($entry->name)]);
           }
       }
       return "done";
   }
   public function delete_entry(Request $request)
   {
        Catalog_entries::where('product_id', $request->input('id'))->delete();
        Products::where('id', $request->input('id'))->delete();
       return "done";
   }
}