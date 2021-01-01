<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DB;
use Illuminate\Support\Facades\Schema;

class CommonController extends Controller
{
    public function select2Find(Request $request)
    {
        $page = $request->page;

        $resultCount = 15;

        $offset = ($page - 1) * $resultCount;

        $whereArr=[];
        if($request->status){
            $whereArr['status']=$request->status;
        }

        if($request->keyname){
            $whereArr['keyname']=$request->keyname;
        }

        if($request->is_admin == 0 && $request->nonehospid == null){
            $whereArr['hospid']=session('login_data.hospital.id');
        }
        
        if ($request->country_field_name) {
            $whereArr[$request->country_field_name] = $request->country;
        }
        if (Schema::hasColumn($request->model, 'deleted_at')){
            $whereArr['deleted_at']=NULL;
        }

        $q = DB::table($request->model);

        if($request->multicolumns){
            $select_colums=$request->multicolumns;
        }else{
            $select_colums[0]=$request->field_id_name.' as id';
            $select_colums[1]=$request->field_name.' as text';
        }

        foreach($select_colums as $col){
           $q->selectRaw($col);
        }
        
        $q->where($whereArr)->where($request->field_name,'LIKE','%'.$request->term.'%');

        if($request->isvaccine) {
            $q->where($request->field_id_name,'!=',$request->isvaccine);
        }
        $data = $q->skip($offset)->take($resultCount)->get();

        $q1 = DB::table($request->model)->select($request->field_id_name.' as id',$request->field_name.' as text')->where($whereArr)->where($request->field_name,'LIKE','%'.$request->term.'%');
        if($request->isvaccine) {
            $q1->where($request->field_id_name,'!=',$request->isvaccine);
        }
        $count = $q1->count();

        $endCount = $offset + $resultCount;

        $morePages = $count > $endCount;

        $results = array(
          "results" => $data,
          "pagination" => array(
            "more" => $morePages
          )
        );
        return response()->json($results);
    }
}
