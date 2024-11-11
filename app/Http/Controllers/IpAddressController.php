<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    /**
     * Display a listing of the IP addresses.
     */

    public function index()
    {
        $ipAddresses = IpAddress::all(); // Fetch all IP addresses
        return view('dashboard.issues.subnets.index', compact('ipAddresses')); // Return to a view
    }

    /**
     * Show the form for creating a new IP address.
     */
    public function create()
    {
        return view('dashboard.issues.create'); // Display the creation form
    }

    /**
     * Store a newly created IP address in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|unique:ip_addresses,address',
            'in_use' => 'required|boolean',
        ]);

        

        IpAddress::create([
            'address' => $request->address,
            'in_use' => $request->in_use,
            'device_name' => $request->device_name,
        ]);

        return redirect()->route('ipaddresses.index')
            ->with('message', 'IP address created successfully.');
    }

    /**
     * Show the form for editing the specified IP address.
     */
    public function edit($id)
    {

        $ipAddress = IpAddress::find($id);
        return view('dashboard.issues.subnets.edit', compact('ipAddress')); // Display the edit form
    }

    /**
     * Update the specified IP address in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required',
            'in_use' => 'required|boolean',
        ]);


        $ipAddress = IpAddress::find($id);

        $ipAddress->update([
            'address' => $request->address,
            'in_use' => $request->in_use,
            'device_name' => $request->device_name,
        ]);

        return redirect()->route('ipaddresses.index')
            ->with('message', 'IP address updated successfully.');
    }

    public function generateUnusedIPAddress()
    {
        // Get all existing IP addresses from the database in the specified subnets
        $usedIPs = IpAddress::pluck('address')->toArray();

        // Define the subnets we want to check for availability
        $availableSubnets = ['20', '40'];

        // Iterate through each subnet
        foreach ($availableSubnets as $subnet) {
            // Generate random number between 31 and 255 to exclude 1-30
            $randomNumber = rand(31, 255);

            // Format the IP address
            $ipSuffix = sprintf('%s.%03d', $subnet, $randomNumber); // Format as '20.031', '20.032', etc.
            $ipAddress = '192.168.' . $ipSuffix; // Create the full IP address

            // Check if this IP address is already used
            if (!in_array($ipAddress, $usedIPs)) {
                // Save the new IP address in the database

                $newIPAddress =  new IpAddress();
                $newIPAddress->address = $ipAddress;
                $newIPAddress->in_use = false;
                $newIPAddress->device_name = "Unknown";

                // Redirect to the edit view for the new IP address
                return view('dashboard.issues.subnets.show', compact('newIPAddress')); // Return to a view
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'No unused IP addresses available in the specified subnets.',
        ], 404);
    }


    /**
     * Remove the specified IP address from storage.
     */
    public function destroy(IpAddress $ipAddress)
    {
        $ipAddress->delete();

        return redirect()->route('ipaddresses.index')
            ->with('message', 'IP address deleted successfully.');
    }
}
