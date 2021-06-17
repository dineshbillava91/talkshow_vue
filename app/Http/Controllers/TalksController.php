<?php

namespace App\Http\Controllers;

use App\Models\Talks;
use App\Models\Speaker;
use App\Models\Event;
use App\Models\Participants;
use App\Models\Tag;
use App\User;
use App\Models\User_ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\TalksService;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TalksController extends Controller
{
    public $home = "/talks";

    /**
     * TalksController constructor.
     *
     * @param TalksService $talksService
     */
    public function __construct(TalksService $talksService)
    {
        $this->talksService = $talksService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('talks.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->talksService->getNontalksData();
        return view('talks.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateTalks('');

        $validatedData['participants'] = json_encode($request->participants);
        $validatedData['tags'] = json_encode($request->tags);
        $validatedData['users_id'] = Auth::id();

        Talks::create($validatedData);
        return redirect($this->home)->with('success', 'Talks Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function show(Talks $talks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $talk = Talks::findOrFail($id);
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

        $data = $this->talksService->getNontalksData();
        $data['talk'] = $talk;

        return view('talks.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateTalks($id);

        $validatedData['participants'] = json_encode($request->participants);
        $validatedData['tags'] = json_encode($request->tags);
        $validatedData['users_id'] = Auth::id();

        Talks::whereId($id)->update($validatedData);

        return redirect($this->home)->with('success', 'Talk Details Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $talks = Talks::findOrFail($id);
            $talks->delete();
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

        return redirect($this->home)->with('success', 'Talk Deleted Successfully !!!');
    }

    /**
     * Search for specified resource from storage.
     *
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data = $this->talksService->search(request('speaker'),request('tag'));

        return response()->json($data, 200);
    }

    /**
     * Validating the talks.
     *
     * @param  \App\Talks  $talks
     * @return \Illuminate\Http\Response
     */
    public function validateTalks($id){
        return request()->validate([
            'name' => 'required|unique:talks,name,'.$id,
            'title' => 'required|unique:talks,title,'.$id,
            'description' => 'required',
            'speaker_id' => 'required',
            'event_id' => 'required',
            'participants' => 'required',
            'tags' => 'required'
        ]);
    }
}
