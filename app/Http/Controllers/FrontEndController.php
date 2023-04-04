<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Sell;
use App\Models\ShopInfo;
use Hash;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use ZanySoft\LaravelPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
class FrontEndController extends Controller
{

    public function showlogin(){


        return view('auth.login');
    }


    public function index(){


        return view('index');
    }

    public function product(){


        return view('layouts.product');
    }
    //the fuction for the admin
    public function admin(){
        return view('layouts.admin');
    }
    //The function for Bidhaa
    public function bidhaa(){
        if(empty(Auth::user()->branch_id)){
            
            $branch = Branch::all();
            $product = Product::all();
            $categories = Category::all();
            return view('layouts.bidhaa',compact('branch','product','categories'));
        }
        else{
            $branch = Branch::all();
            $categories = Category::all();
            $product = Product::where('branch_id',Auth::user()->branch->id)->get();
            return view('layouts.bidhaa',compact('branch','product','categories'));
        }


    }
    //The function for the Dashboard
    public function dashboard(){

        if(empty(Auth::user()->branch_id)){
            
            $branch = Branch::all();
            $product = Product::all();
            $user = User::all();
            $orders = Order::sum('total_amount');
            $order = number_format($orders,2);
            $capitals= Product::sum('capital');
            $capital = number_format($capitals,2);
            $pprofits= Product::sum('pprofit');

            $dina =number_format($capitals - $orders,2);            
            $pprofit = number_format($pprofits,2);
            return view('layouts.dashboard',compact('user','branch','product','order','capital','pprofit','dina'));
        }
        else{
            $branch = Branch::all();
            $product = Product::where('branch_id',Auth::user()->branch->id)->get();
            $user = User::where('branch_id',Auth::user()->branch->id)->get();
            $order = Order::where('user_id',Auth::user()->id)->sum('total_amount');
            return view('layouts.dashboard',compact('user','branch','product','order'));
        }


    }
    //The function for the empty
    public function empty(){
        return view('layouts.empty');
    }
    //The function for the historia ya mauzo
    public function historiamauzo(){

        $sells = Sell::all();
        return view('layouts.historiamauzo',compact('sells'));
    }

    //The function for the matawi
    public function matawi(Request $request){
        $branch = Branch::all();

        return view('layouts.matawi',compact('branch'));
    }
    //The function for the mauzo
    public function mauzo(){

        if(empty(Auth::user()->branch_id)){
            $branch = Branch::all();
            $product = Product::all();
            return view('layouts.mauzo',compact('product'));
        }
        else{
                $branch = Branch::all();
                $product = Product::where('branch_id',Auth::user()->branch->id)->get();
                return view('layouts.mauzo',compact('product'));
            }
    }

    public function cart(){

        return view ('layouts.cart');
    }

//The function for the mauzomuuzaji
    public function mauzomuuzaji(){
    $group = [];
        $order = Order::groupBy('id')->get();
        $sells = Sell::where('status','IMEUZWA')->get();



    foreach($sells as $sell){
            $group[$sell->order->id] = Sell::with(['product','order'])->where('order_id',$sell->order->id)->get()->groupBy('order_id');

        }
// dd($group);
        // $order = Order::select('id');
        return view('layouts.mauzomuuzaji',compact('sells','order','group'));
    }
    //The function for the reported
    public function printirisiti($id){


        return view('layouts.printirisiti');
    }
    //The function for the sale_report
    public function report(Request $request){

        $users = User::all();
        $fromDate = $request->input('fromDate');

        $toDate   = $request->input('toDate');

        $other    = $request->input('other');
        $query = Sell::where('status','IMEUZWA')->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
        return view('layouts.report',compact('query'));
    }
    //The function for the risiti.html"
    public function risiti(Request $request,$id){
        $date = carbon::now();

        $group = [];
        $order = Order::find($id)->first();
        $sells = Sell::orderBy('order_id')->get();



    foreach($sells as $sell){
            $group[$sell->order->id] = Sell::with(['product','order'])->where('order_id',$id)->get()->groupBy('order_id');

        }
        $s = Sell::with(['product','order'])->where('order_id',$id)->get();
        $o = Order::where('id',$id)->get();
        // dd($sells);
        return view('pdf.risiti',compact('sells','date','group','s','o'));
    }

    //The function for the sale_report
    public function sale_report(){
        return view('layouts.sale_report');
    }
    //The function for the setting
    public function setting(){
        return view('layouts.setting');
    }
    //The function for the Wateja
    public function wateja(){

        return view('layouts.wateja');
    }
    //The function for the wauzaji
    public function wauzaji(){
        $branch = Branch::all();
        $roles = Role::all();
        $user = User::whereNotNull('branch_id')->get();

        return view('layouts.wauzaji',compact('branch','roles','user'));
    }
    //The function for the welcome
    public function welcome(){
        return view('layouts.welcome');
    }
    //The function for the logOut
    public function logOut(){
        return view('layouts.logOut');
    }
    //The function of mauzomuuzaji
    public function mauzomuaji(){
        return view('layouts.mauzomuaji');
    }
    public function jukumu(){
       $permission = Permission::all();
        $role =Role::with('permissions')->get();
        // for($i=0; $i<count($role); $i++){
        //     dd($role[$i]['permissions']);
        // }
        // dd($role[$i]['permissions'][$i]['name']);

        return view('layouts.jukumu',compact('permission','role'));
    }

    public function exportPDF(Request $request){
        $fromDate = $request->input('fromDate');

        $toDate   = $request->input('toDate');

        $other    = $request->input('other');


        if(count($request->all()) > 0){
            $pdf = new PDF();
            $query = Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            $pdf->loadView('layouts.reportPrint',compact('query'));
            return $pdf->stream('mauzo.pdf');

        }
        else{
            $query = Sell::all();
            $pdf = new PDF();

            $pdf->loadView('layouts.reportPrint',compact('query'));
            return $pdf->stream('reportPrint.pdf');

        }


}

// public function report(){

//     $users = User::all();

//     return view('layouts.report',compact('users'));
// }
public function reportPrint(){
    ;
    return view('layouts.reportPrint',compact('users'));
}

public function punguzo(){
    $shop =ShopInfo::all();
    return view ('layouts.punguzo',compact('shop'));
}

public function order(){
    $group = [];
    $order = Order::groupBy('id')->get();
    $sells = Sell::orderBy('order_id')->get();



foreach($sells as $sell){
        $group[$sell->order->id] = Sell::with(['product','order'])->where('order_id',$sell->order->id)->get()->groupBy('order_id');

}
$o = Order::where('status','HAIJAUZWA')->get();
        return view('layouts.order',compact('sells','order','group','o'));

}

public function editorder($id){
    $sell = Sell::where('order_id',$id)->get();
    $shop = ShopInfo::all();
    return view('layouts.editorder',compact('sell','shop'));
}
}
