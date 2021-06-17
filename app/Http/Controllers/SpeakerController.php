<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SpeakerController extends Controller
{
    public $home = "/speaker";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('speaker.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('speaker.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Speaker::create($this->validateSpeaker());
        return redirect($this->home)->with('success', 'Speaker Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function show(Speaker $speaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $speaker = Speaker::findOrFail($id);
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

        return view('speaker.edit', compact('speaker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Speaker::whereId($id)->update($this->validateSpeaker());

        return redirect($this->home)->with('success', 'Speaker Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $speaker = Speaker::findOrFail($id);
            $speaker->delete();
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

        return redirect($this->home)->with('success', 'Speaker Deleted Successfully !!!');
    }

    /**
     * Load all speakers from database
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function load_speakers()
    {
        $speakers = Speaker::all();

        return response()->json($speakers, 200);
    }

    /**
     * Load top speakers from database
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function top()
    {
        $speakers = Speaker::all();

        return response()->json($speakers, 200);
    }

    /**
     * Validating the speaker.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function validateSpeaker(){
        return request()->validate([
            'name' => 'required|unique:speaker'
        ]);
    }
}
