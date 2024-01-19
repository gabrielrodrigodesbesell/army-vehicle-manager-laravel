@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa-fw fas fa-exchange-alt"></i> Últimas entradas e saídas
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Data e hora</th>
                                            <th>Operação</th>
                                            <th>Destino</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($io['pessoas'] as $key => $value)
                                        <tr>
                                            <td><i class="fa-fw fas fa-user"></i> </i> {{$value->name}}</td>
                                            <td>{{$value->data_hora}}</td>
                                            <td style="color:@if($value->operacao =='1') green @else red @endif">
                                                @if($value->operacao =='1')
                                                Entrada
                                                @else
                                                Saída
                                                @endif
                                            </td>
                                            <td>{{$value->destino}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($io['veiculos'] as $key => $value)
                                        <tr>
                                            <td><i class="fa-fw fas fa-truck-moving"></i> {{$value->descricao}} - {{$value->placa}}</td>
                                            <td>{{$value->data_hora}}</td>
                                            <td style="color:@if($value->operacao =='1') green @else red @endif">
                                                @if($value->operacao =='1')
                                                Entrada
                                                @else
                                                Saída
                                                @endif
                                            </td>
                                            <td>{{$value->descricao}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection