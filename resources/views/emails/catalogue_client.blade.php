<html>
    <head></head>
    <body>
        <h3>Thank you! your code is accepted. Sincerely, Company trois-couronnes.ch!</h3>
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
        <a href="http://trois-couronnes.ch/" >http://trois-couronnes.ch/</a>
    </body>
</html>