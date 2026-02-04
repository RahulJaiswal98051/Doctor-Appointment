@extends('dashboard.includes.layout')

@section('content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                       {{-- Success Message  --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                      {{-- Error Messages   --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h4 class="card-title mb-0">All Members</h4>
                    <a href="{{ route('members.create') }}" class="btn btn-primary btn-rounded"><i class="fa-solid fa-user-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Member</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center" >Status</th>
                               <th class="text-center">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>
                                        {{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        @if($member->profile)
                                            <img src="{{ url('storage/profile/'.$member->profile) }}" width="40" height="40" class="rounded-circle mr-2">
                                        @endif
                                        {{ $member->name }}
                                    </td>
                                     <td>{{ $member->role }}</td>
                                    <td>
                                        <label >{{ $member->email }}</label>
                                    </td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->status }}</td>
                                    <td>
                                        <div class ="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-inverse-primary btn-rounded"><i class="fa-solid fa-user-pen"></i></a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-inverse-danger btn-rounded" onclick="return confirm('Are you sure? delete this member')">
        <i class="fa-solid fa-trash-can"></i>
    </button>
</form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 wrapping-pagination">
                    {{ $members->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

