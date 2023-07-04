<div>
    <div class="row">
        <div class="col-12">
            <textarea id="#editor" @if($this->disableInputs) disabled @endif></textarea>
        </div>
    </div>
</div>

@once
    @push('head_js')
        <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush
    @push('js')
        <script>
            CKEDITOR.replace('#editor')
        </script>
    @endpush
@endonce