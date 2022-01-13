@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-2">

                <form>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-auto">
                                <label for="length" class="form-label">Length Desired for Encryption Key (default= 25):</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" min="1" id="length" value="25">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="generate" onclick="generateKey()" class="btn btn-primary">Generate</button>
                </form>

                {{-- Div to display key --}}
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>

                            </tr>
                        </thead>
                        <tbody id="table-body">
                            {{-- <tr>
                                <th scope="row">1</th>
                            </tr> --}}

                        </tbody>
                      </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
