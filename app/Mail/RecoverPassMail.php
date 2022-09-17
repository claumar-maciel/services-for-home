<?php

namespace App\Mail;

use App\Helpers\StringHelper;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class RecoverPassMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(Usuario $usuario)
    {
        $this->userName = $usuario->nome;

        $appUrl = env('APP_URL');

        $guard = null;
        switch ($usuario->perfil_id) {
            case Perfil::CLIENTE:
                $guard = 'client';
                break;
            case Perfil::ADMINISTRADOR:
                $guard = 'admin';
                break;
            case Perfil::PRESTADOR:
                $guard = 'provider';
                break;
        }

        $recoveryCode = Str::uuid();
        $usuario->recovery_code = $recoveryCode;
        $usuario->save();

        $this->recoverUrl =  "$appUrl/$guard/change-pass-form?code=$recoveryCode";
    }

    public function build()
    {
        return $this->subject('Recuperação de senha')
                    ->view('mails.recover-pass')
                    ->with([
                        'user_name' => $this->userName,
                        'recover_url' => $this->recoverUrl
                    ]);
    }
}
