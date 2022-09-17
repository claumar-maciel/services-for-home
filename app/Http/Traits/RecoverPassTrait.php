<?php

namespace App\Http\Traits;

use App\Http\Requests\RecoverPassRequest;
use App\Mail\RecoverPassMail;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait RecoverPassTrait 
{
    public function recoverPass(RecoverPassRequest $request)
    {
        $user = Usuario::where('email', $request->email)->firstOrFail();

        Mail::to($request->email)
            ->send(new RecoverPassMail($user));

        return redirect()->back();
    }
}