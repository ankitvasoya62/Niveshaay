{{-- <h4>Hello {{ $name }}, </h4>
<div class="">your Password is <b style="color: blue">{{ $password }}<b></div> --}}

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Mail</title>
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            }
            
            a {
                border: 0;
                outline: none;
                text-decoration: none;
                cursor: pointer;
            }
            
            img {
                border: 0;
                outline: none;
                max-width: 100%;
            }
            
            a[x-apple-data-detectors] {
                color: inherit !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            
            
            .mobile-mid-space {
                display: none;
            }
            
            @media only screen and (max-width:600px) {
                .table {
                    width: 100% !important;
                }
                .mobile-image {
                    width: 100% !important
                }
                img {
                    max-width: 100%;
                }
            }
            @media only screen and (max-width:575px){
                .side-space{
                    width: 15px !important;
                }
                .mobile-space{
                    height: 16px !important;
                }
                .small-font{
                    font-size: 24px !important;
                }
                .mble-height{
                    height:20px !important;
                }
            }
            @media only screen and (max-width:480px) {
                .mobile-mid-space {
                    display: block !important;
                    width: 100% !important;
                    height: 15px !important;
                }
                .full {
                    display: block !important;
                    width: 100% !important
                }
                .mobile-inner-space{
                    width: 15px !important;
                }
                .text-center{
                    text-align: center !important;
                }
                .xs-fonts{
                    font-size: 13px !important;
                }
            }
        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" width="600" align="center" class="table" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);background-color: #ffffff;">
            <tbody>
                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                            <tbody>
                                <tr>
                                    <td height="15"></td>
                                </tr>
                                <!-- logo row -->
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td width="20" class="side-space"></td>
                                                    <td align="center"  height="73" width="164" style="height: 73px;width: 164px;">
                                                        <a href="#" title="Niveshaay Logo" height="73" width="164" style="display:block;height: 73px;width: 164px;">
                                                            <img src="{{ $message->embed(base_path() . '/public/images/logo.png') }}" alt="Niveshaay Logo" height="73" width="164" style="display:block;height: 73px;width: 164px;">
                                                        </a>
                                                    </td>
                                                    <td width="20" class="side-space"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30"></td>
                                </tr>
                                <tr>
                                   <td>
                                       <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #fafafa;">
                                            <tbody>
                                                <tr>
                                                    <td width="20" class="side-space"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"  height="80" width="80" style="height: 80px;width: 80px;">
                                                                                        <img src="{{ $message->embed(base_path() . '/public/images/lock-icon.png') }}" alt="Lock Icon" height="80" width="80" style="display:block;height: 80px;width: 80px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" class="small-font" style="font-family: Arial, Helvetica Neue, Helvetica, sans-serif;font-size: 31px;color: #000000;font-weight: 700;line-height: 1.2;">Password</td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="20" class="side-space"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                   </td>
                                </tr>
                                <tr>
                                   <td>
                                       <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td width="20" class="side-space"></td>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="font-family: Verdana;color:#000;font-size: 14px;line-height: 1.2;">Your Password is</td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="15"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <table cellpadding="0" cellspacing="0" border="0" width="205" align="center" style="width:205px;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-family: Verdana;color:#83b645;font-size: 31px;line-height: 1.2;font-weight: 700;text-align: center;letter-spacing:5px">{{$password}}</td>
                                                                                    
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="15"></td>
                                                                </tr>
                                                                {{-- <tr>
                                                                    <td align="center" style="font-family: Verdana;color:rgba(0, 0, 0, 0.5);font-size: 14px;line-height: 1.2;">This OTP is valid for 3 minutes.</td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="font-family: Verdana;color:#000;font-size: 14px;line-height: 1.2;">Please don't share this with anyone for security reasons. </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" class="mble-height"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="20" class="side-space"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                   </td>
                                </tr>
                                <!-- footer row -->
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #83b645;">
                                            <tbody>
                                                <tr>
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="20" class="side-space"></td>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" dir="rtl">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td valign="top" width="119" class="full" dir="ltr">
                                                                                        <table cellpadding="0" cellspacing="0" border="0" align="center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td width="12" class="mobile-inner-space"></td>
                                                                                                    <td width="16" height="16" valign="center" align="center" style="width: 16px;height: 16px;" class="text-center">
                                                                                                        <a href="#" title="instagram" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                            <img src="{{ $message->embed(base_path() . '/public/images/instagram-icon-white.png') }}" alt="instagram-icon-white" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="12" class="mobile-inner-space"></td>
                                                                                                    <td width="17" height="15" valign="center" align="center" style="width: 17px;height: 15px;" class="text-center">
                                                                                                        <a href="#" title="twitter" width="15" height="13" style="width: 15px;height: 13px;display: block;">
                                                                                                            <img src="{{ $message->embed(base_path() . '/public/images/twitter-icon-white.png') }}" alt="twitter-icon-white" width="15" height="13" style="width: 15px;height: 13px;display: block;">
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="12" class="mobile-inner-space"></td>
                                                                                                    <td  width="10" height="18" valign="center" align="center" style="width: 10px;height: 18px;" class="text-center">
                                                                                                        <a href="#" title="facebook"  width="8" height="16" style="width: 8px;height: 16px;display: block;">
                                                                                                            <img src="{{ $message->embed(base_path() . '/public/images/facebook-icon-white.png') }}" alt="facebook-icon-white"  width="8" height="16" style="width: 8px;height: 16px;display: block;">
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="12" class="mobile-inner-space"></td>
                                                                                                    <td width="16" height="16" valign="center" align="center" style="width: 16px;height: 16px;" class="text-center">
                                                                                                        <a href="#" title="linkedin" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                            <img src="{{ $message->embed(base_path() . '/public/images/linkedin-icon-white.png') }}" alt="linkedin-icon-white" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                        </a>
                                                                                                    </td>
                                                                                                    <td width="12" class="mobile-inner-space"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td class="mobile-mid-space" height="15"></td>
                                                                                    <td valign="top" class="full"  dir="ltr">
                                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-center xs-fonts" style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;text-decoration: none !important;">Inquiry: 
                                                                                                        <a  style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;text-decoration: none !important;" x-apple-data-detectors=true href="mailto:info@niveshaay.com" title="mail us">info@niveshaay.com</a></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td height="10" class="hidden-td"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-center xs-fonts" style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.57;">Niveshaay © 2022. All rights reserved.</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table> 
                                                                                    </td>                                                                            
                                                                                </tr>
                                                                            </tbody>
                                                                        </table> 
                                                                    </td>
                                                                    <td width="20" class="side-space"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
    </html>