
jQuery(document).ready(function(){
    jQuery('a.link').click(function(event){
        event.preventDefault();
        var id  = jQuery(this).attr('href');
        var url = window.location.origin + '/admissao/'+id+'/solicitacao'

        setTimeout(function(){
            jQuery('input.swal2-input').attr('id','link-copy')
            jQuery('button.swal2-confirm').attr('onclick','myFunction()')
        },1000)

        Swal.fire({
            title: 'Link do formulario',
            input: 'text',
            inputValue: url,
            confirmButtonText: 'Selecianar!',
            cancelButtonText: 'Copiado',
            showCancelButton: true,
        }).then((result) => {
            console.log(result);
        })
        
    })
})

function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("link-copy");
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */


  } 