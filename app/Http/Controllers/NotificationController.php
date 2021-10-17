<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification as Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
//        $unreadNotifications = auth()->user()->unreadNotifications()->get();
//        $readNotifications = auth()->user()->readNotifications()->get();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        try {
            $notification->delete();
            return redirect()->back()->withSuccess(__('common.deleted', ['title' => 'Notification']));
        } catch (\Exception $exception) {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
