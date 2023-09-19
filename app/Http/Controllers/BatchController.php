<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Session;

class BatchController extends Controller
{
    public function addItems(Request $request)
    {
        $batch = $request->input('selected_values');

        // Get the current cart from the session
        $sessionBatch = Session::get('allRequestedItems', []);
        $duplicateItems = [];
        if ($batch == null) {
            return redirect()->back()->withErrors(['No item selected!']);
        } else {

            // Check if the item already exists in the cart
            foreach ($batch as $requested_item) {
                $item = Store::find($requested_item);
                // $item->state = Store::is_borrowed;
                // $item->save();
                $isDuplicate = false;

                foreach ($sessionBatch as $cartItem) {
                    if ($cartItem['id'] === $item->id) {
                        $isDuplicate = true;
                        array_push($duplicateItems, $item->attributesToArray());
                        break;
                    }
                }
                // If the item is not a duplicate, add it to the cart
                if ($isDuplicate) {
                    return redirect()->back()->withErrors(["one of the Items you selected already exists in batch: $item->asset_description"]);
                } else {
                    array_push($sessionBatch, $item->attributesToArray());
                }

            }



            //dd(count($sessionBatch));

            // Store the updated cart in the session
            Session::put('allRequestedItems', $sessionBatch);

            return redirect()->back()->with('message', 'Items added to batch successfully.');
        }
    }
    public function addSingleItem(Request $request, $id)
    {
        $item = Store::find($id);
        // Get the current cart from the session
        $sessionBatch = Session::get('allRequestedItems', []);
        if ($item == null) {
            return redirect()->back()->withErrors(['No item selected!']);
        } else {


            // Check if the item already exists in the cart
            $isDuplicate = false;
            foreach ($sessionBatch as $cartItem) {
                if ($cartItem['id'] === $item->id) {
                    $isDuplicate = true;
                    array_push($duplicateItems, $item->attributesToArray());
                    break;
                }
            }
            // If the item is not a duplicate, add it to the cart
            if ($isDuplicate) {
                return redirect()->back()->withErrors(["The item you selected already exists in batch: $item->asset_description"]);
            } else {
                array_push($sessionBatch, $item->attributesToArray());
            }



            //dd(count($sessionBatch));

            // Store the updated cart in the session
            Session::put('allRequestedItems', $sessionBatch);

            return redirect()->back()->with('message', 'Items added to batch successfully.');
        }
    }


    public function removeItem(Request $request, $id)
    {

        // Get the current cart from the session
        $sessionBatch = Session::get('allRequestedItems', []);

        // Find the index of the item with the specified ID in the cart
        $index = -1;
        foreach ($sessionBatch as $key => $item) {
            if ($item['id'] == $id) {
                $index = $key;
                break;
            }
        }

        // If the item was found, remove it from the cart
        if ($index !== -1) {
            unset($sessionBatch[$index]);
            // Reset the array keys after removing the item
            $sessionBatch = array_values($sessionBatch);
        }

        // Store the updated cart in the session
        Session::put('allRequestedItems', $sessionBatch);

        return redirect()->back()->with('message', 'Item removed from batch successfully.');
    }

    public function clearBatch()
    {
        Session::remove('allRequestedItems');
        return redirect()->back()->with('message', 'Batch cleared successfully.');
    }

}
