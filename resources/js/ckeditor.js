ClassicEditor
    .create(document.querySelector('.ckeditor'), {
        removePlugins: ['ImageUpload'],
        toolbar: {
            items: ["heading", "|", "bold", "italic", "link", "bulletedList", "numberedList", "blockQuote", "undo", "redo"]
        }
    })
    .catch(function (error) {
        console.error(error);
    });