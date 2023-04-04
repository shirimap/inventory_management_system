<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Sell;
use App\Models\ShopInfo;
use Hash;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use MultipleIterator;
use ArrayIterator;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;



class BackendController extends Controller
{
    public function createBranch(Request $request){

       $data = Branch::where('name', '=' ,$request->branchname)->where('location', '=' ,$request->location)->first();
       $date = Carbon::now();

       if ($data != null){
        return back()->with('error','Jina La Tawi Tayari Lipo! Chagua Lingine');
       }

        $validate = Validator::make($request->all(),[
            'branchname'=>'required',
            'location'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',

        ]);

         if ($validate->fails()){
            $messages = $validate->messages();
            return back()->with('errors','Kuna Kosa wakati wa uwekaji Taarifa');
         }



        $branch = Branch::create([
            'name'=> $request->branchname,
            'location'=>$request->location,
            'email'=>$request->email,
            'address'=>$request->address,
            'phoneNumber'=>$request->phone,
            'created_at'=> $date,
        ]);

        return back()->with('message','Taarifa zimeingia kikamilifu');
    }

    public function deleteBranch($id){

        $product = Branch::where('id',$id)->delete();

        if ($product){
            return back()->with('message','Tawi limefutwa kikamilifu');

        }

        return back()->with('error','Kuna Kosa wakati wa ufutaji wa tawi');


    }

    public function editBranch(Request $request,$id){

        $date = Carbon::now();

        $validate = Validator::make($request->all(),[
          'name'=>'required',

          'location'=>'required',
      ]);

      if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error',$messages);
     }



      $branch = Branch::where('id',$id)->update(
          [
          'name'=> $request->name,

          'location'=>$request->location,
            'email'=>$request->email,
            'address'=>$request->address,
            'phoneNumber'=>$request->phone,
          'updated_at'=>$date
      ]
  );
  return back()->with('message','Taarifa zimebadilika kikamilifu');
  }

  public function createUser(Request $request)

    {
        $date = Carbon::now();
        $data = User::where('email', '=' ,$request->email)->first();
        if ($data != null){
            return back()->with('error','Mfanyakazi Tayari yupo Tafadhali Ongeza Mwingine');
           }
        $validate = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' =>'required|digits_between:2,10',
            'address' => 'required',
            'gender'=>'required',
            'branch'=>'required',
            'roles' => 'required'
        ]);



        if ($validate->fails()){
            $messages = $validate->messages();
            return back()->with('error','Kuna Kosa wakati wa uwekaji Taarifa');
         }


        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->branch_id = $request->branch;
        $user->password = Hash::make("12345");
        $user->created_at =$date;
        $user->status=1;
        $user->save();
        $user->assignRole($request->input('roles'));

        return back()->with('message','Mfanyakazi amewekwa kikamilifu');
    }


    public function editUser(Request $request, $id)
    {
        // $data = User::where('email', '=' ,$request->email)->first();
        // if ($data != null){
        //     return back()->with('error','Mfanyakazi Tayari yupo Tafadhali Ongeza Mwingine');
        //    }
        $date = Carbon::now();
        $validate = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' =>'required|digits_between:2,10',
            'address' => 'required',
            'gender'=>'required',
            'branch'=>'required',
            'roles' => 'required'

        ]);



        if ($validate->fails()){
            $messages = $validate->messages();
            return back()->with('error','kuna tatizo kwenye uwekaji taarifa');
         }


        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->branch_id = $request->branch;
        $user->updated_at=$date;
        $user->password = Hash::make("12345");
        $user->status=1;
        $user->save();
        $user->removeRole($user->roles->first()->name);
        $user->assignRole($request->input('roles'));

        return back()->with('message','Mfanyakazi amewekwa kikamilifu');
    }
    public function deleteUser($id){

        $product = User::where('id',$id)->delete();

        if ($product){
            return back()->with('message','Mfanyakazi limefutwa kikamilifu');

        }

        return back()->with('error','Kuna Kosa wakati wa ufutaji wa mfanyakazi');


    }
    public function login(Request $request){
        $date = Carbon::now()->toDateTimeString();

        $validate = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:users,email',
            'password' =>'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
           $user = Auth::user();
           $user->last_login=$date;
           $user->save();


        //    dd($user->last_login);


            return redirect('/dashboard')->with('message','login successful');
        }

        return back()->with('error','Mtumiaje ayupo Tafadhali Hakiki taarifa zako');



    }
    public function logout(Request $request){

        Auth::logout();
        return redirect('/');
    }
    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');


        $toDate   = $request->input('toDate');

        $other    = $request->input('other');

        $query = Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();


        $role = Role::all();
        return view('report.report',compact('query','role'));
    }


public function report(Request $request)
    {


        $fromDate = $request->input('fromDate');


        $toDate   = $request->input('toDate');

        $other    = $request->input('other');




        $role = Role::all();
        if(count($request->all()) > 0){
            $query = Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            return view('layouts.report',compact('query','role'));
        }
        else{
            $query = Sell::all();
            return view('layouts.report',compact('query','role'));
        }



    }

    public function delete($id)
    {
        Order::where('id',$id)->delete();
        return redirect()->back()->with('message','Umefanikiwa Kufuta!');
   }

   public function update(Request $request,$id)
    {
        $update = [
                'name'           =>  $request->name,
                'sex'            =>  $request->sex,
                'date_of_birth'  =>  $request->dateOfBirth,
                'email'          =>  $request->email,
                'phone'          =>  $request->phone,
                'job_position'   =>  $request->jobPosition,
                'salary'         =>  $request->salary

            ];
        Sell::find($id)->update($update);
        return redirect()->back()->with('success','Has been update successfully!');
    }

    
// ===============product functions===================
public function createProduct(Request $request){
    $date = Carbon::now();
    $net_amount = $request->amount - (($request->discount / 100)*$request->amount);
     $validate = Validator::make($request->all(),[
         'name'=>'required',
         'type'=>'required',
         'quantity'=>'required',
         'bprice'=>'required',
         'amount'=>'required',
         'branch'=>'required',
         'category'=>'required',
         'discount'=>'required',
     ]);
     
      if ($validate->fails()){
         $messages = $validate->messages();
         return back()->with('error','Kuna Kosa wakati wa uwekaji Taarifa');
      }

     $product = new Product;
     $product->name =  $request->name;
     $product->type = $request->type;
     $product->quantity = $request->quantity;
     $product->bprice = $request->bprice;
     $product->amount = $request->amount;
     $product->capital = $request->amount * $request->quantity;
     $product->pprofit = $request->amount - $request->bprice;
     $product->sub_quantity = $request->sub_quantity;
     $product->sub_amount = $request->sub_amount;
     $product->net_amount = $net_amount;
     $product->total_quantity = $request->sub_quantity * $request->quantity;
     $product->branch_id = $request->branch;
     $product->category_id = $request->category;
     $product->discount=$request->discount;
     $product->created_at = $date;
     $product->save();
     return back()->with('message','Taarifa zimeingia kikamilifu');
 }


 public function upload(Request $request){
//   $path = storage_path() . '/app/' . request()->file->store('tmp');

//   dd($path);

  Excel::import(new ProductImport, $request->file('file'));
  return back()->with('message','Taarifa zimebadilika kikamilifu');

 }

 public function deleteProduct($id){

    $product = Product::where('id',$id)->delete();

    if ($product){
        return back()->with('message','Bidhaa limefutwa kikamilifu');

    }

    return back()->with('error','Kuna Kosa wakati wa ufutaji wa Bidhaa');
}

public function editProduct(Request $request, $id){
    $date = Carbon::now();
    $net_amount = $request->amount - (($request->discount / 100)*$request->amount);
    $validate = Validator::make($request->all(),[
        'name'=>'required',
        'type'=>'required',
        'quantity'=>'required',
        'bprice'=>'required',
        'amount'=>'required',
        'branch'=>'required',

    ]);

     if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error',$messages);
     }

    $product = Product::find($id);
    $product->quantity = $request->quantity;
    $product->bprice = $request->bprice;
    $product->capital = $request->amount * $request->quantity;
    $product->pprofit = $request->amount - $request->bprice;
    $product->sub_quantity = $request->sub_quantity;
    $product->sub_amount = $request->sub_amount;
    $product->amount = $request->amount;
    $product->net_amount = $net_amount;
    $product->branch_id = $request->branch;
    $product->discount=$request->discount;
    $product->created_at = $date;
    $product->save();


    return back()->with('message','Taarifa zimeingia kikamilifu');
}

public function addToCart(Request $request ,$id) // by this function we add product of choose in card
{
    $product = Product::find($id);

    if(!$product) {

        abort(404);

    }



    // if cart is empty then this the first product
    if($product->quantity-$request->quantity < 0){
        return back()->with('error','bidhaa hazitoshi, Tafadhali Ongeza Bidhaa');
    }
    $cart = session()->get('cart');
    if(!$cart) {

        $cart = [
        $id => [
        'id'=>$product->id,
        'name'=>$product->name,
        'type'=>$product->type,
        'net_amount'=>$product->net_amount,
        'quantity'=>$request->quantity,
        'discount'=>$product->discount,
        'branch_id'=>$product->branch->id,
        'category_id'=>$product->category->id,
        'sub_quantity'=>$request->sub_quantity,
        'sub_amount'=>$product->sub_amount,
                ]
        ];

        session()->put('cart', $cart);


        return redirect()->back()->with('message', 'Bidhaa imewekwa kwenye Mkikoteni kikamilifu!');
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$id])) {

        // this code put product of choose in cart

        return redirect()->back()->with('error', 'Bidhaa ishawekwa tayari!');

    }
    if(isset($cart[$id]['branch_id'])) {

        // this code put product of choose in cart

        return redirect()->back()->with('error', 'Matawi hayakosawa Tafadhali chagua bidhaa kwenye tawi Moja');

    }

    // if item not exist in cart then add to cart with quantity = 1
    $cart[$id] = [
        'id'=>$product->id,
        'name'=>$product->name,
        'type'=>$product->type,
        'net_amount'=>$product->net_amount,
        'quantity'=>$request->quantity,
        'discount'=>$request->discount,
        'branch_id'=>$product->branch->id,
        'category_id'=>$product->category->id,
        'sub_quantity'=>$product->sub_quantity,
        'sub_amount'=>$request->sub_amount,
    ];

    session()->put('cart', $cart); // this code put product of choose in cart

    return redirect()->back()->with('message', 'Bidhaa imewekwa kikamilifu');
}

public function updateCart(Request $request)
 {
    $product = Product::find($request->id);
     if($request->id and ($request->quantity or $request->sub_quantity))
     {
         $cart = session()->get('cart');
         if($product->quantity-$request->quantity < 0 or $product->total_quantity-$request->sub_quantity < 0){
            return back()->with('error','bidhaa hazitoshi, Tafadhali Ongeza Bidhaa');
        }
         $cart[$request->id]["quantity"] = $request->quantity;

         $cart[$request->id]["sub_quantity"] = $request->sub_quantity;
         session()->put('cart', $cart);

         session()->flash('message', 'Cart updated successfully');
         return redirect()->back()->with('message', 'Mkokoteni Umehaririwa kikamilifu!');
     }
     return redirect()->back()->with('message', 'Mkokoteni Umehaririwa kikamilifu!');
 }

 public function deleteCart(Request $request)
 {

     if($request->id) {

         $cart = session()->get('cart');

         if(isset($cart[$request->id])) {

             unset($cart[$request->id]);

             session()->put('cart', $cart);
         }

         session()->flash('message', 'Bidhaa imetolewa kikamilifu');
         return redirect()->back()->with('message', 'Bidhaa imetolewa kikamilifu');
     }
 }


 ////////////////////////////////////////////////////////pius
 public function checkout(Request $request){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         return back()->with('error','Kuna Kosa wakati wa uwekaji Taarifa');
      }

    $na = ($request->total_amount - $request->discount);
    $nA =  $na*(($request->vat)/100);
    $nA = $nA+$na;
     $order = new Order;
     $order->user_id = Auth::user()->id;
     $order->customer_name = $request->customer_name;
     $order->address = $request->address;
     $order->TIN = $request->TIN;
     $order->VRN = $request->VRN;
     $order->phonenumber = $request->phonenumber;
     $order->discount = $request->discount;
     $order->total_quantity = $request->total_quantity;
     $order->status = "IMEUZWA";
     $order->vat = $request->vat;
     $order->org_amount = $na;
     $order->total_amount = $nA;
     $order->created_at = $date;
     $order->save();
     $mi = new MultipleIterator();
     $mi->attachIterator(new ArrayIterator($request->product));

     $mi->attachIterator(new ArrayIterator($request->quantity));
     $mi->attachIterator(new ArrayIterator($request->sub_quantity));
     $mi->attachIterator(new ArrayIterator($request->amount));

     foreach($mi as list($p,$q,$s,$a)){
        $product = Product::find($p);
        if($product->category_id == 2){
            $total = $product->total_quantity-(($product->sub_quantity * $q)+($s));

            $qunt = $total/$product->sub_quantity;
            //$pius =$product->capital-$total;////////pius
            $product->total_quantity = $total;
            $product->quantity=$qunt;
            //$product->capital=$pius;
            $product->save();
        }else{
            $product->quantity=$product->quantity - $q;
           // $product->capital=$product->capital-$p;
            $product->save();
        }
     }

     foreach($mi as list($p,$q,$s,$a)){
        $product = Product::find($p);
        $sells = new Sell;
        $sells->customer_name = $request->customer_name;
        $sells->address = $request->address;
        $sells->TIN = $request->TIN;
        $sells->VRN = $request->VRN;
        $sells->phonenumber = $request->phonenumber;
        $sells->order_id = $order->id;
        $sells->status = "IMEUZWA";
        $sells -> product_id = $p;
        if($product->category_id == 2){

        $sells -> quantity = $q*$product->sub_quantity + $s;

        $sells -> amount = $product->sub_amount;
        $sells->save();
        }
        else{
            $sells -> quantity = $q;
            $sells -> amount = $a;
            $sells->save();
        }

}
    //  $product->quantity = $product->quantity - $a;
    //  $product->save();
     $request->session()->forget('cart');
     return back()->with('message','Taarifa zimeingia kikamilifu');

 }






public function viewPDF($id){
    $date = Carbon::now();
    $s = Sell::with(['product','order'])->where('order_id',$id)->get();
    $o = Order::where('id',$id)->get();
    $order = Order::find($id)->get();
    $pdf = Pdf::setOption(['isRemoteEnabled'=>true, 'isHtml5ParseEnabled'=>true]);
    // $pdf::loadView('pdf.risiti',compact('date','s','o'));
    $pdf->loadView('pdf.risiti',compact('date','s','o','order'));
    return $pdf->stream('mauzo.pdf');
}

public function previewPDF($id){
    $date = Carbon::now();
    $s = Sell::with(['product','order'])->where('order_id',$id)->get();
    $o = Order::where('id',$id)->get();
    $order = Order::find($id)->get();
    $pdf = Pdf::setOption(['isRemoteEnabled'=>true, 'isHtml5ParseEnabled'=>true]);
    // $pdf::loadView('pdf.risiti',compact('date','s','o'));
    $pdf->loadView('pdf.prerisiti',compact('date','s','o','order'));
    return $pdf->stream('order.pdf');
}


public function addRole(Request $request){
    $role = Role::create(['name' => $request->name]);

        $permissions = $request->permission;

        $role->syncPermissions($permissions);

        if ($role){
            return back()->with('message','Taarifa zimeingia kikamilifu');
        }
        return back()->with('error','Taarifa zimeingia kikamilifu');
}

public function deleteRole(Request $request,$id){
    $role = Role::find($id);

       $role->delete();
        if ($role){
            return back()->with('message','Jukumu limefutwa kikamilifu');
        }
        return back()->with('error','kunakitu hakiko sawa wakati wa ufutaji');
}

public function editRole(Request $request,$id){
    $role = Role::find($id);

    $role->update(['name' => $request->name]);

    $permissions = $request->permission;

    $role->syncPermissions($permissions);

    if ($role){
        return back()->with('message','Taarifa zimeingia kikamilifu');
    }
    return back()->with('error','Taarifa zimeingia kikamilifu');
}

public function changepassword(Request $request){

if(!(Hash::check($request->old, Auth::user()->password))){
        return back()->with('error','Neno lako la siri la zamani si sahihi');
}
if($request->old == $request->new){
    return back()->with('error','Neno lako la siri la zamani haliwezi kuwa sawa na jipya');
}
$validate = Validator::make($request->all(),[

    'old'=>'required',
    'new'=> 'required|string|min:8',
]);
if ($validate->fails()){
    $messages = $validate->messages();
    return back()->with('error',$messages);
 }
$user = Auth::user();
$user->password = bcrypt($request->new);
$user->save();
if($user){
    Auth::logout();
    return redirect('/')->with('message','umefanikiwa Kubadilisha neno la siri, Ingia Tena');
}

}

public function changeinfo(Request $request){

    $date = Carbon::now();
    $validate = Validator::make($request->all(),
    [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' =>'required|digits_between:2,10',
        'address' => 'required',
        'gender'=>'required',


    ]);



    if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error','kuna tatizo kwenye uwekaji taarifa');
     }


    $user = Auth::user();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->gender = $request->gender;
    $user->save();
    return back()->with('message','Taafifa zimebadilishwa kikamilifu');

}

public function makeorder(Request $request){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         return back()->with('error','Kuna Kosa wakati wa uwekaji Taarifa');
      }
$na = ($request->total_amount - $request->discount);
$nA =  $na*(($request->vat)/100);
$nA = $nA+$na;
 $order = new Order;
 $order->user_id = Auth::user()->id;
 $order->customer_name = $request->customer_name;
 $order->address = $request->address;
 $order->TIN = $request->TIN;
 $order->VRN = $request->VRN;
 $order->phonenumber = $request->phonenumber;
 $order->discount = $request->discount;
 $order->total_quantity = $request->total_quantity;
 $order->status = "HAIJAUZWA";
 $order->vat = $request->vat;
 $order->org_amount = $na;
 $order->total_amount = $nA;
 $order->created_at = $date;
 $order->save();
 $mi = new MultipleIterator();
 $mi->attachIterator(new ArrayIterator($request->product));

 $mi->attachIterator(new ArrayIterator($request->quantity));
 $mi->attachIterator(new ArrayIterator($request->sub_quantity));
 $mi->attachIterator(new ArrayIterator($request->amount));


 foreach($mi as list($p,$q,$s,$a)){
    $product = Product::find($p);
    $sells = new Sell;
    $sells->customer_name = $request->customer_name;
    $sells->address = $request->address;
    $sells->TIN = $request->TIN;
    $sells->VRN = $request->VRN;
    $sells->phonenumber = $request->phonenumber;
    $sells->order_id = $order->id;
    $sells->status = "HAIJAUZWA";
    $sells -> product_id = $p;
    if($product->category_id == 2){

    $sells -> quantity = $q*$product->sub_quantity + $s;

    $sells -> amount = $product->sub_amount;
    $sells->save();
    }
    else{
        $sells -> quantity = $q;
        $sells -> amount = $a;
        $sells->save();
    }

}
    //  $product->quantity = $product->quantity - $a;
    //  $product->save();
     $request->session()->forget('cart');
     return back()->with('message','Taarifa zimeingia kikamilifu');

 }


 public function updateorder(Request $request,$id){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         return back()->with('error','Kuna Kosa wakati wa uwekaji Taarifa');
      }
$na = ($request->total_amount - $request->discount);
$nA =  $na*(($request->vat)/100);
$nA = $nA+$na;
     $order = Order::find($id);
     $order->user_id = Auth::user()->id;
     $order->customer_name = $request->customer_name;
     $order->address = $request->address;
     $order->TIN = $request->TIN;
     $order->VRN = $request->VRN;
     $order->phonenumber = $request->phonenumber;
     $order->status = "HAIJAUZWA";
     $order->discount = $request->discount;
     $order->vat = $request->vat;
     $order->org_amount = $na;
     $order->total_amount = $nA;
     $order->created_at = $date;
     $order->total_quantity = $request->total_quantity;
     $order->save();
     $mi = new MultipleIterator();
     $mi->attachIterator(new ArrayIterator($request->product));

     $mi->attachIterator(new ArrayIterator($request->quantity));
     $mi->attachIterator(new ArrayIterator($request->amount));
     foreach($mi as list($p,$q,$a)){
        $sells = new Sell;
        $sells->customer_name = $request->customer_name;
        $sells->address = $request->address;
        $sells->TIN = $request->TIN;
        $sells->VRN = $request->VRN;
        $sells->phonenumber = $request->phonenumber;
        $sells->order_id = $order->id;
        $sells -> product_id = $p;
        $sells -> quantity = $q;
        $sells -> amount = $a;
        $sells->save();


}
    //  $product->quantity = $product->quantity - $a;
    //  $product->save();
     $request->session()->forget('cart');
     return back()->with('message','Taarifa zimeingia kikamilifu');

 }

 public function removeProduct(Request $request,$id){
    $role = Sell::where('product_id',$id);

    $order = Order::find($request->id);
    $order->total_quantity = ($order->total_quantity - $request->total_quantity);
    $order->save();
    if($order->total_quantity <=0){
        $order->delete();
        $role->delete();
    }
    $role->delete();


        if ($role){
            return back()->with('message','umefanikiwa');
        }
        return back()->with('error','kunakitu hakiko sawa wakati wa ufutaji');
}

public function editOrders(Request $request,$id){

    $sells= Sell::find($id);


    if ($sells){
    $sells->quantity = $request->quantity;
    $sells->save();
        return back()->with('message','umefanikiwa');
    }
    return back()->with('error','kunakitu hakiko sawa wakati wa ufutaji');

}

public function updateShop(Request $request,$id){
    $date = Carbon::now();

    $shop = ShopInfo::where('id',$id)->update(
        [
        'name'=> $request->name,

        'location'=>$request->location,
          'email'=>$request->email,
          'address'=>$request->address,
          'phoneNumber'=>$request->phone,
          'mobile1'=>$request->mobile1,
          'mobile2'=>$request->mobile2,
          'mobile3'=>$request->mobile3,
          'AccountNumber1'=>$request->AccountNumber1,
          'AccountNumber2'=>$request->AccountNumber2,
          'AccountNumber3'=>$request->AccountNumber3,
          'slogan'=>$request->slogan,
          'MainBranch'=>$request->MainBranch,
          'TIN'=>$request->TIN,
          'website'=>$request->website,
           'updated_at'=>$date
        ]);
        return back()->with('message','Taarifa zimebadilika kikamilifu');
}

}
