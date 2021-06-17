<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RatingController extends Controller
{
    public $home = "/rating";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('rating.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rating.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rating::create($this->validateRating());
        return redirect($this->home)->with('success', 'Rating Added Successfully !!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $rating = Rating::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return view('errors.notfound');
        } catch (BadRequestHttpException $exception) {
            throw $exception;
        } catch (AccessDeniedHttpException $exception) {
            throw $exception;
        } catch (HttpException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            GeneralUtility::logException($exception, __FUNCTION__);
            // Throwing Internal Server Error Response In case of Unknown Errors.
            throw new HttpException(500, ErrorConstant::INTERNAL_ERR);
        }

        return view('rating.edit', compact('rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Rating::whereId($id)->update($this->validateRating());

        return redirect($this->home)->with('success', 'Rating Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $rating = Rating::findOrFail($id);
            $rating->delete();
        } catch (ModelNotFoundException $exception) {
            return view('errors.notfound');
        } catch (BadRequestHttpException $exception) {
            throw $exception;
        } catch (AccessDeniedHttpException $exception) {
            throw $exception;
        } catch (HttpException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            GeneralUtility::logException($exception, __FUNCTION__);
            // Throwing Internal Server Error Response In case of Unknown Errors.
            throw new HttpException(500, ErrorConstant::INTERNAL_ERR);
        }

        return redirect($this->home)->with('success', 'Rating Deleted Successfully !!!');
    }

    /**
     * Load all ratings from database
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function load_rating()
    {
        $ratings = Rating::all();

        return response()->json($ratings, 200);
    }

    /**
     * Validating the rating.
     *
     * @param  \App\rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function validateRating(){
        return request()->validate([
            'name' => 'required|unique:rating',
            'value' => 'required'
        ]);
    }
}
