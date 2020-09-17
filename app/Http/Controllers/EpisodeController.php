<?php

namespace App\Http\Controllers;

use App\Episode;

use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('episodes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'episode-number' => 'required',
            'title' => 'required',
            'link' => 'required',
            'published-date' => 'required'
        ]);

        // Add Episode
        $episode = new Episode();
        $episode->episode_number = request('episode-number');
        $episode->title = request('title');
        $episode->link = request('link');
        $episode->published_date = request('published-date');

        // Jazz Fight? Diamond Collection? Reg?
        if (request('jazz-fight') != null) {
            $episode->jazz_fight = 1;
            $episode->diamond_collection = 0;
        } else if (request('diamond-collection') != null) {
            $episode->jazz_fight = 0;
            $episode->diamond_collection = 1;
        } else {
            $episode->jazz_fight = 0;
            $episode->diamond_collection = 0;
        }

        if (request('description') != null) {
            $episode->description = request('description');
        } else {
            $episode->description = null;
        }

        $episode->save();

        return redirect('/')->with('success-add', 'Episode added successfully!');

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
        $episode = Episode::findOrFail($id);

        return view('episodes.edit', [
            'episode' => $episode
        ]);
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
        request()->validate([
            'episode-number' => 'required',
            'title' => 'required',
            'link' => 'required',
            'published-date' => 'required'
        ]);

        $episode = Episode::findOrFail($id);

        // Update Episode
        $episode->episode_number = request('episode-number');
        $episode->title = request('title');
        $episode->link = request('link');
        $episode->published_date = request('published-date');

        // Jazz Fight? Diamond Collection? Reg?
        if (request('jazz-fight') != null) {
            $episode->jazz_fight = 1;
            $episode->diamond_collection = 0;
        } else if (request('diamond-collection') != null) {
            $episode->jazz_fight = 0;
            $episode->diamond_collection = 1;
        } else {
            $episode->jazz_fight = 0;
            $episode->diamond_collection = 0;
        }

        if (request('description') != null) {
            $episode->description = request('description');
        } else {
            $episode->description = null;
        }

        $episode->save();

        return redirect('/')->with('success-update', 'Episode updated successfully!');
    }

    public function toggleDl($id, Request $request)
    {
        $episode = Episode::findOrFail($id);
        $episode->downloaded = $request->status;
        $episode->save();

        return array(
            'status' => 'success',
            'message' => 'Download toggled!',
        );
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
