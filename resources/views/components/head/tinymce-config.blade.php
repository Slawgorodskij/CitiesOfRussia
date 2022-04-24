<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
        plugins:
            'advlist autolink link image lists charmap preview anchor pagebreak ' +
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking ' +
            'table emoticons template help codesample ' //+ 'print hr paste'
        ,
        toolbar:
            'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help'
        ,
    });
</script>
