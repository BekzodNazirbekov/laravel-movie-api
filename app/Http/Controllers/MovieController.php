<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $movies = Movie::query()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $movies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'year' => 'integer|required',
            'director' => 'string|required',
            'description' => 'string|required',
            'poster' => 'string|required',
            'type' => 'string|required'
        ]);

        $movie = Movie::query()->create([
            'title' => request('title'),
            'year' => request('year'),
            'director' => request('director'),
            'description' => request('description'),
            'poster' => request('poster'),
            'type' => request('type')
        ]);

        return response()->json([
            'success' => true,
            'data' => $movie,
            'message' => 'Movie added successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): JsonResponse
    {

        if ($movie) {

            return response()->json([
                'success' => true,
                'data' => $movie
            ]);

        }

        return response()->json([
            'success' => false,
            'message' => 'Movie not found'
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {

        $request->validate([
            'title' => 'string|required',
            'year' => 'integer|required',
            'director' => 'string|required',
            'description' => 'string|required',
            'poster' => 'string|required',
            'type' => 'string|required'
        ]);


        $movie->update([
            'title' => request('title'),
            'year' => request('year'),
            'director' => request('director'),
            'description' => request('description'),
            'poster' => request('poster'),
            'type' => request('type')
        ]);

        return response()->json([
            'success' => true,
            'data' => $movie,
            'message' => 'Movie updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie) {
            $movie->delete();

            return response()->json([
                'success' => true,
                'message' => 'Movie deleted successfully'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Movie not found'
        ]);
    }
}
