@foreach ($testblocks as $post)
    <tr {!! !$post->seen && session('statut') == 'admin'? 'class="warning"' : '' !!}>
        <td class="text-primary"><strong>{{ $post->en_title }}</strong></td>
        <td>{{ $post->created_at }}</td> 
        <td>{!! Form::checkbox('active', $post->id, $post->active) !!}</td>
        @if(session('statut') == 'admin')
            <td>{{ $post->username }}</td>
            <td>{!! Form::checkbox('seen', $post->id, $post->seen) !!}</td>
        @endif
        <td>{!! link_to('testblock/' . $post->slug, trans('back/testblock.see'), ['class' => 'btn btn-success btn-block btn']) !!}</td>
        <td>{!! link_to_route('testblock.edit', trans('back/testblock.edit'), [$post->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
        <td>
            {!! Form::open(['method' => 'DELETE', 'route' => ['testblock.destroy', $post->id]]) !!}
                {!! Form::destroyBootstrap(trans('back/testblock.destroy'), trans('back/testblock.destroy-warning')) !!}
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach