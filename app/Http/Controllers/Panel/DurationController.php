<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\DurationtModelRequest;
use App\Models\Duration;
use Illuminate\Http\Request;

class DurationController extends Controller
{
  public function index()
{
    $fetchDuration = Duration::latest()->get();

 
    return view('panel.duration.index', compact('fetchDuration'));
}


    public function create()
    {

        return view('panel.duration.create');
    }

  public function store(DurationtModelRequest $reqValid)
{
    $duration = $this->createRequest($reqValid);

    return response()->json([
        'success' => true,
        'data' => $duration
    ]);
}


public function createRequest(DurationtModelRequest $reqValid)
{
    $validated = $reqValid->validated();

    $result = Duration::create([
        'duration' => $validated['duration'],
        'user_id' => $validated['user_id'] ?? auth()->id(), 
    ]);

    return $result; 
}
   public function delete($id)
    {
        $duration = Duration::find($id);

        if (!$duration) {
            return response()->json(['success' => false, 'message' => 'Duration not found'], 404);
        }

        $deleted = $this->deleteAction($duration);

        if ($deleted) {
            return response()->json(['success' => true, 'id' => $id]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to delete'], 500);
    }


    public function deleteAction(Duration $duration)
    {
        return $duration->delete();
    }
}
