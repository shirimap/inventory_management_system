<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Matumizi;
use App\Models\Sbidhaa;
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
            $data= Sbidhaa::all();            
            $branch = Branch::all();
            $product = Product::all();
            $categories = Category::all();
            return view('layouts.bidhaa',compact('branch','product','categories','data'));
        }
        else{
            $data= Sbidhaa::all();  
            $branch = Branch::all();
            $categories = Category::all();
            $product = Product::where('branch_id',Auth::user()->branch->id)->get();
            return view('layouts.bidhaa',compact('branch','product','categories','data'));
        }


    }
    //The function for the Dashboard
    public function dashboard(){
        if(empty(Auth::user()->branch_id)){
            $branch = Branch::all();
            $product = Product::all();  
            $user = User::all();
            $data= Sell::with('product')->select('product_id',DB::raw('sum(quantity) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
            
            $sells = Sell::sum('amount');
            $sell = number_format($sells);
            $capitals= Product::sum('capital');
            $capital = number_format($capitals);
            $pprofits= Product::sum('pprofit');
            $dina =number_format($capitals - $sells);            
            $pprofit = number_format($pprofits);
            $currentDate= date('Y-m-d');
            $todaysales= number_format(Sell::whereDate('created_at',$currentDate)->sum('amount'));
        
            $sales = Sell::selectRaw('YEAR(created_at) as year,MONTH(created_at) AS month,SUM(amount) AS total')
                ->groupBy('year','month')
                ->get();
        
           // $data = $sales->pluck('total');
            // $labels =$sales->pluck('month');
                $data=[];
                $labels=[];
                 foreach($sales as $sale){
                    $data[]=$sale->total;
                    $labels[]=Carbon::createFromDate($sale->year,$sale->month)->format('M Y');
                 }
          
        
            return view('layouts.dashboard',['labels' => $labels,'amounts' => $data],
            compact('user','branch','product','sell','capital','pprofit','dina','data','todaysales'));
        }
        else{
            $branch = Branch::all();
            $product = Product::all();  
            $user = User::all();
            $data= Sell::with('product')->select('product_id',DB::raw('sum(quantity) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
            
            $sells = Sell::sum('amount');
            $sell = number_format($sells);
            $capitals= Product::sum('capital');
            $capital = number_format($capitals);
            $pprofits= Product::sum('pprofit');
            $dina =number_format($capitals - $sells);            
            $pprofit = number_format($pprofits);
            $currentDate= date('Y-m-d');
            $todaysales= number_format(Sell::whereDate('created_at',$currentDate)->sum('amount'));
        
            $sales = Sell::selectRaw('YEAR(created_at) as year,MONTH(created_at) AS month,SUM(amount) AS total')
                ->groupBy('year','month')
                ->get();
        
           // $data = $sales->pluck('total');
            // $labels =$sales->pluck('month');
                $data=[];
                $labels=[];
                 foreach($sales as $sale){
                    $data[]=$sale->total;
                    $labels[]=Carbon::createFromDate($sale->year,$sale->month)->format('M Y');
                 }
          
        
            return view('layouts.dashboard',['labels' => $labels,'amounts' => $data],
            compact('user','branch','product','sell','capital','pprofit','dina','data','todaysales'));
        }


    }
    //The function for the empty
    public function empty(){
        return view('layouts.empty');
    }
    //The function for the empty
    public function profile(){
        return view('layouts.profile');
    }

    //The function for the sajili bidhaa
    public function sbidhaa(){
        $data= Sbidhaa::all();
        return view('layouts.sajilbidhaa',compact('data'));
    }


    //The function for the historia ya mauzo
    public function historiamauzo(){

        $sells = Sell::all();
        return view('layouts.historiamauzo',compact('sells'));
    }
// function for matumizi
    public function matumizi()
    {
        return view('layouts.matumizi');
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
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(amount) as amount'))->groupBy('product_id','created_at')->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            $pius =Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');
            $pdf->loadView('layouts.reportPrint',compact('query','pius'));
            return $pdf->stream('mauzo.pdf');

        }
        else{
            $pdf = new PDF();
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(amount) as amount'))->groupBy('product_id','created_at')->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            $pius =Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');
            $pdf->loadView('layouts.reportPrint',compact('query','pius'));
            return $pdf->stream('reportPrint.pdf');

        }
}

// public function report(){

//     $users = User::all();

//     return view('layouts.report',compact('users'));
// }
public function reportPrint(Request $request){
    $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');
        $other    = $request->input('other');
        $role = Role::all();
        if(count($request->all()) > 0){
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(amount) as amount'))->groupBy('product_id','created_at')->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            $pius =Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');
            return view('layouts.reportPrint',compact('query','role','pius'));
        }
        else{
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(amount) as amount'))->groupBy('product_id')->get();
            $pius =Sell::sum('amount');
            return view('layouts.reportPrint',compact('query','role','pius'));
        }
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
