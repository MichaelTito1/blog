@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Month:</strong>
                    <input type="text" name="month" value="{{ $project->month }}" class="form-control" placeholder="month">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>salaries payment day:</strong>
                    <textarea type="number" class="form-control" style="height:50px" name="salaries_payment_day"
                        placeholder="salaries_payment_day">{{ $project->salaries_payment_day }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>bonus payment day:</strong>
                    <input type="number" name="bonus_payment_day" class="form-control" placeholder="{{ $project->bonus_payment_day }}"
                        value="{{ $project->bonus_payment_day }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>salaries_total:</strong>
                    <input type="number" name="salaries_total" class="form-control" placeholder="{{ $project->salaries_total }}"
                        value="{{ $project->salaries_total }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>bonus_total:</strong>
                    <input type="number" name="bonus_total" class="form-control" placeholder="{{ $project->bonus_total }}"
                        value="{{ $project->bonus_total }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>payments_total:</strong>
                    <input type="number" name="payments_total" class="form-control" placeholder="{{ $project->payments_total }}"
                        value="{{ $project->payments_total }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection