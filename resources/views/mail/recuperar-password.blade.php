<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f3f4f6; padding:20px;">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:24px; border-radius:8px;">

                <tr>
                    <td>
                        <h2 style="color:#111827;">
                            Hola {{ $user->name ?? 'nombre usuario' }},
                        </h2>

                        <p style="color:#374151; font-size:14px;">
                            Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.
                        </p>

                        <p style="color:#374151; font-size:14px;">
                            Haz clic en el siguiente botón para crear una nueva contraseña:
                        </p>

                        <p style="text-align:center; margin:30px 0;">
                            <a
                                href="{{ $resetUrl ?? 'url de recuperación' }}"
                                style="background:#4f46e5; color:#ffffff; padding:12px 20px; text-decoration:none; border-radius:6px; display:inline-block;"
                            >
                                Restablecer contraseña
                            </a>
                        </p>

                        <p style="color:#374151; font-size:14px;">
                            Este enlace expirará en {{ config('auth.passwords.users.expire') }} minutos.
                        </p>

                        <p style="color:#6b7280; font-size:13px; margin-top:30px;">
                            Si no solicitaste el cambio de contraseña, puedes ignorar este correo.
                        </p>

                        <p style="color:#111827; font-size:14px; margin-top:20px;">
                            Un saludo,<br>
                            <strong>{{ config('app.name') }}</strong>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
