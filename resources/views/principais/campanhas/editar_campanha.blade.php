@extends('layouts.main')

@section('titulo', 'Edição de campanha | HelpHere')

@section('conteudo')

    <div class="container">


        {{-- Formulário --}}
        <div class="container">

            {{-- Título --}}

            <div class="row mt-3 mb-3">
                <div class="col-sm-4">
                    <div class="container p-3 bg-white shadow rounded">

                        <h3>
                            Editando
                            {{ $campanha->nome }}
                        </h3>
                        <form action="/campanha/update/{{ $campanha->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="nome" class="mt-3">Nome da campanha</label>
                            <input type="text" name="nome" id="nome" value="{{ $campanha->nome }}"
                                class="form-control" oninput="nome_att()">

                            <label for="categoria" class="mt-3">Categoria</label>
                            <select name="id_categoria" id="categoria" class="form-select">
                                @foreach ($categorias as $categoria)
                                    @if ($campanha->id_categoria == $categoria->id)
                                        <option value="{{ $categoria->id }}" selected>{{ $categoria->categoria }}
                                        </option>
                                    @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                    @endif
                                @endforeach
                            </select>


                            <label for="tel" class="mt-3">Telefone de contato</label>
                            <input type="tel" name="telefone" id="tel" value="{{ $campanha->telefone }}"
                                class="form-control">


                            <label for="email" class="mt-3">E-mail de contato</label>
                            <input type="email" name="email" id="email" value="{{ $campanha->email }}"
                                class="form-control">



                            <label for="voluntarios" class="mt-3">Precisa de voluntários?</label>
                            <input type="checkbox" name="voluntarios" id="voluntarios" onclick="AtivaEndereco()"
                                @if ($campanha->endereco !== null)
                            checked
                            @endif
                            >

                            <div id="div_endereco" @if ($campanha->endereco === null)
                                style="display: none"
                                @endif>
                                <label for="tel" class="mt-3">Endereço do local:</label>
                                <input type="text" name="endereco" id="endereco" value="{{ $campanha->endereco }}"
                                    class="form-control">
                            </div>

                            <label for="data_fim" class="mt-3">Data de fim da campanha</label>
                            <input type="date" name="data_fim" id="data_fim" value="{{ $campanha->data_fim }}">
                            <br>

                            <label for="image" class="mt-3">Imagem de capa:</label>
                            <input type="file" name="image" id="image" onchange="validateCapa()" class="form-control"
                                accept="image/*">

                            <label for="descricao" class="mt-3">Descrição da instituição:</label><br>
                            <textarea name="descricao" id="descricao"
                                class="form-control">{{ $campanha->descricao }}</textarea>

                            <button type="submit"
                                class="btn bg-verde-agua w-100 text-white mt-3 rounded-pill"><b>Salvar</b></button>

                        </form>
                    </div>

                </div>


                <div class="col-sm-8">

                    {{-- Topo perfil do usuário --}}
                    <div class="container bg-white rounded shadow w-100 text-center p-3">

                        <h3>Preview da campanha</h3>
                        <hr>
                        <div class="container">
                            <img src="{{ $campanha->img_path }}" class="w-100 rounded-bottom"
                                style="width: 800; height: 300px; object-fit: cover;" id="preview">
                        </div>

                        <div class="container p-3">

                            <h1 id="nome_preview">{{$campanha->nome}}</h1>
                            <p class="text-muted">Campanha</p>

                            <div class="container text-center">
                                <a href="#">
                                    <ion-icon name="create-outline"></ion-icon>Editar
                                </a>
                            </div>

                        </div>
                        <div class="container p-3">
                            <hr>
                            <div class="row">
                                {{-- Coluna 1 --}}
                                <div class="col-sm p-1">
                                    <button class="btn bg-verde-agua w-100 p-3 text-white rounded-pill">
                                        <b>Apoiar causa</b>
                                    </button>
                                </div>
                                {{-- Coluna 2 --}}
                                <div class="col-sm p-1">
                                    <button class="btn btn-info w-100 p-3 text-white rounded-pill">
                                        <b>Compartilhar</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Script para carregar preview da imagem de capa --}}
        <script>
            function validateCapa() {
                var fileName = document.getElementById("image").value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" ) {
                    var output = document.getElementById('preview');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                    }
                } else {
                    alert("Somente imagens com extensão .jpg, .jpeg e .png  são permitidas!");
                    document.getElementById("image").value = '';
                }
            }

            function AtivaEndereco() {
                const elemento = document.getElementById('div_endereco')

                if (elemento.style.display === 'none') {
                    elemento.style.display = 'block'
                } else {
                    elemento.style.display = 'none'
                    document.getElementById('endereco').value = null
                }
            }

            function nome_att(){
                document.getElementById("nome_preview").innerText = document.getElementById('nome').value;
            }   
        </script>

    @endsection
