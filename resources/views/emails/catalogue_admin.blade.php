<html>
    <head></head>
    <body>
        <h3>Номер гарантии с сайта http://trois-couronnes.ch/</h3>
        <table>
            @foreach($needed as $key=>$field)
                @if (isset($fields[$key]))
                    <tr>
                        <td>{{ $field }}: </td>
                        <td>{{ $fields[$key] }}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </body>
</html>