@include('mail.header')
<tr>
    <td valign="top">
        <!-- BEGIN MODULE: Call to action 2 -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
            <tr>
                <td style="padding: 0px 0px 0px 0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                        <tr>
                            <td valign="top" class="pc-w520-padding-30-40-30-40 pc-w620-padding-35-50-35-50" style="padding: 40px 60px 40px 60px;border-radius: 0px;background-color: #ffffff;" bgcolor="#ffffff">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td align="center" valign="top" style="padding: 0px 0px 10px 0px;">
                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="margin-right: auto; margin-left: auto;">
                                                <tr>
                                                    <td valign="top" class="pc-font-alt" align="center" style="mso-line-height: exactly;line-height: 128%;letter-spacing: -0.6px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 36px;font-weight: 800;color: #151515;text-align: center;text-align-last: center;font-variant-ligatures: normal;">
                                                        <div><span>Join Our Exclusive Expert Community! </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td align="center" valign="top" style="padding: 0px 0px 20px 0px;">
                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="margin-right: auto; margin-left: auto;">
                                                <tr>
                                                    <td valign="top" class="pc-font-alt" align="center" style="mso-line-height: exactly;line-height: 140%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 20px;font-weight: normal;color: #1b1b1b;text-align: center;text-align-last: center;font-variant-ligatures: normal;">
                                                        <div><span>You&#39;ve been invited to be shortlisted as an expert for our upcoming project. </span>
                                                        </div>
                                                        <div><span>&#xFEFF;</span>
                                                        </div>
                                                        <div><span>Project: </span>
                                                        </div>
                                                        <div><span style="font-size: 19px;font-weight: 700;font-style: normal;">{{$mailData['projectName'] ?? 'Not set'}}</span>
                                                        </div>
                                                        <div><span>&#xFEFF;</span>
                                                        </div>
                                                        <div><span>Show your interest by sign-up with us. </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td align="center" style="padding: 0px 0px 20px 0px;">
                                            <table class="pc-width-hug pc-w620-gridCollapsed-0" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr class="pc-grid-tr-first pc-grid-tr-last">
                                                    <td class="pc-grid-td-first pc-grid-td-last" valign="top" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;">
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td align="center" valign="top">
                                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                        <tr>
                                                                            <td align="center" valign="top">
                                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <th valign="top" align="center" style="font-weight: normal;line-height: 1;">
                                                                                            <!--[if mso]>
                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="border-collapse: separate;margin-right: auto; margin-left: auto;">
                                                                                                                            <tr>
                                                                                                                                <td valign="middle" align="center" style="text-align: center;color: #ffffff;border-radius: 8px;background-color: rgba(251,22,22,0.8);padding: 14px 18px 14px 18px;" bgcolor="#1595e7">
                                                                                                                                    <a class="pc-font-alt" style="display: inline-block;text-decoration: none;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-weight: 500;font-size: 16px;line-height: 150%;letter-spacing: -0.2px;color: #ffffff;font-variant-ligatures: normal;" href="{{ $mailData['expert_url'] }}" target="_blank">Join Asia Deal Hub Expert</a>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </table>
                                                                                                                        <![endif]-->
                                                                                            <!--[if !mso]>--><a style="border-radius: 8px;background-color: rgba(251,22,22,0.8);padding: 14px 18px 14px 18px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-weight: 500;font-size: 16px;line-height: 150%;letter-spacing: -0.2px;color: #ffffff;text-align: center;text-align-last: center;text-decoration: none;display: inline-block;vertical-align: top;-webkit-text-size-adjust: none;" href="{{ $mailData['expert_url'] }}" target="_blank">Join Asia Deal Hub Expert</a>
                                                                                            <!--<![endif]-->
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- END MODULE: Call to action 2 -->
    </td>
</tr>
<tr>
    <td valign="top">
        <!-- BEGIN MODULE: Feature 1 -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
            <tr>
                <td style="padding: 0px 0px 0px 0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                        <tr>
                            <td valign="top" class="pc-w520-padding-30-30-30-30 pc-w620-padding-35-35-35-35" style="padding: 40px 40px 40px 40px;border-radius: 0px;background-color: #ffffff;" bgcolor="#ffffff">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td valign="top" style="padding: 0px 0px 10px 0px;">
                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 142%;letter-spacing: -0.4px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 24px;font-weight: bold;color: #151515;font-variant-ligatures: normal;">
                                                        <div><span>How AsiaDealHub work?</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td>
                                            <table class="pc-width-fill pc-w620-gridCollapsed-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr class="pc-grid-tr-first pc-grid-tr-last">
                                                    <td class="pc-grid-td-first pc-w620-padding-30-0" align="left" valign="top" style="width: 33.333333333333%; padding-top: 0px; padding-right: 20px; padding-bottom: 0px; padding-left: 0px;">
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                            <tr>
                                                                <td align="left" valign="top">
                                                                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td align="left" valign="top" style="padding: 0px 0px 10px 0px;">
                                                                                            <img src="https://cloudfilesdm.com/postcards/feature-1-image-2.jpg" class="" width="48" height="48" alt="" style="display: block;border: 0;outline: 0;line-height: 100%;-ms-interpolation-mode: bicubic;width:48px;height: auto;max-width: 100%;" />
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td valign="top" style="padding: 0px 0px 6px 0px;">
                                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                                <tr>
                                                                                                    <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 133%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 18px;font-weight: 500;color: #1b1b1b;font-variant-ligatures: normal;">
                                                                                                        <div><span>1. Client choose Expert </span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" align="left">
                                                                                    <tr>
                                                                                        <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 143%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 14px;font-weight: normal;color: #9b9b9b;font-variant-ligatures: normal;">
                                                                                            <div><span>Client send project invitation to potential expert</span>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class="pc-w620-padding-30-0" align="left" valign="top" style="width: 33.333333333333%; padding-top: 0px; padding-right: 20px; padding-bottom: 0px; padding-left: 20px;">
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                            <tr>
                                                                <td align="left" valign="top">
                                                                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td align="left" valign="top" style="padding: 0px 0px 10px 0px;">
                                                                                            <img src="https://cloudfilesdm.com/postcards/feature-1-image-1.jpg" class="" width="48" height="48" alt="" style="display: block;border: 0;outline: 0;line-height: 100%;-ms-interpolation-mode: bicubic;width:48px;height: auto;max-width: 100%;" />
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td valign="top" style="padding: 0px 0px 6px 0px;">
                                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                                <tr>
                                                                                                    <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 133%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 18px;font-weight: 500;color: #1b1b1b;font-variant-ligatures: normal;">
                                                                                                        <div><span>2. Expert Work on Project</span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" align="left">
                                                                                    <tr>
                                                                                        <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 143%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 14px;font-weight: normal;color: #9b9b9b;font-variant-ligatures: normal;">
                                                                                            <div><span>Varies types of projects is available.</span>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class="pc-grid-td-last pc-w620-padding-30-0" align="left" valign="top" style="width: 33.333333333333%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 20px;">
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                            <tr>
                                                                <td align="left" valign="top">
                                                                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td align="left" valign="top" style="padding: 0px 0px 10px 0px;">
                                                                                            <img src="https://cloudfilesdm.com/postcards/feature-1-image-3.jpg" class="" width="48" height="48" alt="" style="display: block;border: 0;outline: 0;line-height: 100%;-ms-interpolation-mode: bicubic;width:48px;height: auto;max-width: 100%;" />
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                    <tr>
                                                                                        <td valign="top" style="padding: 0px 0px 6px 0px;">
                                                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                                                <tr>
                                                                                                    <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 133%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 18px;font-weight: 500;color: #1b1b1b;font-variant-ligatures: normal;">
                                                                                                        <div><span>3. Getting Paid</span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top">
                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" align="left">
                                                                                    <tr>
                                                                                        <td valign="top" class="pc-font-alt" style="mso-line-height: exactly;line-height: 143%;letter-spacing: -0.2px;font-family: Fira Sans, Arial, Helvetica, sans-serif;font-size: 14px;font-weight: normal;color: #9b9b9b;font-variant-ligatures: normal;">
                                                                                            <div><span>You&#39;ll get paid for each of project that you complete.</span>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- END MODULE: Feature 1 -->
    </td>
</tr>
@include('mail.footer')
