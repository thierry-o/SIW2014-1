@extends('template')

@section('contenu')

    <br>

    <div class="col-sm-offset-3 col-sm-6">

        <div class="panel panel-info">

            <div class="panel-heading">Contactez-moi</div>

            <div class="panel-body"> 

                {{ Form::open(array('url' => 'contact/form')) }}

                    <small class="text-danger">{{ $errors->first('nom') }}</small>

                    <div class="form-group {{ $errors->has('nom') ? 'has-error has-feedback' : '' }}">

                        {{ Form::text('nom', null, array('class' => 'form-control', 'placeholder' => 'Votre nom')) }}

                    </div>

                    <small class="text-danger">{{ $errors->first('email') }}</small>    

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Votre email')) }}

                    </div>

                    <small class="text-danger">{{ $errors->first('texte') }}</small>    

                    <div class="form-group {{ $errors->has('texte') ? 'has-error' : '' }}">

                        {{ Form::textarea ('texte', null, array('class' => 'form-control', 'placeholder' => 'Votre message')) }}

                    </div>

                    {{ Form::submit('Envoyer !', array('class' => 'btn btn-info pull-right')) }}

                {{ Form::close() }}

            </div>

        </div>

    </div>

@stop