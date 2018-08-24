<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>::Sci-fi Cafe::</title>
    </head>
    <body>
        <table style="max-width: 750px; width: 100%; margin: 0 auto; border-collapse: collapse; border: none; font-family:verdana; background-color: #fff; border: transparent;">
            <tr>
                <td style="width: 50%; padding: 15px 30px; background-color: #272727;"><img src="{{ URL::asset('themes/mail/mail-logo.png')}}" alt="" /></td>
                <td style="width: 50%; padding: 15px 30px; background-color: #272727; text-align: right; color:#CCCCCC">{{date_format(new DateTime(date('Y-m-d')), 'F d, Y')}}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <div style="padding: 30px 0px; background-color: #fff;">
                        <?php
                        if (isset($content)) {
                            echo $content;
                        } else {
                            ?>
                            [[CONTENT]]
                            <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; background-color:#fff;">
                    <div style="padding: 15px 30px 15px; text-align: left; background-color: #fff; width: 41%;  display: inline-block;">
                        <div style="text-align: left; color: #666; padding-bottom: 5px; font-size: 14px; ">Thanking You</div>
                        <div style="text-align: left; color: #666; padding-bottom: 15px; font-size: 14px; font-weight: bold;">Sci-fi Cafe</div>
                    </div>
                    <div style="text-align: left; font-size: 12px;color: #666; background-color: #fff; width: 41%; display: inline-block; padding: 15px 30px 15px;">
                        <div style="padding: 0px 15px; ">
                            <table>
                                <tr>
                                    <td><img src="{{ URL::asset('themes/mail/mail-phone.png')}}" alt="" style="position: relative; top: 12px;" /></td>
                                    <td>{{get_settings_by_slug('site_phone')}}</td>
                                </tr>
                            </table>

                        </div>
                        <div style="padding: 0px 15px;">
                            <table>
                                <tr>
                                    <td><img src="{{ URL::asset('themes/mail/mail-email.png')}}" alt="" style="position: relative; top: 12px;" /> </td>
                                    <td>{{get_settings_by_slug('site_email')}}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <div style="padding: 30px 0px; background-color: #17293f; background-image: url({{ URL::asset('themes/mail/ft-img.png')}}); background-size:cover;">
                        <div style="text-align: center; color: #fff; padding-bottom: 10px; font-size: 12px;">Copyright &copy; 2018 . All rights reserved.</div>
                        <div style="text-align: center; color: #fff; padding-bottom: 15px; font-size: 12px;">Terms and Conditions |  Privacy Policy </div>
                        <div style="">
                            <a href="{{get_settings_by_slug('facebook_url')}}"><img src="{{ URL::asset('themes/mail/mail-facebook.png')}}" alt=""  style="padding: 0px 5px;"/></a>
                            <a href="{{get_settings_by_slug('twitter_url')}}"><img src="{{ URL::asset('themes/mail/mail-twitter.png')}}" alt="" style="padding: 0px 5px;" /></a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>
