<?php

namespace App\Http\Controllers;

use App\Models\Event;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
Use Illuminate\HTTP\JsonResponse;;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(): JsonResponse{
        $event = Event::all();
        if(!empty($event)){
            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'message' => 'Events retrieved successfully',
                'data' => $event
            ]); 

        }
        return response()->json([
            'code' => 205,
            'status' => 'Empty_Data',
            'message' => 'No events found',
            'data' => null
        ]);
    }

    public function store(Request $request): JsonResponse{
        $validator = Validator::make($request->all(),[
            'event_type_id' => 'required|exists:event_types,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' =>'nullable|string|max:255',
            'guest_capacity' => 'nullable|integer|min:1',
            'status' => 'required|string|in:draft,published,canceled',
            // 'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'status' => 'Validation_Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        $storeEvent = Event::create($validator->validated());
        if($storeEvent){
            return response()->json([
                'code' => 201,
                'status' => 'Success',
                'message' => 'Event created successfully',
                'data' => $storeEvent
            ]);
        }
        return response()->json([
            'code' => 500,
            'status' => 'Internal_Server_Error',
            'message' => 'Failed to create event',
            'data' => null
        ]);

    }

    public function show(Event $event) : JsonResponse {
        if($event){
            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'message' => 'Event retrieved successfully',
                'data' => $event
            ]);
        }
        return response()->json([
            'code' => 404,
            'status' => 'Not_Found',
            'message' => 'Event not found',
            'data' => null
        ]);
    }
    public function update(Request $request,Event $event) : JsonResponse {
     $validator = Validator::make($request->all(),[
        'event_type_id' => 'required|exists:event_types,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'venue' =>'nullable|string|max:255',
        'guest_capacity' => 'nullable|integer|min:1',
        'status' => 'required|string|in:draft,published,canceled',
        // 'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
     ]);
        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'status' => 'Validation_Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }
        $event->update($validator->validated());
        if($event){
            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'message' => 'Event updated successfully',
                'data' => $event
            ]);
        }
        return response()->json([
            'code' => 500,
            'status' => 'Internal_Server_Error',
            'message' => 'Failed to update event',
            'data' => null
        ]);
    }
    public function destory(Event $event):JsonResponse{

        $event-> delete();

        if($event){
            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'message' => 'Event deleted successfully',
                'data' => null
            ]);
        }
        return response()->json([
            'code' => 404,
            'status' => 'Not_Found',
            'message' => 'Event not found',
            'data' => null
        ]);
    }
}
