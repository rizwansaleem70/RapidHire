<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: var(--bs-font-sans-serif), Arial, sans-serif;
            background-color: #E6E5E7;
        }

        #body-table {
            width: 100%;
            background-color: #E6E5E7;
        }

        #kt_app_content_container {
            max-width: 600px;
            margin: 0;
            padding: 20px;
            background-color: #FFFFFF;
        }

        .logo-container {
            text-align: center;
            margin-top: 5%;
        }

        .logo-container img {
            width: 100px;
        }

        .greeting-container {
            text-align: left;
        }

        .greeting-container img {
            width: 50px;
            margin-bottom: 10px !important;
        }

        .greeting-container .user-info {
            font-weight: bold;
            font-size: 16px;
            color: #6C757D;
            margin-top: 10px;
        }

        .property-container {
            text-align: center;
            margin-top: 5px;
        }

        .property-container img {
            width: 300px;
        }

        .property-container .property-info {
            font-weight: bold;
            font-size: 14px;
            /*color: #000000;*/
            margin-top: 10px;
        }

        .contact-info-container {
            text-align: left;
            margin-top: 20px;
        }

        .contact-info-container .fs-5 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .contact-info-container .fs-6 {
            font-size: 16px;
            color: #6C757D;
        }

        .social-icons-container {
            display: flex;
            justify-content: center;
            margin-top: 5px;
        }

        .social-icons-container i {
            font-size: 2em;
            margin-right: 10px;
            color: #555;
            /* Icon color */
            cursor: pointer;
        }

        .copyright-container {
            margin-bottom: 10px;
        }

        .copyright-container .fs-6 {
            font-size: 16px;
            color: #6C757D;
        }

        .approval-message {
            text-align: center;
            font-size: 16px;
            color: #6C757D;
            margin-top: 20px;
        }

        .mb2 {
            margin-bottom: 2%;
        }

        .mt-5 {
            margin-top: 10px;
        }
    </style>
    <title>SUBBII</title>
</head>

<body>
    <table id="body-table" align="center" cellspacing="0" cellpadding="0" border="0" style="table-layout:fixed;">
        <tbody>
            <tr>
                <td align="center">
                    <div id="kt_app_content_container">
                        <div class="container">
                            <img alt="Logo"
                                src="{{ asset('images/banner.jpg') }}"
                                width="100%">
                        </div>

                        <div class="greeting-container">
                            {{--  <img alt="Logo" src="{{settings()->group('logo')->get("logo") ? asset(settings()->group('logo')->get("logo")):asset('rapidhire.png')}}"
                                style=" width: 200px;">  --}}
                            <div>
                                <p>
                                    {{ $data['massage'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>


</html>
