
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niveshaay Newsletter</title>
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
        
        .black-text {
            color: #000 !important;
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
            .hidden-td{
                display: none;
            }
            .has-date{
                width: 200px !important;
                font-size: 12px !important;
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
                                                        <img src="{{ asset('images/logo.png') }}" alt="Niveshaay Logo" height="73" width="164" style="display:block;height: 73px;width: 164px;">
                                                    </a>
                                                </td>
                                                <td width="20" class="side-space"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="15"></td>
                            </tr>
                            <!-- banner row -->
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="600" height="auto" style="width: 600px; height: auto; display: block;" class="mobile-image">
                                                    <img src="{{ asset('images/newsletter/'.$newsletter->banner)}}" alt="niveshaay-newsletter-banner" width="600" height="auto" style="width: 600px; height: auto; display: block;" class="mobile-image">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- date row -->
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="415"></td>
                                                <td width="25" height="31" style="width: 25px ;height: 31px ;text-align: right;background-color: #83b645;">
                                                    <img src="{{ asset('images/button-shape-new.png')}}" alt="button-shape" width="25" height="33" style="width: 25px ;height: 33px ;display: block;">
                                                </td>
                                                <td width="10" style="background-color: #83b645;"></td>
                                                <td width="150" class="has-date" style="font-family: Verdana;background-color:#83b645;width: 150px;color:#fff;font-size: 13px;">{{ date('F d, Y',strtotime($newsletter->date)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- content block 1 -->
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
                                                                <td>{!! $newsletter->editor_top !!}</td>
                                                            </tr>
                                                            {{-- <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: Verdana;font-size: 16px;color: #000;font-weight: 400;line-height: 1.38;font-style: italic;">Lorem ipsum</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">
                                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis
                                                                    orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td  style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="25" class="mobile-space"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: Verdana;font-size: 18px;color: #83b645;font-weight: 700;line-height: 1.22;">Lorem ipsum dolor sit amet, </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus</td>
                                                            </tr> --}}
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
                                <td height="25"  class="mobile-space"></td>
                            </tr>
                            <!-- side by side content block -->
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" class="full" style="background-color:#f2f8ec;">
                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="20" class="side-space"></td>
                                                                <td>
                                                                    {!! $newsletter->editor_left !!}
                                                                    {{-- <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>    
                                                                                <td height="25" class="mobile-space"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Verdana;font-size: 18px;color: #83b645;font-weight: 700;line-height: 1.22;">Lorem ipsum dolor sit amet, </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="15"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.57;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>     
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #333;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="30" class="mobile-space"></td> 
                                                                            </tr>
                                                                        </tbody>
                                                                    </table> --}}
                                                                </td>
                                                                <td width="10" class="side-space"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table> 
                                                    
                                                </td>
                                                <td valign="top" class="full" style="background-color: #83b645;">
                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="10" class="side-space"></td>
                                                                <td>
                                                                    {!! $newsletter->editor_right !!}
                                                                    {{-- <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>    
                                                                                <td height="25" class="mobile-space"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Verdana;font-size: 18px;color:#fff;font-weight: 700;line-height: 1.22;">Lorem ipsum dolor sit amet, </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="15"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="15"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet,</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="12"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign="top" style="color:#fff;">&bull;</td>
                                                                                                <td width="5"></td>
                                                                                                <td style="font-family: Verdana;font-size: 14px;color: #fff;font-weight: 400;line-height: 1.14;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table> 
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="30" class="mobile-space"></td> 
                                                                            </tr>
                                                                        </tbody>
                                                                    </table> --}}
                                                                </td>
                                                                <td width="20" class="side-space"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table> 
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                </td>
                            </tr>                    
                             <!-- content block 2 -->
                             {{-- <tr>
                                <td height="30" class="mobile-space"></td>
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
                                                                <td style="font-family: Verdana;font-size: 18px;color: #83b645;font-weight: 700;line-height: 1.22;">Lorem ipsum dolor sit amet, </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="color:#83b645;">&bull;</td>
                                                                                <td width="5"></td>
                                                                                <td style="font-family: Verdana;font-size: 14px;color: #3b3b3b;font-weight: 400;line-height: 1.14;">
                                                                                    Lorem ipsum dolor sit amet, con <span style="font-family: Verdana;font-size: 14px;color:#83b645;text-decoration:underline;font-weight: 400;line-height: 1.14;">
                                                                                        <a href="#" x-apple-data-detectors=true title="sectetur adipiscing" style="font-family: Verdana;font-size: 14px;color:#83b645;text-decoration:underline;font-weight: 400;line-height: 1.14;">sectetur adipiscing</a>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table> 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" style="color:#83b645;line-height: 1.64;">&bull;</td>
                                                                                <td width="5"></td>
                                                                                <td style="font-family: Verdana;font-size: 14px;color: #3b3b3b;font-weight: 400;line-height: 1.64;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse</td>
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
                             </tr> --}}
                             <tr>
                                <td> {!! $newsletter->editor_bottom !!}</td>
                             </tr>
                             <tr>
                                 <td height="25" class="mobile-space"></td>
                             </tr>
                             <!-- footer image row -->
                             {{-- <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="600" height="auto" style="width: 600px; height: auto; display: block;" class="mobile-image">
                                                    <img src="http://new.anasource.com/team8/niveshaay-newsletter/images/newsletter-footer-image.jpg" width="600" height="auto" style="width: 600px; height: auto; display: block;" class="mobile-image">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr> --}}
                            <!-- content block 3 -->
                            {{-- <tr>
                                <td height="25" class="mobile-space"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td width="20" class="side-space"></td>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="font-family: Verdana;font-size: 18px;color: #83b645;font-weight: 700;line-height: 1.22;">Lorem ipsum dolor sit amet, </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="15"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td  style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family: Verdana;font-size: 14px;color: #000;font-weight: 400;line-height: 1.57;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="20" class="side-space"></td>
                                        </tr>
                                    </table>
                                </td>
                                
                            </tr>
                            <tr>
                                <td height="30" class="mobile-space"></td>
                            </tr> --}}
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
                                                                                                        <img src="{{ asset('images/instagram-icon-white.png') }}" alt="instagram-icon-white" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td width="12" class="mobile-inner-space"></td>
                                                                                                <td width="17" height="15" valign="center" align="center" style="width: 17px;height: 15px;" class="text-center">
                                                                                                    <a href="#" title="twitter" width="15" height="13" style="width: 15px;height: 13px;display: block;">
                                                                                                        <img src="{{ asset('images/twitter-icon-white.png') }}" alt="twitter-icon-white" width="15" height="13" style="width: 15px;height: 13px;display: block;">
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td width="12" class="mobile-inner-space"></td>
                                                                                                <td  width="10" height="18" valign="center" align="center" style="width: 10px;height: 18px;" class="text-center">
                                                                                                    <a href="#" title="facebook"  width="8" height="16" style="width: 8px;height: 16px;display: block;">
                                                                                                        <img src="{{ asset('images/facebook-icon-white.png') }}" alt="facebook-icon-white"  width="8" height="16" style="width: 8px;height: 16px;display: block;">
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td width="12" class="mobile-inner-space"></td>
                                                                                                <td width="16" height="16" valign="center" align="center" style="width: 16px;height: 16px;" class="text-center">
                                                                                                    <a href="#" title="linkedin" width="14" height="14" style="width: 14px;height: 14px;display: block;">
                                                                                                        <img src="{{ asset('images/linkedin-icon-white.png') }}" alt="linkedin-icon-white" width="14" height="14" style="width: 14px;height: 14px;display: block;">
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