@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Stato</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
