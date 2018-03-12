@foreach ($items as $post)
    <tr {!! !$post->seen && session('statut') == 'admin'? 'class="warning"' : '' !!}>
        <td class="text-primary"><strong>{{ $post->en_title }}</strong></td>
        <td>{{ $post->created_at }}</td> 
        <td>{!! Form::checkbox('active', $post->id, $post->active) !!}</td>
        @if(session('statut') == 'admin')
            <td>{{ $post->username }}</td>
            <td>{!! Form::checkbox('seen', $post->id, $post->seen) !!}</td>
        @endif
        <td>{!! link_to('adm_customerservice/' . $post->slug, trans('back/all.see'), ['class' => 'btn btn-success btn-block btn']) !!}</td>
        <td>{!! link_to_route('adm_customerservice.edit', trans('back/all.edit'), [$post->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
        <td>
            {!! Form::open(['method' => 'DELETE', 'route' => ['adm_customerservice.destroy', $post->id]]) !!}
                {!! Form::destroyBootstrap(trans('back/all.destroy'), trans('back/all.destroy-warning')) !!}
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach