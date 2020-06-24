@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    @auth
        <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fa fa-check"></i>
                        </button>
                        {{--@csrf--}}
                    </div>
                </div>
                <div class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id  }})">
                            <i class="fa fa-edit"></i>
                        </button>
                    @endauth
                    <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="fa fa-external-link"></i>
                    </a>
                    @auth
                        <form action="/series/{{$serie->id}}" method="post"
                              onsubmit="return confirm('Deseja realmente excluir esta série?')">
                            @csrf
                            @Method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </li>
        @endforeach
    </ul>
    <script>
        function toggleInput(serieId){
            const nomeSerieEl = document.getElementById('nome-serie-'+serieId);
            const inputSerieEl = document.getElementById('input-nome-serie-'+serieId);
            if (nomeSerieEl.hidden){
                inputSerieEl.setAttribute('hidden', 'hidden');
                nomeSerieEl.hidden = false;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;

            }
        }

        function editarSerie(serieId) {
            const nome = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const token = document.querySelector('input[name=_token]').value;

            let formData = new FormData();
            formData.append('nome', nome);
            formData.append('_token', token);

            const url = `/series/${serieId}/editaNome`;
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                document.getElementById('nome-serie-'+serieId).textContent = nome;
                toggleInput(serieId);
            });
        }
    </script>
@endsection
