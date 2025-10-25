<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestModelRequest;
use App\Jobs\SendUrlRequestJob;
use App\Models\Duration;
use App\Models\RequestModel;
use Illuminate\Http\Request;

class RequestController extends Controller
{
public function index()
{
$fatchRequest = RequestModel::with('duration')->get();

    
    return view('panel.request.index', compact('fatchRequest'));
}

    public function create()
    {
        $fetchDuration = Duration::all();
     
        return view('panel.request.create',compact('fetchDuration'));
    }

    public function store(RequestModelRequest $reqValid)
    {
        
        $this->createRequest($reqValid);
        return redirect()->route('panel.request.index')->with('success', 'Request updated successfully');
    }


public function createRequest(RequestModelRequest $reqValid)
{
    $validated = $reqValid->validated();

    $requestModel = RequestModel::create([
        'url' => $validated['url'],
        'name' => $validated['name'],
        'email' => $validated['email'],
        'duration_id' => $validated['duration_id'],
        'status' => 'active',
        'last_visited' => null,
    ]);

    return $requestModel;
}



    public function edit($id)
    {
        $fetchRequest =  RequestModel::findOrFail($id);
        return view('panel.request.edit', compact('fetchRequest'));
    }

    public function update($id)
    {
        $requestModel = RequestModel::findOrFail($id);

        if ($this->updateAction($requestModel, request()->all())) {
            return redirect()->route('panel.request.index')->with('success', 'Request updated successfully');
        } else {
            return redirect()->route('panel.request.index')->with('error', 'Failed to update request');
        }
    }

    public function updateAction(RequestModel $requestModel, array $data)
    {

        $validator = \Validator::make($data, [
            'url' => 'required|url|max:255',
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:150',
            'duration' => 'required',
        ]);


        $requestModel->url = $data['url'];
        $requestModel->name = $data['name'];
        $requestModel->email = $data['email'];
        $requestModel->duration = $data['duration'];


        return $requestModel->save();
    }



    //delete
    public function delete($id)
    {
        $request = RequestModel::findOrFail($id);

        if ($this->deleteAction($request)) {
            return redirect()->route('panel.request.index')->with('success', 'Request deleted successfully');
        } else {
            return redirect()->route('panel.request.index')->with('error', 'Failed to delete request');
        }
    }

    public function deleteAction(RequestModel $request)
    {
        return $request->delete();
    }




public function storeTestJob()
{
    $requestModel = RequestModel::create([
        'url' => 'http://127.0.0.1:8000/test-job',
        'name' => 'test',
        'email' => 'alimohammadi123450@gmail.com',
        'duration' => 1,
        'status' => 'active',
        'last_visited' => null,
    ]);

    return $requestModel;
}

public function testJob()
{
  
}


}
