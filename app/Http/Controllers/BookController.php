<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //
    public function getBook(Request $request)
    {
        echo 1;die;
    }

    public function getBookSlider(Request $request)
    {
        $bookSlider = Book::orderByDesc('id')->limit(10)->get();
        return response()->json([
            $bookSlider
        ]);
    }
    public function getListBookRecomend(Request $request)
    {
        $bookSlider = Book::limit(8)->get();
        return response()->json([
            $bookSlider
        ]);
    }

    public function getListBookPopular(Request $request)
    {
        $bookSlider = Book::orderByDesc('id')->limit(8)->get();
        return response()->json([
            $bookSlider
        ]);
    }
}
