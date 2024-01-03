<x-layout>
    <div class="row text-white m-4">
        <h1 style="text-align: center">Manage Users</h1>

        <div class="col-md-6">
            <h2 style="text-align: center">Active Users</h2>
            
            {{-- Search Bar for Active Users --}}
            <form method="get" action="/admin/users">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Active Users" name="searchActive" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th class="center-text">Name</th>
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="center-text"><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
                            <td class="center-text">
                                <form method="post" action="/users/{{$user->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger" style="width: 50%">Ban</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>

        <div class="col-md-6">
            <h2 style="text-align: center">Banned Users</h2>

            {{-- Search Bar for Banned Users --}}
            <form method="get" action="/admin/users">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Banned Users" name="searchBanned" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th class="center-text">Name</th>
                        <th class="center-text">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banned as $user)
                        <tr>
                            <td class="center-text"><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
                            <td class="center-text">
                                <form method="post" action="/users/{{$user->id}}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success" style="width: 50%">Unban</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $banned->links() }}
        </div>
    </div>
</x-layout>
