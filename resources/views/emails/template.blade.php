<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="x-apple-disable-message-reformatting"/>
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap");

        #outlook a {
            padding: 0;
        }

        /* / Force Outlook to provide a "view in browser" menu link. / */
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: Open Sans, Arial, Helvetica, sans-serif;
        }

        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/
        .ExternalClass {
            width: 100%;
        }

        /* / Force Hotmail to display emails at full width / */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        /* / Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ / */
        /* / End reset / */

        * {
            padding: 0;
            margin: 0;
            font-family: "Quicksand", sans-serif;
        }

        @media (max-width: 600px) {
            .d-table {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .d-block {
                display: block;
            }

            .d-none {
                display: none;
            }

            .table-row {
                display: block !important;
                width: 100%;
                box-sizing: border-box;
            }

            .table-row-half {
                width: 50%;
                box-sizing: border-box;
                display: inline-block;
            }

            #movil, #correo {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
<center>
    <table id="wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
           style="max-width: 600px; background-color: rgba(222,212,207,0.84);">
        <tr style="background-color:#e37f81">
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr style="padding-bottom: 30px;">
                        <td align="center" valign="middle" style="padding-top: 40px;  padding-bottom: 40px;">
                            <a href="{{route('/')}}" target="_blank">
                                <img src="{{$message->embed($logo)}}" width="177px" alt="logo filmxtra"
                                     style="display: block;"/>
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                    {{--La imagen de fondo no carga en desarrollo, creo que por la url generada en relacion al css--}}
                       style="background-image: url('/images/posters-fondo.png'); background-repeat: no-repeat; background-position: center bottom; ">
                    {{--Contenido específico del email--}}
                    <tr>
                        <td  style="padding: 30px 40px 0px 40px;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 40px 40px 40px;">
                            <p style="color: #2a4467; font-weight: 300;">
                                Saludos,
                                <a href="{{route('/')}}" target="_blank" style="text-decoration: none; color: #1d9cd8; font-weight: 700;">Filmxtra</a>
                                <br/><br/>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="100%" height="153px">
                <table id="footer" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="153px"
                       style="background-repeat: no-repeat; background-position: center center; background-color: #e37f81;">
                    <tr>
                        <td style="padding-top: 25px;">
                            <p style="text-align: center; font-size: 14px; font-weight: 500; color: white; margin-bottom: 15px">
                                <a href="{{route('/')}}" target="_blank" style="text-decoration: none; color: #000000; font-weight: 700;">www.filmxtra.es</a>
                                <br>
                                <br>
                                Copyright (c) 2023 Filmxtra.
                                Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
