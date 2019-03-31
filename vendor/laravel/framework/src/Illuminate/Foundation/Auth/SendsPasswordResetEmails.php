<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait SendsPasswordResetEmails
{
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), ['email_reset' => 'required|email'], [], []);

        if ($validator->fails())
        {
            $errors = [
                'email_reset' => 'Email incorect.',
            ];

            if ($request->expectsJson())
            {
                return new JsonResponse($errors, 422);
            }

            return redirect()->to($this->getRedirectUrl())
                             ->withInput($request->input())
                             ->withErrors($errors, $this->errorBag());
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink([
                                                       'email' => $request->get('email_reset'),
                                                   ]);

        $resetLink = route('change_pass', ['code' => $this->broker()->getGeneratedToken()]);

        return $response == Password::PASSWORD_RESET
            ? response()->json(['title' => 'Token generat', 'message' => 'Click <strong><a target="_blank" href="' . $resetLink . '">AICI</a></strong> pentru a reseta parola!'])
            : new JsonResponse(['email_reset' => 'Generarea tokenului a esuat.'], 422);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email_reset' => trans($response)]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
