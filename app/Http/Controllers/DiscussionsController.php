<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateDiscussionRequest;
use App\Notifications\BestReply;
use App\Reply;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth')->only(['create', 'store']);
     }

    public function index()
    {
        return view('discussions.index',[
            'discussions' => Discussion::paginate(3),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        Discussion::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => str_slug($request->title),
            'user_id' => auth()->user()->id,
            'channel_id' => $request->channels,
        ]);

        session()->flash('success', 'The discussion has been added.');

        return redirect(route('discussion.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show')->with('discussion', $discussion);
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

    public function bestReply(Discussion $discussion, Reply $reply)
    {
        $discussion->update([
            'reply_id' => $reply->id,
        ]);

        $reply->user->notify(new BestReply($reply->discussion));

        session()->flash('success', 'Reply marked as best.');

        return redirect()->back();
    }
}
