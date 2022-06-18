
jQuery(document).ready(function(){
    jQuery('a.link').click(function(event){
        event.preventDefault();
        var id  = jQuery(this).attr('href');
        var url = window.location.origin + '/admissao/'+id+'/1/solicitacao'

        setTimeout(function(){
            jQuery('input.swal2-input').attr('id','link-copy')
            jQuery('button.swal2-confirm').attr('onclick','myFunction()')
        },1000)

        Swal.fire({
            title: 'Link do formulario',
            input: 'text',
            inputValue: url,
            confirmButtonText: 'Copiar!',
        }).then((result) => {
            console.log(result);
        })
        
    })
})

function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
}

function myFunction(){
    var copyText = document.getElementById("link-copy");
    copyToClipboard(copyText.value);
    swal.close();
    toastr.success('Link copiado!');
}