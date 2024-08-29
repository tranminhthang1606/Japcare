<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico"
          type="image/x-icon">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;display=swap" rel="stylesheet">

    <style type="text/css">
        .back {
            text-align: center;
            width: 650px;
            font-family: 'Open Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
            margin: 0 auto;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        p {
            margin: 15px 0;
        }

        h5 {
            color: #444;
            text-align: left;
            font-weight: 400;
        }

        .text-center {
            text-align: center
        }

        .main-bg-light {
            background-color: #fafafa;
        }

        .title {
            color: #444444;
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 0;
            text-transform: uppercase;
            display: inline-block;
            line-height: 1;
        }

        table {
            margin-top: 30px
        }

        table.top-0 {
            margin-top: 0;
        }

        table.order-detail,
        .order-detail th,
        .order-detail td {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }

        .order-detail th {
            font-size: 16px;
            padding: 15px;
            text-align: center;
        }

        .footer-social-icon tr td img {
            margin-left: 5px;
            margin-right: 5px;
        }

    </style>
</head>
<div id="main"
     style="display: block; margin-top: -30px; text-align: center;">
    <div class="back">
        <table align="center" border="0" cellpadding="0" cellspacing="0"
               style="padding: 0 30px;background-color: #f8f9fa; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
            <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>
                                <img src="{{ asset('frontend/images/Logo-01.png') }}" alt=""
                                     style=";margin-bottom: 30px; width:250px">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="title">Cảm ơn bạn đã mua hàng của ADT store</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Thông tin cập nhật lại mật khẩu của bạn như sau .</p>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <div style="border-top:1px solid #777;height:1px;margin-top: 30px;"> </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>
                                <h2 class="title">Hãy kích vào <a href="{{route('showResetPasswordForm', ['token' => $token])}}" class="">đây</a> để cập nhật lại mật khẩu</h2>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0"
               width="100%">
            <tbody>
            <tr>
                <td style="padding: 30px;">
                    <div>
                        <h4 class="title" style="margin:0;text-align: center;">Theo dõi chúng tôi để đón
                            nhận các thông tin mới nhất</h4>
                    </div>
                    <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon" align="center"
                           style="margin-top:20px;">
                        <tbody>
                        <tr>
                            <td>
                                <a href="{{ env('APP_URL') }}">
                                    <img src="{{ asset('frontend/images/Logo-01.png') }}" alt="">
                                </a>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                    <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;">
                        <tbody>
                        <tr>
                            <td>
                                <a href="{{ env('APP_URL') }}" style="font-size:13px">Hãy đến mua sắm và tận
                                    hưởng</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size:13px; margin:0;">ADT Store</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

</html>
