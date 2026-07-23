<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'username' => ['nullable', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $login = trim($this->input('login') ?? $this->input('email') ?? $this->input('username') ?? '');
        $password = $this->input('password');
        $remember = $this->boolean('remember');

        if (empty($login)) {
            throw ValidationException::withMessages([
                'login' => 'Username atau email wajib diisi.',
            ]);
        }

        $attemptSuccess = false;

        // 1. If input is formatted as email, try matching by email
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $attemptSuccess = Auth::attempt(['email' => $login, 'password' => $password], $remember);
        }

        // 2. Try matching by username if username column exists
        if (!$attemptSuccess && Schema::hasColumn('users', 'username')) {
            $attemptSuccess = Auth::attempt(['username' => $login, 'password' => $password], $remember);
        }

        // 3. Fallback try matching by email even if not standard format
        if (!$attemptSuccess) {
            $attemptSuccess = Auth::attempt(['email' => $login, 'password' => $password], $remember);
        }

        if (!$attemptSuccess) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        $login = trim($this->input('login') ?? $this->input('email') ?? $this->input('username') ?? '');
        return Str::transliterate(Str::lower($login).'|'.$this->ip());
    }
}
