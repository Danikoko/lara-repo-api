<!DOCTYPE html>
<html>

<head>
    <title>Message from {{ $name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add your custom CSS styles here */
        /* Ensure that your styles are inline as many email clients don't support external stylesheets */
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f4f4f4">
        <tr>
            <td align="center" valign="top">
                <table cellpadding="0" cellspacing="0" border="0" width="600"
                    style="max-width: 600px; background-color: #ffffff;">
                    <tr>
                        <td style="padding: 20px;">
                            <h1 style="font-size: 24px; margin-bottom: 20px;">Contact Mail from {{ $name }}</h1>
                            <p style="margin-bottom: 20px;">Hi {{ env('DEVELOPER_NAME') }},</p>
                            <p style="margin-bottom: 20px;">{{ $content }}</p>
                            <p style="margin-bottom: 20px;">Reach me via email: {{ $email }}</p>
                            @if (strlen($phone) > 0)
                                <p style="margin-bottom: 20px;">Or via a call: {{ $phone }}</p>
                            @endif
                            <p style="margin-bottom: 20px;">Regards, <br>{{ $name }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
