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
                                <label for="input-string" class="form-label">Message to Encrypt/Decrypt:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="input-string" >
                            </div>
                            <br>
                            <div class="col-auto">
                                <label for="input-key" class="form-label">Desired Shift Amount (leave 0 for random or unknown key):</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" min="0" max="26" id="input-key" value="0">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="encipher" onclick="encipherString()" class="btn btn-primary">Encipher</button>
                    <button type="button" id="decipher" onclick="decipherString()" class="btn btn-primary">Decipher</button>

                </form>

                {{-- Div to display key --}}
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>

                            </tr>
                        </thead>
                        {{-- This will be changed via javascript in app.blade.php --}}
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
