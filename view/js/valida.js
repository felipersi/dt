function validacampos() {
    var valida = $("#form").validate({
        focusCleanup: true,
        errorLabelContainer: "input .labell",
        errorElement: "div",
        rules : {
            host_origem:{
                required:true,
                minlength:3
            },
            usuario_origem:{
                required:true
            },
            senha_origem:{
                required:true
            },
            host_destino:{
                required:true,
                minlength:3
            },
            usuario_destino:{
                required:true
            },
            senha_destino:{
                required:true
            }
        },
        messages:{
            host_origem:{
                required:"Host em branco",
                minlength:"Deve ter pelo menos 3 caracteres"
            },
            usuario_origem:{
                required:"Usuario em branco"
            },
            senha_origem:{
                required:"Senha em branco"
            },
            host_destino:{
                required:"Host em branco",
                minlength:"Deve ter pelo menos 3 caracteres"
            },
            usuario_destino:{
                required:"Usuario em branco"
            },
            senha_destino:{
                required:"Senha em branco"
            }
        }
    });

}
validacampos();










