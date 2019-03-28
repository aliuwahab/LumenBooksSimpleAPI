<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Show all books
     * @return JsonResponse
     */
    public function index(){

        $books = Book::all();
        return $this->successResponse($books);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){

        $this->validate($request, Book::$createRules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }


    /**
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($book){
        $book = Book::findOrFail($book);
        return $this->successResponse($book);
    }

    /**
     * @param Request $request
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $book){

        $this->validate($request, Book::$updateRules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if ($book->isClean()) {

            return $this->errorResponse('At least one value must be changed to trigger update',Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);
    }


    /**
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($book){
        $book = Book::findOrFail($book);
        $book->delete();

        return $this->successResponse($book);
    }

}
