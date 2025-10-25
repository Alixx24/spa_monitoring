@extends('customer.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <a class="btn btn-success ms-5" type="submit" data-bs-toggle="modal" data-bs-target="#createReqModal">create request</a>
    <a class="btn btn-warning ms-5" type="submit" data-bs-toggle="modal" data-bs-target="#createReqModal">+ unlimited</a>

    <section class="hero-section m-md-5 m-3">

        <div class="bg-light mb-3 p-2">
            <h5>
                name: {{ $fetchUrls['name'] }} | 
                last visited: {{ $fetchUrls['last_visited'] }}
                
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">request_id</th>
                        <th scope="col">to_email</th>
                        <th scope="col">description</th>
                        <th scope="col">status_code</th>
                        <th scope="col">at</th>


                        <th scope="col">Status</th>
                   

                    </tr>
                </thead>

                <tbody>
                    @foreach ($fetchRequestStatus as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->id }}  - {{ $item->request->url }}</td>
                            <td>{{ $item->to_email }} Min</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->status_code }}</td>

                            <td>{{ $item->created_at }}</td>

                            <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>


                            {{-- <td>
                                <a class="btn btn-warning"
                                    href="{{ route('dashboard.analysis.link.index', ['linkId' => auth()->user()->id, 'id' => $item->id]) }}">Click!</a>
                            </td> --}}

                        </tr>
                    @endforeach
                    {{ $fetchRequestStatus->links() }}

                </tbody>
            </table>
              {{ $fetchRequestStatus->links() }}
        </div>

    </section>


    <x-create-request-modal />
@endsection
