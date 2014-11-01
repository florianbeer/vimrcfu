<?php

class TagsController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function search($string)
  {
    return Tag::where('name', 'LIKE', '%'.$string.'%')->get();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

}
