@include('mails.header')


<table id="u_content_text_3" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0"
    cellspacing="0" width="100%" border="0">
    <tbody>
        <tr>
            <td class="v-container-padding-padding"
                style="overflow-wrap:break-word;word-break:break-word;padding:10px 55px 40px;font-family:arial,helvetica,sans-serif;"
                align="left">

                <div style="font-size: 14px; line-height: 170%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 16px; line-height: 27.2px;">Hi
                            {{ $user->full_name }},</span></p>
                    <p style="font-size: 14px; line-height: 170%;"> </p>
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 16px; line-height: 27.2px;">Please use the
                            following verification PIN to access the SGA system: </span></p>
                    <p style="font-size: 14px; line-height: 170%;"> </p>
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 16px; line-height: 27.2px;">Verification
                            PIN: [{{ $verificationPin }}] </span></p>
                    <p style="font-size: 14px; line-height: 170%;"> </p>
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 16px; line-height: 27.2px;">If you did not
                            request this PIN or have any concerns, please contact us immediately.</span></p>
                    <p style="font-size: 14px; line-height: 170%;"> </p>
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 14px; line-height: 23.8px;">
                            Thank you,</span></p>
                    <p style="font-size: 14px; line-height: 170%;"><span
                            style="font-family: Lato, sans-serif; font-size: 14px; line-height: 23.8px;">
                            NETI-SGA System</span></p>
                </div>

            </td>
        </tr>
    </tbody>
</table>







@include('mails.footer')
