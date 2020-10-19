<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="{{ $url }}" class="button button-{{ $color or 'blue' }}" target="_blank" style="background:linear-gradient(to right, rgb(21, 153, 87), rgb(21, 87, 153))!important;color: white;border-top: 0;border-right: 0;border-bottom: 0;border-left: 0;padding: 12px;">{{ $slot }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
