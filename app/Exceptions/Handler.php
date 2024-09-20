<?php

namespace App\Exceptions;

use App\Models\User;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            $this->logTokenMismatch($request);
            return redirect()->back()->withInput($request->except('_token'))->with('withError', true);
        }

        return parent::render($request, $exception);
    }

    /**
     * Log user information when a TokenMismatchException occurs.
     *
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    protected function logTokenMismatch(Request $request)
    {
        $user = auth()->user();
        $userInfo = $user ? $user->toArray() : ['guest' => true];

        $info = [
            'error' => 'true',
            'error_type' => '419 error CSRF TOKEN',
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'user_info' => $userInfo,
            'session_id' => $request->session()->getId(),
            'session_data' => $request->session()->all(),
            'input' => $request->except(['password', 'password_confirmation']), // Exclude sensitive fields
        ];
        Log::warning('419 Token Mismatch Exception', $info);
        Notification::send(User::where('role_id', 1)->first(), new \App\Notifications\SendTelegramBot(['text' => json_encode($info, JSON_PRETTY_PRINT)]));
    }
}
