<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            background-color: #edf2f7;
        }
    </style>
</head>
<body>
    <div id="tudo" style="padding:50px">
        <div style="
            background:#fff; 
            max-width:590px; 
            width:100%;
            padding:30px;
            margin:15px auto 15px auto;
            font-family:Arial, Helvetica, sans-serif; font-weight:bold; 
            color:#383838;
            font-size:13px;
            ">
            <table width="100%" align="center">
                <tr>
                    <td align="center">
                        <img src="{{asset($logo)}}" width="auto" height="70" />
                    </td>
                </tr>
            </table>
            <div style="background: #6B6B6B; margin-top:15px; height: 3px; width: 100%; margin-bottom:15px"></div>
            <table width="100%">
                <tr>
                    <td align="center" style="">

                        @yield('icon')


                    </td>
                </tr>
            </table>

            @yield('content')

        </div>

        <table width="100%">
            <tr>
                <td align="center" style="font-family:'Open Sans',sans-serif; font-size:10px; font-weight:100;padding:30px">
                    <p><img src="{{asset('img/logo.png')}}" width="auto" height="20"/></p>
                    <p>dvelopers.com.br<br/>
                        Copyright © {{date('Y')}} Dvelopers<br/>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>