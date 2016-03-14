<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
</head>
<style>
</style>

<body cz-shortcut-listen="true">

    <div>
        <div class="adM">

        </div>
        <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" border="0">
            <tbody>
                <tr height="5" bgcolor="#3498DB">
                    <td></td>
                </tr>
                <tr>
                    <td style="font-size:0;line-height:0;padding:0 10px" height="90" align="center" bgcolor="#145D8E">
                        <img src="http://shicosoft.com/public/themes/uploads/logo.png" alt="" class="CToWUd">
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#145D8E" border="0">
            <tbody>
                <tr>
                    <td>
                        <table style="background-color:#ffffff;border-collapse:collapse;border-color:#dddddd;border-style:solid;border-top-left-radius:5px;border-top-right-radius:5px;border-width:1px;color:#525252" width="640" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" border="0">

                            <tbody>
                                <tr>
                                    <td style="font-size:0;line-height:0" height="10">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:15px 10px 0px">
                                        <div style="font-size:17px;font-weight:bold">Hi,</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="padding:10px 10px 0px">

                                        <table width="100%" cellpadding="0" cellspacing="0" align="left" border="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h3 style="margin-top:10px;padding-bottom:5px;border-bottom:1px solid #ddd;margin-bottom:3px"><strong>You have Received a new File/s
</strong></h3> <b>From : {{ $data['senderEmail'] }}</b>
                                                    </td>
                                                </tr>
                                                <tr>

                                                </tr>
                                            </tbody>
                                        </table>


                                    </td>
                                </tr>

                                <tr>
                                    <td>

    <div style="margin: 10px auto;
  width: 96%;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  display: table;" class="table">

        <div style="  display: table-row;background: #2980b9;color:#fff;">
            <div style="padding: 6px 12px;display: table-cell;">
                File Name
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                File Type
            </div>            
            <div style="padding: 6px 12px;display: table-cell;">
                File Size
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                Password
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                File Link
            </div>
        </div>
                                                                                                    @foreach($data['files'] as $key=>$file)

        <div style="display:table-row;background: #f6f6f6;" class="row">
            <div style="padding: 6px 12px; display: table-cell;">
                {{ mb_substr($file->fileName,0,15,"utf-8") }}
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                {{ $file->fileExt }}
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                {{ formatFileSize( $file->fileSize ) }}
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
            @if(DB::table('lockedfiles')->where('fileId',$file->id)->count() == 0)
                No
            @else
                Yes
            @endif
            </div>
            <div style="padding: 6px 12px;display: table-cell;">
                <a target="_blank" style="text-decoration:underline;
                font-size:14px;" href="{{ $file->filePath }}">
                    Download Link
                </a>            
            </div>
        </div>
        
@endforeach

        </div>


                                    </td>
                                </tr>
                                <tr>


                                    <td>

                                        <table style="border-top:1px solid #dddddd" width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size:0;line-height:0" height="15">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:tahoma;padding:0 10px">Regards,</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:tahoma;padding:0 10px">
                                                        {{ Settings::find(1)->sitename }} Team
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:0;line-height:0" height="15">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr height="130" align="center">
                    <td>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>

                                    <td><a style="color:#fff;text-decoration:none;font-size:12px" href="{{ Social::find(1)->facebookLink }}" target="_blank">Visit us on Facebook</a>
                                    </td>
                                    <td style="padding:0 15px">|</td>
                                    <td style="padding:0 5px">
                                        <a href="https://twitter.com/tasmeemME" target="_blank">

                                        </a>
                                    </td>
                                    <td><a style="color:#fff;text-decoration:none;font-size:12px" href="{{ Social::find(1)->twitterLink }}" target="_blank">Follow us on Twitter</a>
                                    </td>
                                    <td style="padding:0 15px">|</td>
                                    <td style="padding:0 5px">
                                        <a href="mailto:{{ Settings::find(1)->email }}" target="_blank">

                                        </a>
                                    </td>
                                    <td><a style="color:#FFF;text-decoration:none;font-size:13px" href="mailto:{{ Settings::find(1)->email }}" target="_blank">Email us</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>

                                    <td>
                                        <p style="color:#fff;font-size:12px">All Rights Reserved © {{ Settings::find(1)->sitename }}.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>



</body>

</html>