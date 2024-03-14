<?php

namespace App\Livewire\DeliveryManagement;

use Livewire\Component;
use Illuminate\Http\Request;

class ScheduleHome extends Component
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $events = ScheduleHome::where('active_status', 1)->get(); // Fetch all events
            return response()->json($events);
        }
    }

    public function ajax(Request $request)
    {
        if ($request->type == 'add') {
            $event = ScheduleHome::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
        } else if ($request->type == 'update') {
            $event = ScheduleHome::findOrFail($request->id); // Find the event
            $event->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
        } else if ($request->type == 'delete') {
            $event = ScheduleHome::findOrFail($request->id); // Find the event
            $event->delete();
            return response()->json(['status' => 'success']);
        }
    }
    public function render()
    {
        return view('livewire.delivery-management.schedule-home');
    }
}
