<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TagController extends Controller
{
    public $home = "/tag";
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tag::create($this->validateTag());
        return redirect($this->home)->with('success', 'Tag Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $tag = Tag::findOrFail($id);
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

        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tag::whereId($id)->update($this->validateTag());

        return redirect($this->home)->with('success', 'Tag Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $tag = Tag::findOrFail($id);
            $tag->delete();
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

        return redirect($this->home)->with('success', 'Tag Deleted Successfully !!!');
    }

    /**
     * Load all tags from database
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function load_tags()
    {
        $tags = Tag::all();

        return response()->json($tags, 200);
    }

    /**
     * Validating the tag.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function validateTag(){
        return request()->validate([
            'name' => 'required|unique:tag'
        ]);
    }
}
