const ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
import "@ckeditor/ckeditor5-build-classic/build/translations/ru";

const editor = document.getElementById('editor');

if (editor) {
    ClassicEditor
        .create(editor, {
            language: "ru",
            ckfinder: {
                uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
                options: {
                    resourceType: 'Images',
                    language: "ru",
                },
            },
        });
}
