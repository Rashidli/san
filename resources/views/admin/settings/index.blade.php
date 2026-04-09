@include('admin.includes.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('message'))
                                <div class="alert alert-success">{{session('message')}}</div>
                            @endif
                            <h4 class="card-title">Ayarlar</h4>
                            <br>

                            <form action="{{ route('settings.update') }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="col-form-label">Xəritə iframe URL</label>
                                    <input class="form-control" type="text" name="map_iframe" value="{{ $settings['map_iframe'] }}" placeholder="Google Maps embed URL">
                                    <small class="text-muted">Google Maps-dan "Embed a map" linkini buraya yapışdırın</small>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">WhatsApp nömrəsi</label>
                                    <input class="form-control" type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] }}" placeholder="994505555555">
                                    <small class="text-muted">Nömrəni beynəlxalq formatda yazın (məs: 994505555555)</small>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
