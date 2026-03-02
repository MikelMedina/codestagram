Hola {{ $user->name ?? 'nombre usuario' }},

Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.

Para crear una nueva contraseña, visita el siguiente enlace:

{{ $resetUrl ?? 'url reset'  }}

Este enlace expirará en {{ config('auth.passwords.users.expire') }} minutos.

Si no solicitaste este cambio, puedes ignorar este correo.

Un saludo,
{{ config('app.name') }}
