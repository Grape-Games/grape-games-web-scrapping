// toast event listener

Livewire.on("response-toast", (event) => {
    console.log(event);
    toastr.options = {
        closeButton: true,
        progressBar: true,
    };
    var code = "toastr." + event.type + "('" + event.message + "')";
    eval(code);
});
