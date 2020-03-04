<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Contracts;
use App\Models\Order;
use App\Models\Tag;
use App\Models\OrderTags;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('trashed', 0)->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('trashed', 0)->get();

        $tags = Tag::all();

         return view('orders.create', compact('customers', 'tags'))->withOrder(new Order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         $this->validate($request, [
             'title' => 'required|string|max:99',
             'description' => 'required|string|max:99',
             'cost' => 'required|integer',
            'customer_id' => 'required|exists:customers,id',
            'tag_ids' => 'required|exists:tags,id'
            
        ]);

         $order = new Order();
         $order->title = $request->title;
         $order->description = $request->description;
         $order->cost = $request->cost;
         $order->customer_id = $request->customer_id;

         if($order->save()){

            $contract = new Contracts();
            $contract->order_id = $order->id;
            $contract->customer_id = $request->customer_id;
            $contract->save();

            
            foreach ($request->tag_ids as $ids) {

                $orderTags = new OrderTags();
                $orderTags->tag_id = $ids;
                $orderTags->order_id = $order->id;
                $orderTags->save();
            }
            

          

            return redirect()->route('orders.all')->withMessage('Order created successfully.');
         }
         
        return back()->withMessage('Try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $tagidss = Tag::select('id', 'name')->get();

        $myTags =  $order->orderTags->pluck('tag_id')->toArray();


        return view('orders.edit', compact('order', 'tagidss', 'myTags'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $order = Order::FindOrFail($request->id);

        $this->validate($request, [
            'tag_ids' => 'required|exists:tags,id',
            'title' => 'required|string|max:99',
            'description' => 'required|string|max:99',
            'cost' => 'required|integer',
            
        ]);

         $order->title = $request->title;
         $order->description = $request->description;
         $order->cost = $request->cost;

         $thisOrdertags = $order->orderTags;

         if($thisOrdertags){

            foreach ($thisOrdertags as $orderTags) {

                $orderTags->delete();
            }

         foreach ($request->tag_ids as $ids) {

                $newOrderTags = new OrderTags();
                $newOrderTags->tag_id = $ids;
                $newOrderTags->order_id = $order->id;
                $newOrderTags->save();
            }
         }


        return redirect()->route('orders.all')->withMessage('Order updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  

        $order = Order::FindOrFail($id);

        $order->trashed = 1;

        if ($order->save()) {
            
            if ($order->contracts) {
               
               foreach ($order->contracts as $contract) {
                   
                   $contract->trashed = 1;

                   $contract->save();
               }
            }
        }

        
        return redirect()->route('orders.all')->withMessage('Order deleted successfully');
    }






     public function asign(Order $order)
    {

        $customers = Customer::all();

        return view('orders.assign', compact('order', 'customers'));
    }





    public function assingOrderToCustomer(Request $request, Order $order)
    {
        
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
            
        ]);

        if($order->customer_id){

            return back()->withMessage('This order is already assigned! Please chooose another!');
         }

        $order->customer_id = $request->customer_id;

        if($order->update()){

            return back()->withMessage('Order assigned successfully to user');
        }

        

        return back()->withMessage('Something went wrong! Please try again!');
        

    }




    public function contract($id)
    {
        $order = Order::FindOrFail($id);


        return view('orders.view-contracts', compact('order'));
    }




    public function restoreOrder($id)
    {
        $order = Order::FindOrFail($id);

        $order->trashed = 0;

        if ($order->save()) {
            
            if ($order->contracts) {
               
               foreach ($order->contracts as $contract) {
                   
                   $contract->trashed = 0;

                   $contract->save();
               }
            }
        }

        
        return redirect()->route('orders.all')->withMessage('Order restored successfully');
    }
}
