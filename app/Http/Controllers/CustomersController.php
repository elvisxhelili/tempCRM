<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Contracts;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::where('trashed', 0)->get();
        
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create')->withCustomer(new Customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::create($request->all());

        return redirect()->route('customers.edit', $customer)->withMessage('Customer created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return view('customers.edit', compact('customer'))->withMessage('Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::FindOrFail($id);

        $customer->trashed = 1;

        if($customer->save()){

            if($customer->contracts){    // checking if the customer has contracts means he also has orders, or not

                foreach ($customer->contracts as $contract) {
                    
                    $contract->trashed = 1;

                    $contract->save();

                    foreach ($customer->orders as $order) {
                       
                      $order->trashed = 1;

                      $order->save();
                    }
                }
            }

            return redirect()->route('customers.index')->withMessage('Customer deleted successfully');
        }

        return redirect()->route('customers.index')->withMessage('Something went wrong, pleayse try again!');
    }

    public function customerOders($id)
    {
        $customer = Customer::FindOrFail($id);

        if(count($customer->activeOrders) > 0){


            return view('customers.view-orders', compact('customer'));
        }

        return back()->withMessage('This Cusomer has no orders!');
        
    }

     public function restoreCustomer($id)
    {
         $customer = Customer::FindOrFail($id);

        $customer->trashed = 0;

        if($customer->save()){

            if($customer->contracts){    // checking if the customer has contracts means he also has orders, or not

                foreach ($customer->contracts as $contract) {
                    
                    $contract->trashed = 0;

                    $contract->save();

                    foreach ($customer->orders as $order) {
                       
                      $order->trashed = 0;

                      $order->save();
                    }
                }
            }

            return redirect()->route('customers.index')->withMessage('Customer restored successfully');
        }

        return redirect()->route('customers.index')->withMessage('Something went wrong, pleayse try again!');
        
    }


}
