const Font = Quill.import('formats/font');
Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
Quill.register(Font, true);

const contentEditor = new Quill('#full-container .editor', {
    bounds: '#full-container .editor',
    modules: {
        formula: true,
        syntax: true,
        toolbar: [
            [
                {
                    font: []
                },
                {
                    size: []
                }
            ],
            ['bold', 'italic', 'underline', 'strike'],
            [
                {
                    color: []
                },
                {
                    background: []
                }
            ],
            [
                {
                    script: 'super'
                },
                {
                    script: 'sub'
                }
            ],
            [
                {
                    header: '1'
                },
                {
                    header: '2'
                },
                'blockquote',
                'code-block'
            ],
            [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                },
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
            ],
            [
                'direction',
                {
                    align: []
                }
            ],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ]
    },
    theme: 'snow'
});

contentEditor.on('text-change', function () {
    document.getElementById("contents").value = contentEditor.root.innerHTML;
});
