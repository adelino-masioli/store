<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTimeline;
use App\Traits\DataTableTrait;
use Illuminate\Support\Facades\Auth;

class OrderTimelineController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //all
    public static function all()
    {
        $timelines = OrderTimeline::where('configuration_id', Auth::user()->configuration_id)->where('status_id', '!=', statusOrder('canceled'))->orderBy('id', 'desc')->orderBy('status_id', 'asc')->get();
        return view('admin.timeline.home', compact('timelines'));
    }

    //show
    public static function show($order)
    {
        $id = base64_decode($order);
        $timelines = OrderTimeline::where('order_id', $id)->where('configuration_id', Auth::user()->configuration_id)->where('status_id', '!=', statusOrder('canceled'))->orderBy('id', 'desc')->orderBy('status_id', 'asc')->get();
        return view('admin.timeline.show', compact('timelines'));
    }
}
