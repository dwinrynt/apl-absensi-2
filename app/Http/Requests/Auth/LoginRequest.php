<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string']
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if ($this->role != 'siswa') {
            $user = User::where('email', $this->login)
                    ->orWhere('nip', $this->login)
                    ->first();

            if (!$user || !Hash::check($this->password, $user->password)|| !$user->hasRole($this->role)) {
                RateLimiter::hit($this->throttleKey());
    
                throw ValidationException::withMessages([
                    'message' => 'Login Gagal',
                ]);
                
            }

            Auth::login($user, $this->boolean(key: 'remember'));
        }else{
            $siswa = Siswa::where('nipd', $this->login)->first();

            if (!$siswa || !Hash::check($this->password, $siswa->password)) {
                RateLimiter::hit($this->throttleKey());
    
                throw ValidationException::withMessages([
                    'message' => 'Login Gagal',
                ]);
            }

            Auth::login($siswa, $this->boolean(key: 'remember'));
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('login')).'|'.$this->ip();
    }
}
