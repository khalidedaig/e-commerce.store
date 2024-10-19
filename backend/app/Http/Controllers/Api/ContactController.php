<?php

namespace App\Http\Controllers\Api;

use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewContactRequest;
use App\Http\Requests\ValidateIdsFromRequest;
use App\Http\Resources\ApiResource;
use App\Models\Contact;
use App\Notifications\Admin\NewContactNotification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{


  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(Request $request)
  {
    if ($request->has('perPage')) {
      return ApiResource::collection(Contact::filter($request->all())->trashed()->sorted());
    }
    return ApiResource::collection(Contact::filter($request->all())->trashed()->sorted()->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(NewContactRequest $request)
  {
    $contact = Contact::create($request->validated());

    return Response::success("Contact created successfully", [
      'contact' => $contact,
      'message' => 'Your message has been sent successfully, we will get back to you soon'
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Contact  $contact
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(Contact $contact)
  {
    return new ApiResource($contact);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Contact  $contact
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Contact $contact)
  {
    $contact->update($request->validated());
    return Response::success("Updated successfully", $contact);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Contact  $contact
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Contact $contact)
  {
    if ($contact->delete()) {
      return Response::success("Deleted successfully");
    }
  }

  /**
   * Delete all the specified resource from storage.
   *
   * @param  \App\Http\Requests\ValidateIdsFromRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function deleteAll(ValidateIdsFromRequest $request)
  {
    if (Contact::withTrashed()->whereIn('id', $request->ids)->delete()) {
      return Response::success("Deleted all successfully");
    };
  }

  /**
   * Restore the specified resource from storage.
   *
   * @param  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function restore($id)
  {
    $contact = Contact::withTrashed()->findOrFail($id);
    $contact->restore();
    return new ApiResource($contact);
  }

  /**
   * Restore all the specified resource from storage.
   *
   * @param  \App\Http\Requests\ValidateIdsFromRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function restoreAll(ValidateIdsFromRequest $request)
  {
    if (Contact::withTrashed()->whereIn('id', $request->ids)->restore()) {
      return Response::success("Restored all successfully");
    };
  }

  /**
   * Force Delete the specified resource from storage.
   *
   * @param  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function forceDelete($id)
  {
    $contact = Contact::withTrashed()->findOrFail($id);
    if ($contact->forceDelete()) {
      return Response::success("Force deleted successfully");
    };
  }

  /**
   * Restore all the specified resource from storage.
   *
   * @param  \App\Http\Requests\ValidateIdsFromRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function forceDeleteAll(ValidateIdsFromRequest $request)
  {
    if (Contact::withTrashed()->whereIn('id', $request->ids)->forceDelete()) {
      return Response::success("Force deleted all successfully");
    };
  }
}
