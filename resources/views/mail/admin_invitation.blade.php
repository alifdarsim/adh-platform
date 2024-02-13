@extends('mail.layout')
@section('content')
    <table class="email-body text-center">
        <tbody>
        <tr>
            <td class="px-3 px-sm-5 pt-3 pt-sm-5 pb-3">
                <h2 class="email-heading text-danger">Admin Invitation</h2>
            </td>
        </tr>
        <tr>
            <td class="px-3 px-sm-5 pb-2">
                <p>Hi {{ $mailData['name'] ?? 'No Name'}},</p>
                <p>You have been invited to join as admin for AsiaDealHub. <br>Click button below to
                    accept.</p>
                <a href="{{route('admin.invitation', ['token' => $mailData['token'] ?? '--'])}}"
                   class="email-btn bg-danger">ACCEPT AS ADMIN</a>
            </td>
        </tr>
        <tr>
            <td class="px-3 px-sm-5 pt-2 pb-3 pb-sm-5">
                <p>This link will expire 3 days after this email sent</p>
                <p></p>
                <p class="email-note">This is an automatically generated email please do not reply to
                    this email. If you face any issues, please contact us at support@asiadealhub.com</p>
            </td>
        </tr>
        </tbody>
    </table>

@endsection
