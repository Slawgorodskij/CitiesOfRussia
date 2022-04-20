<link href="{{ asset("plugins/summernote/summernote-bs4.css") }}" rel="stylesheet">
<link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet">
<script src="{{ asset("js/jquery-3.6.0.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/summernote/summernote-bs4.js") }}"></script>
<script src="{{ asset("plugins/summernote/lang/summernote-ru-RU.min.js") }}"></script>
<script>
    let title =  $(".title");
    let description =  $(".description");
    let text = $(".text");

    text.summernote({
        lang: 'ru-RU',
        height: 300,
        minHeight: 100,
        maxHeight: 500,
        placeholder: 'Текст статьи',

        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize', 'fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],

        codeviewFilter: true,
        codeviewIframeFilter: true,
        disableDragAndDrop: true,
    });
</script>
