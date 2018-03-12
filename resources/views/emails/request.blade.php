<html>
    <head></head>
    <body>
        <h1>Новая заявка!</h1>
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