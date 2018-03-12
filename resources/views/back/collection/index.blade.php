@extends('back.template')

@section('main')

  @include('back.partials.entete', ['title' => trans('back/all.dashboard') . link_to_route('adm_collection.create', trans('back/all.add'), [], ['class' => 'btn btn-info pull-right']), 'icon' => 'pencil', 'fil' => trans('back/all.table')])

    @if(session()->has('ok'))
        @include('partials/error', ['type' => 'success', 'message' => session('ok')])
    @endif

  <div class="row col-lg-12">
    <div class="pull-right link">{!! $links !!}</div>
  </div>

  <div class="row col-lg-12">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>
              {{ trans('back/all.title') }}
              <a href="#" name="title" class="order">
                <span class="fa fa-fw fa-{{ $order->name == 'collections.en_title' ? $order->sens : 'unsorted'}}"></span>
              </a>
            </th>
            <th>
              {{ trans('back/all.date') }}
              <a href="#" name="created_at" class="order">
                <span class="fa fa-fw fa-{{ $order->name == 'collections.created_at' ? $order->sens : 'unsorted'}}"></span>
              </a>
            </th>
            <th>
              {{ trans('back/all.published') }}
              <a href="#" name="collections.active" class="order">
                <span class="fa fa-fw fa-{{ $order->name == 'collections.active' ? $order->sens : 'unsorted'}}"></span>
              </a>
            </th> 
            @if(session('statut') == 'admin')
              <th>
                {{ trans('back/all.author') }}
                <a href="#" name="username" class="order">
                  <span class="fa fa-fw fa-{{ $order->name == 'username' ? $order->sens : 'unsorted'}}"></span>
                </a>
              </th>            
              <th>
                {{ trans('back/all.seen') }}
                <a href="#" name="seen" class="order">
                  <span class="fa fa-fw fa-{{ $order->name == 'collections.seen' ? $order->sens : 'unsorted'}}"></span>
                </a>
              </th>
            @endif
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @include('back.collection.table')
        </tbody>
      </table>
    </div>
  </div>

  <div class="row col-lg-12">
    <div class="pull-right link">{!! $links !!}</div>
  </div>

@endsection

@section('scripts')

  <script>
    
    $(function() {

        // Seen gestion
        $(document).on('change', ':checkbox[name="seen"]', function() {
            $(this).parents('tr').toggleClass('warning');
            $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
            $.ajax({
                url: '{{ url('adm_collectionpostseen') }}' + '/' + this.value,
                type: 'PUT',
                data: "seen=" + this.checked
            })
            .done(function() {
                $('.fa-spin').remove();
                $('input:checkbox[name="seen"]:hidden').show();
            })
            .fail(function() {
                $('.fa-spin').remove();
                chk = $('input:checkbox[name="seen"]:hidden');
                chk.show().prop('checked', chk.is(':checked') ? null:'checked').parents('tr').toggleClass('warning');
                alert('{{ trans('back/all.fail') }}');
            });
        });

        // Active gestion
        $(document).on('change', ':checkbox[name="active"]', function() {
            $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
            $.ajax({
                url: '{{ url('adm_collectionpostactive') }}' + '/' + this.value,
                type: 'PUT',
                data: "active=" + this.checked
            })
            .done(function() {
                $('.fa-spin').remove();
                $('input:checkbox[name="active"]:hidden').show();
            })
            .fail(function() {
                $('.fa-spin').remove();
                chk = $('input:checkbox[name="active"]:hidden');
                chk.show().prop('checked', chk.is(':checked') ? null:'checked').parents('tr').toggleClass('warning');
                alert('{{ trans('back/all.fail') }}');
            });
        });

        // Sorting gestion
        $('a.order').click(function(e) {
            e.preventDefault();
            // Sorting direction
            var sens;
            if($('span', this).hasClass('fa-unsorted')) sens = 'aucun';
            else if ($('span', this).hasClass('fa-sort-desc')) sens = 'desc';
            else if ($('span', this).hasClass('fa-sort-asc')) sens = 'asc';
            // Set to zero
            $('a.order span').removeClass().addClass('fa fa-fw fa-unsorted');
            // Adjust selected
            $('span', this).removeClass();
            var tri;
            if(sens == 'aucun' || sens == 'asc') {
                $('span', this).addClass('fa fa-fw fa-sort-desc');
                tri = 'desc';
            } else if(sens == 'desc') {
                $('span', this).addClass('fa fa-fw fa-sort-asc');
                tri = 'asc';
            }
            var name = $(this).attr('name');
            // Wait icon
            $('.breadcrumb li').append('<span id="tempo" class="fa fa-refresh fa-spin"></span>'); 
            // Send ajax      
            $.get('{{ url('adm_collection/order') }}', { name: name, sens: tri })
            .done(function(data) {
                $('tbody').html(data.view);
                $('.link').html(data.links.replace('adm_collection.(.+)&sens', name));
                $('#tempo').remove();
            })
            .fail(function() {
                $('#tempo').remove();
                alert('{{ trans('back/all.fail') }}');
            });
        })

    });

  </script>

@endsection
