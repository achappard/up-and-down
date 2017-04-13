@extends('layouts.email')

@section('content')
<!-- start textbox-with-title -->
<table width="100%" bgcolor="#e8eaed" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                        <tbody>
                                        <!-- Title -->
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:normal; color: #333333; text-align:left;line-height: 24px;">
                                                <strong style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;">{{ $sender_name  }}</strong> vous a envoyé un fichier :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:normal; color: #333333; text-align:left;line-height: 24px;">
                                                <ul>
                                                    <li><a href="{{ $download_link }}" style="color: #3f9fff;text-decoration:none;font-weight:bold; ">{{ $file_name }}</a> <small>({{ $file_size }})</small></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- End of Title -->
                                        <!-- Spacing -->
                                        <tr>
                                            <td width="100%" height="15"></td>
                                        </tr>
                                        <!-- Spacing -->
                                        <!-- content -->
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p style="padding: 12px; background: #f2f6f8;font-style: italic; font-size:14px; margin: 10px 0px ">{!! $sender_message  !!} </p>
                                            </td>
                                        </tr>

                                        <!-- End of content -->
                                        <!-- Spacing -->
                                        <tr>
                                            <td width="100%" height="15"></td>
                                        </tr>
                                        <!-- Spacing -->
                                        <!-- big button -->
                                        <tr>
                                            <td width="100%">
                                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                                    <tr>
                                                        <td width="25%">&nbsp;</td>
                                                        <td width="50%" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;">
                                                            <a href="{{ $download_link }}" style="background-color: #fff;border:1px solid #3f9fff;color: #3f9fff;padding:6px 12px;text-decoration:none;font-weight:bold; display: block; text-align: center;border-radius: 20px;  moz-border-radius: 50%; khtml-border-radius: 20px; o-border-radius: 20px; webkit-border-radius: 20px; ms-border-radius: 20px;">
                                                                Télécharger ce fichier
                                                            </a>
                                                            @if ( $file_expiration_date )
                                                                <p>
                                                                <small>Lien valable jusqu'au {{ $file_expiration_date }}</small>
                                                                </p>
                                                            @endif
                                                        </td>
                                                        <td width="25%">&nbsp;</td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                        <!-- /bigbutton -->
                                        <!-- Spacing -->
                                        <tr>
                                            <td width="100%" height="20"></td>
                                        </tr>
                                        <!-- Spacing -->
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
        </td>
    </tr>
    </tbody>
</table>
<!-- end of textbox-with-title -->
@endsection