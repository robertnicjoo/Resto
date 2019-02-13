<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Menu;
use App\MenuType;
use App\User;
use Auth;
use Session;
use Storage;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Manager|Cashier|Waiter']);
    }

    public function index()
    {
        if(Auth::user()->hasrole('Manager')){
            $orders = Order::orderby('id', 'desc')->get();
            return view('admin.orders.index', compact('orders'));
        } elseif(Auth::user()->hasrole('Cashier')) {
            $orders = Order::where('cashier_id', Auth::user()->id)->orderby('id', 'desc')->get();
            return view('admin.orders.index', compact('orders'));
        } else {
            $orders = Order::where('waiter_id', Auth::user()->id)->orderby('id', 'desc')->get();
            return view('admin.orders.index', compact('orders'));
        }
    }

    public function create()
    {
        $menus = MenuType::with('items')->get();
        $waiters = User::role('Waiter')->get();
        $cachiers = User::role('Cashier')->get();
        return view('admin.orders.create', compact('menus', 'waiters', 'cachiers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'customer' => 'required',
            'table_no' => 'required|numeric',
            'waiter_id' => 'required|numeric',
        ));
        $order = new Order;
        $lastorderId = Order::orderBy('id', 'desc')->first()->order_no ?? 0;
        $lastIncreament = substr($lastorderId, -3);
        $order->order_no = 'ERP'. date('Ymd') . '-' .str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
        $order->customer = $request->input('customer');
        $order->table_no = $request->input('table_no');
        $order->waiter_id = $request->input('waiter_id');
        $order->price = $request->input('price');
        $order->cashier_id = Auth::user()->id;
        $order->status = 'Active';
        if($order->save()){
            $order_id = $order->id;
            $items = $request->input('items');
            $qty = $request->input('qty');
            $results = collect($items)->map(function ($item, $key) use($qty) {
                return ['item_id' => $item, 'qty' => $qty[$key] ?? null,];
            });
            // dd($results);
            foreach($results as $result) {
                if($result['qty'] != null){
                OrderItem::create([
                'item_id' => $result['item_id'],
                'quantity' => $result['qty'],
                'order_id' => $order_id,
                ]);
                }
            }
        }
        Session::flash('success', 'Order Placed Successfully.');
        return redirect()->route('orders.index');
    }

    public function show($id)
    {
        if(Auth::user()->id == 'cashier_id' || Auth::user()->id == 'waiter_id' || Auth::user()->hasRole('Manager')){
            $order = Order::where('order_no', $id)->with('items')->first();
            return view('admin.orders.show', compact('order'));
        } else {
            abort('403');
        }
    }

    public function getItems($id)
    {
        $find = MenuType::where('id', $id)->first();
        $items = Menu::where('type_id', $find->id)->get();
        return response()->json($items);
    }

    public function updateorderstatus(Request $request, $id)
    {
        $type = Order::where('id',$id)->first();
        $type->status = $request->value;
        $type->save();
    }
}
