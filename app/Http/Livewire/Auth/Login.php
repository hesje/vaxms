<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MultipleItemsFoundException;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $user_id;
    public $auth_code = '';

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function sendAuthCode()
    {
        $this->validate([
            'username' => 'required|min:2|string',
        ]);
        try {
            $user = User::query()
                ->where('username', $this->username)
                ->sole();

            $user->sendAuthCode();
            $this->user_id = $user->id;

        } catch (ModelNotFoundException $exception) {
            // TODO: notify user that user with username doesnt exist
        } catch (MultipleItemsFoundException $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }
    }

    public function tryLogin()
    {
        $this->validate([
            'auth_code' => 'required|max:999999|numeric',
        ]);

        $user = User::find($this->user_id);
        if ($user->login($this->auth_code)) {
            return redirect()->route('parent-dashboard');
        }
    }
}
