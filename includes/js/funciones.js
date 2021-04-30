$(document).ready(function(){ 

    /* Busqueda incremental */
    //Buscar cliente.
    $('#buscarCliente').keyup(function(e){
        e.preventDefault();

        const id = $(this).val();
        const action = 'busquedaCliente';
        var dataCliente = '';

        $.ajax({
            url: 'ajax_clientes.php',
            type: 'POST',
            async: true,
            data: {
                    action:action, 
                    id:id
                },
            //Success.
            success: function(response){
                if(response == 'notData'){
                    //Si no existe el cliente.
                    dataCliente = "No existe el cliente";
                    //Imprime la tabla.
                    $('#rowsCliente').html(dataCliente);                        
                }else{
                    //Activa los campos.
                    const info = JSON.parse(response);
                    dataCliente = info;
                    //Imprime la tabla.
                    $('#rowsCliente').html(dataCliente);
                }
                

            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });

    });
    
    //Buscar producto.
    $('#buscarProducto').keyup(function(e){
        e.preventDefault();

        const id = $(this).val();
        const action = 'busquedaProducto';
        var dataProducto = '';

        $.ajax({
            url: 'ajax_productos.php',
            type: 'POST',
            async: true,
            data: {
                    action:action, 
                    id:id
                },
            beforeSend: function(){
            },
            //Success.
            success: function(response){
                
                if(response == 'notData'){
                    //Si no existe el producto.
                    dataProducto = "No existe el producto";
                    //Imprime la tabla.
                    $('#rowsProducto').html(dataProducto);
                }else{
                    //Activa los campos.
                    const info = JSON.parse(response);
                    dataProducto = info;
                    //Imprime la tabla.
                    $('#rowsProducto').html(dataProducto);
                }

            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });

    });
    
    //Buscar venta.
    $('#buscarVenta').keyup(function(e){
        e.preventDefault();

        const id = $('#buscarVenta').val();
        const action = 'busquedaVenta';
        var dataVenta = '';

        //Ajax.
        $.ajax({
            url: 'ajax_ventas.php',
            type: 'POST',
            async: true,
            data: {
                    action:action, 
                    id:id
                },
            //Success.
            success: function(response){
                if(response == 'notData'){
                    //Si no existe la venta.
                    dataVenta = "No existe la venta";
                    //Imprime la tabla.
                    $('#rowsVenta').html(dataVenta);
                }else{
                    const info = JSON.parse(response);
                    dataVenta = info;
                    //Imprime la tabla.
                    $('#rowsVenta').html(dataVenta);
                }
            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });

    });



    /* Dropdown button nav */
    dropdown_button = document.getElementById("dropdown-button");
    dropdown_menu = document.getElementById("dropdown-menu");
    $(dropdown_button).click(function(e){
        if(dropdown_menu.style.display == "flex"){
            dropdown_menu.style.display = "none";
        }else{
            dropdown_menu.style.display = "flex";
        }
    });


    /* Caja */
    abrir_caja = document.getElementById("abrir_caja");
    cerrar_caja = document.getElementById("cerrar_caja");
    CajaAbierta = document.getElementById("CajaAbierta");
    
    $(abrir_caja).click(function(e){
        cerrar_caja.style.display = "flex";
        abrir_caja.style.display = "none";
        CajaAbierta.style.display = "flex";
    });

    $(cerrar_caja).click(function(e){
        abrir_caja.style.display = "flex";
        cerrar_caja.style.display = "none";
        CajaAbierta.style.display = "none";
    });


    /* Ventas */
    //Filtrar.
    var filtrarVenta = document.getElementById("filtrarVenta");
    var modalFondoFiltrar = document.getElementById("modalFondoFiltrar");
    var cancelarFiltrarModal = document.getElementById("cancelarFiltrarModal");
    var ConfirmarFiltrar = document.getElementById("btn_filtrar");
    var mensajeModalFiltrar = document.getElementById("mensajeModalFiltrar");
    var errorModal = document.getElementById("errorModal");

    var quitarFiltro = document.getElementById("quitarFiltro");

    $(filtrarVenta).click(function(e){ //Click Filtrar Venta.
        modalFondoFiltrar.style.display = "flex";
    });

    $(cancelarFiltrarModal).click(function(e){ //Click CancelarfiltrarModal.
        modalFondoFiltrar.style.display = "none";
        mensajeModalFiltrar.style.display = "none";

        var fechaDesde = document.getElementById("fechaDesde");
        var fechaHasta = document.getElementById("fechaHasta");

        fechaDesde.style.border = "1px solid #A2A2A2"
        fechaDesde.style.background = "#ffffff";
        fechaHasta.style.border = "1px solid #A2A2A2"
        fechaHasta.style.background = "#ffffff";
    });
    
    $(ConfirmarFiltrar).click(function(e){ //Click ConfirmarFiltrar.
        var fechaDesde = document.getElementById("fechaDesde");
        var fechaHasta = document.getElementById("fechaHasta");
        
        var fechaDesdeValue = fechaDesde.value;
        var fechaHastaValue = fechaHasta.value;
        
        console.log(fechaDesdeValue);
        console.log(fechaHastaValue);

        if(fechaDesdeValue == "" && fechaHastaValue == ""){
            fechaDesde.style.border = "1px solid #DE1113";
            fechaDesde.style.background = "rgb(254, 246, 245)";
            fechaHasta.style.border = "1px solid #DE1113";
            fechaHasta.style.background = "rgb(254, 246, 245)";
            //Muestra mensaje de Error.
            errorModal.innerHTML = "Debe rellenar todos los campos";
            mensajeModalFiltrar.style.display = "flex";
        }else 
        if(fechaDesdeValue != "" && fechaHastaValue == ""){
            fechaDesde.style.border = "1px solid #DE1113";
            fechaDesde.style.background = "rgb(254, 246, 245)";
            fechaHasta.style.border = "1px solid #DE1113";
            fechaHasta.style.background = "rgb(254, 246, 245)";
            //Muestra mensaje de Error.
            errorModal.innerHTML = "Debe rellenar todos los campos";
            mensajeModalFiltrar.style.display = "flex";
        }else 
        if(fechaDesdeValue != "" && fechaHastaValue != ""){
            fechaDesde.style.border = "1px solid #A2A2A2";
            fechaHasta.style.border = "1px solid #A2A2A2";
        }

        //Si fecha Desde esta antes o es igual que fecha Hasta:
        if(fechaDesdeValue <= fechaHastaValue && fechaDesdeValue != "" && fechaHastaValue != ""){
            e.preventDefault();

            const action = 'filtrarVenta';
            var dataVenta = '';

            //Ajax.
            $.ajax({
                url: 'ajax_ventas.php',
                type: 'POST',
                async: true,
                data: {
                        action:action,
                        fechaDesdeValue:fechaDesdeValue,
                        fechaHastaValue:fechaHastaValue
                    },
                //Success.
                success: function(response){
                    console.log(response);
                    if(response == 'no hay fecha de esa venta'){
                        //Si no existe la venta.
                        dataVenta = "No hay ventas realizadas en esa fecha";

                        //Imprime la tabla.
                        $('#rowsVenta').html(dataVenta);
                    }else{
                        dataVenta = JSON.parse(response);
                        
                        //Imprime la tabla.
                        $('#rowsVenta').html(dataVenta);
                    }
                },
                //Error.
                error: function(error){
                    console.log(error);
                },

            });//End ajax.

            //Oculta el modal.
            modalFondoFiltrar.style.display = "none";

            //Muestra el boton Quitar filtro.
            quitarFiltro.style.display="flex";

            //Setea los input date en vacio:
            fechaDesde.value = "";
            fechaHasta.value = "";

            //Oculta mensaje de Error.
            mensajeModalFiltrar.style.display = "none";
            
            fechaDesde.style.border = "1px solid #A2A2A2"
            fechaDesde.style.background = "#ffffff";
            fechaHasta.style.border = "1px solid #A2A2A2"
            fechaHasta.style.background = "#ffffff";
        }

        //Si fecha Desde esta despues que fecha Hasta:
        if(fechaDesdeValue > fechaHastaValue && fechaHastaValue != ""){
            fechaDesde.style.border = "1px solid #DE1113";
            fechaDesde.style.background = "rgb(254, 246, 245)";
            fechaHasta.style.border = "1px solid #DE1113";
            fechaHasta.style.background = "rgb(254, 246, 245)";
            //Muestra mensaje de Error.
            errorModal.innerHTML = "Seleccione una fecha correcta";
            mensajeModalFiltrar.style.display = "flex";
        }
        
    });

    $(quitarFiltro).click(function(e){ //Click quitarFiltro.
        e.preventDefault();

        const action = 'quitarFiltro';
        var dataVenta = '';
    
        //Ajax.
        $.ajax({
            url: 'ajax_ventas.php',
            type: 'POST',
            async: true,
            data: {
                    action:action
                },
            //Success.
            success: function(response){
                if(response == 'notData'){
                    //Si no existe la venta.
                    dataVenta = "No existe la venta";
    
                    //Imprime la tabla.
                    $('#rowsVenta').html(dataVenta);
                }else{
                    const info = JSON.parse(response);
                    dataVenta = info;
    
                    //Imprime la tabla.
                    $('#rowsVenta').html(dataVenta);
                }
            },
            //Error.
            error: function(error){
                console.log(error);
            },
    
        });//End ajax.

        quitarFiltro.style.display = "none";
    });


    
    //Condición de pago.
    var Cliente = document.getElementById("Cliente");
    var Contado = document.getElementById("Contado");
    var Cuenta_corriente = document.getElementById("Cuenta_corriente");
    var Efectivo = document.getElementById("Efectivo");
    var Credito = document.getElementById("Credito");
    var Debito = document.getElementById("Debito");
    
    if(Cliente.value == "Cliente Default"){ //Seleccion default.
        Contado.checked = true;
        Cuenta_corriente.disabled = true;
        Efectivo.checked = true;   
    }

    $(Contado).click(function(e){ //Click Contado.
        Efectivo.disabled = false;
        Credito.disabled = false;
        Debito.disabled = false;
    });

    $(Cuenta_corriente).click(function(e){ //Click Cuenta corriente.
        Efectivo.disabled = true;
        Credito.disabled = true;
        Debito.disabled = true;
    });    

    $('#Cliente').click(function(e){ //Seleccionar cliente.
        if(Cliente.value == "Cliente Default"){
            Contado.checked = true;
            Cuenta_corriente.disabled = true;
            Efectivo.disabled = false;
            Credito.disabled = false;
            Debito.disabled = false;
        }else{
            Cuenta_corriente.disabled = false;
        }
    });


    //Si se escribe en el input codigo.
    $('#idVenta').keyup(function(e){
            e.preventDefault();

            const id = $(this).val();
            const action = 'infoProducto';
            var dataProducto = '';
        
            //Ajax.
            $.ajax({
                url: 'ajax_ventas.php',
                type: 'POST',
                async: true,
                data: {
                        action:action, 
                        id:id
                    },
                beforeSend: function(){
                },
                success: function(response){
                    console.log(response);
                    
                    if(response == 'notData'){
                        dataProducto = "No existe el producto";
                        console.log(dataProducto);

                        //Setea los campos en default.
                        $('#descripcion').html("-");
                        $('#precioUnitario').html("-");
                        document.getElementById("Cantidad").value = '0';
                        document.getElementById("Cantidad").disabled = true;
                        $('#total').html("-");
                        
                    }else{
                        //Activa los campos.   
                        const info = JSON.parse(response);
                        dataProducto = info;

                        $('#descripcion').html(dataProducto.DescCorta);
                        $('#precioUnitario').html(dataProducto.PrecioVenta);
                        document.getElementById("Cantidad").disabled = false;
                        var cantidad = document.getElementById("Cantidad").value = '1';
                        $('#total').html(dataProducto.PrecioVenta * cantidad);

                        $('#idVenta').keyup(function(e){
                            e.preventDefault();

                            //Si el campo Codigo es igual a vacio.
                            if(document.getElementById("idVenta").value == ""){
                                //Setea los campos en default.
                                $('#descripcion').html("-");
                                $('#precioUnitario').html("-");
                                document.getElementById("Cantidad").value = '0';
                                document.getElementById("Cantidad").disabled = true;
                                $('#total').html("-");
                            }
                        });

                        //Si el campo Cantidad es actualizado.
                        $('#Cantidad').keyup(function(e){
                            e.preventDefault();

                            //Si el campo Cantidad es igual a vacio.
                            if(document.getElementById("Cantidad").value == ""){
                                //Actualiza el campo total.
                                $('#total').html("-");
                            }

                            //Si el campo Cantidad es igual que 0.
                            if(document.getElementById("Cantidad").value == "0"){
                                //Actualiza la variable cantidad y setea el campo total con el valor especificado.
                                cantidad = document.getElementById("Cantidad").value = "1";
                                $('#total').html(dataProducto.PrecioVenta * cantidad);
                            }
                            
                            //Si el campo Cantidad es mayor que 0.
                            if(document.getElementById("Cantidad").value > "0"){
                                //Actualiza la variable cantidad y setea el campo total con el valor especificado.
                                cantidad = document.getElementById("Cantidad").value;
                                $('#total').html(dataProducto.PrecioVenta * cantidad);
                            }
                            
                        });

                    }

                },
                error: function(error){
                    console.log(error);

                },

            });//End Ajax.

    });

    //Modal Limite de cantidad de items.
    let modalLimite = document.getElementById("modalFondoLimite");
    let AceptarModalLimite = document.getElementById("btn_AceptarModal");

    //Click en Cargar Item.
    $('#cargarItem').click(function(e){
        e.preventDefault();

        //Busca si el item ya esta cargado en la tabla de items.
        var num_venta = $('#num_venta').text();
        var action = 'buscar_item';
        var idProducto = $('#idVenta').val();

        $.ajax({
            url: 'ajax_ventas.php',
            type: 'POST',
            async: true,
            data: {
                    action:action, 
                    idProducto:idProducto,
                    num_venta:num_venta
                },
            //Success.
            success: function(response){
                console.log(response);
                //Si no hay ningun item cargado con el mismo idProducto.
                //Entonces lo carga en la tabla.
                if(response == "Error"){

                    //Calcula la cantidad de items con el numero de venta.
                    //Para limitar la tabla a 15 items.
                    var action = 'cantidad_items';

                    $.ajax({
                        url: 'ajax_ventas.php',
                        type: 'POST',
                        async: true,
                        data: {
                                action:action,
                                num_venta:num_venta
                            },
                        //Success.
                        success: function(response){
                            console.log(response);
                            //Si la cantidad de items cargados es Menor a 15.
                            if(response != 'Error la cantidad es mayor a 15'){
                                
                                var idProducto = $('#idVenta').val();
                                var cantidad = $('#Cantidad').val();
                                var action = 'agregar_Producto';
                        
                                if( $('#Cantidad').val() > 0 ){
                        
                                    //Ajax.
                                    $.ajax({
                                        url: 'ajax_ventas.php',
                                        type: 'POST',
                                        async: true,
                                        data: {
                                                action:action, 
                                                idProducto:idProducto,
                                                cantidad:cantidad,
                                                num_venta:num_venta
                                            },
                                        beforeSend: function(){
                                        },
                                        //Success.
                                        success: function(response){
                                            //Si se realiza la carga del producto en la tabla items.
                                            if(response != 'Error no hay producto'){
                                                //Si el campo idVenta es distinto de vacio.
                                                if(document.getElementById("idVenta").value != ""){
                                                    //Setea los campos de carga de items en default.
                                                    document.getElementById("idVenta").value = "";
                                                    $('#descripcion').html("-");
                                                    $('#precioUnitario').html("-");
                                                    document.getElementById("Cantidad").value = '0';
                                                    document.getElementById("Cantidad").disabled = true;
                                                    $('#total').html("-");
                                                }
                                                    
                                                var info = JSON.parse(response);
                                                //Imprime la tabla.
                                                $('#tabla').html(info);
                        
                        
                                                //Muestra el boton Grabar venta.
                                                document.getElementById("grabar_venta").style.display = "flex";
                        
                        
                                                //Actualiza el total de la venta.
                                                var action = 'total_venta';
                        
                                                //Ajax.
                                                $.ajax({
                                                    url: 'ajax_ventas.php',
                                                    type: 'POST',
                                                    async: true,
                                                    data: {
                                                            action:action,
                                                            num_venta:num_venta
                                                        },
                                                    //Success.
                                                    success: function(response){
                                                        if(response != 'Error'){
                                                            //Imprime el valor total.
                                                            $('#valorSubF').html(response);
                                                            $('#valorF').html(response);
                                                        }
                        
                                                    },
                                                    //Error.
                                                    error: function(error){
                                                        console.log(error);
                                                    },
                        
                                                });//End Ajax.
                        
                                            }
                        
                                        },
                                        //Error.
                                        error: function(error){
                                            console.log(error);
                                        },
                        
                                    });//End Ajax.
                        
                                }else{
                                    alert("Cantidad igual a cero.");
                                }
                                
                            }

                            //Si la cantidad de items cargados es Mayor a 15.
                            if(response == 'Error la cantidad es mayor a 15'){
                                console.log("Error, ya hay 15 items cargados");
                                modalLimite.style.display = "flex";
                            }

                        },
                        //Error.
                        error: function(error){
                            console.log(error);
                        },

                    });//End Ajax.

                }

                //Si el item ya esta cargado en la tabla de items.
                //Entonces actualiza su cantidad.
                if(response != "Error"){
                    
                    var idProducto = $('#idVenta').val();
                    var cantidad = $('#Cantidad').val();
                    var action = 'agregar_Producto';
            
                    if( $('#Cantidad').val() > 0 ){
            
                        //Ajax.
                        $.ajax({
                            url: 'ajax_ventas.php',
                            type: 'POST',
                            async: true,
                            data: {
                                    action:action, 
                                    idProducto:idProducto,
                                    cantidad:cantidad,
                                    num_venta:num_venta
                                },
                            beforeSend: function(){
                            },
                            //Success.
                            success: function(response){
                                //Si se realiza la carga del producto en la tabla items.
                                if(response != 'Error no hay producto'){
                                    //Si el campo idVenta es distinto de vacio.
                                    if(document.getElementById("idVenta").value != ""){
                                        //Setea los campos de carga de items en default.
                                        document.getElementById("idVenta").value = "";
                                        $('#descripcion').html("-");
                                        $('#precioUnitario').html("-");
                                        document.getElementById("Cantidad").value = '0';
                                        document.getElementById("Cantidad").disabled = true;
                                        $('#total').html("-");
                                    }
                                        
                                    var info = JSON.parse(response);
                                    //Imprime la tabla.
                                    $('#tabla').html(info);
            
            
                                    //Muestra el boton Grabar venta.
                                    document.getElementById("grabar_venta").style.display = "flex";
            
            
                                    //Actualiza el total de la venta.
                                    var action = 'total_venta';
            
                                    //Ajax.
                                    $.ajax({
                                        url: 'ajax_ventas.php',
                                        type: 'POST',
                                        async: true,
                                        data: {
                                                action:action,
                                                num_venta:num_venta
                                            },
                                        //Success.
                                        success: function(response){
                                            if(response != 'Error'){
                                                //Imprime el valor total.
                                                $('#valorSubF').html(response);
                                                $('#valorF').html(response);
                                            }
            
                                        },
                                        //Error.
                                        error: function(error){
                                            console.log(error);
                                        },
            
                                    });//End Ajax.
            
                                }
            
                            },
                            //Error.
                            error: function(error){
                                console.log(error);
                            },
            
                        });//End Ajax.
            
                    }else{
                        alert("Cantidad igual a cero.");
                    }
                
                }

            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });//End Ajax.

    });

    //Click Aceptar modal cantidad items.
    $(AceptarModalLimite).click(function(e){ //Click Aceptar items.
        e.preventDefault();
        //Setea los campos de carga de items en default.
        document.getElementById("idVenta").value = "";
        $('#descripcion').html("-");
        $('#precioUnitario').html("-");
        document.getElementById("Cantidad").value = '0';
        document.getElementById("Cantidad").disabled = true;
        $('#total').html("-");
        
        //Oculta el modal cantidad items.
        modalLimite.style.display = "none";
    });
    
    //Grabar venta.
    $('#grabar_venta').click(function(e){
        console.log("Grabar venta");
        //Definen variables.
        var numero_venta = document.getElementById("numero_venta");
        var fecha = document.getElementById("fecha_pc");
        var Total = document.getElementById("Total");

        numero_venta.value = $('#num_venta').text();
        fecha.value = $('#fecha').text();
        Total.value = $('#valorF').text();

        console.log(numero_venta.value);
        console.log(fecha.value);
        console.log(Total.value);
    });
    


    //Salir.
    let botonSalir = document.getElementById("boton_salir");
    let modalSalir = document.getElementById("modalFondoSalir");
    let ConfirmarSalir = document.getElementById("btn_salir");
    let cerrarModalSalir = document.getElementById("btn_cancelarSalirModal");

    $(botonSalir).click(function(e){
        e.preventDefault();

        //Si en la tabla items hay algun item con el numero de venta asignado (num_venta).
        var num_venta = $('#num_venta').text();
        var action = 'boton_salir';

        //Ajax.
        $.ajax({
            url: 'ajax_ventas.php',
            type: 'POST',
            async: true,
            data: {
                    action:action,
                    num_venta:num_venta
                },
            //Success.
            success: function(response){
                //Muestra el modal Salir.
                if(response != 'Error no hay items con ese id'){
                    $('#salir_value').text(response);
                    modalSalir.style.display = "flex";
                }else{
                    window.location.href = "tabla_ventas.php";
                }

            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });//End Ajax.

    });
    
    $(ConfirmarSalir).click(function(e){ //Click confirmar Salir.
        //Elimina todos los items con el numero de venta asignado (num_venta).
        var num_venta = $('#num_venta').text();
        var action = 'eliminar_items';

        //Ajax.
        $.ajax({
            url: 'ajax_ventas.php',
            type: 'POST',
            async: true,
            data: {
                    action:action,
                    num_venta:num_venta
                },
            //Success.
            success: function(response){
                //Si hay items con el numero de venta.
                if(response != 'Error no hay items con ese id'){
                    console.log(response);
                    window.location.href = "tabla_ventas.php";
                    modalSalir.style.display = "none";
                }else{
                    window.location.href = "tabla_ventas.php";
                }

            },
            //Error.
            error: function(error){
                console.log(error);
            },

        });//End Ajax.

    });    

    $(cerrarModalSalir).click(function(e){ //Click cancelar Salir.
        e.preventDefault();
        //Oculta el modal Salir.
        modalSalir.style.display = "none";
    });

});//End ready.


/* Eliminar Item */
function eliminar_item(idItem, idProducto, Cantidad){
    console.log(idItem);
    console.log(idProducto);
    console.log(Cantidad);

    var action = 'eliminar_item_tabla';
    var num_venta = $('#num_venta').text();

    //Ajax
    $.ajax({
        url: 'ajax_ventas.php',
        type: 'POST',
        async: true,
        data: {
                action:action,
                num_venta:num_venta,
                idItem:idItem,
                idProducto:idProducto,
                Cantidad:Cantidad
            },
        //Success.
        success: function(response){
            console.log(response);
            if(response != 'Error no hay items con ese id'){
                var info = JSON.parse(response);
                //Imprime la tabla.
                $('#tabla').html(info);
            }

            //Actualiza el total de la venta.
            var action = 'total_venta';
            var num_venta = $('#num_venta').text();

            //Ajax.
            $.ajax({
                url: 'ajax_ventas.php',
                type: 'POST',
                async: true,
                data: {
                        action:action,
                        num_venta:num_venta
                    },
                //Success.
                success: function(response){
                    console.log(response);
                    if(response != 'Error'){
                        //Imprime el valor total.
                        $('#valorSubF').html(response);
                        $('#valorF').html(response);

                        if(response == ""){
                            document.getElementById("valorSubF").innerHTML = "0";
                            document.getElementById("valorF").innerHTML = "0";
                        }
                    }

                },
                //Error.
                error: function(error){
                    console.log(error);
                },

            });//End Ajax.

            //Calcula la cantidad de items con el numero de venta.
            //Para ocultar el boton Grabar venta.
            var action = 'cantidad_items';
            var num_venta = $('#num_venta').text();

            //Ajax
            $.ajax({
                url: 'ajax_ventas.php',
                type: 'POST',
                async: true,
                data: {
                        action:action,
                        num_venta:num_venta
                    },
                //Success.
                success: function(response){
                    console.log(response);
                    console.log("10101");
                    if(response == "0"){
                        console.log("aaaa");
                        //Oculta el boton Grabar venta.
                        document.getElementById("grabar_venta").style.display = "none";
                    }
                },
                //Error.
                error: function(error){
                    console.log(error);
                },

            });//End Ajax.

        },
        //Error.
        error: function(error){
            console.log(error);
        },

    });//End Ajax.

};
