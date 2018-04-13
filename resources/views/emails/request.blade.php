<html>
    <head></head>
    <body>
        <h3>New application from the site http://trois-couronnes.ch/ to subscribe!</h3>
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