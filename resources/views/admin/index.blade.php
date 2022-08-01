@extends('admin.layouts.admin')

@section('title', trans('positivity::admin.setting.title'))

@push('styles')
    <link href="{{ plugin_asset('positivity', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('positivity.admin.setting.update', $setting) }}" name="setting-form" method="POST">
                        <h3>{{ trans('positivity::admin.setting.title') }}</h3>
                        @method('PUT')
                        @include('positivity::admin._form')
                        <p id="result"></p>
                        <button class="btn btn-success" onclick="return checkDb();">
                            <i class="bi bi-check2-circle"></i> {{ trans('positivity::admin.db.check') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function checkDb() {
            var data = new Array();
            Array.from(document.forms["setting-form"].elements).forEach(e => {
                if(e.name == "_method")
                    return;
                if(e.tagName.toLowerCase() === 'input') {
                    data[e.name] = e.value;
                }
            });
            fetch('{{ route("positivity.checkDatabase") }}', {
                method: "POST",
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.assign({}, data))
            }).then(res => {
                var div = document.getElementById("result");
                if (res.status === 200) {
                    res.json().then(function(json) {
                        if(json["good"] == 1) {
                            div.innerHTML = "{{ trans('positivity::admin.db.fine') }}";
                            div.style.color = "#00FF00";
                        } else {
                            div.innerHTML = "{{ trans('positivity::admin.db.not-fine') }}" + (json["error"] != null ? " " + json["error"] : "");
                            div.style.color = "#FF0000";
                        }
                    });
                } else {
                    div.innerHTML = "Error code: " + res.status;
                    div.style.color = "#FF0000";
                }
            });
            return false;
        }
    </script>
@endpush