<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Child;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon; 

class FamilyController extends Controller
{
    //function for display parent form
    public function view_parent_form(){
        return view('parentform');
    }

    // function for display child form
    public function view_child_form(){
        $father_names = Parents::pluck('father_name','id');
        return view('childform',["fathers"=>$father_names]);
    }

    // function for store parent details in database
    public function createparent(Request $request){
        $parent = new Parents();
        $parent->father_name = $request->father_name;
        $parent->mother_name = $request->mother_name;
        $parent->mobile_number = $request->mobile_number;

        $request->validate([
            'father_name' => 'required | string',
            'mother_name' => 'required | string',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
        $parent->save();
        return view('parentdisplaydata');
    }

    // function for store child details in database
    public function createchild(Request $request){
        $child = new Child();
        $child->name = $request->name;
        $child->father_name = $request->father_name;
        $child->mother_name = $request->mother_name;
        $child->date_of_birth = $request->date_of_birth;

        $request->validate([
            'name' => 'required | string',
            'father_name' => 'required | string',
            'mother_name' => 'required | string',
            'date_of_birth' => 'required | date_format:Y-m-d',
        ]);
        $child->save();
        return back()->with("child_created","child add successfully");
    }

    // start function for yajra datatable for parentsrecord display dashboard
    public function parents_display_data()
    {
        return view('parentdisplaydata');
    }
    public function getdata_for_parent_display(Request $request){
        if ($request->ajax()) {
            $data = Parents::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="'.route("update.parent").'" data-url="'.route("edit.parent",[$data->id]).'" data-id="'.$data->id.'" class="editbtn btn btn-success btn-sm" data-toggle="modal" data-target="#editparentmodal">Edit</a> 
                    <a href="'.route("delete.parent",[$data->id]).'" class=" btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
            })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('parentdisplaydata');
    }
    // end function for yajra datatable for parentsrecord display dashboard

    // start function for yajra datatable for childrecord display dashboard
    public function childs_display_data()
    {
        // return view('childdisplaydata');
        $father_names = Parents::pluck('father_name','id');
        return view('childdisplaydata',["fathers"=>$father_names]);
    }
    public function getdata_for_child_display(Request $request){
        if ($request->ajax()) {
            $data = Child::with('parents')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('father_name', function($data) {
                    return  $data->parents->father_name;
                })
                ->addColumn('mother_name', function($data) {
                    return  $data->parents->mother_name;
                })
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="'.route("update.child").'" data-url="'.route("edit.child",[$data->id]).'" data-id="'.$data->id.'" class="editbtn btn btn-success btn-sm" data-toggle="modal" data-target="#editchildmodal">Edit</a> 
                    <a href="'.route("delete.child",[$data->id]).'" class=" btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('age', function($data){
                    $actionBtn = $data->date_of_birth;
                    $age = Carbon::parse($data->date_of_birth)->diff(Carbon::now())->y;
                    return $age;
                })
                ->rawColumns(['action'])
                ->make(true);
                
        }
        return view('childdisplaydata');
    }
    // end function for yajra datatable for childrecord display dashboard

    // start function for parent edit  using ajax
    public function edit_parent($id)
    {
        $parent = Parents::find($id);
        if($parent)
        {
            return response()->json([
                'status'=>200,
                'parents'=> $parent,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No parent Found.'
            ]);
        }
    
    }
    // end function for parent edit using ajax

    // start function for update parent record
    public function update_parent(Request $request ){
        $record = $request->parent_id;
        $where= array(
            "id"=>$record,
        );
        $data = array(    
                'father_name' =>$request->father_name,
                'mother_name' =>$request->mother_name,
                'mobile_number' =>$request->mobile_number
            );
        $result = Parents::where($where)->update($data);   
        return response()->json(['success'=>'parents record updated successfully']);
    }
    // start function for update parent record

    // start function for delete parent
    public function deleteparent($id){
        $id = $id;
        $result = Parents::where('id',$id)->delete();
        if($result){
            // return redirect()->route('manageuser')->with('user_login','Data Deleted Successfully');
        }   
    }
    // end function for delete parent 

    // start function for child edit  using ajax
    public function edit_child($id)
    {
        // $data = Child::with('parents')->get();
        // $child = Child::find($id);  
        $child = Child::with('parents')->find($id);
        if($child )
        {
            return response()->json([
                'status'=>200,
                'childs'=> $child ,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No child Found.'
            ]);
        }
        
    }
    // end function for child edit using ajax

    // start function for update child record
    public function update_child(Request $request ){
        $record = $request->child_id;
        $where= array(
            "id"=>$record,
        );
        $data = array(    
            'name' => $request->name,
            'father_name' =>$request->father_name,
            'mother_name' =>$request->mother_name,
            'date_of_birth' =>$request->date_of_birth
        );
        $result = Child::where($where)->update($data);   
        return response()->json(['success'=>'child record updated successfully']);
    }
    // end function for update child record

    // start function for delete childs
    public function deletechild($id){
        $id = $id;
        $result = Child::where('id',$id)->delete();
        if($result){
            // return redirect()->route('manageuser')->with('user_login','Data Deleted Successfully');
        }   
    }
    // end function for delete childs

    // start function for get mother name
    public function get_mother_name($id)
    {
        // echo $_GET['id'];die;
        $data = Parents::where('id', $id)->first();
        return response()->json($data);
    }
    // end function for get mother name

    // start function for add child record
    public function add_child(Request $request ){
        $request->validate([
            'name' => 'required | string',
            'date_of_birth' => 'required | date_format:Y-m-d',
        ]);

        $child = new Child();
        $child->name = $request->name;
        $child->parent_id = $request->parent_id;
        $child->date_of_birth = $request->date_of_birth;

        $child->save();
        return response()->json([
            'status'=>200,
            'message'=> "Success",
        ]);
    }
    // end function for add child record

    // start function for add parent record
    public function add_parent(Request $request ){
        $request->validate([
            'father_name' => 'required | string',
            'mother_name' => 'required | string',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    
        $parent = new Parents();
        $parent->father_name = $request->father_name;
        $parent->mother_name = $request->mother_name;
        $parent->mobile_number = $request->mobile_number;
    
        $parent->save();
        return response()->json([
            'status'=>200,
            'message'=> "Success",
        ]);
    }
    // end function for parent child record

    // start function for manage family tree
    public function family_list(Request $request)
    {
        return view('childparentlist');
    }
    public function getdata_for_family_display(Request $request){
        if ($request->ajax()) {
            $data = Parents::all();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<a href="" data-url="'.route("parentchild.list",[$data->id]).'" data-id="'.$data->id.'" class="childdetail btn btn-success btn-sm" data-toggle="modal" data-target="#childdetailmodal">Child Deatils</a>';
                        return $actionBtn;
                })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('childparentlist');
    }
    // end function for manage family tree

    // start function for child edit  using ajax
    public function display_child_list($id)
    {
        $parent = Parents::with('child')->where("id",$id)->first();
        
        if($parent)
        {
            return response()->json([
                'status'=>200,
                'parents'=> $parent,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No parent Found.'
            ]);
        }
    
    }
    // end function for child edit using ajax

}
