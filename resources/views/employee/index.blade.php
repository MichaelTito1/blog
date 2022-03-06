@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}" title="Add a new Employee"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>name</th>
            <th>salary</th>
            <th>bonus percent</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employee as $emp)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->salary }}</td>
                <td>{{ $emp->bonus_percent }}</td>
                <td>
                    <form action="{{ route('employee.destroy', $emp->id) }}" method="POST">

                        <a href="{{ route('employee.show', $emp->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('employee.edit', $emp->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $employee->links() !!}

@endsection