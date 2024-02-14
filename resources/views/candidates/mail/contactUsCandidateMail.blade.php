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
                            <div class="user-info">
                                Dear {{ @$data['name'] }}
                            </div>
                            <div>
                                <p>
                                    Thank you for reaching out to us! We truly appreciate your interest in {{ settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name") ? ucfirst(settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name")) : "Rapid Hire" }}.
                                    We have received your message and are eager to assist you. Our team is currently reviewing your inquiry and will get back to you as soon as possible. Please expect a response within [timeframe, e.g., 1-2 business days].
                                </p>
                            </div>
                            <div>
                                <p>
                                    In the meantime, if you have any additional information or specific questions you would like to address, please feel free to share them with us. Your input helps us tailor our response to better meet your needs.
                                </p>
                            </div>
                            <div>
                                <p>
                                    Once again, thank you for contacting us. We look forward to connecting with you further and providing you with the assistance you need.
                                </p>
                            </div>
                        </div>
                        <div class="contact-info-container mb-5">
                            <span class="">
                                Best regards,<br>
                                {{ settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name") ? ucfirst(settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name")) : "Rapid Hire" }} Team <br>
                            </span>
                        </div>
                        <div class="copyright-container mt-5">
                            <span class="text-muted fs-6">© Copyright {{ settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name") ? ucfirst(settings()->group(App\Helpers\Constant::ORGANIZATION)->get("name")) : "Rapid Hire" }}. All rights reserved</span>
                        </div>
                        <!-- End New Code -->
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>


</html>
