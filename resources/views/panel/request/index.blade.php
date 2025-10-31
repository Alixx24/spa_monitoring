@extends('panel.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(3px);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 26px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>



    <button id="openModalRequestBtn" class="btn btn-warning">Create</button>

    <!-- Modal -->
    <div id="createRequestModal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <h2>Create Request</h2>





            <form id="createForm" action="{{ route('panel.request.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Url</label>
                    <input type="text" name="url" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter Url...">
                </div>




                <div class="form-group mt-1">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter Name...">

                </div>

                <div class="form-group mt-1">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>




                <select name="duration_id" class="form-select mt-2" id="" name="duration_id">
                    <option selected disabled>انتخاب کنید</option>
                    @foreach ($fetchDuration as $duration)
                        <option value="{{ $duration->id }}">{{ $duration->duration }}</option>
                    @endforeach
                </select>




                <button type="submit" class="btn btn-success mt-4">Make it</button>
            </form>

        </div>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">url</th>
                <th scope="col">email</th>
                <th scope="col">name</th>
                <th scope="col">duration</th>
                <th scope="col">created_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fatchRequest as $request)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $request->url }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->name }}</td>

                    <td>{{ $request->duration->duration ?? 'ندارد' }}</td>


                    <td>{{ $request->created_at }}</td>

                    <td>
                        <a href="{{ route('panel.request.edit', $request->id) }}" class="btn btn-warning ">Edit</a>

                        <form action="{{ route('panel.request.delete', $request->id) }}" method="post"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger ">Delete</button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <script src="{{ asset('panel/ts/modal-create-request.js') }}"></script>
@endsection
