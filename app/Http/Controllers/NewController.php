<?php

namespace Bulkly\Http\Controllers;

use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;
use Bulkly\SocialPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->submit){
            $posts = BufferPosting::with('groupInfo', 'accountInfo');
            if ($request->group){
                $posts->orWhereHas('groupInfo', function ($query) use ($request) {
                    $query->where('type', '=', $request->group);
                });
            }
            if ($request->date){
                $date=date_create($request->date);
                $date = date_format($date,"Y-m-d");
                $posts->where(DB::raw("DATE(sent_at)"), '=', $date);
            }
            if ($request->search){
                $posts->orWhere('post_text', 'like', "%{$request->search}%");
                $posts->orWhereHas('groupInfo', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%");
                    $query->orWhere('type', 'like', "%{$request->search}%");
                });
            }
            $posts = $posts->paginate(10)->appends(['search' => $request->search, 'group' => $request->group, 'date' => $request->date]);
            $groups = SocialPostGroups::select('type')->groupBy('type')->get();
            return view('new.index', compact('posts', 'groups'));
        }else {
            $posts = BufferPosting::with('groupInfo', 'accountInfo')->paginate(10);
            $groups = SocialPostGroups::select('type')->groupBy('type')->get();
            return view('new.index', compact('posts', 'groups'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
