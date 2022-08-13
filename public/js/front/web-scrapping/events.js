// toast event listener

Livewire.on("response-toast", (event) => {
    toastr.options = {
        closeButton: true,
        progressBar: true,
    };
    var quote = "'";
    var code =
        "toastr." +
        event.type +
        "(" +
        quote +
        "" +
        event.message +
        "" +
        quote +
        ")";
    eval(code);
});
