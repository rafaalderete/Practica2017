@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Tipos de Trabajo | Listado de Tipos de Trabajo')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Tipos de Trabajo</a></li>
        <li><a>Listado de Tipos de Trabajo</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row">
    <!-- Box -->
    <div class="box" style="margin-top: -20px">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <!-- Titulo del Cuerpo del Box -->
        <h4 class="page-header">Listado de Tipos de Trabajo
        @if(Entrust::can('crear_tipo_trabajo'))
          <a href="{{ route('in.tipo_trabajo.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right btn-registrar-2">
            <span><i class="fa fa-plus"></i></span>
            Registrar Tipo de Trabajo
          </a>
        @endif
        </h4>
        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')
        <!-- Tabla -->
        <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
          <!-- columnas de la tabla -->
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Tipo Trabajo</th>
              <th>Estado</th>
              <th style="width:75px">Acción</th>
            </tr>
          </thead>
          <!-- contenido de la tabla -->
          <tbody>
            @foreach( $tipos_trabajo as $tipo_trabajo)
              <tr>
                <td>{{ $tipo_trabajo->id }}</td>
                <td>{{ $tipo_trabajo->nombre_tipo_trabajo }}</td>
                <td>{{ $tipo_trabajo->estado }}</td>
                <!-- envio el parametro del metodo edit y destroy-->
                <td>
                  @if(Entrust::can('modificar_tipo_trabajo'))
                    <a href="{{ route('in.tipo_trabajo.edit', $tipo_trabajo->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                  @endif
                  @if(Entrust::can('eliminar_tipo_trabajo'))
                    {!! Form::open(['route' => ['in.tipo_trabajo.destroy', $tipo_trabajo->id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Tipo Trabajo"
                      data-message="¿Seguro que quiere eliminar el Tipo Trabajo {{$tipo_trabajo->nombre_tipo_trabajo}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                    {!! Form::close() !!}
                  @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

@endsection

@section('bodyJS')

  <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('plugins/datatables/ZeroClipboard.js')}}"></script>
  <script src="{{asset('plugins/datatables/TableTools.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>

  <script type="text/javascript">

    $(document).ready(function(){

      //Modal
      $('#delSpk').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
      });
      $('#delSpk').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
      });

      // Tabla
      $('#dev-table').dataTable( {
        "bStateSave": "false",
        "aaSorting": [[ 0, "asc" ]],
        "sDom": "<'pull-left'f><'pull-right'l>rt<'text-center'p>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     '<select><option value="5">5</option>'+
          '<option value="10">10</option>'+
          '<option value="25">25</option></select>',
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "",
          "sInfo":           "",
          "sInfoEmpty":      "",
          "sInfoFiltered":   "",
          "sInfoPostFix":    "",
          "sSearch":         "",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  "",
            "sSortDescending": ""
          }
        },
      });

      // Multiseletc para la tabla
      $('select').select2();
      $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Buscar');
      });
    });

  </script>

@endsection
