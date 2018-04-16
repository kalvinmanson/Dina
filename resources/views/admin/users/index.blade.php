@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->

    <h1>Users</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="250">Timestamps</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <a href="/admin/users/{{ $user->id }}/edit">{{ $user->name }}</a><br>
                    <small>{{ $user->username }}</small>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <small>
                        Created at: {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('jS F Y g:ia') }}<br />
                        Updated at: {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('jS F Y g:ia') }}<br />
                        ({{ Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->diffForHumans() }})
                    </small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection