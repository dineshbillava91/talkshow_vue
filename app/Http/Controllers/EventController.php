<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EventController extends Controller
{
    public $home = "/event";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateEvent();

        $validatedData['users_id'] = Auth::id();

        Event::create($validatedData);
        return redirect($this->home)->with('success', 'Event Created Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $event = Event::findOrFail($id);
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

        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateEvent();

        $validatedData['users_id'] = Auth::id();

        Event::whereId($id)->update($this->validateEvent());

        return redirect($this->home)->with('success', 'Event Details Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $event = Event::findOrFail($id);
            $event->delete();
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

        return redirect($this->home)->with('success', 'Event Deleted Successfully !!!');
    }

    /**
     * Load all events from database
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function load_events()
    {
        $events = Event::all();

        return response()->json($events, 200);
    }

    /**
     * Validating the event.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function validateEvent(){
        return request()->validate([
            'name' => 'required|unique:event',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
    }
}
